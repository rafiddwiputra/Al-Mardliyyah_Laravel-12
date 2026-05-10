@extends('layouts.pimpinan')

@section('content')

<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">

    {{-- Welcome Message --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">
            Dashboard Pimpinan
        </h1>

        <p class="text-gray-500 text-sm">
            Ringkasan data pendaftaran santri Pondok Pesantren Al-Mardliyyah
        </p>
    </div>

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        {{-- Total --}}
        <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
            <div>
                <p class="text-xs font-bold opacity-80 mb-2">
                    Total Pendaftar
                </p>

                <h3 class="text-3xl font-bold">
                    {{ $total }}
                </h3>
            </div>

            <i class="fas fa-users text-2xl opacity-50"></i>
        </div>

        {{-- Diproses --}}
        <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
            <div>
                <p class="text-xs font-bold opacity-80 mb-2">
                    Santri Diproses
                </p>

                <h3 class="text-3xl font-bold">
                    {{ $baru }}
                </h3>
            </div>

            <i class="fas fa-user-plus text-2xl opacity-50"></i>
        </div>

        {{-- Diterima --}}
        <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
            <div>
                <p class="text-xs font-bold opacity-80 mb-2">
                    Santri Diterima
                </p>

                <h3 class="text-3xl font-bold">
                    {{ $diterima }}
                </h3>
            </div>

            <i class="fas fa-user-check text-2xl opacity-50"></i>
        </div>

        {{-- Ditolak --}}
        <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
            <div>
                <p class="text-xs font-bold opacity-80 mb-2">
                    Santri Ditolak
                </p>

                <h3 class="text-3xl font-bold">
                    {{ $ditolak }}
                </h3>
            </div>

            <i class="fas fa-user-times text-2xl opacity-50"></i>
        </div>

    </div>

    {{-- Tabel --}}
    <div>

        <div class="flex justify-between items-center mb-5">

            <h3 class="text-lg font-bold text-[#1E5631]">
                Pendaftaran
            </h3>

            <a href="/pimpinan/laporan"
                class="text-xs font-bold px-4 py-2 border border-[#1E5631] rounded-lg text-[#1E5631] hover:bg-[#1E5631] hover:text-white transition">

                Lihat Semua

            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full border border-[#D9D9D9] border-collapse text-sm">

                <thead class="border-b border-[#D9D9D9]">

                    <tr class="bg-white">

                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            Nama Santri
                        </th>

                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            Program Pendidikan
                        </th>

                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            Tanggal Daftar
                        </th>

                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody class="text-gray-700">

                    @foreach($terbaru as $item)

                    <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition">

                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            {{ $item->nama_lengkap }}
                        </td>

                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            {{ $item->program->nama_program ?? '-' }}
                        </td>

                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            {{ $item->created_at->format('d/m/Y') }}
                        </td>

                        <td class="p-4 text-center border-r border-[#D9D9D9]">

                            @php
                                $status = ucfirst($item->status ?? 'diproses');

                                $statusColor = match($status) {
                                    'Diproses' => 'bg-[#BFDBFE] text-[#1D4ED8]',
                                    'Diterima' => 'bg-[#DEFFE9] text-[#1E5631]',
                                    'Ditolak' => 'bg-[#FECACA] text-[#B91C1C]',
                                    default => 'bg-gray-100 text-gray-600'
                                };
                            @endphp

                            <span class="inline-block w-20 text-center text-xs px-4 py-2 rounded-xl font-semibold {{ $statusColor }}">
                                {{ $status }}
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