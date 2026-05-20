@extends('layouts.app')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="relative h-screen w-full flex items-center justify-center overflow-hidden">
    
    {{-- SLIDER BACKGROUND --}}
    <div class="absolute inset-0 z-0 overflow-hidden bg-[#153a21]">
        <div id="slider-container" class="flex w-full h-full transition-transform duration-1000 ease-in-out">
            @forelse($banners as $b)
                <div class="w-full h-full flex-shrink-0 relative slide-item" data-title="{{ $b->judul }}">
                    <img src="{{ asset($b->gambar) }}" class="w-full h-full object-cover scale-105" alt="Banner">
                    {{-- Gradient overlay untuk estetika lebih baik dari sekadar warna hitam rata --}}
                    <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/80"></div>
                </div>
            @empty
                <div class="w-full h-full flex-shrink-0 relative slide-item" data-title="Mari Menjadi Generasi Penerus yang Berjiwa Islami dan Berwawasan Luas">
                    <img src="{{ asset('images/default-banner.jpg') }}" class="w-full h-full object-cover scale-105" alt="Background">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/80"></div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- FOREGROUND TEXT --}}
    <div class="relative z-10 text-center px-6 sm:px-8 max-w-5xl mx-auto w-full mt-10 md:mt-0" data-aos="zoom-in" data-aos-duration="1000">
        
        {{-- Logo --}}
        <div class="flex justify-center mb-6 md:mb-8">
            <img src="{{ asset('images/logo-pondok.png') }}" alt="Logo" class="w-24 md:w-32 drop-shadow-[0_10px_20px_rgba(0,0,0,0.5)]">
        </div>

        {{-- Judul Utama --}}
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 drop-shadow-2xl leading-tight tracking-wide uppercase">
            Pondok Pesantren <br class="hidden md:block"> Al-Mardliyyah Demangan
        </h1>
        
        {{-- Tagline --}}
        <div class="bg-black/20 backdrop-blur-sm border border-white/10 rounded-full px-6 py-2 inline-block mb-10">
            <p id="banner-tagline" class="text-gray-100 text-sm md:text-lg font-medium transition-opacity duration-500 opacity-100 uppercase tracking-widest">
                {{ $banners->first()?->judul ?? 'Pendaftaran Calon Santri Baru 2026/2027 Telah Dibuka' }}
            </p>
        </div>

        {{-- TOMBOL --}}
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 w-full max-w-sm mx-auto sm:max-w-none">
            
            @php
                $periodeAktif = \App\Models\Public\PeriodePendaftaran::where('status', 1)->latest()->first();
                $status = false;

                if($periodeAktif && $periodeAktif->tanggal_mulai && $periodeAktif->tanggal_selesai) {
                    $hariIni = \Carbon\Carbon::now();
                    $mulai = \Carbon\Carbon::parse($periodeAktif->tanggal_mulai)->startOfDay();
                    $selesai = \Carbon\Carbon::parse($periodeAktif->tanggal_selesai)->endOfDay();

                    if($hariIni->between($mulai, $selesai)) {
                        $status = true;
                    }
                }
            @endphp

            @if($status)
                @auth
                    {{-- === LOGIKA PINTAR UNTUK TOMBOL HERO === --}}
                    @php
                        $heroRoute = route('formulir'); // Default
                        $heroLabel = 'Lanjutkan Pendaftaran';
                        
                        if (Auth::user()->role === 'admin' || Auth::user()->role === 'pimpinan') {
                            $heroRoute = route('admin.dashboard');
                            $heroLabel = 'Masuk ke Dashboard';
                        } elseif (Auth::user()->role === 'calon_santri') {
                            $data = \App\Models\PendaftaranSantri::where('users_id', Auth::id())->first();
                            
                            if (!$data) {
                                $heroRoute = route('formulir');
                                $heroLabel = 'Lanjutkan Pendaftaran';
                            } elseif (
                                empty($data->foto_santri) || $data->foto_santri == '-' ||
                                empty($data->akta_kelahiran) || $data->akta_kelahiran == '-' ||
                                empty($data->kartu_keluarga) || $data->kartu_keluarga == '-' ||
                                empty($data->ktp_ayah) || $data->ktp_ayah == '-' ||
                                empty($data->ktp_ibu) || $data->ktp_ibu == '-'
                            ) {
                                $heroRoute = route('upload.dokumen');
                                $heroLabel = 'Lanjutkan Pendaftaran';
                            } else {
                                $heroRoute = route('status.pendaftaran');
                                $heroLabel = 'Cek Status Pendaftaran';
                            }
                        }
                    @endphp

                    {{-- Tombol Hero Dinamis --}}
                    <a href="{{ $heroRoute }}"
                       class="w-full sm:w-auto text-center bg-[#C6A75E] text-white px-8 py-3 rounded-lg font-bold shadow-lg hover:bg-[#b59650] transition inline-block">
                        {{ $heroLabel }}
                    </a>
                @else
                    {{-- Tombol jika belum login --}}
                    <a href="{{ route('pendaftaran') }}"
                       class="w-full sm:w-auto text-center bg-[#C6A75E] text-white px-8 py-3 rounded-lg font-bold shadow-lg hover:bg-[#b59650] transition inline-block">
                        Daftar Sekarang
                    </a>
                @endauth
            @else
                {{-- Tombol jika pendaftaran ditutup --}}
                <button onclick="bukaPopupTutup()"
                    class="w-full sm:w-auto text-center bg-[#C6A75E] text-white px-8 py-3 rounded-lg font-bold shadow-lg hover:bg-[#b59650] transition inline-block">
                    Daftar Sekarang
                </button>
            @endif

            {{-- Tombol Lihat Profil (Disesuaikan bentuknya agar serasi dengan tombol di sebelahnya) --}}
            <a href="{{ route('profile') }}" 
                class="w-full sm:w-auto text-center border-2 border-white/80 text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-[#1E5631] transition-all inline-block backdrop-blur-md bg-white/5">
                Lihat Profil
            </a>
            
        </div>
    </div>
