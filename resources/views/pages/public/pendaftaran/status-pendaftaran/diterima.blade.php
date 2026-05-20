@extends('layouts.app')

@section('content')

{{-- Container Utama yang memberikan jarak aman (px-4 sm:px-6) --}}
<div class="max-w-6xl mx-auto py-12 px-4 sm:px-6">

    <div class="flex items-center justify-between mb-20 md:mb-16 px-2 sm:px-6 md:px-10">

        @php
            $steps = [
                1 => 'Buat Akun',              
                2 => 'Isi Formulir',
                3 => 'Upload Dokumen',
                4 => 'Status Pendaftaran'
            ];
            $currentStep = 4;
        @endphp

        @foreach($steps as $number => $label)
            <div class="flex flex-col items-center flex-1 relative">
                
                {{-- GARIS PENGHUBUNG --}}
                @if($number != 4)
                    <div class="absolute top-4 md:top-5 left-1/2 w-full h-[3px] -z-0 
                        {{ $number < 4 ? 'bg-[#1e4d2b]' : 'bg-gray-200' }}">
                    </div>
                @endif

                {{-- BULATAN (Responsif mengecil di HP) --}}
                <div class="z-10 flex flex-col items-center">
                    <div class="
                        w-8 h-8 md:w-11 md:h-11 flex items-center justify-center rounded-full text-sm md:text-lg font-bold shadow-sm
                        {{ $number <= 4 
                            ? 'bg-[#1e4d2b] text-white' 
                            : ($number == 4 
                                ? 'bg-[#c9a76d] text-white' 
                                : 'bg-gray-200 text-gray-400') 
                        }}
                    ">
                        {{ $number }}
                    </div>

                    {{-- LABEL TEKS (Responsif wrap di HP) --}}
                    <span class="text-[10px] md:text-xs mt-2 md:mt-3 font-bold text-gray-700 text-center absolute -bottom-8 md:-bottom-8 w-16 sm:w-20 md:w-max leading-tight break-words">
                        {{ $label }}
                    </span>
                </div>
            </div>
        @endforeach

    </div>

    {{-- Tag </div> penyusup yang membuat desain berantakan sudah DIHAPUS dari sini --}}

    <div class="text-center mb-8 px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-[#1E5631]">
            Status Pendaftaran
        </h2>
        <p class="text-sm md:text-base text-gray-500 mt-2">
            Informasi Pendaftaran Anda
        </p>
    </div>

    <div class="max-w-2xl mx-auto bg-white p-6 md:p-12 rounded-xl border border-[#D9D9D9] mb-20 shadow-sm">

        <div class="flex justify-center mb-6">
            <span class="bg-[#1E5631] text-white px-6 py-2 rounded-lg text-sm font-semibold shadow-sm">
                Diterima
            </span>
        </div>

        <div class="pb-4 border-b">
            <p class="text-xs md:text-sm text-gray-500 mb-1">Nama Calon Santri</p>
            <p class="font-medium text-gray-800">{{ $data->nama_lengkap }}</p>
        </div>

        <div class="py-4 border-b">
            <p class="text-xs md:text-sm text-gray-500 mb-1">Program Pendidikan Pilihan</p>
            <p class="font-medium text-gray-800">{{ $data->program->nama_program ?? '-' }}</p>
        </div>

        <div class="py-4 border-b">
            <p class="text-xs md:text-sm text-gray-500 mb-1">Tanggal Pendaftaran</p>
            <p class="font-medium text-gray-800">{{ $data->created_at->format('d F Y') }}</p>
        </div>

        @if(strtolower($data->status ?? '') === 'diterima')
        <div class="mt-8 flex justify-center">
            {{-- Tombol PDF dibuat melebar penuh di HP (w-full) --}}
            <a href="{{ route('user.cetak-bukti') }}" target="_blank" 
               class="w-full md:w-auto flex justify-center items-center gap-2 bg-[#1E5631] text-white px-6 py-3 md:py-3.5 rounded-lg text-sm md:text-base font-semibold hover:bg-[#17472a] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 shadow-md">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Download Bukti Pendaftaran (PDF)
            </a>
        </div>
        @endif

        <div class="bg-[#F8FAFC] rounded-lg border border-gray-100 p-4 mt-6">
            <p class="text-gray-600 text-xs md:text-sm text-center leading-relaxed">
                Selamat! Pendaftaran Anda telah diterima. Silakan cek email Anda untuk informasi lebih lanjut mengenai tahap selanjutnya.
            </p>
        </div>

    </div>

</div> 

@endsection