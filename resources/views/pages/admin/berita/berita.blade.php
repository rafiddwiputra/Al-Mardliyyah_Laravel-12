@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-lg p-6 shadow-sm">
    
    {{-- ================= DETEKTOR ERROR & SUCCESS ================= --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center justify-between shadow-sm">
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center justify-between shadow-sm">
            <span class="font-bold">{{ session('error') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-400 text-red-700 rounded-lg shadow-sm">
            <strong class="font-bold">Gagal menyimpan data!</strong>
            <ul class="list-disc list-inside mt-2 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- ================= END DETEKTOR ================= --}}

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1E5631]">
            Manajemen Berita
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola semua artikel berita pondok pesantren al-mardliyyah
        </p>
    </div>

    <div class="flex justify-end mb-4">
        <button onclick="openTambahModal()"
            class="bg-[#1E5631] text-white px-5 py-2 rounded-lg text-sm font-bold hover:bg-[#17472a] transition shadow-sm">
            + Tambah Berita
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-[#D9D9D9] border-collapse">
    <thead>
        <tr class="bg-white border-b border-[#D9D9D9]">
            <th class="p-4 text-left font-bold text-black border-r border-[#D9D9D9] w-1/2">
                Judul Berita
            </th>
            
            <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                Tanggal
            </th>
            
            <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                Status
            </th>
            
            <th class="p-4 text-center font-bold text-black">
                Aksi
            </th>
        </tr>
    </thead>
    
    <tbody>
        @forelse($beritas as $berita)
        <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition">
            <td class="p-4 text-sm text-[#444444] border-r border-[#D9D9D9]">
                {{ $berita->judul }}
            </td>

            <td class="p-4 text-sm text-center text-[#444444] border-r border-[#D9D9D9]">
                {{ $berita->created_at->format('d/m/Y') }}
            </td>

            <td class="p-4 text-center border-r border-[#D9D9D9]">
                <span class="text-[#1E5631] font-medium text-sm">
                    {{ $berita->status == 'publish' ? 'Dipublikasikan' : 'Draft' }}
                </span>
            </td>

            <td class="px-5 py-6 text-center align-middle whitespace-nowrap">
                <div class="flex justify-center gap-2">
                    <button type="button" onclick="openEditModal({{ json_encode($berita) }})"
                         class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded font-bold mr-2 hover:bg-blue-200 transition-colors focus:outline-none">
                        Edit
                    </button>
                    <button type="button" onclick="openHapusModal({{ json_encode($berita) }})"
                        class="bg-red-100 text-red-600 px-4 py-1.5 rounded font-bold hover:bg-red-200 transition-colors focus:outline-none">
                        Hapus
                    </button>
                </div>
            </td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>
    </div>
</div>

{{-- Memanggil Modal --}}
@include('pages.admin.berita.berita-tambah')
@include('pages.admin.berita.berita-edit')
@include('pages.admin.berita.berita-hapus')

{{-- Script Logika Modal --}}
<script>
    // MODAL TAMBAH
    function openTambahModal() {
        document.getElementById('modalTambah').classList.remove('hidden');
    }
    function closeTambahModal() {
        document.getElementById('modalTambah').classList.add('hidden');
    }

    // MODAL EDIT (DINAMIS)
    function openEditModal(data) {
        document.getElementById('modalEdit').classList.remove('hidden');
        const form = document.getElementById('formEdit');
        form.action = `/admin/berita/${data.id}`;

        document.getElementById('edit_judul').value = data.judul;
        document.getElementById('edit_deskripsi').value = data.deskripsi;
        document.getElementById('edit_status').value = data.status;

        if (data.created_at) {
            // Mengubah format timestamp database ke format date HTML (YYYY-MM-DD)
            const date = new Date(data.created_at);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            document.getElementById('edit_tanggal').value = `${year}-${month}-${day}`;
        }
    }
    function closeEditModal() {
        document.getElementById('modalEdit').classList.add('hidden');
    }

    // MODAL HAPUS (DINAMIS)
    function openHapusModal(data) {
        document.getElementById('modalHapus').classList.remove('hidden');
        const form = document.getElementById('formHapus');
        form.action = `/admin/berita/${data.id}`;
        document.getElementById('hapus_judul').innerText = data.judul;
    }
    function closeHapusModal() {
        document.getElementById('modalHapus').classList.add('hidden');
    }
</script>

@endsection