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

{{-- ================= HERO SECTION ================= --}}
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

{{-- ================= GRID BERITA ================= --}}
<div class="max-w-6xl mx-auto py-16 px-6">

    <h2 class="text-center text-3xl font-bold mb-12 text-[#1E5631]" data-aos="fade-up">
       Berita & Kegiatan Pondok
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Loop Berita dengan delay agar muncul bergantian dari kiri ke kanan --}}
        @foreach($beritas as $index => $berita)
        <div onclick="window.location='{{ route('berita.detail', $berita->id) }}'"
             data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 150 }}" data-aos-duration="800"
             class="berita-item {{ $index >= 9 ? 'hidden' : '' }} flex flex-col cursor-pointer bg-white rounded-lg shadow-sm hover:shadow-xl border border-gray-100 hover:-translate-y-2 transition-all duration-300 overflow-hidden group h-full">

            {{-- Bagian Gambar & Badge (Proporsi 4:3) --}}
            <div class="relative overflow-hidden aspect-[4/3] shrink-0">
                <img src="{{ Str::startsWith($berita->gambar, 'http') ? $berita->gambar : asset($berita->gambar) }}" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            </div>

            {{-- Bagian Konten --}}
            <div class="p-6 flex flex-col flex-grow">
                <h3 class="font-bold text-lg text-gray-800 mb-3 leading-tight group-hover:text-[#1E5631] transition-colors line-clamp-4">
                    {{ $berita->judul }}
                </h3>

                {{-- Deskripsi singkat (Dihidupkan kembali agar layout tidak kosong melompong) --}}
                <p class="text-sm text-gray-500 mb-6 leading-relaxed line-clamp-3 flex-grow">
                    @if($berita->ringkasan)
                        {{ $berita->ringkasan }}
                    @elseif($berita->konten)
                        {{ Str::limit(strip_tags($berita->konten), 100) }}
                    @elseif($berita->deskripsi)
                        {{ Str::limit(strip_tags($berita->deskripsi), 100) }}
                    @else
                        Berita selengkapnya dapat dibaca di halaman detail...
                    @endif
                </p>

                {{-- Tombol Baca Selengkapnya --}}
                <span class="text-[#C6A75E] text-sm font-bold flex items-center gap-2 group-hover:gap-3 transition-all shrink-0">
                    Baca Selengkapnya <span class="text-lg">&rarr;</span>
                </span>
            </div> 
        </div> 
        @endforeach
    </div>

    {{-- Tombol Load More --}}
    @if($beritas->count() > 9)
    <div class="text-center mt-16" data-aos="zoom-in" data-aos-duration="800">
        <button id="loadMoreBtn" onclick="loadMore()" class="bg-[#1E5631] hover:bg-[#153d22] text-white px-10 py-3 rounded-full font-bold shadow-md hover:-translate-y-1 transition-all active:scale-95">
            Muat Lebih Banyak
        </button>
    </div>
    @endif

</div>

{{-- ================= BERITA POPULER ================= --}}
<div class="bg-[#F8FAFC] py-20 px-6 border-t border-gray-100">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-center font-bold text-3xl mb-12 text-[#1E5631]" data-aos="fade-up">
            Berita Populer
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($beritaPopuler as $index => $populer)
            <div onclick="window.location='{{ route('berita.detail', $populer->id) }}'"
                 data-aos="zoom-in" data-aos-delay="{{ ($index % 3) * 150 }}" data-aos-duration="600"
                 class="cursor-pointer bg-white border border-gray-100 rounded-lg p-4 flex gap-4 shadow-sm hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">

                <img src="{{ Str::startsWith($populer->gambar, 'http') ? $populer->gambar : asset($populer->gambar) }}"
                     class="w-24 h-24 object-cover rounded-xl shrink-0 group-hover:scale-105 transition-transform duration-500">

                <div class="flex flex-col justify-center">
                    <div class="flex items-center gap-1.5 text-xs text-gray-400 font-bold mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#1E5631]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V4m8 3V4m-9 7h10m-11 9h12a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                        </svg>
                        <span>
                            {{ $populer->tanggal_publish ? $populer->tanggal_publish->translatedFormat('d M Y') : $populer->created_at->translatedFormat('d M Y') }}
                        </span>
                    </div>

                    <h4 class="text-sm font-bold text-gray-800 leading-snug line-clamp-2 group-hover:text-[#1E5631] transition-colors">
                        {{ $populer->judul }}
                    </h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- SCRIPT LOAD MORE --}}
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