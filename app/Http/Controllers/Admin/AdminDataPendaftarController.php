<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;
use Illuminate\Support\Str;

class AdminDataPendaftarController extends Controller
{
    public function index()
    {
        $data = PendaftaranSantri::latest()->paginate(10);

        return view('pages.admin.data-pendaftar.data', compact('data'));
    }

    public function show($id)
{
    $data = PendaftaranSantri::with('ortu')->findOrFail($id);

    return view('pages.admin.data-pendaftar.detail-data', compact('data'));
}
}