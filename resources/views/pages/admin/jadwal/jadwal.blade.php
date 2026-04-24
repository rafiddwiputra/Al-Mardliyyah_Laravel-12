@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-lg p-6 shadow-sm">

    {{-- TOAST NOTIFICATION CONTAINER --}}
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

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-[#1E5631]">
            Jadwal Pendaftaran
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola jadwal pembukaan dan penutupan pendaftaran santri
        </p>
    </div>

    @php
        $jadwalUtama = $data->first();
        
        // Logika Status Realtime untuk Tampilan Admin
        $statusRealtime = "DITUTUP";
        $warnaRealtime = "bg-red-50 text-red-600 border-red-200";
        $teksBantuan = "Calon santri tidak dapat mengakses formulir pendaftaran.";

        if($jadwalUtama && $jadwalUtama->status == 1) {
            if($jadwalUtama->tanggal_mulai && $jadwalUtama->tanggal_selesai) {
                $now = \Carbon\Carbon::now();
                $start = \Carbon\Carbon::parse($jadwalUtama->tanggal_mulai)->startOfDay();
                $end = \Carbon\Carbon::parse($jadwalUtama->tanggal_selesai)->endOfDay();
                
                if($now->between($start, $end)) {
                    $statusRealtime = "SEDANG BERLANGSUNG";
                    $warnaRealtime = "bg-green-50 text-green-600 border-green-200";
                    $teksBantuan = "Pendaftaran sedang terbuka di website saat ini.";
                } elseif($now->lt($start)) {
                    $statusRealtime = "MENUNGGU WAKTU BUKA";
                    $warnaRealtime = "bg-yellow-50 text-yellow-600 border-yellow-200";
                    $teksBantuan = "Sistem aktif, akan otomatis buka pada tanggal yang ditentukan.";
                }
            } else {
                $statusRealtime = "TANGGAL BELUM DIATUR";
                $warnaRealtime = "bg-gray-100 text-gray-600 border-gray-200";
            }
        }
    @endphp

    @if($jadwalUtama)
    <div class="bg-white border border-[#D9D9D9] rounded-2xl p-6 mb-8 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-40 h-40 rounded-full translate-x-16 -translate-y-16 opacity-30 transition-colors duration-500 {{ $jadwalUtama->status == 1 ? 'bg-green-100' : 'bg-red-100' }}"></div>

        <div class="flex items-center gap-5 relative z-10">
            <div class="w-14 h-14 shrink-0 rounded-2xl flex items-center justify-center transition-colors duration-500 shadow-inner {{ $jadwalUtama->status == 1 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                @if($jadwalUtama->status == 1)
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                @else
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                @endif
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-3">
                    Sistem Buka / Tutup Pendaftaran
                    <span class="px-2.5 py-1 rounded text-[10px] uppercase font-extrabold border tracking-wider {{ $warnaRealtime }}">
                        {{ $statusRealtime }}
                    </span>
                </h3>
                <p class="text-sm text-gray-500 mt-1">{{ $teksBantuan }}</p>
            </div>
        </div>

        <div class="flex items-center gap-4 bg-gray-50 py-3 px-5 rounded-xl border border-[#D9D9D9] relative z-10 shadow-inner">
            <span class="text-xs font-bold tracking-wide {{ $jadwalUtama->status == 0 ? 'text-red-600' : 'text-gray-400' }}">TUTUP</span>
            <div onclick="openEditJadwalModalFromCard()" class="relative inline-flex items-center cursor-pointer" title="Klik untuk mengubah jadwal/status">
                <input type="checkbox" class="sr-only peer" {{ $jadwalUtama->status == 1 ? 'checked' : '' }} disabled>
                <div class="w-14 h-7 bg-red-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-500 shadow-sm cursor-pointer"></div>
            </div>
            <span class="text-xs font-bold tracking-wide {{ $jadwalUtama->status == 1 ? 'text-green-600' : 'text-gray-400' }}">BUKA</span>
            <div class="w-px h-6 bg-[#D9D9D9] mx-2"></div>
            <button type="button" onclick="openEditJadwalModalFromCard()" class="text-gray-400 hover:text-[#1E5631] transition-colors focus:outline-none" title="Edit Jadwal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            </button>
        </div>
    </div>

    <div id="cardDataStorage"
        data-id="{{ $jadwalUtama->id }}"
        data-judul="{{ $jadwalUtama->judul }}"
        data-mulai="{{ $jadwalUtama->tanggal_mulai ? \Carbon\Carbon::parse($jadwalUtama->tanggal_mulai)->format('Y-m-d') : '' }}"
        data-selesai="{{ $jadwalUtama->tanggal_selesai ? \Carbon\Carbon::parse($jadwalUtama->tanggal_selesai)->format('Y-m-d') : '' }}"
        data-status="{{ $jadwalUtama->status }}"
        data-deskripsi="{{ $jadwalUtama->deskripsi }}"
        class="hidden"></div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border border-[#D9D9D9] border-collapse">
            <thead>
                <tr class="bg-white border-b border-[#D9D9D9]">
                    <th class="p-4 text-left font-bold text-black border-r border-[#D9D9D9]">Nama Informasi</th>
                    <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">Tgl Pembukaan</th>
                    <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">Tgl Penutupan</th>
                    <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">Status Toggle</th>
                    <th class="p-4 text-center font-bold text-black w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition">
                    <td class="p-4 border-r border-[#D9D9D9] font-medium text-[#1E5631]">
                        {{ $item->judul }} <br>
                        <span class="text-xs text-gray-500 font-normal mt-1 block whitespace-pre-line">{{ $item->deskripsi }}</span>
                    </td>
                    <td class="p-4 text-sm text-center text-[#444444] border-r border-[#D9D9D9]">
                        {{ $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') : '-' }}
                    </td>
                    <td class="p-4 text-sm text-center text-[#444444] border-r border-[#D9D9D9]">
                        {{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') : '-' }}
                    </td>
                    <td class="p-4 text-center border-r border-[#D9D9D9]">
                        @if($item->status == 1)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">ON</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold border border-red-200">OFF</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-center align-middle whitespace-nowrap">
                        <div class="flex gap-3 justify-center items-center">
                            <button type="button" 
                                data-id="{{ $item->id }}"
                                data-judul="{{ $item->judul }}"
                                data-mulai="{{ $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d') : '' }}"
                                data-selesai="{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('Y-m-d') : '' }}"
                                data-status="{{ $item->status }}"
                                data-deskripsi="{{ $item->deskripsi }}"
                                onclick="openEditDeskripsiModal(this)"
                                class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded font-bold hover:bg-blue-200 transition-colors focus:outline-none">
                                Edit Deskripsi
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL 1: EDIT JADWAL & STATUS (Dari Kartu Atas) --}}
<div id="modalJadwal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0">
    <div class="bg-white w-full max-w-lg rounded-xl overflow-hidden shadow-lg transform scale-95 transition-transform duration-300">
        <form id="formJadwal" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="deskripsi" id="jadwal_deskripsi">

            <div class="bg-[#1E5631] text-white text-center py-3 font-semibold flex justify-between items-center px-4">
                <span>Atur Jadwal & Status</span>
                <button type="button" onclick="closeModal('modalJadwal')" class="text-white hover:text-gray-200 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-5 space-y-4">
                <div>
                    <label class="text-sm font-bold text-gray-700">Nama Informasi</label>
                    <input type="text" name="judul" id="jadwal_judul" readonly class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm bg-gray-100 text-gray-500 cursor-not-allowed outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-bold text-gray-700">Tanggal Pembukaan</label>
                        <input type="date" name="tanggal_mulai" id="jadwal_mulai" required class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]">
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Tanggal Penutupan</label>
                        <input type="date" name="tanggal_selesai" id="jadwal_selesai" required class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700 mb-2 block">Status Gelombang Pendaftaran</label>
                    <div class="flex items-center gap-4 border border-gray-300 p-3 rounded bg-gray-50">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="1" id="jadwal_status_buka" class="w-4 h-4 text-[#1E5631] focus:ring-[#1E5631]">
                            <span class="text-sm font-semibold text-green-700">Buka</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="0" id="jadwal_status_tutup" class="w-4 h-4 text-red-600 focus:ring-red-600">
                            <span class="text-sm font-semibold text-red-600">Tutup</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('modalJadwal')" class="border border-gray-300 text-gray-700 px-4 py-2 rounded text-sm font-bold hover:bg-gray-50 transition">Batal</button>
                    <button type="submit" class="bg-[#1E5631] text-white px-4 py-2 rounded text-sm font-bold hover:bg-[#17472a] transition shadow-sm">Simpan Jadwal</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODAL 2: EDIT DESKRIPSI (Dari Tabel) --}}
<div id="modalDeskripsi" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0">
    <div class="bg-white w-full max-w-lg rounded-xl overflow-hidden shadow-lg transform scale-95 transition-transform duration-300">
        <form id="formDeskripsi" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="tanggal_mulai" id="desc_mulai">
            <input type="hidden" name="tanggal_selesai" id="desc_selesai">
            <input type="hidden" name="status" id="desc_status">

            <div class="bg-blue-600 text-white text-center py-3 font-semibold flex justify-between items-center px-4">
                <span>Edit Catatan / Deskripsi</span>
                <button type="button" onclick="closeModal('modalDeskripsi')" class="text-white hover:text-gray-200 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-5 space-y-4">
                <div>
                    <label class="text-sm font-bold text-gray-700">Nama Informasi</label>
                    <input type="text" name="judul" id="desc_judul" readonly class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm bg-gray-100 text-gray-500 cursor-not-allowed outline-none">
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700">Catatan Tambahan / Deskripsi</label>
                    <textarea name="deskripsi" id="desc_deskripsi" rows="4" placeholder="Contoh: Tes Seleksi: 10 Juli 2026" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('modalDeskripsi')" class="border border-gray-300 text-gray-700 px-4 py-2 rounded text-sm font-bold hover:bg-gray-50 transition">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm font-bold hover:bg-blue-700 transition shadow-sm">Simpan Catatan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
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
                setTimeout(() => toast.remove(), 500);
            }, 4000); 
        });
    });

    function openModal(id){
        const modal = document.getElementById(id);
        const content = modal.querySelector('.transform');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        void modal.offsetWidth; 
        modal.classList.remove('opacity-0');
        content.classList.remove('scale-95');
        document.body.style.overflow = 'hidden'; 
    }

    function closeModal(id){
        const modal = document.getElementById(id);
        const content = modal.querySelector('.transform');
        modal.classList.add('opacity-0');
        content.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto'; 
        }, 300);
    }

    function openEditJadwalModalFromCard() {
        const element = document.getElementById('cardDataStorage');
        if(!element) return;

        let id = element.getAttribute('data-id');
        document.getElementById('formJadwal').action = '/admin/jadwal-pendaftaran/' + id;
        
        document.getElementById('jadwal_judul').value = element.getAttribute('data-judul');
        document.getElementById('jadwal_mulai').value = element.getAttribute('data-mulai');
        document.getElementById('jadwal_selesai').value = element.getAttribute('data-selesai');
        document.getElementById('jadwal_deskripsi').value = element.getAttribute('data-deskripsi');

        if(element.getAttribute('data-status') == 1) {
            document.getElementById('jadwal_status_buka').checked = true;
        } else {
            document.getElementById('jadwal_status_tutup').checked = true;
        }
        
        openModal('modalJadwal');
    }

    function openEditDeskripsiModal(element){
        let id = element.getAttribute('data-id');
        document.getElementById('formDeskripsi').action = '/admin/jadwal-pendaftaran/' + id;
        
        document.getElementById('desc_judul').value = element.getAttribute('data-judul');
        document.getElementById('desc_deskripsi').value = element.getAttribute('data-deskripsi');
        
        document.getElementById('desc_mulai').value = element.getAttribute('data-mulai');
        document.getElementById('desc_selesai').value = element.getAttribute('data-selesai');
        document.getElementById('desc_status').value = element.getAttribute('data-status');
        
        openModal('modalDeskripsi');
    }
</script>

@endsection