@extends('layouts.app')

@section('content')

@if(!$status)
<div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 overflow-hidden">
    <div class="bg-white p-6 rounded-lg text-center shadow-lg max-w-sm">

        <h2 class="text-lg font-bold text-red-600 mb-2">
            Pendaftaran Ditutup
        </h2>

        <p class="text-sm text-gray-600 mb-4">
            Maaf, pendaftaran saat ini sedang ditutup.
        </p>

        <a href="/" class="bg-[#1E5631] text-white px-4 py-2 rounded">
            Kembali
        </a>

    </div>
</div>
@endif

<div class="bg-[#1E5631] text-white px-20 py-20">
    <p class="text-sm mb-4">Beranda > Pendaftaran</p>

    <h1 class="text-3xl font-bold mb-4">
        Pendaftaran Santri Baru
    </h1>

    <p class="max-w-2xl text-sm leading-relaxed text-gray-100">
        Pondok Pesantren Al-Mardliyyah membuka pendaftaran santri baru tahun ajaran 2026/2027. Bergabunglah bersama kami untuk pendidikan Islam
        yang berkualitas dan berakhlak mulia.
    </p>
</div>

<div class="bg-[#F5F7F6] py-16">

    <div class="max-w-6xl mx-auto text-center mb-16 px-6">

        <div class="inline-block bg-[#D8E6E0] text-[#1E5631] px-4 py-1 rounded-lg text-sm mb-4 font-medium">
            Informasi Pendaftaran
        </div>

        <h2 class="text-2xl font-semibold text-[#1E5631] mb-2">
            Yang Perlu Anda Ketahui
        </h2>

        <p class="text-sm text-gray-600 mb-10">
            Informasi lengkap mengenai persyaratan, jadwal, alur, dan biaya pendaftaran
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">

            {{-- LOOP DATA DARI DATABASE (IKON POJOK KIRI ATAS) --}}
@foreach($informasi as $item)
<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group overflow-hidden text-left relative">
    
    {{-- 
        KOTAK IKON (POJOK KIRI ATAS):
        - Menghapus items-center agar default ke kiri (left).
        - Tetap menggunakan bg-[#1E5631] untuk kotak hijau.
    --}}
    <div class="w-14 h-14 bg-[#1E5631] rounded-2xl flex items-center justify-center p-3 mb-6 group-hover:rotate-6 transition-transform duration-500 shadow-md">
        <img src="{{ asset('images/ikon_dokumen.png') }}" alt="Ikon Dokumen" class="w-full h-full object-contain">
    </div>

    {{-- KONTEN TEKS (RATA KIRI SESUAI DESAIN) --}}
    <div>
        <h4 class="font-bold text-[#1E5631] mb-3 text-lg uppercase tracking-wider leading-tight">
            {{ $item->judul }}
        </h4>
        
        {{-- List Persyaratan --}}
        <div class="text-xs text-gray-600 leading-relaxed space-y-1">
            {{-- Menggunakan nl2br agar format baris baru di database tetap terjaga --}}
            {!! nl2br(e($item->deskripsi)) !!}
        </div>
    </div>
    
</div>
@endforeach

        </div>
    </div>

    <div class="max-w-6xl mx-auto text-center px-6">

        <div class="inline-block bg-[#D8E6E0] text-[#1E5631] px-4 py-1 rounded-lg text-sm mb-4 font-medium">
            Alur Pendaftaran
        </div>

        <h2 class="text-2xl font-semibold text-[#1E5631] mb-2">
            Langkah Pendaftaran
        </h2>

        <p class="text-sm text-gray-600 mb-10">
            Ikuti langkah-langkah berikut untuk menyelesaikan pendaftaran!
        </p>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 text-left">

            <div class="bg-white p-5 rounded-xl shadow-sm relative border border-gray-100">
                <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md">
                    1
                </div>
               <div class="w-12 h-12 bg-[#D8E6E0] rounded-xl mb-4 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                👤
            </div>
                <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Buat Akun</h4>
                <p class="text-[11px] text-gray-500 leading-relaxed">
                    Daftarkan akun baru dengan mengisi data diri yang valid untuk memulai proses pendaftaran.
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm relative border border-gray-100">
                <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md">
                    2
                </div>
                <div class="w-12 h-12 bg-[#D8E6E0] rounded-xl mb-4 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                🔑
            </div>
                <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Login</h4>
                <p class="text-[11px] text-gray-500 leading-relaxed">
                    Silakan masuk menggunakan email dan kata sandi yang telah didaftarkan.
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm relative border border-gray-100">
                <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md">
                    3
                </div>
                <div class="w-12 h-12 bg-[#D8E6E0] rounded-xl mb-4 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                📝
            </div>
                <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Isi Formulir</h4>
                <p class="text-[11px] text-gray-500 leading-relaxed">
                    Lengkapi formulir online dengan data diri calon santri dan wali yang valid.
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm relative border border-gray-100">
                <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md">
                    4
                </div>
                <div class="w-12 h-12 bg-[#D8E6E0] rounded-xl mb-4 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                📤
            </div>
                <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Upload Dokumen</h4>
                <p class="text-[11px] text-gray-500 leading-relaxed">
                    Upload dokumen persyaratan seperti Pas Foto, KK, KTP Orang Tua, dan Ijazah.
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm relative border border-gray-100">
                <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md">
                    5
                </div>
                <div class="w-12 h-12 bg-[#D8E6E0] rounded-xl mb-4 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                🔔
            </div>
                <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Status</h4>
                <p class="text-[11px] text-gray-500 leading-relaxed">
                    Pantau status pendaftaran Anda secara berkala untuk mengetahui hasil seleksi.
                </p>
            </div>

        </div>

    </div>

</div>

<div class="bg-[#4F7C5C] text-white py-20 text-center px-6">
    @if($status)
        <h3 class="text-2xl font-semibold mb-4">
            Pendaftaran Santri Baru Telah Dibuka
        </h3>
    @else
        <h3 class="text-2xl font-semibold mb-4 text-red-300">
            Pendaftaran Saat Ini Ditutup
        </h3>
    @endif

    <p class="text-sm mb-8 max-w-xl mx-auto text-gray-200">
        Bergabunglah dengan ribuan santri kami dan mulai perjalanan
        pendidikan Anda di Pondok Pesantren Al-Mardliyyah
    </p>

    @if($status)
    <a href="{{ route('redirect.pendaftaran') }}"
        class="bg-[#C6A75E] text-[#1E5631] px-8 py-3 rounded-lg font-bold inline-block hover:bg-[#b59650] transition-colors shadow-lg active:scale-95">
        Daftar Sekarang
    </a>
    @else
    <button disabled
        class="bg-gray-400 text-white px-8 py-3 rounded-lg font-bold inline-block cursor-not-allowed">
        Pendaftaran Ditutup
    </button>
    @endif
    
</div>

@endsection

