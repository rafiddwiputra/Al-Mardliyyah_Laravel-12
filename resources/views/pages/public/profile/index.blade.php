@extends('layouts.app')

@section('title', 'Profil Pondok')

@php 
    $showCTA = true; 
@endphp

@section('content')

{{-- ================= HERO SECTION ================= --}}
<div id="hero" class="bg-[#1e4d2b] text-white py-28 relative overflow-hidden">
    {{-- Dekorasi Latar Belakang --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
    
    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <nav class="text-sm text-gray-300 mb-6 flex items-center gap-2">
            <a href="/" class="hover:text-white transition">Beranda</a> 
            <span class="opacity-50">></span> 
            <span class="font-semibold text-white">Profil</span>
        </nav>

        <h1 class="text-4xl md:text-6xl font-bold mb-6 tracking-tight">Profil Pondok</h1>

        <p class="text-lg md:text-xl text-gray-100 max-w-2xl leading-relaxed opacity-90">
            Pondok Pesantren Al-Mardliyyah adalah lembaga pendidikan Islam yang berkomitmen membentuk generasi Qur'ani yang berakhlak mulia, berilmu, dan siap menghadapi tantangan zaman.
        </p>
    </div>
</div>

{{-- ================= TAB NAVIGATION (ALPINE.JS + SCROLL SPY) ================= --}}
{{-- 
    Sticky di top-20 (menyesuaikan tinggi Navbar). 
    z-30 agar berada di atas konten tapi di bawah modal/dropdown jika ada.
--}}
<div class="bg-white border-b sticky top-20 z-30 shadow-sm" 
     x-data="{ 
        activeTab: 'sejarah',
        scrollTo(id) {
            const element = document.getElementById(id);
            if (element) {
                const offset = 160; {{-- Offset lebih besar agar judul section terlihat jelas --}}
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
     @scroll-spy.window="activeTab = $event.detail">
     
    <div class="max-w-6xl mx-auto px-6 flex justify-center gap-2 md:gap-6 py-4 overflow-x-auto no-scrollbar whitespace-nowrap">

        <button @click="scrollTo('sejarah')"
           :class="activeTab === 'sejarah' ? 'bg-[#1e4d2b] text-white shadow-md' : 'text-gray-500 hover:bg-gray-100'"
           class="px-8 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
            Sejarah
        </button>

        <button @click="scrollTo('pimpinan')"
           :class="activeTab === 'pimpinan' ? 'bg-[#1e4d2b] text-white shadow-md' : 'text-gray-500 hover:bg-gray-100'"
           class="px-8 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
            Pimpinan
        </button>

        <button @click="scrollTo('legalitas')"
           :class="activeTab === 'legalitas' ? 'bg-[#1e4d2b] text-white shadow-md' : 'text-gray-500 hover:bg-gray-100'"
           class="px-8 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
            Legalitas
        </button>

        <button @click="scrollTo('fasilitas')"
           :class="activeTab === 'fasilitas' ? 'bg-[#1e4d2b] text-white shadow-md' : 'text-gray-500 hover:bg-gray-100'"
           class="px-8 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
            Fasilitas
        </button>

    </div>
</div>

{{-- ================= SEJARAH SECTION ================= --}}
<section id="sejarah" class="py-24 bg-[#FAFAFA] scroll-mt-32">
    <div class="max-w-4xl mx-auto px-6">
        
        <div class="text-center mb-20">
            <span class="bg-[#e2ede5] text-[#1e4d2b] px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest mb-4 inline-block">Milestone</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1e4d2b] mb-3">Sejarah Pondok</h2>
            <p class="text-gray-500 text-base md:text-lg">Lebih dari 40 tahun pengabdian dalam dunia pendidikan Islam</p>
        </div>

        <div class="relative">
            {{-- Garis Tengah Timeline --}}
            <div class="absolute left-6 top-0 h-full w-[2px] bg-[#1e4d2b]/10"></div>

            <div class="space-y-12">
                @foreach($timelines as $item)
                <div class="relative flex items-start gap-12 group">
                    {{-- Titik Timeline --}}
                    <div class="z-10 w-12 h-12 flex items-center justify-center bg-transparent shrink-0">
                        <div class="w-6 h-6 rounded-full bg-[#1e4d2b] border-4 border-white shadow-md transition-transform group-hover:scale-150 duration-500"></div>
                    </div>

                    {{-- Konten Card --}}
                    <a href="{{ route('profile.sejarah.detail', $item->tahun) }}" class="flex-1 block">
                        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                            <h3 class="text-3xl font-black text-[#c9a76d] mb-2">
                                {{ $item->tahun }}
                            </h3>
                            
                            <h4 class="text-xl font-bold text-[#1e4d2b] mb-4">
                                {{ $item->judul }}
                            </h4>
                            
                            <p class="text-gray-600 text-sm leading-relaxed mb-6">
                                {{ $item->deskripsi_singkat }}
                            </p>

                            <div class="text-[#1e4d2b] text-xs font-bold flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <span>Baca selengkapnya</span>
                                <span class="group-hover:translate-x-2 transition-transform">→</span>
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
<section id="pimpinan" class="py-24 bg-white scroll-mt-32">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-20">
             <span class="bg-[#e2ede5] text-[#1e4d2b] px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest mb-4 inline-block">Struktur Organisasi</span>
             <h2 class="text-3xl md:text-4xl font-bold text-[#1e4d2b]">Pimpinan Pondok</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($pimpinans as $p)
            <div class="bg-[#FAFAFA] rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group border border-gray-50 flex flex-col">
                
                {{-- Foto Pimpinan --}}
                <div class="h-80 overflow-hidden shrink-0 relative">
                    <img src="{{ asset($p->foto) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $p->nama }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>

                <div class="p-8 text-left flex flex-col flex-grow">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('images/calendar.png') }}" alt="Calendar" class="w-4 h-4 opacity-40">
                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                            Update: {{ $p->created_at->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    <p class="text-[11px] text-[#c9a76d] font-black uppercase mb-2 tracking-[0.2em]">{{ $p->jabatan }}</p>
                    <h3 class="text-[#1e4d2b] font-bold text-2xl mb-4 leading-tight line-clamp-2">
                        {{ $p->nama }}
                    </h3>
                    
                    <p class="text-gray-500 text-sm mb-8 leading-relaxed line-clamp-3 flex-grow italic">
                        "{{ $p->deskripsi }}"
                    </p>

                    <div class="mt-auto pt-6 border-t border-gray-100">
                        <a href="{{ route('profile.pimpinan.detail', $p->id) }}" 
                           class="text-[#1e4d2b] font-bold text-sm flex items-center gap-2 hover:gap-4 transition-all duration-300">
                            <span>Lihat Biografi</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= LEGALITAS SECTION ================= --}}
<section id="legalitas" class="py-24 bg-[#FAFAFA] scroll-mt-32 border-y border-gray-100">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-20">
            <div class="inline-block bg-[#1e4d2b] text-white px-5 py-2 rounded-xl mb-4 text-[10px] font-bold uppercase tracking-[0.2em]">
                Verified
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1e4d2b] mb-4">Legalitas Pondok</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Dokumen resmi dan izin operasional sebagai jaminan akuntabilitas lembaga.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-16">
            {{-- Bagian ini bisa dibuat dinamis jika nanti ada tabel legalitas --}}
            @for ($i = 1; $i <= 4; $i++)
            <div class="bg-white p-10 rounded-[2rem] shadow-sm border border-gray-50 flex items-start gap-8 hover:shadow-xl transition-all duration-500 group">
                <div class="w-16 h-16 bg-[#e2ede5] text-[#1e4d2b] flex items-center justify-center rounded-2xl text-3xl shrink-0 group-hover:bg-[#1e4d2b] group-hover:text-white transition-colors duration-500">
                    📄
                </div>
                <div class="text-left">
                    <h3 class="text-[#1e4d2b] font-bold text-xl mb-1">Izin Operasional</h3>
                    <p class="text-[#c9a76d] font-black text-sm uppercase tracking-wider mb-3">No: 123/ABC/2020</p>
                    <p class="text-gray-500 text-sm leading-relaxed">Terdaftar resmi di Kementerian Agama RI dan memenuhi standar kualifikasi nasional.</p>
                </div>
            </div>
            @endfor
        </div>

        <div class="bg-[#1e4d2b] p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full translate-x-1/2 -translate-y-1/2"></div>
            <p class="text-white text-lg md:text-xl font-medium leading-relaxed relative z-10 italic">
                "Seluruh dokumen legalitas telah terverifikasi dan memenuhi standar pemerintah, menjamin keamanan proses belajar mengajar serta kepercayaan masyarakat luas."
            </p>
        </div>
    </div>
