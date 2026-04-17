@extends('layouts.app')

@section('content')

<div class="bg-[#F5F5F5] min-h-screen pb-20">

    <!-- STEP PROGRESS -->
    <div class="max-w-4xl mx-auto pt-10 mb-12">

        @php
        $labels = ['Buat Akun', 'Isi Formulir', 'Upload Dokumen', 'Status Pendaftaran'];
        @endphp

        <div class="flex items-center justify-between relative">

            <div class="absolute top-5 left-0 w-full h-1 bg-gray-200"></div>
            <div class="absolute top-5 left-0 h-1 bg-[#1E5631]" style="width: 100%"></div>

            @foreach([1,2,3,4] as $step)
            <div class="flex flex-col items-center relative z-10">

                <div class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-semibold bg-[#1E5631] text-white">
                    {{ $step }}
                </div>

                <p class="mt-2 text-xs text-[#1E5631] font-medium">
                    {{ $labels[$step-1] }}
                </p>

            </div>
            @endforeach

        </div>

    </div>

    <!-- TITLE -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-[#1E5631]">
            Status Pendaftaran
        </h2>
        <p class="text-gray-500">
            Informasi Pendaftaran Anda
        </p>
    </div>

    <!-- CARD -->
    <div class="max-w-2xl mx-auto bg-white p-12 rounded border border-[#D9D9D9]">

        <!-- STATUS -->
        <div class="flex justify-center mb-6">
            <span class="bg-[#C6A75E] text-white px-6 py-2 rounded text-sm font-semibold">
                Sedang Diproses
            </span>
        </div>

        <!-- DATA 1 -->
        <div class="pb-4 border-b">
            <p class="text-sm text-gray-500 mb-1">Nama Calon Santri</p>
            <p class="text-[#1E5631] text-lg font-semibold">Ahmad Fauzan</p>
        </div>

        <!-- DATA 2 -->
        <div class="py-4 border-b">
            <p class="text-sm text-gray-500 mb-1">Program Pendidikan Pilihan</p>
            <p class="text-[#1E5631] text-lg font-semibold">MA Al-Mardliyyah</p>
        </div>

        <!-- DATA 3 -->
        <div class="py-4 border-b">
            <p class="text-sm text-gray-500 mb-1">Tanggal Pendaftaran</p>
            <p class="text-[#1E5631] text-lg font-semibold">12 Januari 2026</p>
        </div>

        <!-- CARD TAMBAHAN -->
        <div class="bg-[#F5F5F5] rounded p-4 mt-6 text-center">
            <p class="text-gray-500 text-sm">
                Pendaftaran Anda sedang dalam proses verifikasi oleh tim kami. Silakan tunggu dan cek status pendaftaran secara berkala.
            </p>
        </div>

        <!-- BUTTON EDIT -->
        <div class="flex justify-center mt-6">
            <button class="bg-[#C6A75E] text-white px-6 py-2 rounded text-sm font-semibold">
                Edit Data
            </button>
        </div>

    </div>
</div>

@endsection