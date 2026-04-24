<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Public\InformasiPendaftaran;
use Illuminate\Http\Request;

class AdminBiayaController extends Controller
{
    public function index()
    {
        // AUTO-SEED: Pastikan data 'Biaya Pendaftaran' selalu ada (Hanya 1 baris)
        InformasiPendaftaran::firstOrCreate(
            ['judul' => 'Biaya Pendaftaran'],
            [
                'deskripsi' => 'Belum ada informasi biaya yang ditambahkan.',
                'tanggal_mulai' => null,
                'tanggal_selesai' => null,
                'status' => 1
            ]
        );

        // Ambil khusus data Biaya Pendaftaran
        $data = InformasiPendaftaran::where('judul', 'Biaya Pendaftaran')->get();

        return view('pages.admin.biaya', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required' // Cukup validasi teks biasa
        ]);

        $biaya = InformasiPendaftaran::findOrFail($id);
        
        $biaya->update([
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->back()->with('success', 'Rincian Biaya Pendaftaran berhasil diperbarui!');
    }
}