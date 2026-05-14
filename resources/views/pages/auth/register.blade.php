@extends('layouts.app')

@section('title', 'Pendaftaran')

@section('content')

<div class="max-w-6xl mx-auto py-12 px-4">

    {{-- ================= STEPPER ================= --}}
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

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            {{-- GRID FORM --}}
            <div class="grid md:grid-cols-2 gap-x-12 gap-y-6">

                {{-- NAMA --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>

                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                        placeholder="Masukkan nama lengkap" required>
                    @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Password <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <input 
                            type="password"
                            id="password"
                            name="password"
                            autocomplete="new-password"
                            class="w-full border border-gray-200 rounded-lg px-4 py-3 pr-12 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                            placeholder="Minimal 8 karakter"
                            required
                        >

                        <button 
                            type="button"
                            id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center justify-center w-12 text-gray-500 hover:text-[#1e4d2b] transition"
                        >
                            <svg 
                                id="eyeIcon"
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                {{-- Default mata dicoret --}}
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

                {{-- EMAIL --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Email <span class="text-red-500">*</span>
                    </label>

                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                        placeholder="Email@gmail.com" required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <input 
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            autocomplete="new-password"
                            class="w-full border border-gray-200 rounded-lg px-4 py-3 pr-12 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                            placeholder="Ulangi password"
                            required
                        >

                        <button 
                            type="button"
                            id="toggleConfirmPassword"
                            class="absolute inset-y-0 right-0 flex items-center justify-center w-12 text-gray-500 hover:text-[#1e4d2b] transition"
                        >
                            <svg 
                                id="confirmEyeIcon"
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                {{-- Default mata dicoret --}}
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

                {{-- NOMOR HP --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-800">
                        Nomor HP (WhatsApp) <span class="text-red-500">*</span>
                    </label>

                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-green-800 transition"
                        placeholder="08xxxxxxxxxx" required>
                    @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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

    function setupPasswordToggle(inputId, buttonId, iconId) {

        const passwordInput = document.getElementById(inputId);
        const toggleButton = document.getElementById(buttonId);
        const eyeIcon = document.getElementById(iconId);

        toggleButton.addEventListener('click', function () {

            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';

            if (isHidden) {

                // mata normal
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

                // mata dicoret
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
    }

    setupPasswordToggle('password', 'togglePassword', 'eyeIcon');

    setupPasswordToggle(
        'password_confirmation',
        'toggleConfirmPassword',
        'confirmEyeIcon'
    );

</script>

@endsection