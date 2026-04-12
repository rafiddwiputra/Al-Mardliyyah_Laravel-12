<div id="editSejarahModal" 
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-[9999] opacity-0 transition-opacity duration-300">
    
    <div class="bg-white w-full max-w-4xl rounded-xl shadow-lg transform transition-transform duration-300 scale-95 mx-4" id="editSejarahModalContent">
        
        <div class="bg-[#2D7FF9] text-white text-center py-4 font-bold rounded-t-xl uppercase tracking-widest text-sm">
            Edit Peristiwa Sejarah
        </div>

        <form id="formEditSejarah" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 text-left">
                    
                    <div class="lg:col-span-8 space-y-4">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-1">
                                <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase tracking-wider">Tahun</label>
                                <input type="text" name="tahun" id="edit_tahun" required
                                    class="w-full border border-[#D9D9D9] rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#2D7FF9] outline-none">
                            </div>
                            <div class="col-span-3">
                                <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase tracking-wider">Judul Peristiwa</label>
                                <input type="text" name="judul" id="edit_judul" required
                                    class="w-full border border-[#D9D9D9] rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#2D7FF9] outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase tracking-wider">Deskripsi Singkat (Timeline)</label>
                            <textarea name="deskripsi_singkat" id="edit_deskripsi_singkat" rows="2"
                                class="w-full border border-[#D9D9D9] rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#2D7FF9] outline-none"></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase tracking-wider">Konten Detail / Narasi</label>
                            <textarea name="konten_detail" id="edit_konten_detail" rows="5"
                                class="w-full border border-[#D9D9D9] rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#2D7FF9] outline-none"></textarea>
                        </div>
                    </div>

                    <div class="lg:col-span-4">
                        <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase tracking-wider">Gambar Pendukung</label>
                        
                        <div class="mb-3 relative group h-40 border rounded-lg overflow-hidden bg-gray-50 border-[#D9D9D9]">
                            <img id="edit_preview_sejarah" src="" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-[10px] text-white font-bold uppercase">Gambar Saat Ini</span>
                            </div>
                        </div>

                        <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-[#D9D9D9] rounded-xl cursor-pointer hover:bg-gray-50 transition-all">
                            <div class="flex flex-col items-center justify-center pt-2 pb-3">
                                <svg class="w-6 h-6 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M12 12v9m0-9l-3 3m3-3l3 3" />
                                </svg>
                                <p class="text-[10px] font-medium text-gray-500 uppercase">Ganti Foto</p>
                            </div>
                            <input type="file" name="gambar" class="hidden" onchange="previewEditSejarah(this)">
                        </label>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeModal('editSejarahModal')"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-bold text-gray-600 hover:bg-gray-100 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-[#2D7FF9] text-white rounded-lg text-sm font-bold hover:bg-[#1a66d6] shadow-md transition-all">
                        Update Peristiwa
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewEditSejarah(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('edit_preview_sejarah').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>