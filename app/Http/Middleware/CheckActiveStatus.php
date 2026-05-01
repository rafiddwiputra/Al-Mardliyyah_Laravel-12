<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sedang login DAN statusnya nonaktif
        if (Auth::check() && Auth::user()->status === 'nonaktif') {
            
            // Langsung cabut paksa sesinya
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Tendang kembali ke halaman login dengan pesan error
            return redirect()->route('login')->withErrors([
                'email' => 'Sesi Anda dihentikan paksa karena akun dinonaktifkan oleh Pimpinan.',
            ]);
        }

        // Jika aman (status aktif), biarkan lewat
        return $next($request);
    }
}