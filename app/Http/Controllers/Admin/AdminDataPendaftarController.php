<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiPenerimaanSantri;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataPendaftar;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminDataPendaftarController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua daftar periode untuk ditampilkan di Dropdown
        // Diurutkan dari yang terbaru (desc) agar tahun ajaran terkini ada di paling atas
        $listPeriode = \App\Models\Public\PeriodePendaftaran::orderBy('tanggal_mulai', 'desc')->get();

        // 2. Siapkan Query Dasar
        $query = PendaftaranSantri::with(['ortu', 'user', 'program', 'periode']);

        // 3. LOGIKA FILTER PERIODE
        if ($request->filled('periode_id')) {
            $query->where('id_periode', $request->periode_id);
        }

        //  LOGIKA FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
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

        return view('pages.admin.data-pendaftar.data', compact('data', 'listPeriode'));
    }

    public function show($id)
    {
        $data = PendaftaranSantri::with(['ortu', 'user', 'program'])->findOrFail($id);

        return view('pages.admin.data-pendaftar.detail-data', compact('data'));
    }

   public function updateStatus(Request $request, $id)
    {
        // 1. Ambil data santri beserta relasi akun (user) untuk mendapatkan alamat email
        $data = PendaftaranSantri::with('user')->findOrFail($id);

        // 2. Simpan status lama sebelum diubah, untuk pengecekan
        $statusLama = $data->status;

        // 3. Update dan simpan status baru ke database
        $data->status = $request->status;
        $data->save();

        // 4. LOGIKA PEMICU EMAIL
        // Jika status yang baru adalah 'diterima' DAN sebelumnya belum diterima
        if (strtolower($request->status) === 'diterima' && strtolower($statusLama) !== 'diterima') {
            
            // Pastikan relasi user dan emailnya benar-benar ada
            if ($data->user && $data->user->email) {
                // Panggil kurir untuk mengirim email
                Mail::to($data->user->email)->send(new NotifikasiPenerimaanSantri($data));
            }
        }

        // Tambahkan session success agar ada notifikasi visual di layar admin (opsional)
        return back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }

    public function exportExcel()
    {
        $data = \App\Models\PendaftaranSantri::with(['program', 'ortu'])->get();

        $filename = "data_pendaftar.csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // HEADER KOLOM
            fputcsv($file, [
                'ID',
                'Nama',
                'NISN',
                'NIK',
                'Tempat Lahir',
                'Tanggal Lahir',
                'No KK',
                'Jenis Kelamin',
                'Sekolah Asal',
                'Program',
                'Sumber Informasi',

                'Ukuran Baju Putra',
                'Ukuran Celana Putra',
                'Ukuran Baju Putri',
                'Ukuran Rok Putri',

                'Tanggal Daftar',
                'Status',

                // AYAH
                'Nama Ayah',
                'NIK Ayah',
                'Tanggal Lahir Ayah',
                'Pekerjaan Ayah',
                'Pendidikan Ayah',

                // IBU
                'Nama Ibu',
                'NIK Ibu',
                'Tanggal Lahir Ibu',
                'Pekerjaan Ibu',
                'Pendidikan Ibu',

                // UMUM
                'No HP',
                'Penghasilan',
                'Alamat',
                'Kode Pos'
            ]);

            // DATA
            foreach ($data as $item) {
                fputcsv($file, [
                    // 'PSB' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                    $item->smart_id,
                    $item->nama_lengkap,
                    $item->nisn,
                    $item->nik,
                    $item->tempat_lahir,
                    $item->tanggal_lahir,
                    $item->nomor_kk,
                    $item->jenis_kelamin,
                    $item->sekolah_asal,
                    $item->program->nama_program ?? '-',
                    $item->sumber_informasi,

                    $item->ukuran_baju_putra,
                    $item->ukuran_celana_putra,
                    $item->ukuran_baju_putri,
                    $item->ukuran_rok_putri,

                    $item->created_at ? $item->created_at->format('d/m/Y') : '-',
                    ucfirst($item->status ?? 'diproses'),

                    // AYAH
                    $item->ortu->nama_ayah ?? '-',
                    $item->ortu->nik_ayah ?? '-',
                    $item->ortu?->tanggal_lahir_ayah ?? '-',
                    $item->ortu->pekerjaan_ayah ?? '-',
                    $item->ortu->pendidikan_terakhir_ayah ?? '-',

                    // IBU
                    $item->ortu->nama_ibu ?? '-',
                    $item->ortu->nik_ibu ?? '-',
                    $item->ortu?->tanggal_lahir_ibu ?? '-',
                    $item->ortu->pekerjaan_ibu ?? '-',
                    $item->ortu->pendidikan_terakhir_ibu ?? '-',

                    // UMUM
                    $item->ortu->no_hp ?? '-',
                    $item->ortu->penghasilan_ortu ?? '-',
                    $item->ortu->alamat ?? '-',
                    $item->ortu->kode_pos ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPDF()
    {
        $data = \App\Models\PendaftaranSantri::with(['program', 'ortu'])->get();

        $pdf = Pdf::loadView('pages.admin.data-pendaftar.pdf', compact('data'))
          ->setPaper('a4', 'landscape');

        return $pdf->download('data_pendaftar.pdf');
    }

    public function cetakBukti($id)
    {
        // 1. Ambil data santri beserta relasinya
        $data = PendaftaranSantri::with(['user', 'ortu', 'program'])->findOrFail($id);

        // 2. Pastikan hanya yang berstatus "diterima" yang bisa dicetak
        if (strtolower($data->status) !== 'diterima') {
            return redirect()->back()->with('error', 'Bukti pendaftaran hanya bisa dicetak untuk santri yang sudah diterima.');
        }

        // 3. Render view ke dalam PDF
        // Kita letakkan file blade-nya di dalam folder yang sama dengan view admin pendaftar
        $pdf = Pdf::loadView('pages.admin.data-pendaftar.pdf-bukti', compact('data'))
                  ->setPaper('a4', 'portrait');

        // 4. Gunakan stream() agar file terbuka di tab baru (bisa di-preview sebelum di-download)
        // Jika ingin langsung auto-download, ganti stream() menjadi download()
        return $pdf->stream('Bukti_Pendaftaran_' . $data->nama_lengkap . '.pdf');
    }
    
}