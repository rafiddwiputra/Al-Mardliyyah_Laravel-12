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
    <div class="max-w-2xl mx-auto bg-white p-12 rounded border border-[#D9D9D9] mb-10">

        <div class="text-center">

            <div class="w-24 h-24 bg-[#E8F2EC] rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-sm">
    
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-12 h-12 text-[#1E5631]"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M9 12h6m-6 4h6M8 4h5l5 5v11a1 1 0 01-1 1H8a1 1 0 01-1-1V5a1 1 0 011-1z"/>
                </svg>

            </div>

            <h3 class="text-3xl font-bold text-gray-700 mb-2">
                Belum Ada Pendaftaran
            </h3>

            <p class="text-gray-500 mb-6">
                Anda belum melakukan pendaftaran. Silahkan isi formulir terlebih dahulu.
            </p>

            <a href="/pendaftaran"
                class="bg-[#C6A75E] hover:bg-[#b8954f] text-white px-8 py-3 rounded-lg font-semibold shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 inline-block">
                Mulai Pendaftaran
            </a>

        </div>

    </div>

</div>

@endsection