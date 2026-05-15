<div id="modalTambahFasilitas"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-300">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-lg shadow-lg overflow-hidden transform scale-95 transition-transform duration-300" id="modalTambahFasilitasContent">

        <div class="bg-[#1E5631] py-3">
            <h2 class="text-center text-white font-medium text-base uppercase tracking-widest text-xs">
                Tambah Fasilitas
            </h2>
        </div>

        <div class="p-5">
            {{-- Tambahkan Action, Method, dan Enctype --}}
            <form action="{{ route('admin.profil.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm mb-1 font-semibold text-[#1E5631]">Nama Fasilitas</label>
                    {{-- Tambahkan name="nama_fasilitas" --}}
                    <input type="text" name="nama_fasilitas" required
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:ring-1 focus:ring-[#1E5631] outline-none" 
                        placeholder="Contoh: Gedung Serbaguna">
                </div>

                <div class="mb-4">
                    <label class="block text-sm mb-1 font-semibold text-[#1E5631]">Deskripsi</label>
                    {{-- Tambahkan name="deskripsi" --}}
                    <textarea name="deskripsi" rows="4" maxlength="150"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:ring-1 focus:ring-[#1E5631] outline-none"
                        placeholder="Berikan penjelasan singkat (maks 150 karakter)..."></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm mb-2 font-semibold text-[#1E5631]">Upload Gambar</label>

                    <label class="flex flex-col items-center justify-center w-full min-h-[180px] border-2 border-dashed border-[#D9D9D9] rounded cursor-pointer hover:bg-gray-50 transition-all relative overflow-hidden p-3">
    
                        <img id="previewFasilitasBaru" 
                            class="hidden max-h-[250px] max-w-full object-contain rounded">

                        <div id="placeholderFasilitasBaru" class="flex flex-col items-center justify-center">
                            <span class="text-sm text-gray-500 font-medium">Drag & Drop gambar</span>
                            <span class="text-xs text-gray-400">atau klik untuk pilih file</span>
                        </div>

                        {{-- Tambahkan name="gambar" --}}
                        <input type="file" name="gambar" class="hidden" accept="image/*" onchange="previewImgFasilitas(this)" required>
                    </label>
                </div>

                <div class="flex justify-center gap-2 mt-6">
                    <button type="button"
                        onclick="closeTambahFasilitasModal()"
                        class="px-6 py-2 border border-[#D9D9D9] rounded text-sm font-bold text-gray-600 hover:bg-gray-100 transition-colors">
                        Batal
                    </button>

                    <button type="submit" class="px-6 py-2 bg-[#1E5631] text-white rounded text-sm font-bold hover:bg-[#164227] shadow-md transition-all">
                        Simpan Fasilitas
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function previewImgFasilitas(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewFasilitasBaru').src = e.target.result;
            document.getElementById('previewFasilitasBaru').classList.remove('hidden');
            document.getElementById('placeholderFasilitasBaru').classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>