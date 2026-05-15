@extends('layouts.pimpinan')

@section('content')

<div class="p-6">

    <!-- TITLE -->
    <h2 class="text-2xl font-bold text-[#1E5631] mb-1">
        Laporan Pendaftaran Santri
    </h2>

    <p class="text-sm text-gray-500 mb-6">
        Rekapitulasi data pendaftaran berdasarkan kategori
    </p>

    <!-- FILTER CARD -->
    <div class="bg-white border rounded-lg p-5 mb-6 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        
        <div class="w-full md:w-auto">
            <p class="text-sm font-semibold text-[#1E5631] mb-4">
                Pilih Periode Laporan
            </p>
            <form method="GET" action="{{ route('pimpinan.laporan') }}">
                <div class="w-full md:w-72">
                    <label class="text-xs text-gray-500 mb-1 block">
                        Tahun Ajaran / Gelombang
                    </label>
                    <select name="periode_id" onchange="this.form.submit()" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-[#1E5631] cursor-pointer">
                        <option value="">Semua Periode / Tahun</option>
                        @foreach($listPeriode as $p)
                            <option value="{{ $p->id_periode }}" {{ request('periode_id', $periodeAktif->id_periode ?? '') == $p->id_periode ? 'selected' : '' }}>
                                {{ $p->nama_periode }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

    </div>

    <!-- LAPORAN -->
    <div id="laporanSection" class="space-y-6">

        <!-- TITLE -->
        <div class="text-center">
            <h3 class="text-lg font-bold text-[#1E5631]">
                Laporan Pendaftaran Santri
            </h3>
            <p class="text-xs text-gray-500">
                {{ $periodeAktif ? $periodeAktif->nama_periode : 'Semua Periode' }}
            </p>
        </div>

        <!-- RINGKASAN DINAMIS -->
        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm font-semibold text-[#1E5631] mb-4">
                Ringkasan Keseluruhan
            </p>

            <div class="grid grid-cols-4 gap-4 text-white text-sm">
                <div class="bg-[#1E5631] p-4 rounded-lg">
                    <p class="text-xs">Total Pendaftar</p>
                    <p class="text-xl font-bold">{{ $ringkasan['total'] }}</p>
                </div>
                <div class="bg-[#1E5631] p-4 rounded-lg">
                    <p class="text-xs">Pendaftar Baru (Diproses)</p>
                    <p class="text-xl font-bold">{{ $ringkasan['baru'] }}</p>
                </div>
                <div class="bg-[#1E5631] p-4 rounded-lg">
                    <p class="text-xs">Santri Diterima</p>
                    <p class="text-xl font-bold">{{ $ringkasan['diterima'] }}</p>
                </div>
                <div class="bg-[#1E5631] p-4 rounded-lg">
                    <p class="text-xs">Santri Ditolak</p>
                    <p class="text-xl font-bold">{{ $ringkasan['ditolak'] }}</p>
                </div>
            </div>
        </div>

        <!-- REKAP DINAMIS -->
        <div class="bg-white border rounded-lg p-5">
            <p class="text-sm font-semibold text-[#1E5631] mb-4">
                Rekapitulasi per Program Pendidikan
            </p>

            <table class="w-full text-sm">
                <thead class="border-b">
                    <tr class="text-left text-gray-600">
                        <th class="pb-2">Program Pendidikan</th>
                        <th class="pb-2 text-center">Total Pendaftar</th>
                        <th class="pb-2 text-center">Diterima</th>
                        <th class="pb-2 text-center">Ditolak</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php 
                        $grandTotal = 0; $grandDiterima = 0; $grandDitolak = 0;
                    @endphp
                    
                    @foreach($rekapProgram as $program)
                        @php
                            $grandTotal += $program->total;
                            $grandDiterima += $program->diterima;
                            $grandDitolak += $program->ditolak;
                        @endphp
                        <tr class="border-b">
                            <td class="py-2">{{ $program->nama_program }}</td>
                            <td class="text-center">{{ $program->total }}</td>
                            <td class="text-center text-green-600">{{ $program->diterima }}</td>
                            <td class="text-center text-red-500">{{ $program->ditolak }}</td>
                        </tr>
                    @endforeach

                    <!-- TOTAL KESELURUHAN BAWAH -->
                    <tr class="font-semibold bg-gray-50">
                        <td class="py-3 px-2">Total Keseluruhan</td>
                        <td class="text-center">{{ $grandTotal }}</td>
                        <td class="text-center text-green-600">{{ $grandDiterima }}</td>
                        <td class="text-center text-red-500">{{ $grandDitolak }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

       <!-- FILTER DATA PENDAFTAR -->
<div id="dataPendaftar" class="bg-white border rounded-lg p-5">

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">

        <!-- FORM FILTER -->
        <form method="GET"
              action="{{ route('pimpinan.laporan') }}#dataPendaftar"
              class="flex-1 w-full flex flex-wrap gap-3">

            {{-- PERTAHANKAN PERIODE --}}
            <input type="hidden"
                   name="periode_id"
                   value="{{ request('periode_id', $periodeAktif->id_periode ?? '') }}">

            <!-- FILTER PROGRAM -->
            <select name="program_id"
                onchange="this.form.submit()"
                class="w-full sm:w-[220px] px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-[#1E5631] text-gray-600">

                <option value="">Semua Program / Jenjang</option>

                @foreach($listProgram as $prog)
                    <option value="{{ $prog->id }}"
                        {{ request('program_id') == $prog->id ? 'selected' : '' }}>
                        {{ $prog->nama_program }}
                    </option>
                @endforeach

            </select>

            <!-- FILTER STATUS -->
            <select name="status"
                onchange="this.form.submit()"
                class="w-full sm:w-[180px] px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-[#1E5631] text-gray-600">

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

            <!-- SEARCH -->
            <div class="relative flex-1 min-w-[250px]">

                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau ID santri"
                    class="w-full pl-4 pr-10 py-2 text-sm border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-[#1E5631]">

                <!-- ICON SEARCH -->
                <button type="submit"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#1E5631]">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>

                </button>

            </div>

        </form>

        <!-- EXPORT DROPDOWN -->
        <div class="relative group inline-block ml-auto z-50">

            <!-- BUTTON -->
            <button
                class="text-sm font-semibold text-white bg-[#1E5631] border border-[#1E5631] px-4 py-2 rounded-lg hover:bg-[#C3A771] hover:border-[#C3A771] transition duration-200 shadow-sm">
                Export
            </button>

            <!-- DROPDOWN -->
            <div class="absolute right-0 pt-2 w-44 z-50">

                <div class="bg-white border rounded-lg shadow
                    opacity-0 invisible pointer-events-none
                    group-hover:opacity-100 group-hover:visible group-hover:pointer-events-auto
                    transition duration-200 z-10">

                    <a href="{{ route('pimpinan.laporan.exportExcel', request()->all()) }}"
                        class="block px-4 py-2 text-sm hover:bg-[#1E5631] hover:text-white transition">
                        Download Excel
                    </a>

                    <a href="{{ route('pimpinan.laporan.exportPDF', request()->all()) }}"
                        class="block px-4 py-2 text-sm hover:bg-[#1E5631] hover:text-white">
                        Download PDF
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

        <!-- PENDAFTAR TERBARU DINAMIS -->
        <div class="bg-white border rounded-lg p-5">
            <div class="flex justify-between mb-4">
                <p class="text-sm font-semibold text-[#1E5631]">
                    Semua Data Pendaftar
                </p>
            </div>

            <div class="overflow-x-auto overflow-y-auto min-h-[300px] max-h-[300px] border border-[#D9D9D9] rounded-lg">
    
    <table class="w-full border-collapse text-sm">

        <!-- HEADER -->
        <thead class="sticky top-0 bg-white z-10">
            <tr class="bg-white border-b border-[#D9D9D9] text-black">

                <th class="p-4 text-center font-bold border-r border-[#D9D9D9]">
                    ID
                </th>

                <th class="p-4 text-center font-bold border-r border-[#D9D9D9]">
                    Nama Santri
                </th>

                <th class="p-4 text-center font-bold border-r border-[#D9D9D9]">
                    Program Pendidikan
                </th>

                <th class="p-4 text-center font-bold border-r border-[#D9D9D9]">
                    Tanggal Daftar
                </th>

                <th class="p-4 text-center font-bold">
                    Status
                </th>

            </tr>
        </thead>

        <!-- BODY -->
        <tbody class="text-gray-700">

            @forelse($pendaftarTerbaru as $santri)

                @php
                    $statusColor = match(strtolower($santri->status)) {
                        'diproses' => 'bg-[#BFDBFE] text-[#1D4ED8]',
                        'diterima' => 'bg-[#DEFFE9] text-[#1E5631]',
                        'ditolak' => 'bg-[#FECACA] text-[#B91C1C]',
                        default => 'bg-gray-100 text-gray-600'
                    };
                @endphp

                <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition">

                    <td class="p-4 text-center border-r border-[#D9D9D9]">
                        {{ $santri->smart_id }}
                    </td>

                    <td class="p-4 text-center border-r border-[#D9D9D9]">
                        {{ $santri->nama_lengkap }}
                    </td>

                    <td class="p-4 text-center border-r border-[#D9D9D9]">
                        {{ $santri->program->nama_program ?? '-' }}
                    </td>

                    <td class="p-4 text-center border-r border-[#D9D9D9]">
                        {{ $santri->created_at->format('d/m/Y') }}
                    </td>

                    <td class="p-4 text-center">
                        <span class="inline-block min-w-[90px] text-center {{ $statusColor }} px-3 py-1 rounded-lg text-xs font-semibold">
                            {{ ucfirst($santri->status) }}
                        </span>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">
                        Belum ada pendaftar di periode ini.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>
        </div>

        <!-- FOOTER DINAMIS -->
        <div class="bg-white border rounded-lg p-5 text-center mb-10">
            <p class="text-sm text-gray-700">
                Laporan Resmi Pendaftaran Santri
            </p>
            <p class="text-xs text-[#1E5631] mt-1 font-bold">
                Pondok Pesantren Al-Mardliyyah
            </p>
        </div>

    </div>
</div>

@endsection