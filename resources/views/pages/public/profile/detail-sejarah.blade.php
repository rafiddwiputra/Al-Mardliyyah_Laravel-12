@extends('layouts.app')

@section('content')

<!-- HERO -->
<div class="bg-[#1E5631] text-white py-24">
    <div class="max-w-6xl mx-auto px-6">

        <p class="text-sm text-gray-200 mb-4">
            Beranda > Profil
        </p>

        <h1 class="text-3xl font-bold mb-3">
            Profil Pondok
        </h1>

        <p class="text-sm text-gray-100 max-w-2xl">
            Pondok Pesantren Al-Mardliyyah adalah lembaga pendidikan Islam yang telah berdiri sejak tahun 1985. Dengan komitmen untuk mencetak generasi cendekiawan yang berakhlak karimah
            , pondok pesantren ini telah menjadi tempat yang memberikan pendidikan agama dan umum kepada para santri. Melalui berbagai program pendidikan dan kegiatan keagamaan,
             Pondok Pesantren Al-Mardliyyah terus berupaya untuk membentuk karakter dan meningkatkan kualitas sumber daya manusia di lingkungan pesantren.
        </p>

    </div>
</div>

<!-- CONTENT -->
<div class="bg-[#F3F4F6] pt-5 pb-10">

    <!-- JUDUL + GARIS FULL -->
    <div class="text-center px-6">

        <h3 class="text-[#1E5631] font-semibold text-2xl mb-4">
            Sejarah Pondok
        </h3>

    </div>

    <!-- GARIS FULL SELEBAR HALAMAN -->
    <div class="w-full h-[2px] bg-gray-300 mb-10"></div>

    <!-- ISI -->
    <div class="max-w-4xl mx-auto px-6">

        <!-- JUDUL SEJARAH -->
        <h1 class="text-[#1E5631] font-semibold text-xl mb-3">
            {{ $sejarah['judul'] }}
        </h1>

        <!-- TAHUN + ICON -->
        <p class="text-[#1E5631] text-sm mb-6 flex items-center gap-2">
            <span>📅</span>
            {{ $tahun }}
        </p>

        {{-- GAMBAR (Responsif & Berbayang) --}}
            <div class="rounded-2xl overflow-hidden shadow-2xl mb-12 border border-gray-100">
                <img src="{{ asset($sejarah['gambar']) }}" 
                     alt="{{ $sejarah['judul'] }}" 
                     class="w-full h-[450px] object-cover hover:scale-105 transition-transform duration-700">
            </div>

        <!-- DESKRIPSI -->
        @foreach ($sejarah->konten_detail as $paragraf)
    <p class="text-[#1E5631] text-sm mb-4 leading-relaxed text-justify">
        {{ $paragraf }}
    </p>
@endforeach

        <!-- BUTTON -->
        <div class="flex justify-center mt-10">
            <a href="/profil"
                class="bg-[#1E5631] text-white px-6 py-2 rounded text-sm hover:bg-[#17472a] transition flex items-center gap-2">
                
                <span> ← </span>
                Kembali ke Halaman Profil
            </a>
        </div>

    </div>

</div>

@endsection