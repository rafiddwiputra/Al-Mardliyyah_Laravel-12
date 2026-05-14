@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">

    <!-- HEADER -->
    <h1 class="text-2xl font-bold text-[#1E5631]">
        Data Pendaftar
    </h1>
    <p class="text-sm text-gray-500 mt-1 mb-6">
        Kelola data pendaftar dan status pendaftaran
    </p>

    <!-- CARD SEARCH + EXPORT -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">

    <div class="flex items-center justify-between w-full px-4">

        <!-- SUB CARD SEARCH -->
       <!-- SUB CARD SEARCH & FILTER -->
       <!-- SUB CARD SEARCH & FILTER -->
<form method="GET" action="{{ route('admin.pendaftar') }}" class="flex-1 w-full flex flex-col xl:flex-row gap-3 mr-4">
    
            <!-- DROPDOWN FILTER PERIODE -->
            <select name="periode_id" 
                onchange="this.form.submit()" 
                class="px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-[#1E5631] text-gray-600 cursor-pointer min-w-[200px]">
                <option value="">Semua Periode / Tahun</option>
                @foreach($listPeriode as $p)
                    <option value="{{ $p->id_periode }}" {{ request('periode_id') == $p->id_periode ? 'selected' : '' }}>
                        {{ $p->nama_periode }}
                    </option>
                @endforeach
            </select>

            <!-- DROPDOWN BARU: FILTER PROGRAM PENDIDIKAN -->
            <select name="program_id" 
                onchange="this.form.submit()" 
                class="px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-[#1E5631] text-gray-600 min-w-[200px]">
                <option value="">Semua Program / Jenjang</option>
                @foreach($listProgram as $prog)
                    <option value="{{ $prog->id }}" {{ request('program_id') == $prog->id ? 'selected' : '' }}>
                        {{ $prog->nama_program }}
                    </option>
                @endforeach
            </select>

            <!-- FILTER STATUS -->
    <select name="status"
        onchange="this.form.submit()"
        class="px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-[#1E5631] text-gray-600 min-w-[170px]">

        <option value="">Semua Status</option>

        <option value="diproses"
            {{ request('status') == 'diproses' ? 'selected' : '' }}>
            Diproses
        </option>

        <option value="diterima"
            {{ request('status') == 'diterima' ? 'selected' : '' }}>
            Diterima
        </option>

        <option value="ditolak"
            {{ request('status') == 'ditolak' ? 'selected' : '' }}>
            Ditolak
        </option>

    </select>

            <!-- INPUT SEARCH -->
            <div class="relative flex-1">
                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau ID (PSB-2026-G1-001)"
                    class="w-full pl-4 pr-10 py-2 text-sm border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-[#1E5631]">

                <!-- BUTTON ICON SEARCH -->
                <button type="submit"
                    class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#1E5631]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

        </form>

        <!-- EXPORT -->
        <div class="relative group inline-block ml-auto z-50">

            <!-- BUTTON -->
            <button class="text-sm text-gray-600 border px-4 py-2 rounded-lg bg-white hover:bg-gray-50">
                Export
            </button>

            <!-- DROPDOWN WRAPPER -->
            <div class="absolute right-0 pt-2 w-44 z-50">

                <div class="bg-white border rounded-lg shadow
                            opacity-0 invisible pointer-events-none
