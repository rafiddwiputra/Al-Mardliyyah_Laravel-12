@extends('layouts.pimpinan')

@section('content')

<div class="p-6">

    <!-- TITLE -->
    <h2 class="text-2xl font-bold text-[#1E5631] mb-1">
        Manajemen Akun Admin
    </h2>

    <p class="text-sm text-gray-500 mb-6">
        Kelola penambahan akun baru dan status aktif administrator pondok.
    </p>

    <!-- FORM TAMBAH ADMIN CARD -->
    <div class="bg-white border rounded-lg p-5 mb-6">

        <p class="text-sm font-semibold text-[#1E5631] mb-4">
            Tambah Admin Baru
        </p>

        <!-- Tampilkan Pesan Sukses -->
        @if(session('success'))
            <div class="bg-[#DEFFE9] border border-[#1E5631]/20 text-[#1E5631] px-4 py-3 rounded relative mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tampilkan Pesan Error Validasi -->
        @if($errors->any())
            <div class="bg-[#FECACA] border border-red-300 text-[#B91C1C] px-4 py-3 rounded relative mb-4 text-sm">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Update Action dan Method Form -->
        <form action="{{ route('pimpinan.admin.store') }}" method="POST">
            @csrf 
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                
                <!-- Input Nama -->
                <div>
                    <label class="text-xs text-gray-500 mb-1 block">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama admin" required
                        class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <!-- Input No HP -->
                <div>
                    <label class="text-xs text-gray-500 mb-1 block">No. Handphone (WhatsApp)</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" required
                        class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <!-- Input Email -->
                <div>
                    <label class="text-xs text-gray-500 mb-1 block">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@al-mardliyyah.com" required
                        class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <!-- Input Password -->
                <div>
                    <label class="text-xs text-gray-500 mb-1 block">Password</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" required
                        class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]">
                </div>

            </div>

            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="bg-[#1E5631] text-white px-6 py-2 rounded-md text-sm hover:bg-[#174427] transition duration-200">
                    Simpan Akun Admin
                </button>
            </div>
        </form>

    </div>

    <!-- TABEL DAFTAR ADMIN -->
    <div class="bg-white border rounded-lg p-5">

        <div class="flex justify-between items-center mb-4">
            <p class="text-sm font-semibold text-[#1E5631]">
                Daftar Administrator
            </p>
            
            <!-- Opsional: Kolom Pencarian -->
            <div class="w-48">
                <input type="text" placeholder="Cari admin..."
                    class="w-full border rounded-md px-3 py-1.5 text-xs focus:outline-none focus:border-[#1E5631]">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="border-b text-gray-600">
                    <tr>
                        <th class="pb-2 text-left">Nama Admin</th>
                        <th class="pb-2 text-left">Email / No. HP</th>
                        <th class="pb-2 text-center">Status</th>
                        <th class="pb-2 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700">

                    @forelse($admins as $admin)
                    <tr class="border-b hover:bg-gray-50 transition duration-150 {{ $admin->status === 'nonaktif' ? 'opacity-75 bg-gray-50' : '' }}">
                        <td class="py-3">
                            <p class="font-medium">{{ $admin->nama }}</p>
                            <p class="text-xs text-gray-400">Ditambahkan: {{ $admin->created_at->format('d/m/Y') }}</p>
                        </td>
                        <td class="py-3">
                            <p>{{ $admin->email }}</p>
                            <p class="text-xs text-gray-500">{{ $admin->no_hp }}</p>
                        </td>
                        <td class="py-3 text-center">
                            @if($admin->status === 'aktif')
                                <span class="inline-block min-w-[80px] text-center bg-[#DEFFE9] text-[#1E5631] px-2 py-1 rounded text-xs border border-[#1E5631]/20">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-block min-w-[80px] text-center bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs border border-gray-200">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="py-3 text-center">
                            <form id="form-toggle-{{ $admin->id }}" action="{{ route('pimpinan.admin.toggle', $admin->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                @if($admin->status === 'aktif')
                                    <button type="button" onclick="bukaModalToggle('{{ $admin->id }}', 'nonaktif', '{{ $admin->nama }}')" 
                                        class="bg-[#FECACA] text-[#B91C1C] px-3 py-1 rounded text-xs hover:bg-red-200 transition duration-200">
                                        Nonaktifkan
                                    </button>
                                @else
                                    <button type="button" onclick="bukaModalToggle('{{ $admin->id }}', 'aktif', '{{ $admin->nama }}')" 
                                        class="bg-[#DEFFE9] text-[#1E5631] px-3 py-1 rounded text-xs hover:bg-[#cbf5da] transition duration-200 border border-[#1E5631]/20">
                                        Aktifkan
                                    </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">
                            Belum ada data admin yang terdaftar.
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>

