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
    <div class="bg-white border rounded-lg p-5 mb-6">

        <p class="text-sm font-semibold text-[#1E5631] mb-4">
            Pilih Periode Laporan
        </p>

        <div class="flex items-center justify-between flex-wrap gap-4">

            <!-- DROPDOWN -->
            <div class="w-64">
                <label class="text-xs text-gray-500 mb-1 block">
                    Tahun Ajaran
                </label>

                <div class="relative" id="tahunWrapper">

                    <input type="hidden" id="tahunValue" value="2025/2026">

                    <button type="button" onclick="toggleTahun()"
                        class="w-full border rounded-md px-3 py-2 text-sm text-left flex justify-between items-center">

                        <span id="tahunText">2025/2026</span>

                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>

                    </button>

                    <div id="tahunMenu"
                        class="hidden absolute w-full bg-white border rounded-md mt-1 shadow z-50">

                        <div onclick="pilihTahun('2025/2026')" class="px-3 py-2 text-sm hover:bg-[#1E5631] hover:text-white cursor-pointer">2025/2026</div>
                        <div onclick="pilihTahun('2024/2025')" class="px-3 py-2 text-sm hover:bg-[#1E5631] hover:text-white cursor-pointer">2024/2025</div>
                        <div onclick="pilihTahun('2023/2024')" class="px-3 py-2 text-sm hover:bg-[#1E5631] hover:text-white cursor-pointer">2023/2024</div>

                    </div>

                </div>
            </div>

            <button onclick="tampilkanLaporan()"
                class="bg-[#1E5631] text-white px-6 py-2 rounded-md text-sm hover:bg-[#174427]">
                Tampilkan Laporan
            </button>

        </div>

    </div>

    <!-- LAPORAN -->
    <div id="laporanSection" class="hidden space-y-6">

        <!-- TITLE -->
        <div class="text-center">
            <h3 class="text-lg font-bold text-[#1E5631]">
                Laporan Pendaftaran Santri
            </h3>
            <p class="text-xs text-gray-500">
                Tahun Ajaran 2025/2026
            </p>
        </div>

        <!-- RINGKASAN -->
        <div class="bg-white border rounded-lg p-5">

            <p class="text-sm font-semibold text-[#1E5631] mb-4">
                Ringkasan Keseluruhan
            </p>

            <div class="grid grid-cols-4 gap-4 text-white text-sm">

                <div class="bg-[#1E5631] p-4 rounded-lg">
                    <p class="text-xs">Total Pendaftar</p>
                    <p class="text-xl font-bold">100</p>
                </div>

                <div class="bg-[#1E5631] p-4 rounded-lg">
                    <p class="text-xs">Pendaftar Baru</p>
                    <p class="text-xl font-bold">24</p>
                </div>

                <div class="bg-[#1E5631] p-4 rounded-lg">
                    <p class="text-xs">Santri Diterima</p>
                    <p class="text-xl font-bold">24</p>
                </div>

                <div class="bg-[#1E5631] p-4 rounded-lg">
                    <p class="text-xs">Santri Ditolak</p>
                    <p class="text-xl font-bold">24</p>
                </div>

            </div>

        </div>

        <!-- REKAP -->
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

                    <tr class="border-b">
                        <td class="py-2">MTs Al Mujaddadiyyah</td>
                        <td class="text-center">3</td>
                        <td class="text-center text-green-600">3</td>
                        <td class="text-center text-red-500">1</td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-2">MA Al Mujaddadiyyah</td>
                        <td class="text-center">2</td>
                        <td class="text-center text-green-600">3</td>
                        <td class="text-center text-red-500">1</td>
                    </tr>

                    <tr class="font-semibold">
                        <td class="pt-3">Total</td>
                        <td class="text-center">12</td>
                        <td class="text-center text-green-600">3</td>
                        <td class="text-center text-red-500">1</td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!-- PENDAFTAR TERBARU -->
        <div class="bg-white border rounded-lg p-5">

            <div class="flex justify-between mb-4">
                <p class="text-sm font-semibold text-[#1E5631]">
                    Pendaftaran Terbaru
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

                    <tr class="border-b">
                        <td class="py-2">Ahmad Fauzi</td>
                        <td class="text-center">Madrasah Aliyah</td>
                        <td class="text-center">14/3/2026</td>
                        <td class="text-center">
                            <span class="inline-block min-w-[90px] text-center bg-[#FECACA] text-[#B91C1C] px-2 py-1 rounded text-xs">
                            Ditolak
                            </span>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-2">Fatimah Zahra</td>
                        <td class="text-center">Madrasah Aliyah</td>
                        <td class="text-center">14/3/2026</td>
                        <td class="text-center">
                            <span class="inline-block min-w-[90px] text-center bg-[#BFDBFE] text-[#1D4ED8] px-2 py-1 rounded text-xs">
                            Diproses
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="py-2">Muhammad Riski</td>
                        <td class="text-center">Madrasah Tsanawiyah</td>
                        <td class="text-center">14/3/2026</td>
                        <td class="text-center">
                            <span class="inline-block min-w-[90px] text-center bg-[#DEFFE9] text-[#1E5631] px-2 py-1 rounded text-xs">
                            Diterima
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!-- FOOTER -->
        <div class="bg-white border rounded-lg p-5 text-center">

            <p class="text-sm text-gray-700">
                Laporan Resmi Pendaftaran Santri
            </p>

            <p class="text-xs text-[#1E5631] mt-1">
                Pondok Pesantren Al-Mardliyyah
            </p>

            <p class="text-xs text-gray-400 mt-1">
                Dicetak: 25/3/2026
            </p>

        </div>

    </div>

</div>

<!-- SCRIPT -->
<script>
function toggleTahun() {
    document.getElementById('tahunMenu').classList.toggle('hidden');
}

function pilihTahun(value) {
    document.getElementById('tahunText').innerText = value;
    document.getElementById('tahunValue').value = value;
    document.getElementById('tahunMenu').classList.add('hidden');
}

document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('tahunWrapper');
    if (!wrapper.contains(e.target)) {
        document.getElementById('tahunMenu').classList.add('hidden');
    }
});

function tampilkanLaporan() {
    document.getElementById('laporanSection').classList.remove('hidden');
}
</script>

@endsection