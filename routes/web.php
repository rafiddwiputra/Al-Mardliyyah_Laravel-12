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

// ROUTE PUBLIC =======================================================================================

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


// ============================================================= ROUTE ADMIN PANEL  ======================================================
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        // Cek lagi di sini
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'pimpinan') {
            return redirect('/')->with('error', 'Anda tidak punya akses ke halaman ini.');
        }
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');
});

//Route data.blade.php
Route::get('/admin/data-pendaftar', function () {
    return view('pages.admin.data-pendaftar.data');
});

//Route detail-data.blade.php
Route::get('/admin/data-pendaftar/detail-data', function () {
    return view('pages.admin.data-pendaftar.detail-data');
});

//Route admin-galeri.blade.php
Route::get('/admin/galeri/admin-galeri', function () {
    return view('pages.admin.galeri.admin-galeri');
});

//Route biaya.blade.php
Route::get('/admin/biaya', function () {
    return view('pages.admin.biaya');
});

//Route jadwal.blade.php
Route::get('/admin/jadwal/jadwal', function () {
    return view('pages.admin.jadwal.jadwal');
});

// Route admin berita
Route::prefix('admin')->group(function () {

    Route::get('admin/berita', function () {
        return view('pages.admin.berita.berita');
    });

    Route::get('berita/tambah', function () {
        return view('pages.admin.berita.berita-tambah');
    });

    Route::get('berita/edit', function () {
        return view('pages.admin.berita.berita-edit');
    });

    Route::get('berita/hapus', function () {
        return view('pages.admin.berita.berita-hapus');
    });

});

// Route admin profil pondok
Route::get('/admin/profil-pondok', function () {
    return view('pages.admin.profil-pondok.profil-pondok'); 
});

//Route admin program pendidikan 
Route::get('/admin/program-pendidikan', function () {
    return view('pages.admin.program-pendidikan.program-pendidikan');
});

//Route admin banner beranda
Route::get('/admin/banner-beranda', function () {
    return view('pages.admin.banner-beranda');
});

//Route admin kontak
Route::get('/admin/kontak', function () {
    return view('pages.admin.kontak');
});

//Route edit profil admin
Route::get('/admin/profil', function () {
    return view('pages.admin.edit-profil');
});


/// ROUTE PIMPINAN
Route::get('/pimpinan/laporan', function () {
    return view('pages.pimpinan.laporan');
});