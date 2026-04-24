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
                    <div class="absolute inset-0 bg-black/50"></div>
                </div>
            @empty
                <div class="w-full h-full flex-shrink-0 relative slide-item" data-title="Mari Menjadi Generasi Penerus yang Berjiwa Islami dan Berwawasan Luas">
                    <img src="{{ asset('images/default-banner.jpg') }}" class="w-full h-full object-cover" alt="Background">
                    <div class="absolute inset-0 bg-black/50"></div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- FOREGROUND TEXT (Muncul dengan efek zoom-in) --}}
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto" data-aos="zoom-in" data-aos-duration="1000">
        <div class="flex justify-center mb-6">
            {{-- Logo --}}
            <img src="{{ asset('images/logo-pondok.png') }}" alt="Logo" class="w-40 md:w-56 drop-shadow-2xl">
        </div>

        <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 drop-shadow-md">
            Pondok Pesantren Al-Mardliyyah
        </h1>
        
        <p id="banner-tagline" class="text-white text-lg md:text-xl mb-10 font-medium transition-opacity duration-500 opacity-90">
            {{ $banners->first()?->judul ?? 'Mari Menjadi Generasi Penerus yang Berjiwa Islami dan Berwawasan Luas' }}
        </p>

        <div class="flex flex-wrap justify-center gap-4">
            {{-- TOMBOL DAFTAR DENGAN ANIMASI HEARTBEAT --}}
            <a href="{{ url('/pendaftaran') }}" class="bg-[#C6A75E] text-[#1E5631] px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-[#b5954a] transition animate-heartbeat">
                Daftar Sekarang
            </a>
            <a href="{{ route('profile') }}" class="border-2 border-white text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-white hover:text-[#1E5631] transition">
                Lihat Profil
            </a>
        </div>
    </div>
</section>

{{-- LEMBAGA PENDIDIKAN --}}
<section class="py-16 bg-gray-50 overflow-hidden">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">

        {{-- GAMBAR (Masuk dari kiri) --}}
        <div data-aos="fade-right" data-aos-duration="1000">
            <img src="{{ asset('images/logo.jpg') }}" 
            class="rounded-xl shadow-md w-full object-cover">
        </div>

        {{-- TEKS (Masuk dari kanan) --}}
        <div data-aos="fade-left" data-aos-duration="1000">
            <h2 class="text-2xl md:text-3xl font-bold text-[#1E5631] mb-4">
                Latar Belakang Berdirinya Pondok
            </h2>

            <p class="text-gray-600 mb-6 leading-relaxed">
            Berawal dari keprihatinan mendalam terhadap kondisi pendidikan Islam di tahun 1980-an, 
            sekelompok ulama dan tokoh masyarakat berinisiatif mendirikan sebuah lembaga pendidikan yang mampu mencetak generasi muslim
            </p>

            <a href="{{ route('profile') }}" 
               class="bg-[#1E5631] text-white px-6 py-2 rounded-lg shadow hover:bg-[#17472a] transition">
                Selengkapnya
            </a>
        </div>

    </div>
</section>

{{-- DIVIDER --}}
<div class="flex items-center justify-center" data-aos="zoom-in" data-aos-duration="800">
    <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
    <div class="w-2 h-2 bg-[#C6A75E] mx-4 rotate-45"></div>
    <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
</div>

{{-- VISI --}}
<section class="pt-16 pb-6">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <h2 class="text-2xl font-bold text-[#1E5631] mb-5" data-aos="fade-up">Visi & Misi</h2>

        <div class="mb-4 text-left" data-aos="fade-up" data-aos-duration="800">
            <div class="bg-gradient-to-r from-[#1E5631] to-[#2E8B57] text-white p-8 rounded-lg border-l-8 border-[#C6A75E] shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Visi</h3>
                <p class="text-justify">
                Melahirkan kader pemimpin yang sholeh dan berkarakter serta berjiwa interpreneur dalam membangun
                peradaban islam radhiyatan mardliyyah.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- MISI --}}
<section class="py-5">
    <div class="max-w-5xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-6 text-left">
            {{-- Misi Cards: Berurutan munculnya dengan delay --}}
            <div class="bg-white p-6 rounded-lg shadow border-t-4 border-[#1E5631]" data-aos="fade-up" data-aos-delay="100">
                <div class="w-10 h-10 flex items-center justify-center bg-[#C6A75E] rounded-full mb-4">
                    <span class="text-[#1E5631] font-bold">1</span>
                </div>
                <h4 class="text-[#1E5631] font-semibold mb-2">Misi 1</h4>
                <p class="text-sm text-justify">
                    Menjadi pusat pembelajaran Al-Qur'an dan mempersiapkan kader hafidzul Qur'an yang beriman, bertaqwa, serta berakhlakul karimah.
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow border-t-4 border-[#1E5631]" data-aos="fade-up" data-aos-delay="200">
                <div class="w-10 h-10 flex items-center justify-center bg-[#C6A75E] rounded-full mb-4">
                    <span class="text-[#1E5631] font-bold">2</span>
                </div>
                <h4 class="text-[#1E5631] font-semibold mb-2">Misi 2</h4>
                <p class="text-sm text-justify">
                    Menguasai tafakkuh fiddiin, pengetahuan dan memiliki daya saing, serta mampu mengembangkan diri di tengah masyarakat.
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow border-t-4 border-[#1E5631]" data-aos="fade-up" data-aos-delay="300">
                <div class="w-10 h-10 flex items-center justify-center bg-[#C6A75E] rounded-full mb-4">
                    <span class="text-[#1E5631] font-bold">3</span>
                </div>
                <h4 class="text-[#1E5631] font-semibold mb-2">Misi 3</h4>
                <p class="text-sm text-justify">
                    Mendidik santri yang alim hikmah dan ilmiah.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- DIVIDER --}}
