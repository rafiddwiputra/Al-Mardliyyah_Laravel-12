@extends('layouts.app')

@php
    $showCTA = true;
@endphp

@section('title', 'Galeri Pondok - Al-Mardliyyah')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<div class="bg-[#1E5631] text-white px-6 md:px-20 py-20" data-aos="fade-down" data-aos-duration="1000">
    <div class="max-w-6xl mx-auto">
        <p class="text-sm mb-4 opacity-80 text-white">Beranda > Galeri</p>
        <h1 class="text-4xl font-bold mb-4 tracking-tight text-white">Galeri Pondok</h1>
        <p class="max-w-2xl text-sm md:text-base leading-relaxed opacity-90 text-gray-100">
            Dokumentasi kegiatan sehari-hari santri, proses pembelajaran, fasilitas penunjang, 
            dan berbagai acara penting di Pondok Pesantren Al-Mardliyyah.
        </p>
    </div>
</div>

<div class="max-w-6xl mx-auto pt-6 pb-16 md:pt-10 md:pb-16 px-0 md:px-6">

    {{-- ================= FILTER KATEGORI ================= --}}
    <div class="mb-10 md:mb-12 w-full max-w-6xl mx-auto px-4 md:px-0" data-aos="fade-up" data-aos-duration="800">
        
        {{-- Menggunakan flex-wrap untuk PC agar turun ke bawah jika penuh, dan overflow-x-auto untuk HP --}}
        <div class="flex md:flex-wrap justify-start md:justify-center items-center gap-2 md:gap-3 overflow-x-auto pb-2 md:pb-0 hide-scroll">
            
            <a href="{{ route('galeri', ['kategori' => 'semua']) }}"
               class="whitespace-nowrap shrink-0 text-sm md:text-base font-semibold capitalize transition-all duration-300 px-6 py-2.5 rounded-xl border
                      {{ $kategoriAktif == 'semua' 
                         ? 'bg-[#1E5631] border-[#1E5631] text-white shadow-md' 
                         : 'bg-white border-gray-200 text-gray-500 hover:border-[#1E5631] hover:text-[#1E5631] hover:bg-[#f2f7f4]' }}">
                Semua
            </a>

            @foreach($categories as $cat)
            <a href="{{ route('galeri', ['kategori' => $cat]) }}"
               class="whitespace-nowrap shrink-0 text-sm md:text-base font-semibold capitalize transition-all duration-300 px-6 py-2.5 rounded-xl border
                      {{ $kategoriAktif == $cat 
                         ? 'bg-[#1E5631] border-[#1E5631] text-white shadow-md' 
                         : 'bg-white border-gray-200 text-gray-500 hover:border-[#1E5631] hover:text-[#1E5631] hover:bg-[#f2f7f4]' }}">
                {{ $cat }}
            </a>
            @endforeach

        </div>
    </div>

   {{-- ================= GRID GALERI (GAMBAR MEMANJANG, TEKS RINGKAS) ================= --}}
    <div class="grid md:grid-cols-3 gap-6 md:gap-8 px-4 md:px-0">
        
        @forelse($visibleGaleris as $index => $item)
        {{-- Logika JavaScript: Otomatis menyembunyikan item ke-7 (index >= 6) ke atas agar pas 2 baris --}}
        <div class="galeri-item {{ $index >= 3 ? 'hidden' : '' }} bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group flex flex-col h-full"
             data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
            
            {{-- Gambar (Diatur agar lebih memanjang ke bawah dengan proporsi 4:5) --}}
            <div class="relative w-full aspect-[4/5] overflow-hidden shrink-0 cursor-pointer" onclick="openModal('{{ asset($item->gambar) }}')">
                <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                     
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300 flex items-center justify-center">
                    {{-- Icon Kaca Pembesar Efek Zoom Smooth --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-10 md:w-10 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-md scale-50 group-hover:scale-100 transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            {{-- Judul Teks (Ruang kosong dibuang, tinggi menyesuaikan teks secara alami) --}}
            <div class="p-4 md:p-5 flex flex-col justify-center text-left border-t border-gray-50 bg-white">
                <h3 class="text-[#1E5631] font-bold text-sm md:text-base leading-snug line-clamp-3 group-hover:text-[#4a855d] transition-colors">
                    {{ $item->judul }}
                </h3>
            </div>
            
        </div>
        @empty
            <div class="col-span-full py-16 text-center text-gray-400 italic text-sm">Belum ada foto galeri di kategori ini.</div>
        @endforelse

    </div>

    </div>

    {{-- ================= TOMBOL MUAT (VERSI JAVASCRIPT INSTAN) ================= --}}
    @if(count($visibleGaleris) > 3)
    {{-- Mengubah mt-16 menjadi mt-24 dan menambahkan mb-8 agar jarak atas-bawah lebih lega --}}
    <div class="text-center mt-24 mb-8 flex flex-wrap justify-center items-center gap-4" data-aos="fade-up" data-aos-duration="600">
        
        <button id="btnLoadLess" onclick="tampilkanLebihSedikit()"
           class="hidden bg-white border-2 border-[#1E5631] text-[#1E5631] hover:bg-[#1E5631] hover:text-white px-8 md:px-10 py-2.5 md:py-3 rounded-xl font-bold transition-all shadow-sm hover:shadow-lg text-sm md:text-base active:scale-95">
            &larr; Muat Lebih Sedikit
        </button>

        <button id="btnLoadMore" onclick="tampilkanSemua()"
           class="bg-[#1E5631] hover:bg-[#153d22] border-2 border-[#1E5631] text-white px-8 md:px-10 py-2.5 md:py-3 rounded-xl font-bold transition-all shadow-md hover:shadow-lg text-sm md:text-base active:scale-95">
            Muat Lebih Banyak &rarr;
        </button>

    </div>
    @endif
</div>

{{-- ================= AKTIVITAS KESEHARIAN SANTRI ================= --}}
<div class="bg-gray-50 py-24 px-6 border-t border-gray-100">
    <div class="max-w-6xl mx-auto">
        
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4">
                <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">Kegiatan Unggulan</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1E5631] tracking-tight text-center">
                Aktivitas Keseharian Santri
            </h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto text-sm md:text-base text-center">
                Pembiasaan karakter dan keterampilan spiritual melalui berbagai kegiatan rutin yang membentuk jati diri santri.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($aktivitas as $item)
            <div class="bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group flex flex-col h-full"
                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
                
                <div class="relative w-full h-72 overflow-hidden shrink-0 border-b border-gray-100 bg-gray-100">
    
    {{-- LAYERS: Gambar Asli Memenuhi Kotak (Style Berita) --}}
    <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_aktivitas }}" 
         class="relative z-10 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
         
    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300 z-20"></div>
