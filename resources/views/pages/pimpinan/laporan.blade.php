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

        <div class="flex gap-2 w-full md:w-auto mt-4 md:mt-0">
            <a href="{{ route('pimpinan.laporan.exportExcel', ['periode_id' => request('periode_id', $periodeAktif->id_periode ?? '')]) }}"
               class="flex-1 md:flex-none text-center bg-[#1E5631] text-white px-5 py-2 rounded-md text-sm font-semibold hover:bg-[#17472a] transition shadow-sm">
                Download Excel
            </a>
            
            <a href="{{ route('pimpinan.laporan.exportPDF', ['periode_id' => request('periode_id', $periodeAktif->id_periode ?? '')]) }}"
               class="flex-1 md:flex-none text-center border border-[#1E5631] text-[#1E5631] px-5 py-2 rounded-md text-sm font-semibold hover:bg-gray-50 transition shadow-sm">
                Download PDF
            </a>
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

        <!-- PENDAFTAR TERBARU DINAMIS -->
        <div class="bg-white border rounded-lg p-5">
            <div class="flex justify-between mb-4">
                <p class="text-sm font-semibold text-[#1E5631]">
                    5 Pendaftaran Terbaru
                </p>
            </div>

            <table class="w-full text-sm">
                <thead class="border-b text-gray-600">
                    <tr>
                        <th class="pb-2 text-left">Nama Santri</th>
                        <th class="pb-2">Program Pendidikan</th>
                        <th class="pb-2">Tanggal Daftar</th>
                        <th class="pb-2">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($pendaftarTerbaru as $santri)
                        <tr class="border-b">
                            <td class="py-2">{{ $santri->nama_lengkap }}</td>
                            <td class="text-center">{{ $santri->program->nama_program ?? '-' }}</td>
                            <td class="text-center">{{ $santri->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                @php
                                    $statusColor = match(strtolower($santri->status)) {
                                        'diproses' => 'bg-[#BFDBFE] text-[#1D4ED8]',
                                        'diterima' => 'bg-[#DEFFE9] text-[#1E5631]',
                                        'ditolak' => 'bg-[#FECACA] text-[#B91C1C]',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp
                                <span class="inline-block min-w-[90px] text-center {{ $statusColor }} px-2 py-1 rounded text-xs">
                                    {{ ucfirst($santri->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada pendaftar di periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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