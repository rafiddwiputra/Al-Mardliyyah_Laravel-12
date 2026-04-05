<div id="uploadModal"
     class="hidden fixed inset-0 bg-black/40 flex items-start justify-center overflow-y-auto z-50">

    <div class="bg-white w-full max-w-lg rounded-xl overflow-visible shadow-lg">

        <!-- HEADER -->
        <div class="bg-[#1E5631] text-white text-center py-3 font-semibold">
            Upload Foto
        </div>

        <!-- BODY -->
        <div class="p-5 space-y-4">

            <!-- LABEL -->
            <p class="text-sm font-medium text-gray-700">Upload Foto</p>

            <!-- DROP AREA -->
            <div class="border border-gray-300 rounded-lg h-32 flex flex-col items-center justify-center text-gray-400 text-sm cursor-pointer">
                <span>Drag & Drop gambar di sini</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mt-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M12 12v9m0-9l-3 3m3-3l3 3m0-9V4m0 0l-3 3m3-3l3 3"/>
                </svg>
            </div>

            <!-- INPUT FILE -->
            <input type="file" id="fileInput" class="hidden">

            <!-- NAMA FOTO -->
            <div>
                <label class="text-sm text-gray-700">Nama Kegiatan/Foto</label>
                <input type="text"
                    class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
            </div>

            <!-- KATEGORI -->
            <div>
                <label class="text-sm text-gray-700">Kategori</label>

                <div class="relative" id="kategoriWrapper">

                    <!-- VALUE -->
                    <input type="hidden" name="kategori" id="kategoriValue">

                    <!-- BUTTON -->
                    <button type="button" onclick="toggleKategori()"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm text-left flex justify-between items-center">

                        <span id="kategoriText">Semua</span>

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>

                    </button>

                    <!-- DROPDOWN -->
                    <div id="kategoriMenu"
                        class="hidden absolute w-full bg-white border rounded-lg mt-1 shadow z-50">

                        <div onclick="pilihKategori('Semua')"
                            class="px-3 py-2 text-sm cursor-pointer hover:bg-[#1E5631] hover:text-white">
                            Semua
                        </div>

                        <div onclick="pilihKategori('Kegiatan Santri')"
                            class="px-3 py-2 text-sm cursor-pointer hover:bg-[#1E5631] hover:text-white">
                            Kegiatan Santri
                        </div>

                        <div onclick="pilihKategori('Kegiatan Belajar')"
                            class="px-3 py-2 text-sm cursor-pointer hover:bg-[#1E5631] hover:text-white">
                            Kegiatan Belajar
                        </div>

                        <div onclick="pilihKategori('Fasilitas Pondok')"
                            class="px-3 py-2 text-sm cursor-pointer hover:bg-[#1E5631] hover:text-white">
                            Fasilitas Pondok
                        </div>

                        <div onclick="pilihKategori('Acara Pondok')"
                            class="px-3 py-2 text-sm cursor-pointer hover:bg-[#1E5631] hover:text-white">
                            Acara Pondok
                        </div>

                    </div>

                </div>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-between gap-3 pt-2">

                <button onclick="closeModal('uploadModal')"
                    class="flex-1 border rounded-lg py-2 text-sm font-bold text-gray-700 hover:bg-gray-100">
                    Batal
                </button>

                <button
                    class="flex-1 bg-[#1E5631] text-white rounded-lg py-2 text-sm hover:bg-[#17472A]">
                    Upload
                </button>

            </div>

        </div>

    </div>

</div>

<script>
function toggleKategori() {
    document.getElementById('kategoriMenu').classList.toggle('hidden');
}

function pilihKategori(value) {
    document.getElementById('kategoriText').innerText = value;
    document.getElementById('kategoriValue').value = value;
    document.getElementById('kategoriMenu').classList.add('hidden');
}

// klik luar dropdown
document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('kategoriWrapper');

    if (!wrapper.contains(e.target)) {
        document.getElementById('kategoriMenu').classList.add('hidden');
    }
});
</script>