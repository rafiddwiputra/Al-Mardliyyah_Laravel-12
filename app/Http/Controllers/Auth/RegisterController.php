<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use App\Models\Public\PeriodePendaftaran;

class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        $periodeAktif = PeriodePendaftaran::where('status', 1)->orderBy('tanggal_mulai', 'asc')->first();
        
        $statusPendaftaran = false;

        if ($periodeAktif && $periodeAktif->tanggal_mulai && $periodeAktif->tanggal_selesai) {
            $hariIni = Carbon::now();
            $mulai = Carbon::parse($periodeAktif->tanggal_mulai)->startOfDay();
            $selesai = Carbon::parse($periodeAktif->tanggal_selesai)->endOfDay();
            
            if ($hariIni->between($mulai, $selesai)) {
                $statusPendaftaran = true; 
            }
        }

        if (!$statusPendaftaran) {
            return redirect()->route('login')->with('error', 'Mohon maaf, pendaftaran saat ini sedang tidak dibuka.');
        }

        return view('pages.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:30',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'required|string|max:12',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'role' => 'calon_santri', 
        ]);

        event(new Registered($user));
        

        Auth::login($user);
        return redirect()->route('verification.notice');
    }
}