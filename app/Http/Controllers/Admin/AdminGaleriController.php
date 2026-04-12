<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Public\Galeri; 
use App\Models\Public\KategoriGaleri; 
use Illuminate\Support\Facades\File;

class AdminGaleriController extends Controller
{
    /**
     * Menampilkan halaman utama galeri admin
     */
    public function index()
    {
        // Mengambil galeri beserta relasi kategorinya
        $galeris = Galeri::with('kategori')->latest()->get();
        // Mengambil semua kategori untuk dropdown di modal tambah/edit
        $categories = KategoriGaleri::all();
        
        return view('pages.admin.galeri.admin-galeri', compact('galeris', 'categories'));
    }

    /**
     * Menyimpan foto baru ke database dan storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_galeri,id',
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
                'kategori_id' => $request->kategori_id,
                'gambar' => $pathSimpan,
                'created_by' => auth()->id(),
            ]);

            return redirect()->back()->with('success', 'Foto galeri berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
    }

    /**
     * Memperbarui data galeri (judul, kategori, atau foto)
     */
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_galeri,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Data yang akan diupdate (kecuali gambar)
        $data = [
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
        ];

        // Cek jika ada file gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            // 1. Hapus gambar lama dari server jika ada
            if (File::exists(public_path($galeri->gambar))) {
                File::delete(public_path($galeri->gambar));
            }

            // 2. Upload gambar baru
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/galeri'), $namaFile);
            
            // 3. Masukkan path gambar baru ke array data
            $data['gambar'] = 'uploads/galeri/' . $namaFile;
        }

        $galeri->update($data);

        return redirect()->back()->with('success', 'Data galeri berhasil diperbarui!');
    }

    /**
     * Menghapus data galeri dan file fisiknya
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Hapus file fisik dari folder public agar storage tidak penuh
        if (File::exists(public_path($galeri->gambar))) {
            File::delete(public_path($galeri->gambar));
        }

        $galeri->delete();

        return redirect()->back()->with('success', 'Foto galeri berhasil dihapus!');
    }

    public function storeKategori(Request $request)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:100|unique:kategori_galeri,nama_kategori',
    ]);

    KategoriGaleri::create([
        'nama_kategori' => $request->nama_kategori,
        'slug'          => Str::slug($request->nama_kategori), // Ini solusinya!
    ]);

    KategoriGaleri::create([
        'nama_kategori' => $request->nama_kategori,
    ]);

    return redirect()->back()->with('success', 'Kategori baru berhasil ditambahkan!');
}
}