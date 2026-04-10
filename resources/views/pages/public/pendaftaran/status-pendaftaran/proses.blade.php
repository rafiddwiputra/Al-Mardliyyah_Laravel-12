@extends('layouts.app')

@section('content')

<div class="bg-[#F5F5F5] min-h-[72vh] py-3">

    <!-- STEP PROGRESS -->
    <div class="max-w-3xl mx-auto pt-4 mb-6">

        @php
        $labels = ['Buat Akun', 'Login', 'Isi Formulir', 'Upload Dokumen', 'Status Pendaftaran'];
        @endphp

        <div class="flex items-center justify-between relative">

            <div class="absolute top-4 left-0 w-full h-[2px] bg-gray-200"></div>
            <div class="absolute top-4 left-0 h-[2px] bg-[#1E5631]" style="width: 100%"></div>

            @foreach([1,2,3,4,5] as $step)
            <div class="flex flex-col items-center relative z-10">

                <div class="w-8 h-8 flex items-center justify-center rounded-full text-[11px] font-semibold bg-[#1E5631] text-white">
                    {{ $step }}
                </div>

                <p class="mt-1 text-[10px] text-[#1E5631] font-medium">
                    {{ $labels[$step-1] }}
                </p>

            </div>
            @endforeach

        </div>

    </div>

    <!-- TITLE -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-[#1E5631]">
            Status Pendaftaran
        </h2>
        <p class="text-sm text-gray-500">
            Informasi Pendaftaran Anda
        </p>
    </div>

    <!-- CARD -->
    <div class="max-w-2xl mx-auto bg-white p-4 rounded border border-[#D9D9D9]">

        <!-- STATUS -->
        <div class="flex justify-center mb-6">
            <span class="bg-[#C6A75E] text-white px-4 py-1 rounded text-sm font-medium">
                Sedang Diproses
            </span>
        </div>

        <!-- DATA 1 -->
        <div class="pb-4 border-b">
            <p class="text-xs text-gray-500 mb-1">Nama Calon Santri</p>
            <p class="text-[#1E5631] font-medium">Ahmad Fauzan</p>
        </div>

        <!-- DATA 2 -->
        <div class="py-4 border-b">
            <p class="text-xs text-gray-500 mb-1">Program Pendidikan Pilihan</p>
            <p class="text-[#1E5631] font-medium">MA Al-Mardliyyah</p>
        </div>

        <!-- DATA 3 -->
        <div class="py-4 border-b">
            <p class="text-xs text-gray-500 mb-1">Tanggal Pendaftaran</p>
            <p class="text-[#1E5631] font-medium">12 Januari 2026</p>
        </div>

        <!-- CARD TAMBAHAN -->
        <div class="bg-[#F8F8F8] rounded p-3 mt-3 text-center">
            <p class="text-gray-500 text-sm">
                Pendaftaran Anda sedang dalam proses verifikasi oleh tim kami. Tunggu dan cek status pendaftaran sampai dengan tanggal yang sudah ditentukan
            </p>
        </div>

        <!-- BUTTON EDIT -->
        <div class="flex justify-center mt-6">
            <button class="bg-[#C6A75E] text-white px-5 py-1.5 rounded text-xs font-medium">
                Edit Data
            </button>
        </div>

    </div>

    <!-- LOGOUT -->
    <div class="max-w-2xl mx-auto flex justify-end mt-3">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="bg-[#F8CFCF] text-red-600 font-semibold px-6 py-2 rounded-md text-sm hover:bg-red-200 transition">
            Log Out
        </button>
    </form>
</div>
</div>

@endsection