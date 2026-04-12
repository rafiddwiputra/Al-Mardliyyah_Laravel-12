@extends('layouts.app')

@section('title', 'Berita & Kegiatan - Al-Mardliyyah')

@section('content')

@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
    Carbon::setLocale('id');
@endphp

<div class="bg-[#1E5631] text-white px-6 md:px-20 py-20">
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

    <h2 class="text-center text-2xl font-bold mb-12 text-[#1E5631]">
       Berita & Kegiatan Pondok
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Loop data dari database ($beritas dikirim dari Controller) --}}
        @foreach($beritas as $index => $berita)
        <div onclick="window.location='{{ route('berita.detail', $berita->slug) }}'"
            class="berita-item {{ $index >= 9 ? 'hidden' : '' }} cursor-pointer bg-white border border-gray-100 rounded-[2rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group">

            {{-- Logika Gambar: Cek apakah link URL atau path lokal --}}
            <img src="{{ Str::startsWith($berita->gambar, 'http') ? $berita->gambar : asset($berita->gambar) }}" 
                 class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110">

            <div class="p-6">
                <p class="text-xs text-gray-400 font-bold mb-3 uppercase tracking-wider">
                    📅 {{ $berita->tanggal_publish ? $berita->tanggal_publish->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}
                </p>

                <h3 class="font-bold text-lg text-[#1E5631] mb-3 leading-tight group-hover:text-[#c9a76d] transition-colors">
                    {{ $berita->judul }}
                </h3>

                <p class="text-sm text-gray-500 mb-6 leading-relaxed line-clamp-3">
                    {{ Str::limit(strip_tags($berita->deskripsi), 100) }}
                </p>

                <a href="{{ route('berita.detail', $berita->slug) }}"
                    class="text-[#1E5631] text-xs font-extrabold flex items-center gap-2">
                    Baca Selengkapnya <span class="group-hover:translate-x-2 transition-transform">→</span>
                </a>
            </div>

        </div>
        @endforeach
    </div>

    @if($beritas->count() > 9)
    <div class="text-center mt-16">
        <button id="loadMoreBtn" onclick="loadMore()" class="bg-[#1E5631] hover:bg-[#153d22] text-white px-10 py-3 rounded-xl font-bold shadow-lg transition-all active:scale-95">
            Muat Lebih Banyak
        </button>
    </div>
    @endif

</div>

<div class="bg-gray-50 py-20 px-6 border-t border-gray-100">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-center font-bold text-2xl mb-12 text-[#1E5631]">
            Berita Populer
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($beritaPopuler as $populer)
            <div onclick="window.location='{{ route('berita.detail', $populer->slug) }}'"
                class="cursor-pointer bg-white border border-gray-50 rounded-2xl p-4 flex gap-4 shadow-sm hover:shadow-md transition group">

                <img src="{{ Str::startsWith($populer->gambar, 'http') ? $populer->gambar : asset($populer->gambar) }}"
                     class="w-20 h-20 object-cover rounded-xl shrink-0">

                <div class="flex flex-col justify-center">
                    <p class="text-[10px] text-gray-400 font-bold mb-1">
                        📅 {{ $populer->tanggal_publish ? $populer->tanggal_publish->translatedFormat('d M Y') : $populer->created_at->translatedFormat('d M Y') }}
                    </p>

                    <h4 class="text-sm font-bold text-[#1E5631] leading-tight line-clamp-2 group-hover:text-[#c9a76d]">
                        {{ $populer->judul }}
                    </h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- CTA tetap sama seperti kodemu --}}
<div class="bg-[#1E5631] text-white py-24 text-center relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <h3 class="text-3xl font-bold mb-6 text-white relative z-10">Pendaftaran Santri Baru Telah Dibuka</h3>
    <p class="text-base mb-10 max-w-2xl mx-auto text-gray-200 opacity-80 relative z-10">
        Bergabunglah dengan keluarga besar Al-Mardliyyah untuk mencetak generasi yang berakhlak mulia dan berwawasan luas.
    </p>
    <a href="{{ url('/pendaftaran') }}" class="bg-[#C6A75E] hover:bg-[#b59650] text-[#1E5631] px-10 py-3 rounded-full font-bold shadow-xl transition-all inline-block relative z-10">
        Daftar Sekarang
    </a>
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

