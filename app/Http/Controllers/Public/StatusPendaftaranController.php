<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusPendaftaranController extends Controller
{
     public function belum()
    {
        return view('pages.public.pendaftaran.status-pendaftaran.belum');
    }

    public function proses()
    {
        return view('pages.public.pendaftaran.status-pendaftaran.proses');
    }

    public function diterima()
    {
        return view('pages.public.pendaftaran.status-pendaftaran.diterima');
    }

    public function ditolak()
    {
        return view('pages.public.pendaftaran.status-pendaftaran.ditolak');
    }
}
