<div id="tambahModal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-lg rounded-xl overflow-hidden shadow-lg">

        <form action="{{ route('admin.jadwal.store') }}" method="POST">
            @csrf

            <div class="bg-[#1E5631] text-white text-center py-3 font-semibold">
                Tambah Jadwal
            </div>

            <div class="p-5 space-y-4">

                <div>
                    <label class="text-sm font-bold text-gray-700">Nama Jadwal</label>
                    <input type="text" name="judul" required
                        placeholder="Contoh: Pendaftaran"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700">Syarat & Ketentuan</label>
                    <textarea name="deskripsi" required rows="4"
                        placeholder="1. Lulusan SD/MI&#10;2. Menyerahkan fotokopi KK..."
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Gunakan enter untuk membuat poin-poin.</p>
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" required
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" required
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <div class="flex justify-between gap-3 pt-2">

                    <button type="button" onclick="closeModal('tambahModal')"
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