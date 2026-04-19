<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;

class AdminDataPendaftarController extends Controller
{
    public function index()
    {
        $data = PendaftaranSantri::latest()->paginate(10);

        return view('pages.admin.data-pendaftar.data', compact('data'));
    }
}