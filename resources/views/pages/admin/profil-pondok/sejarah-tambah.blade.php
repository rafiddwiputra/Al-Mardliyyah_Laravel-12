<div id="tambahSejarahModal" 
     class="hidden fixed inset-0 bg-black/50 items-center justify-center z-[9999] opacity-0 transition-opacity duration-300 flex">
    
    <div class="bg-white w-full max-w-4xl rounded-xl shadow-2xl transform transition-transform duration-300 scale-95 mx-4" id="modalTambahContent">
        
        <div class="bg-[#1E5631] text-white text-center py-4 font-bold rounded-t-xl uppercase tracking-widest text-sm">
            Tambah Peristiwa Sejarah Baru
        </div>

        <form action="{{ route('admin.profil.sejarah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 text-left">
                    
                    <div class="lg:col-span-8 space-y-4">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-1">
                                <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase">Tahun</label>
                                <input type="text" name="tahun" placeholder="1985" required
                                    class="w-full border border-[#D9D9D9] rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#1E5631] outline-none">
                            </div>
                            <div class="col-span-3">
                                <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase">Judul Peristiwa</label>
                                <input type="text" name="judul" placeholder="Contoh: Pendirian Gedung Utama" required
                                    class="w-full border border-[#D9D9D9] rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#1E5631] outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase">Deskripsi Singkat (Timeline)</label>
                            <textarea name="deskripsi_singkat" rows="2"
                                class="w-full border border-[#D9D9D9] rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#1E5631] outline-none"></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase">Konten Detail (Paragraf)</label>
                            <textarea name="konten_detail" rows="4" placeholder="Tulis narasi lengkap di sini..."
                                class="w-full border border-[#D9D9D9] rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#1E5631] outline-none"></textarea>
                        </div>
                    </div>

                    <div class="lg:col-span-4">
                        <label class="block text-xs font-bold text-[#1E5631] mb-1 uppercase">Gambar Pendukung</label>
                        <div class="border-2 border-dashed border-[#D9D9D9] rounded-xl h-48 flex flex-col items-center justify-center text-gray-400 hover:bg-gray-50 cursor-pointer transition-all relative overflow-hidden"
                             onclick="document.getElementById('fileSejarahBaru').click()">
                            
                            <img id="previewTambahSejarah" class="hidden w-full h-full object-cover">
                            <div id="placeholderTambah" class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="text-[10px] font-medium uppercase">Klik Upload</span>
                            </div>
                            <input type="file" name="gambar" id="fileSejarahBaru" class="hidden" onchange="previewTambah(this)">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeModal('tambahSejarahModal')"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-bold text-gray-600 hover:bg-gray-100 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-[#1E5631] text-white rounded-lg text-sm font-bold hover:bg-[#164227] shadow-md transition-all">
                        Simpan Peristiwa
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>