</section>

{{-- ================= LEMBAGA PENDIDIKAN ================= --}}
<section class="py-20 md:py-28 bg-white overflow-hidden relative">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        
        {{-- TEKS (Berada di kiri pada laptop, di bawah pada HP) --}}
        <div data-aos="fade-right" data-aos-duration="1000" class="order-2 md:order-1 text-center md:text-left z-10">
            <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4">
                <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">Tentang Pondok</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1E5631] mb-6">
                Latar Belakang <br> <span class="text-[#1E5631]">Berdirinya Pondok</span>
            </h2>
            <p class="text-gray-600 mb-8 leading-relaxed text-base text-justify md:text-left">
                Pondok Pesantren Al-Mardliyyah, atau yang lebih dikenal masyarakat sebagai “Pondok Demangan”, didirikan secara resmi pada tahun 2010 M oleh KH. Agus Mushoffa Izzuddin. Kehadiran pesantren ini bermula dari niat mulia beliau untuk memfasilitasi sang istri, Ibu Nyai Hj. Siti Alfiyah, dalam mengamalkan dan menyiarkan ilmu Al-Qur'an melalui asrama khusus Tahfidzul Qur'an.

                Dalam perjalanannya, pondok yang bernaung di bawah Yayasan Pendidikan Islam Al-Mujaddadiyyah ini berkembang sangat pesat. Tidak hanya berfokus pada hafalan Al-Qur'an, Al-Mardliyyah kini memadukan kajian kitab kuning dengan program kewirausahaan (entrepreneurship) dan pengembangan bakat, demi mencetak kader pemimpin yang tangguh, berkarakter, dan siap terjun ke masyarakat.

                Kini, kepercayaan umat dari berbagai penjuru Nusantara—mulai dari Pulau Jawa, Sumatra, hingga Kalimantan—telah menjadikan pesantren ini rumah bagi lebih dari 700 santri untuk menimba ilmu dan membangun peradaban Islam yang Radhiyatan Mardliyyah.
            </p>
            <a href="{{ route('profile') }}" 
               class="inline-block bg-white text-[#1E5631] border-2 border-[#1E5631] px-8 py-3 rounded-lg font-bold shadow-sm hover:bg-[#1E5631] hover:text-white hover:-translate-y-1 transition-all duration-300">
                Selengkapnya &rarr;
            </a>
        </div>

        {{-- GAMBAR --}}
        <div class="relative z-10 order-1 md:order-2 flex justify-center md:justify-end" data-aos="fade-left" data-aos-duration="1000">
            
            {{-- Wrapper luar untuk mengontrol ukuran maksimal agar tidak memanjang mengikuti tinggi teks --}}
            <div class="relative w-full max-w-sm">
                
                {{-- Bingkai Foto Utama --}}
                <div class="rounded-2xl overflow-hidden shadow-2xl border-[6px] border-white relative z-10 aspect-[4/5] bg-gray-100">
                    <img src="{{ asset('images/sejarah.jpg') }}" 
                         alt="Gedung Pondok Pesantren" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                </div>
                
                {{-- Kotak aksen offset modern (warna emas/kuning kalem) --}}
                <div class="absolute -bottom-6 -left-6 md:-bottom-6 md:-right-6 w-full h-full bg-[#E5D7B7] rounded-2xl z-0 shadow-lg border border-white/50"></div>
                
                {{-- Elemen dekoratif tambahan (Opsional, titik-titik kecil) --}}
                <div class="absolute -top-4 -right-4 md:-left-4 z-20 opacity-30 pointer-events-none">
                    <svg width="60" height="60" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <pattern id="dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="2" fill="#1E5631"/>
                        </pattern>
                        <rect width="100" height="100" fill="url(#dots)"/>
                    </svg>
                </div>
            </div>
            
        </div>

    </div>
