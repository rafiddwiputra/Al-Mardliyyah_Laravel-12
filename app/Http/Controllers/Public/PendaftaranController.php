<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Public\InformasiPendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function pendaftaran()
    {
        // Mengambil semua data informasi pendaftaran
        $informasi = InformasiPendaftaran::orderBy('created_at', 'asc')->get();
        
        return view('pages.public.pendaftaran.pendaftaran', compact('informasi'));
    }
}