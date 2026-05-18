@extends('layouts.app')

@section('title', 'Profil Pondok')

@php 
    $showCTA = true; 
@endphp

@section('content')

{{-- ================= HERO SECTION ================= --}}
<div class="bg-[#1E5631] text-white px-6 md:px-20 py-20"
     data-aos="fade-down"
     data-aos-duration="1000">

    <div class="max-w-6xl mx-auto">

        <p class="text-sm mb-4 opacity-80 text-white">
            Beranda > Profil
        </p>

        <h1 class="text-4xl font-bold mb-4 text-white">
            Profil Pondok
        </h1>

        <p class="max-w-2xl text-base leading-relaxed opacity-90 text-gray-100">
            Pondok Pesantren Al-Mardliyyah adalah lembaga pendidikan Islam yang berkomitmen membentuk generasi Qur'ani yang berakhlak mulia, berilmu, dan siap menghadapi tantangan zaman.
        </p>

    </div>
</div>

{{-- ================= TAB NAVIGATION ================= --}}
<div class="bg-white border-b sticky top-20 z-30 shadow-sm" 
     x-data="{ 
        activeTab: 'sejarah',
        scrollTo(id) {
            const element = document.getElementById(id);
            if (element) {
                const offset = 160; 
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
     @scroll-spy.window="activeTab = $event.detail"
     data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
     
    <div class="max-w-6xl mx-auto px-6 flex justify-center gap-2 md:gap-6 py-4 overflow-x-auto no-scrollbar whitespace-nowrap">
        <button @click="scrollTo('sejarah')"
           :class="activeTab === 'sejarah' ? 'bg-[#1e4d2b] text-white shadow-md' : 'text-gray-500 hover:bg-gray-100'"
           class="px-8 py-2.5 rounded-lg  text-sm font-bold transition-all duration-300">
            Sejarah
        </button>

        <button @click="scrollTo('fasilitas')"
           :class="activeTab === 'fasilitas' ? 'bg-[#1e4d2b] text-white shadow-md' : 'text-gray-500 hover:bg-gray-100'"
           class="px-8 py-2.5 rounded-lg  text-sm font-bold transition-all duration-300">
            Fasilitas
        </button>

        <button @click="scrollTo('video')"
           :class="activeTab === 'video' ? 'bg-[#1e4d2b] text-white shadow-md' : 'text-gray-500 hover:bg-gray-100'"
           class="px-8 py-2.5 rounded-lg  text-sm font-bold transition-all duration-300">
            Video
        </button>
    </div>
</div>

{{-- ================= SEJARAH SECTION ================= --}}
<section id="sejarah" class="py-24 bg-white scroll-mt-32">
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- Header Section --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-[#1e4d2b] mb-4">Sejarah Pondok Pesantren Al-Mardliyyah</h2>
            <p class="text-gray-500 text-lg">Perjalanan berdirinya dan perkembangan Pondok Pesantren Al-Mardliyyah</p>
        </div>

        {{-- Hero Image Sejarah --}}
        <div class="mb-16" data-aos="zoom-in" data-aos-duration="1000">
            <div class="rounded-lg  overflow-hidden shadow-xl border-8 border-white">
                <img src="{{ asset('images/1985.png') }}" alt="Pembangunan Pondok" class="w-full h-auto object-cover hover:scale-105 transition-transform duration-700">
            </div>
        </div>

        {{-- Konten Artikel --}}
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-12">
            
            {{-- Latar Belakang --}}
            <div data-aos="fade-up">
                <h3 class="text-2xl font-bold text-[#1e4d2b] mb-4">Latar Belakang Berdirinya Pondok</h3>
                <p>
                    Pondok Pesantren Al-Mardliyyah atau juga dikenal dengan sebutan “Pondok Demangan” merupakan salah satu lembaga pendidikan Islam yang berada di Kota Madiun, lebih tepatnya di Jl. H. Moch Noer RT.01/RW.01, Kelurahan Demangan, Kecamatan Taman, Kota Madiun. Pondok pesantren ini didirikan oleh KH. Agus Mushoffa Izzuddin pada tanggal 27 Rajab 1431 H atau bertepatan dengan tahun 2010 M.
                </p>
                <p class="mt-4">
                    Pendirian pondok pesantren ini, dilatarbelakangi oleh keinginan kuat dari KH. Agus Mushoffa Izzuddin untuk mendirikan pesantren berbasis tahfidzul qur’an sebagai wadah bagi istrinya, Ibu Nyai Hj. Siti Alfiyah yang merupakan seorang hafidul qur’an untuk mengamalkan dan menyebarkan ilmu al-qur’an yang beliau miliki.
                </p>
            </div>

            <hr class="border-gray-100" data-aos="fade-in">

            {{-- Awal Berdiri --}}
            <div data-aos="fade-up">
                <h3 class="text-2xl font-bold text-[#1e4d2b] mb-4">Awal Berdiri</h3>
                <p class="mt-4">
                    Pondok Pesantren Al-Mardliyyah pada awalnya merupakan salah satu dari empat asrama yang berada di bawah naungan Yayasan Pendidikan Islam Mujaddadiyyah. Keempat asrama tersebut
                    adalah Asrama Gen-Q Al-Mujaddadiyyah, asrama Induk Putra, asrama Induk Putri dan asrama Tahfidzul Qur'an Al-Mardliyyah. 
                </p>
            </div>

            {{-- Quote Box --}}
            <div class="bg-[#FAFAFA] border-l-4 border-[#c9a76d] p-8 rounded-r-lg my-12 shadow-sm" data-aos="fade-right" data-aos-duration="1000">
                <svg class="w-10 h-10 text-[#c9a76d] opacity-30 mb-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21L14.017 18C14.017 16.899 14.899 16 16 16H19C19.103 16 19.204 16.007 19.303 16.022C19.123 13.945 18.027 12.65 16.195 12.147C15.639 11.996 15.222 11.517 15.148 10.941C15.074 10.365 15.353 9.81 15.834 9.511C18.231 8.019 20.301 8.52 21.684 11.124C22.42 12.518 22.75 14.301 22.75 16.5C22.75 19.011 20.914 21 18.75 21H14.017ZM1.25 21L1.25 18C1.25 16.899 2.131 16 3.232 16H6.232C6.335 16 6.436 16.007 6.535 16.022C6.355 13.945 5.259 12.65 3.427 12.147C2.871 11.996 2.454 11.517 2.38 10.941C2.306 10.365 2.585 9.81 3.066 9.511C5.463 8.019 7.533 8.52 8.916 11.124C9.652 12.518 9.982 14.301 9.982 16.5C9.982 19.011 8.146 21 5.982 21H1.25Z" />
                </svg>
                <p class="text-xl md:text-2xl font-bold text-[#1e4d2b] italic leading-tight">
                    "Mencetak generasi berakhlak mulia dan berilmu, yang mampu memberikan manfaat bagi agama, bangsa, dan negara"
                </p>
                <p class="mt-4 text-gray-500 font-semibold">— Visi KH. Ahmad Mardliyyah</p>
            </div>

            <hr class="border-gray-100" data-aos="fade-in">

            {{-- Perkembangan Pondok --}}
            <div data-aos="fade-up">
                <h3 class="text-2xl font-bold text-[#1e4d2b] mb-4">Perkembangan Pondok</h3>
                <p>
                    Pondok pesantren Al-Mardliyyah pada awalnya merupakan salah satu dari empat asrama yang berada di bawah naungan Yayasan Pendidikan Islam Al-Mujaddadiyyah. Keempat asrama tersebut adalah Asrama Gen-Q Al-Mujaddadiyyah, asrama Induk Putra, asrama Induk Putri dan asrama Tahfidzul Qur’an Al-Mardliyyah. laundry dan pertanian. Serta beberapa kegiatan dalam bidang kesenian seperti: qira’ah, hadrah, muhadharah, barongsai, paduan suara dan juga kaligrafi yang bertujuan mengembangkan potensi, minat dan bakat santri.
                </p>
                <p class="mt-4">
                    Hingga saat ini, tercatat lebih dari 700 santri yang berdomisili dan menimba ilmu di Pondok Pesantren Al-Mardliyyah. Para santri tersebut tidak hanya berasal dari wilayah Pulau Jawa, tetapi juga dari daerah lain di Indonesia seperti Sumatra, Riau, Jambi, Lampung dan Kalimantan. Hal tersebut menunjukkan luasnya cakupan dan kepercayaan masyarakat terhadap eksistensi pondok pesantren ini.
                </p>
                <p class="mt-4">
                    Seiring berjalannya waktu serta perkembangan yang pesat, baik dari segi jumlah santri maupun cakupan program pendidikan yang diselenggarakan. Berdasarkan Keputusan Direktur Jenderal Pendidikan Islam pada tanggal 11 Mei 2021, Pondok Pesantren Al-Mardliyyah secara resmi diakui dan tercatat di Kementerian Agama Republik Indonesia dengan Nomor Statistik 965, menggunakan nama resmi “Pondok Pesantren Al-Mardliyyah”.
                </p>
                <p class="mt-4 font-semibold text-[#1e4d2b]">
                    Meskipun telah berdiri sebagai  yayasan  pendidikan Islam yang mandiri dan tercatat secara resmi, Pondok Pesantren Al-Mardliyyah tetap berada di bawah naungan besar Pondok Pesantren Al-Mujaddadiyyah. Oleh karena itu, secara kelembagaan dan historis, pondok ini masih dikenal oleh masyarakat luas dengan nama Pondok Pesantren Al-Mardliyyah Al-Mujaddadiyyah.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- ================= FASILITAS SECTION ================= --}}
<section id="fasilitas" class="py-24 bg-gray-50 scroll-mt-32">
    <div class="max-w-6xl mx-auto px-6">
        {{-- Header Fasilitas --}}
        <div class="text-center mb-20" data-aos="fade-up">
            <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4">
                <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">Sarana & Prasarana</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1e4d2b] mb-4">Fasilitas Pondok</h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-base">Fasilitas lengkap dan modern untuk mendukung pembelajaran optimal</p>
        </div>

        {{-- Grid Card Fasilitas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($fasilitas as $f)
            {{-- PERUBAHAN 1: Hapus p-3, ganti ke rounded-2xl, dan pastikan ada flex-col h-full --}}
            <div class="bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group flex flex-col h-full"
                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
                
                {{-- PERUBAHAN 2: Bagian Gambar (Full-bleed / Tanpa jarak putih di pinggir) --}}
                <div class="relative w-full h-56 overflow-hidden shrink-0">
                    <img src="{{ asset($f->gambar) }}" alt="{{ $f->nama_fasilitas }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    {{-- Tambahan Estetika: Efek overlay tipis agar persis seperti Card Berita --}}
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                </div>

                {{-- PERUBAHAN 3: Bagian Konten menggunakan p-6 dan flex-grow --}}
                <div class="p-6 flex flex-col flex-grow text-left">
                    {{-- Judul dibatasi maksimal 2 baris agar jika panjang, tidak merusak layout --}}
                    <h3 class="text-[#1E5631] font-bold text-xl mb-3 leading-tight line-clamp-2">
                        {{ $f->nama_fasilitas }}
                    </h3>
                    
                    {{-- Deskripsi dibatasi paksa maksimal 4 baris --}}
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-4">
                        {{ strip_tags($f->deskripsi) }}
                    </p>
                </div>
                
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= VIDEO PROFIL SECTION ================= --}}
@if(isset($videos) && $videos->count() > 0)
<section id="video" class="py-24 bg-white scroll-mt-32 overflow-hidden border-t border-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        
        {{-- Header Video --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="bg-[#e2ede5] text-[#1e4d2b] px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest mb-4 inline-block">Multimedia</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1e4d2b] mb-4">Video Profil Pesantren</h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-base">Dokumentasi visual kegiatan dan profil Pondok Pesantren Al-Mardliyyah</p>
        </div>

        {{-- Container Slider --}}
        <div class="max-w-5xl mx-auto" data-aos="zoom-in" data-aos-duration="1000">
            <div class="swiper videoSwiper rounded-lg shadow-2xl border border-gray-100 overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach($videos as $v)
                    <div class="swiper-slide bg-white">
                        <a href="{{ $v->link_yt }}" target="_blank" class="block group">
                            <div class="relative aspect-video overflow-hidden">
                                {{-- Thumbnail --}}
                                <img src="{{ asset('storage/' . $v->thumbnail) }}" 
                                     class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                                
                                {{-- Overlay Play Button --}}
                                <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                    <svg class="w-20 h-20 md:w-24 md:h-24 text-red-600 drop-shadow-2xl" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                </div>
                            </div>

                            {{-- Konten Teks di bawah Video --}}
                            <div class="p-10 text-left">
                                <h3 class="text-2xl md:text-3xl font-bold text-[#1e4d2b] mb-3">{{ $v->judul }}</h3>
                                <p class="text-gray-500 leading-relaxed text-lg mb-6 line-clamp-2">{{ $v->deskripsi }}</p>
                                <div class="text-[#1e4d2b] font-bold text-sm flex items-center gap-2 group-hover:text-[#c9a76d] transition-colors">
                                    Tonton Video Lengkap <span class="group-hover:translate-x-3 transition-transform">→</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                {{-- Navigasi --}}
                <div class="swiper-button-prev !text-[#1e4d2b] after:!text-xl font-bold"></div>
                <div class="swiper-button-next !text-[#1e4d2b] after:!text-xl font-bold"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

    </div>
</section>
@endif

{{-- ================= JAVASCRIPT ================= --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sectionIds = ['sejarah', 'fasilitas', 'video'];
        
        const observerOptions = {
            root: null,
            rootMargin: '-200px 0px -40% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
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

    const swiper = new Swiper('.videoSwiper', {
        loop: true,
        autoplay: {
            delay: 5000, 
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
    });
</script>

@endsection