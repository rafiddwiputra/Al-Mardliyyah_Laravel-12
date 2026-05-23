<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Galeri; 
use App\Models\Public\AktivitasSantri; 
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $kategoriAktif = $request->query('kategori', 'semua');
        $page = $request->query('page', 1);
        $perPage = 4; 

        // PERUBAHAN UTAMA: Sesuaikan list kategori dengan permintaan pondok
        $categories = [
            'Kegiatan Pembelajaran Santri',
            'Kegiatan Ibadah Santri',
            'Ekstrakulikuler',
            'Event',
            'Kegiatan Santri',
            'Prestasi'
        ];
        
        $aktivitas = AktivitasSantri::orderBy('created_at', 'asc')->get();
    
        $query = Galeri::query();

        if ($kategoriAktif !== 'semua') {
            $query->where('kategori', $kategoriAktif);
        }

        $allGaleris = $query->orderBy('created_at', 'desc')->get();
        $total = $allGaleris->count();
        
        // Kirimkan semua galeri hasil query agar bisa disembunyikan/ditampilkan oleh JavaScript
        $visibleGaleris = $allGaleris;

        return view('pages.public.galeri', compact(
            'visibleGaleris', 
            'categories', 
            'kategoriAktif', 
            'total', 
            'page', 
            'perPage',
            'aktivitas'
        ));
    }
}