{{-- resources/views/pages/admin/berita/berita-tambah.blade.php --}}

{{-- FIX #1: Tambah id="modalTambah" dan class hidden, hapus flex --}}
<div id="modalTambah" class="fixed inset-0 bg-black/30 backdrop-blur-sm items-center justify-center z-50 p-4 overflow-y-auto hidden">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-3xl shadow-lg overflow-hidden max-h-[90vh] overflow-y-auto">

        <div class="bg-[#1E5631] py-2">
            <h2 class="text-center text-white font-medium text-base">
                Tambah Berita {{-- FIX #2: Judul yang benar --}}
            </h2>
        </div>

        <div class="p-6">
            {{-- FIX #3: Route store (POST), bukan update (PUT) --}}
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm text-[#000000] mb-1">Judul Berita</label>
                        {{-- FIX #4: Tidak ada $berita, pakai old() saja --}}
                        <input type="text" name="judul" required value="{{ old('judul') }}"
                            class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                        @error('judul')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-[#000000] mb-1">Status</label>
                        <select name="status" required
                            class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                            <option value="">Pilih Status</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                        </select>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm text-[#000000] mb-2">Upload Gambar Berita (Opsional)</label>

                    <label id="drop-area"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-[#D9D9D9] rounded cursor-pointer hover:bg-gray-50 transition overflow-hidden">
                        
                        <div id="preview-container" class="flex flex-col items-center justify-center text-center p-2">
                            {{-- FIX #5: Kosong, tidak ada gambar default untuk form tambah --}}
                            <span class="text-sm text-gray-500">Drag & Drop gambar di sini</span>
                            <span class="text-xs text-gray-400 mt-1">atau klik untuk memilih file</span>
                        </div>

                        <input type="file" name="gambar" id="file-input" class="hidden" accept="image/*">
                    </label>
                    @error('gambar')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">Isi Berita</label>
                    <textarea name="deskripsi" id="editor" rows="12"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm text-[#000000] mb-1">Tanggal Publikasi</label>
                    <input type="date" name="tanggal" required value="{{ old('tanggal') }}"
                        class="w-full md:w-1/2 border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                </div>

                <div class="flex justify-end gap-3 border-t border-gray-200 pt-4">
                    {{-- FIX #6: Batal menutup modal, bukan redirect --}}
                    <button type="button" onclick="closeTambahModal()"
                        class="px-5 py-2 text-sm bg-gray-100 border border-gray-300 hover:bg-gray-200 rounded text-gray-700 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 text-sm bg-[#1E5631] text-white rounded hover:bg-[#154024] transition shadow-sm">
                        Simpan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (document.querySelector('#editor')) {
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
                })
                .catch(error => console.error(error));
        }

        const fileInput = document.getElementById('file-input');
        const previewContainer = document.getElementById('preview-container');

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainer.innerHTML = `
                            <img src="${e.target.result}" class="h-24 w-auto object-cover rounded mb-1 shadow-sm">
                            <p class="text-[10px] text-green-700 font-bold truncate w-40">Gambar Baru: ${file.name}</p>
                        `;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>