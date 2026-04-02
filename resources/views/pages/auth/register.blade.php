@extends('layouts.app')

@section('title', 'Pendaftaran')

@section('content')

<div class="max-w-6xl mx-auto py-12 px-4">

    {{-- ================= STEPPER ================= --}}
    <div class="flex items-center justify-between mb-16 px-10">

        @php
            $steps = [
                1 => 'Buat Akun',
                2 => 'Login',
                3 => 'Isi Formulir',
                4 => 'Upload Dokumen',
                5 => 'Status Pendaftaran'
            ];
        @endphp

        @foreach($steps as $number => $label)
            <div class="flex flex-col items-center flex-1 relative">
                
                {{-- GARIS PENGHUBUNG --}}
                @if($number != 5)
                    <div class="absolute top-5 left-1/2 w-full h-[3px] -z-0 
                        {{ $number == 1 ? 'bg-[#1e4d2b]' : 'bg-gray-200' }}">
                    </div>
                @endif

                {{-- BULATAN --}}
                <div class="z-10 flex flex-col items-center">
                    <div class="
                        w-11 h-11 flex items-center justify-center rounded-full text-lg font-bold shadow-sm
                        {{ $number == 1 
                            ? 'bg-[#1e4d2b] text-white' 
                            : ($number == 2 
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

    {{-- ================= HEADER ================= --}}
    <div class="text-center mb-10 mt-10">
        <span class="bg-[#e2ede5] text-[#1e4d2b] px-8 py-2 rounded-lg text-sm font-bold">
            Daftar Akun
        </span>

        <h2 class="text-2xl font-normal mt-6 text-gray-800">
            <span class="font-bold">Langkah 1</span> : Buat akun untuk melanjutkan pendaftaran
        </h2>
    </div>

    {{-- ================= CARD FORM ================= --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 max-w-5xl mx-auto">

        <form>

            {{-- GRID FORM --}}
            <div class="grid md:grid-cols-2 gap-x-12 gap-y-6">

                {{-- NAMA --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                        placeholder="Masukkan nama lengkap">
                </div>

                {{-- PASSWORD --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Password <span class="text-red-500">*</span>
                    </label>

                    <input type="password"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                        placeholder="Minimal 8 karakter">
                </div>

                {{-- EMAIL --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Email <span class="text-red-500">*</span>
                    </label>

                    <input type="email"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                        placeholder="Email@gmail.com">
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>

                    <input type="password"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                        placeholder="Ulangi password">
                </div>

                {{-- NOMOR HP --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Nomor HP <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                        placeholder="08xxxxxxxxxx">
                </div>

                {{-- BUTTON & LOGIN --}}
                <div class="flex flex-col items-center justify-center gap-3">
                    <button type="submit"
                        class="w-full bg-[#c9a76d] hover:bg-[#b5955e] transition text-white font-bold
                               py-3.5 rounded-lg shadow-sm text-lg">
                        Daftar Akun
                    </button>
                    
                    <div class="text-sm text-gray-700">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-bold hover:underline">Login</a>
                    </div>
                </div>

            </div>

        </form>

    </div>

</div>

@endsection
