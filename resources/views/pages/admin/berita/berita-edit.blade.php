<div id="modalEdit{{ $berita->id }}" class="fixed inset-0 bg-black/30 backdrop-blur-sm items-center justify-center z-50 p-4 overflow-y-auto hidden">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-3xl shadow-lg overflow-hidden max-h-[90vh] overflow-y-auto">

        <div class="bg-[#1E5631] py-2">
            <h2 class="text-center text-white font-medium text-base">
                Edit Berita
            </h2>
        </div>

        <div class="p-6">
            {{-- 🔥 JURUS 1: Form akan langsung memaksa modal tertutup saat tombol Perbarui ditekan --}}
            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" 
                  onsubmit="document.getElementById('modalEdit{{ $berita->id }}').classList.add('hidden'); document.getElementById('modalEdit{{ $berita->id }}').classList.remove('flex');">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm text-[#000000] mb-1">Judul Berita</label>
                        <input type="text" name="judul" required value="{{ old('judul', $berita->judul) }}"
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
                            <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="publish" {{ old('status', $berita->status) == 'publish' ? 'selected' : '' }}>Publish</option>
                        </select>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm text-[#000000] mb-2">Upload Gambar Berita (Opsional)</label>

                    <label id="drop-area-{{ $berita->id }}"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-[#D9D9D9] rounded cursor-pointer hover:bg-gray-50 transition overflow-hidden">
                        
                        <div id="preview-container-{{ $berita->id }}" class="flex flex-col items-center justify-center text-center p-2">
                            @if($berita->gambar)
                                <img src="{{ asset($berita->gambar) }}" class="h-24 w-auto object-cover rounded mb-1 shadow-sm">
                                <p class="text-[10px] text-green-700 font-bold truncate w-40">Gambar Saat Ini. Klik untuk mengganti.</p>
                            @else
                                <span class="text-sm text-gray-500">Drag & Drop gambar di sini</span>
                                <span class="text-xs text-gray-400 mt-1">atau klik untuk memilih file</span>
                            @endif
                        </div>

                        {{-- 🔥 JURUS 2: Preview Gambar langsung jalan tanpa perlu Script luar --}}
                        <input type="file" name="gambar" id="file-input-{{ $berita->id }}" class="hidden" accept="image/*" 
                               onchange="const file = this.files[0]; const container = document.getElementById('preview-container-{{ $berita->id }}'); if(file) { const reader = new FileReader(); reader.onload = function(e) { container.innerHTML = `<img src='${e.target.result}' class='h-24 w-auto object-cover rounded mb-1 shadow-sm'><p class='text-[10px] text-green-700 font-bold truncate w-40'>Gambar Baru: ${file.name}</p>`; }; reader.readAsDataURL(file); }">
                    </label>
                    @error('gambar')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-[#000000] mb-1">Isi Berita</label>
                    <textarea name="deskripsi" id="editor-{{ $berita->id }}" rows="12" class="ckeditor-textarea w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm text-[#000000] mb-1">Tanggal Publikasi</label>
                    <input type="date" name="tanggal" required value="{{ old('tanggal', \Carbon\Carbon::parse($berita->created_at)->format('Y-m-d')) }}"
                        class="w-full md:w-1/2 border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                </div>

                <div class="flex justify-end gap-3 border-t border-gray-200 pt-4">
                    {{-- 🔥 JURUS 3: Tombol Batal murni memanipulasi CSS Class secara mandiri --}}
                    <button type="button" 
                        onclick="document.getElementById('modalEdit{{ $berita->id }}').classList.add('hidden'); document.getElementById('modalEdit{{ $berita->id }}').classList.remove('flex');"
                        class="px-5 py-2 text-sm bg-gray-100 border border-gray-300 hover:bg-gray-200 rounded text-gray-700 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 text-sm bg-[#1E5631] text-white rounded hover:bg-[#154024] transition shadow-sm">
                        Perbarui Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>