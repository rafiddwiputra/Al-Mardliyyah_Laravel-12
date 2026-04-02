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
        
        {{-- Header Sejarah --}}
        <div class="text-center mb-20">
            <h2 class="text-3xl font-bold text-[#1e4d2b] mb-3">Sejarah Pondok</h2>
            <p class="text-gray-500 text-lg">Lebih dari 40 tahun pengabdian dalam dunia pendidikan Islam</p>
        </div>

        {{-- TIMELINE CONTAINER --}}
        <div class="relative">
            {{-- Garis Vertical --}}
            <div class="absolute left-6 top-0 h-full w-[2px] bg-[#1e4d2b]/20"></div>

            <div class="space-y-10">
                @php
                    $timelines = [
                        [
                            'year' => '1985', 
                            'title' => 'Pendirian Pondok', 
                            'desc' => 'Pondok Pesantren Al-Mardliyyah didirikan dengan santri perdana sebanyak 30 orang di atas lahan seluas 2 hektar'
                        ],
                        [
                            'year' => '1992', 
                            'title' => 'Pembangunan Masjid Utama', 
                            'desc' => 'Diresmikan masjid utama dengan kapasitas 500 jamaah sebagai pusat kegiatan ibadah dan pembelajaran'
                        ],
                        [
                            'year' => '2000', 
                            'title' => 'Penambahan Program Tahfidz', 
                            'desc' => 'Diluncurkan program Tahfidz Al-Qur\'an intensif dengan target hafalan 30 juz dalam 3 tahun'
                        ],
                        [
                            'year' => '2010', 
                            'title' => 'Perluasan Fasilitas', 
                            'desc' => 'Pembangunan asrama baru, ruang kelas modern, dan perpustakaan digital untuk mendukung pembelajaran'
                        ],
                        [
                            'year' => '2018', 
                            'title' => 'Akreditasi A', 
                            'desc' => 'Meraih akreditasi A dari Kementrian Agama dan berbagai prestasi di tingkat nasional.'
                        ],
                        [
                            'year' => '2026', 
                            'title' => 'Santri Lebih dari 1000', 
                            'desc' => 'Berkembang menjadi salah satu pesantren terbesar di wilayah Kota Madiun dengan lebih dari 1000 santri aktif'
                        ],
                    ];
                @endphp

               @foreach($timelines as $item)
<div class="relative flex items-start gap-12 group">
    {{-- Titik Lingkaran Hijau --}}
    <div class="z-10 w-12 h-12 flex items-center justify-center bg-transparent shrink-0">
        <div class="w-6 h-6 rounded-full bg-[#1e4d2b] border-4 border-white shadow-sm transition-transform group-hover:scale-125 duration-300"></div>
    </div>

    {{-- KONTEN CARD (Dibungkus Link agar bisa diklik) --}}
    <a href="{{ route('profile.sejarah.detail', ['tahun' => $item['year']]) }}" class="flex-1 block">
        <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer">
            {{-- Tahun (Warna Emas) --}}
            <h3 class="text-2xl font-bold text-[#c9a76d] mb-1">
                {{ $item['year'] }}
            </h3>
            
            {{-- Judul Kegiatan (Warna Hijau) --}}
            <h4 class="text-lg font-bold text-[#1e4d2b] mb-3">
                {{ $item['title'] }}
            </h4>
            
            {{-- Deskripsi Singkat --}}
            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                {{ $item['desc'] }}
            </p>

            {{-- Indikator Klik (Opsional agar user tahu ini bisa diklik) --}}
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

