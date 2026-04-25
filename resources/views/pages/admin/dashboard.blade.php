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
                <h3 class="text-3xl font-bold">{{ $total }}</h3>
            </div>
            <i class="fas fa-users text-2xl opacity-50"></i>
        </div>
        {{-- Santri Diproses --}}
        <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
            <div>
                <p class="text-xs font-bold opacity-80 mb-2">Santri Diproses</p>
                <h3 class="text-3xl font-bold">{{ $baru }}</h3>
            </div>
            <i class="fas fa-user-plus text-2xl opacity-50"></i>
        </div>
        {{-- Santri Diterima --}}
        <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
            <div>
                <p class="text-xs font-bold opacity-80 mb-2">Santri Diterima</p>
                <h3 class="text-3xl font-bold">{{ $diterima }}</h3>
            </div>
            <i class="fas fa-user-check text-2xl opacity-50"></i>
        </div>
        {{-- Santri Ditolak --}}
        <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
            <div>
                <p class="text-xs font-bold opacity-80 mb-2">Santri Ditolak</p>
                <h3 class="text-3xl font-bold">{{ $ditolak }}</h3>
            </div>
            <i class="fas fa-user-times text-2xl opacity-50"></i>
        </div>
    </div>

    {{-- Tabel Pendaftaran Terbaru --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-[#1e4d2b]">Pendaftaran Terbaru</h3>
            <a href="{{ route('admin.pendaftar') }}"
                class="text-xs font-bold px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">
                    Lihat Semua
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border border-gray-200">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4 border border-gray-200">Nama Santri</th>
                        <th class="px-6 py-4 border border-gray-200">Program Pendidikan</th>
                        <th class="px-6 py-4 border border-gray-200">Tanggal Daftar</th>
                        <th class="px-6 py-4 border border-gray-200">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
@foreach($terbaru as $item)
<tr class="hover:bg-gray-50">
    <td class="px-6 py-4 border border-gray-200">
        {{ $item->nama_lengkap }}
    </td>

    <td class="px-6 py-4 border border-gray-200">
        {{ $item->program->nama_program ?? '-' }}
    </td>

    <td class="px-6 py-4 border border-gray-200">
        {{ $item->created_at->format('d/m/Y') }}
    </td>

    <td class="px-6 py-4 border border-gray-200">
        @php
            $status = $item->status ?? 'diproses';

            $color = match($status) {
                'diterima' => 'bg-green-100 text-green-600',
                'ditolak' => 'bg-red-100 text-red-600',
                default => 'bg-blue-100 text-blue-600'
            };
        @endphp

        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $color }}">
            {{ ucfirst($status) }}
        </span>
    </td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection