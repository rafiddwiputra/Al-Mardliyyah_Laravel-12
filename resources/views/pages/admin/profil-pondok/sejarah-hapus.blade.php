<div id="deleteSejarahModal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-[9999] opacity-0 transition-opacity duration-300">

    <div class="bg-white w-full max-w-sm rounded-xl shadow-lg overflow-hidden transform transition-transform duration-300 scale-95 mx-4" id="deleteSejarahModalContent">

        <div class="bg-white text-[#B91C1C] text-center py-3 font-semibold border-b border-gray-200 uppercase tracking-widest text-[10px]">
            Konfirmasi Hapus
        </div>

        <form id="formHapusSejarah" method="POST">
            @csrf
            @method('DELETE')

            <div class="p-6 text-center">
                <p class="text-sm text-gray-700 mb-3">
                    Apakah Anda yakin ingin menghapus peristiwa sejarah ini? Tindakan ini tidak dapat dibatalkan.
                </p>

                <p class="text-xs text-gray-500 mb-5 bg-gray-50 py-2 px-3 rounded-lg border border-gray-100">
                    Peristiwa: 
                    <span id="hapus_judul_sejarah" class="font-bold text-gray-800 italic">
                        {{-- Diisi oleh JavaScript prepareDeleteSejarah --}}
                    </span>
                </p>

                <div class="flex gap-3">
                    {{-- TOMBOL BATAL --}}
                    <button type="button" onclick="closeModal('deleteSejarahModal')"
                        class="flex-1 border border-gray-200 rounded-md py-2 text-sm font-bold text-gray-600 hover:bg-gray-100 transition-colors">
                        Batal
                    </button>

                    {{-- TOMBOL EKSEKUSI --}}
                    <button type="submit"
                        class="flex-1 bg-red-600 text-white rounded-md py-2 text-sm font-medium hover:bg-red-700 shadow-sm transition-all">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>