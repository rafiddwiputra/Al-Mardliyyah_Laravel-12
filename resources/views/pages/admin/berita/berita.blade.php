@extends('layouts.admin')

@section('content')

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
                    <?php foreach ($errors->all() as $error): ?>
                        <li>{{ $error }}</li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif
</div>

<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1E5631]">Manajemen Berita</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola semua artikel berita pondok pesantren al-mardliyyah</p>
    </div>

    <div class="flex justify-end mb-4">
        <button onclick="openTambahModal()" class="bg-[#1E5631] text-white px-5 py-2 rounded-lg text-sm font-bold hover:bg-[#17472a] transition shadow-sm">
            + Tambah Berita
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-[#D9D9D9] border-collapse">
            <thead>
                <tr class="bg-white border-b border-[#D9D9D9]">
                    <th class="p-4 text-left font-bold text-black border-r border-[#D9D9D9] w-1/2">Judul Berita</th>
                    <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">Tanggal</th>
                    <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">Status</th>
                    <th class="p-4 text-center font-bold text-black">Aksi</th>
                </tr>
            </thead>
            
            <tbody>
                @if ($beritas->isNotEmpty())
                    <?php foreach ($beritas as $berita): ?>
                    <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition">
                        <td class="p-4 text-sm text-[#444444] border-r border-[#D9D9D9]">{{ $berita->judul }}</td>
                        <td class="p-4 text-sm text-center text-[#444444] border-r border-[#D9D9D9]">{{ \Carbon\Carbon::parse($berita->created_at)->format('d/m/Y') }}</td>
                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            <span class="text-[#1E5631] font-medium text-sm">
                                {{ $berita->status == 'publish' ? 'Dipublikasikan' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-5 py-6 text-center align-middle whitespace-nowrap">
                            <div class="flex justify-center gap-2">
                                <button type="button" onclick="openEditModal('{{ $berita->id }}')" class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded font-bold mr-2 hover:bg-blue-200 transition-colors focus:outline-none">
                                    Edit
                                </button>
                                <button type="button" onclick="openHapusModal({{ json_encode($berita) }})" class="bg-red-100 text-red-600 px-4 py-1.5 rounded font-bold hover:bg-red-200 transition-colors focus:outline-none">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                @else
                    <tr>
                        <td colspan="4" class="p-4 text-center text-sm text-gray-500">Belum ada data berita.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@include('pages.admin.berita.berita-tambah')
@include('pages.admin.berita.berita-hapus')

<?php foreach ($beritas as $berita): ?>
    @include('pages.admin.berita.berita-edit', ['berita' => $berita])
<?php endforeach; ?>

{{-- Script Inti CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

{{-- Script Logika Terpusat yang Bebas Crash --}}
<script>
    // Inisialisasi CKEditor Massal secara aman
    document.addEventListener("DOMContentLoaded", function() {
        const textareas = document.querySelectorAll('.ckeditor-textarea');
        textareas.forEach(textarea => {
            ClassicEditor
                .create(textarea, {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
                })
                .catch(error => console.error(error));
        });
    });

    // Sesudah
function openTambahModal() {
    document.getElementById('modalTambah').style.display = 'flex';
}
function closeTambahModal() {
    document.getElementById('modalTambah').style.display = 'none';
}

    // MODAL HAPUS
    function openHapusModal(data) {
        document.getElementById('modalHapus').classList.remove('hidden');
        const form = document.getElementById('formHapus');
        form.action = `/admin/berita/${data.id}`;
        document.getElementById('hapus_judul').innerText = data.judul;
    }
    function closeHapusModal() { document.getElementById('modalHapus').classList.add('hidden'); }

    // MODAL EDIT & PREVIEW GAMBAR
    function openEditModal(id) {
        const modal = document.getElementById('modalEdit' + id);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeEditModal(id) {
        const modal = document.getElementById('modalEdit' + id);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function previewEditImage(input, id) {
        const previewContainer = document.getElementById('preview-container-' + id);
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewContainer.innerHTML = `
                    <img src="${e.target.result}" class="h-24 w-auto object-cover rounded mb-1 shadow-sm">
                    <p class="text-[10px] text-green-700 font-bold truncate w-40">Gambar Baru: ${file.name}</p>
                `;
            }
            reader.readAsDataURL(file);
        }
    }

    // TOAST NOTIFICATION
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
                setTimeout(function() { toast.remove(); }, 500);
            }, 4000); 
        });
    });
</script>

@endsection