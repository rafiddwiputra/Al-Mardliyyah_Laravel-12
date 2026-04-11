<div id="tambahModal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-lg rounded-xl overflow-hidden shadow-lg">

        <form action="{{ route('admin.jadwal.store') }}" method="POST">
            @csrf


            <!-- HEADER -->
            <div class="bg-[#1E5631] text-white text-center py-3 font-semibold">
                Tambah Jadwal
            </div>

            <!-- BODY -->
            <div class="p-5 space-y-4">

                <!-- NAMA -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Nama Jadwal</label>
                    <input type="text" name="judul"
                        placeholder="Contoh: Pendaftaran"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <!-- TANGGAL MULAI -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm">
                </div>

                <!-- TANGGAL SELESAI -->
                <div>
                    <label class="text-sm font-bold text-gray-700">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai"
                        class="w-full mt-1 border rounded-lg px-3 py-2 text-sm">
                </div>

                <!-- BUTTON -->
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