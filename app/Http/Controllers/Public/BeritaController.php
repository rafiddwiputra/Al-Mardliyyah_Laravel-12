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

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
                        ->where('status', 'publish')
                        ->firstOrFail();
        
        $beritaTerkait = Berita::where('slug', '!=', $slug)
                                ->where('status', 'publish')
                                ->orderBy('created_at', 'desc')
                                ->take(3)
                                ->get();

        return view('pages.public.berita.detail-berita', compact('berita', 'beritaTerkait'));
    }
}