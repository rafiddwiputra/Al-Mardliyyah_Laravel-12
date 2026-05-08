@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section class="relative h-screen w-full flex items-center justify-center overflow-hidden">
    
    {{-- SLIDER BACKGROUND --}}
    <div class="absolute inset-0 z-0 overflow-hidden">
        <div id="slider-container" class="flex w-full h-full transition-transform duration-1000 ease-in-out">
            @forelse($banners as $b)
                <div class="w-full h-full flex-shrink-0 relative slide-item" data-title="{{ $b->judul }}">
                    <img src="{{ asset($b->gambar) }}" class="w-full h-full object-cover" alt="Banner">
                    <div class="absolute inset-0 bg-black/60"></div> {{-- Dipergelap sedikit agar teks putih lebih kontras --}}
                </div>
            @empty
                <div class="w-full h-full flex-shrink-0 relative slide-item" data-title="Mari Menjadi Generasi Penerus yang Berjiwa Islami dan Berwawasan Luas">
                    <img src="{{ asset('images/default-banner.jpg') }}" class="w-full h-full object-cover" alt="Background">
                    <div class="absolute inset-0 bg-black/60"></div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- FOREGROUND TEXT --}}
    <div class="relative z-10 text-center px-6 sm:px-8 max-w-4xl mx-auto w-full mt-10 md:mt-0" data-aos="zoom-in" data-aos-duration="1000">
        
        {{-- Logo --}}
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo-pondok.png') }}" alt="Logo" class="w-24 md:w-36 drop-shadow-2xl">
        </div>

        {{-- Judul Utama (Diperbesar untuk Mobile) --}}
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white mb-4 drop-shadow-lg leading-snug tracking-wide uppercase">
            Pondok Pesantren <br class="hidden md:block"> Al-Mardliyyah
        </h1>
        
        {{-- Tagline --}}
        <p id="banner-tagline" class="text-gray-200 text-sm md:text-xl mb-10 md:mb-12 font-medium transition-opacity duration-500 opacity-90 px-2 leading-relaxed max-w-2xl mx-auto uppercase tracking-widest">
            {{ $banners->first()?->judul ?? 'Pendaftaran Calon Santri Baru 2026/2027 Telah Dibuka' }}
        </p>

        {{-- TOMBOL: Ditumpuk atas-bawah di HP seperti referensi --}}
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 w-full max-w-sm mx-auto sm:max-w-none">
            <a href="{{ url('/pendaftaran') }}" class="w-full sm:w-auto text-center bg-[#C6A75E] text-white px-8 py-3.5 rounded-lg font-bold shadow-lg hover:bg-[#b5954a] transition uppercase text-sm md:text-base animate-heartbeat">
                Daftar Sekarang
            </a>
            <a href="{{ route('profile') }}" class="w-full sm:w-auto text-center border-2 border-white text-white px-8 py-3.5 rounded-lg font-bold shadow-lg hover:bg-white hover:text-[#1E5631] transition uppercase text-sm md:text-base backdrop-blur-sm bg-white/10">
                Lihat Profil
            </a>
        </div>
    </div>
</section>

{{-- LEMBAGA PENDIDIKAN --}}
<section class="py-12 md:py-16 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 grid md:grid-cols-2 gap-8 md:gap-10 items-center">

        {{-- GAMBAR (Masuk dari kiri) --}}
        <div data-aos="fade-right" data-aos-duration="1000" class="order-2 md:order-1 mt-6 md:mt-0">
            <img src="{{ asset('images/logo.jpg') }}" 
            class="rounded-xl shadow-md w-full object-cover aspect-video md:aspect-auto">
        </div>

        {{-- TEKS (Masuk dari kanan) --}}
        <div data-aos="fade-left" data-aos-duration="1000" class="order-1 md:order-2 text-center md:text-left">
            <h2 class="text-2xl md:text-3xl font-bold text-[#1E5631] mb-3 md:mb-4">
                Latar Belakang Berdirinya Pondok
            </h2>

            <p class="text-gray-600 mb-6 leading-relaxed text-sm md:text-base text-justify md:text-left">
            Berawal dari keprihatinan mendalam terhadap kondisi pendidikan Islam di tahun 1980-an, 
            sekelompok ulama dan tokoh masyarakat berinisiatif mendirikan sebuah lembaga pendidikan yang mampu mencetak generasi muslim
            </p>

            <a href="{{ route('profile') }}" 
               class="inline-block bg-[#1E5631] text-white px-6 py-2 rounded-lg shadow hover:bg-[#17472a] transition">
                Selengkapnya
            </a>
        </div>

    </div>
</section>

{{-- DIVIDER --}}
<div class="flex items-center justify-center" data-aos="zoom-in" data-aos-duration="800">
    <div class="h-[2px] w-20 md:w-56 bg-[#C6A75E]"></div>
    <div class="w-2 h-2 bg-[#C6A75E] mx-3 md:mx-4 rotate-45 shrink-0"></div>
    <div class="h-[2px] w-20 md:w-56 bg-[#C6A75E]"></div>
</div>

