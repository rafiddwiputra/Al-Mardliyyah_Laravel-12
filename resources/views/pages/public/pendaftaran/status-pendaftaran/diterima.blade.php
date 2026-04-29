@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto py-12 px-4">

<!-- STEP PROGRESS -->
<div class="flex items-center justify-between mb-16 px-10">

    @php
            $steps = [
                1 => 'Buat Akun',              
                2 => 'Isi Formulir',
                3 => 'Upload Dokumen',
                4 => 'Status Pendaftaran'
            ];
        @endphp

        @foreach($steps as $number => $label)
            <div class="flex flex-col items-center flex-1 relative">
                
                {{-- GARIS PENGHUBUNG --}}
                @if($number != 4)
                    <div class="absolute top-5 left-1/2 w-full h-[3px] -z-0 
                        {{ $number < 4 ? 'bg-[#1e4d2b]' : 'bg-gray-200' }}">
                    </div>
                @endif

                {{-- BULATAN --}}
                <div class="z-10 flex flex-col items-center">
                    <div class="
                        w-11 h-11 flex items-center justify-center rounded-full text-lg font-bold shadow-sm
                        {{ $number <= 4 
                            ? 'bg-[#1e4d2b] text-white' 
                            : ($number == 4 
                                ? 'bg-[#c9a76d] text-white' 
                                : 'bg-gray-200 text-gray-400') 
                        }}
                    ">
                        {{ $number }}
                    </div>

                    <span class="text-xs mt-3 font-bold text-gray-700 text-center absolute -bottom-8 w-max">
                        {{ $label }}
                    </span>
                </div>
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
            <p>{{ $data->nama_lengkap }}</p>
        </div>

        <div class="py-4 border-b">
            <p class="text-sm text-gray-500 mb-1">Program Pendidikan Pilihan</p>
            <p>{{ $data->program->nama_program ?? '-' }}</p>
        </div>

        <div class="py-4 border-b">
            <p class="text-sm text-gray-500 mb-1">Tanggal Pendaftaran</p>
            <p>{{ $data->created_at->format('d F Y') }}</p>
        </div>

        <div class="bg-[#F5F5F5] rounded p-4 mt-6">
            <p class="text-gray-500 text-sm text-center">
                Selamat! Pendaftaran Anda telah diterima. Silahkan cek email Anda untuk informasi lebih lanjut mengenai tahap selanjutnya.
            </p>
        </div>

    </div>

</div>

@endsection