<?php

use Illuminate\Support\Facades\Route;

// Halaman Register
Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

// Halaman Login
Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

// Redirect root ke register
Route::get('/', function () {
    return redirect()->route('register');
});