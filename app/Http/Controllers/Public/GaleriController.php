<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Public\Galeri;
use App\Models\Public\KategoriGaleri;
use App\Models\Public\AktivitasSantri; // Import Model Baru
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        // --- Bagian 1: Inisialisasi Parameter ---
        $kategoriAktif = $request->query('kategori', 'semua');
        $page = $request->query('page', 1);
        $perPage = 3; // Jumlah foto galeri yang muncul di awal sesuai Figma

        // --- Bagian 2: Ambil Data Kategori & Aktivitas ---
        // Ambil semua kategori untuk tombol filter
        $categories = KategoriGaleri::all();
        
        // Ambil semua data Aktivitas Santri untuk section bawah
        $aktivitas = AktivitasSantri::orderBy('created_at', 'asc')->get();

        // --- Bagian 3: Query Data Galeri Utama ---
        $query = Galeri::with('kategori');

        // Logika Filter: Saring berdasarkan slug kategori jika bukan 'semua'
        if ($kategoriAktif !== 'semua') {
            $query->whereHas('kategori', function($q) use ($kategoriAktif) {
                $q->where('slug', $kategoriAktif);
            });
        }

        // Ambil semua hasil filter, urutkan dari yang terbaru
        $allGaleris = $query->orderBy('created_at', 'desc')->get();
        $total = $allGaleris->count();
        
        // --- Bagian 4: Logika "Muat Lebih Banyak" ---
        // Jika masih di halaman 1, ambil hanya 3. Jika sudah klik tombol (page 2), ambil semua.
        $visibleGaleris = ($page > 1) ? $allGaleris : $allGaleris->take($perPage);

        // --- Bagian 5: Kirim ke View ---
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