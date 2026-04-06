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

    <!-- ================= SECTION 1 ================= -->
    <div class="border border-[#D9D9D9] rounded mb-6 overflow-hidden">

        <div class="bg-gradient-to-r from-[#1E5631] to-[#43C463] px-8 py-5">
            <h2 class="text-white font-bold text-[18px]">
                Lembaga Pendidikan Formal
            </h2>
        </div>

        <div class="divide-y divide-[#D9D9D9]">

            <div class="flex justify-between items-center px-5 py-4">

                <div>
                    <h3 class="font-semibold text-[16px] text-black">
                        SMP Progresif Al-Mardliyiyah
                    </h3>

                    <p class="text-sm text-[#7A7A7A] mt-1">
                        Sekolah Menengah Kejuruan bidang Kimia
                    </p>
                </div>

                <div class="flex gap-3">

                    <button onclick="openEditProgramModal()"
                        class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium">
                        Edit
                    </button>

                    <button onclick="openHapusProgramModal()"
                        class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium">
                        Hapus
                    </button>

                </div>

            </div>

            <div class="flex justify-between items-center px-5 py-4">

                <div>
                    <h3 class="font-semibold text-[16px] text-black">
                        MTS Al-Mujadaddiyyah
                    </h3>

                    <p class="text-sm text-[#7A7A7A] mt-1">
                        Pendidikan Madrasah Tsanawiyah dengan kurikulum terintegrasi
                    </p>
                </div>

                <div class="flex gap-3">
                    <button class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium">
                        Edit
                    </button>

                    <button class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium">
                        Hapus
                    </button>
                </div>

            </div>

            <div class="flex justify-between items-center px-5 py-4">

                <div>
                    <h3 class="font-semibold text-[16px] text-black">
                        MA Al-Mujadaddiyyah
                    </h3>

                    <p class="text-sm text-[#7A7A7A] mt-1">
                        Pendidikan Madrasah Aliyah dengan fokus pendidikan Islam
                    </p>
                </div>

                <div class="flex gap-3">
                    <button class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium">
                        Edit
                    </button>

                    <button class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium">
                        Hapus
                    </button>
                </div>

            </div>

        </div>

    </div>

    <!-- ================= SECTION 2 ================= -->
    <div class="border border-[#D9D9D9] rounded mb-6 overflow-hidden">

        <div class="bg-gradient-to-r from-[#1E5631] to-[#43C463] px-8 py-5">
            <h2 class="text-white font-bold text-[18px]">
                Lembaga Pendidikan Non Formal
            </h2>
        </div>

        <div class="divide-y divide-[#D9D9D9]">

            <div class="flex justify-between items-center px-5 py-4">

                <div>
                    <h3 class="font-semibold text-[16px] text-black">
                        Madrasah Diniyyah Al-Mardliyiyah
                    </h3>

                    <p class="text-sm text-[#7A7A7A] mt-1">
                        Pendidikan Madrasah Tsanawiyah dengan kurikulum terintegrasi
                    </p>
                </div>

                <div class="flex gap-3">
                    <button class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium">
                        Edit
                    </button>

                    <button class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium">
                        Hapus
                    </button>
                </div>

            </div>

        </div>

    </div>

    <!-- ================= SECTION 3 ================= -->
    <div class="border border-[#D9D9D9] rounded overflow-hidden">

        <div class="bg-gradient-to-r from-[#1E5631] to-[#43C463] px-8 py-5">
            <h2 class="text-white font-bold text-[18px]">
                Program Keunggulan
            </h2>
        </div>

        <div class="divide-y divide-[#D9D9D9]">

            <div class="flex justify-between items-center px-5 py-4">
                <div>
                    <h3 class="font-semibold text-[16px] text-black">Tahfidzul Qur'an</h3>
                    <p class="text-sm text-[#7A7A7A] mt-1">
                        Program menghafal Al-Qur'an 30 juz
                    </p>
                </div>

                <div class="flex gap-3">
                    <button class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium">Edit</button>
                    <button class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium">Hapus</button>
                </div>
            </div>

            <div class="flex justify-between items-center px-5 py-4">
                <div>
                    <h3 class="font-semibold text-[16px] text-black">Takhasus Kitab Kuning</h3>
                    <p class="text-sm text-[#7A7A7A] mt-1">
                        Pembelajaran kitab klasik Islam
                    </p>
                </div>

                <div class="flex gap-3">
                    <button class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium">Edit</button>
                    <button class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium">Hapus</button>
                </div>
            </div>

            <div class="flex justify-between items-center px-5 py-4">
                <div>
                    <h3 class="font-semibold text-[16px] text-black">Bahasa Inggris</h3>
                    <p class="text-sm text-[#7A7A7A] mt-1">
                        Program bahasa Inggris global
                    </p>
                </div>

                <div class="flex gap-3">
                    <button class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium">Edit</button>
                    <button class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium">Hapus</button>
                </div>
            </div>

        </div>

    </div>

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

function openEditProgramModal() {
    document.getElementById('modalEditProgram').classList.remove('hidden');
}

function closeEditProgramModal() {
    document.getElementById('modalEditProgram').classList.add('hidden');
}

function openHapusProgramModal() {
    document.getElementById('modalHapusProgram').classList.remove('hidden');
}

function closeHapusProgramModal() {
    document.getElementById('modalHapusProgram').classList.add('hidden');
}
</script>

@endsection