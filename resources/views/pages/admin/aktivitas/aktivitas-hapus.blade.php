<div id="deleteAktivitasModal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 opacity-0 transition-opacity duration-300">

    <div class="bg-white w-full max-w-sm rounded-xl shadow-lg overflow-hidden transform transition-transform duration-300 scale-95" id="deleteAktivitasModalContent">

        <div class="bg-white text-[#B91C1C] text-center py-3 font-semibold border-b border-gray-200">
            Konfirmasi Hapus
        </div>

        <form id="formHapusAktivitas" method="POST">
            @csrf
            @method('DELETE')

            <div class="p-5 text-center">
                <p class="text-sm text-gray-700 mb-3">
                    Apakah Anda yakin ingin menghapus aktivitas ini? Tindakan ini tidak dapat dibatalkan.
                </p>

                <p class="text-xs text-gray-500 mb-4 bg-gray-50 py-2 rounded">
                    Aktivitas: 
                    <span id="hapus_nama_aktivitas" class="font-semibold text-gray-800 italic">
                        {{-- Diisi oleh JS --}}
                    </span>
                </p>

                <div class="flex gap-3">
                    <button type="button" onclick="closeModal('deleteAktivitasModal')"
                        class="flex-1 border rounded-md py-2 text-sm font-bold text-gray-700 hover:bg-gray-100 transition-colors">
                        Batal
                    </button>

                    <button type="submit"
                        class="flex-1 bg-red-600 text-white rounded-md py-2 text-sm font-medium hover:bg-red-700 shadow-sm transition-all">
                        Ya, Hapus Aktivitas
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>