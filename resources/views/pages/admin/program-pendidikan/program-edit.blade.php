<div id="modalEditProgram"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-lg shadow-lg overflow-hidden">

        <div class="bg-[#1E5631] py-2">
            <h2 class="text-center text-white font-medium text-base">
                Edit Program Pendidikan
            </h2>
        </div>

        <div class="p-5">

            <form id="formEditProgram" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-sm text-black mb-1 font-medium">
                        Nama Program/Lembaga
                    </label>

                    <input type="text" name="nama_program" id="edit_nama" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-black mb-1 font-medium">
                        Deskripsi
                    </label>

                    <textarea name="deskripsi" id="edit_deskripsi" rows="4" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631]"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-black mb-1 font-medium">
                        Kategori Program
                    </label>

                    {{-- Name diubah menjadi "nama_kategori" --}}
                    <select name="nama_kategori" id="edit_kategori" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#1E5631] bg-white capitalize">
                        
                        <option value="" disabled>Pilih kategori...</option>
                        
                        {{-- Looping langsung dari array string ENUM yang dikirim dari controller --}}
                        @foreach($kategori as $k)
                            <option value="{{ $k }}">
                                {{ ucwords($k) }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-5">

                    <label class="block text-sm text-black mb-2 font-medium">
                        Status Publikasi
                    </label>

                    <div class="flex items-center gap-3">

                        <span class="text-sm text-gray-600">
                            Nonaktif
                        </span>

                        <label class="relative inline-flex items-center cursor-pointer">

                            <input type="checkbox" id="edit_status" name="status" value="aktif" class="sr-only peer">

                            <div
                                class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-[#1E5631] transition">
                            </div>

                            <div
                                class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition peer-checked:translate-x-5 shadow-sm">
                            </div>

                        </label>

                        <span class="text-sm text-[#1E5631] font-medium">
                            Aktif
                        </span>

                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-2">

                    <button type="button"
                        onclick="closeEditProgramModal()"
                        class="px-5 py-2 text-sm border border-gray-300 rounded text-gray-600 hover:bg-gray-50 transition">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-5 py-2 text-sm bg-[#1E5631] text-white rounded hover:bg-green-800 transition shadow-md">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>