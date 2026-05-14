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

                <div class="relative">
                    
                    {{-- Input Password --}}
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        autocomplete="new-password"
                        placeholder="Masukkan password Anda"
                        required
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1a5336] focus:border-[#1a5336] @error('password') border-red-500 @enderror"
                    >

                    {{-- Tombol Icon Mata --}}
                    <button 
                        type="button"
                        id="togglePassword"
                        class="absolute inset-y-0 right-0 flex items-center justify-center w-12 text-gray-500 hover:text-[#1a5336] transition"
                    >
                        <svg 
                            id="eyeIcon"
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19
                                c-4.478 0-8.268-2.943-9.542-7
                                a9.956 9.956 0 012.042-3.368m3.1-2.675
                                A9.953 9.953 0 0112 5c4.478 0 8.268 2.943
                                9.542 7a9.97 9.97 0 01-4.132 5.411
                                M15 12a3 3 0 00-3-3m0 0
                                a2.99 2.99 0 00-2.12.879
                                M3 3l18 18" />
                        </svg>
                    </button>

                </div>

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

<style>
    /* Hilangkan icon bawaan browser untuk password */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear {
        display: none;
    }

    input[type="password"]::-webkit-credentials-auto-fill-button {
        visibility: hidden;
        display: none !important;
        pointer-events: none;
    }
</style>

<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {

        // cek kondisi password
        const isPasswordHidden = passwordInput.type === 'password';

        // ubah tipe input
        passwordInput.type = isPasswordHidden ? 'text' : 'password';

        // ubah icon
        if (isPasswordHidden) {

            // icon mata biasa (password terlihat)
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5
                    c4.478 0 8.268 2.943 9.542 7
                    -1.274 4.057-5.064 7-9.542 7
                    -4.477 0-8.268-2.943-9.542-7z" />
            `;

        } else {

            // icon mata dicoret (password disembunyikan)
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19
                    c-4.478 0-8.268-2.943-9.542-7
                    a9.956 9.956 0 012.042-3.368m3.1-2.675
                    A9.953 9.953 0 0112 5c4.478 0 8.268 2.943
                    9.542 7a9.97 9.97 0 01-4.132 5.411
                    M15 12a3 3 0 00-3-3m0 0
                    a2.99 2.99 0 00-2.12.879
                    M3 3l18 18" />
            `;
        }
    });
</script>

@endsection