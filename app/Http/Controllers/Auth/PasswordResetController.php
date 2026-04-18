<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    // 1. Menampilkan form input email
    public function request()
    {
        return view('pages.auth.lupa-sandi');
    }

    // 2. Memproses pengiriman email link reset
    public function email(Request $request)
    {
        // Validasi email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Kirim link reset menggunakan sistem bawaan Laravel
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Cek status pengiriman (Berhasil atau Gagal)
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Kami telah mengirimkan link reset password ke email Anda!');
        }

        return back()->withErrors(['email' => 'Kami tidak dapat menemukan pengguna dengan email tersebut.']);
    }

    public function resetForm(Request $request, $token = null)
    {
        // Ingat, kita butuh $token dan $email dari URL untuk dikirim ke view
        return view('pages.auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    // 4. Memproses penyimpanan password baru
   // 4. Memproses penyimpanan password baru
    public function update(Request $request)
    {
        // Validasi input dari user
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Proses reset password bawaan Laravel
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Update password dengan Hash baru
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        // Cek status, jika berhasil arahkan ke halaman login dengan pesan sukses
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login dengan password baru Anda.');
        }

        // Jika gagal (misal token expired), kembalikan dengan pesan error
        return back()->withErrors(['email' => 'Gagal mereset password, link mungkin sudah kedaluwarsa.']);
    }
}