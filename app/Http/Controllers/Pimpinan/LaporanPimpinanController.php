<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendaftaranSantri;
use App\Models\Public\PeriodePendaftaran;
use App\Models\Public\ProgramPendidikan;
use Carbon\Carbon;

class LaporanPimpinanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil daftar periode untuk Dropdown
        $listPeriode = PeriodePendaftaran::orderBy('tanggal_mulai', 'desc')->get();

        // 2. Tentukan periode mana yang sedang dilihat (Default: periode terbaru)
        $periodeId = $request->periode_id ?? ($listPeriode->first()->id_periode ?? null);
        $periodeAktif = $listPeriode->where('id_periode', $periodeId)->first();

        // 3. Hitung Ringkasan Keseluruhan (Query Dasar)
        $query = PendaftaranSantri::where('id_periode', $periodeId);

        $ringkasan = [
            // Gunakan clone agar query dasar tidak tertumpuk
            'total' => (clone $query)->count(),
            'baru' => (clone $query)->where('status', 'diproses')->count(),
            'diterima' => (clone $query)->where('status', 'diterima')->count(),
            'ditolak' => (clone $query)->where('status', 'ditolak')->count(),
        ];

        // 4. Hitung Rekapitulasi per Program Pendidikan
        // Ini akan menghitung otomatis jumlah pendaftar per jenjang (MTs, MA, dll)
        $rekapProgram = ProgramPendidikan::withCount([
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

        // 5. Ambil 5 Pendaftar Terbaru untuk ditampilkan di bawah
        $pendaftarTerbaru = PendaftaranSantri::with('program')
            ->where('id_periode', $periodeId)
            ->latest()
            ->take(5)
            ->get();

        // Tanggal cetak hari ini
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
}