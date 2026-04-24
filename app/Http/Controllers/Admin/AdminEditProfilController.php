<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminEditProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('pages.admin.edit-profil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

       $request->validate([
            'nama' => 'required|string|max:30',
            'no_hp' => 'required|string|max:12',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.max' => 'Nama maksimal 30 karakter.',
            
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 12 karakter.',
            
            'photo.image' => 'File yang diunggah harus berupa gambar.',
            'photo.mimes' => 'Format foto harus berupa jpeg, png, atau jpg.',
            'photo.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        $user->nama = $request->nama;
        $user->no_hp = $request->no_hp; 

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('foto-profil', 'public');
            $user->photo = $path;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}