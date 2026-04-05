@extends('layouts.app')

@section('content')

{{-- HERO --}}
<div class="bg-[#1E5631] text-white text-center py-32">
    <h1 class="text-4xl font-bold mb-4">
        Pondok Pesantren Al-Mardliyyah
    </h1>

    <p class="mb-6">
        Membentuk Generasi Qur’ani yang Berakhlak Mulia dan Berprestasi
    </p>

    <div class="flex justify-center gap-4">
        {{-- Link ke halaman pendaftaran --}}
        <a href="{{ url('/pendaftaran') }}" class="bg-[#C6A75E] text-[#1E5631] px-5 py-2 rounded font-semibold hover:bg-[#b59650] transition">
            Daftar Sekarang
        </a>

        {{-- Link ke halaman profil --}}
        <a href="{{ route('profile') }}" class="border border-white px-5 py-2 rounded hover:bg-white hover:text-[#1E5631] transition">
            Lihat Profil
        </a>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="bg-[#FAFAFA]">

    {{-- TENTANG --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-start">
        
        <div>
            {{-- Gambar Dinamis --}}
            <img src="{{ $tentang && $tentang->gambar ? asset($tentang->gambar) : asset('images/pesantren-al-mardliyyah.jpg') }}"
                alt="Gambar Pondok"
                class="rounded-lg shadow-md w-full h-auto object-cover">
        </div>  
        
        <div>
            <h2 class="text-2xl font-bold text-[#1E5631] mb-4 text-left">
                {{ $tentang->judul ?? 'Tentang Pesantren' }}
            </h2>

            <div class="text-[#333333] mb-6 text-justify leading-relaxed">
                {{-- Menggunakan {!! !!} jika deskripsi mengandung baris baru/HTML dari editor --}}
                {!! nl2br(e($tentang->deskripsi ?? 'Pondok Pesantren Al-Mardliyyah berkomitmen dalam membentuk generasi Qur’ani.')) !!}
            </div>

            <a href="{{ route('profile') }}" class="inline-block bg-[#1E5631] text-white px-5 py-2 rounded hover:bg-[#17472a] transition">
                Selengkapnya
            </a>
        </div>

    </div>
</section>

    {{-- DIVIDER --}}
    <div class="flex items-center justify-center">
        <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
        <div class="w-2 h-2 bg-[#C6A75E] mx-4 rotate-45"></div>
        <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
    </div>

    {{-- VISI --}}
<section class="py-16">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <h2 class="text-2xl font-bold text-[#1E5631] mb-5">Visi & Misi</h2>

        <div class="mb-12 text-left">
            <div class="bg-gradient-to-r from-[#1E5631] to-[#2E8B57] text-white p-8 rounded-lg border-l-8 border-[#C6A75E]">
                <h3 class="text-xl font-semibold mb-4">Visi</h3>
                <p class="text-justify">
                  {{ $visi->konten ?? 'Visi Belum Di Isi' }} 
                </p>
                </p>
            </div>
        </div>
    </div>
</section>

{{-- MISI --}}
<section class="py-5">
    <div class="max-w-5xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-6 text-left">
            @forelse($misi as $key => $item)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition border-t-4 border-[#1E5631]">
                <div class="w-10 h-10 flex items-center justify-center bg-[#C6A75E] rounded-full mb-4">
                    {{-- Menggunakan $key+1 agar nomor mulai dari 1 --}}
                    <span class="text-[#1E5631] font-bold">{{ $key + 1 }}</span>
                </div>
                <h4 class="text-[#1E5631] font-semibold mb-2">
                    {{-- Jika kamu ingin judul misi dinamis, bisa tambah kolom judul di migration. 
                         Untuk sekarang, kita buat kontennya saja --}}
                    Misi {{ $key + 1 }}
                </h4>
                <p class="text-[#333333] text-sm text-justify leading-relaxed">
                    {{ $item->konten }}
                </p>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-400 italic">Data misi belum diisi.</div>
            @endforelse
        </div>
    </div>
</section>

    {{-- DIVIDER --}}
    <div class="flex items-center justify-center my-16">
        <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
        <div class="w-2 h-2 bg-[#C6A75E] mx-4 rotate-45"></div>
        <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
    </div>

    {{-- PROGRAM --}}
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-xl font-semibold text-[#1E5631] mb-10 text-center">
                Program Pendidikan
            </h2>
<div class="grid md:grid-cols-3 gap-8 justify-items-center">
    @forelse($programs as $item)
        {{-- Hanya satu blok kartu ini yang tersisa, sisanya dihapus --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden w-64 hover:-translate-y-2 transition-transform duration-300"> 
            <div class="h-3 bg-[#1E5631]"></div>
            <div class="p-5 text-left">
                <div class="w-9 h-9 bg-[#1E5631] text-white flex items-center justify-center rounded mb-4">🏫</div>
                
                {{-- Ambil nama program dari Database --}}
                <h3 class="text-sm font-semibold text-[#1E5631] mb-2">
                    {{ $item->nama_program }}
                </h3> 

                {{-- Ambil deskripsi dari Database --}}
                <div class="text-sm text-gray-600 leading-relaxed">
                    {{ $item->deskripsi }}
                </div>
            </div>
        </div>
    @empty
        {{-- Muncul jika di database benar-benar kosong --}}
        <div class="col-span-3 text-center text-gray-400 italic">
            Belum ada program pendidikan yang dipublikasikan.
        </div>
    @endforelse
</div>
    </section>

    {{-- DIVIDER --}}
    <div class="flex items-center justify-center my-16">
        <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
        <div class="w-2 h-2 bg-[#C6A75E] mx-4 rotate-45"></div>
        <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
    </div>

   {{-- BERITA --}}
<section class="pb-16">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-xl font-semibold text-[#1E5631] mb-10">
            Berita Terbaru
        </h2>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($beritas as $news)
                {{-- CARD DINAMIS --}}
                <div class="bg-white rounded-xl shadow-md overflow-hidden text-left hover:shadow-lg transition duration-300">

                    {{-- GAMBAR BERITA --}}
                    <img src="{{ $news->thumbnail ? asset($news->thumbnail) : asset('images/berita-default.jpg') }}" 
                         alt="{{ $news->judul }}"
                         class="w-full h-40 object-cover">

                    <div class="p-5">
                        {{-- TANGGAL --}}
                        <p class="text-xs text-gray-500 mb-2">
                            {{ $news->created_at->translatedFormat('d F Y') }}
                        </p>

                        {{-- JUDUL --}}
                        <h3 class="text-sm font-semibold text-[#1E5631] mb-2 line-clamp-2">
                            {{ $news->judul }}
                        </h3>

                        {{-- RINGKASAN DESKRIPSI --}}
                        <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                            {{ $news->ringkasan ?? Str::limit(strip_tags($news->konten), 100) }}
                        </p>

                        {{-- BUTTON KE DETAIL --}}
                        <a href="{{ route('berita.detail', $news->slug) }}" class="text-[#1E5631] text-sm font-bold hover:underline">
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
    
        <div class="mt-10 flex justify-center">
            <a href="{{ route('berita') }}" class="bg-[#1E5631] text-white px-6 py-2 rounded-md hover:bg-[#17472a] transition">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

    {{-- DIVIDER --}}
    <div class="flex items-center justify-center my-16">
        <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
        <div class="w-2 h-2 bg-[#C6A75E] mx-4 rotate-45"></div>
        <div class="h-[2px] w-24 md:w-55 bg-[#C6A75E]"></div>
    </div>

    {{-- GALERI --}}
<div class="pb-16">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-xl font-semibold text-[#1E5631] mb-10 text-center uppercase tracking-wider">
            Galeri Kegiatan
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($galeris as $g)
                {{-- ITEM GAMBAR --}}
                {{-- 
                    Kita bungkus dengan 'group' agar efek hover 
                    scale (perbesaran) gambarnya tetap rapi di dalam bingkai 
                --}}
                <div class="overflow-hidden rounded-[1.5rem] shadow-sm border border-gray-100 group aspect-square md:aspect-video bg-gray-50">
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

        <div class="mt-12 flex justify-center">
            <a href="{{ route('galeri') }}" class="bg-[#1E5631] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#17472a] shadow-lg hover:shadow-xl transition-all duration-300">
                Lihat Galeri Lengkap
            </a>
        </div>

    </div>    
</div>

</div> {{-- END MAIN CONTENT --}}

@endsection