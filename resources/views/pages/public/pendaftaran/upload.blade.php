@extends('layouts.app')

@section('content')

<!-- STEP PROGRESS -->
<div class="max-w-4xl mx-auto pt-10 mb-12">

    @php
    $labels = ['Buat Akun', 'Login', 'Isi Formulir', 'Upload Dokumen', 'Status Pendaftaran'];
    @endphp

    <div class="flex items-center justify-between relative">

        <!-- GARIS FULL -->
        <div class="absolute top-5 left-0 w-full h-1 bg-gray-200"></div>

        <!-- GARIS AKTIF -->
        <div class="absolute top-5 left-0 h-1 bg-[#1E5631]" style="width: 75%"></div>

        @foreach([1,2,3,4,5] as $step)
        <div class="flex flex-col items-center relative z-10">

            <!-- BULATAN -->
            <div class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-semibold
                {{ $step <= 4 ? 'bg-[#1E5631] text-white' : 'bg-gray-200 text-gray-400' }}">
                {{ $step }}
            </div>

            <!-- LABEL -->
            <p class="mt-2 text-xs
                {{ $step <= 4 ? 'text-[#1E5631] font-medium' : 'text-gray-400' }}">
                {{ $labels[$step-1] }}
            </p>

        </div>
        @endforeach

    </div>

</div>

<!-- TITLE -->
<div class="text-center mb-6">
    <h2 class="text-2xl font-bold text-[#1E5631]">
        Upload Dokumen Persyaratan
    </h2>
    <p class="text-sm text-gray-500">
        Langkah 4 : Lengkapi dokumen yang diperlukan untuk proses verifikasi
    </p>
</div>

<!-- CONTENT -->
<div class="max-w-3xl mx-auto pb-12">

    <!-- PROGRESS BAR -->
    <div class="bg-white border rounded-xl p-5 mb-6 shadow-sm">
        <p class="text-sm font-semibold text-[#1E5631] mb-3">Progress Upload</p>
        <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
            <div class="bg-[#1E5631] h-2 rounded-full w-0"></div>
        </div>
    </div>

    <form class="space-y-5">

        @php
        $dokumen = [
    [
        'judul' => 'Upload foto santri formal 3x4(background warna merah)',
        'format' => 'Upload pas foto ukuran 3x4 (Format: PDF, Max 1 MB)'
    ],
    [
        'judul' => 'Upload Akta Kelahiran',
        'format' => 'Upload fotokopi Akta Kelahiran (Format: PDF Max 1 MB)'
    ],
    [
        'judul' => 'Upload Kartu Keluarga',
        'format' => 'Upload fotokopi Kartu Keluarga (Format: PDF, Max 1 MB)'
    ],
    [
        'judul' => 'Upload KTP Ayah',
        'format' => 'Upload KTP Ayah (Format: PDF, Max 1 MB)'
    ],
    [
        'judul' => 'Upload KTP Ibu',
        'format' => 'Upload KTP Ibu (Format: PDF, Max 1 MB)'
    ],
    [
        'judul' => 'Upload sertifikat/piagam penghargaan
                    (jika pernah mengikuti lomba)',
        'format' => 'Upload fotokopi sertivikat/piagam penghargaan (Format: PDF, Max 1 MB)'
    ],
];
        @endphp

        @foreach($dokumen as $item)
        <div class="bg-white border rounded-xl p-6 shadow-sm">

            <!-- TITLE -->
            <div class="flex items-start gap-3 mb-4">
                <div class="w-5 h-5 bg-[#1E5631] rounded-md mt-1"></div>

                <div>
                    <p class="text-sm font-semibold text-[#1E5631]">
                        {{ $item['judul'] }}
                    </p>
                    <p class="text-xs text-gray-400">
                        {{ $item['format'] }}
                    </p>
                </div>
            </div>

            <!-- INPUT FILE -->
            <label class="w-full border border-gray-200 rounded-lg p-6 flex flex-col items-center justify-center text-gray-400 cursor-pointer hover:border-[#2F855A] transition bg-gray-50">

                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-7 h-7 mb-2 text-gray-400" 
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M12 12v-8m0 0l-3 3m3-3l3 3" />
                </svg>

                <p class="text-sm text-gray-400">
                    Klik untuk upload atau drag and drop
                </p>

                <input type="file" class="hidden">

            </label>

        </div>
        @endforeach

        <!-- BUTTON -->
        <div class="text-center pt-4">
            <a href="/status-pendaftaran"
                class="bg-[#C6A75E] text-[#FFFFFF] px-8 py-2 rounded-lg font-semibold inline-block">
                Kirim
            </a>
        </div>

    </form>

</div>

@endsection