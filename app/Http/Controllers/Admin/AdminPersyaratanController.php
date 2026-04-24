<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Public\InformasiPendaftaran;
use Illuminate\Http\Request;

class AdminPersyaratanController extends Controller
{
    public function index()
    {

        InformasiPendaftaran::firstOrCreate(
            ['judul' => 'Persyaratan Pendaftaran'],
            [
                'deskripsi' => 'Belum ada persyaratan yang ditambahkan.',
                'tanggal_mulai' => null,
                'tanggal_selesai' => null,
                'status' => 1
            ]
        );

        $data = InformasiPendaftaran::where('judul', 'Persyaratan Pendaftaran')->get();

        return view('pages.admin.persyaratan.persyaratan', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required'
        ]);

        $persyaratan = InformasiPendaftaran::findOrFail($id);
        
        $persyaratan->update([
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->back()->with('success', 'Persyaratan Pendaftaran berhasil diperbarui!');
    }
}