{{-- Navbar tetap di atas dengan sticky top-0 --}}
<nav class="bg-white py-4 px-8 flex items-center justify-between border-b border-gray-100 sticky top-0 z-50 shadow-sm">
    <div class="flex items-center gap-3">
        {{-- BAGIAN LOGO GAMBAR --}}
        {{-- Kita ganti div pembungkus huruf 'A' dengan tag <img> --}}
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo Pondok Pesantren Al-Mardliyyah" class="w-12 h-12 object-contain">

        <div>
            <h1 class="text-[#1e4d2b] font-bold leading-none text-lg">Pondok Pesantren</h1>
            <p class="text-[#1e4d2b] text-xs">Al-Mardliyyah</p>
        </div>
    </div>

    <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600">
        {{-- Link dengan efek underline smooth --}}
        <li>
            <a href="#" class="relative pb-1 hover:text-[#1e4d2b] transition-colors duration-300 group">
                Beranda
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 group-hover:w-full"></span>
            </a>
        </li>
        <li>
            <a href="#" class="relative pb-1 hover:text-[#1e4d2b] transition-colors duration-300 group">
                Profil
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 group-hover:w-full"></span>
            </a>
        </li>
        <li>
            <a href="#" class="relative pb-1 hover:text-[#1e4d2b] transition-colors duration-300 group">
                Program Pendidikan
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 group-hover:w-full"></span>
            </a>
        </li>
        <li>
            <a href="#" class="relative pb-1 hover:text-[#1e4d2b] transition-colors duration-300 group">
                Berita
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 group-hover:w-full"></span>
            </a>
        </li>
        <li>
            <a href="#" class="relative pb-1 hover:text-[#1e4d2b] transition-colors duration-300 group">
                Galeri
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 group-hover:w-full"></span>
            </a>
        </li>
        {{-- Khusus Pendaftaran: Garis bawah stay (aktif) --}}
        <li>
            <a href="#" class="relative pb-1 text-[#1e4d2b] font-bold group">
                Pendaftaran
                <span class="absolute left-0 bottom-0 w-full h-0.5 bg-[#1e4d2b]"></span>
            </a>
        </li>
        <li>
            <a href="#" class="relative pb-1 hover:text-[#1e4d2b] transition-colors duration-300 group">
                Kontak
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 group-hover:w-full"></span>
            </a>
        </li>
    </ul>
</nav>