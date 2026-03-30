@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="max-w-6xl mx-auto py-12 px-4">

    {{-- ================= STEPPER ================= --}}
    {{-- Mengikuti logika desain: Step 1 & 2 sudah dilewati/aktif --}}
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
                        {{ $number < 2 ? 'bg-[#1e4d2b]' : 'bg-gray-200' }}">
                    </div>
                @endif

                {{-- BULATAN STEP --}}
                <div class="z-10 flex flex-col items-center">
                    <div class="
                        w-11 h-11 flex items-center justify-center rounded-full text-lg font-bold shadow-sm
                        {{ $number == 1 
                            ? 'bg-[#1e4d2b] text-white' 
                            : ($number == 2 
                                ? 'bg-[#1e4d2b] text-white' 
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
        {{-- Badge --}}
        <span class="bg-[#e2ede5] text-[#1e4d2b] px-8 py-2 rounded-lg text-sm font-bold">
            Login Akun
        </span>

        {{-- Judul --}}
        <h2 class="text-2xl font-normal mt-6 text-gray-800">
            <span class="font-bold">Langkah 2</span> : Masuk ke akun Anda untuk melanjutkan
        </h2>
    </div>

    {{-- ================= CARD LOGIN ================= --}}
    {{-- Card dibuat lebih ramping sesuai desain Figma --}}
    <div class="flex justify-center">

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-10 w-full max-w-md">

            <form>

                {{-- EMAIL --}}
                <div class="mb-5 space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Email <span class="text-red-500">*</span>
                    </label>

                    <input type="email"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                        placeholder="Masukkan nama lengkap">
                </div>

                {{-- PASSWORD --}}
                <div class="mb-8 space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Password <span class="text-red-500">*</span>
                    </label>

                    <input type="password"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                        placeholder="Email@gmail.com">
                </div>

                {{-- BUTTON LOGIN --}}
                <button type="submit"
                    class="w-full bg-[#c9a76d] hover:bg-[#b5955e] transition text-white font-bold
                           py-3.5 rounded-lg shadow-sm text-lg mb-4">
                    Login
                </button>

                {{-- LINK KE DAFTAR --}}
                <div class="text-center text-sm text-gray-700">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold hover:underline">
                        Daftar Akun
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection