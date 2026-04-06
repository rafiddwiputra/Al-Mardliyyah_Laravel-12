<div id="modalTambahProgram"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-lg shadow-lg overflow-hidden">

        <!-- HEADER -->
        <div class="bg-[#1E5631] py-2">
            <h2 class="text-center text-white font-medium text-base">
                Tambah Program Pendidikan
            </h2>
        </div>

        <!-- FORM -->
        <div class="p-5">

            <form>

                <!-- NAMA -->
                <div class="mb-4">
                    <label class="block text-sm text-black mb-1">
                        Nama Program
                    </label>

                    <input type="text"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                </div> 
                
                <!-- DESKRIPSI -->
                <div class="mb-5">
                    <label class="block text-sm text-black mb-1">
                        Deskripsi
                    </label>

                    <textarea rows="4"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none"></textarea>
                </div>

                <!-- KATEGORI -->
                <div class="mb-4">
                    <label class="block text-sm text-black mb-1">
                        Kategori Program
                    </label>

                    <select
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm text-[#1E5631] focus:outline-none focus:ring-1 focus:ring-[#1E5631] bg-white">

                        <option value="" disabled selected>Pilih kategori</option>
                        <option>Lembaga Pendidikan Formal</option>
                        <option>Lembaga Pendidikan Non Formal</option>
                        <option>Program Keunggulan</option>

                    </select>
                </div>

                <!-- STATUS -->
                <div class="mb-5">

                    <label class="block text-sm text-black mb-2">
                        Status
                    </label>

                    <div class="flex items-center gap-3">

                        <span class="text-sm text-gray-600">
                            Nonaktif
                        </span>

                        <label class="relative inline-flex items-center cursor-pointer">

                            <input type="checkbox" class="sr-only peer">

                            <div
                                class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-[#1E5631] transition">

                            </div>

                            <div
                                class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition peer-checked:translate-x-5">
                            </div>

                        </label>

                        <span class="text-sm text-[#1E5631]">
                            Aktif
                        </span>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="flex justify-center gap-2">

                    <button type="button"
                        onclick="closeTambahProgramModal()"
                        class="px-4 py-2 text-sm border border-[#D9D9D9] rounded text-gray-600">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 text-sm bg-[#1E5631] text-white rounded">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>