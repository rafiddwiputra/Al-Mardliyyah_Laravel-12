<div id="editModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg rounded-xl overflow-hidden shadow-lg">
        
        <form id="editForm" method="POST">
            @csrf
            @method('PUT') <div class="bg-[#1E5631] text-white text-center py-3 font-semibold">
                Edit Informasi Pendaftaran
            </div>

            <div class="p-5 space-y-4">

                <div>
                    <label class="text-sm font-bold text-gray-700">Nama Jadwal</label>
                    <input type="text" name="judul" id="editJudul" readonly
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm bg-gray-100 text-gray-500 cursor-not-allowed outline-none">
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700">Deskripsi / Syarat Pendaftaran</label>
                    <textarea name="deskripsi" id="editDeskripsi" required rows="5"
                        placeholder="Contoh:&#10;- Tes Seleksi: 5 Juli&#10;- Pengumuman: 10 Juli"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Gunakan enter untuk membuat daftar poin-poin baru.</p>
                </div>

                <div class="flex justify-between gap-3 pt-2">
                    <button type="button" onclick="closeModal('editModal')"
                        class="flex-1 border rounded-lg py-2 text-sm font-bold text-gray-700 hover:bg-gray-100 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#1E5631] text-white rounded-lg py-2 text-sm hover:bg-[#174427] transition shadow-md">
                        Simpan Perubahan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>