<!-- MODAL KONFIRMASI TOGGLE STATUS -->
<div id="modalToggle" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 opacity-0">
    <div id="modalToggleContent" class="bg-white rounded-lg shadow-xl w-11/12 md:w-1/3 p-6 transform scale-95 transition-transform duration-300">
        <div class="flex flex-col items-center text-center">
            
            <!-- Icon (Background & SVG) akan diatur via JS -->
            <div id="modalIconBg" class="w-14 h-14 rounded-full flex items-center justify-center mb-4">
                <svg id="modalIcon" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
            </div>
            
            <h3 id="modalTitle" class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Aksi</h3>
            <p id="modalPesan" class="text-sm text-gray-500 mb-6 leading-relaxed">
                Pesan akan diisi melalui Javascript
            </p>
            
            <div class="flex gap-3 w-full">
                <button type="button" onclick="tutupModalToggle()" class="flex-1 bg-gray-100 text-gray-700 font-medium px-4 py-2 rounded-md text-sm hover:bg-gray-200 transition">
                    Batal
                </button>
                <!-- Tombol Konfirmasi -->
                <button type="button" id="btnKonfirmasiToggle" class="flex-1 font-medium text-white px-4 py-2 rounded-md text-sm transition shadow-sm">
                    Ya, Lanjutkan
                </button>
            </div>

        </div>
    </div>
</div>

<!-- SCRIPT UNTUK MODAL TOGGLE -->
<script>
    let formIdTarget = null; // Menyimpan ID form yang akan dieksekusi

    function bukaModalToggle(id, aksi, namaAdmin) {
        formIdTarget = id;
        
        const modal = document.getElementById('modalToggle');
        const modalContent = document.getElementById('modalToggleContent');
        const judul = document.getElementById('modalTitle');
        const pesan = document.getElementById('modalPesan');
        const btnKonfirmasi = document.getElementById('btnKonfirmasiToggle');
        const iconBg = document.getElementById('modalIconBg');
        const icon = document.getElementById('modalIcon');
        
        // Atur gaya dan teks berdasarkan tombol apa yang diklik
        if (aksi === 'nonaktif') {
            judul.innerText = 'Nonaktifkan Admin?';
            pesan.innerHTML = `Apakah Anda yakin ingin mencabut akses <b>${namaAdmin}</b>? Sesi login admin ini akan langsung dihentikan.`;
            btnKonfirmasi.innerText = 'Ya, Nonaktifkan';
            btnKonfirmasi.className = 'flex-1 font-medium text-white px-4 py-2 rounded-md text-sm transition shadow-sm bg-[#B91C1C] hover:bg-red-800';
            iconBg.className = 'w-14 h-14 rounded-full flex items-center justify-center mb-4 bg-red-100 text-[#B91C1C]';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>';
        } else {
            judul.innerText = 'Aktifkan Kembali?';
            pesan.innerHTML = `Apakah Anda yakin ingin memulihkan akses untuk <b>${namaAdmin}</b>? Admin akan bisa login kembali.`;
            btnKonfirmasi.innerText = 'Ya, Aktifkan';
            btnKonfirmasi.className = 'flex-1 font-medium text-white px-4 py-2 rounded-md text-sm transition shadow-sm bg-[#1E5631] hover:bg-[#174427]';
            iconBg.className = 'w-14 h-14 rounded-full flex items-center justify-center mb-4 bg-[#DEFFE9] text-[#1E5631]';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>';
        }

        // Tampilkan Modal dengan Animasi Fade-in & Scale
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function tutupModalToggle() {
        const modal = document.getElementById('modalToggle');
        const modalContent = document.getElementById('modalToggleContent');
        
        // Animasi Fade-out & Scale-down
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        // Sembunyikan sepenuhnya setelah animasi selesai (300ms)
        setTimeout(() => {
            modal.classList.add('hidden');
            formIdTarget = null;
        }, 300); 
    }

    // Eksekusi Form saat tombol konfirmasi "Ya" diklik
    document.getElementById('btnKonfirmasiToggle').addEventListener('click', function() {
        if (formIdTarget) {
            // Mencegah double klik
            this.disabled = true;
            this.innerText = 'Memproses...';
            document.getElementById('form-toggle-' + formIdTarget).submit();
        }
    });
</script>

@endsection