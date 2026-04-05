@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-lg p-6 shadow-sm">

    <!-- HEADER -->
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-[#1E5631]">
            Manajemen Berita
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Kelola informasi berita yang akan ditampilkan pada website pondok pesantren.
        </p>

    </div>

    <!-- BUTTON -->
    <div class="flex justify-end mb-4">
        <button onclick="openTambahModal()"
            class="bg-[#1E5631] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-[#17472a] transition">
            + Tambah Berita
        </button>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full border border-[#D9D9D9] border-collapse">

            <thead>
                <tr class="bg-gray-100 text-center text-sm text-[#000000]">
                    <th class="p-3">Judul Berita</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-b border-[#D9D9D9]">
                    <td class="p-3 text-sm text-center text-[#333333]">Kegiatan Santri Ramadhan</td>
                    <td class="p-3 text-sm text-center text-[#333333]">12 Juni 2025</td>
                    <td class="p-3 text-center">
                        <span class="bg-[#D8E6E0] text-[#1E5631] px-3 py-1 rounded text-xs">
                            Publish
                        </span>
                    </td>
                    <td class="p-3 flex gap-2 justify-center">
                        <button onclick="openEditModal()"
                            class="bg-[#BFDBFE] text-[#1D4ED8] px-3 py-1 rounded text-xs">
                            Edit
                        </button>

                        <button onclick="openHapusModal()"
                            class="bg-[#FECACA] text-[#B91C1C] px-3 py-1 rounded text-xs">
                            Hapus
                        </button>
                    </td>
                </tr>

                <tr class="border-b border-[#D9D9D9]">
                    <td class="p-3 text-sm text-center text-[#333333]">Wisuda Tahfidz 2025</td>
                    <td class="p-3 text-sm text-center text-[#333333]">10 Juni 2025</td>
                    <td class="p-3 text-center">
                        <span class="bg-[#D8E6E0] text-[#1E5631] px-3 py-1 rounded text-xs">
                            Publish
                        </span>
                    </td>
                    <td class="p-3 flex gap-2 justify-center">
                        <button onclick="openEditModal()"
                            class="bg-[#BFDBFE] text-[#1D4ED8] px-3 py-1 rounded text-xs">
                            Edit
                        </button>

                        <button onclick="openHapusModal()"
                            class="bg-[#FECACA] text-[#B91C1C] px-3 py-1 rounded text-xs">
                            Hapus
                        </button>
                    </td>
                </tr>

                <tr class="border-b border-[#D9D9D9]">
                    <td class="p-3 text-sm text-center text-[#333333]">Kegiatan Santri Ramadhan</td>
                    <td class="p-3 text-sm text-center text-[#333333]">12 Juni 2025</td>
                    <td class="p-3 text-center">
                        <span class="bg-[#D8E6E0] text-[#1E5631] px-3 py-1 rounded text-xs">
                            Publish
                        </span>
                    </td>
                    <td class="p-3 flex gap-2 justify-center">
                        <button onclick="openEditModal()"
                            class="bg-[#BFDBFE] text-[#1D4ED8] px-3 py-1 rounded text-xs">
                            Edit
                        </button>

                        <button onclick="openHapusModal()"
                            class="bg-[#FECACA] text-[#B91C1C] px-3 py-1 rounded text-xs">
                            Hapus
                        </button>
                    </td>
                </tr>

                <tr class="border-b border-[#D9D9D9]">
                    <td class="p-3 text-sm text-center text-[#333333]">Kegiatan Santri Ramadhan</td>
                    <td class="p-3 text-sm text-center text-[#333333]">12 Juni 2025</td>
                    <td class="p-3 text-center">
                        <span class="bg-[#D8E6E0] text-[#1E5631] px-3 py-1 rounded text-xs">
                            Publish
                        </span>
                    </td>
                    <td class="p-3 flex gap-2 justify-center">
                        <button onclick="openEditModal()"
                            class="bg-[#BFDBFE] text-[#1D4ED8] px-3 py-1 rounded text-xs">
                            Edit
                        </button>

                        <button onclick="openHapusModal()"
                            class="bg-[#FECACA] text-[#B91C1C] px-3 py-1 rounded text-xs">
                            Hapus
                        </button>
                    </td>
                </tr>

                <tr class="border-b border-[#D9D9D9]">
                    <td class="p-3 text-sm text-center text-[#333333]">Kegiatan Santri Ramadhan</td>
                    <td class="p-3 text-sm text-center text-[#333333]">12 Juni 2025</td>
                    <td class="p-3 text-center">
                        <span class="bg-[#D8E6E0] text-[#1E5631] px-3 py-1 rounded text-xs">
                            Publish
                        </span>
                    </td>
                    <td class="p-3 flex gap-2 justify-center">
                        <button onclick="openEditModal()"
                            class="bg-[#BFDBFE] text-[#1D4ED8] px-3 py-1 rounded text-xs">
                            Edit
                        </button>

                        <button onclick="openHapusModal()"
                            class="bg-[#FECACA] text-[#B91C1C] px-3 py-1 rounded text-xs">
                            Hapus
                        </button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@include('pages.admin.berita.berita-tambah')
@include('pages.admin.berita.berita-edit')
@include('pages.admin.berita.berita-hapus')

<!-- Script Tambah -->
<script>
function openTambahModal() {
    document.getElementById('modalTambah').classList.remove('hidden');
}

function closeTambahModal() {
    document.getElementById('modalTambah').classList.add('hidden');
}
</script>

<!-- Script Edit -->
<script>
function openEditModal() {
    document.getElementById('modalEdit').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('modalEdit').classList.add('hidden');
}
</script>

<!-- Script Hapus -->
<script>
function openHapusModal() {
    document.getElementById('modalHapus').classList.remove('hidden');
}

function closeHapusModal() {
    document.getElementById('modalHapus').classList.add('hidden');
}
</script>

@endsection