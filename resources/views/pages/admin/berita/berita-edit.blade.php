<div id="modalEdit"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-lg shadow-lg overflow-hidden">

        <!-- HEADER -->
        <div class="bg-[#1E5631] py-2">
            <h2 class="text-center text-white font-medium text-base">
                Edit Berita
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
                        value="Kegiatan Santri Ramadhan"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-[#D9D9D9] text-sm focus:outline-none">
                </div>

                <!-- UPLOAD -->
                <div class="mb-5">
                    <label class="block text-sm text-[#000000] mb-2">
                        Upload Gambar
                    </label>

                    <label
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-[#D9D9D9] rounded cursor-pointer hover:bg-gray-50 transition">

                        <span class="text-sm text-[#D9D9D9]">
                            Drag & Drop gambar di sini
                        </span>

                        <span class="text-xs text-[#D9D9D9] mt-1">
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
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm text-[#D9D9D9] focus:outline-none">Kegiatan santri selama bulan Ramadhan berjalan dengan lancar.</textarea>
                </div>

                <!-- TANGGAL -->
                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">
                        Tanggal
                    </label>
                    <input type="date"
                        value="2025-06-12"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm  text-[#D9D9D9] focus:outline-none">
                </div>

                <!-- STATUS -->
                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">
                        Status
                    </label>

                    <select
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm text-[#D9D9D9] focus:outline-none focus:ring-1 focus:ring-[#1E5631] bg-white">

                        <option value="" disabled>Pilih Status</option>
                        <option value="draft">Draft</option>
                        <option value="publish">Publish</option>

                    </select>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-center gap-2">

                    <button type="button"
                        onclick="closeEditModal()"
                        class="px-4 py-2 text-sm border border-[#D9D9D9] rounded text-gray-600">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 text-sm bg-[#1E5631] text-white rounded">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>