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

    {{-- Grid Card Galeri --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
             @forelse($visibleGaleris as $index => $item)
            
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group flex flex-col h-full"
                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
                
                {{-- PERUBAHAN PENTING: Tambahkan cursor-pointer dan fungsi onclick="openModal()" di sini --}}
                <div class="relative w-full h-64 overflow-hidden shrink-0 cursor-pointer" onclick="openModal('{{ asset($item->gambar) }}')">
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                         
                    {{-- Efek overlay tipis yang elegan saat di-hover --}}
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300 flex items-center justify-center">
                        {{-- Tambahan Opsional: Icon Kaca Pembesar agar User tahu ini bisa diklik --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-grow justify-center text-center">
                    <h3 class="text-[#1E5631] font-bold text-lg leading-tight line-clamp-2 group-hover:text-[#c9a76d] transition-colors">
                        {{ $item->judul }}
                    </h3>
                </div>
                
            </div>
            @empty
                <div class="col-span-3 py-10 text-center text-gray-400">Belum ada foto galeri.</div>
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
        
        {{-- Grid Card Aktivitas Santri --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($aktivitas as $item)
            
            {{-- PERUBAHAN 1: Pembungkus utama disamakan persis dengan Berita & Fasilitas (pakai h-full & flex-col) --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group flex flex-col h-full"
                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
                
                {{-- PERUBAHAN 2: Gambar dibuat Full-bleed (tanpa padding putih), tinggi disamakan h-56 --}}
                <div class="relative w-full h-56 overflow-hidden shrink-0">
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                         
                    {{-- Efek overlay tipis elegan saat di-hover --}}
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                </div>

                {{-- PERUBAHAN 3: Area Teks menggunakan flex-grow agar mendesak ruang kosong ke bawah --}}
                <div class="p-6 flex flex-col flex-grow text-left">
                    
                    {{-- Judul dibatasi maksimal 2 baris (line-clamp-2). 
                         Aku tambahkan class 'uppercase' karena di gambarmu judulnya menggunakan huruf kapital semua --}}
                    {{-- Hapus uppercase, tracking-wide, dan line-clamp-2 --}}
<h3 class="text-[#1E5631] font-bold text-lg mb-3 leading-tight group-hover:text-[#c9a76d] transition-colors">
    {{ $item->nama_aktivitas }}
</h3>
                    
                    {{-- Deskripsi dibatasi paksa maksimal 4 baris persis seperti halaman Fasilitas --}}
                    {{-- Bungkus dengan relative untuk efek scroll dan gradasi --}}
<div class="relative mt-auto border-t border-gray-50 pt-3">
    {{-- Hapus line-clamp, gunakan max-h-32 dan custom-scrollbar --}}
    <div class="text-gray-500 text-sm leading-relaxed max-h-32 overflow-y-auto pr-3 pb-6 text-justify custom-scrollbar">
        {{ strip_tags($item->deskripsi) }}
    </div>

    <style>
    /* Styling untuk Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px; /* Dibuat sedikit lebih tipis (4px) khusus untuk dalam Card agar lebih manis */
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f8fafc; 
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1; 
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #1E5631; 
    }
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 #f8fafc;
    }
</style>
    
    {{-- Efek Kabut Putih (Fade) di bawah agar pengguna HP tahu bisa di-scroll --}}
    <div class="absolute bottom-0 left-0 right-0 h-8 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
</div>
                    
                </div>
                
            </div>
            @endforeach
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