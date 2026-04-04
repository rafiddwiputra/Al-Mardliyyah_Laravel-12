@extends('layouts.app')

@section('content')

@php
use Carbon\Carbon;
use Illuminate\Support\Str;

Carbon::setLocale('id');

/* =========================
   DATA DUMMY
   ========================= */
$beritas = collect([
    (object)[
        'id' => 1,
        'judul' => 'Wisuda Tahfidz 30 Juz Angkatan 2026',
        'gambar' => 'https://picsum.photos/800/400?1',
        'deskripsi' => 'Alhamdulillah, sebanyak 25 santri berhasil menyelesaikan hafalan 30 juz dan diwisuda. Kegiatan ini berlangsung dengan
         khidmat dan dihadiri oleh wali santri serta masyarakat sekitar.',
        'tanggal_publish' => '2026-03-01'
    ],
    (object)[
        'id' => 2,
        'judul' => 'Kegiatan Santri Harian',
        'gambar' => 'https://picsum.photos/800/400?2',
        'deskripsi' => 'Kegiatan santri meliputi belajar, mengaji, serta aktivitas pembentukan karakter setiap hari di lingkungan pondok.',
        'tanggal_publish' => '2026-03-02'
    ],
    (object)[
        'id' => 3,
        'judul' => 'Kajian Kitab Kuning',
        'gambar' => 'https://picsum.photos/800/400?3',
        'deskripsi' => 'Santri mendalami kitab klasik sebagai bagian dari pendidikan pesantren tradisional.',
        'tanggal_publish' => '2026-03-03'
    ],
    (object)[
        'id' => 4,
        'judul' => 'Kegiatan Ramadhan',
        'gambar' => 'https://picsum.photos/400/300?4',
        'deskripsi' => 'Tadarus, tarawih, dan buka bersama menjadi kegiatan utama selama bulan Ramadhan.',
        'tanggal_publish' => '2026-03-04'
    ],
    (object)[
        'id' => 5,
        'judul' => 'Lomba Antar Santri',
        'gambar' => 'https://picsum.photos/400/300?5',
        'deskripsi' => 'Berbagai lomba diadakan untuk meningkatkan kreativitas dan semangat santri.',
        'tanggal_publish' => '2026-03-05'
    ],
    (object)[
        'id' => 6,
        'judul' => 'Bakti Sosial Santri',
        'gambar' => 'https://picsum.photos/400/300?6',
        'deskripsi' => 'Santri melakukan kegiatan sosial sebagai bentuk kepedulian terhadap masyarakat.',
        'tanggal_publish' => '2026-03-06'
    ],
    (object)[
    'id' => 7,
    'judul' => 'Pelatihan Public Speaking',
    'gambar' => 'https://picsum.photos/400/300?7',
    'deskripsi' => 'Santri dilatih berbicara di depan umum untuk meningkatkan kepercayaan diri.',
    'tanggal_publish' => '2026-03-07'
],
(object)[
    'id' => 8,
    'judul' => 'Kegiatan Olahraga Santri',
    'gambar' => 'https://picsum.photos/400/300?8',
    'deskripsi' => 'Olahraga rutin untuk menjaga kesehatan jasmani santri.',
    'tanggal_publish' => '2026-03-08'
],
(object)[
    'id' => 9,
    'judul' => 'Lomba Adzan',
    'gambar' => 'https://picsum.photos/400/300?9',
    'deskripsi' => 'Santri mengikuti lomba adzan dengan penuh semangat.',
    'tanggal_publish' => '2026-03-09'
],
(object)[
    'id' => 10,
    'judul' => 'Pelatihan IT Santri',
    'gambar' => 'https://picsum.photos/400/300?10',
    'deskripsi' => 'Santri dikenalkan dengan teknologi dan coding dasar.',
    'tanggal_publish' => '2026-03-10'
],
(object)[
    'id' => 11,
    'judul' => 'Kunjungan Ulama',
    'gambar' => 'https://picsum.photos/400/300?11',
    'deskripsi' => 'Kunjungan ulama untuk memberikan tausiyah kepada santri.',
    'tanggal_publish' => '2026-03-11'
],
(object)[
    'id' => 12,
    'judul' => 'Kegiatan Kebersihan Lingkungan',
    'gambar' => 'https://picsum.photos/400/300?12',
    'deskripsi' => 'Santri menjaga kebersihan lingkungan pesantren.',
    'tanggal_publish' => '2026-03-12'
],
]);

