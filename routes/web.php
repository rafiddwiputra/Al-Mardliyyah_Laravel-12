<?php

use Illuminate\Support\Facades\Route;

// ================= ROUTE ADMIN PANEL =================
Route::prefix('admin')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');

    // Kamu bisa menambah route lain di sini nanti, contoh:
    // Route::get('/berita', ...);
});

// Route default (halaman awal)
Route::get('/', function () {
    return view('welcome');
});