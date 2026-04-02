@extends('layouts.app')

@section('title', 'Profil Pondok')

@php 
    $showCTA = true; 
@endphp

@section('content')

{{-- ================= HERO SECTION ================= --}}
<div class="bg-[#1e4d2b] text-white py-28">
    <div class="max-w-6xl mx-auto px-6">
        <nav class="text-sm text-gray-300 mb-3">
            <a href="/" class="hover:text-white transition">Beranda</a> 
            <span class="mx-2">></span> 
            <span class="font-semibold text-white">Profil</span>
        </nav>

        <h1 class="text-4xl md:text-5xl font-bold mb-6">Profil Pondok</h1>

        <p class="text-lg text-gray-100 max-w-2xl leading-relaxed opacity-90">
            Pondok Pesantren Al-Mardliyyah adalah lembaga pendidikan Islam yang berkomitmen membentuk generasi Qur'ani yang berakhlak mulia, berilmu, dan siap menghadapi tantangan zaman.
        </p>
    </div>
</div>

{{-- ================= TAB NAVIGATION DENGAN ALPINE.JS ================= --}}
<div class="bg-white border-b sticky top-16 z-30 shadow-sm" 
     x-data="{ 
        activeTab: 'sejarah',
        {{-- Fungsi untuk scroll halus saat diklik --}}
        scrollTo(id) {
            const element = document.getElementById(id);
            if (element) {
                const offset = 140; {{-- Jarak agar judul tidak tertutup navbar --}}
                const bodyRect = document.body.getBoundingClientRect().top;
                const elementRect = element.getBoundingClientRect().top;
                const elementPosition = elementRect - bodyRect;
                const offsetPosition = elementPosition - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }
     }"
     {{-- Event listener untuk menangkap perubahan tab dari scroll --}}
     @scroll-spy.window="activeTab = $event.detail">
     
    <div class="max-w-6xl mx-auto px-6 flex justify-center gap-2 md:gap-6 py-4 overflow-x-auto whitespace-nowrap">

        {{-- TAB SEJARAH --}}
        <button @click="scrollTo('sejarah')"
           :class="activeTab === 'sejarah' ? 'bg-[#1e4d2b] text-white shadow-md' : 'text-gray-500 hover:bg-gray-100'"
           class="px-8 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
            Sejarah
        </button>

        {{-- TAB PIMPINAN --}}
        <button @click="scrollTo('pimpinan')"
           :class="activeTab === 'pimpinan' ? 'bg-[#1e4d2b] text-white shadow-md' : 'text-gray-500 hover:bg-gray-100'"
           class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
            Pimpinan
        </button>

        {{-- TAB LEGALITAS --}}
        <button @click="scrollTo('legalitas')"
           :class="activeTab === 'legalitas' ? 'bg-[#1e4d2b] text-white shadow-md' : 'text-gray-500 hover:bg-gray-100'"
           class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
            Legalitas
        </button>

        {{-- TAB FASILITAS --}}
        <button @click="scrollTo('fasilitas')"
           :class="activeTab === 'fasilitas' ? 'bg-[#1e4d2b] text-white shadow-md' : 'text-gray-500 hover:bg-gray-100'"
           class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
            Fasilitas
        </button>

    </div>
</div>

