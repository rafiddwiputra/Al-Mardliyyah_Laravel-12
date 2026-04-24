@extends('layouts.admin')

@section('content')

{{-- ================= TOAST NOTIFICATION CONTAINER ================= --}}
{{-- Container dibuat 'fixed' di pojok kanan atas, menimpa elemen lain (z-[9999]) --}}
<div id="toast-container" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 items-end pointer-events-none">
    
    @if(session('success'))
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-green-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Berhasil</h4>
                <p class="text-xs text-gray-500 mt-0.5">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-red-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Gagal</h4>
                <p class="text-xs text-gray-500 mt-0.5">{{ session('error') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-red-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Peringatan</h4>
                <ul class="list-disc list-inside mt-1 text-xs text-gray-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

</div>
{{-- ================= END TOAST CONTAINER ================= --}}

<div class="p-4">

    <div class="mb-6">
        <div>
            <h1 class="text-[32px] font-bold text-[#1E5631] leading-tight">
                Program Pendidikan
            </h1>
            <p class="text-sm text-[#7A7A7A] mt-1">
                Kelola lembaga dan program pendidikan pondok
            </p>
        </div>

        <div class="flex justify-end mt-4">
            <button onclick="openTambahProgramModal()"
                class="bg-[#1E5631] text-white px-4 py-2 rounded text-sm font-medium hover:bg-green-800 transition">
                + Tambah
            </button>
        </div>
    </div>

    {{-- ================= SECTION 1: LEMBAGA PENDIDIKAN ================= --}}
    {{-- Menyesuaikan dengan string persis dari nilai ENUM di database --}}
    @if(isset($programs['lembaga pendidikan']))
    <div class="border border-[#D9D9D9] rounded mb-6 overflow-hidden bg-white">

        <div class="bg-gradient-to-r from-[#1E5631] to-[#43C463] px-8 py-5">
            <h2 class="text-white font-bold text-[18px]">
                Daftar Lembaga Pendidikan
            </h2>
        </div>

        <div class="divide-y divide-[#D9D9D9]">
            @foreach($programs['lembaga pendidikan'] as $program)
            <div class="flex justify-between items-center px-5 py-4 hover:bg-gray-50 transition">

                <div>
                    <h3 class="font-semibold text-[16px] text-black">
                        {{ $program->nama_program }}
                    </h3>
                    <p class="text-sm text-[#7A7A7A] mt-1 line-clamp-2 max-w-3xl">
                        {{ $program->deskripsi }}
                    </p>
                </div>

                <div class="flex gap-3 shrink-0">
                    {{-- Perhatikan parameter ke-4: mengirimkan string kategori, bukan ID --}}
                    <button onclick="openEditProgramModal(
                        {{ $program->id }},
                        '{{ addslashes($program->nama_program) }}',
                        '{{ addslashes($program->deskripsi) }}',
                        '{{ $program->kategori }}', 
                        '{{ $program->status }}'
                    )"
                    class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium hover:bg-blue-300 transition">
                        Edit
                    </button>

                    <button onclick="openHapusProgramModal({{ $program->id }}, '{{ addslashes($program->nama_program) }}')"
                        class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium hover:bg-red-300 transition">
                        Hapus
                    </button>
                </div>

            </div>
            @endforeach
        </div>

    </div>
    @endif

    {{-- ================= SECTION 2: PROGRAM PENDIDIKAN ================= --}}
    @if(isset($programs['program pendidikan']))
    <div class="border border-[#D9D9D9] rounded mb-6 overflow-hidden bg-white">

        <div class="bg-gradient-to-r from-[#1E5631] to-[#43C463] px-8 py-5">
            <h2 class="text-white font-bold text-[18px]">
                Daftar Program Pendidikan (Ekstrakurikuler/Unggulan)
            </h2>
        </div>

        <div class="divide-y divide-[#D9D9D9]">
            @foreach($programs['program pendidikan'] as $program)
            <div class="flex justify-between items-center px-5 py-4 hover:bg-gray-50 transition">

                <div>
                    <h3 class="font-semibold text-[16px] text-black">
                        {{ $program->nama_program }}
                    </h3>
                    <p class="text-sm text-[#7A7A7A] mt-1 line-clamp-2 max-w-3xl">
                        {{ $program->deskripsi }}
                    </p>
                </div>

                <div class="flex gap-3 shrink-0">
                    <button onclick="openEditProgramModal(
                        {{ $program->id }},
                        '{{ addslashes($program->nama_program) }}',
                        '{{ addslashes($program->deskripsi) }}',
                        '{{ $program->kategori }}',
                        '{{ $program->status }}'
                    )"
                    class="bg-[#BFDBFE] text-[#1D4ED8] px-6 py-2 rounded text-sm font-medium hover:bg-blue-300 transition">
                        Edit
                    </button>

                    <button onclick="openHapusProgramModal({{ $program->id }}, '{{ addslashes($program->nama_program) }}')"
                        class="bg-[#FECACA] text-[#B91C1C] px-6 py-2 rounded text-sm font-medium hover:bg-red-300 transition">
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

function openEditProgramModal(id, nama, deskripsi, kategori, status) {
    document.getElementById('modalEditProgram').classList.remove('hidden');
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_deskripsi').value = deskripsi;
    document.getElementById('edit_kategori').value = kategori;
    let checkbox = document.getElementById('edit_status');
    checkbox.checked = (status === 'aktif');
    document.getElementById('formEditProgram').action = '/admin/program-pendidikan/' + id;
}

function closeEditProgramModal() {
    document.getElementById('modalEditProgram').classList.add('hidden');
}

function openHapusProgramModal(id, nama) {
    document.getElementById('modalHapusProgram').classList.remove('hidden');
    document.getElementById('formHapusProgram').action = '/admin/program-pendidikan/' + id;
    document.getElementById('hapus_nama_program').innerText = nama;
}

function closeHapusProgramModal() {
    document.getElementById('modalHapusProgram').classList.add('hidden');
}

    document.addEventListener("DOMContentLoaded", function() {
        const toasts = document.querySelectorAll('.toast-alert');
        
        toasts.forEach(function(toast, index) {
            setTimeout(function() {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 100 + (index * 150)); 
            setTimeout(function() {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(function() {
                    toast.remove();
                }, 500);
            }, 4000); 
        });
    });

</script>

@endsection