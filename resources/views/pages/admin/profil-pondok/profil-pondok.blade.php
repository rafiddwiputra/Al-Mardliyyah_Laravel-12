@extends('layouts.admin')

@section('content')

<div class="mb-6 text-left">
    <h1 class="text-2xl font-bold text-[#1E5631]">Kelola Profil Pondok</h1>
    <p class="text-sm text-gray-500 mt-1">Kelola informasi profil dan sejarah pesantren</p>
</div>

<div class="bg-white rounded-lg border border-[#D9D9D9] overflow-hidden">
    
    <div class="border-b border-[#D9D9D9] py-6 bg-white">
        <div class="flex justify-center items-center gap-8">
            <button onclick="showTab('sejarah')" id="btn-sejarah" class="focus:outline-none">
                <span class="bg-[#1E5631] text-white px-6 py-1.5 rounded text-sm transition-all duration-300">Sejarah</span>
            </button>
            <button onclick="showTab('fasilitas')" id="btn-fasilitas" class="focus:outline-none">
                <span class="px-6 py-1.5 rounded text-sm transition-all duration-300">Fasilitas</span>
            </button>
            <button onclick="showTab('video')" id="btn-video" class="focus:outline-none">
                <span class="px-6 py-1.5 rounded text-sm transition-all duration-300">Video</span>
            </button>
        </div>
    </div>

    <div id="tab-sejarah" class="p-8">
        @include('pages.admin.profil-pondok.sejarah')
    </div>

    <div id="tab-fasilitas" class="hidden p-8">
        @include('pages.admin.profil-pondok.fasilitas')
    </div>

    <div id="tab-video" class="hidden p-8">
        @include('pages.admin.profil-pondok.video')
    </div>

</div>

@include('pages.admin.profil-pondok.fasilitas-tambah')
@include('pages.admin.profil-pondok.fasilitas-edit')
@include('pages.admin.profil-pondok.fasilitas-hapus')

{{-- @include('pages.admin.profil-pondok.video-tambah') --}}
{{-- @include('pages.admin.profil-pondok.video-edit') --}}
{{-- @include('pages.admin.profil-pondok.video-hapus') --}}

{{-- BEST PRACTICE: Jika layouts.admin memiliki @stack('scripts'), 
     lebih baik <script> ini dipindah ke dalam @push('scripts'). 
     Tapi jika tidak, diletakkan di akhir @section sudah cukup aman. --}}
<script>
// --- FUNGSI TAB ---
function showTab(tab) {
    document.querySelectorAll('[id^="tab-"]').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('[id^="btn-"] span').forEach(span => {
        span.classList.remove('bg-[#1E5631]', 'text-white');
    });
    document.getElementById('tab-' + tab).classList.remove('hidden');
    document.querySelector('#btn-' + tab + ' span').classList.add('bg-[#1E5631]', 'text-white');
}

// --- FUNGSI CORE MODAL ---
function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
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

// --- LOGIKA MODAL FASILITAS ---
function openTambahFasilitasModal() {
    openModal('modalTambahFasilitas');
}
function closeTambahFasilitasModal() {
    closeModal('modalTambahFasilitas');
}

// EDIT FASILITAS
function openEditFasilitasModal(id, nama, deskripsi, fotoUrl) {
    document.getElementById('edit_nama_fasilitas').value = nama || '';
    document.getElementById('edit_deskripsi_fasilitas').value = deskripsi || '';
    
    const imgPreview = document.getElementById('edit_preview_fasilitas_img');
    if(imgPreview && fotoUrl) {
        imgPreview.src = fotoUrl;
    }

    const form = document.getElementById('formEditFasilitas');
    if(form && id) {
        form.action = "/admin/profil-pondok/fasilitas/" + id;
    }

    openModal('modalEditFasilitas');
}

function closeEditFasilitasModal() {
    closeModal('modalEditFasilitas');
}

// HAPUS FASILITAS
function openHapusFasilitasModal(id) {
    const form = document.getElementById('formHapusFasilitas');
    if(form && id) {
        form.action = "/admin/profil-pondok/fasilitas/" + id;
    }
    
    openModal('modalHapusFasilitas');
}

// --- LOGIKA MODAL VIDEO ---
function openTambahVideoModal() {
    openModal('modalTambahVideo');
}
function closeTambahVideoModal() {
    closeModal('modalTambahVideo');
}

function openEditVideoModal(id, judul, deskripsi) {
    const inputJudul = document.getElementById('edit_judul_video');
    const inputDeskripsi = document.getElementById('edit_deskripsi_video');
    if(inputJudul) inputJudul.value = judul || '';
    if(inputDeskripsi) inputDeskripsi.value = deskripsi || '';

    const form = document.getElementById('formEditVideo');
    if(form && id) {
        form.action = `/admin/profil-pondok/video/update/${id}`;
    }
    openModal('modalEditVideo');
}
function closeEditVideoModal() {
    closeModal('modalEditVideo');
}

function openHapusVideoModal(id) {
    const form = document.getElementById('formHapusVideo');
    if(form && id) {
        form.action = `/admin/profil-pondok/video/hapus/${id}`;
    }
    openModal('modalHapusVideo');
}
function closeHapusVideoModal() {
    closeModal('modalHapusVideo');
}
</script>

@endsection