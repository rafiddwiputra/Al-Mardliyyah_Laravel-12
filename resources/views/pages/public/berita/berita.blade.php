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
        'gambar' => 'https://picsum.photos/400/300?1',
        'deskripsi' => 'Alhamdulillah, sebanyak 25 santri berhasil menyelesaikan hafalan 30 juz dan diwisuda.',
        'tanggal_publish' => '2026-03-01'
    ],
    (object)[
        'id' => 2,
        'judul' => 'Kegiatan Santri Harian',
        'gambar' => 'https://picsum.photos/400/300?2',
        'deskripsi' => 'Kegiatan santri meliputi belajar, mengaji, dan aktivitas harian yang membentuk karakter islami.',
        'tanggal_publish' => '2026-03-02'
    ],
    (object)[
        'id' => 3,
        'judul' => 'Kajian Kitab Kuning',
        'gambar' => 'https://picsum.photos/400/300?3',
        'deskripsi' => 'Santri mendalami kitab klasik sebagai bagian dari pembelajaran tradisional pesantren.',
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

<!-- CONTENT -->
<div class="max-w-6xl mx-auto py-12">

    <h2 class="text-center text-xl font-semibold mb-10 text-[#1E5631]">
        Berita & Kegiatan Pondok
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        @foreach($beritas as $index => $berita)
        <div onclick="window.location='/detail-berita?id={{ $berita->id }}'"
            class="berita-item {{ $index >= 9 ? 'hidden' : '' }} cursor-pointer bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition overflow-hidden">

            <img src="{{ $berita->gambar }}" class="w-full h-44 object-cover">

            <div class="p-4">
                <p class="text-xs text-gray-500 mb-2">
                    📅 {{ Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') }}
                </p>

                <h3 class="font-semibold text-sm text-[#1E5631] mb-2">
                    {{ $berita->judul }}
                </h3>

                <p class="text-xs text-gray-600 mb-3">
                    {{ Str::limit($berita->deskripsi, 90) }}
                </p>

                <a href="/detail-berita?id={{ $berita->id }}"
                    class="text-[#1E5631] text-xs font-semibold">
                    Baca Selengkapnya →
                </a>
            </div>

        </div>
        @endforeach

    </div>

    <!-- BUTTON -->
    <div class="text-center mt-12">
        <button id="loadMoreBtn" onclick="loadMore()" class="bg-[#1E5631] text-white px-6 py-2 rounded-lg">
            Muat Lebih Banyak
    </div>

</div>

<!-- BERITA POPULER -->
<div class="max-w-6xl mx-auto py-12">

    <h2 class="text-center font-semibold text-lg mb-8 text-[#1E5631]">
        Berita Populer
    </h2>

    <div class="grid md:grid-cols-3 gap-6">

        @foreach($beritas->take(3) as $berita)
        <div onclick="window.location='/detail-berita?id={{ $berita->id }}'"
            class="cursor-pointer bg-white border rounded-lg p-3 flex gap-3 shadow-sm hover:shadow-md transition">

            <img src="{{ $berita->gambar }}"
                 class="w-20 h-20 object-cover rounded-md">

            <div>
                <p class="text-[10px] text-gray-500 mb-1">
                    📅 {{ Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') }}
                </p>

                <h4 class="text-xs font-semibold text-[#1E5631]">
                    {{ $berita->judul }}
                </h4>

                <p class="text-[10px] text-gray-600">
                    {{ Str::limit($berita->deskripsi, 50) }}
                </p>
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

<script>
function loadMore() {
    let items = document.querySelectorAll('.berita-item');
    let button = document.getElementById('loadMoreBtn');

    let shown = 0;

    // hitung yang sudah tampil
    items.forEach(item => {
        if (!item.classList.contains('hidden')) {
            shown++;
        }
    });

    // tampilkan 3 berikutnya
    for (let i = shown; i < shown + 3; i++) {
        if (items[i]) {
            items[i].classList.remove('hidden');
        }
    }

    // hitung ulang setelah ditampilkan
    let newShown = 0;
    items.forEach(item => {
        if (!item.classList.contains('hidden')) {
            newShown++;
        }
    });

    // 🔥 baru cek setelah benar-benar tampil
    if (newShown >= items.length) {
        button.style.display = 'none';
    }
}
</script>

@endsection