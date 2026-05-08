@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">

    <div id="toast-container" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 items-end pointer-events-none">
    
    @if(session('success'))
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-green-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Berhasil</h4>
                <p class="text-xs text-gray-500 mt-0.5">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-red-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Gagal</h4>
                <p class="text-xs text-gray-500 mt-0.5">{{ session('error') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-red-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Peringatan</h4>
                <ul class="list-disc list-inside mt-1 text-xs text-gray-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

</div>

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
                        Judul 
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

{{-- ================= AKTIVITAS SANTRI ================= --}}
<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm mt-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1E5631]">
           Manajemen Aktivitas Santri
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola semua aktivitas santri pondok pesantren Al-Mardliyyah
        </p>
    </div>

    {{-- BUTTON --}}
    <div class="flex justify-end mb-4">
        <button onclick="openModal('tambahAktivitasModal')"
            class="bg-[#1E5631] text-white px-5 py-2 rounded-lg text-sm font-bold hover:bg-[#17472a] transition shadow-sm">
            + Tambah Aktivitas
        </button>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="w-full border border-[#D9D9D9] border-collapse">
            <thead>
                <tr class="bg-white border-b border-[#D9D9D9]">
                    <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9] w-32">
                        Foto
                    </th>
                    <th class="p-4 text-left font-bold text-black border-r border-[#D9D9D9]">
                        Nama Aktivitas
                    </th>
                    <th class="p-4 text-left font-bold text-black border-r border-[#D9D9D9]">
                        Deskripsi
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
                @forelse($aktivitas as $item)
                <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition">

                    <td class="p-4 border-r border-[#D9D9D9] text-center">
                        <img src="{{ asset($item->gambar) }}"
                            class="w-16 h-12 object-cover rounded mx-auto border border-[#D9D9D9]">
                    </td>

                    <td class="p-4 text-sm text-[#444444] border-r border-[#D9D9D9]">
                        {{ $item->nama_aktivitas }}
                    </td>

                    <td class="p-4 text-sm text-[#444444] border-r border-[#D9D9D9] truncate max-w-xs">
                        {{ Str::limit($item->deskripsi, 50) }}
                    </td>

                    <td class="p-4 text-sm text-center text-[#444444] border-r border-[#D9D9D9]">
                        {{ $item->created_at->format('d/m/Y') }}
                    </td>

                    <td class="px-5 py-6 text-center whitespace-nowrap">
                        <div class="flex gap-3 justify-center items-center">
                            <button onclick='openEditAktivitasModal(@json($item))'
                                class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded font-bold hover:bg-blue-200">
                                Edit
                            </button>

                            <button type="button"
                                onclick="openDeleteAktivitasModal('{{ $item->id }}', '{{ $item->nama_aktivitas }}')"
                                class="bg-red-100 text-red-600 px-4 py-1.5 rounded font-bold hover:bg-red-200">
                                Hapus
                            </button>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-sm text-[#444444] italic">
                        Belum ada aktivitas santri
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

@include('pages.admin.aktivitas.aktivitas-tambah')
@include('pages.admin.aktivitas.aktivitas-edit')
@include('pages.admin.aktivitas.aktivitas-hapus')

{{-- ================= AKTIVITAS SANTRI ================= --}}
<div id="tambahAktivitasModal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-lg rounded-xl overflow-hidden shadow-lg">

        <div class="bg-[#1E5631] text-white text-center py-3 font-semibold">
            Tambah Aktivitas
        </div>

        <div class="p-5 space-y-4">

            <form action="/admin/aktivitas-santri" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="text" name="nama_aktivitas" placeholder="Nama Aktivitas"
                    class="w-full border rounded-lg px-3 py-2 text-sm" required>

                <textarea name="deskripsi" placeholder="Deskripsi"
                    class="w-full border rounded-lg px-3 py-2 text-sm" required></textarea>

                <input type="file" name="gambar"
                    class="w-full border rounded-lg px-3 py-2 text-sm" required>

                <div class="flex gap-3 mt-4">
                    <button type="button" onclick="closeModal('tambahAktivitasModal')"
                        class="flex-1 border rounded-lg py-2 text-sm">
                        Batal
                    </button>

                    <button type="submit"
                        class="flex-1 bg-[#1E5631] text-white rounded-lg py-2 text-sm">
                        Simpan
                    </button>
                </div>
            </form>

        </div>

    </div>
</div>

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

    document.addEventListener("DOMContentLoaded", function() {
            const toasts = document.querySelectorAll('.toast-alert');
            
            toasts.forEach(function(toast, index) {
                setTimeout(function() {
                    toast.classList.remove('translate-x-full', 'opacity-0');
                    toast.classList.add('translate-x-0', 'opacity-100');
                }, 100 + (index * 150)); 
                setTimeout(function() {
                    toast.classList.remove('translate-x-0', 'opacity-100');
                    toast.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(function() {
                        toast.remove();
                    }, 500);
                }, 4000); 
            });
        });
</script>

<script>
function previewImageAktivitas(input) {
    const preview = document.getElementById('imagePreviewAktivitas');
    const placeholder = document.getElementById('placeholderAktivitas');
    const dropArea = document.getElementById('dropAreaAktivitas');
    const display = document.getElementById('fileNameAktivitas');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
            dropArea.classList.replace('border-gray-300', 'border-[#1E5631]');
        }

        reader.readAsDataURL(input.files[0]);
        display.innerText = input.files[0].name;
    }
}

function openEditAktivitasModal(data) {
    const form = document.getElementById('formEditAktivitas');

    form.action = `/admin/aktivitas-santri/${data.id}`;

    document.getElementById('edit_nama_aktivitas').value = data.nama_aktivitas;
    document.getElementById('edit_deskripsi').value = data.deskripsi;

    const preview = document.getElementById('editImagePreviewAktivitas');
    if (preview) preview.src = `/${data.gambar}`;

    console.log("FORM ACTION:", form.action);

    openModal('editAktivitasModal');
}

function openDeleteAktivitasModal(id, nama) {
    const form = document.getElementById('formHapusAktivitas');

    form.action = `/admin/aktivitas-santri/${id}`;

    document.getElementById('hapus_nama_aktivitas').innerText = nama;

    openModal('deleteAktivitasModal');
}
</script>

@endsection