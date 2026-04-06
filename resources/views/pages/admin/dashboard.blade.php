@extends('layouts.admin')

@section('title', 'Admin Dashboard - Al-Mardliyyah')

@section('content')
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
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-800">Ahmad Fauzi</td>
                        <td class="px-6 py-4 text-gray-600">Madrasah Aliyah</td>
                        <td class="px-6 py-4 text-gray-600">14/3/2026</td>
                        <td class="px-6 py-4"><span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-bold uppercase">Ditolak</span></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-800">Fatimah Zahra</td>
                        <td class="px-6 py-4 text-gray-600">Madrasah Aliyah</td>
                        <td class="px-6 py-4 text-gray-600">14/3/2026</td>
                        <td class="px-6 py-4"><span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-bold uppercase">Diproses</span></td>
                    </tr>
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
@endsection