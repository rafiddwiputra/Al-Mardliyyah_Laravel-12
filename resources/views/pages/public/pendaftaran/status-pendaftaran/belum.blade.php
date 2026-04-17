@extends('layouts.app')

@section('content')

<div class="bg-[#F5F5F5] min-h-screen pb-20">

    <!-- STEP PROGRESS -->
    <div class="max-w-4xl mx-auto pt-10 mb-12">

        @php
        $labels = ['Buat Akun', 'Isi Formulir', 'Upload Dokumen', 'Status Pendaftaran'];
        @endphp

        <div class="flex items-center justify-between relative">

            <!-- GARIS FULL -->
            <div class="absolute top-5 left-0 w-full h-1 bg-gray-200"></div>

            <!-- GARIS AKTIF -->
            <div class="absolute top-5 left-0 h-1 bg-[#1E5631]" style="width: 100%"></div>

            @foreach([1,2,3,4] as $step)
            <div class="flex flex-col items-center relative z-10">

                <!-- BULATAN -->
                <div class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-semibold bg-[#1E5631] text-white">
                    {{ $step }}
                </div>

                <!-- LABEL -->
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

        <div class="text-center">

            <div class="text-6xl text-gray-300 mb-4">📄</div>

            <h3 class="text-3xl font-bold text-gray-700 mb-2">
                Belum Ada Pendaftaran
            </h3>

            <p class="text-gray-500 mb-6">
                Anda belum melakukan pendaftaran. Silahkan isi formulir terlebih dahulu.
            </p>

            <a href="/pendaftaran"
                class="bg-[#C6A75E] text-white px-8 py-3 rounded font-semibold">
                Mulai Pendaftaran
            </a>

        </div>

    </div>

</div>

@endsection