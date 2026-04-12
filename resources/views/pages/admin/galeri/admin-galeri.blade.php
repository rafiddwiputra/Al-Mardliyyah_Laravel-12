@extends('layouts.admin')

@section('content')

<div class="p-6">
    <h2 class="text-2xl font-bold text-[#1E5631]">Manajemen Galeri</h2>
    <p class="text-sm text-gray-500 mb-6">Kelola foto pondok pesantren Al-Mardliyyah</p>

    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <div class="flex gap-2 flex-wrap">
            <button onclick="filterKategori('semua', event)"
                class="filter-btn px-4 py-2 rounded-lg text-sm bg-[#1E5631] text-white">
                Semua
            </button>
            @foreach($categories as $cat)
            <button onclick="filterKategori('{{ $cat->id }}', event)"
                class="filter-btn px-4 py-2 rounded-lg text-sm border text-[#1E5631] hover:bg-gray-50 transition">
                {{ $cat->nama_kategori }}
            </button>
            @endforeach
        </div>

    <div class="flex gap-2">
    <button onclick="openModal('kategoriModal')"
        class="border border-[#1E5631] text-[#1E5631] px-4 py-2 rounded-lg text-sm font-bold hover:bg-[#1E5631] hover:text-white transition-all">
        + Kategori
    </button>

    <button onclick="openModal('uploadModal')"
        class="bg-[#1E5631] text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md hover:bg-[#164227] transition">
        + Upload Foto
    </button>

</div>
    </div>

    <div class="grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(250px,1fr))]">
        @forelse($galeris as $item)
        <div class="galeri-item bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition border border-gray-100"
             data-kategori="{{ $item->kategori_id }}">

            <div class="h-48 bg-gray-200 overflow-hidden">
                <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
            </div>

            <div class="p-4">
                <p class="text-sm font-semibold text-[#1E5631] mb-1 truncate" title="{{ $item->judul }}">
                    {{ $item->judul }}
                </p>
                <p class="text-[10px] text-gray-400 mb-3 uppercase tracking-wider italic">
                    {{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                </p>

                <div class="flex gap-2">
                    {{-- Tombol Edit dengan mempassing data JSON --}}
                    <button onclick='openEditModal(@json($item))'
                        class="flex-1 bg-blue-100 font-bold text-blue-600 text-xs py-2 rounded hover:bg-blue-200 transition">
                        Edit
                    </button>

                    {{-- Tombol Hapus dengan mempassing ID dan Judul --}}
                    <button onclick="openDeleteModal('{{ $item->id }}', '{{ $item->judul }}')"
                        class="flex-1 bg-red-100 font-bold text-red-600 text-xs py-2 rounded hover:bg-red-200 transition">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl py-20 text-center">
            <p class="text-gray-400">Belum ada foto yang diunggah.</p>
        </div>
        @endforelse
    </div>
</div>

@include('pages.admin.galeri.galeri-tambah')
@include('pages.admin.galeri.galeri-edit')
@include('pages.admin.galeri.galeri-hapus')
@include('pages.admin.galeri.galeri-kategori')

<script>
// Fungsi Open Modal (Gunakan versi smooth yang kita buat tadi)
function openModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => { modal.classList.add('opacity-100'); }, 10);
}

function closeModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('opacity-100');
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

// KHUSUS EDIT: Mengisi data ke modal edit
function openEditModal(data) {
    // Isi value input di galeri-edit.blade.php
    document.getElementById('edit_judul').value = data.judul;
    document.getElementById('edit_kategori').value = data.kategori_id;
    document.getElementById('edit_kategori_text').innerText = data.kategori.nama_kategori;
    
    // Set action form agar mengarah ke ID yang benar
    document.getElementById('formEditGaleri').action = `/admin/galeri/update/${data.id}`;
    
    openModal('editModal');
}

// KHUSUS HAPUS: Set action dan nama di modal hapus
function openDeleteModal(id, judul) {
    document.getElementById('hapus_judul_text').innerText = judul;
    document.getElementById('formHapusGaleri').action = `/admin/galeri/destroy/${id}`;
    openModal('deleteModal');
}

// FILTER KATEGORI (Sekarang pakai ID Kategori)
function filterKategori(kategoriId, event) {
    const items = document.querySelectorAll('.galeri-item');
    const buttons = document.querySelectorAll('.filter-btn');

    buttons.forEach(btn => {
        btn.classList.remove('bg-[#1E5631]', 'text-white');
        btn.classList.add('border', 'text-[#1E5631]');
    });

    event.target.classList.add('bg-[#1E5631]', 'text-white');
    event.target.classList.remove('border');

    items.forEach(item => {
        // Cek data-kategori (ID)
        if (kategoriId === 'semua' || item.dataset.kategori == kategoriId) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>

@endsection