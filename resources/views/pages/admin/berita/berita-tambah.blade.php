<div id="modalTambah"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-lg shadow-lg overflow-hidden">

        <div class="bg-[#1E5631] py-2">
            <h2 class="text-center text-white font-medium text-base">
                Tambah Berita
            </h2>
        </div>

        <div class="p-5">
            {{-- PENTING: Tambahkan action, method, dan enctype untuk upload file --}}
           <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">Judul Berita</label>
                    <input type="text" name="judul" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                </div>

                <div class="mb-5">
                    <label class="block text-sm text-[#000000] mb-2">Upload Gambar Berita</label>

                    <label id="drop-area"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-[#D9D9D9] rounded cursor-pointer hover:bg-gray-50 transition overflow-hidden">
                        
                        {{-- Tempat pratinjau gambar akan muncul di sini --}}
                        <div id="preview-container" class="flex flex-col items-center justify-center text-center p-2">
                            <span class="text-sm text-gray-500">Drag & Drop gambar di sini</span>
                            <span class="text-xs text-gray-400 mt-1">atau klik untuk memilih file</span>
                        </div>

                        <input type="file" name="gambar" id="file-input" class="hidden" accept="image/*" required>
                    </label>
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">Isi Berita</label>
                    <textarea name="deskripsi" rows="4" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">Tanggal Publikasi</label>
                    <input type="date" name="tanggal" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">Status</label>
                    <select name="status" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                        <option value="">Pilih Status</option>
                        <option value="draft">Draft</option>
                        <option value="publish">Publish</option>
                    </select>
                </div>

                <div class="flex justify-center gap-2">
                    <button type="button" onclick="closeTambahModal()"
                        class="px-4 py-2 text-sm bg-[#D9D9D9] border border-[#D9D9D9] rounded text-[#333333]">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm bg-[#1E5631] text-white rounded">
                        Simpan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Logika Preview Gambar
    const fileInput = document.getElementById('file-input');
    const previewContainer = document.getElementById('preview-container');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Ganti isi container dengan gambar yang dipilih
                previewContainer.innerHTML = `
                    <img src="${e.target.result}" class="h-24 w-auto object-cover rounded mb-1">
                    <p class="text-[10px] text-green-700 font-bold truncate w-40">${file.name}</p>
                `;
            }
            reader.readAsDataURL(file);
        }
    });
</script>