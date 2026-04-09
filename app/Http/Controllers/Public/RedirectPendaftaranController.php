<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class RedirectPendaftaranController extends Controller
{
    public function index()
    {
        // 1. Kalau belum login
        if (!auth()->check()) {
            return redirect()->route('register');
        }

        $user = auth()->user();

        // 2. Kalau belum verifikasi email
        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        // 3. Kalau belum isi formulir
        if (!$user->pendaftaran) {
            return redirect()->route('formulir');
        }

        // 4. Kalau sudah isi formulir
        return redirect('/status-pendaftaran/belum');
    }
}