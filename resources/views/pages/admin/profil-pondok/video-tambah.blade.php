<div id="modalTambahVideo" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-2xl w-[600px] overflow-hidden transform scale-95 transition-transform duration-300" id="modalContentVideo">
        
        <div class="bg-[#1E5631] px-6 py-3">
            <h3 class="text-white text-center font-bold text-lg">Tambah Video</h3>
        </div>

        <form action="{{ route('admin.video.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-5">
            @csrf
            
            <div>
                <label class="block text-sm font-bold text-black mb-2">Upload Thumbnail:</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer relative" id="dropzone">
                    <input type="file" name="thumbnail" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="fileInput" onchange="previewImage(event)">
                    <div class="text-center" id="preview-text">
                        <p class="text-gray-500 text-sm mb-4">Drag & Drop gambar di sini</p>
                        <div class="flex justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                        </div>
                    </div>
                    <img id="image-preview" class="hidden max-h-32 rounded-lg shadow-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-black mb-2">Judul:</label>
                <input type="text" name="judul" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-[#1E5631]" placeholder="Masukkan judul video..." required>
            </div>

            <div>
                <label class="block text-sm font-bold text-black mb-2">Deskripsi:</label>
                <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-[#1E5631]" placeholder="Masukkan deskripsi..." required></textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-black mb-2">Link Youtube:</label>
                <input type="url" name="link_yt" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-[#1E5631]" placeholder="Contoh: https://www.youtube.com/watch?v=..." required>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="button" onclick="closeTambahVideoModal()" class="flex-1 py-2 border border-gray-300 rounded text-black font-medium hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex-1 py-2 bg-[#1E5631] text-white rounded font-medium hover:bg-[#174427] transition-colors">
                    Upload Video
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openTambahVideoModal() {
    const modal = document.getElementById('modalTambahVideo');
    const content = document.getElementById('modalContentVideo');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        content.classList.remove('scale-95');
        content.classList.add('scale-100');
    }, 10);
}


function closeTambahVideoModal() {
    const modal = document.getElementById('modalTambahVideo');
    const content = document.getElementById('modalContentVideo');
    modal.classList.add('opacity-0');
    content.classList.remove('scale-100');
    content.classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Fungsi Preview Gambar setelah di-upload
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('image-preview');
        const text = document.getElementById('preview-text');
        preview.src = reader.result;
        preview.classList.remove('hidden');
        text.classList.add('hidden');
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>