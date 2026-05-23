@extends('layouts.app')

@section('content')
{{-- min-h-[90vh] mendorong footer ke bawah. pb-32 menggeser titik tengah konten sedikit lebih ke atas --}}
<div class="flex flex-col items-center justify-center min-h-[90vh] bg-white pb-32">
    
    <div class="text-center mb-8 mt-8">
        <img src="{{ asset('images/logo-1.png') }}" alt="Logo Pondok Pesantren" class="w-36 h-36 mx-auto mb-5 object-contain">
        
        <div class="inline-block bg-[#E6F0EB] text-[#1a5336] font-bold px-8 py-2 rounded-md mb-4 text-sm">
            Lupa Kata Sandi
        </div>
        <p class="text-gray-700 text-lg font-medium">Masukkan email أنت untuk mereset kata sandi</p>
    </div>

    <div class="w-full max-w-md bg-white border border-gray-300 rounded-xl p-8 shadow-sm">
        
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" id="form-reset">
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

            <button type="submit" id="btn-reset"
                class="w-full flex justify-center items-center bg-[#C3A771] text-white font-bold text-lg py-3 rounded-md hover:bg-[#b09664] transition duration-200 mb-4">
                Kirim Link Reset
            </button>

        </form>

        <div class="text-center text-sm text-gray-600 mt-4">
            Ingat Kata Sandi Anda? <a href="{{ route('login') }}" class="font-bold text-gray-900 hover:underline">Kembali ke Masuk</a>
        </div>
    </div>
</div>

<script>
    document.getElementById('form-reset').addEventListener('submit', function() {
        let btn = document.getElementById('btn-reset');
        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        btn.innerHTML = `
            <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        `;
    });
</script>
@endsection