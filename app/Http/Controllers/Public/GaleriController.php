<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Public\Galeri;
use App\Models\Public\KategoriGaleri;
use App\Models\Public\AktivitasSantri; 
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        
        $kategoriAktif = $request->query('kategori', 'semua');
        $page = $request->query('page', 1);
        $perPage = 3; 
        $categories = KategoriGaleri::all();
        $aktivitas = AktivitasSantri::orderBy('created_at', 'asc')->get();
        $query = Galeri::with('kategori');

        if ($kategoriAktif !== 'semua') {
            $query->whereHas('kategori', function($q) use ($kategoriAktif) {
                $q->where('slug', $kategoriAktif);
            });
        }

        $allGaleris = $query->orderBy('created_at', 'desc')->get();
        $total = $allGaleris->count();
        $visibleGaleris = ($page > 1) ? $allGaleris : $allGaleris->take($perPage);

        return view('pages.public.galeri', compact(
            'visibleGaleris', 
            'categories', 
            'kategoriAktif', 
            'total', 
            'page', 
            'perPage',
            'aktivitas' // Variabel data Aktivitas Santri
        ));
    }
}