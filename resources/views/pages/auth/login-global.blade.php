@extends('layouts.app')

@section('content')

<div class="flex flex-col items-center justify-center min-h-[90vh] bg-white pb-32 px-4 sm:px-6">
    
    <div class="text-center mb-6 md:mb-8 mt-8">
        <img src="{{ asset('images/logo-1.png') }}" alt="Logo Pondok Pesantren Al-Mardliyyah" class="w-28 h-28 md:w-36 md:h-36 mx-auto mb-4 md:mb-5 object-contain">
        
        <div class="inline-block bg-[#E6F0EB] text-[#1a5336] font-bold px-6 md:px-8 py-2 rounded-md mb-3 md:mb-4 text-xs md:text-sm">
            Masuk Akun
        </div>
        
        <p class="text-gray-700 text-sm md:text-lg font-medium px-2">Masuk ke Akun yang sudah Anda daftarkan sebelumnya</p>
    </div>

    <div class="w-full max-w-md bg-white border border-gray-300 rounded-xl p-6 md:p-8 shadow-sm">
        <form method="POST" action="{{ route('login.authenticate') }}">
            @csrf

            {{-- Input Email --}}
            <div class="mb-5">
                <label for="email" class="block text-sm font-bold text-gray-900 mb-2">
                    Email <span class="text-red-600">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md text-sm md:text-base focus:outline-none focus:ring-1 focus:ring-[#1a5336] focus:border-[#1a5336] @error('email') border-red-500 @enderror"
                    placeholder="Masukkan email Anda" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password --}}
            <div class="mb-3">
                <label for="password" class="block text-sm font-bold text-gray-900 mb-2">
                    Kata Sandi <span class="text-red-600">*</span>
                </label>

                <div class="relative">
                    
                    {{-- Input Password --}}
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        autocomplete="new-password"
                        placeholder="Masukkan kata sandi Anda"
                        required
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-md text-sm md:text-base focus:outline-none focus:ring-1 focus:ring-[#1a5336] focus:border-[#1a5336] @error('password') border-red-500 @enderror"
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
            <div class="flex justify-end mb-6 mt-2">
                <a href="{{ route('password.request') }}" class="text-xs md:text-sm font-bold text-[#1a5336] hover:underline">
                    Lupa Kata Sandi?
                </a>
            </div>

            {{-- Tombol Login --}}
            <button type="submit" 
                class="w-full bg-[#C3A771] text-white font-bold text-base md:text-lg py-3 rounded-md hover:bg-[#b09664] hover:-translate-y-0.5 hover:shadow-lg transition-all duration-300">
                Masuk
            </button>
        </form>

        {{-- Belum punya akun --}}
        <div class="mt-8 text-center text-xs md:text-sm text-gray-600">
            Belum punya akun? 
            
            {{-- Logika pengecekan status pendaftaran --}}
            @if(isset($status) && $status == false)
                {{-- Jika tutup: Tampilkan popup --}}
                <button type="button" onclick="showRegistrationClosed()" class="font-bold text-gray-900 hover:text-[#1a5336] hover:underline transition-colors">
                    Daftar Akun
                </button>
            @else
                {{-- Jika buka: Redirect ke halaman register --}}
                <a href="{{ route('register') }}" class="font-bold text-gray-900 hover:text-[#1a5336] hover:underline transition-colors">
                    Daftar Akun
                </a>
            @endif

        </div>
    </div>
</div>

<style>
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

        const isPasswordHidden = passwordInput.type === 'password';

        passwordInput.type = isPasswordHidden ? 'text' : 'password';

        if (isPasswordHidden) {

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
</script>

{{-- Masukkan library SweetAlert2 jika belum ada di layout utama --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showRegistrationClosed() {
        Swal.fire({
            icon: null,
            buttonsStyling: false,
            
            html: `
                <div class="flex flex-col items-center mt-2 px-2">
                    {{-- Ikon Gembok Merah --}}
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    
                    {{-- Teks Judul dan Deskripsi --}}
                    <h2 class="text-2xl font-bold text-gray-800 mb-3">Pendaftaran Ditutup</h2>
                    <p class="text-gray-500 text-base leading-relaxed">
                        Mohon maaf, pendaftaran santri baru saat ini sedang tidak dibuka. Silakan cek secara berkala.
                    </p>
                </div>
            `,
            showConfirmButton: true,
            confirmButtonText: 'Mengerti & Tutup',
        
            customClass: {
                popup: 'rounded-2xl p-6 md:p-8',
                confirmButton: 'w-full mt-6 bg-[#1a5336] hover:bg-[#123b26] text-white font-bold py-3.5 rounded-full transition-colors text-base shadow-sm'
            }
        });
    }
</script>

@endsection