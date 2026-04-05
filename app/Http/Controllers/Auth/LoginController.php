<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{ // <--- KURUNG KURAWAL BUKA INI WAJIB ADA

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 1. Ambil data user yang sedang login
            $user = Auth::user();

            // 2. CEK ROLE USER
            // Jika Admin atau Pimpinan, masuk ke Dashboard Admin
            if ($user->role === 'admin' || $user->role === 'pimpinan') {
                return redirect()->route('admin.dashboard')
                                 ->with('success', 'Selamat Datang di Panel Admin.');
            }

            // Jika Calon Santri, masuk ke halaman Formulir
            if ($user->role === 'calon_santri') {
                return redirect()->route('formulir')
                                 ->with('success', 'Silakan lengkapi pendaftaran Anda.');
            }

            // Default jika role tidak dikenal
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Jangan lupa tambahkan fungsi Logout juga ya di sini
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
} 