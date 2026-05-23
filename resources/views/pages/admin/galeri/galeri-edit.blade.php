<div id="editModal"
      class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm items-center justify-center overflow-y-auto z-50 opacity-0 transition-opacity duration-300">
     
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
                    class="border border-gray-300 rounded-lg min-h-[180px] flex items-center justify-center text-gray-400 text-sm overflow-hidden bg-gray-50 cursor-pointer hover:border-[#1E5631] transition-all relative p-3">
    
                <img id="editImagePreview" 
                    class="max-h-[250px] max-w-full object-contain rounded">
                    
                    <div class="absolute inset-0 bg-black/20 opacity-0 hover:opacity-100 flex items-center justify-center transition-opacity">
                        <span class="text-white text-xs bg-[#1E5631] px-3 py-1 rounded-full">Ganti Foto</span>
                    </div>
                </div>

                <input type="file" name="gambar" id="editFileInput" class="hidden" onchange="previewEditImage(this)">
                <p class="text-[10px] text-gray-400 italic text-center">Abaikan jika tidak mengganti foto</p>

                {{-- BAGIAN YANG DIRUBAH: Tambah maxlength dan Helper Text --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Kegiatan/Foto</label>
                    <input type="text" name="judul" id="edit_judul" maxlength="100" required
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
                    <p class="text-[10px] text-gray-400 italic mt-1">*Maksimal 100 karakter.</p>
                </div>

                {{-- Input Kategori (Sekarang pakai standard Select Dropdown statis) --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Kategori</label>
                    <select name="kategori" id="edit_kategori" required 
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#1E5631] transition-all bg-white cursor-pointer hover:bg-gray-50">
                        <option value="" disabled>-- Pilih Kategori --</option>
                        {{-- Looping string ENUM --}}
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
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
</script>