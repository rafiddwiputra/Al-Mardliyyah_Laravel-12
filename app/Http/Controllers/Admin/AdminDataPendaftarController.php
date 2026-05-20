<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiPenerimaanSantri;
use App\Mail\PenolakanSantriMail;
use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPimpinanExport; // Gunakan Export milik Pimpinan
use Barryvdh\DomPDF\Facade\Pdf;

class AdminDataPendaftarController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua daftar periode untuk ditampilkan di Dropdown
         $listPeriode = \App\Models\Public\PeriodePendaftaran::orderBy('tanggal_mulai', 'desc')->get();
        
        // BARU: Ambil semua program pendidikan untuk Dropdown
         $listProgram = \App\Models\Public\ProgramPendidikan::where('nama_kategori', 'Lembaga Pendidikan')->get();

             // DEFAULT PERIODE TERBARU
        $periodeId = $request->has('periode_id')
        ? $request->periode_id
        : ($listPeriode->first()->id_periode ?? null);

         // QUERY DASAR
        $query = PendaftaranSantri::with(['ortu', 'user', 'program', 'periode']);

        if ($periodeId) {
            $query->where('id_periode', $periodeId);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // BARU: Filter Program Pendidikan
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        // 4. LOGIKA PENCARIAN (SEARCH)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                // Cari nama
                $q->where('nama_lengkap', 'like', '%' . $search . '%');

                // Cari Smart ID
                if (str_starts_with(strtoupper($search), 'PSB')) {
                    $parts = explode('-', $search);
                    $lastPart = end($parts); 
                    $id = (int) $lastPart; 
                    if ($id > 0) {
                        $q->orWhere('id', $id);
                    }
                } 
                // Cari angka langsung
                elseif (is_numeric($search)) {
                    $q->orWhere('id', $search);
                }
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        // BARU: Tambahkan 'listProgram' ke fungsi compact()
        return view('pages.admin.data-pendaftar.data', compact('data', 'listPeriode', 'listProgram'));
    }

    public function show($id)
    {
        $data = PendaftaranSantri::with(['ortu', 'user', 'program'])->findOrFail($id);

        return view('pages.admin.data-pendaftar.detail-data', compact('data'));
    }

   public function updateStatus(Request $request, $id)
    {
        // 1. Validasi: Catatan wajib diisi JIKA statusnya Ditolak
        $request->validate([
            'status' => 'required|in:Diproses,Diterima,Ditolak',
            'catatan_admin' => 'required_if:status,Ditolak' 
        ], [
            'catatan_admin.required_if' => 'Alasan penolakan WAJIB diisi jika status diubah menjadi Ditolak!'
        ]);

        // 2. Ambil data santri beserta relasi akun (user)
        $data = PendaftaranSantri::with('user')->findOrFail($id);

        // 3. Simpan status lama sebelum diubah, untuk pengecekan pemicu email
        $statusLama = $data->status;

        // 4. Update data ke database
        $data->status = $request->status;
        
        if ($request->status === 'Ditolak') {
            $data->catatan_admin = $request->catatan_admin;
        } else {
            $data->catatan_admin = null; // Kosongkan catatan jika diterima/diproses
        }
        
        $data->save();

        // 5. LOGIKA PEMICU EMAIL
        
        // A. Jika status berubah menjadi 'Diterima'
        if (strtolower($request->status) === 'diterima' && strtolower($statusLama) !== 'diterima') {
            if ($data->user && $data->user->email) {
                Mail::to($data->user->email)->send(new NotifikasiPenerimaanSantri($data));
            }
        }

        // B. Jika status berubah menjadi 'Ditolak'
        if (strtolower($request->status) === 'ditolak' && strtolower($statusLama) !== 'ditolak') {
            if ($data->user && $data->user->email) {
                Mail::to($data->user->email)->send(new PenolakanSantriMail($data, $request->catatan_admin));
            }
        }

        return back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }

    // ================= FUNGSI EXPORT EXCEL YANG SUDAH DIOPTIMASI =================
    public function exportExcel(Request $request)
    {
        // Siapkan Query Dasar
        $query = \App\Models\PendaftaranSantri::with(['program', 'ortu']);

        // Terapkan Filter sama seperti di index
        if ($request->filled('periode_id')) {
            $query->where('id_periode', $request->periode_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        // Ambil datanya (tambahkan latest() agar urutan sama dengan tabel)
        $data = $query->latest()->get();

        // Penamaan file dinamis berdasarkan tanggal
        $namaFile = 'Data_Pendaftar_Admin_' . \Carbon\Carbon::now()->format('d-m-Y') . '.xlsx';

        // Panggil class Export milik Pimpinan
        return Excel::download(new LaporanPimpinanExport($data), $namaFile);
    }

    public function exportPDF(Request $request)
    {
        // Siapkan Query Dasar
        $query = \App\Models\PendaftaranSantri::with(['program', 'ortu']);

        // Siapkan Variabel Keterangan untuk Header Laporan PDF
        $namaPeriode = 'Semua Periode / Tahun';
        $namaProgram = 'Semua Program Pendidikan';
        $statusAktif = $request->filled('status') ? ucfirst($request->status) : 'Semua Status';

        // Terapkan Filter & Ambil Nama Filternya
        if ($request->filled('periode_id')) {
            $query->where('id_periode', $request->periode_id);
            $periode = \App\Models\Public\PeriodePendaftaran::find($request->periode_id);
            if($periode) $namaPeriode = $periode->nama_periode;
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
            $program = \App\Models\Public\ProgramPendidikan::find($request->program_id);
            if($program) $namaProgram = $program->nama_program;
        }

        // Ambil datanya
        $data = $query->get();

        // Lempar variabel data dan keterangan filter ke tampilan PDF
        $pdf = Pdf::loadView('pages.admin.data-pendaftar.pdf', compact('data', 'namaPeriode', 'namaProgram', 'statusAktif'))
          ->setPaper('a4', 'portrait');

        // Menamai file sesuai program jika ada filter
        $namaFile = 'Laporan_Pendaftar_' . str_replace(['/', '\\'], '-', $namaProgram) . '.pdf';

        return $pdf->download($namaFile);
    }

    public function cetakBukti($id)
    {
        // 1. Ambil data santri beserta relasinya (Sudah pas dengan yang dibutuhkan di blade)
        $data = PendaftaranSantri::with(['user', 'ortu', 'program', 'periode'])->findOrFail($id);

        // 2. Pastikan hanya yang berstatus "diterima" yang bisa dicetak
        if (strtolower($data->status) !== 'diterima') {
            return redirect()->back()->with('error', 'Bukti pendaftaran hanya bisa dicetak untuk santri yang sudah diterima.');
        }

        // 3. PERBAIKAN UTAMA: Arahkan dari 'pdf' ke file baru 'pdf-bukti'
        $pdf = Pdf::loadView('pages.admin.data-pendaftar.pdf-bukti', compact('data'))
          ->setPaper('a4', 'portrait');

        // 4. Gunakan stream() agar file terbuka di tab baru (bisa di-preview sebelum di-download)
        return $pdf->stream('Bukti_Pendaftaran_' . $data->nama_lengkap . '.pdf');
    }
}