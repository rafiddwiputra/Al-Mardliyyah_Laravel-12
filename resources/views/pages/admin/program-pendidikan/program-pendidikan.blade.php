@extends('layouts.admin')

@section('content')

<div class="p-4">

    <!-- HEADER -->
    <div class="mb-6">

        <div>
            <h1 class="text-[32px] font-bold text-[#1E5631] leading-tight">
                Program Pendidikan
            </h1>

            <p class="text-sm text-[#7A7A7A] mt-1">
                Kelola program-program pendidikan pondok
            </p>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-end mt-4">
            <button onclick="openTambahProgramModal()"
                class="bg-[#1E5631] text-white px-4 py-2 rounded text-sm font-medium">
                + Tambah
            </button>
        </div>

    </div>

    {{-- ================= SECTION 1 ================= --}}
@if(isset($programs['formal']))
<div class="border border-[#D9D9D9] rounded mb-6 overflow-hidden">

    <div class="bg-gradient-to-r from-[#1E5631] to-[#43C463] px-8 py-5">
        <h2 class="text-white font-bold text-[18px]">
            Lembaga Pendidikan Formal
        </h2>
    </div>

    <div class="divide-y divide-[#D9D9D9]">

        @foreach($programs['formal'] as $program)
        <div class="flex justify-between items-center px-5 py-4">

            <div>
                <h3 class="font-semibold text-[16px] text-black">
                    {{ $program->nama_program }}
                </h3>

                <p class="text-sm text-[#7A7A7A] mt-1">
                    '{{ addslashes($program->deskripsi) }}',
                </p>
            </div>

            <div class="flex gap-3">

                <button onclick="openEditProgramModal(
                {{ $program->id }},
                '{{ $program->nama_program }}',
                '{{ addslashes($program->deskripsi) }}',
                {{ $program->kategori_id }},
                '{{ $program->status }}'
                )"
                class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium">
                    Edit
                </button>

                <button onclick="openHapusProgramModal({{ $program->id }}, '{{ $program->nama_program }}')"
                    class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium">
                    Hapus
                </button>

            </div>

        </div>
        @endforeach

    </div>

</div>
@endif

    {{-- ================= SECTION 2 ================= --}}
@if(isset($programs['nonformal']))
<div class="border border-[#D9D9D9] rounded mb-6 overflow-hidden">

    <div class="bg-gradient-to-r from-[#1E5631] to-[#43C463] px-8 py-5">
        <h2 class="text-white font-bold text-[18px]">
            Lembaga Pendidikan Non Formal
        </h2>
    </div>

    <div class="divide-y divide-[#D9D9D9]">

        @foreach($programs['nonformal'] as $program)
        <div class="flex justify-between items-center px-5 py-4">

            <div>
                <h3 class="font-semibold text-[16px] text-black">
                    {{ $program->nama_program }}
                </h3>

                <p class="text-sm text-[#7A7A7A] mt-1">
                    '{{ addslashes($program->deskripsi) }}',
                </p>
            </div>

            <div class="flex gap-3">
                <button onclick="openEditProgramModal(
                {{ $program->id }},
                '{{ $program->nama_program }}',
                '{{ addslashes($program->deskripsi) }}',
                {{ $program->kategori_id }},
                '{{ $program->status }}'
                )"
                class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium">
                    Edit
                </button>

                <button onclick="openHapusProgramModal({{ $program->id }}, '{{ $program->nama_program }}')"
                    class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium">
                    Hapus
                </button>
            </div>

        </div>
        @endforeach

    </div>

</div>
@endif

    {{-- ================= SECTION 3 ================= --}}
    @if(isset($programs['unggulan']))
    <div class="border border-[#D9D9D9] rounded overflow-hidden">

        <div class="bg-gradient-to-r from-[#1E5631] to-[#43C463] px-8 py-5">
            <h2 class="text-white font-bold text-[18px]">
                Program Keunggulan
            </h2>
        </div>

        <div class="divide-y divide-[#D9D9D9]">

            @foreach($programs['unggulan'] as $program)
            <div class="flex justify-between items-center px-5 py-4">
                <div>
                    <h3 class="font-semibold text-[16px] text-black">
                        {{ $program->nama_program }}
                    </h3>
                    <p class="text-sm text-[#7A7A7A] mt-1">
                        '{{ addslashes($program->deskripsi) }}'
                    </p>
                </div>

                <div class="flex gap-3">
                    <button onclick="openEditProgramModal(
                        {{ $program->id }},
                        '{{ $program->nama_program }}',
                        '{{ addslashes($program->deskripsi) }}',
                        {{ $program->kategori_id }},
                        '{{ $program->status }}'
                        )"
                        class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium">
                        Edit
                    </button>

                    <button onclick="openHapusProgramModal({{ $program->id }}, '{{ $program->nama_program }}')"
                        class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium">
                        Hapus
                    </button>
                </div>
            </div>
            @endforeach

        </div>

    </div>
    @endif

</div>

@include('pages.admin.program-pendidikan.program-tambah')
@include('pages.admin.program-pendidikan.program-edit')
@include('pages.admin.program-pendidikan.program-hapus')

<script>
function openTambahProgramModal() {
    document.getElementById('modalTambahProgram').classList.remove('hidden');
}

function closeTambahProgramModal() {
    document.getElementById('modalTambahProgram').classList.add('hidden');
}

function openEditProgramModal(id, nama, deskripsi, kategori_id, status) {

    document.getElementById('modalEditProgram').classList.remove('hidden');

    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_deskripsi').value = deskripsi;
    document.getElementById('edit_kategori').value = kategori_id;

    let checkbox = document.getElementById('edit_status');
    checkbox.checked = (status === 'aktif');

    document.getElementById('formEditProgram').action =
        '/admin/program-pendidikan/' + id;
}

function closeEditProgramModal() {
    document.getElementById('modalEditProgram').classList.add('hidden');
}

function openHapusProgramModal(id) {
    document.getElementById('modalHapusProgram').classList.remove('hidden');

    document.getElementById('formHapusProgram').action =
        '/admin/program-pendidikan/' + id;

        // set nama program ke modal
    document.getElementById('hapus_nama_program').innerText = nama;
}

function closeHapusProgramModal() {
    document.getElementById('modalHapusProgram').classList.add('hidden');
}
</script>

@endsection