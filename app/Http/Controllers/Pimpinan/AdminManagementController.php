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
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => 'admin', 
            'status_user' => 'aktif', 
            'email_verified_at' => now(), 
        ]);

        return redirect()->back()->with('success', 'Akun Admin berhasil ditambahkan!');
    }

    public function toggleStatus(Request $request, $id)
{
    $admin = User::findOrFail($id); 

    $targetStatus = $request->input('target_status');

    if ($targetStatus === 'aktif') {
        $admin->status_user = 'aktif';
    } else {
        $admin->status_user = 'nonaktif';
    }

    $admin->save();

    return redirect()->back()->with('success', 'Status admin berhasil diperbarui!');
}
}