</section>

{{-- ================= VISI & MISI ================= --}}
<section class="py-20 md:py-28 bg-[#F8FAFC]">
    <div class="max-w-6xl mx-auto px-6 text-center mb-16">
       <div class="max-w-6xl mx-auto px-6 text-center mb-16">
        <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4" data-aos="fade-up">
            <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">Tujuan Kami</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-[#1E5631]" data-aos="fade-up" data-aos-delay="100">
            Visi & Misi Pondok
        </h2>
    </div>
    </div>

    <div class="max-w-5xl mx-auto px-6">
        {{-- VISI --}}
        <div class="mb-8" data-aos="fade-up" data-aos-duration="800">
            <div class="bg-[#1E5631] relative overflow-hidden text-white p-8 md:p-10 rounded-lg shadow-xl border-b-4 border-[#C6A75E]">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-5 rounded-full blur-xl"></div>
                <h3 class="text-xl md:text-2xl font-bold mb-4 text-[#C6A75E]">Visi</h3>
                <p class="text-base md:text-lg leading-relaxed text-gray-100 italic">
                    "Melahirkan kader pemimpin yang sholeh dan berkarakter serta berjiwa interpreneur dalam membangun peradaban islam radhiyatan mardliyyah."
                </p>
            </div>
        </div>

        {{-- MISI --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Misi 1 --}}
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 flex items-center justify-center bg-[#fdfaf3] text-[#C6A75E] rounded-xl mb-6 group-hover:scale-110 transition-transform">
                    <span class="font-extrabold text-xl">1</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed text-justify">
                    Menjadi pusat pembelajaran Al-Qur'an dan mempersiapkan kader hafidzul Qur'an yang beriman, bertaqwa, serta berakhlakul karimah.
                </p>
            </div>
            {{-- Misi 2 --}}
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 flex items-center justify-center bg-[#fdfaf3] text-[#C6A75E] rounded-xl mb-6 group-hover:scale-110 transition-transform">
                    <span class="font-extrabold text-xl">2</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed text-justify">
                    Menguasai tafakkuh fiddiin, pengetahuan dan memiliki daya saing, serta mampu mengembangkan diri di tengah masyarakat.
                </p>
            </div>
            {{-- Misi 3 --}}
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 h-12 flex items-center justify-center bg-[#fdfaf3] text-[#C6A75E] rounded-xl mb-6 group-hover:scale-110 transition-transform">
                    <span class="font-extrabold text-xl">3</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed text-justify">
                    Mendidik santri yang alim hikmah dan ilmiah dalam mengamalkan ajaran agama Islam secara komprehensif.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ================= PROGRAM PENDIDIKAN ================= --}}
<section class="py-20 md:py-28 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        
        <div class="max-w-6xl mx-auto px-6 text-center">
        <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4" data-aos="fade-up">
            <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">Pendidikan</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-[#1E5631] mb-12" data-aos="fade-up" data-aos-delay="100">
            Program Pendidikan
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 justify-items-center">
            @forelse($programs as $item)
                <div class="bg-white rounded-lg shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-50 overflow-hidden w-full max-w-[320px] sm:max-w-full hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group flex flex-col"
                     data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 150 }}"> 
                    
                    <div class="h-1.5 w-full bg-[#C6A75E]"></div>

                    <div class="p-8 flex-grow flex flex-col items-center">
                        <div class="w-16 h-16 bg-[#F8FAFC] rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-[#1E5631] transition-all duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#1E5631] group-hover:text-white transition-colors duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                            </svg>
                        </div>

                        <h3 class="text-gray-800 font-bold text-lg mb-4 text-center group-hover:text-[#1E5631] transition-colors">
                            {{ $item->nama_program }}
                        </h3>

                        <div class="text-sm text-gray-500 leading-relaxed text-center overflow-y-auto no-scrollbar flex-grow">
                            {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400 italic text-sm py-10">
                    Belum ada program pendidikan yang dipublikasikan.
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ================= BERITA TERBARU ================= --}}
<section class="py-20 md:py-28 bg-[#F8FAFC]">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-16">
            <div class="text-center mb-16">
            <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4" data-aos="fade-up">
                <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">Informasi</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1E5631]" data-aos="fade-up" data-aos-delay="100">
                Berita Terbaru
            </h2>
        </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($beritas as $index => $news)
            <div onclick="window.location='{{ route('berita.detail', $news->slug ?? $news->id) }}'"
                 data-aos="fade-up"
                 data-aos-delay="{{ ($index % 3) * 150 }}"
                 class="cursor-pointer bg-white rounded-lg shadow-sm hover:shadow-xl border border-gray-100 hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col group">

                <div class="relative overflow-hidden aspect-square bg-gray-100 shrink-0 border-b border-gray-100">
                    
                    <img src="{{ $news->gambar ? (Str::startsWith($news->gambar, 'http') ? $news->gambar : asset($news->gambar)) : asset('images/berita-default.jpg') }}"
                         {{-- 2. Kembalikan ke object-cover agar gambar mengisi penuh/full menempel ke tepi bingkai --}}
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                         
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="font-bold text-lg text-gray-800 mb-3 leading-tight group-hover:text-[#1E5631] transition-colors line-clamp-2">
                        {{ $news->judul }}
                    </h3>

                    <p class="text-sm text-gray-500 mb-6 leading-relaxed line-clamp-3 flex-grow">
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

                    <span class="text-[#C6A75E] text-sm font-bold flex items-center gap-2 group-hover:gap-3 transition-all">
                        Baca Selengkapnya <span class="text-lg">&rarr;</span>
                    </span>
                </div>
            </div>
            @empty
            <div class="col-span-full py-10 text-center text-gray-400 italic text-sm">
                Belum ada berita terbaru saat ini.
            </div>
            @endforelse
        </div>

        <div class="mt-14 flex justify-center" data-aos="fade-up">
            <a href="{{ route('berita') }}"
               class="inline-block bg-[#1E5631] text-white px-8 py-3.5 rounded-lg font-bold shadow-md hover:bg-[#17472a] hover:-translate-y-1 transition-all duration-300">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

