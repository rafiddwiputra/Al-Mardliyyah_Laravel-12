<?php

use Illuminate\Support\Facades\Route;

// ================= ROUTE AUTH =================
Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

// ================= DEFAULT =================
Route::get('/', function () {
    return view('welcome');
});