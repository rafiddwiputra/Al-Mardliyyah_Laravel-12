<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Public\ProgramPendidikan;
use App\Models\Galeri;
use App\Models\Public\Kontak;
use App\Models\Public\Berita;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $banners = Galeri::where('kategori', 'Banner')->latest()->get();
        $programs = ProgramPendidikan::where('status', 'aktif')
                                     ->latest()
                                     ->take(3)
                                     ->get();
        $beritas = Berita::where('status', 'publish') 
                         ->latest()
                         ->take(3)
                         ->get();
        $galeris = Galeri::where('kategori', '!=', 'Banner')
                         ->latest()
                         ->take(6)
                         ->get();
        
        $kontaks = Kontak::all();
        return view('pages.public.beranda', compact(
            'banners', 
            'programs', 
            'galeris', 
            'beritas',
            'kontaks'
        ));
    }
}