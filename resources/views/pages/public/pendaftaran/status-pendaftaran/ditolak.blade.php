@extends('layouts.app')

@section('content')

<div class="bg-[#F5F5F5] min-h-[72vh] py-3">

    <!-- STEP PROGRESS -->
    <div class="max-w-2xl mx-auto pt-2 mb-4">

        @php
        $labels = ['Buat Akun', 'Login', 'Isi Formulir', 'Upload Dokumen', 'Status Pendaftaran'];
        @endphp

        <div class="flex items-center justify-between relative">

            <div class="absolute top-3 left-0 w-full h-[2px] bg-gray-200"></div>
            <div class="absolute top-3 left-0 h-[2px] bg-[#1E5631]" style="width: 100%"></div>

            @foreach([1,2,3,4,5] as $step)
            <div class="flex flex-col items-center relative z-10">

                <div class="w-7 h-7 flex items-center justify-center rounded-full text-[10px] font-semibold bg-[#1E5631] text-white">
                    {{ $step }}
                </div>

                <p class="mt-1 text-[9px] text-[#1E5631] font-medium">
                    {{ $labels[$step-1] }}
                </p>

            </div>
            @endforeach

        </div>

    </div>

    <!-- TITLE -->
    <div class="text-center mb-4">
        <h2 class="text-xl font-bold text-[#1E5631]">
            Status Pendaftaran
        </h2>
        <p class="text-xs text-gray-500">
            Informasi Pendaftaran Anda
        </p>
    </div>

    <!-- CARD -->
    <div class="max-w-xl mx-auto bg-white p-4 rounded border border-[#D9D9D9]">

        <div class="flex justify-center mb-4">
            <span class="bg-[#F8CFCF] text-red-600 px-4 py-1 rounded text-xs font-medium">
                Ditolak
            </span>
        </div>

        <div class="pb-2 border-b">
            <p class="text-[11px] text-gray-500 mb-1">Nama Calon Santri</p>
            <p class="text-[#1E5631] text-sm font-medium">Ahmad Fauzan</p>
        </div>

        <div class="py-2 border-b">
            <p class="text-[11px] text-gray-500 mb-1">Program Pendidikan Pilihan</p>
            <p class="text-[#1E5631] text-sm font-medium">Progam Tahfidz Al-Qur’an</p>
        </div>

        <div class="py-2 border-b">
            <p class="text-[11px] text-gray-500 mb-1">Tanggal Pendaftaran</p>
            <p class="text-[#1E5631] text-sm font-medium">12 Januari 2025</p>
        </div>

        <div class="bg-[#F5F5F5] rounded p-3 mt-3">
            <p class="text-gray-500 text-xs text-center">
                Mohon maaf! pendaftaran Anda belum dapat kami proses lebih lanjut. Silahkan hubungan admin untuk informasi lebih lanjut
            </p>

            <div class="flex justify-center mt-6">
                <button class="bg-[#1E5631] text-white px-5 py-1.5 rounded text-xs font-medium">
                    Hubungi Admin
                </button>
            </div>
        
        </div>

    </div>

    <div class="max-w-xl mx-auto flex justify-end mt-3">
        <button class="bg-[#F8CFCF] text-red-600 font-semibold px-5 py-1.5 rounded-md text-xs">
            Log Out
        </button>
    </div>

</div>

@endsection