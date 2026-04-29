<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;
use Illuminate\Support\Facades\Auth;

class StatusPendaftaranController extends Controller
{
    public function index()
    {
        $data = PendaftaranSantri::where('users_id', Auth::id())->first();

        if (!$data) {
            return view('pages.public.pendaftaran.status-pendaftaran.belum');
        }

        $status = strtolower(trim($data->status));

        switch ($status) {
    case 'diterima':
        return view('pages.public.pendaftaran.status-pendaftaran.diterima', compact('data'));
    case 'ditolak':
        return view('pages.public.pendaftaran.status-pendaftaran.ditolak', compact('data'));
    default:
        return view('pages.public.pendaftaran.status-pendaftaran.proses', compact('data'));
}
    }
}