@extends('layouts.admin')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1E5631]">
            Informasi Website
        </h1>

        <p class="text-sm text-gray-500">
            Mengatur tampilan website
        </p>
    </div>

    <!-- FORM -->
    <form action="{{ route('informasi.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="space-y-6">

        <!-- SECTION HERO -->
        <div class="border border-[#D9D9D9] rounded p-5">

            <!-- TITLE -->
            <div class="mb-4">
                <h2 class="text-sm font-semibold text-[#1E5631]">
                    Banner Beranda (Hero)
                </h2>
                <p class="text-xs text-gray-500">
                    Mengatur tampilan banner utama di halaman beranda
                </p>
            </div>

            <!-- UPLOAD -->
            <div>
                <label class="block text-xs text-black mb-2">
                    Background
                </label>

                <label
                class="flex flex-col items-center justify-center w-full h-32 border border-[#D9D9D9] rounded cursor-pointer hover:bg-gray-50 transition text-center">

                <span class="text-[11px] text-gray-400 upload-text">
                    Upload Gambar (Opsional)
                </span>

                <!-- NAMA FILE -->
                <p class="text-xs text-green-600 mt-2 file-name hidden"></p>

                <!-- PREVIEW GAMBAR -->
                <img class="preview-image hidden mt-2 max-h-20 rounded">

                <input type="file" name="banner_image" class="hidden file-input">
                </label>
            </div>

        </div>

        <!-- SECTION LEMBAGA -->
        <div class="border border-[#D9D9D9] rounded p-5">

            <!-- TITLE -->
            <div class="mb-4">
                <h2 class="text-sm font-semibold text-[#1E5631]">
                    Lembaga Pendidikan
                </h2>
                <p class="text-xs text-gray-500">
                    Informasi tentang lembaga pendidikan
                </p>
            </div>


            <!-- DESKRIPSI -->
            <div>
                <label class="block text-xs text-black mb-1">
                    Deskripsi
                </label>

                <textarea 
                name="deskripsi_lembaga"
                rows="4"
                class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm">{{ $profil->deskripsi_lembaga ?? '' }}</textarea>

            </div>

            <div class="mt-4">
    <label class="block text-xs text-black mb-2">
        Gambar Lembaga
    </label>

    <label
    class="flex flex-col items-center justify-center w-full h-32 border border-[#D9D9D9] rounded cursor-pointer hover:bg-gray-50 transition text-center">

    <span class="text-[11px] text-gray-400 upload-text">
        Upload Gambar
    </span>

    <!-- NAMA FILE -->
    <p class="text-xs text-green-600 mt-2 file-name hidden"></p>

    <!-- PREVIEW GAMBAR -->
    <img class="preview-image hidden mt-2 max-h-20 rounded">

    <input type="file" name="gambar_lembaga" class="hidden file-input">
</label>
</div>
        </div>


        <!-- BUTTON -->
        <div class="flex justify-end gap-2">
            <button type="button" class="px-4 py-2 border rounded text-gray-600">
                Batal
            </button>

            <button type="submit" class="px-4 py-2 bg-[#1E5631] text-white rounded">
                Simpan Perubahan
            </button>
        </div>

    </div>
</div>
</form>

<script>
function tambahMisi() {
    const list = document.getElementById('listMisi');
    const jumlah = list.children.length + 1;

    const item = document.createElement('div');
    item.className = "flex items-center gap-2";

    item.innerHTML = `
        <span class="text-xs text-gray-500 w-4 text-right">${jumlah}.</span>

        <input type="text"
            name="misi[]"
            placeholder="Masukkan misi"
            class="flex-1 border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">

        <button onclick="hapusMisi(this)" class="text-red-500 text-sm">🗑</button>
    `;

    list.appendChild(item);
}

function hapusMisi(btn) {
    btn.parentElement.remove();

    // update nomor ulang
    const items = document.querySelectorAll('#listMisi div');
    items.forEach((item, index) => {
        item.querySelector('span').innerText = (index + 1) + '.';
    });
}

document.querySelectorAll('.file-input').forEach(input => {
    input.addEventListener('change', function() {

        const file = this.files[0];
        if(!file) return;

        const label = this.closest('label');

        const fileNameText = label.querySelector('.file-name');
        const previewImage = label.querySelector('.preview-image');
        const uploadText = label.querySelector('.upload-text');

        // tampilkan nama file
        fileNameText.textContent = "File: " + file.name;
        fileNameText.classList.remove('hidden');

        // sembunyikan text upload
        uploadText.classList.add('hidden');

        // tampilkan preview gambar
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    });
});

</script>

@endsection