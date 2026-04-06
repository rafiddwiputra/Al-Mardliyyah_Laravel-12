<div id="modalTambahFasilitas"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-lg shadow-lg overflow-hidden">

        <!-- HEADER -->
        <div class="bg-[#1E5631] py-2">
            <h2 class="text-center text-white font-medium text-base">
                Tambah Fasilitas
            </h2>
        </div>

        <!-- FORM -->
        <div class="p-5">

            <form>

                <div class="mb-4">
                    <label class="block text-sm mb-1">Nama Fasilitas</label>
                    <input type="text"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm mb-1">Deskripsi</label>
                    <textarea rows="4"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm mb-2">Upload Gambar</label>

                    <label
                        class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-[#D9D9D9] rounded cursor-pointer">

                        <span class="text-sm text-gray-500">Drag & Drop gambar</span>
                        <span class="text-xs text-gray-400">atau klik upload</span>

                        <input type="file" class="hidden">
                    </label>
                </div>

                <div class="flex justify-center gap-2">
                    <button type="button"
                        onclick="closeTambahFasilitasModal()"
                        class="px-4 py-2 border border-[#D9D9D9] rounded text-sm">
                        Batal
                    </button>

                    <button class="px-4 py-2 bg-[#1E5631] text-white rounded text-sm">
                        Simpan
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>