/* =========================
   PILIH SALAH SATU DATA
   ========================= */
$id = request()->id ?? 1;

$berita = $beritas->firstWhere('id', $id);
@endphp

<!-- HERO -->
<div class="bg-[#1E5631] text-white px-20 py-20">
    <p class="text-sm mb-4">Beranda > Berita</p>
    <h1 class="text-3xl font-bold mb-4">Berita & Kegiatan Pondok</h1>
    <p class="max-w-2xl text-sm leading-relaxed">
        Berita dan informasi terbaru mengenai kegiatan santri, pengumuman resmi,
        prestasi, serta berbagai aktivitas yang berlangsung di Pondok Pesantren Al-Mardliyyah.
    </p>
</div>

<!-- CONTENT DETAIL -->
<div class="max-w-4xl mx-auto py-12">

    <h2 class="text-center text-xl font-semibold mb-10 text-[#1E5631]">
        Berita
    </h2>

    <h3 class="text-2xl font-semibold text-[#1E5631] mb-2">
        {{ $berita->judul }}
    </h3>

    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        📅 {{ Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') }}
    </div>

    <img src="{{ $berita->gambar }}"
         class="w-full h-[400px] object-cover rounded-lg mb-6">

    <p class="text-sm text-[#333333] leading-relaxed mb-10">
        {{ $berita->deskripsi }}
    </p>

    <!-- tombol -->
    <div class="text-center mb-16">
        <a href="/berita"
           class="inline-block bg-[#1E5631] text-white px-6 py-2 rounded-lg text-sm">
            ← Kembali ke Berita
        </a>
    </div>

</div>

<!-- BERITA TERKAIT -->
<div class="max-w-6xl mx-auto pb-16">

    <h2 class="text-center text-xl font-semibold mb-10 text-[#1E5631]">
        Berita Terkait
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        @foreach($beritas->where('id','!=',$berita->id) as $item)
            <div onclick="window.location='/detail-berita?id={{ $item->id }}'"
                class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition overflow-hidden cursor-pointer">

            <img src="{{ $item->gambar }}"
                 class="w-full h-44 object-cover">

            <div class="p-4">

                <p class="text-xs text-gray-500 mb-2">
                    📅 {{ Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y') }}
                </p>

                <h3 class="font-semibold text-sm text-[#1E5631] mb-2">
                    {{ $item->judul }}
                </h3>

                <p class="text-xs text-gray-600 mb-3">
                    {{ Str::limit($item->deskripsi, 90) }}
                </p>

                <a href="#" class="text-[#1E5631] text-xs font-semibold">
                    Baca Selengkapnya →
                </a>

            </div>
        </div>
        @endforeach

    </div>

</div>

<!-- CTA -->
<div class="bg-[#4F7C5C] text-white py-20 text-center">
    <h3 class="text-2xl font-semibold mb-4">
        Pendaftaran Santri Baru Telah Dibuka
    </h3>

    <p class="text-sm mb-8 max-w-xl mx-auto text-gray-200">
        Bergabunglah dengan ribuan santri kami dan mulai perjalanan
        pendidikan Anda di Pondok Pesantren Al-Mardliyyah
    </p>

    <a href="/registrasi"
   class="bg-[#C6A75E] text-[#1E5631] px-6 py-2 rounded-lg font-semibold inline-block">
    Daftar Sekarang
    </a>
</div>

@endsection