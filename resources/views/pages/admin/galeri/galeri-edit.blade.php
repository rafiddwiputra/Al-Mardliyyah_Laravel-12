<div id="editModal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center overflow-y-auto z-50 opacity-0 transition-opacity duration-300">
     
    <div class="bg-white w-full max-w-lg rounded-xl overflow-visible shadow-lg transform transition-transform duration-300 scale-95" id="editModalContent">

        <div class="bg-[#1E5631] text-white text-center py-3 font-semibold rounded-t-xl">
            Edit Data Galeri
        </div>

        <form id="formEditGaleri" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-5 space-y-4">

                <p class="text-sm font-medium text-gray-700">Preview Gambar</p>
                <div onclick="document.getElementById('editFileInput').click()" 
                     class="border border-gray-300 rounded-lg h-40 flex items-center justify-center text-gray-400 text-sm overflow-hidden bg-gray-50 cursor-pointer hover:border-[#1E5631] transition-all relative">
                    
                    {{-- Preview Gambar Baru atau Lama --}}
                    <img id="editImagePreview" class="w-full h-full object-cover">
                    
                    <div class="absolute inset-0 bg-black/20 opacity-0 hover:opacity-100 flex items-center justify-center transition-opacity">
                        <span class="text-white text-xs bg-[#1E5631] px-3 py-1 rounded-full">Ganti Foto</span>
                    </div>
                </div>

                <input type="file" name="gambar" id="editFileInput" class="hidden" onchange="previewEditImage(this)">
                <p class="text-[10px] text-gray-400 italic text-center">*Kosongkan jika tidak ingin mengubah foto</p>

                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Kegiatan/Foto</label>
                    <input type="text" name="judul" id="edit_judul" required
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Kategori</label>
                    <div class="relative" id="editKategoriWrapper">
                        <input type="hidden" name="kategori_id" id="edit_kategori" value="">

                        <button type="button" onclick="toggleEditKategori()"
                            class="w-full mt-1 border rounded-lg px-3 py-2 text-sm text-left flex justify-between items-center bg-white">
                            <span id="edit_kategori_text">Pilih Kategori</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 transition-transform duration-300" id="editArrowIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div id="editKategoriMenu" class="hidden absolute w-full bg-white border rounded-lg mt-1 shadow-xl z-50 max-h-40 overflow-y-auto">
                            @foreach($categories as $cat)
                                <div onclick="pilihEditKategori('{{ $cat->id }}', '{{ $cat->nama_kategori }}')"
                                    class="px-3 py-2 text-sm cursor-pointer hover:bg-[#1E5631] hover:text-white border-b last:border-0">
                                    {{ $cat->nama_kategori }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex justify-between gap-3 pt-2 border-t border-gray-100">
                    <button type="button" onclick="closeModal('editModal')"
                        class="flex-1 border rounded-lg py-2 text-sm font-bold text-gray-700 hover:bg-gray-100 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#1E5631] text-white rounded-lg py-2 text-sm font-bold hover:opacity-90 shadow-md">
                        Simpan Perubahan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
/**
 * Preview gambar saat admin memilih file baru di modal edit
 */
function previewEditImage(input) {
    const preview = document.getElementById('editImagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function toggleEditKategori() {
    const menu = document.getElementById('editKategoriMenu');
    const arrow = document.getElementById('editArrowIcon');
    menu.classList.toggle('hidden');
    arrow.classList.toggle('rotate-180');
}

function pilihEditKategori(id, name) {
    document.getElementById('edit_kategori_text').innerText = name;
    document.getElementById('edit_kategori').value = id;
    document.getElementById('editKategoriMenu').classList.add('hidden');
    document.getElementById('editArrowIcon').classList.remove('rotate-180');
}

// Klik luar untuk tutup dropdown
document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('editKategoriWrapper');
    if (wrapper && !wrapper.contains(e.target)) {
        document.getElementById('editKategoriMenu').classList.add('hidden');
        document.getElementById('editArrowIcon').classList.remove('rotate-180');
    }
});
</script>