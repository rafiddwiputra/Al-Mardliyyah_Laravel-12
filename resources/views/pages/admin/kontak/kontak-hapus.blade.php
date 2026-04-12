<div id="deleteModal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-sm rounded-xl shadow-lg overflow-hidden">

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <!-- HEADER -->
            <div class="bg-white text-red-600 text-center py-3 font-semibold border-b">
                Konfirmasi Hapus
            </div>

            <!-- BODY -->
            <div class="p-5 text-center">

                <p class="text-sm text-gray-700 mb-2">
                    Apakah Anda yakin ingin menghapus data kontak ini?
                </p>

                <p class="text-xs text-gray-500 mb-4">
                    Data ini akan dihapus secara permanen
                </p>

                <!-- BUTTON -->
                <div class="flex gap-3">

                    <button type="button"
                        onclick="closeModal('deleteModal')"
                        class="flex-1 border rounded-lg py-2 text-sm font-bold text-gray-700 hover:bg-gray-100">
                        Batal
                    </button>

                    <button type="submit"
                        class="flex-1 bg-red-500 text-white rounded-lg py-2 text-sm font-bold hover:bg-red-600">
                        Hapus
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>