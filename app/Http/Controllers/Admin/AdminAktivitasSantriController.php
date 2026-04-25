<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Public\AktivitasSantri;
use Illuminate\Support\Facades\File;

class AdminAktivitasSantriController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_aktivitas' => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('gambar');
        $namaFile = time().'_'.$file->getClientOriginalName();

        $folder = public_path('uploads/aktivitas');

        if (!File::isDirectory($folder)) {
            File::makeDirectory($folder, 0777, true, true);
        }

        $file->move($folder, $namaFile);

        AktivitasSantri::create([
            'nama_aktivitas' => $request->nama_aktivitas,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'uploads/aktivitas/'.$namaFile,
            'created_by' => auth()->id(),
        ]);

        return back()->with('success', 'Aktivitas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = AktivitasSantri::findOrFail($id);

        $request->validate([
            'nama_aktivitas' => 'required|string|max:255',
            'deskripsi' => 'required',
        ]);

        $updateData = [
            'nama_aktivitas' => $request->nama_aktivitas,
            'deskripsi' => $request->deskripsi,
            'updated_by' => auth()->id(),
        ];

        if ($request->hasFile('gambar')) {

            if (File::exists(public_path($data->gambar))) {
                File::delete(public_path($data->gambar));
            }

            $file = $request->file('gambar');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/aktivitas'), $namaFile);

            $updateData['gambar'] = 'uploads/aktivitas/'.$namaFile;
        }

        $data->update($updateData);

        return back()->with('success', 'Aktivitas berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = AktivitasSantri::findOrFail($id);

        if (File::exists(public_path($data->gambar))) {
            File::delete(public_path($data->gambar));
        }

        $data->delete();

        return back()->with('success', 'Aktivitas berhasil dihapus');
    }
}