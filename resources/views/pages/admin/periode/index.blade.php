@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">
    <div id="toast-container" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 items-end pointer-events-none">

    @if(session('success'))
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-green-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Berhasil</h4>
                <p class="text-xs text-gray-500 mt-0.5">
                    {{ session('success') }}
                </p>
            </div>

            <button onclick="this.parentElement.remove()"
                class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-red-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Gagal</h4>
                <p class="text-xs text-gray-500 mt-0.5">
                    {{ session('error') }}
                </p>
            </div>

            <button onclick="this.parentElement.remove()"
                class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-red-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>

            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Peringatan</h4>

                <ul class="list-disc list-inside mt-1 text-xs text-gray-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

            <button onclick="this.parentElement.remove()"
                class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif
</div>

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
                    <td class="p-4 text-center border-r border-[#D9D9D9] align-middle">
    @php
        $hariIni = \Carbon\Carbon::now()->startOfDay();
        $tglMulai = \Carbon\Carbon::parse($item->tanggal_mulai)->startOfDay();
        $tglSelesai = \Carbon\Carbon::parse($item->tanggal_selesai)->endOfDay();

        if ($item->status == 0 || $hariIni->greaterThan($tglSelesai)) {
            $teksStatus = 'Ditutup';
            $warnaBadge = 'bg-[#FECACA] text-[#B91C1C] border-red-200';
        } elseif ($hariIni->lessThan($tglMulai)) {
            $teksStatus = 'Belum Dibuka';
            $warnaBadge = 'bg-yellow-100 text-yellow-700 border-yellow-200';
        } else {
            $teksStatus = 'Dibuka';
            $warnaBadge = 'bg-[#DEFFE9] text-[#1E5631] border-[#1E5631]/20';
        }
    @endphp

    <span class="inline-block min-w-[100px] px-3 py-1 border rounded-full text-xs font-bold uppercase tracking-wide {{ $warnaBadge }}">
        {{ $teksStatus }}
    </span>
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
                                
                                {{-- Penambahan Data Jadwal PDF untuk Tombol Edit --}}
                                data-js-tanggal="{{ $item->jadwal_seleksi_tanggal }}"
                                data-js-ruang="{{ $item->jadwal_seleksi_ruang }}"
                                data-js-waktu="{{ $item->jadwal_seleksi_waktu }}"
                                data-jw-tanggal="{{ $item->jadwal_wawancara_tanggal }}"
                                data-jw-ruang="{{ $item->jadwal_wawancara_ruang }}"
                                data-jw-waktu="{{ $item->jadwal_wawancara_waktu }}"

                                class="bg-blue-100 text-blue-600 px-3 py-1.5 rounded font-bold hover:bg-blue-200 text-xs">Edit</button>
                            
                            <button 
                            onclick="openDeleteModal(
                            '{{ route('admin.periode.destroy', $item->id_periode) }}',
                            '{{ $item->nama_periode }}'
                            )"
                            class="bg-red-100 text-red-700 px-3 py-1.5 rounded font-bold hover:bg-red-200 text-xs">
                            Hapus
                            </button>
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
<div id="modalTambah" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm items-center justify-center z-50 p-4">
    <div class="bg-white w-full max-w-4xl rounded-xl overflow-hidden shadow-lg max-h-[90vh] flex flex-col">
        <form action="{{ route('admin.periode.store') }}" method="POST" class="flex flex-col h-full overflow-hidden">
            @csrf
            <div class="bg-[#1E5631] text-white py-3 px-4 font-bold flex justify-between shrink-0">
                <span>Tambah Periode Pendaftaran</span>
            </div>
            
            <div class="p-5 overflow-y-auto space-y-4">
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

                {{-- FORM BARU: JADWAL UNTUK CETAK PDF --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-bold text-[#1E5631] mb-2">Pengaturan Jadwal Cetak Bukti (PDF)</h3>
                    <p class="text-xs text-gray-500 mb-4">Data di bawah ini akan tercetak langsung di dalam tabel Surat Bukti Pendaftaran Santri.</p>

                    <h4 class="text-sm font-bold text-gray-700 mb-2">Jadwal Seleksi Penentuan Kelas Santri</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Hari/Tanggal</label>
                            <input type="text" name="jadwal_seleksi_tanggal" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="Minggu, 19 April 2026">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Ruang</label>
                            <input type="text" name="jadwal_seleksi_ruang" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="Ruang D">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Waktu</label>
                            <input type="text" name="jadwal_seleksi_waktu" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="08.00 - Selesai">
                        </div>
                    </div>

                    <h4 class="text-sm font-bold text-gray-700 mb-2 mt-4">Jadwal Wawancara Orang Tua</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-4">
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Hari/Tanggal</label>
                            <input type="text" name="jadwal_wawancara_tanggal" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="Minggu, 19 April 2026">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Ruang</label>
                            <input type="text" name="jadwal_wawancara_ruang" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="Ruang D">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Waktu</label>
                            <input type="text" name="jadwal_wawancara_waktu" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="08.00 - Selesai">
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex justify-end gap-3 p-4 border-t bg-gray-50 shrink-0">
                <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 border rounded text-sm font-bold">Batal</button>
                <button type="submit" class="bg-[#1E5631] text-white px-4 py-2 rounded text-sm font-bold hover:bg-[#17472a] transition">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT PERIODE --}}
<div id="modalEdit" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm items-center justify-center z-50 p-4">
    <div class="bg-white w-full max-w-4xl rounded-xl overflow-hidden shadow-lg max-h-[90vh] flex flex-col">
        <form id="formEdit" method="POST" class="flex flex-col h-full overflow-hidden">
            @csrf
            @method('PUT')
            <div class="bg-[#1E5631] text-white py-3 px-4 font-bold flex justify-between shrink-0">
                <span>Edit Periode Pendaftaran</span>
            </div>
            
            <div class="p-5 overflow-y-auto space-y-4">
                <div>
                    <label class="text-sm font-bold text-gray-700">Nama Periode / Gelombang <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_periode" id="edit_nama" required class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-bold text-gray-700">Tgl Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai" id="edit_mulai" required class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none">
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Tgl Selesai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_selesai" id="edit_selesai" required class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-bold text-gray-700">Persyaratan Pendaftaran</label>
                        <textarea name="persyaratan" id="edit_persyaratan" rows="5" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none"></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Rincian Biaya</label>
                        <textarea name="biaya" id="edit_biaya" rows="5" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none"></textarea>
                    </div>
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700">Status</label>
                    <select name="status" id="edit_status" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none">
                        <option value="1">Aktif (Buka)</option>
                        <option value="0">Tutup</option>
                    </select>
                </div>

                <div class="mt-4">
                    <label class="text-sm font-bold text-gray-700">Jadwal Tambahan (Seleksi, Pengumuman, dll)</label>
                    <textarea name="jadwal_tambahan" id="edit_jadwal_tambahan" rows="3" placeholder="Contoh:&#10;Seleksi : 10 Juli 2026&#10;Pengumuman : 20 Juli 2026" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#1E5631] outline-none"></textarea>
                </div>

                {{-- FORM EDIT BARU: JADWAL UNTUK CETAK PDF --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-bold text-[#1E5631] mb-2">Pengaturan Jadwal Cetak Bukti (PDF)</h3>
                    <p class="text-xs text-gray-500 mb-4">Data di bawah ini akan tercetak langsung di dalam tabel Surat Bukti Pendaftaran Santri.</p>

                    <h4 class="text-sm font-bold text-gray-700 mb-2">Jadwal Seleksi Penentuan Kelas Santri</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Hari/Tanggal</label>
                            <input type="text" name="jadwal_seleksi_tanggal" id="edit_js_tanggal" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Ruang</label>
                            <input type="text" name="jadwal_seleksi_ruang" id="edit_js_ruang" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Waktu</label>
                            <input type="text" name="jadwal_seleksi_waktu" id="edit_js_waktu" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        </div>
                    </div>

                    <h4 class="text-sm font-bold text-gray-700 mb-2 mt-4">Jadwal Wawancara Orang Tua</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-4">
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Hari/Tanggal</label>
                            <input type="text" name="jadwal_wawancara_tanggal" id="edit_jw_tanggal" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Ruang</label>
                            <input type="text" name="jadwal_wawancara_ruang" id="edit_jw_ruang" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Waktu</label>
                            <input type="text" name="jadwal_wawancara_waktu" id="edit_jw_waktu" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex justify-end gap-3 p-4 border-t bg-gray-50 shrink-0">
                <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 border rounded text-sm font-bold">Batal</button>
                <button type="submit" class="bg-[#1E5631] text-white px-4 py-2 rounded text-sm font-bold hover:bg-[#1E5631] transition">Update Data</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div id="modalHapus"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden p-4">

    <div class="bg-white rounded-lg border border-[#D9D9D9] w-full max-w-sm shadow-lg">

        {{-- HEADER --}}
        <div class="bg-[#FCA5A5] py-2 rounded-t-lg">
            <h2 class="text-center text-[#B91C1C] font-bold text-base">
                Konfirmasi Hapus
            </h2>
        </div>

        {{-- CONTENT --}}
        <div class="p-5 text-center">

            <p class="text-sm text-gray-600 mb-2">
                Apakah Anda yakin ingin menghapus periode ini secara permanen?
            </p>

            <p class="text-sm font-bold text-[#1E5631] mb-5">
                <span id="hapus_nama_periode"></span>
            </p>

            <form id="formHapusPeriode" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex justify-center gap-2 py-4">

                    {{-- BATAL --}}
                    <button type="button"
                        onclick="closeModal('modalHapus')"
                        class="px-4 py-2 text-sm border border-[#D9D9D9] rounded text-gray-600 hover:bg-gray-50">
                        Batal
                    </button>

                    {{-- HAPUS --}}
                    <button type="submit"
                        class="px-4 py-2 text-sm bg-[#B91C1C] text-white rounded hover:bg-red-700 shadow-sm transition-colors">
                        Ya, Hapus
                    </button>

                </div>
            </form>

        </div>

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

        document.getElementById('edit_persyaratan').value = element.getAttribute('data-persyaratan');
        document.getElementById('edit_biaya').value = element.getAttribute('data-biaya');
        document.getElementById('edit_jadwal_tambahan').value = element.getAttribute('data-jadwal-tambahan');
        document.getElementById('edit_status').value = element.getAttribute('data-status');

        // Menarik data jadwal PDF ke dalam input edit
        document.getElementById('edit_js_tanggal').value = element.getAttribute('data-js-tanggal');
        document.getElementById('edit_js_ruang').value = element.getAttribute('data-js-ruang');
        document.getElementById('edit_js_waktu').value = element.getAttribute('data-js-waktu');
        document.getElementById('edit_jw_tanggal').value = element.getAttribute('data-jw-tanggal');
        document.getElementById('edit_jw_ruang').value = element.getAttribute('data-jw-ruang');
        document.getElementById('edit_jw_waktu').value = element.getAttribute('data-jw-waktu');

        openModal('modalEdit');
    }

    function openDeleteModal(action, nama) {
        document.getElementById('formHapusPeriode').action = action;
        document.getElementById('hapus_nama_periode').innerText = nama;

        openModal('modalHapus');
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