<div id="modalHapusFasilitas"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-[9999] opacity-0 transition-opacity duration-300">

    <div class="bg-white w-full max-w-sm rounded-xl shadow-lg overflow-hidden transform transition-transform duration-300 scale-95 mx-4" id="modalHapusFasilitasContent">

        <div class="bg-white text-[#B91C1C] text-center py-3 font-semibold border-b border-gray-200 uppercase tracking-widest text-[10px]">
            Konfirmasi Hapus Fasilitas
        </div>

        <form id="formHapusFasilitas" method="POST">
            @csrf
            @method('DELETE')

          <div class="p-6">
    <p class="text-sm text-gray-600 text-center mb-4">
        Apakah Anda yakin ingin menghapus fasilitas ini? Foto yang tersimpan juga akan dihapus permanen.
    </p>
    
    <div class="bg-red-50 text-red-600 px-4 py-2 rounded-md mb-6 text-sm text-center">
        Fasilitas: <strong id="hapus_nama_fasilitas_text"></strong>
    </div>

    <div class="flex justify-center gap-3">
        <button type="button" onclick="closeHapusFasilitasModal()"
            class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-bold text-gray-700 hover:bg-gray-50 transition-colors w-full">
            Batal
        </button>
        
        <button type="submit"
            class="px-6 py-2 bg-red-600 text-white rounded-lg text-sm font-bold hover:bg-red-700 transition-colors w-full">
            Ya, Hapus
        </button>
    </div>
</div>
        </form>
    </div>
</div>