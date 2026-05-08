@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">
    {{-- TOAST NOTIFICATION --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-[#1E5631]">Periode Pendaftaran</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola gelombang pendaftaran, jadwal, syarat, dan biaya.</p>
        </div>
        <button onclick="openModal('modalTambah')" class="bg-[#1E5631] text-white px-4 py-2 rounded-lg font-bold hover:bg-[#17472a] transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Periode
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-[#D9D9D9] border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-[#D9D9D9]">
                    <th class="p-4 text-left font-bold text-black border-r">Nama Periode / Gelombang</th>
                    <th class="p-4 text-center font-bold text-black border-r">Jadwal Pelaksanaan</th>
                    <th class="p-4 text-center font-bold text-black border-r">Status</th>
                    <th class="p-4 text-center font-bold text-black w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition">
                    <td class="p-4 border-r border-[#D9D9D9]">
                        <span class="font-bold text-[#1E5631] text-lg">{{ $item->nama_periode }}</span>
                        <div class="mt-2 text-xs text-gray-500">
                            <p class="line-clamp-1" title="{{ $item->persyaratan }}"><strong>Syarat:</strong> {{ $item->persyaratan ?? '-' }}</p>
                            <p class="line-clamp-1 mt-1" title="{{ $item->biaya }}"><strong>Biaya:</strong> {{ $item->biaya ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="p-4 text-sm text-center border-r border-[#D9D9D9]">
                        <span class="block font-semibold">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d M Y') }}</span>
                        <span class="block text-gray-400 text-xs my-1">sampai</span>
                        <span class="block font-semibold">{{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d M Y') }}</span>
                    </td>
                    <td class="p-4 text-center border-r border-[#D9D9D9]">
                        @if($item->status == 1)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">AKTIF</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold border border-red-200">TUTUP</span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex gap-2 justify-center">
                            <button onclick="openEditModal(this)" 
                                data-id="{{ $item->id_periode }}"
                                data-nama="{{ $item->nama_periode }}"
                                data-mulai="{{ $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d') : '' }}"
                                data-selesai="{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('Y-m-d') : '' }}"
                                data-status="{{ $item->status }}"
                                data-persyaratan="{{ $item->persyaratan }}"
                                data-biaya="{{ $item->biaya }}"
                                data-jadwal-tambahan="{{ $item->jadwal_tambahan }}"
                                class="bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded font-bold hover:bg-yellow-200 text-xs">Edit</button>
                            
                            <form action="{{ route('admin.periode.destroy', $item->id_periode) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus periode ini? Data pendaftar yang terkait mungkin akan terpengaruh.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-100 text-red-700 px-3 py-1.5 rounded font-bold hover:bg-red-200 text-xs">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-6 text-gray-500 font-medium">Belum ada data periode pendaftaran. Silakan tambah baru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH PERIODE --}}
<div id="modalTambah" class="hidden fixed inset-0 bg-black/50 items-center justify-center z-50">
    <div class="bg-white w-full max-w-4xl rounded-xl overflow-hidden shadow-lg">
        <form action="{{ route('admin.periode.store') }}" method="POST">
            @csrf
            <div class="bg-[#1E5631] text-white py-3 px-4 font-bold flex justify-between">
                <span>Tambah Periode Pendaftaran</span>
                <button type="button" onclick="closeModal('modalTambah')" class="hover:text-gray-300">✕</button>
            </div>
            <div class="p-5 space-y-4">
                <div>
                    <label class="text-sm font-bold text-gray-700">Nama Periode / Gelombang <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_periode" placeholder="Contoh: Gelombang 1 - Tahun Ajaran 2026/2027" required class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-bold text-gray-700">Tgl Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai" required class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none">
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Tgl Selesai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_selesai" required class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none">
                    </div>
                </div>
                
                {{-- KOTAK PERSYARATAN & BIAYA DIBUAT SEJAJAR --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-bold text-gray-700">Persyaratan Pendaftaran</label>
                        <textarea name="persyaratan" rows="5" placeholder="Contoh:&#10;1. Fotocopy KK 2 Lembar&#10;2. Pas Foto 3x4" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none"></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Rincian Biaya</label>
                        <textarea name="biaya" rows="5" placeholder="Contoh:&#10;- Formulir: Rp 200.000&#10;- Seragam: Rp 500.000" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none"></textarea>
                    </div>
                </div>
                <span class="text-xs text-gray-500 block">Teks yang Anda masukkan di atas akan langsung tampil pada masing-masing Card di Halaman Pendaftaran.</span>

                <div class="mt-4">
                    <label class="text-sm font-bold text-gray-700">Jadwal Tambahan (Seleksi, Pengumuman, dll)</label>
                    <textarea name="jadwal_tambahan" rows="3" placeholder="Contoh:&#10;Seleksi : 10 Juli 2026&#10;Pengumuman : 20 Juli 2026" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none"></textarea>
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700">Status</label>
                    <select name="status" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none">
                        <option value="1">Aktif (Buka)</option>
                        <option value="0">Tutup</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 border rounded text-sm font-bold">Batal</button>
                    <button type="submit" class="bg-[#1E5631] text-white px-4 py-2 rounded text-sm font-bold hover:bg-[#17472a] transition">Simpan Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT PERIODE --}}
<div id="modalEdit" class="hidden fixed inset-0 bg-black/50 items-center justify-center z-50">
    <div class="bg-white w-full max-w-4xl rounded-xl overflow-hidden shadow-lg">
        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')
            <div class="bg-yellow-500 text-white py-3 px-4 font-bold flex justify-between">
                <span>Edit Periode Pendaftaran</span>
                <button type="button" onclick="closeModal('modalEdit')" class="hover:text-gray-200">✕</button>
            </div>
            <div class="p-5 space-y-4">
                <div>
                    <label class="text-sm font-bold text-gray-700">Nama Periode / Gelombang <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_periode" id="edit_nama" required class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-yellow-500 outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-bold text-gray-700">Tgl Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai" id="edit_mulai" required class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-yellow-500 outline-none">
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Tgl Selesai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_selesai" id="edit_selesai" required class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-yellow-500 outline-none">
                    </div>
                </div>
                
                {{-- KOTAK PERSYARATAN & BIAYA UNTUK EDIT --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-bold text-gray-700">Persyaratan Pendaftaran</label>
                        <textarea name="persyaratan" id="edit_persyaratan" rows="5" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-yellow-500 outline-none"></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Rincian Biaya</label>
                        <textarea name="biaya" id="edit_biaya" rows="5" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-yellow-500 outline-none"></textarea>
                    </div>
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700">Status</label>
                    <select name="status" id="edit_status" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-yellow-500 outline-none">
                        <option value="1">Aktif (Buka)</option>
                        <option value="0">Tutup</option>
                    </select>
                </div>

                <div class="mt-4">
    <label class="text-sm font-bold text-gray-700">Jadwal Tambahan (Seleksi, Pengumuman, dll)</label>
    <textarea name="jadwal_tambahan" id="edit_jadwal_tambahan" rows="3" placeholder="Contoh:&#10;Seleksi : 10 Juli 2026&#10;Pengumuman : 20 Juli 2026" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none"></textarea>
</div>

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 border rounded text-sm font-bold">Batal</button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded text-sm font-bold hover:bg-yellow-600 transition">Update Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
    }
    
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
    }

    function openEditModal(element) {
        let id = element.getAttribute('data-id');
        document.getElementById('formEdit').action = '/admin/periode-pendaftaran/' + id;
        
        document.getElementById('edit_nama').value = element.getAttribute('data-nama');
        document.getElementById('edit_mulai').value = element.getAttribute('data-mulai');
        document.getElementById('edit_selesai').value = element.getAttribute('data-selesai');
        
        // Memasukkan data ke dalam textarea yang baru
        document.getElementById('edit_persyaratan').value = element.getAttribute('data-persyaratan');
        document.getElementById('edit_biaya').value = element.getAttribute('data-biaya');
        document.getElementById('edit_jadwal_tambahan').value = element.getAttribute('data-jadwal-tambahan');
        document.getElementById('edit_status').value = element.getAttribute('data-status');
        
        openModal('modalEdit');
    }
</script>

@endsection