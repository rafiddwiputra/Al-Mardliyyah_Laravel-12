<div id="modalTambah"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-lg shadow-lg overflow-hidden">

        <!-- HEADER -->
        <div class="bg-[#1E5631] py-2">
            <h2 class="text-center text-white font-medium text-base">
                Tambah Berita
            </h2>
        </div>

        <!-- FORM -->
        <div class="p-5">

            <form>

                <!-- JUDUL -->
                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">
                        Judul Berita
                    </label>
                    <input type="text"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                </div>

                <!-- UPLOAD -->
                <div class="mb-5">
                    <label class="block text-sm text-[#000000] mb-2">
                        Upload Gambar Berita
                    </label>

                    <label
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-[#D9D9D9] rounded cursor-pointer hover:bg-gray-50 transition">

                        <span class="text-sm text-gray-500">
                            Drag & Drop gambar di sini
                        </span>

                        <span class="text-xs text-gray-400 mt-1">
                            atau klik untuk memilih file
                        </span>

                        <input type="file" class="hidden">
                    </label>
                </div>

                <!-- ISI -->
                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">
                        Isi Berita
                    </label>
                    <textarea rows="4"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none"></textarea>
                </div>

                <!-- TANGGAL -->
                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">
                        Tanggal Publikasi
                    </label>
                    <input type="date"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                </div>

                <!-- STATUS -->
                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">
                        Status
                    </label>

                    <select
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">

                        <option value="">Pilih Status</option>
                        <option value="draft">Draft</option>
                        <option value="publish">Publish</option>

                    </select>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-center gap-2">

                    <button type="button"
                        onclick="closeTambahModal()"
                        class="px-4 py-2 text-sm bg-[#D9D9D9] border border-[#D9D9D9] rounded text-[#333333]">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 text-sm bg-[#1E5631] text-white rounded">
                        Simpan Berita
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>