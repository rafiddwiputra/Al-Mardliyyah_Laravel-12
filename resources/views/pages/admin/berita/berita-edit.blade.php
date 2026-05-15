<div id="modalEdit"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm 
           flex items-center justify-center z-50 hidden p-4 overflow-y-auto">

    <div class="bg-white rounded-lg border border-[#D9D9D9] 
                w-full max-w-lg shadow-lg overflow-hidden 
                max-h-[90vh] overflow-y-auto">
        <div class="bg-[#1E5631] py-2">
            <h2 class="text-center text-white font-medium text-base">Edit Berita</h2>
        </div>

        <div class="p-5">
            <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm mb-1 text-black">Judul Berita</label>
                    <input type="text" name="judul" id="edit_judul" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none text-black">
                </div>

                <div class="mb-4">

    <label class="block text-sm mb-2 text-black">
        Ganti Gambar
        <span class="text-gray-500 text-xs">(Kosongkan jika tidak ingin diganti)</span>
    </label>

    {{-- PREVIEW GAMBAR LAMA --}}
    <div class="mb-3">
        <p class="text-xs text-gray-500 mb-2">Gambar Saat Ini</p>

        <div class="border border-[#D9D9D9] rounded-lg p-3 flex justify-center bg-gray-50">
            <img id="preview_gambar_lama"
                src=""
                class="max-h-[180px] max-w-full object-contain rounded shadow-sm">
        </div>
    </div>

    {{-- INPUT GAMBAR BARU --}}
    <input type="file"
        name="gambar"
        id="edit_gambar"
        accept="image/*"
        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none text-black">

    {{-- PREVIEW GAMBAR BARU --}}
    <div id="container_preview_baru" class="mt-3 hidden">
        <p class="text-xs text-green-700 mb-2 font-semibold">
            Preview Gambar Baru
        </p>

        <div class="border border-green-200 rounded-lg p-3 flex justify-center bg-green-50">
            <img id="preview_gambar_baru"
                src=""
                class="max-h-[180px] max-w-full object-contain rounded shadow-sm">
        </div>
    </div>

</div>

                <div class="mb-4">
                    <label class="block text-sm mb-1 text-black">Isi Berita</label>
                    <textarea name="deskripsi" id="edit_deskripsi" rows="4" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none text-black"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm mb-1 text-black">Tanggal</label>
                    <input type="date" name="tanggal" id="edit_tanggal" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none text-black">
                </div>

                <div class="mb-4">
                    <label class="block text-sm mb-1 text-black">Status</label>
                    <select name="status" id="edit_status" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none bg-white text-black">
                        <option value="draft">Draft</option>
                        <option value="publish">Publish</option>
                    </select>
                </div>

                <div class="flex justify-center gap-2">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 text-sm border border-[#D9D9D9] rounded text-gray-600">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm bg-[#1E5631] text-white rounded">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    // PREVIEW GAMBAR BARU
    const editGambar = document.getElementById('edit_gambar');
    const previewBaru = document.getElementById('preview_gambar_baru');
    const containerPreviewBaru = document.getElementById('container_preview_baru');

    editGambar.addEventListener('change', function () {

        const file = this.files[0];

        if (file) {

            const reader = new FileReader();

            reader.onload = function (e) {

                previewBaru.src = e.target.result;

                containerPreviewBaru.classList.remove('hidden');
            }

            reader.readAsDataURL(file);

        }

    });

</script>