@extends('layouts.admin')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold text-[#1E5631]">
        Jadwal Pendaftaran
    </h2>
    <p class="text-sm text-gray-500 mb-6">
        Kelola jadwal pembukaan dan penutupan pendaftaran santri
    </p>

    <!-- CARD SISTEM BUKA TUTUP -->

<div class="bg-white border rounded-xl p-6 mb-6 flex items-center justify-between">

    <div>
        <h3 class="font-bold text-[#1E5631] mb-1">
            Sistem Buka / Tutup Pendaftaran
        </h3>
        <p class="text-sm text-gray-500 mb-3">
            Kontrol akses formulir pendaftaran untuk calon santri
        </p>

        <!-- STATUS -->
        <div class="flex items-center gap-3">

            @if($status)

                <span class="bg-green-100 font-bold text-green-700 text-xs px-3 py-1 rounded-full">
                    Dibuka
                </span>

                <span class="text-xs text-[#1E5631]">
                    Formulir pendaftaran dibuka
                </span>

            @else

                <span class="bg-red-100 font-bold text-red-700 text-xs px-3 py-1 rounded-full">
                    Ditutup
                </span>

                <span class="text-xs text-red-600">
                    Formulir pendaftaran ditutup
                </span>

            @endif

        </div>
    </div>

    <!-- TOGGLE -->
    <form action="{{ route('admin.jadwal.toggle') }}" method="POST">
        @csrf

        <button type="submit"
            class="w-12 h-6 rounded-full flex items-center px-1 transition
            {{ $status ? 'bg-[#1E5631]' : 'bg-gray-400' }}">

            <div class="w-4 h-4 bg-white rounded-full
                {{ $status ? 'ml-auto' : 'ml-0' }}">
            </div>

        </button>
    </form>

</div>

</div>

<div class="flex justify-end mb-4">
    <button onclick="openModal('tambahModal')"
    class="bg-[#1E5631] text-white px-4 py-2 rounded-lg text-sm">
    + Tambah Jadwal
    </button>
</div>

<div class="bg-white border rounded-xl overflow-hidden">

    <table class="w-full text-sm">

        <!-- HEADER -->
        <thead class="bg-gray-50 text-gray-600">
            <tr>
                <th class="text-left px-6 py-3">Nama Jadwal</th>
                <th class="text-left px-6 py-3">Tanggal Buka</th>
                <th class="text-left px-6 py-3">Tanggal Tutup</th>
                <th class="text-center px-6 py-3">Aksi</th>
            </tr>
        </thead>

        <!-- BODY -->
        <tbody class="text-gray-700">

            @foreach($data as $item)
            <tr class="border-t hover:bg-gray-50">

                <td class="px-6 py-4 font-medium">
                    {{ $item->judul }}
                </td>

                <td class="px-6 py-4">
                    {{ explode(' - ', $item->deskripsi)[0] ?? '-' }}
                </td>

                <td class="px-6 py-4">
                    {{ explode(' - ', $item->deskripsi)[1] ?? '-' }}
                </td>

                <td class="px-6 py-4 text-center">

                    <div class="flex justify-center gap-2">

                        <!-- EDIT -->
                        <button type="button"
                            onclick="openEditModal(
                                {{ $item->id }},
                                '{{ $item->judul }}',
                                '{{ explode(' - ', $item->deskripsi)[0] ?? '' }}',
                                '{{ explode(' - ', $item->deskripsi)[1] ?? '' }}'
                            )"
                            class="bg-[#BFDBFE] text-[#1D4ED8] px-3 py-1 rounded text-xs font-bold">
                            Edit
                        </button>

                        <!-- DELETE -->
                        <button type="button"
                            onclick="openDeleteModal({{ $item->id }})"
                            class="bg-[#FECACA] text-[#B91C1C] px-3 py-1 rounded text-xs font-bold">
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

@include('pages.admin.jadwal.jadwal-tambah')
@include('pages.admin.jadwal.jadwal-edit')
@include('pages.admin.jadwal.jadwal-hapus')

<script>
function openModal(id){
    document.getElementById(id).classList.remove('hidden');
}

function closeModal(id){
    document.getElementById(id).classList.add('hidden');
}
</script>


<script>
function openEditModal(id, judul, mulai, selesai){
    document.getElementById('editForm').action = '/admin/jadwal-pendaftaran/' + id;

    document.getElementById('editJudul').value = judul;
    document.getElementById('editMulai').value = mulai;
    document.getElementById('editSelesai').value = selesai;

    openModal('editModal');
}

function openDeleteModal(id){
    document.getElementById('deleteForm').action = '/admin/jadwal-pendaftaran/' + id;
    openModal('deleteModal');
}
</script>

@endsection