group-hover:opacity-100 group-hover:visible group-hover:pointer-events-auto
                            transition duration-200 z-10">

                    <a href="{{ route('admin.pendaftar.exportExcel', request()->all()) }}"
                    class="block px-4 py-2 text-sm hover:bg-[#1E5631] hover:text-white transition">
                        Download Excel
                    </a>

                    <a href="{{ route('admin.pendaftar.exportPDF', request()->all()) }}"
                    class="block px-4 py-2 text-sm hover:bg-[#1E5631] hover:text-white">
                        Download PDF
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

    <!-- CARD -->
    <div>

        <h3 class="text-lg font-bold text-[#1E5631] mb-4">
            Pendaftaran Terbaru
        </h3>

        <div class="overflow-x-auto overflow-y-scroll min-h-[300px] max-h-[300px] border border-[#D9D9D9] rounded-lg">
            <table class="w-full border-collapse text-sm">

                <!-- HEADER -->
                <thead class="sticky top-0 bg-white z-10">
                    <tr class="bg-white border-b border-[#D9D9D9]">
                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            ID
                        </th>

                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            Nama Santri
                        </th>

                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            Program Pendidikan
                        </th>

                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            Tanggal Daftar
                        </th>

                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            Status
                        </th>

                        <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <!-- DATA -->
                <tbody class="text-gray-700">

                    @foreach($data as $item)
                    <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition relative">

                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            <!-- PSB{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }} -->
                             {{ $item->smart_id }}
                        </td>

                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            {{ $item->nama_lengkap }}
                        </td>

                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            {{ $item->program->nama_program ?? '-' }}
                        </td>

                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                            {{ $item->created_at ? $item->created_at->format('d/m/Y') : '-' }}
                        </td>

                        <td class="p-4 text-center border-r border-[#D9D9D9]">

    @php
    $status = ucfirst($item->status ?? 'diproses');

    $statusColor = match($status) {
        'Diproses' => 'bg-[#BFDBFE] text-[#1D4ED8]',
        'Diterima' => 'bg-[#DEFFE9] text-[#1E5631]',
        'Ditolak' => 'bg-[#FECACA] text-[#B91C1C]',
        default => 'bg-gray-100 text-gray-600'
    };
    @endphp

    <div x-data="{ open: false }" class="relative inline-block">

        <!-- BUTTON STATUS -->
        <button
            @click="open = !open"
            type="button"
            class="w-24 text-center text-xs px-4 py-2 rounded-xl font-semibold cursor-pointer {{ $statusColor }}">

            {{ $status }}
        </button>

        <!-- DROPDOWN -->
       <div
            x-show="open"
            @click.outside="open = false"
            x-transition
            class="absolute right-0 top-full mt-2 w-28 bg-white border rounded-lg shadow-lg z-[9999]"
            style="display: none;">

            {{-- FORM UNTUK DIPROSES & DITERIMA (Langsung Submit) --}}
            <form action="{{ route('admin.pendaftar.updateStatus', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- VALUE HARUS HURUF BESAR DI AWAL SESUAI VALIDASI CONTROLLER --}}
                <button type="submit" name="status" value="Diproses"
                    class="block w-full text-left px-4 py-2 text-xs hover:bg-[#1E5631] hover:text-white transition">
                    Diproses
                </button>

                <button type="submit" name="status" value="Diterima"
                    class="block w-full text-left px-4 py-2 text-xs hover:bg-[#1E5631] hover:text-white transition">
                    Diterima
                </button>
            </form>

            {{-- TOMBOL UNTUK DITOLAK (Membuka Modal) --}}
            <button type="button" 
                @click="open = false; bukaModalTolak({{ $item->id }}, '{{ addslashes($item->nama_lengkap) }}')"
                class="block w-full text-left px-4 py-2 text-xs text-[#B91C1C] hover:bg-[#B91C1C] hover:text-white border-t transition font-medium">
                Ditolak
            </button>

        </div>

    </div>

</td>

                        <!-- AKSI -->
                        <td class="p-4 text-center border-r border-[#D9D9D9]">
                           <a href="{{ route('admin.pendaftar.detail', $item->id) }}"
                            class="border border-[#1E5631] text-[#1E5631] px-3 py-1 rounded-md text-xs hover:bg-[#1E5631] hover:text-white transition">
                            Detail
                            </a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

            <div class="mt-4">
                {{ $data->links() }}
            </div>

        </div>

    </div>

</div>

{{-- MODAL PENOLAKAN SANTRI --}}
<div id="modalTolak" class="fixed inset-0 z-[9999] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300 opacity-0">
    <div id="modalTolakContent" class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden transform scale-95 transition-transform duration-300">
        
        {{-- HEADER MODAL --}}
        <div class="bg-[#B91C1C] px-5 py-4 flex justify-between items-center">
            <h3 class="text-white font-bold text-lg">Konfirmasi Penolakan</h3>
            <button type="button" onclick="tutupModalTolak()" class="text-white hover:text-red-200 text-2xl leading-none">&times;</button>
        </div>

        {{-- FORM MODAL --}}
        <form id="formTolak" method="POST" action="">
            @csrf
            @method('PUT')
            
            {{-- Input hidden agar Controller tahu ini update status Ditolak --}}
            <input type="hidden" name="status" value="Ditolak">
            
            <div class="p-6">
                <div class="bg-red-50 text-red-800 p-3 rounded-lg text-sm mb-4 border border-red-100">
                    Anda akan menolak pendaftaran calon santri atas nama <strong id="namaSantriTolak"></strong>.
                </div>

                <label class="text-sm font-bold text-gray-700 block mb-1">
                    Alasan Penolakan <span class="text-red-500">*</span>
                </label>
                <textarea name="catatan_admin" rows="4" required 
                    placeholder="Contoh: Mohon maaf, kuota asrama telah penuh..." 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition"></textarea>
                
                <span class="text-xs text-gray-500 mt-2 flex items-start gap-1">
                    <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Catatan ini akan langsung dikirimkan ke alamat email pendaftar.
                </span>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t border-gray-100">
                <button type="button" onclick="tutupModalTolak()" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-100 font-semibold transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 bg-[#B91C1C] text-white rounded-lg text-sm hover:bg-red-800 font-bold transition shadow-sm">
                    Tolak & Kirim Email
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT UNTUK MODAL PENOLAKAN --}}
<script>
    function bukaModalTolak(id, nama) {
        const modal = document.getElementById('modalTolak');
        const content = document.getElementById('modalTolakContent');
        
        document.getElementById('namaSantriTolak').innerText = nama;
        
        let baseUrl = "{{ route('admin.pendaftar.updateStatus', ':id') }}";
        document.getElementById('formTolak').action = baseUrl.replace(':id', id);

        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }, 10);
    }

    function tutupModalTolak() {
        const modal = document.getElementById('modalTolak');
        const content = document.getElementById('modalTolakContent');
        
        modal.classList.add('opacity-0');
        content.classList.remove('scale-100');
        content.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>

<script src="https://unpkg.com/alpinejs" defer></script>

@endsection