<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendaftaranSantri;
use App\Models\Public\PeriodePendaftaran;
use App\Models\Public\ProgramPendidikan;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\LaporanPimpinanExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPimpinanController extends Controller
{
    public function index(Request $request)
{
    $listPeriode = PeriodePendaftaran::orderBy('tanggal_mulai', 'desc')->get();

    $listProgram = ProgramPendidikan::where('nama_kategori', 'lembaga Pendidikan')->get();

    $periodeId = $request->periode_id ?? ($listPeriode->first()->id_periode ?? null);
    $periodeAktif = $listPeriode->where('id_periode', $periodeId)->first();

    // QUERY DASAR
    $query = PendaftaranSantri::with('program')
        ->where('id_periode', $periodeId);

    // FILTER PROGRAM
    if ($request->filled('program_id')) {
        $query->where('program_id', $request->program_id);
    }

    // FILTER STATUS
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // SEARCH NAMA / SMART ID
    if ($request->filled('search')) {

    $search = $request->search;

    $query->where(function ($q) use ($search) {

        $q->where('nama_lengkap', 'like', '%' . $search . '%')
          ->orWhere('id', 'like', '%' . $search . '%');

    });
}

    // RINGKASAN
    $ringkasan = [
        'total' => (clone $query)->count(),
        'baru' => (clone $query)->where('status', 'diproses')->count(),
        'diterima' => (clone $query)->where('status', 'diterima')->count(),
        'ditolak' => (clone $query)->where('status', 'ditolak')->count(),
    ];

    // REKAP PROGRAM
    $rekapProgram = ProgramPendidikan::where('nama_kategori', 'lembaga Pendidikan')
        ->withCount([
            'pendaftar as total' => function($q) use ($periodeId) {
                $q->where('id_periode', $periodeId);
            },
            'pendaftar as diterima' => function($q) use ($periodeId) {
                $q->where('id_periode', $periodeId)
                  ->where('status', 'diterima');
            },
            'pendaftar as ditolak' => function($q) use ($periodeId) {
                $q->where('id_periode', $periodeId)
                  ->where('status', 'ditolak');
            },
        ])->get();

    // DATA PENDAFTAR
    $pendaftarTerbaru = $query->latest()->get();

    $tanggalCetak = Carbon::now()->format('d/m/Y');

    return view('pages.pimpinan.laporan', compact(
        'listPeriode',
        'listProgram',
        'periodeAktif',
        'ringkasan',
        'rekapProgram',
        'pendaftarTerbaru',
        'tanggalCetak'
    ));
}

    // ================= FUNGSI EXPORT PDF (MENGGUNAKAN TEMPLATE KARTU) =================
    public function exportPDF(Request $request)
    {
        $periodeId = $request->periode_id;
        $programId = $request->program_id;
        $status = $request->status;
        $periodeAktif = $periodeId ? PeriodePendaftaran::where('id_periode', $periodeId)->first() : null;
        $query = PendaftaranSantri::with(['program', 'ortu']);

        if ($periodeId) {
            $query->where('id_periode', $periodeId);
        }

        if ($programId) {
            $query->where('program_id', $programId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $data = $query->latest()->get();
        $namaProgram = $programId 
                        ? ProgramPendidikan::find($programId)->nama_program ?? 'Semua Program' 
                        : 'Semua Program';
                        
        $namaPeriode = $periodeAktif ? $periodeAktif->nama_periode : 'Semua Periode';
        $statusAktif = $status ? ucfirst($status) : 'Semua Status';
        $pdf = Pdf::loadView('pages.admin.data-pendaftar.pdf', compact(
            'data', 
            'periodeAktif', 
            'namaProgram', 
            'namaPeriode', 
            'statusAktif'
        ));
        
        $pdf->setPaper('A4', 'portrait'); 

        $namaPeriodeAman = $periodeAktif ? str_replace(['/', '\\'], '-', $periodeAktif->nama_periode) : 'Semua_Periode';
        $namaFile = 'Laporan_Pendaftar_' . $namaPeriodeAman . '.pdf';
        
        return $pdf->download($namaFile);
    }

    // ================= FUNGSI EXPORT EXCEL (VERSI XLSX) =================
    public function exportExcel(Request $request)
    {
        $periodeId = $request->periode_id;
        $periodeAktif = $periodeId ? \App\Models\Public\PeriodePendaftaran::where('id_periode', $periodeId)->first() : null;

        $pendaftar = \App\Models\PendaftaranSantri::with(['program', 'ortu'])
            ->when($periodeId, function($query) use ($periodeId) {
                return $query->where('id_periode', $periodeId);
            })->latest()->get();

        $namaPeriodeAman = $periodeAktif ? str_replace(['/', '\\'], '-', $periodeAktif->nama_periode) : 'Semua_Periode';
        $namaFile = 'Laporan_Pendaftar_' . $namaPeriodeAman . '.xlsx';

        return Excel::download(new LaporanPimpinanExport($pendaftar), $namaFile);
    }
}