<div class="flex items-center justify-center my-16" data-aos="zoom-in" data-aos-duration="800">
    <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
    <div class="w-2 h-2 bg-[#C6A75E] mx-4 rotate-45"></div>
    <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
</div>

{{-- PROGRAM --}}
<section class="py-16">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-xl font-semibold text-[#1E5631] mb-10 text-center" data-aos="fade-up">
            Program Pendidikan
        </h2>
        <div class="grid md:grid-cols-3 gap-8 justify-items-center">
            @forelse($programs as $item)
                <div class="bg-white rounded-xl shadow-md overflow-hidden w-64 hover:-translate-y-2 transition-transform duration-300" 
                     data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 150 }}"> 
                    <div class="h-3 bg-[#1E5631]"></div>
                    <div class="p-5 text-left">
                        <div class="w-9 h-9 bg-[#1E5631] text-white flex items-center justify-center rounded mb-4">🏫</div>
                        <h3 class="text-sm font-semibold text-[#1E5631] mb-2">
                            {{ $item->nama_program }}
                        </h3> 
                        <div class="text-sm text-gray-600 leading-relaxed">
                            {{ $item->deskripsi }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-400 italic">
                    Belum ada program pendidikan yang dipublikasikan.
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- DIVIDER --}}
<div class="flex items-center justify-center my-16" data-aos="zoom-in" data-aos-duration="800">
    <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
    <div class="w-2 h-2 bg-[#C6A75E] mx-4 rotate-45"></div>
    <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
</div>

{{-- BERITA --}}
<section class="pb-16">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-xl font-semibold text-[#1E5631] mb-10" data-aos="fade-up">
            Berita Terbaru
        </h2>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($beritas as $news)
                <div class="bg-white rounded-xl shadow-md overflow-hidden text-left hover:shadow-lg transition duration-300"
                     data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
                    <div class="w-full h-40 overflow-hidden bg-gray-100">
                        <img src="{{ $news->gambar ? (Str::startsWith($news->gambar, 'http') ? $news->gambar : asset($news->gambar)) : asset('images/berita-default.jpg') }}" 
                             alt="{{ $news->judul }}"
                             class="w-full h-full object-cover hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-5">
                        <p class="text-xs text-gray-500 mb-2">
                            {{ $news->created_at->translatedFormat('d F Y') }}
                        </p>
                        <h3 class="text-sm font-semibold text-[#1E5631] mb-2 line-clamp-2 min-h-[40px]">
                            {{ $news->judul }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-3">
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
                        <a href="{{ route('berita.detail', $news->slug ?? $news->id) }}" class="text-[#1E5631] text-sm font-bold hover:underline">
                            Selengkapnya →
                        </a>
                    </div> 
                </div>
            @empty
                <div class="col-span-3 py-10 text-center text-gray-400 italic">
                    Belum ada berita terbaru saat ini.
                </div>
            @endforelse
        </div>
    
        <div class="mt-10 flex justify-center" data-aos="fade-up">
            <a href="{{ route('berita') }}" class="bg-[#1E5631] text-white px-6 py-2 rounded-md hover:bg-[#17472a] transition">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

{{-- DIVIDER --}}
<div class="flex items-center justify-center my-16" data-aos="zoom-in" data-aos-duration="800">
    <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
    <div class="w-2 h-2 bg-[#C6A75E] mx-4 rotate-45"></div>
    <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
</div>

{{-- GALERI --}}
<div class="pb-16">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-xl font-semibold text-[#1E5631] mb-10 text-center uppercase tracking-wider" data-aos="fade-up">
            Galeri Kegiatan
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($galeris as $g)
                <div class="overflow-hidden rounded-[1.5rem] shadow-sm border border-gray-100 group aspect-square md:aspect-video bg-gray-50"
                     data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <img src="{{ Str::startsWith($g->gambar, 'http') ? $g->gambar : asset($g->gambar) }}" 
                         alt="{{ $g->judul }}"
                         class="w-full h-full object-cover transform transition duration-500 group-hover:scale-110 cursor-pointer">
                </div>
            @empty
                <div class="col-span-full py-20 text-center text-gray-400 italic">
                    Belum ada dokumentasi foto di galeri.
                </div>
            @endforelse
        </div>

        <div class="mt-12 flex justify-center" data-aos="fade-up">
            <a href="{{ route('galeri') }}" class="bg-[#1E5631] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#17472a] shadow-lg hover:shadow-xl transition-all duration-300">
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