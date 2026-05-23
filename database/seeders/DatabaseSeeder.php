<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Ini wajib dipanggil untuk enkripsi password

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Pimpinan (Super Admin)
        User::create([
            'nama' => 'Pimpinan Pondok',
            'email' => 'ppalmardliyyah.office@gmail.com',
            'password' => Hash::make('admin123'), // Silakan ganti passwordnya nanti
            'no_hp' => '081234567890',
            'role' => 'pimpinan', 
            'status_user' => 'aktif',
            'email_verified_at' => now(), // Agar tidak kena cegat verifikasi email
        ]);
        
        // Opsional: Kamu juga bisa sekalian membuatkan satu akun Admin awal di sini
        User::create([
            'nama' => 'Admin Utama',
            'email' => 'ppdbalmardliyyah@gmail.com',
            'password' => Hash::make('admin123'), 
            'no_hp' => '089876543210',
            'role' => 'admin', 
            'status_user' => 'aktif',
            'email_verified_at' => now(), 
        ]);
    }
}