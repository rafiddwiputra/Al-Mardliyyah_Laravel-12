<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{ 

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // 1. SATPAM UTAMA: Cek status blokir sebelum masuk ke mana pun
            if ($user->status === 'nonaktif') {
                Auth::logout(); // Langsung keluarkan
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return back()->withErrors([
                    'email' => 'Akun Anda telah dinonaktifkan oleh Pimpinan. Silakan hubungi pihak pondok.',
                ])->onlyInput('email');
            }

            // 2. Jalur khusus Pimpinan
            if ($user->role === 'pimpinan') {
                return redirect()->route('pimpinan.laporan')
                                 ->with('success', 'Selamat Datang di Panel Pimpinan.');
            }

            // 3. Jalur khusus Admin (sudah bersih dari sisa kode lama)
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                                 ->with('success', 'Selamat Datang di Panel Admin.');
            }
            
            // 4. Jalur khusus Calon Santri
            if ($user->role === 'calon_santri') {
                return redirect()->route('formulir')
                                 ->with('success', 'Silakan lengkapi pendaftaran Anda.');
            }
            
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
} 