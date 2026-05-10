<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;
use Illuminate\Http\Request;
use App\Models\Public\PeriodePendaftaran;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // LIST PERIODE
        $listPeriode = PeriodePendaftaran::orderBy('tanggal_mulai', 'desc')->get();

        // QUERY DASAR
        $query = PendaftaranSantri::with(['program', 'periode']);

        // FILTER PERIODE
        if ($request->filled('periode_id')) {
            $query->where('id_periode', $request->periode_id);
        }

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
            'listPeriode'
        ));
    }
}