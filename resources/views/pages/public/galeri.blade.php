@extends('layouts.app')

@section('title', 'Galeri Pondok - Al-Mardliyyah')

@section('content')

<div class="bg-[#1E5631] text-white px-6 md:px-20 py-20">
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

    <div class="flex justify-center gap-3 mb-12 flex-wrap">
        {{-- Link Semua Kategori --}}
        <a href="{{ route('galeri', ['kategori' => 'semua']) }}"
           class="px-5 py-2 rounded-xl text-sm font-medium transition-all duration-300 {{ $kategoriAktif == 'semua' ? 'bg-[#1E5631] text-white shadow-lg' : 'bg-gray-100 text-[#1E5631] hover:bg-gray-200' }}">
            Semua
        </a>

        {{-- Looping Kategori dari Database --}}
        @foreach($categories as $cat)
        <a href="{{ route('galeri', ['kategori' => $cat->slug]) }}"
           class="px-5 py-2 rounded-xl text-sm font-medium transition-all duration-300 {{ $kategoriAktif == $cat->slug ? 'bg-[#1E5631] text-white shadow-lg' : 'bg-gray-100 text-[#1E5631] hover:bg-gray-200' }}">
            {{ $cat->nama_kategori }}
        </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($visibleGaleris as $item)
        <div class="group bg-white rounded-[2rem] shadow-md border border-gray-100 p-3 text-center hover:shadow-xl transition-all duration-300">
            
            {{-- Container Gambar Utama --}}
            <div class="w-full h-56 bg-gray-100 rounded-[1.5rem] mb-5 overflow-hidden shadow-inner relative">
                <img src="{{ Str::startsWith($item->gambar, 'http') ? $item->gambar : asset($item->gambar) }}"
                     alt="{{ $item->judul }}"
                     onclick="openModal(this.src)"
                     class="w-full h-full object-cover transition duration-500 cursor-pointer group-hover:scale-110">
            </div>

            {{-- Judul Foto --}}
            <h3 class="text-base font-bold text-[#1E5631] px-2 mb-2 leading-tight">
                {{ $item->judul }}
            </h3>
        </div>
        @empty
        <div class="col-span-full py-20 text-center text-gray-400 italic">
            Belum ada dokumentasi foto untuk kategori ini.
        </div>
        @endforelse
    </div>

    {{-- Hanya muncul jika total foto > 3 dan masih di halaman 1 --}}
    @if($page == 1 && $total > $perPage)
    <div class="text-center mt-16">
        <a href="{{ route('galeri', ['kategori' => $kategoriAktif, 'page' => 2]) }}"
           class="inline-block bg-[#1E5631] hover:bg-[#153d22] text-white px-10 py-3 rounded-xl font-semibold transition-all shadow-md hover:shadow-lg">
            Muat Lebih Banyak
        </a>
    </div>
    @endif
</div>

<div class="bg-gray-50 py-24 px-6 border-t border-gray-100">
    <div class="max-w-6xl mx-auto">
        
        <div class="text-center mb-16">
            <span class="bg-[#D8E6E0] text-[#1E5631] text-[10px] font-extrabold px-4 py-1.5 rounded-full uppercase tracking-widest">
                Kegiatan Unggulan
            </span>
            <h2 class="text-3xl md:text-4xl font-bold mt-6 text-[#1E5631] tracking-tight text-center">
                Aktivitas Keseharian Santri
            </h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto text-sm md:text-base text-center">
                Pembiasaan karakter dan keterampilan spiritual melalui berbagai kegiatan rutin yang membentuk jati diri santri.
            </p>
        </div>
        
        {{-- Grid Aktivitas Santri --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($aktivitas as $akt)
            <div class="bg-white rounded-[2rem] shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 p-2 group">
                
                {{-- Gambar Aktivitas --}}
                <img src="{{ $akt->gambar ? (Str::startsWith($akt->gambar, 'http') ? $akt->gambar : asset($akt->gambar)) : 'https://picsum.photos/400/300' }}" 
                     class="w-full h-44 object-cover rounded-[1.5rem] mb-4 cursor-pointer" 
                     onclick="openModal(this.src)">
                
                <div class="px-4 pb-4">
                    {{-- Nama Aktivitas --}}
                    <h4 class="font-bold text-xl text-[#1E5631] mb-2 leading-tight uppercase">
                        {{ $akt->nama_aktivitas }}
                    </h4>
                    {{-- Deskripsi (dengan line-clamp agar rapi) --}}
                    <p class="text-gray-500 text-xs leading-relaxed line-clamp-2">
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

{{-- Bagian CTA untuk Pendaftaran Santri Baru --}}
<div class="bg-[#1E5631] relative overflow-hidden text-white py-24 text-center">
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="relative z-10 px-6">
        <h3 class="text-3xl font-bold mb-6 text-white">Mulai Masa Depan Gemilang di Sini</h3>
        <p class="text-sm md:text-base mb-10 max-w-xl mx-auto opacity-80 leading-relaxed text-gray-200">
            Pendaftaran Santri Baru Al-Mardliyyah telah dibuka. Mari bergabung bersama 
            keluarga besar kami untuk mendalami ilmu agama dan pengetahuan umum.
        </p>
        <a href="{{ route('register') }}"
           class="bg-[#C6A75E] hover:bg-[#b59650] text-[#1E5631] px-10 py-3 rounded-full font-bold transition-all shadow-xl inline-block">
            Daftar Sekarang
        </a>
    </div>
</div>

{{-- Modal Gambar --}}
<div id="imageModal" onclick="closeModal()" class="fixed inset-0 bg-black/90 hidden z-[9999] items-center justify-center p-4 backdrop-blur-sm transition-all duration-300">
    <button onclick="closeModal()" class="absolute top-8 right-8 text-white/50 hover:text-white text-5xl font-light transition-colors">&times;</button>
    <img id="modalImage" onclick="event.stopPropagation()" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl scale-95 transition-transform duration-300">
</div>

{{-- Script untuk membuka dan menutup modal gambar --}}
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