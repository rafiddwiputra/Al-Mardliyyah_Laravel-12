@extends('layouts.admin')

@section('content')

<!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1E5631]">
            Kelola Profil Pondok
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola informasi profil dan sejarah pesantren
        </p>
    </div>

<div class="bg-white rounded-lg border border-[#D9D9D9] p-6">

    <!-- TAB CONTAINER -->
    <div class="border border-[#D9D9D9] rounded-lg overflow-hidden">

        <!-- TAB NAVIGATION -->
        <div class="grid grid-cols-4 border-b border-[#D9D9D9] text-sm font-medium text-center py-3">

            <button onclick="showTab('sejarah')" id="btn-sejarah">
                <span class="bg-[#1E5631] text-white px-4 py-1 rounded text-sm">
                    Sejarah
                </span>
            </button>

            <button onclick="showTab('fasilitas')" id="btn-fasilitas">
                <span class="px-4 py-1 rounded text-sm">
                    Fasilitas
                </span>
            </button>

        </div>

        <!-- TAB CONTENT -->
        <div class="p-6">

            <div id="tab-sejarah">
                @include('pages.admin.profil-pondok.sejarah')
            </div>

            <div id="tab-fasilitas" class="hidden">
                @include('pages.admin.profil-pondok.fasilitas')
            </div>

        </div>

    </div>

</div>

@include('pages.admin.profil-pondok.fasilitas-tambah')
@include('pages.admin.profil-pondok.fasilitas-edit')
@include('pages.admin.profil-pondok.fasilitas-hapus')

<script>
function showTab(tab) {
    document.querySelectorAll('[id^="tab-"]').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('[id^="btn-"] span').forEach(span => {
        span.classList.remove('bg-[#1E5631]', 'text-white');
    });
    document.getElementById('tab-' + tab).classList.remove('hidden');
    document.querySelector('#btn-' + tab + ' span').classList.add('bg-[#1E5631]', 'text-white');
}

// --- FUNGSI MODAL FASILITAS (Disederhanakan) ---

function openTambahFasilitasModal() {
    openModal('modalTambahFasilitas');
}

function closeTambahFasilitasModal() {
    closeModal('modalTambahFasilitas');
}

function openEditFasilitasModal() {
    openModal('modalEditFasilitas');
}

function closeEditFasilitasModal() {
    closeModal('modalEditFasilitas');
}

function openHapusFasilitasModal() {
    openModal('modalHapusFasilitas');
}

function closeHapusFasilitasModal() {
    closeModal('modalHapusFasilitas');
}

// --- FUNGSI CORE MODAL (WAJIB ADA) ---

function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex'); // Agar posisi di tengah
        setTimeout(() => {
            modal.classList.add('opacity-100');
        }, 10);
    } else {
        console.error("Modal ID " + id + " tidak ditemukan!");
    }
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('opacity-100');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }
}
</script>


@endsection