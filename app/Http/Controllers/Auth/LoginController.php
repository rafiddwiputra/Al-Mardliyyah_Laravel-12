<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Public\PeriodePendaftaran;
use Carbon\Carbon;

class LoginController extends Controller
{ 
    /**
     * TAMPILKAN HALAMAN LOGIN
     */
    public function showLoginForm()
    {
        // 1. Cek periode aktif di database
        $periodeAktif = PeriodePendaftaran::where('status', 1)->orderBy('tanggal_mulai', 'asc')->first();
        
        $statusPendaftaran = false;

        // 2. Cek apakah tanggal hari ini masuk dalam rentang buka pendaftaran
        if ($periodeAktif && $periodeAktif->tanggal_mulai && $periodeAktif->tanggal_selesai) {
            $hariIni = Carbon::now();
            $mulai = Carbon::parse($periodeAktif->tanggal_mulai)->startOfDay();
            $selesai = Carbon::parse($periodeAktif->tanggal_selesai)->endOfDay();
            
            if ($hariIni->between($mulai, $selesai)) {
                $statusPendaftaran = true; // Pendaftaran BUKA
            }
        }

        // 3. Kirim status aslinya ke view login
        return view('pages.auth.login-global', [
            'status' => $statusPendaftaran
        ]);
    }

    /**
     * PROSES OTENTIKASI (SATPAM UTAMA)
     */
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

    /**
     * KELUAR SISTEM
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}