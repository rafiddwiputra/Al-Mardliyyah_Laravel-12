{{-- Wrapper Diperkuat dengan w-screen dan h-screen agar memaksa full layar --}}
<div id="modalEditVideo" class="fixed inset-0 w-screen h-screen z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
    
    {{-- Content Box dipaksa berukuran konsisten max-w-[600px] seperti Tambah Video --}}
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-[600px] mx-4 overflow-hidden transform scale-95 transition-transform duration-300 max-h-[95vh] flex flex-col" id="modalContentEditVideo">
        
        {{-- Header Hijau --}}
        <div class="bg-[#1E5631] px-6 py-3 relative">
            <h3 class="text-white text-center font-bold text-lg">Edit Video</h3>
            {{-- Tombol X untuk close modal dari atas --}}
            <button onclick="closeEditVideoModal()" class="absolute right-4 top-3 text-white/80 hover:text-white transition-colors focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        {{-- Form Area --}}
        <form id="formEditVideo" method="POST" enctype="multipart/form-data" class="p-8 space-y-5 overflow-y-auto">
            @csrf
            @method('PUT') 
            
            {{-- Upload Thumbnail dengan Preview & Batas 2MB --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">Upload Thumbnail (Maks 2MB):</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer relative" id="dropzone_edit">
                    
                    {{-- Input File --}}
                    <input type="file" id="edit_thumbnail_video" name="thumbnail" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewEditVideoThumbnail(this)">
                    
                    {{-- Placeholder Drag & Drop --}}
                    <div id="edit_placeholder_video" class="text-center z-0">
                        <p class="text-gray-500 text-sm mb-4">Drag & Drop gambar di sini</p>
                        <div class="flex justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                    </div>

                    {{-- Preview Gambar Asli/Baru --}}
                    <img id="edit_preview_video_img" class="hidden max-h-32 rounded-lg shadow-sm relative z-10 object-contain">
                </div>
                
                {{-- Pesan Error & Keterangan --}}
                <div class="flex justify-between items-start mt-2">
                    <p class="text-xs text-gray-400">*Biarkan kosong jika tidak mengubah gambar.</p>
                    <p id="edit_error_size_video" class="text-xs text-red-600 font-bold hidden">❌ Ukuran melebihi 2MB!</p>
                </div>
            </div>

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">Judul:</label>
                <input type="text" id="edit_judul_video" name="judul" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-[#1E5631]" placeholder="Masukkan judul video..." required>
            </div>
            
            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">Deskripsi:</label>
                <textarea id="edit_deskripsi_video" name="deskripsi" rows="4" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-[#1E5631]" placeholder="Masukkan deskripsi..." required></textarea>
            </div>

            {{-- Link Youtube --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">Link Youtube:</label>
                <input type="url" id="edit_link_yt_video" name="link_yt" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-[#1E5631]" placeholder="Contoh: https://www.youtube.com/watch?v=..." required>
            </div>

            {{-- Footer Buttons --}}
            <div class="flex gap-4 pt-4">
                <button type="button" onclick="closeEditVideoModal()" class="flex-1 py-2 border border-gray-300 rounded text-black font-medium hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex-1 py-2 bg-[#1E5631] text-white rounded font-medium hover:bg-[#174427] transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>