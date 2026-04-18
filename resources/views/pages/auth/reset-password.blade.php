@extends('layouts.app')

@section('content')
{{-- Style wrapper dan logo disamakan persis dengan forgot-password --}}
<div class="flex flex-col items-center justify-center min-h-[90vh] bg-white pb-32">
    
    <div class="text-center mb-8 mt-8">
        <img src="{{ asset('images/logo-1.png') }}" alt="Logo Pondok Pesantren" class="w-36 h-36 mx-auto mb-5 object-contain">
        <div class="inline-block bg-[#E6F0EB] text-[#1a5336] font-bold px-8 py-2 rounded-md mb-4 text-sm">
            Buat Password Baru
        </div>
        <p class="text-gray-700 text-lg font-medium">Silakan buat kata sandi baru untuk akun أنت</p>
    </div>

    <div class="w-full max-w-md bg-white border border-gray-300 rounded-xl p-8 shadow-sm">
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-5">
                <label for="email" class="block text-sm font-bold text-gray-900 mb-2">
                    Email
                </label>
                <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" readonly
                    class="w-full px-4 py-3 border border-gray-300 bg-gray-100 text-gray-600 rounded-md focus:outline-none">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block text-sm font-bold text-gray-900 mb-2">
                    Password Baru <span class="text-red-600">*</span>
                </label>
                <input type="password" id="password" name="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1a5336] focus:border-[#1a5336] @error('password') border-red-500 @enderror"
                    placeholder="Minimal 8 karakter" required autofocus>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-bold text-gray-900 mb-2">
                    Konfirmasi Password <span class="text-red-600">*</span>
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1a5336] focus:border-[#1a5336]"
                    placeholder="Ulangi password baru" required>
            </div>

            <button type="submit" 
                class="w-full bg-[#C3A771] text-white font-bold text-lg py-3 rounded-md hover:bg-[#b09664] transition duration-200">
                Simpan Password Baru
            </button>
        </form>
    </div>
</div>
@endsection