{{-- ================= SEJARAH SECTION ================= --}}
<section id="sejarah" class="py-24 bg-[#FAFAFA] scroll-mt-20">
    <div class="max-w-4xl mx-auto px-6">
        
        <div class="text-center mb-20">
            <h2 class="text-3xl font-bold text-[#1e4d2b] mb-3">Sejarah Pondok</h2>
            <p class="text-gray-500 text-lg">Lebih dari 40 tahun pengabdian dalam dunia pendidikan Islam</p>
        </div>

        <div class="relative">
            <div class="absolute left-6 top-0 h-full w-[2px] bg-[#1e4d2b]/20"></div>

            <div class="space-y-10">
                {{-- HAPUS BLOK @php $timelines = [...] @endphp YANG LAMA DI SINI --}}

                @foreach($timelines as $item)
                <div class="relative flex items-start gap-12 group">
                    <div class="z-10 w-12 h-12 flex items-center justify-center bg-transparent shrink-0">
                        <div class="w-6 h-6 rounded-full bg-[#1e4d2b] border-4 border-white shadow-sm transition-transform group-hover:scale-125 duration-300"></div>
                    </div>

                    {{-- Link ke Detail menggunakan ID atau Tahun dari Database --}}
                    <a href="{{ route('profile.sejarah.detail', $item->tahun) }}" class="flex-1 block">
                        <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            {{-- Nama kolom disesuaikan dengan Migration kamu (tahun, judul, deskripsi_singkat) --}}
                            <h3 class="text-2xl font-bold text-[#c9a76d] mb-1">
                                {{ $item->tahun }}
                            </h3>
                            
                            <h4 class="text-lg font-bold text-[#1e4d2b] mb-3">
                                {{ $item->judul }}
                            </h4>
                            
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                {{ $item->deskripsi_singkat }}
                            </p>

                            <div class="text-[#1e4d2b] text-xs font-bold flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                Baca selengkapnya <span>→</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ================= PIMPINAN SECTION ================= --}}
