<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita; 
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('status', 'publish')
                        ->orderBy('created_at', 'desc')
                        ->get();

        $beritaPopuler = Berita::where('status', 'publish')
                               ->orderBy('created_at', 'desc')
                               ->take(3)
                               ->get();

        return view('pages.public.berita.berita', compact('beritas', 'beritaPopuler'));
    }

    // 1. Ubah parameter dari $slug menjadi $id
    public function show($id)
    {
        // 2. Ubah pencarian dari 'slug' menjadi 'id'
        $berita = Berita::where('id', $id)
                        ->where('status', 'publish')
                        ->firstOrFail();
        
        // 3. Ubah pengecualian berita terkait dari 'slug' menjadi 'id'
        $beritaTerkait = Berita::where('id', '!=', $id)
                                ->where('status', 'publish')
                                ->orderBy('created_at', 'desc')
                                ->take(3)
                                ->get();

        return view('pages.public.berita.detail-berita', compact('berita', 'beritaTerkait'));
    }
}