{{-- VISI --}}
<section class="pt-12 md:pt-16 pb-6 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-xl md:text-2xl font-bold text-[#1E5631] mb-5" data-aos="fade-up">Visi & Misi</h2>

        <div class="mb-4 text-left" data-aos="fade-up" data-aos-duration="800">
            <div class="bg-gradient-to-r from-[#1E5631] to-[#2E8B57] text-white p-6 md:p-8 rounded-lg border-l-4 md:border-l-8 border-[#C6A75E] shadow-lg">
                <h3 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Visi</h3>
                <p class="text-sm md:text-base text-justify leading-relaxed">
                Melahirkan kader pemimpin yang sholeh dan berkarakter serta berjiwa interpreneur dalam membangun
                peradaban islam radhiyatan mardliyyah.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- MISI --}}
<section class="py-5 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 text-left">
            {{-- Misi Cards: Berurutan munculnya dengan delay --}}
            <div class="bg-white p-5 md:p-6 rounded-lg shadow border-t-4 border-[#1E5631]" data-aos="fade-up" data-aos-delay="100">
                <div class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center bg-[#C6A75E] rounded-full mb-3 md:mb-4">
                    <span class="text-[#1E5631] font-bold text-sm md:text-base">1</span>
                </div>
                <h4 class="text-[#1E5631] font-semibold mb-2">Misi 1</h4>
                <p class="text-xs md:text-sm text-justify leading-relaxed">
                    Menjadi pusat pembelajaran Al-Qur'an dan mempersiapkan kader hafidzul Qur'an yang beriman, bertaqwa, serta berakhlakul karimah.
                </p>
            </div>

            <div class="bg-white p-5 md:p-6 rounded-lg shadow border-t-4 border-[#1E5631]" data-aos="fade-up" data-aos-delay="200">
                <div class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center bg-[#C6A75E] rounded-full mb-3 md:mb-4">
                    <span class="text-[#1E5631] font-bold text-sm md:text-base">2</span>
                </div>
                <h4 class="text-[#1E5631] font-semibold mb-2">Misi 2</h4>
                <p class="text-xs md:text-sm text-justify leading-relaxed">
                    Menguasai tafakkuh fiddiin, pengetahuan dan memiliki daya saing, serta mampu mengembangkan diri di tengah masyarakat.
                </p>
            </div>

            <div class="bg-white p-5 md:p-6 rounded-lg shadow border-t-4 border-[#1E5631] sm:col-span-2 md:col-span-1" data-aos="fade-up" data-aos-delay="300">
                <div class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center bg-[#C6A75E] rounded-full mb-3 md:mb-4">
                    <span class="text-[#1E5631] font-bold text-sm md:text-base">3</span>
                </div>
                <h4 class="text-[#1E5631] font-semibold mb-2">Misi 3</h4>
                <p class="text-xs md:text-sm text-justify leading-relaxed">
                    Mendidik santri yang alim hikmah dan ilmiah.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- DIVIDER --}}
<div class="flex items-center justify-center mt-12 md:mt-16 mb-4 md:mb-6" data-aos="zoom-in" data-aos-duration="800">
    <div class="h-[2px] w-20 md:w-56 bg-[#C6A75E]"></div>
    <div class="w-2 h-2 bg-[#C6A75E] mx-3 md:mx-4 rotate-45 shrink-0"></div>
    <div class="h-[2px] w-20 md:w-56 bg-[#C6A75E]"></div>
</div>

{{-- PROGRAM --}}
<section class="pt-4 md:pt-6 pb-12 md:pb-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-lg md:text-xl font-semibold text-[#1E5631] mb-8 md:mb-10 text-center" data-aos="fade-up">
            Program Pendidikan
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 justify-items-center">
            @forelse($programs as $item)
                {{-- Diubah dari w-64 menjadi fleksibel mengikuti layar agar pas di HP --}}
                <div class="bg-white rounded-xl shadow-md overflow-hidden w-full max-w-[280px] sm:max-w-full hover:-translate-y-2 transition-transform duration-300" 
                     data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 150 }}"> 
                    <div class="h-3 bg-[#1E5631]"></div>
                    <div class="p-5 text-left">
                        <div class="w-8 h-8 md:w-9 md:h-9 bg-[#1E5631] text-white flex items-center justify-center rounded mb-3 md:mb-4 text-sm md:text-base">🏫</div>
                        <h3 class="text-sm md:text-base font-semibold text-[#1E5631] mb-2">
                            {{ $item->nama_program }}
                        </h3> 
                        <div class="text-xs md:text-sm text-gray-600 leading-relaxed">
                            {{ $item->deskripsi }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400 italic text-sm">
                    Belum ada program pendidikan yang dipublikasikan.
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- DIVIDER --}}
<div class="flex items-center justify-center my-12 md:my-16" data-aos="zoom-in" data-aos-duration="800">
    <div class="h-[2px] w-20 md:w-56 bg-[#C6A75E]"></div>
    <div class="w-2 h-2 bg-[#C6A75E] mx-3 md:mx-4 rotate-45 shrink-0"></div>
    <div class="h-[2px] w-20 md:w-56 bg-[#C6A75E]"></div>
