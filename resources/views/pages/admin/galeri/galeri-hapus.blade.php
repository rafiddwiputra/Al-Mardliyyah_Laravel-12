<!-- MODAL DELETE -->
<div id="deleteModal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-sm rounded-xl shadow-lg overflow-hidden">

        <!-- HEADER -->
        <div class="bg-[#FFFFFF] text-[#B91C1C] text-center py-3 font-semibold border-b border-gray-500">
            Konfirmasi Hapus
        </div>

        <!-- BODY -->
        <div class="p-5 text-center">

            <p class="text-sm text-gray-700 mb-3">
                Apakah Anda yakin ingin menghapus foto ini?
            </p>

            <!-- NAMA FOTO -->
            <p class="text-xs text-gray-500 mb-4">
                Galeri:
                <span class="font-semibold text-gray-800">
                    Sholat Berjamaah di Masjid
                </span>
            </p>

            <!-- BUTTON -->
            <div class="flex gap-3">

                <button onclick="closeModal('deleteModal')"
                    class="flex-1 border rounded-md py-2 text-sm font-bold text-gray-700 hover:bg-gray-100">
                    Batal
                </button>

                <button
                    class="flex-1 bg-red-200 text-[#B91C1C] rounded-md py-2 text-sm font-medium hover:bg-red-300">
                    Hapus
                </button>

            </div>

        </div>

    </div>

</div>