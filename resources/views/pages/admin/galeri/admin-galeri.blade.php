@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-lg p-6 shadow-sm">

    {{-- ================= DETEKTOR ERROR & SUCCESS ================= --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center justify-between shadow-sm">
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center justify-between shadow-sm">
            <span class="font-bold">{{ session('error') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-400 text-red-700 rounded-lg shadow-sm">
            <strong class="font-bold">Gagal menyimpan data!</strong>
            <ul class="list-disc list-inside mt-2 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- ================= END DETEKTOR ================= --}}

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1E5631]">
            Manajemen Galeri
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola semua foto dokumentasi pondok pesantren Al-Mardliyyah
        </p>
    </div>

    {{-- Filter & Tombol Tambah Sejajar --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
        
        {{-- Filter Kategori --}}
        <div class="flex gap-2 flex-wrap">
            <button onclick="filterKategori('semua', event)"
                class="filter-btn px-4 py-1.5 rounded-lg text-xs font-semibold bg-[#1E5631] text-white transition border border-[#1E5631]">
                Semua
            </button>
            @foreach($categories as $cat)
            <button onclick="filterKategori('{{ $cat }}', event)"
                class="filter-btn px-4 py-1.5 rounded-lg text-xs font-semibold border border-[#D9D9D9] text-[#444444] hover:bg-gray-50 transition">
                {{ $cat }}
            </button>
            @endforeach
        </div>

        {{-- Tombol Upload --}}
        <button onclick="openModal('uploadModal')"
            class="bg-[#1E5631] text-white px-5 py-2 rounded-lg text-sm font-bold hover:bg-[#17472a] transition shadow-sm whitespace-nowrap">
            + Upload Foto
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-[#D9D9D9] border-collapse">
            <thead>
                <tr class="bg-white border-b border-[#D9D9D9]">
                    <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9] w-24">
                        Foto
                    </th>
                    <th class="p-4 text-left font-bold text-black border-r border-[#D9D9D9] w-1/3">
                        Judul Foto
                    </th>
                    <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                        Kategori
                    </th>
                    <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                        Tanggal
                    </th>
                    <th class="p-4 text-center font-bold text-black">
                        Aksi
                    </th>
                </tr>
            </thead>
            
            <tbody>
                @forelse($galeris as $item)
                <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition galeri-item" data-kategori="{{ $item->kategori }}">
                    
                    <td class="p-4 border-r border-[#D9D9D9] text-center">
                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" 
                             class="w-16 h-12 object-cover rounded mx-auto border border-[#D9D9D9]">
                    </td>

                    <td class="p-4 text-sm text-[#444444] border-r border-[#D9D9D9]">
                        {{ $item->judul }}
                    </td>

                    <td class="p-4 text-center border-r border-[#D9D9D9]">
                        <span class="text-[#1E5631] font-medium text-sm">
                            {{ $item->kategori }}
                        </span>
                    </td>

                    <td class="p-4 text-sm text-center text-[#444444] border-r border-[#D9D9D9]">
                        {{ $item->created_at->format('d/m/Y') }}
                    </td>

                    <td class="px-5 py-6 text-center align-middle whitespace-nowrap">
                        <div class="flex gap-3 justify-center items-center">
                            <button type="button" onclick='openEditModal(@json($item))'
                                class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded font-bold mr-2 hover:bg-blue-200 transition-colors focus:outline-none">
                                Edit
                            </button>
                            <button type="button" onclick="openDeleteModal('{{ $item->id }}', '{{ $item->judul }}')"
                                class="bg-red-100 text-red-600 px-4 py-1.5 rounded font-bold hover:bg-red-200 transition-colors focus:outline-none">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-sm text-[#444444] italic">
                        Belum ada foto galeri yang diunggah.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('pages.admin.galeri.galeri-tambah')
@include('pages.admin.galeri.galeri-edit')
@include('pages.admin.galeri.galeri-hapus')

<script>
// Fungsi Open & Close Modal
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

// KHUSUS EDIT
function openEditModal(data) {
    document.getElementById('edit_judul').value = data.judul;
    document.getElementById('edit_kategori').value = data.kategori;
    document.getElementById('formEditGaleri').action = `/admin/galeri/update/${data.id}`;
    
    const preview = document.getElementById('editImagePreview');
    if(preview) preview.src = `/${data.gambar}`;

    openModal('editModal');
}

// KHUSUS HAPUS
function openDeleteModal(id, judul) {
    document.getElementById('hapus_judul_text').innerText = judul;
    document.getElementById('formHapusGaleri').action = `/admin/galeri/destroy/${id}`;
    openModal('deleteModal');
}

// FILTER KATEGORI UNTUK TABEL
function filterKategori(kategoriString, event) {
    const items = document.querySelectorAll('.galeri-item');
    const buttons = document.querySelectorAll('.filter-btn');

    // Reset warna semua tombol
    buttons.forEach(btn => {
        btn.classList.remove('bg-[#1E5631]', 'text-white', 'border-[#1E5631]');
        btn.classList.add('border', 'border-[#D9D9D9]', 'text-[#444444]');
    });

    // Aktifkan warna tombol yang diklik
    event.target.classList.add('bg-[#1E5631]', 'text-white', 'border-[#1E5631]');
    event.target.classList.remove('border-[#D9D9D9]', 'text-[#444444]');

    // Filter baris tabel (menggunakan 'table-row')
    items.forEach(item => {
        if (kategoriString === 'semua' || item.dataset.kategori === kategoriString) {
            item.style.display = 'table-row'; 
        } else {
            item.style.display = 'none';
        }
    });
}
</script>

@endsection