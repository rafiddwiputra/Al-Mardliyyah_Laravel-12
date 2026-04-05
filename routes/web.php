<?php

use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Public\ProgramPendidikanController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\BeritaController; 
use App\Http\Controllers\Public\LupaKataSandiController;
use App\Http\Controllers\Public\PendaftaranController;
use Illuminate\Support\Facades\Route;

// Web Routes

// ================= ROUTE DEFAULT =================
Route::get('/', function () {
    return view('welcome');
})->name('home');


// ================= REGISTER DAN LOGIN (AUTH) =================
Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');


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


// ============================================================= ROUTE ADMIN PANEL  ======================================================
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');
});