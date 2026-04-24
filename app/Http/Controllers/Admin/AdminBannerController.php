<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\File;

class AdminBannerController extends Controller
{
    public function index()
    {
        $banners = Galeri::where('kategori', 'Banner')->latest()->get();
       return view('pages.admin.banner.banner-beranda', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
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
                'gambar' => $pathSimpan,
                'kategori' => 'Banner', 
            ]);

            return redirect()->back()->with('success', 'Banner utama berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah banner.');
    }

    public function destroy($id)
    {
        $banner = Galeri::findOrFail($id);

        if (File::exists(public_path($banner->gambar))) {
            File::delete(public_path($banner->gambar));
        }

        $banner->delete();

        return redirect()->back()->with('success', 'Banner berhasil dihapus!');
    }
}