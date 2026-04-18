@extends('layouts.app')

@section('content')
{{-- min-h-[90vh] mendorong footer ke bawah. pb-32 menggeser titik tengah konten sedikit lebih ke atas --}}
<div class="flex flex-col items-center justify-center min-h-[90vh] bg-white pb-32">
    
    <div class="text-center mb-8 mt-8">
        <img src="{{ asset('images/logo-1.png') }}" alt="Logo Pondok Pesantren" class="w-36 h-36 mx-auto mb-5 object-contain">
        
        <div class="inline-block bg-[#E6F0EB] text-[#1a5336] font-bold px-8 py-2 rounded-md mb-4 text-sm">
            Lupa Password
        </div>
        <p class="text-gray-700 text-lg font-medium">Masukkan email أنت untuk mereset kata sandi</p>
    </div>

    <div class="w-full max-w-md bg-white border border-gray-300 rounded-xl p-8 shadow-sm">
        
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="mb-6">
                <label for="email" class="block text-sm font-bold text-gray-900 mb-2">
                    Alamat Email <span class="text-red-600">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1a5336] focus:border-[#1a5336] @error('email') border-red-500 @enderror"
                    placeholder="Masukkan email yang terdaftar" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                class="w-full bg-[#C3A771] text-white font-bold text-lg py-3 rounded-md hover:bg-[#b09664] transition duration-200 mb-4">
                Kirim Link Reset
            </button>
        </form>

        <div class="text-center text-sm text-gray-600 mt-4">
            Ingat password Anda? <a href="{{ route('login') }}" class="font-bold text-gray-900 hover:underline">Kembali ke Login</a>
        </div>
    </div>
</div>
@endsection