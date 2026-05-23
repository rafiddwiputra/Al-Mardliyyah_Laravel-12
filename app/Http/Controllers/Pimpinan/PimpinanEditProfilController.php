<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // ✅ INI WAJIB DITAMBAHKAN UNTUK ENKRIPSI PASSWORD

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

    // ✅ INI ADALAH FUNGSI BARU UNTUK MENGGANTI PASSWORD
    public function updatePassword(Request $request)
    {
        // 1. Validasi input form
        $request->validate([
            'password_lama' => ['required', 'current_password'], // Memastikan password lama benar
            'password_baru' => ['required', 'min:8', 'confirmed'], // Memastikan password baru cocok
        ], [
            'password_lama.current_password' => 'Password saat ini yang Anda masukkan salah.',
            'password_baru.min' => 'Password baru minimal harus 8 karakter.',
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.'
        ]);

        // 2. Ambil data pimpinan yang sedang login
        $user = Auth::user();
        
        // 3. Update dan Enkripsi password baru ke database
        $user->update([
            'password' => Hash::make($request->password_baru)
        ]);

        // 4. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Password berhasil diperbarui!');
    }
}