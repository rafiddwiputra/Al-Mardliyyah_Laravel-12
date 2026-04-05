@extends('layouts.admin')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold text-[#1E5631] mb-1">
        Data Pendaftar
    </h2>
    <p class="text-sm text-gray-500 mb-6">
        Kelola data pendaftar dan status pendaftaran
    </p>

    <!-- CARD SEARCH + EXPORT -->
<div class="bg-white border rounded-xl shadow p-4 mb-6">

    <div class="flex items-center justify-between">

        <!-- SUB CARD SEARCH -->
        <div class="w-1/3">
            <div class="bg-gray-50 border rounded-lg px-3 py-2 flex items-center">
                <input type="text"
                    placeholder="Cari nama"
                    class="w-full text-sm bg-transparent outline-none">
            </div>
        </div>

        <!-- EXPORT -->
        <div class="relative group inline-block">

    <!-- BUTTON -->
    <button class="text-sm text-gray-600 border px-4 py-2 rounded-lg bg-white hover:bg-gray-50">
        Export
    </button>

    <!-- DROPDOWN -->
    <div class="absolute right-0 mt-2 w-44 bg-white border rounded-lg shadow 
                opacity-0 invisible group-hover:visible group-hover:opacity-100
                transition duration-200 z-10">

        <a href="#" class="block px-4 py-2 text-sm hover:bg-[#1E5631] hover:text-white transition">
            Download Excel
        </a>

        <a href="#" class="block px-4 py-2 text-sm hover:bg-[#1E5631] hover:text-white transition">
            Download PDF
        </a>

    </div>

</div>

    </div>

</div>

    <!-- CARD -->
    <div class="bg-white rounded-xl shadow border p-6">

        <h3 class="text-sm font-bold text-[#1E5631] mb-4">
            Pendaftaran Terbaru
        </h3>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <!-- HEADER -->
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="text-left py-3">ID</th>
                        <th class="text-left py-3">Nama Santri</th>
                        <th class="text-left py-3">Program Pendidikan</th>
                        <th class="text-left py-3">Tanggal Daftar</th>
                        <th class="text-left py-3">Status</th>
                        <th class="text-left py-3">Aksi</th>
                    </tr>
                </thead>

                <!-- DATA -->
                <tbody class="text-gray-700">

                    @php
                    $data = [
                        ['id'=>'PSB001','nama'=>'Ahmad Fauzi','program'=>'MTs (khusus putra)','tanggal'=>'14/3/2026','status'=>'Ditolak'],
                        ['id'=>'PSB002','nama'=>'Fatimah Zahra','program'=>'SMP (khusus putri)','tanggal'=>'14/3/2026','status'=>'Diproses'],
                        ['id'=>'PSB003','nama'=>'Muhammad Riski','program'=>'MA (putra/putri)','tanggal'=>'14/3/2026','status'=>'Diterima'],
                        ['id'=>'PSB004','nama'=>'Aisyah Nur','program'=>'MA (putri/putri)','tanggal'=>'14/3/2026','status'=>'Diproses'],
                    ];
                    @endphp

                    @foreach($data as $item)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="py-3">
                            {{ $item['id'] }}
                        </td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['program'] }}</td>
                        <td>{{ $item['tanggal'] }}</td>


                        <td class="text-left">

                            <div class="relative group inline-block">

                            <!-- BUTTON STATUS -->
                            @php
                            $statusColor = match($item['status']) {
                            'Diproses' => 'bg-[#BFDBFE] text-[#1D4ED8]',
                            'Diterima' => 'bg-[#DEFFE9] text-[#1E5631]',
                            'Ditolak' => 'bg-[#FECACA] text-[#B91C1C]',
                            };
                            @endphp

                            <button class="w-20 text-center text-xs px-4 py-2 rounded-xl font-semibold {{ $statusColor }}">
                                {{ $item['status'] }}
                            </button>

                            <!-- POPUP (HOVER) -->
                            <div class="absolute right-0 top-full w-25 bg-white border rounded-lg shadow
                                opacity-0 invisible group-hover:visible group-hover:opacity-100
                                transition duration-200 z-10">

                            <div class="px-4 py-2 text-xs hover:bg-[#1E5631] hover:text-white transition">
                                Diproses
                            </div>

                            <div class="px-4 py-2 text-xs hover:bg-[#1E5631] hover:text-white transition">
                                Diterima
                            </div>

                            <div class="px-4 py-2 text-xs hover:bg-[#1E5631] hover:text-white transition">
                                Ditolak
                            </div>

                            </div>

                            </div>

                            </td>

                        <!-- AKSI -->
                        <td>
                           <a href="/admin/data-pendaftar/detail-data"
                            class="border border-[#1E5631] text-[#1E5631] px-3 py-1 rounded-md text-xs hover:bg-[#1E5631] hover:text-white transition">
                            Detail
                            </a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://unpkg.com/alpinejs" defer></script>

@endsection