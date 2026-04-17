@extends('layouts.app')

@section('content')

<div class="bg-[#F5F5F5] min-h-screen pb-20">

    <!-- STEP PROGRESS -->
    <div class="max-w-4xl mx-auto pt-10 mb-12">

        @php
        $labels = ['Buat Akun', 'Login', 'Isi Formulir', 'Upload Dokumen', 'Status Pendaftaran'];
        @endphp

        <div class="flex items-center justify-between relative">

            <!-- GARIS FULL -->
            <div class="absolute top-5 left-0 w-full h-1 bg-gray-200"></div>

            <!-- GARIS AKTIF -->
            <div class="absolute top-5 left-0 h-1 bg-[#1E5631]" style="width: 100%"></div>

            @foreach([1,2,3,4,5] as $step)
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

        <div class="flex justify-center mb-6">
            <span class="bg-[#1E5631] text-white px-6 py-2 rounded text-sm font-semibold">
                Diterima
            </span>
        </div>

        <div class="pb-4 border-b">
            <p class="text-sm text-gray-500 mb-1">Nama Calon Santri</p>
            <p class="text-[#1E5631] text-lg font-semibold">Ahmad Fauzan</p>
        </div>

        <div class="py-4 border-b">
            <p class="text-sm text-gray-500 mb-1">Program Pendidikan Pilihan</p>
            <p class="text-[#1E5631] text-lg font-semibold">Program Tahfidz Al-Qur’an</p>
        </div>

        <div class="py-4 border-b">
            <p class="text-sm text-gray-500 mb-1">Tanggal Pendaftaran</p>
            <p class="text-[#1E5631] text-lg font-semibold">12 Januari 2025</p>
        </div>

        <div class="bg-[#F5F5F5] rounded p-4 mt-6">
            <p class="text-gray-500 text-sm text-center">
                Selamat! Pendaftaran Anda telah diterima. Silahkan cek email Anda untuk informasi lebih lanjut mengenai tahap selanjutnya.
            </p>
        </div>

    </div>

</div>

@endsection