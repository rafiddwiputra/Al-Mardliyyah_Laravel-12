<!-- MODAL EDIT -->
<div id="editModal"
     class="hidden fixed inset-0 bg-black/40 flex items-start justify-center overflow-y-auto z-50">
     
    <div class="bg-white w-full max-w-lg rounded-xl overflow-visible shadow-lg">

        <!-- HEADER -->
        <div class="bg-[#1E5631] text-white text-center py-3 font-semibold">
            Edit Foto
        </div>

        <!-- BODY -->
        <div class="p-5 space-y-4">

            <!-- LABEL -->
            <p class="text-sm font-medium text-gray-700">Edit Foto</p>

            <!-- PREVIEW -->
            <div class="border border-gray-300 rounded-lg h-32 flex items-center justify-center text-gray-400 text-sm">
                Preview Gambar
            </div>

            <!-- INPUT FILE -->
            <input type="file"
                class="w-full border rounded-lg px-3 py-2 text-sm">

            <!-- NAMA FOTO -->
            <div>
                <label class="text-sm text-gray-700">Nama Kegiatan/Foto</label>
                <input type="text"
                    value="Sholat Berjamaah di Masjid"
                    class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
            </div>

            <!-- KATEGORI -->
            <div>
                <label class="text-sm text-gray-700">Kategori</label>

    <div class="relative" id="editKategoriWrapper">

        <!-- VALUE -->
        <input type="hidden" name="kategori" id="editKategoriValue" value="Kegiatan Santri">

        <!-- BUTTON -->
        <button type="button" onclick="toggleEditKategori()"
            class="w-full mt-1 border rounded-lg px-3 py-2 text-sm text-left flex justify-between items-center">

            <span id="editKategoriText">Kegiatan Santri</span>

            <!-- ICON -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>

        </button>

        <!-- DROPDOWN -->
        <div id="editKategoriMenu"
            class="hidden absolute w-full bg-white border rounded-lg mt-1 shadow z-50">

            <div onclick="pilihEditKategori('Kegiatan Santri')"
                class="px-3 py-2 text-sm cursor-pointer hover:bg-[#1E5631] hover:text-white">
                Kegiatan Santri
            </div>

            <div onclick="pilihEditKategori('Kegiatan Belajar')"
                class="px-3 py-2 text-sm cursor-pointer hover:bg-[#1E5631] hover:text-white">
                Kegiatan Belajar
            </div>

            <div onclick="pilihEditKategori('Fasilitas Pondok')"
                class="px-3 py-2 text-sm cursor-pointer hover:bg-[#1E5631] hover:text-white">
                Fasilitas Pondok
            </div>

            <div onclick="pilihEditKategori('Acara Pondok')"
                class="px-3 py-2 text-sm cursor-pointer hover:bg-[#1E5631] hover:text-white">
                Acara Pondok
            </div>

        </div>

    </div>
</div>

            <!-- BUTTON -->
            <div class="flex justify-between gap-3 pt-2">

                <button onclick="closeModal('editModal')"
                    class="flex-1 border rounded-lg py-2 text-sm font-bold text-gray-700 hover:bg-gray-100">
                    Batal
                </button>

                <button
                    class="flex-1 bg-[#1E5631] text-white rounded-lg py-2 text-sm hover:opacity-90">
                    Update
                </button>

            </div>

        </div>

    </div>
</div>

<script>
function toggleEditKategori() {
    document.getElementById('editKategoriMenu').classList.toggle('hidden');
}

function pilihEditKategori(value) {
    document.getElementById('editKategoriText').innerText = value;
    document.getElementById('editKategoriValue').value = value;
    document.getElementById('editKategoriMenu').classList.add('hidden');
}

// klik luar
document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('editKategoriWrapper');

    if (!wrapper.contains(e.target)) {
        document.getElementById('editKategoriMenu').classList.add('hidden');
    }
});
</script>