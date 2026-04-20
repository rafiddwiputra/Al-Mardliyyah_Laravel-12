<?php
namespace App\Http\Controllers\Admin; // Perhatikan folder Admin

use App\Http\Controllers\Controller;
use App\Models\Public\VideoPondok; // Panggil model dari folder Public
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function destroy($id)
    {
        // Cari data video berdasarkan ID
        $video = VideoPondok::findOrFail($id);

        // Hapus file thumbnail dari folder storage jika ada
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }

        // Hapus data dari database
        $video->delete();

        // Kembalikan ke halaman dengan pesan sukses
        return redirect()->back()->with('success', 'Video berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi input
        $request->validate([
            'judul'     => 'required|max:150',
            'deskripsi' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Cari data video lama
        $video = VideoPondok::findOrFail($id);

        // 3. Siapkan data teks yang akan diupdate
        $data = [
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link_yt'   => $request->link_yt,
        ];

        // 4. Jika user mengupload thumbnail/gambar baru
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama dari storage agar tidak memenuhi memori server
            if ($video->thumbnail) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            
            // Simpan gambar baru
            $path = $request->file('thumbnail')->store('video-thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        // 5. Simpan perubahan ke database
        $video->update($data);

        // 6. Kembalikan ke halaman admin dengan pesan sukses
        return redirect()->back()->with('success', 'Data video berhasil diperbarui!');
    }
}