<div id="kategoriModal" 
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 opacity-0 transition-opacity duration-300">
    
    <div class="bg-white w-full max-w-md rounded-xl shadow-lg transform transition-transform duration-300 scale-95" id="kategoriModalContent">
        <div class="bg-[#1E5631] text-white text-center py-3 font-semibold rounded-t-xl">
            Tambah Kategori Galeri
        </div>

        <form action="{{ route('admin.galeri.kategori.store') }}" method="POST">
            @csrf
            <div class="p-5 space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="nama_kategori" required placeholder="Contoh: Kegiatan Ramadhan"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <div class="flex justify-between gap-3 pt-2">
                    <button type="button" onclick="closeModal('kategoriModal')"
                        class="flex-1 border border-gray-300 rounded-lg py-2 text-sm font-bold text-gray-600 hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#1E5631] text-white rounded-lg py-2 text-sm font-bold hover:bg-[#17472A]">
                        Simpan Kategori
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>