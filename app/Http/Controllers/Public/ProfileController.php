<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;   
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
       
        $fasilitas = Fasilitas::all(); 
        $videos = VideoPondok::latest()->get();
        
        return view('pages.public.profile.index', compact( 'fasilitas', 'videos'));
    }

    // Video Pondok
    public function videoPondok()
    {
        $videos = VideoPondok::all();
        
        return view('pages.public.profile.video-pondok', compact('videos'));
    }
}