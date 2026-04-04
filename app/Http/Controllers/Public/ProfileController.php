<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Public\Sejarah;    
use App\Models\Public\Pimpinan;   
use App\Models\Public\Fasilitas;  
use App\Models\Public\VideoPondok; 

class ProfileController extends Controller
{
    /**
     * Halaman Utama Profil Pondok
     * Mengambil semua data untuk ditampilkan di satu halaman
     */
    public function index()
    {
       
        $timelines = Sejarah::orderBy('tahun', 'asc')->get();
        $pimpinans = Pimpinan::all(); 
        $fasilitas = Fasilitas::all(); 
        $video = VideoPondok::latest()->first();
        
        return view('pages.public.profile.index', compact('timelines', 'pimpinans', 'fasilitas', 'video'));
    }

    // Halaman detail sejarah berdasarkan tahun
    public function detailSejarah($tahun)
    {
        $sejarah = Sejarah::where('tahun', $tahun)->firstOrFail();
        
        return view('pages.public.profile.detail-sejarah', compact('sejarah', 'tahun'));
    }

    // Detail pimpinan berdasarkan ID
    public function detailPimpinan($id)
    {
        $pimpinan = Pimpinan::findOrFail($id);
        
        return view('pages.public.profile.detail-pimpinan', compact('pimpinan'));
    }

    // Video Pondok
    public function videoPondok()
    {
        $videos = VideoPondok::all();
        
        return view('pages.public.profile.video-pondok', compact('videos'));
    }
}