{{-- ================= GALERI KEGIATAN ================= --}}
<section class="py-20 md:py-28 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <div class="max-w-6xl mx-auto px-6 text-center">
        <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4" data-aos="fade-up">
            <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">Dokumentasi</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-[#1E5631] mb-12" data-aos="fade-up" data-aos-delay="100">
            Galeri Kegiatan
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
            @forelse($galeris as $g)
                <div class="relative overflow-hidden rounded-lg shadow-sm group aspect-square md:aspect-[4/3] bg-gray-100 cursor-pointer"
                     data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                     
                    {{-- KEMBALIKAN object-contain menjadi object-cover agar gambar melebar full --}}
                    <img src="{{ Str::startsWith($g->gambar, 'http') ? $g->gambar : asset($g->gambar) }}" 
                         alt="{{ $g->judul }}"
                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                         
                    {{-- Overlay Hitam saat dihover --}}
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 scale-50 group-hover:scale-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-gray-400 italic text-sm">
                    Belum ada dokumentasi foto di galeri.
                </div>
            @endforelse
        </div>

        <div class="mt-14 flex justify-center" data-aos="fade-up">
            <a href="{{ route('galeri') }}" 
                class="inline-block border-2 border-[#1E5631] text-[#1E5631] px-8 py-3.5 rounded-lg font-bold hover:bg-[#1E5631] hover:text-white hover:-translate-y-1 transition-all duration-300">
                Lihat Galeri Lengkap
            </a>
        </div>
    </div>    
