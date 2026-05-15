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

    <div class="relative">

        <input type="password" id="password" name="password"
            placeholder="Minimal 8 karakter"
            required autofocus
            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1a5336] focus:border-[#1a5336] @error('password') border-red-500 @enderror">

        <!-- ICON MATA -->
        <button type="button"
            id="togglePassword"
            class="absolute inset-y-0 right-0 flex items-center justify-center w-12 text-gray-500 hover:text-[#1a5336] transition">

            <svg id="eyeIcon"
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

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

            <div class="mb-6">
    <label for="password_confirmation" class="block text-sm font-bold text-gray-900 mb-2">
        Konfirmasi Password <span class="text-red-600">*</span>
    </label>

    <div class="relative">

        <input type="password" id="password_confirmation" name="password_confirmation"
            placeholder="Ulangi password baru"
            required
            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1a5336] focus:border-[#1a5336]">

        <!-- ICON MATA -->
        <button type="button"
            id="togglePasswordConfirm"
            class="absolute inset-y-0 right-0 flex items-center justify-center w-12 text-gray-500 hover:text-[#1a5336] transition">

            <svg id="eyeIconConfirm"
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

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
</div>

            <button type="submit" 
                class="w-full bg-[#C3A771] text-white font-bold text-lg py-3 rounded-md hover:bg-[#b09664] transition duration-200">
                Simpan Password Baru
            </button>
        </form>
    </div>
</div>

<style>
    /* Hilangkan icon bawaan browser */
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
    // PASSWORD BARU
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {

        const isHidden = passwordInput.type === 'password';

        passwordInput.type = isHidden ? 'text' : 'password';

        if (isHidden) {

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

    // KONFIRMASI PASSWORD
    const confirmInput = document.getElementById('password_confirmation');
    const toggleConfirm = document.getElementById('togglePasswordConfirm');
    const eyeIconConfirm = document.getElementById('eyeIconConfirm');

    toggleConfirm.addEventListener('click', function () {

        const isHidden = confirmInput.type === 'password';

        confirmInput.type = isHidden ? 'text' : 'password';

        if (isHidden) {

            eyeIconConfirm.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5
                    c4.478 0 8.268 2.943 9.542 7
                    -1.274 4.057-5.064 7-9.542 7
                    -4.477 0-8.268-2.943-9.542-7z" />
            `;

        } else {

            eyeIconConfirm.innerHTML = `
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