{{-- Navbar tetap di atas dengan sticky top-0 --}}
<nav class="bg-white py-4 px-8 flex items-center justify-between border-b border-gray-100 sticky top-0 z-50 shadow-sm">
    <div class="flex items-center gap-3">
        {{-- Logo Gambar --}}
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-12 h-12 object-contain">
        <div>
            <h1 class="text-[#1e4d2b] font-bold leading-none text-lg">Pondok Pesantren</h1>
            <p class="text-[#1e4d2b] text-xs">Al-Mardliyyah</p>
        </div>
    </div>

    <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600">
        {{-- Beranda --}}
        <li>
            <a href="/" class="relative pb-1 group {{ Request::is('/') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                Beranda
                <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('/') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </li>

        {{-- Profil (CEK APAKAH AKTIF) --}}
        <li>
            <a href="{{ route('profile') }}" class="relative pb-1 group {{ Request::is('profil*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                Profil
                <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('profil*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </li>

        {{-- Program Pendidikan --}}
        <li>
            <a href="#" class="relative pb-1 hover:text-[#1e4d2b] transition-colors duration-300 group">
                Program Pendidikan
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 group-hover:w-full"></span>
            </a>
        </li>

        {{-- Berita --}}
        <li>
            <a href="#" class="relative pb-1 hover:text-[#1e4d2b] transition-colors duration-300 group">
                Berita
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 group-hover:w-full"></span>
            </a>
        </li>

        {{-- Galeri --}}
<li>
    <a href="{{ route('galeri') }}" class="relative pb-1 group {{ Request::is('galeri*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
        Galeri
        <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('galeri*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
    </a>
</li>

        {{-- Pendaftaran (CEK APAKAH AKTIF) --}}
        <li>
            <a href="{{ route('register') }}" class="relative pb-1 group {{ Request::is('register*') || Request::is('login*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                Pendaftaran
                <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('register*') || Request::is('login*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </li>

        {{-- Kontak (SEKARANG SUDAH DINAMIS) --}}
        <li>
            <a href="{{ route('kontak') }}" class="relative pb-1 group {{ Request::is('kontak*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                Kontak
                <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('kontak*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </li>
    </ul>
</nav>