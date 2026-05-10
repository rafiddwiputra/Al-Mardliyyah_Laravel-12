@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">

    <!-- HEADER -->
    <h1 class="text-2xl font-bold text-[#1E5631]">
        Data Pendaftar
    </h1>
    <p class="text-sm text-gray-500 mt-1 mb-6">
        Kelola data pendaftar dan status pendaftaran
    </p>

    <!-- CARD SEARCH + EXPORT -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">

    <div class="flex items-center justify-between w-full px-4">

        <!-- SUB CARD SEARCH -->
       <!-- SUB CARD SEARCH & FILTER -->
        <form method="GET" action="{{ route('admin.pendaftar') }}" class="flex-1 max-w-2xl flex flex-col sm:flex-row gap-2">
    
            <!-- DROPDOWN FILTER PERIODE -->
            <select name="periode_id" 
                onchange="this.form.submit()" 
                class="px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-[#1E5631] text-gray-600 cursor-pointer min-w-[200px]">
                <option value="">Semua Periode / Tahun</option>
                @foreach($listPeriode as $p)
                    <option value="{{ $p->id_periode }}" {{ request('periode_id') == $p->id_periode ? 'selected' : '' }}>
                        {{ $p->nama_periode }}
                    </option>
                @endforeach
            </select>

            <!-- FILTER STATUS -->
    <select name="status"
        onchange="this.form.submit()"
        class="px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-[#1E5631] text-gray-600 min-w-[170px]">

        <option value="">Semua Status</option>

        <option value="diproses"
            {{ request('status') == 'diproses' ? 'selected' : '' }}>
            Diproses
        </option>

        <option value="diterima"
            {{ request('status') == 'diterima' ? 'selected' : '' }}>
            Diterima
        </option>

        <option value="ditolak"
            {{ request('status') == 'ditolak' ? 'selected' : '' }}>
            Ditolak
        </option>

    </select>

            <!-- INPUT SEARCH -->
            <div class="relative flex-1">
                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau ID (PSB-2026-G1-001)"
                    class="w-full pl-4 pr-10 py-2 text-sm border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-[#1E5631]">

                <!-- BUTTON ICON SEARCH -->
                <button type="submit"
                    class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#1E5631]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

        </form>

        <!-- EXPORT -->
        <div class="relative group inline-block ml-auto z-50">

            <!-- BUTTON -->
            <button class="text-sm text-gray-600 border px-4 py-2 rounded-lg bg-white hover:bg-gray-50">
                Export
            </button>

            <!-- DROPDOWN WRAPPER -->
            <div class="absolute right-0 pt-2 w-44 z-50">

                <div class="bg-white border rounded-lg shadow
                            opacity-0 invisible pointer-events-none
group-hover:opacity-100 group-hover:visible group-hover:pointer-events-auto
                            transition duration-200 z-10">

                    <a href="{{ route('admin.pendaftar.exportExcel') }}"
                    class="block px-4 py-2 text-sm hover:bg-[#1E5631] hover:text-white transition">
                        Download Excel
                    </a>

                    <a href="{{ route('admin.pendaftar.exportPDF') }}"
                    class="block px-4 py-2 text-sm hover:bg-[#1E5631] hover:text-white">
                        Download PDF
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

    <!-- CARD -->
    <div>

        <h3 class="text-lg font-bold text-[#1E5631] mb-4">
            Pendaftaran Terbaru
        </h3>

        <div class="overflow-x-auto overflow-y-scroll min-h-[300px] max-h-[300px] border border-[#D9D9D9] rounded-lg">
            <table class="w-full border-collapse text-sm">

                <!-- HEADER -->
                <thead class="sticky top-0 bg-white z-10">
                    <tr class="bg-white border-b border-[#D9D9D9]">
                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            ID
                        </th>

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

                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <!-- DATA -->
                <tbody class="text-gray-700">

                    @foreach($data as $item)
                    <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition relative">

                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            <!-- PSB{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }} -->
                             {{ $item->smart_id }}
                        </td>

                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            {{ $item->nama_lengkap }}
                        </td>

                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            {{ $item->program->nama_program ?? '-' }}
                        </td>

                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            {{ $item->created_at ? $item->created_at->format('d/m/Y') : '-' }}
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

    <div x-data="{ open: false }" class="relative inline-block">

        <!-- BUTTON STATUS -->
        <button
            @click="open = !open"
            type="button"
            class="w-24 text-center text-xs px-4 py-2 rounded-xl font-semibold cursor-pointer {{ $statusColor }}">

            {{ $status }}
        </button>

        <!-- DROPDOWN -->
        <div
            x-show="open"
            @click.outside="open = false"
            x-transition
            class="absolute right-0 top-full mt-2 w-28 bg-white border rounded-lg shadow-lg z-[9999]"
            style="display: none;">

            <form action="{{ route('admin.pendaftar.updateStatus', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <button type="submit" name="status" value="diproses"
                    class="block w-full text-left px-4 py-2 text-xs hover:bg-[#1E5631] hover:text-white transition">
                    Diproses
                </button>

                <button type="submit" name="status" value="diterima"
                    class="block w-full text-left px-4 py-2 text-xs hover:bg-[#1E5631] hover:text-white transition">
                    Diterima
                </button>

                <button type="submit" name="status" value="ditolak"
                    class="block w-full text-left px-4 py-2 text-xs hover:bg-[#1E5631] hover:text-white transition">
                    Ditolak
                </button>

            </form>

        </div>

    </div>

</td>

                        <!-- AKSI -->
                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                           <a href="{{ route('admin.pendaftar.detail', $item->id) }}"
                            class="border border-[#1E5631] text-[#1E5631] px-3 py-1 rounded-md text-xs hover:bg-[#1E5631] hover:text-white transition">
                            Detail
                            </a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

            <div class="mt-4">
                {{ $data->links() }}
            </div>

        </div>

    </div>

</div>

<script src="https://unpkg.com/alpinejs" defer></script>

@endsection