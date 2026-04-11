<?php

use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Public\ProgramPendidikanController;
use App\Http\Controllers\Admin\AdminProgramController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\BeritaController; 
use App\Http\Controllers\Public\LupaKataSandiController;
use App\Http\Controllers\Public\PendaftaranController;
use App\Http\Controllers\Public\StatusPendaftaranController;
use App\Http\Controllers\Admin\AdminBeritaController;
use App\Http\Controllers\Public\BerandaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Public\RedirectPendaftaranController;
use App\Http\Controllers\Admin\InformasiWebsiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// ================== DEBUG ==================
Route::get('/debug-login', function () {
    return auth()->check() ? 'SUDAH LOGIN' : 'BELUM LOGIN';
});

// ================= REGISTER DAN LOGIN (AUTH) =================
Route::get('/register', function () {
    return view('pages.auth.register');
})->middleware('guest')->name('register'); 

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store')
    ->middleware('guest');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('login.authenticate')
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ================= Suatu Kondisi Pendaftaran =================
Route::get('/redirect-pendaftaran', [RedirectPendaftaranController::class, 'index'])
    ->name('redirect.pendaftaran');


// ================= EMAIL VERIFICATION =================

// Halaman notifikasi verifikasi
Route::get('/email/verify', function () {
    return view('pages.auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

// Proses klik link dari email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('formulir')
        ->with('success', 'Email berhasil diverifikasi! Silakan lengkapi formulir.');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Kirim ulang email verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Link verifikasi dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// ======================================= ROUTE PUBLIC =======================================

// Profile
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
Route::get('/profil/sejarah/{tahun}', [ProfileController::class, 'detailSejarah'])->name('profile.sejarah.detail');
Route::get('/profil/pimpinan/{id}', [ProfileController::class, 'detailPimpinan'])->name('profile.pimpinan.detail');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.detail');

// Program Pendidikan
Route::get('/program-pendidikan', [ProgramPendidikanController::class, 'programPendidikan'])->name('program');

// Pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'pendaftaran'])->name('pendaftaran');

// Galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

// Lupa Password
Route::get('/lupa-sandi', [LupaKataSandiController::class, 'lupaSandi']);


// ================= PROTECTED (WAJIB VERIFIKASI) =================
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/upload-dokumen', function () {
        return view('pages.public.pendaftaran.upload');
    })->name('upload.dokumen');

    Route::get('/formulir', function () {
        return view('pages.public.pendaftaran.formulir');
    })->name('formulir');

});


// Status Pendaftaran
Route::get('/status-pendaftaran/belum', [StatusPendaftaranController::class, 'belum']);
Route::get('/status-pendaftaran/proses', [StatusPendaftaranController::class, 'proses']);
Route::get('/status-pendaftaran/diterima', [StatusPendaftaranController::class, 'diterima']);
Route::get('/status-pendaftaran/ditolak', [StatusPendaftaranController::class, 'ditolak']);


// Beranda
Route::get('/', [BerandaController::class, 'index'])->name('home');


// ================= ADMIN PANEL =================
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        if (!in_array(Auth::user()->role, ['admin', 'pimpinan'])) {
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


    // ================= BERITA =================
    Route::get('/berita', [AdminBeritaController::class, 'index'])->name('admin.berita');
    Route::post('/berita/simpan', [AdminBeritaController::class, 'store'])->name('admin.berita.store');
    Route::put('/berita/{id}', [AdminBeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/berita/{id}', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');


    // ================= GALERI =================
    Route::get('/galeri', function () {
        return view('pages.admin.galeri.admin-galeri');
    })->name('admin.galeri');

    // Profil Pondok
    Route::get('/profil-pondok', function () {
        return view('pages.admin.profil-pondok.profil-pondok'); 
    })->name('admin.profil');

    // Program Pendidikan
    Route::get('/program-pendidikan', [AdminProgramController::class, 'programPendidikan'])
    ->name('admin.program');

    Route::post('/program-pendidikan', [AdminProgramController::class, 'store'])
    ->name('program.store');

    Route::put('/program-pendidikan/{id}', [AdminProgramController::class, 'update'])
    ->name('admin.program.update');
    
    Route::delete('/program-pendidikan/{id}', [AdminProgramController::class, 'destroy']);

    // Biaya & Jadwal
    Route::get('/biaya', function () {
        return view('pages.admin.biaya');
    })->name('admin.biaya');

    Route::get('/jadwal', function () {
        return view('pages.admin.jadwal.jadwal');
    })->name('admin.jadwal');

    Route::get('/banner-beranda', [InformasiWebsiteController::class, 'index'])->name('admin.banner');
    Route::post('/banner-beranda', [InformasiWebsiteController::class, 'update'])->name('informasi.update');

    Route::get('/kontak', function () {
        return view('pages.admin.kontak');
    })->name('admin.kontak');

});