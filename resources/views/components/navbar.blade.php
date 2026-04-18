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

    {{-- LOGIN / USER MENU --}}
<li class="flex items-center">
    @guest
        {{-- Jika Belum Login --}}
        <a href="{{ route('login') }}"
   class="ml-4 bg-[#1E5631] text-white px-8 py-2.5 rounded-xl 
          text-sm font-bold uppercase tracking-widest shadow-md
          {{-- Efek Hover & Aktif --}}
          transition-all duration-300 ease-in-out
          hover:bg-[#174427] hover:scale-105 hover:shadow-lg hover:-translate-y-0.5
          active:scale-95 active:shadow-inner flex items-center justify-center">
    Login
</a>
    @endguest

    @auth
    {{-- Jika Sudah Login --}}
    <div class="flex items-center gap-4 ml-4">
        
        @php
            $targetRoute = route('home');
            
            if (Auth::user()->role === 'admin' || Auth::user()->role === 'pimpinan') {
                $targetRoute = route('admin.dashboard');
            } elseif (Auth::user()->role === 'calon_santri') {
                $targetRoute = route('formulir');
            }
        @endphp

        {{-- Username tetap simpel namun rapi --}}
        <a href="{{ $targetRoute }}" 
           class="text-[#1E5631] font-bold text-sm hover:text-[#174427] whitespace-nowrap">
            Hai, {{ explode(' ', Auth::user()->name)[0] }}!
        </a>

        {{-- TOMBOL KELUAR SESUAI FIGMA --}}
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" 
    class="bg-[#B91C1C] text-white font-bold text-xs px-7 py-2.5 rounded-xl 
           tracking-widest uppercase shadow-md 
           {{-- Efek Hover & Aktif --}}
           transition-all duration-300 ease-in-out
           hover:bg-[#991B1B] hover:scale-105 hover:shadow-lg hover:-translate-y-0.5
           active:scale-95 active:shadow-inner">
    KELUAR
</button>
        </form>
    </div>
    @endauth
</li>
    </ul>
</nav>