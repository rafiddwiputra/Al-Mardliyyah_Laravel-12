<div id="editAktivitasModal"
     class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm items-center justify-center overflow-y-auto z-50 opacity-0 transition-opacity duration-300">
     
    <div class="bg-white w-full max-w-lg rounded-xl overflow-visible shadow-lg transform transition-transform duration-300 scale-95">

        <div class="bg-[#1E5631] text-white text-center py-3 font-semibold rounded-t-xl">
            Edit Aktivitas
        </div>

        <form id="formEditAktivitas" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-5 space-y-4">

                {{-- Preview Gambar --}}
                <p class="text-sm font-medium text-gray-700">Preview Gambar</p>
                <div onclick="document.getElementById('editFileAktivitas').click()" 
                    class="border border-gray-300 rounded-lg min-h-[180px] flex items-center justify-center overflow-hidden bg-gray-50 cursor-pointer relative p-3">

                    <img id="editImagePreviewAktivitas" 
                        class="max-h-[250px] max-w-full object-contain rounded">

                </div>

                <input type="file" name="gambar" id="editFileAktivitas" class="hidden">

                {{-- Nama Aktivitas --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Aktivitas</label>
                    <input type="text" name="nama_aktivitas" id="edit_nama_aktivitas" required
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm">
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" id="edit_deskripsi" required
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm"></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModal('editAktivitasModal')"
                        class="flex-1 border rounded-lg py-2 text-sm">
                        Batal
                    </button>

                    <button type="submit"
                        class="flex-1 bg-[#1E5631] text-white rounded-lg py-2 text-sm">
                        Simpan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>