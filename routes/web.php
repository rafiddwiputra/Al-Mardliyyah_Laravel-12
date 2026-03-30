<?php

use Illuminate\Support\Facades\Route;

// Default
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