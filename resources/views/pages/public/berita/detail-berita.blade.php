@extends('layouts.app')

@section('title', $berita->judul . ' - Al-Mardliyyah')

@section('content')

@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp

<div class="bg-[#1E5631] text-white px-6 md:px-20 py-20">
    <div class="max-w-6xl mx-auto">
        <p class="text-sm mb-4 opacity-80 text-white">
            <a href="/" class="hover:underline">Beranda</a> > 
            <a href="{{ route('berita') }}" class="hover:underline">Berita</a> > 
            Detail
        </p>
        <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight">Detail Berita & Kegiatan</h1>
    </div>
</div>

<div class="max-w-4xl mx-auto py-16 px-6">

    <h2 class="text-3xl md:text-5xl font-extrabold text-[#1E5631] mb-6 leading-tight">
        {{ $berita->judul }}
    </h2>

    <div class="flex items-center gap-4 text-sm text-gray-500 mb-10 border-b border-gray-100 pb-6">
        
        <div class="flex items-center gap-2 font-medium">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 text-[#1E5631]"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M8 7V4m8 3V4m-9 7h10m-11 9h12a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />

            </svg>

            <span>
                {{ $berita->tanggal_publish
                    ? $berita->tanggal_publish->translatedFormat('l, d F Y')
                    : $berita->created_at->translatedFormat('l, d F Y') }}
            </span>

        </div>

        <div class="text-gray-300">|</div>
        <div class="flex items-center gap-2">
            <span class="text-[#c9a76d] font-bold uppercase tracking-widest text-[10px]">Oleh: Admin Pondok</span>
        </div>
    </div>

    <div class="mb-12">
        <img src="{{ Str::startsWith($berita->gambar, 'http') ? $berita->gambar : asset($berita->gambar) }}"
             class="w-full h-auto max-h-[600px] object-cover rounded-[2.5rem] shadow-2xl border-4 border-white">
    </div>

    {{-- 
        Gunakan {!! !!} agar jika nanti di Admin kamu pakai Text Editor (CKEditor/TinyMCE), 
        format HTML seperti Bold, Italic, atau List tetap muncul dengan benar.
    --}}
    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed mb-20">
        {!! nl2br($berita->deskripsi) !!}
    </div>

    <div class="text-center mb-24">
        <a href="{{ route('berita') }}"
           class="inline-flex items-center gap-3 bg-[#1E5631] hover:bg-[#153d22] text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg active:scale-95">
            <span class="text-lg">←</span> Kembali ke Berita
        </a>
    </div>

</div>

<div class="bg-gray-50 py-24 px-6 border-t border-gray-100">
    <div class="max-w-6xl mx-auto">
        
        <div class="text-center mb-16">
            <span class="bg-[#D8E6E0] text-[#1E5631] px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest">Rekomendasi</span>
            <h2 class="text-3xl font-bold mt-6 text-[#1E5631]">Berita Terkait</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Variabel $beritaTerkait dikirim dari BeritaController --}}
            @foreach($beritaTerkait as $item)
            <div onclick="window.location='{{ route('berita.detail', $item->id) }}'"
     class="bg-white border border-gray-100 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer group">

                <div class="h-48 overflow-hidden relative">
                    <img src="{{ Str::startsWith($item->gambar, 'http') ? $item->gambar : asset($item->gambar) }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>

                <div class="p-6">

                    <div class="flex items-center gap-2 text-xs text-gray-400 font-bold mb-3 uppercase tracking-wider">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 text-[#1E5631]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M8 7V4m8 3V4m-9 7h10m-11 9h12a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />

                        </svg>

                        <span>
                            {{ $item->tanggal_publish
                                ? $item->tanggal_publish->translatedFormat('d M Y')
                                : $item->created_at->translatedFormat('d M Y') }}
                        </span>

                    </div>

                    <h3 class="font-bold text-[#1E5631] text-base mb-3 line-clamp-2 group-hover:text-[#c9a76d] transition-colors leading-tight">
                        {{ $item->judul }}
                    </h3>

                    <div class="text-[#1E5631] text-xs font-bold flex items-center gap-2">
                        Baca Artikel <span class="group-hover:translate-x-2 transition-transform">→</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection