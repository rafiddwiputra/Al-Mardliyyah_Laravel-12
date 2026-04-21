@extends('layouts.admin')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-[#1E5631]">
                Kontak
            </h1>
            <p class="text-sm text-gray-500">
                Kelola informasi kontak pondok pesantren
            </p>
        </div>

        <!-- BUTTON TAMBAH -->
        <button onclick="openModal('tambahModal')"
            class="bg-[#1E5631] text-white px-4 py-2 rounded-lg text-sm">
            + Tambah Kontak
        </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white border rounded-xl overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="text-left px-6 py-3">Judul</th>
                    <th class="text-left px-6 py-3">Nilai</th>
                    <th class="text-left px-6 py-3">Tipe</th>
                    <th class="text-center px-6 py-3">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">

                @foreach($kontak as $item)
                <tr class="border-t hover:bg-gray-50">

                    <td class="px-6 py-4 font-medium">
                        {{ $item->judul }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->nilai }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->tipe }}
                    </td>

                    <td class="px-5 py-6 text-center align-middle whitespace-nowrap">

                        <div class="flex justify-center gap-2">

                            <!-- EDIT -->
                            <button type="button"
                                onclick="openEditModal(
                                    {{ $item->id }},
                                    '{{ $item->judul }}',
                                    '{{ $item->nilai }}',
                                    '{{ $item->tipe }}'
                                )"
                                class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded font-bold mr-2 hover:bg-blue-200 transition-colors focus:outline-none">
                                Edit
                            </button>

                            <!-- DELETE -->
                            <button type="button"
                                onclick="openDeleteModal({{ $item->id }})"
                                class="bg-red-100 text-red-600 px-4 py-1.5 rounded font-bold hover:bg-red-200 transition-colors focus:outline-none">
                                Hapus
                            </button>

                        </div>

                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- INCLUDE MODAL (SAMA SEPERTI JADWAL) -->
@include('pages.admin.kontak.kontak-tambah')
@include('pages.admin.kontak.kontak-edit')
@include('pages.admin.kontak.kontak-hapus')

<!-- JS MODAL -->
<script>
function openModal(id){
    document.getElementById(id).classList.remove('hidden');
}

function closeModal(id){
    document.getElementById(id).classList.add('hidden');
}

function openEditModal(id, judul, nilai, tipe){
    document.getElementById('editForm').action = '/admin/kontak/' + id;

    document.getElementById('editJudul').value = judul;
    document.getElementById('editNilai').value = nilai;
    document.getElementById('editTipe').value = tipe;

    openModal('editModal');
}

function openDeleteModal(id){
    document.getElementById('deleteForm').action = '/admin/kontak/' + id;

    openModal('deleteModal');
}
</script>

@endsection