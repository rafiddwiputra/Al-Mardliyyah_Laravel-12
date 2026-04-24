@extends('layouts.admin')

@section('content')

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

<div class="p-6">

   

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

            <div class="border border-[#D9D9D9] rounded p-5 bg-white">
                
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
        <h2 class="text-lg font-bold text-[#1E5631] mb-4 border-b pb-2">
            Daftar Banner Saat Ini
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($banners as $item)
                <div class="border border-[#D9D9D9] rounded-lg overflow-hidden bg-white shadow-sm relative group">
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-40 object-cover">
                    
                    <div class="p-4 flex justify-between items-center">
                        <span class="text-sm font-semibold text-gray-800">{{ $item->judul }}</span>
                        
                        <form action="{{ route('admin.banner.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">
                                Hapus
                            </button>
                        </form>
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
</script>

@endsection