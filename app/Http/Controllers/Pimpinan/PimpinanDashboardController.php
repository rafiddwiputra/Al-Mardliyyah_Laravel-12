<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;

class PimpinanDashboardController extends Controller
{
    public function index()
    {
        $total = PendaftaranSantri::count();

        $baru = PendaftaranSantri::where('status', 'diproses')->count();

        $diterima = PendaftaranSantri::where('status', 'diterima')->count();

        $ditolak = PendaftaranSantri::where('status', 'ditolak')->count();

        $terbaru = PendaftaranSantri::latest()->take(5)->get();

        return view('pages.pimpinan.dashboard', compact(
        'total',
        'baru',
        'diterima',
        'ditolak',
        'terbaru'
        ));
    }
}