<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;
use Illuminate\Http\Request;
use App\Models\Public\PeriodePendaftaran;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk fungsi perhitungan grafik

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $listPeriode = PeriodePendaftaran::orderBy('tanggal_mulai', 'desc')->get();

        if (!$request->has('periode_id')) {
            $periodeAktif = PeriodePendaftaran::where('status', 1)->first();
            
            if ($periodeAktif) {
                $request->merge(['periode_id' => $periodeAktif->id_periode]);
            }
        }
   
        $query = PendaftaranSantri::with(['program', 'periode']);

        if ($request->filled('periode_id')) {
            $query->where('id_periode', $request->periode_id);
        }

        // ================= BARU: LOGIKA DATA GRAFIK SUMBER INFORMASI =================
        // ================= BARU: LOGIKA DATA GRAFIK SUMBER INFORMASI =================
        $sumberData = (clone $query)
            ->select('sumber_informasi', DB::raw('count(*) as total'))
            ->groupBy('sumber_informasi')
            ->get();
        
        $chartLabels = $sumberData->pluck('sumber_informasi');
        $chartValues = $sumberData->pluck('total');

        // Cari yang paling banyak dan paling sedikit
        $sumberTerbanyak = $sumberData->sortByDesc('total')->first();
        $sumberTersedikit = $sumberData->sortBy('total')->first();
        // =============================================================================

        // TOTAL
        $total = (clone $query)->count();

        // DIPROSES
        $baru = (clone $query)
            ->where('status', 'diproses')
            ->count();

        // DITERIMA
        $diterima = (clone $query)
            ->where('status', 'diterima')
            ->count();

        // DITOLAK
        $ditolak = (clone $query)
            ->where('status', 'ditolak')
            ->count();

        // DATA TERBARU
        $terbaru = (clone $query)
            ->latest()
            ->take(5)
            ->get();

        return view('pages.admin.dashboard', compact(
            'total',
            'baru',
            'diterima',
            'ditolak',
            'terbaru',
            'listPeriode',
            'chartLabels', // Kirim label ke Blade
            'chartValues',  // Kirim angka total ke Blade
            'sumberTerbanyak',
            'sumberTersedikit'
        ));
    }
}