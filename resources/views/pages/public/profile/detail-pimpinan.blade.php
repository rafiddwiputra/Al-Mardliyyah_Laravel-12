@extends('layouts.app')

@section('title', 'Profil Pimpinan - ' . ($pimpinan['nama'] ?? 'Al-Mardliyyah'))

@section('content')

{{-- ================= HERO SECTION ================= --}}
<div class="bg-[#1e4d2b] text-white py-20">
    <div class="max-w-6xl mx-auto px-6">
        {{-- Breadcrumb Modern --}}
        <nav class="text-sm mb-6 opacity-80">
            <a href="/" class="hover:underline">Beranda</a> 
            <span class="mx-2">></span> 
            <a href="{{ route('profile') }}" class="hover:underline">Profil</a>
            <span class="mx-2">></span> 
            <span class="font-semibold">Pimpinan</span>
        </nav>

        {{-- Judul Hero --}}
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Detail Pimpinan</h1>

        {{-- Deskripsi Hero --}}
        <p class="max-w-3xl text-lg leading-relaxed opacity-90">
            Informasi lengkap mengenai sosok pimpinan dan pengasuh Pondok Pesantren Al-Mardliyyah yang membimbing santri menjadi generasi Qur'ani.
        </p>
    </div>
</div>

{{-- ================= KONTEN UTAMA ================= --}}
<article class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- Judul Section --}}
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-[#1e4d2b]">Pimpinan Pondok</h2>
        </div>

        {{-- Garis Pembatas Tipis --}}
        <div class="w-full h-[1px] bg-gray-200 mb-12"></div>

        {{-- HEADER KONTEN --}}
        <div class="mb-8">
            <h3 class="text-2xl md:text-3xl font-bold text-[#1e4d2b] mb-4">
                {{ $pimpinan['nama'] }}
            </h3>
            
            {{-- Tanggal Update dengan Icon --}}
            <div class="flex items-center gap-3 text-[#c9a76d] font-bold mb-10">
                <span class="text-xl">📅</span>
                <span>{{ $pimpinan['tanggal'] }}</span>
            </div>

           {{-- FOTO PIMPINAN (Framing Megah) --}}
<div class="rounded-2xl overflow-hidden shadow-2xl mb-12 border border-gray-100 max-w-2xl mx-auto">
    {{-- Ganti 'gambar' menjadi 'foto' sesuai kolom di database --}}
    <img src="{{ asset($pimpinan->foto) }}" 
         alt="{{ $pimpinan->nama }}" 
         class="w-full h-auto object-cover hover:scale-105 transition-transform duration-700">
</div>

            {{-- BIOGRAFI / DESKRIPSI --}}
            <div class="space-y-6 text-gray-600 leading-relaxed text-lg text-justify">
    <p>{!! nl2br(e($pimpinan->deskripsi)) !!}</p>
</div>

            {{-- TOMBOL KEMBALI --}}
            <div class="mt-20 flex justify-center border-t border-gray-100 pt-10">
                <a href="{{ route('profile') }}" 
                   class="bg-[#1e4d2b] text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-[#16472a] hover:-translate-y-1 transition-all flex items-center gap-3">
                    <span>←</span> Kembali ke Profil Pondok
                </a>
            </div>
        </div>

    </div>
</article>

@endsection