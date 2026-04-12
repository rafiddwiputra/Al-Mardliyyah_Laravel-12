<div id="editModal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-lg rounded-xl overflow-hidden shadow-lg">

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <!-- HEADER -->
            <div class="bg-[#1E5631] text-white text-center py-3 font-semibold">
                Edit Kontak
            </div>

            <!-- BODY -->
            <div class="p-5 space-y-4">

                <!-- TIPE -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Tipe Kontak</label>
                    <select name="tipe" id="editTipe"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm">
                        <option value="alamat">Alamat</option>
                        <option value="telepon">Telepon</option>
                        <option value="email">Email</option>
                        <option value="sosmed">Sosial Media</option>
                    </select>
                </div>

                <!-- JUDUL -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Judul</label>
                    <input type="text" name="judul" id="editJudul"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm">
                </div>

                <!-- NILAI -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Nilai</label>
                    <input type="text" name="nilai" id="editNilai"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm">
                </div>

                <!-- LINK -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Link (opsional)</label>
                    <input type="text" name="link" id="editLink"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm">
                </div>

                <!-- ICON -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Icon (opsional)</label>
                    <input type="text" name="icon" id="editIcon"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm">
                </div>

                <!-- BUTTON -->
                <div class="flex justify-between gap-3 pt-2">

                    <button type="button"
                        onclick="closeModal('editModal')"
                        class="flex-1 border rounded-lg py-2 text-sm font-bold text-gray-700 hover:bg-gray-100">
                        Batal
                    </button>

                    <button type="submit"
                        class="flex-1 bg-[#1E5631] text-white rounded-lg py-2 text-sm hover:bg-[#174427]">
                        Update
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>