</div>

{{-- BERITA --}}
<section class="pb-12 md:pb-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-lg md:text-xl font-semibold text-[#1E5631] mb-8 md:mb-10" data-aos="fade-up">
            Berita Terbaru
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
            @forelse($beritas as $news)
                <div class="bg-white rounded-xl shadow-md overflow-hidden text-left hover:shadow-lg transition duration-300 flex flex-col"
                     data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
                    <div class="w-full h-40 md:h-48 overflow-hidden bg-gray-100 shrink-0">
                        <img src="{{ $news->gambar ? (Str::startsWith($news->gambar, 'http') ? $news->gambar : asset($news->gambar)) : asset('images/berita-default.jpg') }}" 
                             alt="{{ $news->judul }}"
                             class="w-full h-full object-cover hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-4 md:p-5 flex flex-col flex-grow">
                        <p class="text-[10px] md:text-xs text-gray-500 mb-2">
                            {{ $news->created_at->translatedFormat('d F Y') }}
                        </p>
                        <h3 class="text-sm md:text-base font-semibold text-[#1E5631] mb-2 line-clamp-2 min-h-[40px]">
                            {{ $news->judul }}
                        </h3>
                        <p class="text-xs md:text-sm text-gray-600 mb-4 line-clamp-3 flex-grow">
                            @if($news->ringkasan)
                                {{ $news->ringkasan }}
                            @elseif($news->konten)
                                {{ Str::limit(strip_tags($news->konten), 100) }}
                            @elseif($news->deskripsi)
                                {{ Str::limit(strip_tags($news->deskripsi), 100) }}
                            @else
                                Tidak ada deskripsi tersedia.
                            @endif
                        </p>
                        <a href="{{ route('berita.detail', $news->slug ?? $news->id) }}" class="text-[#1E5631] text-xs md:text-sm font-bold hover:underline mt-auto">
                            Selengkapnya →
                        </a>
                    </div> 
                </div>
            @empty
                <div class="col-span-full py-10 text-center text-gray-400 italic text-sm">
                    Belum ada berita terbaru saat ini.
                </div>
            @endforelse
        </div>
    
        <div class="mt-8 md:mt-10 flex justify-center" data-aos="fade-up">
            <a href="{{ route('berita') }}" class="bg-[#1E5631] text-white px-5 md:px-6 py-2 rounded-md text-sm md:text-base hover:bg-[#17472a] transition">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

{{-- DIVIDER --}}
<div class="flex items-center justify-center my-12 md:my-16" data-aos="zoom-in" data-aos-duration="800">
    <div class="h-[2px] w-20 md:w-56 bg-[#C6A75E]"></div>
    <div class="w-2 h-2 bg-[#C6A75E] mx-3 md:mx-4 rotate-45 shrink-0"></div>
    <div class="h-[2px] w-20 md:w-56 bg-[#C6A75E]"></div>
</div>

{{-- GALERI --}}
<div class="pb-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 text-center">

        <h2 class="text-lg md:text-xl font-semibold text-[#1E5631] mb-8 md:mb-10 text-center uppercase tracking-wider" data-aos="fade-up">
            Galeri Kegiatan
        </h2>

        {{-- Menggunakan grid-cols-2 di HP agar foto tidak terlalu besar/memakan layar --}}
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 md:gap-6">
            @forelse($galeris as $g)
                <div class="overflow-hidden rounded-xl md:rounded-[1.5rem] shadow-sm border border-gray-100 group aspect-square md:aspect-video bg-gray-50"
                     data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <img src="{{ Str::startsWith($g->gambar, 'http') ? $g->gambar : asset($g->gambar) }}" 
                         alt="{{ $g->judul }}"
                         class="w-full h-full object-cover transform transition duration-500 group-hover:scale-110 cursor-pointer">
                </div>
            @empty
                <div class="col-span-full py-16 md:py-20 text-center text-gray-400 italic text-sm">
                    Belum ada dokumentasi foto di galeri.
                </div>
            @endforelse
        </div>

        <div class="mt-10 md:mt-12 flex justify-center" data-aos="fade-up">
            <a href="{{ route('galeri') }}" class="bg-[#1E5631] text-white px-6 md:px-8 py-3 rounded-xl text-sm md:text-base font-bold hover:bg-[#17472a] shadow-lg hover:shadow-xl transition-all duration-300">
                Lihat Galeri Lengkap
            </a>
        </div>

    </div>    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliderContainer = document.getElementById('slider-container');
        const taglineElement = document.getElementById('banner-tagline');
        const slides = document.querySelectorAll('.slide-item');
        
        if (slides.length <= 1) return; 

        let currentIndex = 0;

        setInterval(() => {
            currentIndex = (currentIndex + 1) % slides.length;
            sliderContainer.style.transform = `translateX(-${currentIndex * 100}%)`;

            taglineElement.style.opacity = 0;
            
            setTimeout(() => {
                taglineElement.innerText = slides[currentIndex].getAttribute('data-title');
                taglineElement.style.opacity = 0.9;
            }, 500); 

        }, 4000); 
    });
</script>

@endsection