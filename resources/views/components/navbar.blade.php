{{-- Navbar tetap di atas dengan sticky top-0 --}}
<nav class="bg-white py-3 px-4 md:py-4 md:px-8 flex items-center justify-between border-b border-gray-100 sticky top-0 z-50 shadow-sm relative">
    
    {{-- 1. BAGIAN KIRI: LOGO & NAMA PONDOK --}}
    <a href="/" class="flex items-center gap-2 md:gap-3 group shrink-0">
        {{-- Logo --}}
        <img src="{{ asset('images/logo-pondok.png') }}"
             alt="Logo Al-Mardliyyah" 
             class="w-10 h-10 md:w-14 md:h-14 object-contain transition-transform group-hover:scale-105">
        
        {{-- Teks Bertumpuk (Ukuran disesuaikan untuk HP agar tidak kepanjangan) --}}
        <div class="flex flex-col justify-center">
            <span class="text-[#1E5631] font-bold text-xs sm:text-sm md:text-xl leading-tight">
                Pondok Pesantren
            </span>
            <span class="text-gray-700 font-medium text-[10px] sm:text-xs md:text-lg leading-tight">
                Al-Mardliyyah
            </span>
        </div>
    </a>

    {{-- 2. BAGIAN KANAN: MENU LINKS + LOGIN + HAMBURGER --}}
    <div class="flex items-center gap-3 md:gap-8">
        
        {{-- MENU NAVIGASI (Hanya berisi Link, disembunyikan di HP) --}}
        <ul id="nav-menu" class="hidden md:flex flex-col md:flex-row items-start md:items-center gap-6 md:gap-8 text-sm font-medium text-gray-600 absolute md:static top-full left-0 w-full md:w-auto bg-white md:bg-transparent shadow-lg md:shadow-none px-6 py-6 md:p-0 border-b md:border-none border-gray-100 z-40 transition-all duration-300">
            <li>
                <a href="/" class="relative pb-1 block group {{ Request::is('/') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                    Beranda
                    <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('/') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile') }}" class="relative pb-1 block group {{ Request::is('profil*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                    Profil
                    <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('profil*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('program') }}" class="relative pb-1 block group {{ Request::is('program*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                    Program Pendidikan
                    <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('program*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('berita') }}" class="relative pb-1 block group {{ Request::is('berita*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                    Berita
                    <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('berita*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('galeri') }}" class="relative pb-1 block group {{ Request::is('galeri*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                    Galeri
                    <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('galeri*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('pendaftaran') }}" class="relative pb-1 block group {{ Request::is('pendaftaran*') || Request::is('register*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                    Pendaftaran
                    <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('pendaftaran*') || Request::is('register*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('kontak') }}" class="relative pb-1 block group {{ Request::is('kontak*') ? 'text-[#1e4d2b] font-bold' : 'hover:text-[#1e4d2b] transition-colors duration-300' }}">
                    Kontak
                    <span class="absolute left-0 bottom-0 h-0.5 bg-[#1e4d2b] transition-all duration-300 {{ Request::is('kontak*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </li>
        </ul>

        {{-- TOMBOL AUTH (Selalu Terlihat) & HAMBURGER --}}
        <div class="flex items-center gap-2 md:gap-4 shrink-0">
            
            @guest
                {{-- Tombol Login --}}
                <a href="{{ route('login') }}"
                   class="bg-[#1E5631] text-white px-4 py-1.5 md:px-8 md:py-2.5 rounded-lg md:rounded-xl 
                          text-[11px] md:text-sm font-bold uppercase tracking-widest shadow-md
                          transition-all duration-300 ease-in-out whitespace-nowrap
                          hover:bg-[#174427] hover:scale-105 hover:shadow-lg hover:-translate-y-0.5
                          active:scale-95 active:shadow-inner flex items-center justify-center">
                    Login
                </a>
            @endguest

            @auth
                {{-- Logika Jika Sudah Login --}}
                @php
                    $targetRoute = route('home');
                    if (Auth::user()->role === 'admin' || Auth::user()->role === 'pimpinan') {
                        $targetRoute = route('admin.dashboard');
                    } elseif (Auth::user()->role === 'calon_santri') {
                        $data = \App\Models\PendaftaranSantri::where('users_id', Auth::id())->first();
                        if (!$data) {
                            $targetRoute = route('formulir');
                        } elseif (
                            empty($data->foto_santri) || $data->foto_santri == '-' ||
                            empty($data->akta_kelahiran) || $data->akta_kelahiran == '-' ||
                            empty($data->kartu_keluarga) || $data->kartu_keluarga == '-' ||
                            empty($data->ktp_ayah) || $data->ktp_ayah == '-' ||
                            empty($data->ktp_ibu) || $data->ktp_ibu == '-'
                        ) {
                            $targetRoute = route('upload.dokumen');
                        } else {
                            $targetRoute = route('status.pendaftaran');
                        }
                    }
                @endphp

                {{-- Sapaan User (Disembunyikan di HP sempit agar rapi, muncul di Tablet/Laptop) --}}
                <a href="{{ $targetRoute }}" 
                   class="hidden sm:block text-[#1E5631] font-bold text-xs md:text-sm hover:text-[#174427] whitespace-nowrap">
                    Hai, {{ explode(' ', Auth::user()->name)[0] }}!
                </a>

                {{-- Tombol Keluar --}}
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-[#B91C1C] text-white font-bold text-[10px] md:text-xs px-3 py-1.5 md:px-7 md:py-2.5 rounded-lg md:rounded-xl 
                                   tracking-widest uppercase shadow-md whitespace-nowrap
                                   transition-all duration-300 ease-in-out
                                   hover:bg-[#991B1B] hover:scale-105 hover:shadow-lg hover:-translate-y-0.5
                                   active:scale-95 active:shadow-inner">
                        KELUAR
                    </button>
                </form>
            @endauth

            {{-- TOMBOL HAMBURGER --}}
            <button id="hamburger-btn" class="block md:hidden text-gray-600 hover:text-[#1E5631] focus:outline-none ml-1">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
        </div>
    </div>
</nav>

{{-- SCRIPT UNTUK TOGGLE MENU MOBILE --}}
<script>
    document.getElementById('hamburger-btn').addEventListener('click', function() {
        const menu = document.getElementById('nav-menu');
        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
    });
</script>