<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Wajib untuk enkripsi password

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->latest()->get();
        
        return view('pages.pimpinan.admin.index', compact('admins'));
    }

    public function store(Request $request)
    {
        // 1. Validasi data yang diinput
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // 2. Simpan ke database
        User::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'role' => 'admin', // Pastikan role-nya admin
            'status' => 'aktif', // Default langsung aktif
            'email_verified_at' => now(), // Bypass verifikasi email
        ]);

        // 3. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Akun Admin berhasil ditambahkan!');
    }

    public function toggleStatus($id)
    {
        // Cari data admin berdasarkan ID
        $admin = User::findOrFail($id);

        // Ubah statusnya (kalau aktif jadi nonaktif, kalau nonaktif jadi aktif)
        if ($admin->status === 'aktif') {
            $admin->status = 'nonaktif';
            $pesan = 'Akun admin berhasil dinonaktifkan.';
        } else {
            $admin->status = 'aktif';
            $pesan = 'Akun admin berhasil diaktifkan kembali.';
        }

        // Simpan perubahan ke database
        $admin->save();

        // Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', $pesan);
    }
}