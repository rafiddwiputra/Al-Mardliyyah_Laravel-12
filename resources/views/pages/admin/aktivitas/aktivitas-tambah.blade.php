<div id="tambahAktivitasModal" 
      class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm items-center justify-center overflow-y-auto z-50 opacity-0 transition-opacity duration-300">
    
    <div class="bg-white w-full max-w-lg rounded-xl overflow-visible shadow-lg transform transition-transform duration-300 scale-95">

        {{-- HEADER --}}
        <div class="bg-[#1E5631] text-white text-center py-3 font-semibold rounded-t-xl">
            Tambah Aktivitas
        </div>

        <form action="{{ route('admin.aktivitas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="p-5 space-y-4">

                {{-- INPUT GAMBAR --}}
                <p class="text-sm font-medium text-gray-700">Gambar Aktivitas</p>
                <div onclick="document.getElementById('fileInputAktivitas').click()" 
                     class="border-2 border-dashed border-gray-300 rounded-lg min-h-[180px] flex flex-col items-center justify-center text-gray-400 text-sm cursor-pointer hover:border-[#1E5631] hover:bg-gray-50 transition-all overflow-hidden relative p-3" 
                     id="dropAreaAktivitas">
                    
                    <img id="imagePreviewAktivitas" 
                        class="hidden max-h-[250px] max-w-full object-contain rounded">

                    <div id="placeholderAktivitas" class="flex flex-col items-center p-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01" />
                        </svg>
                        <span id="fileNameAktivitas">Klik untuk pilih gambar atau Drag & Drop</span>
                        <p class="text-[10px] mt-1 opacity-60 uppercase">JPG, PNG (Max 2MB)</p>
                    </div>
                </div>

                <input type="file" name="gambar" id="fileInputAktivitas"
                    class="hidden" required onchange="previewImageAktivitas(this)">

                {{-- NAMA AKTIVITAS --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Aktivitas</label>
                    <input type="text" name="nama_aktivitas" required
                        placeholder="Contoh: Sholat Berjamaah"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#1E5631]">
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" required
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#1E5631]"></textarea>
                </div>

                {{-- ACTION --}}
                <div class="flex justify-between gap-3 pt-4">
                    <button type="button"
                        onclick="closeModal('tambahAktivitasModal')"
                        class="flex-1 border rounded-lg py-2.5 text-sm font-bold text-gray-600 hover:bg-gray-100">
                        Batal
                    </button>

                    <button type="submit"
                        class="flex-1 bg-[#1E5631] text-white rounded-lg py-2.5 text-sm font-bold hover:bg-[#17472A]">
                        Simpan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>