<section id="pimpinan" class="py-24 bg-white scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        {{-- ... header section (judul/badge) tetap seperti kode kamu ... --}}

        {{-- Pastikan class grid-cols-1, md:grid-cols-3, dan gap-10 ini ada --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($pimpinans as $p)
            <div class="bg-[#FAFAFA] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100 flex flex-col">
                
                {{-- FOTO (Pastikan tingginya dibatasi dengan h-64 atau h-72) --}}
                <div class="h-64 md:h-72 overflow-hidden shrink-0">
                    <img src="{{ asset($p->foto) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $p->nama }}">
                </div>

                <div class="p-8 text-left flex flex-col flex-grow">
                    {{-- TANGGAL & KALENDER --}}
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/calendar.png') }}" alt="Calendar" class="w-4 h-4 shrink-0">
                        <span class="text-xs text-gray-500 font-medium">
                            {{ $p->created_at->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    {{-- JABATAN & NAMA --}}
                    <p class="text-[10px] text-[#c9a76d] font-bold uppercase mb-2 tracking-widest">{{ $p->jabatan }}</p>
                    <h3 class="text-[#1e4d2b] font-bold text-xl mb-4 leading-tight min-h-[3rem] line-clamp-2">
                        {{ $p->nama }}
                    </h3>
                    
                    {{-- DESKRIPSI (Line clamp agar tinggi kartu sama) --}}
                    <p class="text-gray-600 text-sm mb-8 leading-relaxed line-clamp-3 flex-grow">
                        {{ $p->deskripsi }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('profile.pimpinan.detail', $p->id) }}" 
                           class="text-[#1e4d2b] font-bold text-sm flex items-center gap-2 hover:gap-4 transition-all group-hover:text-[#c9a76d]">
                            Baca Selengkapnya <span>→</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= LEGALITAS ================= --}}
<section id="legalitas" class="py-24 bg-[#FAFAFA] scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <div class="inline-block bg-[#e2ede5] text-[#1e4d2b] px-5 py-2 rounded-lg mb-4 text-sm font-bold uppercase tracking-wider">
            Legalitas
        </div>
        <h2 class="text-3xl font-bold text-[#1e4d2b] mb-4">Legalitas Pondok</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-16">Data resmi yayasan dan izin operasional lembaga.</p>

        <div class="grid md:grid-cols-2 gap-8 mb-12">
            @for ($i = 1; $i <= 4; $i++)
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex items-start gap-6 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-[#1e4d2b] text-white flex items-center justify-center rounded-xl text-2xl shrink-0">
                    📄
                </div>
                <div class="text-left">
                    <h3 class="text-[#1e4d2b] font-bold text-lg">Izin Operasional</h3>
                    <p class="text-[#c9a76d] font-bold text-sm mt-1">No: 123/ABC/2020</p>
                    <p class="text-gray-500 text-sm mt-2">Terdaftar resmi di Kementerian Agama sebagai lembaga pendidikan Islam sah.</p>
                </div>
            </div>
            @endfor
        </div>

        <div class="bg-[#e2ede5] p-8 rounded-2xl border-l-8 border-[#1e4d2b]">
            <p class="text-[#1e4d2b] text-sm md:text-base font-medium leading-relaxed">
                "Seluruh dokumen legalitas telah terverifikasi dan memenuhi standar pemerintah, menjamin kualitas serta kepercayaan masyarakat."
            </p>
        </div>
    </div>
</section>

{{-- ================= FASILITAS PONDOK ================= --}}
<section id="fasilitas" class="py-24 bg-white scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <div class="inline-block bg-[#e2ede5] text-[#1e4d2b] px-5 py-1.5 rounded-md mb-4 text-xs font-bold uppercase tracking-wider">
            Fasilitas
        </div>
        <h2 class="text-3xl font-bold text-[#1e4d2b] mb-4">Fasilitas Pondok</h2>
        <p class="text-gray-500 max-w-2xl mx-auto mb-16 text-sm">Fasilitas lengkap dan modern untuk mendukung pembelajaran optimal</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($fasilitas as $f)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-1 flex flex-col hover:shadow-md transition duration-300">
                {{-- GAMBAR FASILITAS --}}
                <div class="w-full h-48 bg-gray-100 rounded-t-lg mb-6 overflow-hidden">
                    <img src="{{ asset($f->gambar) }}" 
                         alt="{{ $f->nama_fasilitas }}" 
                         class="w-full h-full object-cover">
                </div>

                {{-- KONTEN --}}
                <div class="px-5 pb-8 text-left">
                    <h3 class="text-[#1e4d2b] font-bold text-lg mb-1">{{ $f->nama_fasilitas }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $f->deskripsi }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= VIDEO PROFIL SECTION ================= --}}
<section id="video" class="py-24 bg-[#FAFAFA] scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        
        <div class="inline-block bg-[#e2ede5] text-[#1e4d2b] px-6 py-1.5 rounded-md mb-4 text-xs font-bold uppercase tracking-wider">
            Video
        </div>

        @if($video)
        <h2 class="text-3xl font-bold text-[#1e4d2b] mb-4">{{ $video->judul }}</h2>
        <p class="text-gray-500 max-w-2xl mx-auto mb-12 text-sm">{{ $video->deskripsi }}</p>

        <div class="max-w-3xl mx-auto">
            <a href="{{ $video->link_yt }}" target="_blank" rel="noopener noreferrer" class="block">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group cursor-pointer transition-transform hover:-translate-y-1">
                    
                    <div class="relative w-full aspect-video overflow-hidden">
                        {{-- Thumbnail dari database --}}
                        <img src="{{ asset($video->thumbnail) }}" 
                             alt="Thumbnail Video" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <div class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <div class="w-20 h-20 transition-transform duration-300 group-hover:scale-110">
                                <svg viewBox="0 0 24 24" fill="red" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814z" />
                                    <path d="M9.545 15.568V8.432L15.818 12l-6.273 3.568z" fill="white" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 text-left">
                        <h3 class="text-xl font-bold text-[#1e4d2b] mb-3">{{ $video->judul }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">{{ $video->deskripsi }}</p>
                        <div class="inline-flex items-center text-[#1e4d2b] text-sm font-bold gap-2 group-hover:text-[#c9a76d] transition-colors">
                            Klik untuk menonton <span class="transition-transform group-hover:translate-x-2">→</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @else
        <p class="text-gray-400">Video profil belum tersedia.</p>
        @endif
    </div>
</section>

<!-- Scroll Spy Script untuk update activeTab berdasarkan scroll -->
 <script>
    document.addEventListener('DOMContentLoaded', () => {
        const sections = ['sejarah', 'pimpinan', 'legalitas', 'fasilitas'];
        
        const observerOptions = {
            root: null,
            {{-- Deteksi ketika bagian sudah masuk 40% dari layar --}}
            rootMargin: '-150px 0px -40% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    {{-- Kirim sinyal ke Alpine.js untuk ubah tab aktif --}}
                    window.dispatchEvent(new CustomEvent('scroll-spy', { 
                        detail: entry.target.id 
                    }));
                }
            });
        }, observerOptions);

        {{-- Mulai mengawasi setiap section --}}
        sections.forEach(id => {
            const el = document.getElementById(id);
            if (el) observer.observe(el);
        });
    });
</script>

@endsection