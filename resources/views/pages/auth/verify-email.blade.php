@extends('layouts.app')

@section('content')
{{-- Ditambahkan px-4 sm:px-6 agar card tidak menabrak pinggir layar di device HP --}}
<div class="flex flex-col items-center justify-center min-h-[90vh] bg-white pb-32 px-4 sm:px-6">
    
    {{-- Bagian Logo dan Header dibuat responsif --}}
    <div class="text-center mb-6 md:mb-8 mt-8">
        {{-- Logo sedikit dikecilkan di HP (w-28) dan kembali normal di PC (md:w-36) --}}
        <img src="{{ asset('images/logo-1.png') }}" alt="Logo Pondok Pesantren" class="w-28 h-28 md:w-36 md:h-36 mx-auto mb-4 md:mb-5 object-contain">
        
        <div class="inline-block bg-[#E6F0EB] text-[#1a5336] font-bold px-6 md:px-8 py-2 rounded-md mb-3 md:mb-4 text-xs md:text-sm">
            Verifikasi Email
        </div>
        
        {{-- Teks Arab dirubah ke Indonesia & dibuat responsif --}}
        <p class="text-gray-700 text-sm md:text-lg font-medium px-2">Satu langkah lagi untuk menyelesaikan pendaftaran</p>
    </div>
    
    {{-- Card Container diberi p-6 di HP agar memberikan ruang yang ideal --}}
    <div class="w-full max-w-md bg-white border border-gray-300 rounded-xl p-6 md:p-8 shadow-sm text-center">
        
        {{-- Deskripsi Arab dirubah ke Indonesia & ukuran teks disesuaikan --}}
        <p class="text-xs md:text-sm text-gray-600 mb-6 leading-relaxed">
            Terima kasih telah mendaftar! Sebelum melanjutkan, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan ke kotak masuk email Anda.
            <br><br>
            Jika Anda tidak menerima email tersebut, silakan periksa folder spam atau klik tombol di bawah ini untuk mengirim ulang email verifikasi.
        </p>

        {{-- Alert Sukses jika email dikirim ulang --}}
        @if (session('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded text-left">
                <p class="font-medium text-xs md:text-sm">{{ session('message') }}</p>
            </div>
        @endif

        {{-- Form Kirim Ulang --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            {{-- Ukuran teks tombol disesuaikan jadi text-base di HP --}}
            <button type="submit" 
                class="w-full bg-[#C3A771] text-white font-bold text-base md:text-lg py-3 rounded-md hover:bg-[#b09664] hover:-translate-y-0.5 hover:shadow-md transition-all duration-200">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        {{-- Tombol Logout / Kembali --}}
        <div class="mt-6 flex items-center justify-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs md:text-sm font-bold text-gray-500 hover:text-red-600 hover:underline transition">
                    Batal dan Keluar
                </button>
            </form>
        </div>

    </div>
</div>
@endsection