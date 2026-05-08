<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('pages.admin.berita.berita', compact('beritas'));
    }

    public function create()
    {
        return view('pages.admin.berita.berita-tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg|max:2048', 
            'deskripsi' => 'required',
            'tanggal'   => 'required|date',
            'status'    => 'required|in:draft,publish',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_gambar = time() . '_' . $file->getClientOriginalName();
            $tujuan_upload = public_path('images/berita');
            $file->move($tujuan_upload, $nama_gambar);
            $path_gambar = 'images/berita/' . $nama_gambar;
        }

        Berita::create([
            'judul'      => $request->judul,
            'gambar'     => $path_gambar,
            'deskripsi'  => $request->deskripsi,
            'status'     => $request->status,
            'created_at' => $request->tanggal,
            'updated_at' => $request->tanggal,
        ]);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('pages.admin.berita.berita-edit', compact('berita'));
    }


    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul'     => 'required|string|max:255',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'deskripsi' => 'required',
            'tanggal'   => 'required|date',
            'status'    => 'required|in:draft,publish',
        ]);

        $data = [
            'judul'      => $request->judul,
            'deskripsi'  => $request->deskripsi,
            'status'     => $request->status,
            'created_at' => $request->tanggal,
            'updated_at' => now(), 
        ];

        if ($request->hasFile('gambar')) {
            if (File::exists(public_path($berita->gambar))) {
                File::delete(public_path($berita->gambar));
            }

            $file = $request->file('gambar');
            $nama_gambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/berita'), $nama_gambar);
            $data['gambar'] = 'images/berita/' . $nama_gambar;
        }

        $berita->update($data);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil diperbarui!');
    }
      
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id); 
        if (File::exists(public_path($berita->gambar))) {
            File::delete(public_path($berita->gambar));
        }

        $berita->delete();

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil dihapus!');
    }
}