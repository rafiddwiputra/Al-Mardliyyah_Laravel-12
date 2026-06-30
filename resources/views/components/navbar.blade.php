{{-- Navbar tetap di atas dengan sticky top-0 --}}
<nav class="bg-white py-3 px-4 md:py-4 md:px-8 flex items-center justify-between border-b border-gray-100 sticky top-0 z-50 shadow-sm relative">
    
    <a href="/" class="flex items-center gap-2 md:gap-3 group shrink-0">
        {{-- Logo --}}
        <img src="{{ asset('images/logo-pondok.png') }}"
             alt="Logo Al-Mardliyyah" 
             class="w-10 h-10 md:w-14 md:h-14 object-contain transition-transform group-hover:scale-105">
        
       
        <div class="flex flex-col justify-center">
            <span class="text-[#1E5631] font-bold text-xs sm:text-sm md:text-xl leading-tight">
                Pondok Pesantren
            </span>
            <span class="text-gray-700 font-medium text-[10px] sm:text-xs md:text-lg leading-tight">
                Al-Mardliyyah Demangan
            </span>
        </div>
    </a>
    <div class="flex items-center gap-3 md:gap-8">
        
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
                    Masuk
                </a>
            @endguest

            @auth
                {{-- Logika Target Route --}}
                @php
                    $targetRoute = route('home');
                    $menuLabel = 'Cek Status'; 
                    
                    if (Auth::user()->role === 'admin' || Auth::user()->role === 'pimpinan') {
                        $targetRoute = route('admin.dashboard');
                    } elseif (Auth::user()->role === 'calon_santri') {
                        
                        // CEK DATA PENDAFTARAN
                        // Catatan: Sesuaikan 'users_id' jika di databasemu namanya 'users_id'
                        $data = \App\Models\PendaftaranSantri::where('users_id', Auth::id())->first();
                        
                        if (!$data) {
                            $targetRoute = route('formulir');
                            $menuLabel = 'Lanjutkan Pendaftaran';
                        } elseif (
                            empty($data->foto_santri) || $data->foto_santri == '-' ||
                            empty($data->akta_kelahiran) || $data->akta_kelahiran == '-' ||
                            empty($data->kartu_keluarga) || $data->kartu_keluarga == '-' ||
                            empty($data->ktp_ayah) || $data->ktp_ayah == '-' ||
                            empty($data->ktp_ibu) || $data->ktp_ibu == '-'
                        ) {
                            $targetRoute = route('upload.dokumen');
                            $menuLabel = 'Lanjutkan Pendaftaran';
                        } else {
                            $targetRoute = route('status.pendaftaran');
                            $menuLabel = 'Cek Status';
                        }
                    }
                @endphp

                <div class="relative shrink-0">
                    {{-- Tombol Profile / Trigger Dropdown --}}
                    <button id="profile-dropdown-btn" title="Menu Profil"
                       class="w-8 h-8 md:w-10 md:h-10 border border-gray-200 hover:border-[#1E5631]/30 rounded-full flex items-center justify-center transition-all duration-300 shadow-sm overflow-hidden focus:outline-none">
                        <img src="{{ asset('images/default-profile.png') }}" alt="User Profile" class="w-full h-full object-cover">
                    </button>

                    {{-- Isi Dropdown Menu --}}
                    <div id="profile-dropdown-menu" class="hidden absolute right-0 mt-3 w-52 bg-white border border-gray-100 rounded-xl shadow-xl py-2 z-50 flex-col origin-top-right transition-all">
                        
                        {{-- Header Dropdown --}}
                        <div class="px-4 py-3 border-b border-gray-100 mb-1 bg-gray-50/50 rounded-t-xl">
                            <p class="text-[11px] text-gray-500 uppercase tracking-wider font-semibold mb-0.5">Masuk sebagai</p>
                            <p class="text-sm font-bold text-[#1E5631] truncate">{{ Auth::user()->name }}</p>
                        </div>

                        {{-- Menu Dinamis Sesuai Role --}}
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ $targetRoute }}" class="px-4 py-2.5 text-sm text-gray-700 hover:bg-[#E8F2EC] hover:text-[#1E5631] transition-colors flex items-center gap-3 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Panel Admin
                            </a>
                        @elseif(Auth::user()->role === 'pimpinan')
                            <a href="{{ $targetRoute }}" class="px-4 py-2.5 text-sm text-gray-700 hover:bg-[#E8F2EC] hover:text-[#1E5631] transition-colors flex items-center gap-3 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                Panel Pimpinan
                            </a>
                        @else
                            <a href="{{ $targetRoute }}" class="px-4 py-2.5 text-sm text-gray-700 hover:bg-[#E8F2EC] hover:text-[#1E5631] transition-colors flex items-center gap-3 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                {{ $menuLabel }}
                            </a>
                        @endif

                        {{-- Tombol Keluar --}}
                        <div class="border-t border-gray-100 mt-1 pt-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors flex items-center gap-3 font-medium rounded-b-xl">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
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

<script>
    // Toggle Menu Hamburger Mobile
    const hamburgerBtn = document.getElementById('hamburger-btn');
    if(hamburgerBtn) {
        hamburgerBtn.addEventListener('click', function() {
            const menu = document.getElementById('nav-menu');
            menu.classList.toggle('hidden');
            menu.classList.toggle('flex');
        });
    }

    // Toggle Menu Profile Dropdown
    const profileBtn = document.getElementById('profile-dropdown-btn');
    const profileMenu = document.getElementById('profile-dropdown-menu');
    
    if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Mencegah event klik menyebar
            profileMenu.classList.toggle('hidden');
            profileMenu.classList.toggle('flex');
        });

        // Menutup dropdown jika user klik area kosong di luar menu
        document.addEventListener('click', function(e) {
            if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.add('hidden');
                profileMenu.classList.remove('flex');
            }
        });
    }
</script>