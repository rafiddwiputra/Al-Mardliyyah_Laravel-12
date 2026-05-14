<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendaftaranSantri;
use App\Models\Public\PeriodePendaftaran;
use App\Models\Public\ProgramPendidikan;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPimpinanController extends Controller
{
    public function index(Request $request)
    {
        $listPeriode = PeriodePendaftaran::orderBy('tanggal_mulai', 'desc')->get();

        $periodeId = $request->periode_id ?? ($listPeriode->first()->id_periode ?? null);
        $periodeAktif = $listPeriode->where('id_periode', $periodeId)->first();

        $query = PendaftaranSantri::where('id_periode', $periodeId);

        $ringkasan = [
            'total' => (clone $query)->count(),
            'baru' => (clone $query)->where('status', 'diproses')->count(),
            'diterima' => (clone $query)->where('status', 'diterima')->count(),
            'ditolak' => (clone $query)->where('status', 'ditolak')->count(),
        ];

        $rekapProgram = ProgramPendidikan::where('nama_kategori', 'lembaga Pendidikan')
            ->withCount([
            'pendaftar as total' => function($q) use ($periodeId) { 
                $q->where('id_periode', $periodeId); 
            },
            'pendaftar as diterima' => function($q) use ($periodeId) { 
                $q->where('id_periode', $periodeId)->where('status', 'diterima'); 
            },
            'pendaftar as ditolak' => function($q) use ($periodeId) { 
                $q->where('id_periode', $periodeId)->where('status', 'ditolak'); 
            },
        ])->get();

        $pendaftarTerbaru = PendaftaranSantri::with('program')
            ->where('id_periode', $periodeId)
            ->latest()
            ->take(5)
            ->get();

        $tanggalCetak = Carbon::now()->format('d/m/Y');

        return view('pages.pimpinan.laporan', compact(
            'listPeriode', 
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
        $periodeAktif = $periodeId ? PeriodePendaftaran::where('id_periode', $periodeId)->first() : null;

        $data = PendaftaranSantri::with(['program', 'ortu'])
            ->when($periodeId, function($query) use ($periodeId) {
                return $query->where('id_periode', $periodeId);
            })->latest()->get();

        $pdf = Pdf::loadView('pages.admin.data-pendaftar.pdf', compact('data', 'periodeAktif'));
        $pdf->setPaper('A4', 'portrait'); 

        // PERBAIKAN: Hilangkan garis miring (/) dari nama periode agar tidak error saat jadi nama file
        $namaPeriodeAman = $periodeAktif ? str_replace(['/', '\\'], '-', $periodeAktif->nama_periode) : 'Semua_Periode';
        $namaFile = 'Laporan_Pendaftar_' . $namaPeriodeAman . '.pdf';
        
        return $pdf->download($namaFile);
    }

    // ================= FUNGSI EXPORT EXCEL =================
    public function exportExcel(Request $request)
    {
        $periodeId = $request->periode_id;
        $periodeAktif = $periodeId ? PeriodePendaftaran::where('id_periode', $periodeId)->first() : null;

        $pendaftar = PendaftaranSantri::with(['program'])
            ->when($periodeId, function($query) use ($periodeId) {
                return $query->where('id_periode', $periodeId);
            })->latest()->get();

        // PERBAIKAN: Hilangkan garis miring (/) dari nama periode
        $namaPeriodeAman = $periodeAktif ? str_replace(['/', '\\'], '-', $periodeAktif->nama_periode) : 'Semua_Periode';
        $namaFile = 'Laporan_Pendaftar_' . $namaPeriodeAman . '.xls';

        return response(view('pages.pimpinan.export-excel', compact('pendaftar', 'periodeAktif')))
            ->header('Content-Type', 'application/vnd-ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $namaFile . '"');
    }
}