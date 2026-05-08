<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Public\Fasilitas; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Public\VideoPondok;

class AdminProfilController extends Controller
{
    public function index()
    {
    
        $fasilitas = Fasilitas::latest()->get(); 
         $videos = VideoPondok::latest()->get();
        
        return view('pages.admin.profil-pondok.profil-pondok', compact('fasilitas', 'videos'));
    }

    public function storeFasilitas(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:100',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string|max:150',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $path = public_path('uploads/fasilitas');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $namaFile);
            $data['gambar'] = 'uploads/fasilitas/' . $namaFile;
        }

        Fasilitas::create($data);
        return redirect()->back()->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function updateFasilitas(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string|max:150',
        ]);

        $fasilitas = Fasilitas::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($fasilitas->gambar && File::exists(public_path($fasilitas->gambar))) {
                File::delete(public_path($fasilitas->gambar));
            }

            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/fasilitas'), $namaFile);
            $data['gambar'] = 'uploads/fasilitas/' . $namaFile;
        }

        $fasilitas->update($data);
        return redirect()->back()->with('success', 'Fasilitas berhasil diperbarui!');
    }

    public function destroyFasilitas($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        
        if ($fasilitas->gambar && File::exists(public_path($fasilitas->gambar))) {
            File::delete(public_path($fasilitas->gambar));
        }

        $fasilitas->delete();
        return redirect()->back()->with('success', 'Fasilitas berhasil dihapus!');
    }
}