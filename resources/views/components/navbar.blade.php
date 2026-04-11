{{-- Navbar tetap di atas dengan sticky top-0 --}}
<nav class="bg-white py-4 px-8 flex items-center justify-between border-b border-gray-100 sticky top-0 z-50 shadow-sm">
    
    {{-- BAGIAN LOGO & NAMA PONDOK --}}
    <div class="flex items-center">
    <a href="/" class="flex items-center gap-3 group">
        {{-- Logo Dinamis --}}
        <img src="{{ $profil && $profil->logo ? asset('storage/'.$profil->logo) : asset('images/logo.jpg') }}"
             alt="Logo Al-Mardliyyah" 
             class="w-12 h-12 md:w-14 md:h-14 object-contain transition-transform group-hover:scale-105">
        
        {{-- Teks Bertumpuk (Pondok Pesantren + Nama Dinamis) --}}
        <div class="flex flex-col justify-center">
            <span class="text-[#1E5631] font-bold text-base md:text-xl leading-tight">
                Pondok Pesantren
            </span>
            <span class="text-gray-700 font-medium text-sm md:text-lg leading-tight">
                {{ $profil->nama_pondok ?? 'Al-Mardliyyah' }}
            </span>
        </div>
    </a>
</div>

    {{-- MENU NAVIGASI --}}
    <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600">
        {{-- Beranda --}}
        <li>
            <a href="/" class="relative pb-1 group {{ Request::is('/') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                Beranda
                <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('/') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </li>

        {{-- Profil --}}
        <li>
            <a href="{{ route('profile') }}" class="relative pb-1 group {{ Request::is('profil*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                Profil
                <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('profil*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </li>

        {{-- Program Pendidikan --}}
        <li>
            <a href="{{ route('program') }}" class="relative pb-1 group {{ Request::is('program*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                Program
                <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('program*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </li>

        {{-- Berita --}}
        <li>
            <a href="{{ route('berita') }}" class="relative pb-1 group {{ Request::is('berita*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                Berita
                <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('berita*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </li>

        {{-- Galeri --}}
        <li>
            <a href="{{ route('galeri') }}" class="relative pb-1 group {{ Request::is('galeri*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                Galeri
                <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('galeri*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </li>

        {{-- Pendaftaran --}}
        <li>
            <a href="{{ route('pendaftaran') }}" 
               class="relative pb-1 group {{ Request::is('pendaftaran*') || Request::is('register*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                Pendaftaran
                <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('pendaftaran*') || Request::is('register*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </li>

        {{-- Kontak --}}
        <li>
            <a href="{{ route('kontak') }}" class="relative pb-1 group {{ Request::is('kontak*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                Kontak
                <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('kontak*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </li>
    </ul>
</nav>