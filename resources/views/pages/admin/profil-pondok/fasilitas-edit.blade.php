<div id="modalEditFasilitas" 
     class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    
    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-lg shadow-lg">
        
        <div class="bg-[#1E5631] text-white text-center py-3 font-semibold rounded-t-xl uppercase tracking-widest text-xs">
            Edit Fasilitas
        </div>

        <form id="formEditFasilitas" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-5 space-y-4">
                {{-- NAMA FASILITAS --}}
                <div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Fasilitas</label>
    
    <input type="text" name="nama_fasilitas" id="edit_nama_fasilitas" required maxlength="100"
        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631] focus:border-[#1E5631] transition-all">

    <p class="text-[10px] text-gray-400 italic mt-1">*Maksimal 100 karakter.</p>
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
                        <img id="edit_preview_fasilitas_img" 
                            src="" 
                                class="w-full h-32 object-contain rounded-lg border border-gray-200 bg-gray-50 p-2">
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
                        class="px-4 py-2 text-sm bg-[#1E5631] text-white rounded-lg text-sm font-bold hover:bg-[#1E5631] shadow-md transition-all">
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