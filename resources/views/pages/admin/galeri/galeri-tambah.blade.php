<div id="uploadModal" 
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center overflow-y-auto z-50 opacity-0 transition-opacity duration-300">
    
    <div class="bg-white w-full max-w-lg rounded-xl overflow-visible shadow-lg transform transition-transform duration-300 scale-95" id="modalContent">

        <div class="bg-[#1E5631] text-white text-center py-3 font-semibold rounded-t-xl">
            Upload Foto Baru
        </div>

        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="p-5 space-y-4">

                <p class="text-sm font-medium text-gray-700">File Foto</p>
                <div onclick="document.getElementById('fileInput').click()" 
                     class="border-2 border-dashed border-gray-300 rounded-lg min-h-[160px] flex flex-col items-center justify-center text-gray-400 text-sm cursor-pointer hover:border-[#1E5631] hover:bg-gray-50 transition-all overflow-hidden relative" 
                     id="dropArea">
                    
                    {{-- Elemen Preview Gambar --}}
                    <img id="imagePreview" class="hidden w-full h-full object-cover absolute inset-0">

                    {{-- Placeholder saat kosong --}}
                    <div id="placeholderContent" class="flex flex-col items-center p-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span id="fileNameDisplay">Klik untuk pilih gambar atau Drag & Drop</span>
                        <p class="text-[10px] mt-1 opacity-60 text-gray-400 uppercase tracking-tighter">JPG, PNG atau JPEG (Max 2MB)</p>
                    </div>
                </div>
                
                {{-- Input File Asli --}}
                <input type="file" name="gambar" id="fileInput" class="hidden" required onchange="previewImage(this)">

                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Kegiatan / Judul Foto</label>
                    <input type="text" name="judul" required placeholder="Contoh: Sholat Berjamaah"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1E5631] focus:border-[#1E5631] transition-all">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Kategori Galeri</label>
                    <div class="relative" id="kategoriWrapper">
                        <input type="hidden" name="kategori_id" id="kategoriValue" required>

                        <button type="button" onclick="toggleKategori()"
                            class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm text-left flex justify-between items-center bg-white hover:bg-gray-50 transition-colors">
                            <span id="kategoriText" class="text-gray-500">Pilih Kategori</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 transition-transform duration-300" id="arrowIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Menu Dropdown Dinamis --}}
                        <div id="kategoriMenu" class="hidden absolute w-full bg-white border border-gray-200 rounded-lg mt-1 shadow-2xl z-[70] max-h-48 overflow-y-auto">
                            @foreach($categories as $cat)
                                <div onclick="pilihKategori('{{ $cat->id }}', '{{ $cat->nama_kategori }}')"
                                    class="px-4 py-2.5 text-sm cursor-pointer hover:bg-[#1E5631] hover:text-white border-b border-gray-50 last:border-0 transition-colors">
                                    {{ $cat->nama_kategori }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex justify-between gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeModal('uploadModal')"
                        class="flex-1 border border-gray-300 rounded-lg py-2.5 text-sm font-bold text-gray-600 hover:bg-gray-100 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#1E5631] text-white rounded-lg py-2.5 text-sm font-bold hover:bg-[#17472A] shadow-lg hover:shadow-xl transition-all">
                        Upload Sekarang
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
/**
 * Fungsi untuk Preview Gambar saat dipilih
 */
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('placeholderContent');
    const dropArea = document.getElementById('dropArea');
    const display = document.getElementById('fileNameDisplay');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
            dropArea.classList.replace('border-gray-300', 'border-[#1E5631]');
        }

        reader.readAsDataURL(input.files[0]);
        display.innerText = input.files[0].name;
    } else {
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
        dropArea.classList.replace('border-[#1E5631]', 'border-gray-300');
    }
}

/**
 * Fungsi Buka/Tutup Modal (Smooth)
 */
function openModal(id) {
    const modal = document.getElementById(id);
    const content = document.getElementById('modalContent');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        if(content) content.classList.replace('scale-95', 'scale-100');
    }, 10);
}

function closeModal(id) {
    const modal = document.getElementById(id);
    const content = document.getElementById('modalContent');
    
    modal.classList.remove('opacity-100');
    if(content) content.classList.replace('scale-100', 'scale-95');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

/**
 * Logika Dropdown Kategori
 */
function toggleKategori() {
    const menu = document.getElementById('kategoriMenu');
    const arrow = document.getElementById('arrowIcon');
    menu.classList.toggle('hidden');
    arrow.classList.toggle('rotate-180');
}

function pilihKategori(id, name) {
    document.getElementById('kategoriText').innerText = name;
    document.getElementById('kategoriText').classList.replace('text-gray-500', 'text-gray-800');
    document.getElementById('kategoriValue').value = id;
    toggleKategori();
}

// Klik di luar dropdown untuk menutup
document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('kategoriWrapper');
    if (wrapper && !wrapper.contains(e.target)) {
        document.getElementById('kategoriMenu').classList.add('hidden');
        document.getElementById('arrowIcon').classList.remove('rotate-180');
    }
});
</script>