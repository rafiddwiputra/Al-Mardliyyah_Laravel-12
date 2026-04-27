<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // TOTAL
        $total = PendaftaranSantri::count();

        // BARU (misal hari ini)
        $baru = PendaftaranSantri::where('status', 'diproses')->count();

        // DITERIMA
        $diterima = PendaftaranSantri::where('status', 'diterima')->count();

        // DITOLAK
        $ditolak = PendaftaranSantri::where('status', 'ditolak')->count();

        // DATA TERBARU (5 terakhir)
        $terbaru = PendaftaranSantri::with('program')
                    ->latest()
                    ->take(5)
                    ->get();

        return view('pages.admin.dashboard', compact(
            'total',
            'baru',
            'diterima',
            'ditolak',
            'terbaru'
        ));
    }
}