@extends('layouts.app')

@section('title', 'Admin Dashboard - Al-Mardliyyah')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    
    {{-- ================= SIDEBAR ================= --}}
    <aside class="w-64 bg-[#1e4d2b] text-white flex-shrink-0 hidden md:flex flex-col">
        <div class="p-6">
            <h1 class="text-xl font-bold border-b border-white/20 pb-4">Admin Panel</h1>
        </div>
        
        <nav class="flex-1 px-4 space-y-2 overflow-y-auto">
            {{-- Dashboard Aktif --}}
            <a href="#" class="flex items-center gap-3 bg-[#c9a76d] text-white px-4 py-3 rounded-lg font-bold shadow-md">
                <i class="fas fa-th-large w-5"></i>
                <span>Dashboard</span>
            </a>

            {{-- Manajemen Konten --}}
            <div class="pt-4 pb-2">
                <p class="text-xs uppercase text-gray-400 font-bold px-4 mb-2">Manajemen Konten</p>
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-2.5 rounded-lg transition text-sm">Berita</a>
                    <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-2.5 rounded-lg transition text-sm">Galeri</a>
                    <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-2.5 rounded-lg transition text-sm">Profil Pondok</a>
                    <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-2.5 rounded-lg transition text-sm">Program Pendidikan</a>
                    <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-2.5 rounded-lg transition text-sm text-gray-300">Biaya Pendidikan</a>
                    <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-2.5 rounded-lg transition text-sm text-gray-300">Persyaratan Pendaftaran</a>
                    <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-2.5 rounded-lg transition text-sm text-gray-300">Jadwal Pendaftaran</a>
                </div>
            </div>

            {{-- Pendaftaran Santri --}}
            <div class="pt-2">
                <p class="text-xs uppercase text-gray-400 font-bold px-4 mb-2">Pendaftaran Santri</p>
                <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-2.5 rounded-lg transition text-sm">Data Pendaftar</a>
            </div>

            {{-- Pengaturan Website --}}
            <div class="pt-4">
                <p class="text-xs uppercase text-gray-400 font-bold px-4 mb-2">Pengaturan Website</p>
                <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-2.5 rounded-lg transition text-sm text-gray-300">Banner Beranda</a>
                <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-2.5 rounded-lg transition text-sm text-gray-300">Kontak</a>
            </div>
        </nav>
    </aside>

    {{-- ================= MAIN CONTENT ================= --}}
    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        {{-- Navbar Atas --}}
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center sticky top-0 z-20">
            <div class="flex items-center gap-4">
                <button class="md:hidden text-gray-600"><i class="fas fa-bars"></i></button>
                <h2 class="text-[#1e4d2b] font-bold text-lg">Pondok Pesantren Al-Mardliyyah</h2>
            </div>
            <div class="flex items-center gap-3 bg-gray-100 px-4 py-1.5 rounded-full">
                <span class="text-sm font-bold text-gray-700">Admin User</span>
                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-gray-500"></i>
                </div>
            </div>
        </header>

        <div class="p-8">
            {{-- Welcome Message --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                <p class="text-gray-500 text-sm">Selamat datang di Admin Panel Pondok Pesantren Al-Mardliyyah</p>
            </div>

            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                {{-- Total Pendaftar --}}
                <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold opacity-80 mb-2">Total Pendaftar</p>
                        <h3 class="text-3xl font-bold">100</h3>
                    </div>
                    <i class="fas fa-users text-2xl opacity-50"></i>
                </div>
                {{-- Pendaftar Baru --}}
                <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold opacity-80 mb-2">Pendaftar Baru</p>
                        <h3 class="text-3xl font-bold">24</h3>
                    </div>
                    <i class="fas fa-user-plus text-2xl opacity-50"></i>
                </div>
                {{-- Santri Diterima --}}
                <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold opacity-80 mb-2">Santri Diterima</p>
                        <h3 class="text-3xl font-bold">24</h3>
                    </div>
                    <i class="fas fa-user-check text-2xl opacity-50"></i>
                </div>
                {{-- Santri Ditolak --}}
                <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold opacity-80 mb-2">Santri Ditolak</p>
                        <h3 class="text-3xl font-bold">24</h3>
                    </div>
                    <i class="fas fa-user-times text-2xl opacity-50"></i>
                </div>
            </div>

            {{-- Tabel Pendaftaran Terbaru --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-[#1e4d2b]">Pendaftaran Terbaru</h3>
                    <button class="text-xs font-bold px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">Lihat Semua</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                            <tr>
                                <th class="px-6 py-4">Nama Santri</th>
                                <th class="px-6 py-4">Program Pendidikan</th>
                                <th class="px-6 py-4">Tanggal Daftar</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            {{-- Baris 1 --}}
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-800">Ahmad Fauzi</td>
                                <td class="px-6 py-4 text-gray-600">Madrasah Aliyah</td>
                                <td class="px-6 py-4 text-gray-600">14/3/2026</td>
                                <td class="px-6 py-4"><span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-bold uppercase">Ditolak</span></td>
                            </tr>
                            {{-- Baris 2 --}}
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-800">Fatimah Zahra</td>
                                <td class="px-6 py-4 text-gray-600">Madrasah Aliyah</td>
                                <td class="px-6 py-4 text-gray-600">14/3/2026</td>
                                <td class="px-6 py-4"><span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-bold uppercase">Diproses</span></td>
                            </tr>
                            {{-- Baris 3 --}}
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-800">Muhammad Riski</td>
                                <td class="px-6 py-4 text-gray-600">Madrasah Tsanawiyah</td>
                                <td class="px-6 py-4 text-gray-600">14/3/2026</td>
                                <td class="px-6 py-4"><span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-bold uppercase">Diterima</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection