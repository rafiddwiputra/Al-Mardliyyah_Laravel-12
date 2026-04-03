<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Public\Sejarah;    // Import Model Sejarah
use App\Models\Public\Pimpinan;   // Import Model Pimpinan
use App\Models\Public\Fasilitas;  // Import Model Fasilitas
use App\Models\Public\VideoPondok; // Import Model VideoPondok

class ProfileController extends Controller
{
    /**
     * Halaman Utama Profil Pondok
     * Mengambil semua data untuk ditampilkan di satu halaman
     */
    public function index()
    {
        // 1. Ambil data sejarah urut tahun tertua
        $timelines = Sejarah::orderBy('tahun', 'asc')->get();
        
        // 2. Ambil semua data pimpinan
        $pimpinans = Pimpinan::all(); 

        // 3. Ambil semua data fasilitas
        $fasilitas = Fasilitas::all(); 

        // 4. Ambil data video terbaru untuk ditampilkan di section video
        // Kita gunakan first() karena biasanya hanya satu video utama yang tampil
        $video = VideoPondok::latest()->first();
        
        // 5. Kirim semua data ke view profile index
        return view('pages.public.profile.index', compact('timelines', 'pimpinans', 'fasilitas', 'video'));
    }

    /**
     * Halaman Detail Sejarah berdasarkan Tahun
     */
    public function detailSejarah($tahun)
    {
        $sejarah = Sejarah::where('tahun', $tahun)->firstOrFail();
        
        return view('pages.public.profile.detail-sejarah', compact('sejarah', 'tahun'));
    }

    /**
     * Halaman Detail Pimpinan berdasarkan ID
     */
    public function detailPimpinan($id)
    {
        $pimpinan = Pimpinan::findOrFail($id);
        
        return view('pages.public.profile.detail-pimpinan', compact('pimpinan'));
    }

    /**
     * Jika kamu membutuhkan list semua video di halaman terpisah
     */
    public function videoPondok()
    {
        $videos = VideoPondok::all();
        
        return view('pages.public.profile.video-pondok', compact('videos'));
    }
}