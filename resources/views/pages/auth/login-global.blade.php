@extends('layouts.app')

@section('content')
{{-- min-h-[90vh] dan pb-32 disamakan agar footer tetap di bawah dan konten agak naik ke atas --}}
<div class="flex flex-col items-center justify-center min-h-[90vh] bg-white pb-32">
    
    {{-- mt-8 mb-8 disamakan agar posisi logo konsisten dengan halaman lupa password --}}
    <div class="text-center mb-8 mt-8">
        <img src="{{ asset('images/logo-1.png') }}" alt="Logo Pondok Pesantren Al-Mardliyyah" class="w-36 h-36 mx-auto mb-5 object-contain">
        
        <div class="inline-block bg-[#E6F0EB] text-[#1a5336] font-bold px-8 py-2 rounded-md mb-4 text-sm">
            Login Akun
        </div>
        
        <p class="text-gray-700 text-lg font-medium">Masuk ke Akun yang sudah أنت daftarkan sebelumnya</p>
    </div>

    <div class="w-full max-w-md bg-white border border-gray-300 rounded-xl p-8 shadow-sm">
        <form method="POST" action="{{ route('login.authenticate') }}">
            @csrf

            {{-- Input Email --}}
            <div class="mb-5">
                <label for="email" class="block text-sm font-bold text-gray-900 mb-2">
                    Email <span class="text-red-600">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1a5336] focus:border-[#1a5336] @error('email') border-red-500 @enderror"
                    placeholder="Masukkan email Anda" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password --}}
            <div class="mb-3">
                <label for="password" class="block text-sm font-bold text-gray-900 mb-2">
                    Password <span class="text-red-600">*</span>
                </label>
                <input type="password" id="password" name="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1a5336] focus:border-[#1a5336] @error('password') border-red-500 @enderror"
                    placeholder="Masukkan password Anda" required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lupa Kata Sandi --}}
            <div class="flex justify-end mb-6">
                <a href="{{ route('password.request') }}" class="text-sm font-bold text-[#1a5336] hover:underline">
                    Lupa Kata Sandi?
                </a>
            </div>

            {{-- Tombol Login --}}
            <button type="submit" 
                class="w-full bg-[#C3A771] text-white font-bold text-lg py-3 rounded-md hover:bg-[#b09664] transition duration-200">
                Login
            </button>
        </form>

        {{-- Belum punya akun --}}
        <div class="mt-8 text-center text-sm text-gray-600">
            Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-gray-900 hover:underline">Daftar Akun</a>
        </div>
    </div>
</div>
@endsection