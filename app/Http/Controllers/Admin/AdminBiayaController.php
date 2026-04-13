<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Public\InformasiPendaftaran;
use Illuminate\Http\Request;

class AdminBiayaController extends Controller
{
public function index()
{
    // Filter: Hanya ambil data yang deskripsinya HANYA berisi angka (numeric)
    // Ini akan membuang data jadwal yang ada tanda hubung "-" atau huruf
    $biaya = InformasiPendaftaran::all()->filter(function ($item) {
        return is_numeric($item->deskripsi);
    });

    return view('pages.admin.biaya', compact('biaya'));
}

    public function update(Request $request, $id)
{
    $data = InformasiPendaftaran::findOrFail($id);

    $data->update([
        'deskripsi' => $request->deskripsi
    ]);

    return back();
}

public function store(Request $request)
{
    // Tambahkan penanda kalau ini adalah data biaya
    InformasiPendaftaran::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'created_by' => auth()->id()
        // 'type' => 'biaya' // Ide bagus kalau kamu mau nambah kolom type di migrasi
    ]);

    return back()->with('success', 'Berhasil ditambahkan');
}

public function destroy($id)
{
    $data = InformasiPendaftaran::findOrFail($id);
    $data->delete();

    return back()->with('success', 'Berhasil dihapus');
}
}