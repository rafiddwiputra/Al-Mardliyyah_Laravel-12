<?php
namespace App\Http\Controllers\Admin; // Perhatikan folder Admin

use App\Http\Controllers\Controller;
use App\Models\Public\VideoPondok; // Panggil model dari folder Public
use Illuminate\Http\Request;

class AdminVideoPondokController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|max:150',
            'deskripsi' => 'required',
            'link_yt'   => 'required|url',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link_yt'   => $request->link_yt,
        ];

        if ($request->hasFile('thumbnail')) {
            // Simpan file ke folder public/storage/video-thumbnails
            $path = $request->file('thumbnail')->store('video-thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        VideoPondok::create($data);

        return redirect()->back()->with('success', 'Video berhasil ditambahkan!');
    }
}