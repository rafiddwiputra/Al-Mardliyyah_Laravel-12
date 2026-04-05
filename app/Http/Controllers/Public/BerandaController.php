<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Public\TentangPondok;
use App\Models\Public\VisiMisi;
use App\Models\Public\ProgramPendidikan;
use App\Models\Public\Galeri;
use App\Models\Public\Berita;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Menampilkan halaman beranda dengan data dinamis dari database.
     */
    public function index()
    {
        // 1. Ambil data Tentang Pondok (Baris pertama)
        $tentang = TentangPondok::first();

        // 2. Ambil Visi (Tipe 'visi', ambil yang pertama)
        $visi = VisiMisi::where('tipe', 'visi')->first();

        // 3. Ambil Misi (Tipe 'misi', urutkan berdasarkan kolom urutan)
        $misi = VisiMisi::where('tipe', 'misi')
                        ->orderBy('urutan', 'asc')
                        ->get();

        // 4. Ambil 3 Program Pendidikan secara acak atau terbaru untuk ditampilkan di grid Beranda
        // Kita gunakan 'take(3)' agar layout grid tetap rapi (3 kolom)
        $programs = ProgramPendidikan::with('kategori')
                                     ->where('status', 'aktif')
                                     ->latest()
                                     ->take(3)
                                     ->get();
        $beritas = Berita::where('status', 'dipublikasikan') // Sesuaikan kolom status di migrasi kamu
                     ->latest()
                     ->take(3)
                     ->get();


        // 5. Ambil 6 Foto Galeri terbaru untuk section Galeri di bawah
        // Kita gunakan 'take(6)' agar pas dengan grid 3 kolom x 2 baris
        $galeris = Galeri::latest()
                         ->take(6)
                         ->get();

        // 6. Kirim semua variabel ke view beranda
      
    return view('pages.public.beranda', compact('tentang', 'visi', 'misi', 'programs', 'galeris', 'beritas'));
    }
}