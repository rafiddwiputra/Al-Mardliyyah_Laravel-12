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
        if (Auth::check() && Auth::user()->status_user === 'nonaktif') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'Sesi Anda dihentikan paksa karena akun dinonaktifkan oleh Pimpinan.',
            ]);
        }

        return $next($request);
    }
}