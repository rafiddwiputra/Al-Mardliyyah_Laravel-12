<?php

use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Public\ProgramPendidikanController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\BeritaController; 
use App\Http\Controllers\Public\LupaKataSandiController;
use App\Http\Controllers\Public\PendaftaranController;
use App\Http\Controllers\Public\StatusPendaftaranController;
use App\Http\Controllers\Admin\AdminBeritaController;
use App\Http\Controllers\Public\BerandaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Web Routes


// ================= REGISTER DAN LOGIN (AUTH) =================
Route::get('/register', function () {
    return view('pages.auth.register'); // Pastikan path file ini benar sesuai folder kamu
})->name('register');

// Tambahkan Route POST ini agar form bisa mengirim data
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// =======================================  ROUTE PUBLIC =======================================================================================

// Route profile.blade.php
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
// Route detail-sejarah.blade.php
Route::get('/profil/sejarah/{tahun}', [ProfileController::class, 'detailSejarah'])->name('profile.sejarah.detail');
// Route detail-pimpinan.blade.php
Route::get('/profil/pimpinan/{id}', [ProfileController::class, 'detailPimpinan'])->name('profile.pimpinan.detail');

// Route kontak.blade.php
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// Route Berita.blade.php
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
// Route detail.blade.php 
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.detail');

// Route program-pendidikan.blade.php
Route::get('/program-pendidikan', [ProgramPendidikanController::class, 'programPendidikan'])->name('program');

// Route pendaftaran.blade.php
Route::get('/pendaftaran', [PendaftaranController::class, 'pendaftaran'])->name('pendaftaran');

// Route galeri.blade.php
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

// Route lupa-sandi.blade.php
Route::get('/lupa-sandi', [LupaKataSandiController::class, 'lupaSandi']);

//Route upload.blade.php
Route::get('/upload-dokumen', function () {
    return view('pages.public.pendaftaran.upload');
})->name('upload.dokumen')->middleware('auth');

//Route formulir.blade.php
Route::get('/formulir', function () {
    return view('pages.public.pendaftaran.formulir');
})->name('formulir')->middleware('auth');

// Route Status Pendaftaran
Route::get('/status-pendaftaran/belum', [StatusPendaftaranController::class, 'belum']);
Route::get('/status-pendaftaran/proses', [StatusPendaftaranController::class, 'proses']);
Route::get('/status-pendaftaran/diterima', [StatusPendaftaranController::class, 'diterima']);
Route::get('/status-pendaftaran/ditolak', [StatusPendaftaranController::class, 'ditolak']);

// Route beranda.blade.php
Route::get('/', [BerandaController::class, 'index'])->name('home');


// ============================================================= ROUTE ADMIN PANEL ======================================================
Route::prefix('admin')->middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'pimpinan') {
            return redirect('/')->with('error', 'Anda tidak punya akses ke halaman ini.');
        }
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');

    // Data Pendaftar
    Route::get('/data-pendaftar', function () {
        return view('pages.admin.data-pendaftar.data');
    })->name('admin.pendaftar');

    Route::get('/data-pendaftar/detail-data', function () {
        return view('pages.admin.data-pendaftar.detail-data');
    })->name('admin.pendaftar.detail');


// ====================================== BERITA =====================================
// Menampilkan Tabel (Halaman Utama Admin Berita)
Route::get('/berita', [AdminBeritaController::class, 'index'])->name('admin.berita');

// Memproses Simpan Berita Baru (POST)
Route::post('/berita/simpan', [AdminBeritaController::class, 'store'])->name('admin.berita.store');

// Memproses Update Data (PUT) - URL: /admin/berita/{id}
Route::put('/berita/{id}', [AdminBeritaController::class, 'update'])->name('admin.berita.update');

// Menghapus data (DELETE) - URL: /admin/berita/{id}
Route::delete('/berita/{id}', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');

// ====================================== GELERI =====================================

    // Galeri
    Route::get('/galeri', function () {
        return view('pages.admin.galeri.admin-galeri');
    })->name('admin.galeri');

    // Profil Pondok
    Route::get('/profil-pondok', function () {
        return view('pages.admin.profil-pondok.profil-pondok'); 
    })->name('admin.profil');

    // Program Pendidikan
    Route::get('/program-pendidikan', function () {
        return view('pages.admin.program-pendidikan.program-pendidikan');
    })->name('admin.program');

    // Biaya & Jadwal
    Route::get('/biaya', function () {
        return view('pages.admin.biaya');
    })->name('admin.biaya');

    Route::get('/jadwal', function () {
        return view('pages.admin.jadwal.jadwal');
    })->name('admin.jadwal');

    // Banner & Kontak
    Route::get('/banner-beranda', function () {
        return view('pages.admin.banner-beranda');
    })->name('admin.banner');

    Route::get('/kontak', function () {
        return view('pages.admin.kontak');
    })->name('admin.kontak');

});