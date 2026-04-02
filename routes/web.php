<?php

use App\Http\Controllers\Public\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ================= ROUTE DEFAULT =================
Route::get('/', function () {
    return view('welcome');
});


// ================= ROUTE AUTH (Register & Login) =================
Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');


// ================= ROUTE PUBLIC 

// Route Profile
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');

// Route detail-sejarah.blade.php
Route::get('/profil/sejarah/{tahun}', [ProfileController::class, 'detailSejarah'])->name('profile.sejarah.detail');

// Route detail-pimpinan.blade.php
Route::get('/profil/pimpinan/{id}', [ProfileController::class, 'detailPimpinan'])->name('profile.pimpinan.detail');


// ================= ROUTE ADMIN PANEL =================
// Jangan lupa bagian ini agar sidebar & topbar admin bisa tampil
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        // Sesuai folder: resources/views/pages/admin/dashboard.blade.php
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');
});