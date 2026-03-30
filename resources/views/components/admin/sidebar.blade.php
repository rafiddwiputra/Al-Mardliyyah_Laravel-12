<aside class="w-64 bg-[#1e4d2b] min-h-screen flex flex-col text-white">
    {{-- LOGO / TITLE ADMIN PANEL --}}
    <div class="p-6 border-b border-white/10">
        <h2 class="text-xl font-bold text-center">Admin Panel</h2>
    </div>

    {{-- NAVIGASI MENU --}}
    <nav class="flex-1 px-4 py-6 overflow-y-auto custom-scrollbar">
        
        {{-- DASHBOARD --}}
        <div class="mb-6">
            <a href="#" class="flex items-center gap-3 bg-[#c9a76d] text-white px-4 py-2.5 rounded-lg font-bold shadow-md transition hover:bg-[#b5955e]">
                {{-- Menggunakan Ikon Gambar Baru --}}
                <img src="{{ asset('images/ikon-sidebar-admin.png') }}" alt="Icon" class="w-5 h-5 object-contain brightness-0 invert">
                Dashboard
            </a>
        </div>

        {{-- MANAJEMEN KONTEN --}}
        <div class="mb-6">
            <div class="flex items-center gap-3 text-white/90 font-bold px-2 mb-3 text-sm">
                {{-- Menggunakan Ikon Gambar Baru --}}
                <img src="{{ asset('images/ikon-sidebar-admin.png') }}" alt="Icon" class="w-5 h-5 object-contain">
                Manajemen Konten
            </div>
            
            {{-- List Menu dengan Garis Vertikal --}}
            <div class="ml-4 border-l-2 border-white/30 space-y-1">
                <a href="#" class="block px-4 py-1.5 text-sm hover:text-[#c9a76d] transition">Berita</a>
                <a href="#" class="block px-4 py-1.5 text-sm hover:text-[#c9a76d] transition">Galeri</a>
                <a href="#" class="block px-4 py-1.5 text-sm hover:text-[#c9a76d] transition">Profil Pondok</a>
                <a href="#" class="block px-4 py-1.5 text-sm hover:text-[#c9a76d] transition">Program Pendidikan</a>
                <a href="#" class="block px-4 py-1.5 text-sm hover:text-[#c9a76d] transition">Biaya Pendidikan</a>
                <a href="#" class="block px-4 py-1.5 text-sm hover:text-[#c9a76d] transition">Persyaratan Pendaftaran</a>
                <a href="#" class="block px-4 py-1.5 text-sm hover:text-[#c9a76d] transition">Jadwal Pendaftaran</a>
            </div>
        </div>

        {{-- PENDAFTARAN SANTRI --}}
        <div class="mb-6">
            <div class="flex items-center gap-3 text-white/90 font-bold px-2 mb-3 text-sm">
                {{-- Menggunakan Ikon Gambar Baru --}}
                <img src="{{ asset('images/ikon-sidebar-admin.png') }}" alt="Icon" class="w-5 h-5 object-contain">
                Pendaftaran Santri
            </div>
            <div class="ml-4 border-l-2 border-white/30 space-y-1">
                <a href="#" class="block px-4 py-1.5 text-sm hover:text-[#c9a76d] transition">Data Pendaftar</a>
            </div>
        </div>

        {{-- PENGATURAN WEBSITE --}}
        <div class="mb-6">
            <div class="flex items-center gap-3 text-white/90 font-bold px-2 mb-3 text-sm">
                {{-- Menggunakan Ikon Gambar Baru --}}
                <img src="{{ asset('images/ikon-sidebar-admin.png') }}" alt="Icon" class="w-5 h-5 object-contain">
                Pengaturan Website
            </div>
            <div class="ml-4 border-l-2 border-white/30 space-y-1">
                <a href="#" class="block px-4 py-1.5 text-sm hover:text-[#c9a76d] transition">Banner Beranda</a>
                <a href="#" class="block px-4 py-1.5 text-sm hover:text-[#c9a76d] transition">Kontak</a>
            </div>
        </div>

    </nav>
</aside>