<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri; 
use Illuminate\Support\Facades\File;

class AdminGaleriController extends Controller
{
    public function index()
    {
        // 1. Filter: Hanya ambil data yang kategorinya BUKAN 'Banner'
        $galeris = Galeri::where('kategori', '!=', 'Banner')->latest()->get();
        
        // Kategori untuk dropdown di form (Tanpa Banner)
        $categories = ['Kegiatan', 'Fasilitas', 'Prestasi', 'Lingkungan'];
        
        return view('pages.admin.galeri.admin-galeri', compact('galeris', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:30', // 2. Sesuaikan dengan panjang di EER (30 karakter)
            'kategori' => 'required|in:Kegiatan,Fasilitas,Prestasi,Lingkungan', 
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $tujuanFolder = public_path('uploads/galeri');
            
            if (!File::isDirectory($tujuanFolder)) {
                File::makeDirectory($tujuanFolder, 0777, true, true);
            }

            $file->move($tujuanFolder, $namaFile);
            $pathSimpan = 'uploads/galeri/' . $namaFile;

            Galeri::create([
                'judul' => $request->judul,
                'kategori' => $request->kategori, 
                'gambar' => $pathSimpan,
                // 3. 'created_by' DIHAPUS karena tabel sudah tidak punya kolom ini
            ]);

            return redirect()->back()->with('success', 'Foto galeri berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:30', // Sesuaikan dengan panjang di EER
            'kategori' => 'required|in:Kegiatan,Fasilitas,Prestasi,Lingkungan',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'kategori' => $request->kategori, 
        ];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if (File::exists(public_path($galeri->gambar))) {
                File::delete(public_path($galeri->gambar));
            }

            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/galeri'), $namaFile);
            
            $data['gambar'] = 'uploads/galeri/' . $namaFile;
        }

        $galeri->update($data);

        return redirect()->back()->with('success', 'Data galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if (File::exists(public_path($galeri->gambar))) {
            File::delete(public_path($galeri->gambar));
        }

        $galeri->delete();

        return redirect()->back()->with('success', 'Foto galeri berhasil dihapus!');
    }
}