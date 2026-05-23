<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Public\AktivitasSantri;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; // Tambahkan ini untuk fitur nama file aman

class AdminAktivitasSantriController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_aktivitas' => 'required|string|max:255',
            'deskripsi'      => 'required',
            'gambar'         => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('gambar');
        // Keamanan: Bersihkan nama file asli dari spasi dan karakter aneh
        $namaAsli = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $ekstensi = $file->getClientOriginalExtension();
        $namaFile = time() . '_' . Str::slug($namaAsli) . '.' . $ekstensi;

        $folder = public_path('uploads/aktivitas');

        if (!File::isDirectory($folder)) {
            File::makeDirectory($folder, 0755, true, true);
        }

        $file->move($folder, $namaFile);

        AktivitasSantri::create([
            'nama_aktivitas' => $request->nama_aktivitas,
            'deskripsi'      => $request->deskripsi,
            'gambar'         => 'uploads/aktivitas/' . $namaFile,
        ]);

        return back()->with('success', 'Aktivitas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = AktivitasSantri::findOrFail($id);

        $request->validate([
            'nama_aktivitas' => 'required|string|max:255',
            'deskripsi'      => 'required',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        $updateData = [
            'nama_aktivitas' => $request->nama_aktivitas,
            'deskripsi'      => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {

            if (File::exists(public_path($data->gambar))) {
                File::delete(public_path($data->gambar));
            }

            $file = $request->file('gambar');
            // Sama seperti store, bersihkan nama file
            $namaAsli = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namaFile = time() . '_' . Str::slug($namaAsli) . '.' . $ekstensi;
            
            $file->move(public_path('uploads/aktivitas'), $namaFile);

            $updateData['gambar'] = 'uploads/aktivitas/' . $namaFile;
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