</section>

{{-- ================= FASILITAS SECTION ================= --}}
<section id="fasilitas" class="py-24 bg-white scroll-mt-32">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-20">
            <span class="bg-[#e2ede5] text-[#1e4d2b] px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest mb-4 inline-block">Sarana & Prasarana</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1e4d2b] mb-4">Fasilitas Pondok</h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-base">Fasilitas memadai untuk mendukung kenyamanan ibadah dan belajar santri.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($fasilitas as $f)
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-3 flex flex-col hover:shadow-2xl transition-all duration-500 group">
                <div class="w-full h-64 bg-gray-50 rounded-[1.5rem] overflow-hidden mb-6">
                    <img src="{{ asset($f->gambar) }}" 
                         alt="{{ $f->nama_fasilitas }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>

                <div class="px-5 pb-8 text-left">
                    <h3 class="text-[#1e4d2b] font-bold text-xl mb-2">{{ $f->nama_fasilitas }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $f->deskripsi }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= VIDEO PROFIL SECTION ================= --}}
@if($video)
<section id="video" class="py-24 bg-[#FAFAFA] scroll-mt-32">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <span class="bg-[#e2ede5] text-[#1e4d2b] px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest mb-4 inline-block">Multimedia</span>
        <h2 class="text-3xl md:text-4xl font-bold text-[#1e4d2b] mb-4">Video Profil</h2>
        
        <div class="max-w-4xl mx-auto mt-16">
            <a href="{{ $video->link_yt }}" target="_blank" class="block group relative">
                <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-gray-100 transition-all duration-500 group-hover:-translate-y-2">
                    {{-- Thumbnail --}}
                    <div class="relative aspect-video overflow-hidden">
                        <img src="{{ asset($video->thumbnail) }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                        {{-- Overlay Play --}}
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                            <div class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center transition-transform duration-500 group-hover:scale-125">
                                <div class="w-0 h-0 border-t-[15px] border-t-transparent border-l-[25px] border-l-white border-b-[15px] border-b-transparent ml-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="p-10 text-left">
                        <h3 class="text-2xl font-bold text-[#1e4d2b] mb-3">{{ $video->judul }}</h3>
                        <p class="text-gray-500 leading-relaxed mb-6">{{ $video->deskripsi }}</p>
                        <div class="text-[#1e4d2b] font-bold text-sm flex items-center gap-2 group-hover:text-[#c9a76d]">
                            Tonton di YouTube <span class="group-hover:translate-x-3 transition-transform">→</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ================= JAVASCRIPT ================= --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        {{-- List ID section yang akan dipantau --}}
        const sectionIds = ['sejarah', 'pimpinan', 'legalitas', 'fasilitas'];
        
        const observerOptions = {
            root: null,
            {{-- Offset menyesuaikan posisi sticky navbar --}}
            rootMargin: '-200px 0px -40% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    {{-- Trigger event Alpine.js untuk update tab aktif --}}
                    window.dispatchEvent(new CustomEvent('scroll-spy', { 
                        detail: entry.target.id 
                    }));
                }
            });
        }, observerOptions);

        sectionIds.forEach(id => {
            const el = document.getElementById(id);
            if (el) observer.observe(el);
        });
    });
</script>

@endsection