</section>

{{-- ================= SCRIPTS & POPUP ================= --}}
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
                taglineElement.style.opacity = 1;
            }, 500); 

        }, 5000); // Diperlambat sedikit jadi 5 detik agar lebih elegan
    });
</script>

{{-- POPUP PENDAFTARAN DITUTUP (Desain Baru dengan Backdrop Blur) --}}
<div id="popupTutup" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 transition-opacity opacity-0 duration-300">
    <div id="popupContent" class="bg-white p-8 rounded-lg text-center max-w-sm w-[90%] shadow-2xl transform scale-95 transition-transform duration-300">
        <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>
        <h2 class="font-bold text-xl mb-3 text-gray-800">
            Pendaftaran Ditutup
        </h2>
        <p class="text-sm text-gray-500 mb-8 leading-relaxed">
            Mohon maaf, pendaftaran santri baru saat ini sedang tidak dibuka. Silakan cek secara berkala.
        </p>
        <button onclick="tutupPopup()"
            class="w-full bg-[#1E5631] text-white px-6 py-3.5 rounded-full font-bold hover:bg-[#17472a] transition-colors">
            Mengerti & Tutup
        </button>
    </div>
</div>

<style>
/* Utilities */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>

<script>
function bukaPopupTutup() {
    const popup = document.getElementById('popupTutup');
    const content = document.getElementById('popupContent');
    
    popup.classList.remove('hidden');
    // Memaksa browser melakukan reflow sebelum menambahkan opacity
    void popup.offsetWidth; 
    
    popup.classList.remove('opacity-0');
    content.classList.remove('scale-95');
    content.classList.add('scale-100');
    document.body.style.overflow = 'hidden'; // Kunci scroll belakang
}

function tutupPopup() {
    const popup = document.getElementById('popupTutup');
    const content = document.getElementById('popupContent');
    
    popup.classList.add('opacity-0');
    content.classList.remove('scale-100');
    content.classList.add('scale-95');
    
    setTimeout(() => {
        popup.classList.add('hidden');
        document.body.style.overflow = 'auto'; // Buka kunci scroll
    }, 300); // Waktu yang sama dengan duration-300
}
</script>

@endsection