{{-- ================= PIMPINAN ================= --}}
<section id="pimpinan" class="py-24 bg-white scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <div class="inline-block bg-[#e2ede5] text-[#1e4d2b] px-5 py-2 rounded-lg mb-4 text-sm font-bold uppercase tracking-wider">
            Kepemimpinan
        </div>
        <h2 class="text-3xl font-bold text-[#1e4d2b] mb-4">Pimpinan Pondok</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-16 leading-relaxed">
            Pimpinan Pondok Pesantren Al-Mardliyyah merupakan sosok yang berperan penting dalam membimbing karakter santri.
        </p>

        <div class="grid md:grid-cols-3 gap-10">
            @for ($i = 1; $i <= 3; $i++)
            <div class="bg-[#FAFAFA] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100">
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('images/pimpinan1.jpg') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Pimpinan">
                </div>
                <div class="p-6 text-left">
                    <p class="text-xs text-gray-400 mb-2 font-medium">Pengurus Utama</p>
                    <h3 class="text-[#1e4d2b] font-bold text-xl mb-3">KH. Ahmad Fauzi</h3>
                    <p class="text-gray-600 text-sm mb-6 line-clamp-2">Memimpin pesantren dengan visi membentuk generasi Qur’ani yang unggul.</p>
                    <a href="#" class="text-[#1e4d2b] font-bold text-sm flex items-center gap-2 hover:gap-4 transition-all">
                        Baca Profil Lengkap <span>→</span>
                    </a>
                </div>
            </div>
            @endfor
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
        {{-- Badge --}}
        <div class="inline-block bg-[#e2ede5] text-[#1e4d2b] px-5 py-1.5 rounded-md mb-4 text-xs font-bold uppercase tracking-wider">
            Fasilitas
        </div>
        <h2 class="text-3xl font-bold text-[#1e4d2b] mb-4">Fasilitas Pondok</h2>
        <p class="text-gray-500 max-w-2xl mx-auto mb-16 text-sm">Fasilitas lengkap dan modern untuk mendukung pembelajaran optimal</p>

        {{-- Grid Fasilitas --}}
        <div class="grid md:grid-cols-3 gap-8">
            @php
                $fasilitas = [
                    ['name' => 'Asrama Santri', 'desc' => 'Asrama nyaman dengan kapasitas 500 santri'],
                    ['name' => 'Masjid Utama', 'desc' => 'Masjid megah dengan kapasitas 500 jamaah'],
                    ['name' => 'Ruang Kelas Modern', 'desc' => '24 ruang ber-AC dengan fasilitas multimedia'],
                    ['name' => 'Perpustakaan', 'desc' => 'Koleksi lebih dari 5000 buku dan kitab'],
                    ['name' => 'Lapangan Olahraga', 'desc' => 'Lapangan futsal, basket, dan voli'],
                    ['name' => 'Laboratorium Komputer', 'desc' => '40 unit komputer dengan internet berkecepatan tinggi'],
                ];
            @endphp

            @foreach($fasilitas as $f)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-1 flex flex-col hover:shadow-md transition duration-300">
                {{-- Placeholder Gambar Fasilitas --}}
                <div class="w-full h-48 bg-gray-100 rounded-t-lg mb-6 overflow-hidden">
                    {{-- Ganti src jika sudah ada gambarnya --}}
                    <div class="w-full h-full bg-gray-50"></div> 
                </div>
                <div class="px-5 pb-8 text-left">
                    <h3 class="text-[#1e4d2b] font-bold text-lg mb-1">{{ $f['name'] }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $f['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= VIDEO PROFIL SECTION ================= --}}
<section id="video" class="py-24 bg-[#FAFAFA] scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        
        {{-- Badge Video --}}
        <div class="inline-block bg-[#e2ede5] text-[#1e4d2b] px-6 py-1.5 rounded-md mb-4 text-xs font-bold uppercase tracking-wider">
            Video
        </div>

        {{-- Judul & Deskripsi --}}
        <h2 class="text-3xl font-bold text-[#1e4d2b] mb-4">Vidio Profil Pondok</h2>
        <p class="text-gray-500 max-w-2xl mx-auto mb-12 text-sm">Lihat profil Pondok Pesantren Al-Mardliyyah melalui vidio berikut</p>

       {{-- CARD VIDEO --}}
<div class="max-w-3xl mx-auto">
    {{-- Tambahkan 'group' pada pembungkus utama agar hover terdeteksi --}}
    <a href="https://www.youtube.com/watch?v=VIDEO_ID_KAMU" target="_blank" rel="noopener noreferrer" class="block">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group cursor-pointer transition-transform hover:-translate-y-1">
            
            {{-- THUMBNAIL VIDEO --}}
            <div class="relative w-full aspect-video overflow-hidden">
                <img src="{{ asset('images/video-pondok.png') }}" 
                     alt="Thumbnail Vidio Profil" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                
                {{-- OVERLAY LOGO YOUTUBE (Muncul saat Hover) --}}
                <div class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                    {{-- Ikon YouTube menggunakan SVG agar tajam --}}
                    <div class="w-20 h-20 transition-transform duration-300 group-hover:scale-110">
                        <svg viewBox="0 0 24 24" fill="red" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814z" />
                            <path d="M9.545 15.568V8.432L15.818 12l-6.273 3.568z" fill="white" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- KONTEN TEKS VIDEO --}}
            <div class="p-8 text-left">
                <h3 class="text-xl font-bold text-[#1e4d2b] mb-3">
                    Profil Pondok Pesantren Al-Mardliyyah
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">
                    Video singkat yang menampilkan kegiatan, fasilitas, dan kehidupan santri di pondok pesantren.
                </p>
                
                <div class="inline-flex items-center text-[#1e4d2b] text-sm font-bold gap-2 group-hover:text-[#c9a76d] transition-colors">
                    Klik untuk menonton 
                    <span class="transition-transform group-hover:translate-x-2">→</span>
                </div>
            </div>

        </div>
    </a>
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