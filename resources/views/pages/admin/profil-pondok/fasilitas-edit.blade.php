<div id="modalEditFasilitas" 
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-[9999] opacity-0 transition-opacity duration-300">
    
    <div class="bg-white w-full max-w-lg rounded-xl shadow-lg transform transition-transform duration-300 scale-95 mx-4" id="modalEditFasilitasContent">
        
        <div class="bg-[#2D7FF9] text-white text-center py-3 font-semibold rounded-t-xl uppercase tracking-widest text-xs">
            Edit Fasilitas
        </div>

        <form id="formEditFasilitas" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                {{-- NAMA FASILITAS --}}
                <div>
                    <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas" id="edit_nama_fasilitas" required
                        class="w-full border border-[#D9D9D9] rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#2D7FF9] outline-none">
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase">Deskripsi (Maks 150 Karakter)</label>
                    <textarea name="deskripsi" id="edit_deskripsi_fasilitas" rows="3" maxlength="150"
                        class="w-full border border-[#D9D9D9] rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#2D7FF9] outline-none"></textarea>
                </div>

                {{-- GAMBAR --}}
                <div>
                    <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase">Foto Fasilitas</label>
                    
                    {{-- Preview Gambar Lama --}}
                    <div class="mb-2">
                        <img id="edit_preview_fasilitas_img" src="" class="w-full h-32 object-cover rounded-lg border border-gray-200">
                        <p class="text-[9px] text-gray-400 mt-1 italic">*Biarkan jika tidak ingin mengganti foto</p>
                    </div>

                    <label class="flex flex-col items-center justify-center w-full h-20 border-2 border-dashed border-[#D9D9D9] rounded-xl cursor-pointer hover:bg-gray-50 transition-all">
                        <span class="text-[10px] font-medium uppercase text-gray-500">Pilih Foto Baru</span>
                        <input type="file" name="gambar" class="hidden" onchange="previewEditFasilitasImg(this)">
                    </label>
                </div>

                {{-- FOOTER --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeEditFasilitasModal()"
                        class="px-6 py-2 border border-gray-200 rounded-lg text-sm font-bold text-gray-600 hover:bg-gray-100 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-[#2D7FF9] text-white rounded-lg text-sm font-bold hover:bg-[#1a66d6] shadow-md transition-all">
                        Update Fasilitas
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewEditFasilitasImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('edit_preview_fasilitas_img').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>