</div>

                <div class="p-6 flex flex-col flex-grow text-left">
                    <h3 class="text-[#1E5631] font-bold text-lg mb-3 leading-tight group-hover:text-[#c9a76d] transition-colors">
                        {{ $item->nama_aktivitas }}
                    </h3>
                    
                    <div class="relative mt-auto border-t border-gray-50 pt-3">
                        <div class="text-gray-500 text-sm leading-relaxed max-h-32 overflow-y-auto pr-3 pb-6 text-justify custom-scrollbar">
                            {{ strip_tags($item->deskripsi) }}
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 h-8 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
                    </div>
                </div>
                
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ================= MODAL LIGHTBOX POPUP GAMBAR ================= --}}
<div id="imageModal" onclick="closeModal()" class="fixed inset-0 bg-black/90 hidden z-[9999] items-center justify-center p-4 backdrop-blur-sm transition-all duration-300">
    <button onclick="closeModal()" class="absolute top-8 right-8 text-white/50 hover:text-white text-5xl font-light transition-colors">&times;</button>
    <img id="modalImage" onclick="event.stopPropagation()" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl scale-95 transition-transform duration-300">
</div>

{{-- ================= GLOBAL CSS UTILITIES ================= --}}
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f8fafc; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #1E5631; }
    .custom-scrollbar { scrollbar-width: thin; scrollbar-color: #cbd5e1 #f8fafc; }

    /* Utility untuk menyembunyikan scrollbar bawaan browser tapi tetap bisa di-scroll */
    .hide-scroll::-webkit-scrollbar { 
        display: none; 
    }
    .hide-scroll { 
        -ms-overflow-style: none; 
        scrollbar-width: none; 
    }
</style>



<script>
    // 1. FUNGSI LOGIKA TOMBOL MUAT LEBIH BANYAK / SEDIKIT
    function tampilkanSemua() {
        let items = document.querySelectorAll('.galeri-item');
        
        // Buka paksa status tersembunyi
        items.forEach(item => {
            item.classList.remove('hidden');
        });

        // Tukar visibilitas tombol kontrol
        document.getElementById('btnLoadMore').classList.add('hidden');
        document.getElementById('btnLoadLess').classList.remove('hidden');
    }

    function tampilkanLebihSedikit() {
        let items = document.querySelectorAll('.galeri-item');
        
        // Kunci kembali item ke-4 dan seterusnya
        items.forEach((item, index) => {
            if (index >= 3) { // <--- UBAH ANGKA INI JADI 3
                item.classList.add('hidden'); 
            }
        });

        // Kembalikan tombol kontrol seperti semula
        document.getElementById('btnLoadLess').classList.add('hidden');
        document.getElementById('btnLoadMore').classList.remove('hidden');
        
        // Efek UX: Otomatis scroll mulus ke atas
        window.scrollTo({ top: 350, behavior: 'smooth' });
    }

    // 2. FUNGSI POPUP MODAL LIGHTBOX GAMBAR
    function openModal(src) {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('modalImage');
        img.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => { img.classList.remove('scale-95'); img.classList.add('scale-100'); }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('modalImage');
        img.classList.remove('scale-100'); img.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }, 200);
    }
</script>

@endsection