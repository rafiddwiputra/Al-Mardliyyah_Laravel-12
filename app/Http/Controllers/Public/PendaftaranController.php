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

        $status = InformasiPendaftaran::latest()->value('status') ?? 0;

        return view('pages.public.pendaftaran.pendaftaran', compact('informasi', 'status'));
    }

    public function uploadDokumen()
    {
        $status = InformasiPendaftaran::latest()->value('status') ?? 0;

        if (!$status) {
            return redirect('/pendaftaran')
                ->with('error', 'Pendaftaran sedang ditutup');
        }

        return view('pages.public.pendaftaran.upload', compact('status'));
    }

    public function formulir()
    {
        $status = InformasiPendaftaran::latest()->value('status') ?? 0;

        if (!$status) {
            return redirect('/pendaftaran')
                ->with('error', 'Pendaftaran sedang ditutup');
        }

        return view('pages.public.pendaftaran.formulir', compact('status'));
    }
}