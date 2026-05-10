<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PimpinanEditProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('pages.pimpinan.edit-profil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama' => 'required|string|max:30',
            'no_hp' => 'required|string|max:12',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->nama = $request->nama;
        $user->no_hp = $request->no_hp;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto-profil', 'public');
            $user->foto = $path;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}