@extends('layouts.admin')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold text-[#1E5631]">
        Manajemen Galeri
    </h2>
    <p class="text-sm text-gray-500 mb-6">
        Kelola foto pondok pesantren Al-Mardliyyah
    </p>

    <!-- FILTER + BUTTON -->
    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">

        <!-- FILTER -->
        <div class="flex gap-2 flex-wrap">
            <button onclick="filterKategori('semua', event)"
                class="filter-btn px-4 py-2 rounded-lg text-sm bg-[#1E5631] text-white">
                Semua
            </button>

            <button onclick="filterKategori('santri', event)"
                class="filter-btn px-4 py-2 rounded-lg text-sm border text-[#1E5631]">
                Kegiatan Santri
            </button>

            <button onclick="filterKategori('belajar', event)"
                class="filter-btn px-4 py-2 rounded-lg text-sm border text-[#1E5631]">
                Kegiatan Belajar
            </button>

            <button onclick="filterKategori('fasilitas', event)"
                class="filter-btn px-4 py-2 rounded-lg text-sm border text-[#1E5631]">
                Fasilitas Pondok
            </button>

            <button onclick="filterKategori('acara', event)"
                class="filter-btn px-4 py-2 rounded-lg text-sm border text-[#1E5631]">
                Acara Pondok
            </button>
        </div>

        <!-- BUTTON UPLOAD -->
        <button onclick="openModal('uploadModal')"
            class="bg-[#1E5631] text-white px-4 py-2 rounded-lg text-sm">
            + Upload Foto
        </button>

    </div>

    <!-- DATA -->
    @php
    $galeri = [
        ['judul'=>'Sholat Berjamaah di Masjid','kategori'=>'santri'],
        ['judul'=>'Belajar Kitab','kategori'=>'belajar'],
        ['judul'=>'Asrama','kategori'=>'fasilitas'],
        ['judul'=>'Pengajian','kategori'=>'acara'],
        ['judul'=>'Sholat Subuh','kategori'=>'santri'],
        ['judul'=>'Belajar Hadist','kategori'=>'belajar'],
        ['judul'=>'Kamar Santri','kategori'=>'fasilitas'],
        ['judul'=>'Wisuda Santri','kategori'=>'acara'],
    ];
    @endphp

    <!-- GRID -->
    <div class="grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(250px,1fr))]">

        @foreach($galeri as $item)
        <div class="galeri-item bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition"
             data-kategori="{{ $item['kategori'] }}">

            <!-- IMAGE -->
            <div class="h-40 bg-gray-300"></div>

            <!-- CONTENT -->
            <div class="p-4">

                <p class="text-sm font-semibold text-[#1E5631] mb-3">
                    {{ $item['judul'] }}
                </p>

                <div class="flex gap-2">

                    <button onclick="openModal('editModal')"
                        class="flex-1 bg-blue-100 font-bold text-blue-600 text-xs py-1.5 rounded">
                        Edit
                    </button>

                    <button onclick="openModal('deleteModal')"
                        class="flex-1 bg-red-100 font-bold text-red-600 text-xs py-1.5 rounded">
                        Hapus
                    </button>

                </div>

            </div>

        </div>
        @endforeach

    </div>

</div>

<!-- MODALS -->
@include('pages.admin.galeri.galeri-tambah')
@include('pages.admin.galeri.galeri-edit')
@include('pages.admin.galeri.galeri-hapus')

<!-- JAVASCRIPT -->
<script>

// MODAL
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

// FILTER KATEGORI
function filterKategori(kategori, event) {
    const items = document.querySelectorAll('.galeri-item');
    const buttons = document.querySelectorAll('.filter-btn');

    // reset tombol
    buttons.forEach(btn => {
        btn.classList.remove('bg-[#1E5631]', 'text-white');
        btn.classList.add('border', 'text-[#1E5631]');
    });

    // aktifkan tombol yang diklik
    event.target.classList.add('bg-[#1E5631]', 'text-white');
    event.target.classList.remove('border');

    // filter item
    items.forEach(item => {
        if (kategori === 'semua' || item.dataset.kategori === kategori) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

</script>

@endsection