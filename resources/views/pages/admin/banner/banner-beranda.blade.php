@extends('layouts.admin')

@section('content')

<div id="toast-container"
    class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 items-end pointer-events-none">

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

<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">

   

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1E5631]">
            Pengaturan Banner
        </h1>
        <p class="text-sm text-gray-500">
            Mengatur gambar banner utama di halaman beranda pengunjung
        </p>
    </div>

    <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">

            <div class="border border-[#D9D9D9] rounded-xl p-6 bg-white">
                
                <div class="mb-4">
                    <h2 class="text-sm font-semibold text-[#1E5631]">
                        Tambah Banner Baru
                    </h2>
                    <p class="text-xs text-gray-500 mb-4">
                        Unggah gambar landscape untuk tampilan terbaik (Maks: 2MB)
                    </p>
                </div>

                <div class="mb-4">
                    <label class="block text-xs text-black mb-2">
                        Judul Banner <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" required maxlength="50" placeholder="Contoh: Pendaftaran 2026"
                           class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs text-black mb-2">
                        File Gambar Background <span class="text-red-500">*</span>
                    </label>

                    <label class="flex flex-col items-center justify-center w-full h-32 border border-[#D9D9D9] border-dashed rounded cursor-pointer hover:bg-gray-50 transition text-center relative overflow-hidden">

                        <span class="text-[11px] text-gray-400 upload-text">
                            Klik untuk Upload Gambar
                        </span>

                        <p class="text-xs text-green-600 mt-2 file-name hidden z-10 bg-white px-2 py-1 rounded shadow"></p>

                        <img class="preview-image hidden absolute inset-0 w-full h-full object-cover opacity-50">

                        <input type="file" name="gambar" required accept="image/jpeg, image/png, image/jpg" class="hidden file-input">
                    </label>
                </div>

            </div>

            <div class="flex justify-end gap-2">
                <button type="reset" class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-100">
                    Batal
                </button>

                <button type="submit" class="px-4 py-2 bg-[#1E5631] text-white rounded hover:bg-[#17472a]">
                    Simpan Banner
                </button>
            </div>

        </div>
    </form>

    <div class="mt-10">
        <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold text-[#1E5631]">
            Daftar Banner Saat Ini
        </h2>
    </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($banners as $item)
                <div class="border border-[#D9D9D9] rounded-lg overflow-hidden bg-white shadow-sm relative group">
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-40 object-cover">
                    
                    <div class="p-4 flex justify-between items-center">
                        <span class="text-sm font-semibold text-gray-800">{{ $item->judul }}</span>
                        
                        <button type="button"
    onclick="openDeleteModal('{{ route('admin.banner.destroy', $item->id) }}', '{{ $item->judul }}')"
    class="text-red-500 hover:text-red-700 text-sm font-bold">
    Hapus
</button>
                    </div>

                    <div class="absolute top-2 left-2 bg-[#C6A75E] text-[#1E5631] text-xs font-bold px-2 py-1 rounded">
                        Banner Utama
                    </div>
                </div>
            @empty
                <div class="col-span-full py-8 text-center text-gray-400 border border-dashed rounded bg-gray-50">
                    Belum ada banner yang diunggah.
                </div>
            @endforelse
        </div>
    </div>

</div>


{{-- MODAL HAPUS BANNER --}}
<div id="modalHapusBanner"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-sm shadow-lg">

        <div class="bg-[#FCA5A5] py-2 rounded-t-lg">
            <h2 class="text-center text-[#B91C1C] font-bold text-base">
                Konfirmasi Hapus
            </h2>
        </div>

        <div class="p-5 text-center">
            <p class="text-sm text-gray-600 mb-2">
                Apakah Anda yakin ingin menghapus banner ini secara permanen?
            </p>

            <p class="text-sm font-bold text-[#1E5631] mb-5">
                <span id="hapus_banner_judul"></span>
            </p>

            <form id="formHapusBanner" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex justify-center gap-2 py-4">
                    <button type="button"
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 text-sm border border-[#D9D9D9] rounded text-gray-600 hover:bg-gray-50">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 text-sm bg-[#B91C1C] text-white rounded hover:bg-red-700 shadow-sm transition-colors">
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Hanya mempertahankan JS untuk preview gambar
document.querySelectorAll('.file-input').forEach(input => {
    input.addEventListener('change', function() {

        const file = this.files[0];
        if(!file) return;

        const label = this.closest('label');

        const fileNameText = label.querySelector('.file-name');
        const previewImage = label.querySelector('.preview-image');
        const uploadText = label.querySelector('.upload-text');

        // tampilkan nama file
        fileNameText.textContent = "Terpilih: " + file.name;
        fileNameText.classList.remove('hidden');

        // sembunyikan text upload
        uploadText.classList.add('hidden');

        // tampilkan preview gambar sebagai background cover
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    });
});

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


    // ================= MODAL HAPUS BANNER =================
function openDeleteModal(action, judul) {
    document.getElementById('formHapusBanner').action = action;
    document.getElementById('hapus_banner_judul').innerText = judul;

    const modal = document.getElementById('modalHapusBanner');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteModal() {
    const modal = document.getElementById('modalHapusBanner');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

@endsection