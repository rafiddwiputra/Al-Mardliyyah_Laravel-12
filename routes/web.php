<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
// Default
=======

// ================= ROUTE AUTH (Pendaftaran & Login) =================
// Mengarahkan ke views/pages/auth/register.blade.php
Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

// Mengarahkan ke views/pages/auth/login.blade.php
Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

// Route default (halaman awal)
>>>>>>> fc134fe (Menambahkan auth pages (register n login))
Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');