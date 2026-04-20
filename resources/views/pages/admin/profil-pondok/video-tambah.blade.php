{{-- Wrapper dengan efek fade-in dan backdrop-blur --}}
<div id="modalTambahVideo" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
    
    {{-- Content Box dengan ukuran w-[600px] dan animasi zoom (scale) --}}
    <div class="bg-white rounded-lg shadow-2xl w-[600px] overflow-hidden transform scale-95 transition-transform duration-300 max-h-[95vh] flex flex-col" id="modalContentVideo">
        
        {{-- Header Hijau --}}
        <div class="bg-[#1E5631] px-6 py-3">
            <h3 class="text-white text-center font-bold text-lg">Tambah Video</h3>
        </div>

        {{-- Form Area (Bisa di-scroll jika kepanjangan) --}}
        {{-- PASTIKAN ACTION MENGARAH KE ROUTE STORE --}}
        <form action="{{ route('admin.video.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-5 overflow-y-auto">
            @csrf
            {{-- TIDAK ADA @method('PUT') DI SINI KARENA INI CREATE DATA BARU --}}
            
            {{-- Upload Thumbnail dengan Preview & Batas 2MB --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">Upload Thumbnail (Maks 2MB):</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer relative" id="dropzone_tambah">
                    
                    {{-- Input File (Perhatikan onchange memanggil previewImage) --}}
                    <input type="file" name="thumbnail" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" id="fileInput" onchange="previewImage(event)">
                    
                    {{-- Placeholder Drag & Drop --}}
                    <div id="preview-text" class="text-center z-0">
                        <p class="text-gray-500 text-sm mb-4">Drag & Drop gambar di sini</p>
                        <div class="flex justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                    </div>

                    {{-- Preview Gambar Baru --}}
                    <img id="image-preview" class="hidden max-h-32 rounded-lg shadow-sm relative z-10 object-contain">
                </div>
            </div>

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">Judul:</label>
                <input type="text" name="judul" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-[#1E5631]" placeholder="Masukkan judul video..." required>
            </div>
            
            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">Deskripsi:</label>
                <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-[#1E5631]" placeholder="Masukkan deskripsi..." required></textarea>
            </div>

            {{-- Link Youtube --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">Link Youtube:</label>
                <input type="url" name="link_yt" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-[#1E5631]" placeholder="Contoh: https://www.youtube.com/watch?v=..." required>
            </div>

            {{-- Footer Buttons --}}
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