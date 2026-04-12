<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Public\InformasiPendaftaran;
use Illuminate\Http\Request;

class AdminBiayaController extends Controller
{
    public function index()
    {
        $biaya = InformasiPendaftaran::all();
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
    InformasiPendaftaran::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'created_by' => auth()->id()
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