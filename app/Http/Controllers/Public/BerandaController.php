<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Public\TentangPondok;
use App\Models\Public\VisiMisi;
use App\Models\Public\ProgramPendidikan;
use App\Models\Galeri;
use App\Models\Public\Kontak;
use App\Models\Public\Berita;
use App\Models\ProfilPondok;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Menampilkan halaman beranda dengan data dinamis dari database.
     */
   public function index()
    {
        // 1. Data Banner & Logo
        $profil = ProfilPondok::first();

        // 2. Data Tentang Pondok
        $tentang = TentangPondok::first();

        // 4. Program Pendidikan (Ambil 3 terbaru)
        $programs = ProgramPendidikan::where('status', 'aktif')
                                     ->latest()
                                     ->take(3)
                                     ->get();

        // 5. Berita Terbaru (Pastikan status sesuai dengan yang kita buat kemarin: 'publish')
        $beritas = Berita::where('status', 'publish') 
                         ->latest()
                         ->take(3)
                         ->get();

        // 6. Galeri Terbaru
        $galeris = Galeri::latest()
                         ->take(6)
                         ->get();
        
        $kontaks = Kontak::all();

        // Kirim semua variabel ke view
        return view('pages.public.beranda', compact(
            'profil', 
            'tentang',  
            'programs', 
            'galeris', 
            'beritas',
            'kontaks'
        ));
    }
}