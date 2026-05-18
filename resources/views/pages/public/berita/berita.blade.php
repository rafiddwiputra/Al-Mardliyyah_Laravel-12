@extends('layouts.app')

@php
    $showCTA = true;
@endphp

@section('title', 'Berita & Kegiatan - Al-Mardliyyah')

@section('content')

@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
    Carbon::setLocale('id');
@endphp

<div class="bg-[#1E5631] text-white px-6 md:px-20 py-20" data-aos="fade-down" data-aos-duration="1000">
    <div class="max-w-6xl mx-auto">
        <p class="text-sm mb-4 opacity-80 text-white">Beranda > Berita</p>
        <h1 class="text-4xl font-bold mb-4 text-white">Berita & Kegiatan Pondok</h1>
        <p class="max-w-2xl text-base leading-relaxed opacity-90 text-gray-100">
            Berita dan informasi terbaru mengenai kegiatan santri, pengumuman resmi,
            prestasi, serta berbagai aktivitas yang berlangsung di Pondok Pesantren Al-Mardliyyah.
        </p>
    </div>
</div>

<div class="max-w-6xl mx-auto py-16 px-6">

    <h2 class="text-center text-2xl font-bold mb-12 text-[#1E5631]" data-aos="fade-up">
       Berita & Kegiatan Pondok
    </h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Loop Berita dengan delay agar muncul bergantian dari kiri ke kanan --}}
        @foreach($beritas as $index => $berita)
        <div onclick="window.location='{{ route('berita.detail', $berita->id) }}'"
             data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 150 }}" data-aos-duration="800"
             
             class="berita-item {{ $index >= 9 ? 'hidden' : '' }} flex flex-col cursor-pointer bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group h-full">

            {{-- Bagian Gambar --}}
            <div class="relative h-56 overflow-hidden shrink-0">
                <img src="{{ Str::startsWith($berita->gambar, 'http') ? $berita->gambar : asset($berita->gambar) }}" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                     
                {{-- PERUBAHAN 2: Tambahkan efek overlay gelap tipis saat di-hover agar gambar terlihat premium --}}
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                
                {{-- PERUBAHAN 3: Tambahkan Badge Kategori/Status cantik di pojok kiri atas --}}
                <div class="absolute top-5 left-5 bg-white/95 backdrop-blur-sm text-[#1E5631] text-[10px] font-extrabold px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                    Kabar Pondok
                </div>
            </div>

            {{-- Bagian Konten --}}
            {{-- Tambahkan flex-grow agar konten ini mengisi sisa ruang kosong jika teksnya sedikit --}}
            <div class="p-6 flex flex-col flex-grow">

                <div class="flex items-center gap-2 text-xs text-gray-400 font-bold mb-3 uppercase tracking-wider">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#c9a76d]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V4m8 3V4m-9 7h10m-11 9h12a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                    </svg>
                    <span>
                        {{ $berita->tanggal_publish ? $berita->tanggal_publish->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}
                    </span>
                </div>

               {{-- Judul diizinkan maksimal 3 baris agar lebih lega karena deskripsi sudah dihapus --}}
                <h3 class="font-bold text-lg text-[#1E5631] mb-6 leading-snug group-hover:text-[#c9a76d] transition-colors line-clamp-3">
                    {{ $berita->judul }}
                </h3>

                {{-- PERUBAHAN 5: mt-auto akan mendesak tombol ini ke posisi paling bawah frame card secara otomatis --}}
                <div class="mt-auto pt-5 border-t border-gray-100">
                    <a href="{{ route('berita.detail', $berita->id) }}"
                       class="text-[#1E5631] text-xs font-extrabold flex items-center gap-2 group-hover:text-[#c9a76d] transition-colors">
                        Baca Selengkapnya 
                        <span class="group-hover:translate-x-2 transition-transform duration-300">→</span>
                    </a>
                </div>

            </div> {{-- Penutup p-6 flex flex-col flex-grow --}}
        </div> {{-- Penutup berita-item --}}
        @endforeach
    </div>

    @if($beritas->count() > 9)
    <div class="text-center mt-16" data-aos="zoom-in" data-aos-duration="800">
        <button id="loadMoreBtn" onclick="loadMore()" class="bg-[#1E5631] hover:bg-[#153d22] text-white px-10 py-3 rounded-xl font-bold shadow-lg transition-all active:scale-95">
            Muat Lebih Banyak
        </button>
    </div>
    @endif

</div>

<div class="bg-gray-50 py-20 px-6 border-t border-gray-100">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-center font-bold text-2xl mb-12 text-[#1E5631]" data-aos="fade-up">
            Berita Populer
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Loop Berita Populer (Efek zoom-in bergantian) --}}
            @foreach($beritaPopuler as $index => $populer)
            <div onclick="window.location='{{ route('berita.detail', $populer->id) }}'"
     data-aos="zoom-in" data-aos-delay="{{ ($index % 3) * 150 }}" data-aos-duration="600"
     class="cursor-pointer bg-white border border-gray-50 rounded-lg p-4 flex gap-4 shadow-sm hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 group">

                <img src="{{ Str::startsWith($populer->gambar, 'http') ? $populer->gambar : asset($populer->gambar) }}"
                     class="w-20 h-20 object-cover rounded-xl shrink-0">

                <div class="flex flex-col justify-center">

                    <div class="flex items-center gap-1.5 text-[10px] text-gray-400 font-bold mb-1">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-3.5 h-3.5 text-[#1E5631]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M8 7V4m8 3V4m-9 7h10m-11 9h12a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />

                        </svg>

                        <span>
                            {{ $populer->tanggal_publish
                                ? $populer->tanggal_publish->translatedFormat('d M Y')
                                : $populer->created_at->translatedFormat('d M Y') }}
                        </span>

                    </div>

                    <h4 class="text-sm font-bold text-[#1E5631] leading-tight line-clamp-2 group-hover:text-[#c9a76d]">
                        {{ $populer->judul }}
                    </h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
function loadMore() {
    let items = document.querySelectorAll('.berita-item');
    let button = document.getElementById('loadMoreBtn');
    let shown = 0;

    items.forEach(item => { if (!item.classList.contains('hidden')) shown++; });

    for (let i = shown; i < shown + 3; i++) {
        if (items[i]) items[i].classList.remove('hidden');
    }

    let newShown = 0;
    items.forEach(item => { if (!item.classList.contains('hidden')) newShown++; });

    if (newShown >= items.length) button.style.display = 'none';
}
</script>

@endsection