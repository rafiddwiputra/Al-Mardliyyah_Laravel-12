<div id="tambahModal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-lg rounded-xl overflow-hidden shadow-lg">

        <form action="{{ route('admin.kontak.store') }}" method="POST">
            @csrf

            <!-- HEADER -->
            <div class="bg-[#1E5631] text-white text-center py-3 font-semibold">
                Tambah Kontak
            </div>

            <!-- BODY -->
            <div class="p-5 space-y-4">

                <!-- TIPE -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Tipe Kontak</label>
                    <select name="tipe"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
                        <option value="alamat">Alamat</option>
                        <option value="telepon">Telepon</option>
                        <option value="email">Email</option>
                        <option value="sosmed">Sosial Media</option>
                    </select>
                </div>

                <!-- JUDUL -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Judul</label>
                    <input type="text" name="judul"
                        placeholder="Contoh: WhatsApp / Instagram / Alamat"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <!-- NILAI -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Nilai</label>
                    <input type="text" name="nilai"
                        placeholder="Contoh: 081234xxx / link / alamat lengkap"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm">
                </div>

                <!-- LINK (OPSIONAL) -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Link (opsional)</label>
                    <input type="text" name="link"
                        placeholder="https://..."
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm">
                </div>

                <!-- ICON (OPSIONAL) -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Icon (opsional)</label>
                    <input type="text" name="icon"
                        placeholder="bi bi-whatsapp / fa fa-instagram"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm">
                </div>

                <!-- BUTTON -->
                <div class="flex justify-between gap-3 pt-2">

                    <button type="button"
                        onclick="closeModal('tambahModal')"
                        class="flex-1 border rounded-lg py-2 text-sm font-bold text-gray-700 hover:bg-gray-100">
                        Batal
                    </button>

                    <button type="submit"
                        class="flex-1 bg-[#1E5631] text-white rounded-lg py-2 text-sm hover:bg-[#174427]">
                        Simpan
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>