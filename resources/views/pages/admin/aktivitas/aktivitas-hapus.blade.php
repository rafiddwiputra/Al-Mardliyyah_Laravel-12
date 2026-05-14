<div id="deleteAktivitasModal"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm items-center justify-center z-50 hidden">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-sm shadow-lg">

        {{-- HEADER --}}
        <div class="bg-[#FCA5A5] py-2 rounded-t-lg">
            <h2 class="text-center text-[#B91C1C] font-bold text-base">
                Konfirmasi Hapus
            </h2>
        </div>

        {{-- CONTENT --}}
        <div class="p-5 text-center">

            <p class="text-sm text-gray-600 mb-2">
                Apakah Anda yakin ingin menghapus aktivitas ini secara permanen?
            </p>

            <p class="text-sm font-bold text-[#1E5631] mb-5">
                <span id="hapus_nama_aktivitas"></span>
            </p>

            <form id="formHapusAktivitas" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex justify-center gap-2 py-4">

                    {{-- BATAL --}}
                    <button type="button"
                        onclick="closeModal('deleteAktivitasModal')"
                        class="px-4 py-2 text-sm border border-[#D9D9D9] rounded text-gray-600 hover:bg-gray-50">
                        Batal
                    </button>

                    {{-- HAPUS --}}
                    <button type="submit"
                        class="px-4 py-2 text-sm bg-[#B91C1C] text-white rounded hover:bg-red-700 shadow-sm transition-colors">
                        Ya, Hapus
                    </button>

                </div>
            </form>

        </div>

    </div>
</div>