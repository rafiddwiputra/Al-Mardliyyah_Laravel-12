@extends('layouts.admin')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1E5631]">
            Banner Beranda
        </h1>

        <p class="text-sm text-gray-500">
            Mengatur tampilan halaman beranda
        </p>
    </div>

    <!-- FORM -->
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

            <!-- JUDUL -->
            <div class="mb-4">
                <label class="block text-xs text-black mb-1">
                    Judul Banner
                </label>
                <input type="text"
                    value="Pondok Pesantren Al-Mardliyiyah"
                    class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-4">
                <label class="block text-xs text-black mb-1">
                    Deskripsi
                </label>
                <textarea rows="3"
                    class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">Membentuk Generasi Qur'ani yang Berakhlak Mulia dan Berprestasi</textarea>
            </div>

            <!-- UPLOAD -->
            <div>
                <label class="block text-xs text-black mb-2">
                    Background
                </label>

                <label
                    class="flex flex-col items-center justify-center w-full h-20 border border-[#D9D9D9] rounded cursor-pointer hover:bg-gray-50 transition text-center">

                    <span class="text-[11px] text-gray-400">
                        Upload Gambar (Opsional)
                    </span>

                    <input type="file" class="hidden">
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

            <!-- JUDUL -->
            <div class="mb-4">
                <label class="block text-xs text-black mb-1">
                    Judul
                </label>
                <input type="text"
                    value="Lembaga Pendidikan Islam Terpadu"
                    class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label class="block text-xs text-black mb-1">
                    Deskripsi
                </label>

                <textarea rows="4"
                    class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm leading-relaxed focus:outline-none">Pondok Pesantren Al-Mardliyiyah adalah lembaga pendidikan Islam yang menggabungkan kurikulum pesantren tradisional dengan pendidikan formal modern. Kami berkomitmen untuk membentuk generasi yang menguasai ilmu agama, berakhlak mulia, dan berprestasi dalam bidang akademik. Dengan adanya pengajar profesional dan fasilitas yang memadai, kami memastikan setiap santri mendapatkan pendidikan terbaik dalam lingkungan Islami yang kondusif untuk berkembang.</textarea>
            </div>

        </div>

        <!-- SECTION VISI MISI -->
        <div class="border border-[#D9D9D9] rounded p-5">

            <!-- TITLE -->
            <div class="mb-4">
                <h2 class="text-sm font-semibold text-[#1E5631]">
                    Visi & Misi
                </h2>
                <p class="text-xs text-gray-500">
                    Mengatur visi dan misi Pondok Pesantren
                </p>
            </div>

            <!-- VISI -->
            <div class="mb-5">
                <label class="block text-xs text-black mb-1">
                    Visi
                </label>
                <input type="text"
                    value="Menjadi lembaga pendidikan Islam terpadu yang mencetak generasi Qur'ani, berakhlak mulia, berprestasi, dan bermanfaat bagi masyarakat"
                    class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
            </div>

            <!-- MISI -->
            <div>

                <!-- HEADER MISI -->
                <div class="flex justify-between items-center mb-2">
                    <label class="text-xs text-black">
                        Misi
                    </label>

                    <button type="button"
                        onclick="tambahMisi()"
                        class="bg-[#1E5631] text-white text-xs px-3 py-1 rounded">
                        + Tambah
                    </button>
                </div>

                <!-- LIST MISI -->
                <div id="listMisi" class="space-y-2">

                    <!-- ITEM -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 w-4 text-right">1.</span>

                        <input type="text"
                            value="Memberikan pendidikan yang mengintegrasikan aspek spiritual, intelektual, emosional, dan sosial"
                            class="flex-1 border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">

                        <button onclick="hapusMisi(this)" class="text-red-500 text-sm">🗑</button>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 w-4 text-right">2.</span>

                        <input type="text"
                            value="Meningkatkan mutu pendidikan melalui kurikulum yang relevan dan metode pembelajaran inovatif"
                            class="flex-1 border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">

                        <button onclick="hapusMisi(this)" class="text-red-500 text-sm">🗑</button>
                    </div>

                </div>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="flex justify-end gap-2">
            <button class="px-4 py-2 border rounded text-gray-600">
                Batal
            </button>

            <button class="px-4 py-2 bg-[#1E5631] text-white rounded">
                Simpan Perubahan
            </button>
        </div>

    </div>

</div>

<script>
function tambahMisi() {
    const list = document.getElementById('listMisi');
    const jumlah = list.children.length + 1;

    const item = document.createElement('div');
    item.className = "flex items-center gap-2";

    item.innerHTML = `
        <span class="text-xs text-gray-500 w-4 text-right">${jumlah}.</span>

        <input type="text"
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
</script>

@endsection