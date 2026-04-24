<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
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