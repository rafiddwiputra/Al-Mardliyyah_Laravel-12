@extends('layouts.app')

@php
    $showCTA = true;
@endphp

@section('title', 'Galeri Pondok - Al-Mardliyyah')

@section('content')

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

<div class="max-w-6xl mx-auto py-16 px-6">

   {{-- Filter Kategori: Animasi zoom-in --}}
    <div class="mb-16 max-w-6xl mx-auto px-6" data-aos="zoom-in" data-aos-duration="800">
        <div class="w-full bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] py-4 px-6 flex justify-center items-center gap-4 md:gap-10 flex-wrap relative -mt-16 z-20 border border-gray-50">
            
            <a href="{{ route('galeri', ['kategori' => 'semua']) }}"
               class="text-sm md:text-base font-bold capitalize transition-all duration-300 text-center
                      {{ $kategoriAktif == 'semua' ? 'bg-[#1E5631] text-white px-8 py-3 rounded-xl shadow-md' : 'text-gray-600 hover:text-[#1E5631] px-4 py-3' }}">
                Semua
            </a>

            @foreach($categories as $cat)
            <a href="{{ route('galeri', ['kategori' => $cat]) }}"
               class="text-sm md:text-base font-bold capitalize transition-all duration-300 text-center
                      {{ $kategoriAktif == $cat ? 'bg-[#1E5631] text-white px-8 py-3 rounded-xl shadow-md' : 'text-gray-600 hover:text-[#1E5631] px-4 py-3' }}">
                {{ $cat }}
            </a>
            @endforeach

        </div>
    </div>

    {{-- Grid Galeri --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($visibleGaleris as $index => $item)
        {{-- Card Galeri: Animasi fade-up secara berurutan dengan menggunakan sisa bagi $index untuk efek delay --}}
        <div class="group bg-white rounded-xl shadow-[0_3px_15px_rgb(0,0,0,0.06)] border border-gray-100 overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-500"
             data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 150 }}" data-aos-duration="800">
            
            <div class="w-full h-72 overflow-hidden relative">
                <img src="{{ Str::startsWith($item->gambar, 'http') ? $item->gambar : asset($item->gambar) }}"
                     alt="{{ $item->judul }}"
                     onclick="openModal(this.src)"
                     class="w-full h-full object-cover transition duration-700 cursor-pointer group-hover:scale-105">
                
                <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
            </div>

            <div class="p-6">
                <h3 class="text-lg font-bold text-[#1E5631] leading-tight hover:text-[#164227] transition-colors cursor-pointer">
                    {{ $item->judul }}
                </h3>
            </div>
        </div>
        @empty
        <div class="col-span-full py-24 text-center text-gray-400 italic font-medium bg-gray-50 rounded-xl border-2 border-dashed border-gray-100">
            Belum ada dokumentasi foto untuk kategori ini.
        </div>
        @endforelse
    </div>

    @if($page == 1 && $total > $perPage)
    <div class="text-center mt-16" data-aos="fade-up" data-aos-duration="600">
        <a href="{{ route('galeri', ['kategori' => $kategoriAktif, 'page' => 2]) }}"
           class="inline-block bg-[#1E5631] hover:bg-[#153d22] text-white px-10 py-3 rounded-xl font-semibold transition-all shadow-md hover:shadow-lg">
            Muat Lebih Banyak
        </a>
    </div>
    @endif
</div>

<div class="bg-gray-50 py-24 px-6 border-t border-gray-100">
    <div class="max-w-6xl mx-auto">
        
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4">
                <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">Kegiatan Unggulan</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mt-6 text-[#1E5631] tracking-tight text-center">
                Aktivitas Keseharian Santri
            </h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto text-sm md:text-base text-center">
                Pembiasaan karakter dan keterampilan spiritual melalui berbagai kegiatan rutin yang membentuk jati diri santri.
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($aktivitas as $index => $akt)
            {{-- Animasi fade-up berurutan pada Card Aktivitas --}}
            <div class="bg-white rounded-[2rem] shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 p-2 group flex flex-col h-full"
                 data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 150 }}" data-aos-duration="800">
                
                <img src="{{ $akt->gambar ? (Str::startsWith($akt->gambar, 'http') ? $akt->gambar : asset($akt->gambar)) : 'https://picsum.photos/400/300' }}" 
                     class="w-full h-44 object-cover rounded-[1.5rem] mb-4 cursor-pointer" 
                     onclick="openModal(this.src)">
                
                <div class="px-4 pb-4 flex flex-col flex-grow">
                    <h4 class="font-bold text-xl text-[#1E5631] mb-2 leading-tight uppercase">
                        {{ $akt->nama_aktivitas }}
                    </h4>
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mt-1">
                        {{ $akt->deskripsi }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-400 italic">
                Data aktivitas santri sedang disiapkan.
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Modal Gambar --}}
<div id="imageModal" onclick="closeModal()" class="fixed inset-0 bg-black/90 hidden z-[9999] items-center justify-center p-4 backdrop-blur-sm transition-all duration-300">
    <button onclick="closeModal()" class="absolute top-8 right-8 text-white/50 hover:text-white text-5xl font-light transition-colors">&times;</button>
    <img id="modalImage" onclick="event.stopPropagation()" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl scale-95 transition-transform duration-300">
</div>

{{-- Script Modal --}}
<script>
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