<aside class="w-64 bg-[#1e4d2b] h-screen flex flex-col text-white overflow-hidden">
    {{-- LOGO --}}
    <div class="p-6 border-b border-white/10">
        <h2 class="text-xl font-bold text-center">Admin Panel</h2>
    </div>

    {{-- NAVIGASI --}}
    <nav class="flex-1 px-4 py-6 overflow-y-auto scrollbar-hide">
    
    {{-- DASHBOARD --}}
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-bold transition 
           {{ Request::is('admin/dashboard') ? 'bg-[#c9a76d] shadow-md' : 'hover:bg-white/10' }}">
            <img src="{{ asset('images/ikon-sidebar-admin.png') }}" alt="Icon" 
                 class="w-5 h-5 object-contain {{ Request::is('admin/dashboard') ? 'brightness-0 invert' : '' }}">
            Dashboard
        </a>
    </div>

    {{-- MANAJEMEN KONTEN --}}
<div class="mb-6">
    {{-- Header Bab --}}
    <div class="flex items-center gap-3 font-bold px-4 py-2.5 rounded-lg text-sm transition mb-2
        {{ Request::is('admin/berita*', 'admin/galeri*', 'admin/program*', 'admin/periode*', 'admin/profil-pondok*') 
            ? 'bg-[#c9a76d] text-white shadow-md' 
            : 'text-white/90' }}">
        <img src="{{ asset('images/ikon-sidebar-admin.png') }}" alt="Icon" 
             class="w-5 h-5 object-contain brightness-0 invert">
        Manajemen Konten
    </div>
    
    {{-- List Menu --}}
    <div class="ml-6 border-l-2 border-white/30 space-y-1">
        <a href="{{ route('admin.berita') }}" class="block px-4 py-1.5 text-sm transition {{ Request::is('admin/berita*') ? 'text-[#c9a76d] font-bold' : 'hover:text-[#c9a76d]' }}">Berita</a>
        <a href="{{ route('admin.galeri') }}" class="block px-4 py-1.5 text-sm transition {{ Request::is('admin/galeri*') ? 'text-[#c9a76d] font-bold' : 'hover:text-[#c9a76d]' }}">Galeri</a> 
        <a href="{{ route('admin.program') }}" class="block px-4 py-1.5 text-sm transition {{ Request::is('admin/program-pendidikan*') ? 'text-[#c9a76d] font-bold' : 'hover:text-[#c9a76d]' }}">Program Pendidikan</a>
        <a href="{{ route('admin.profil.index') }}" class="block px-4 py-1.5 text-sm transition {{ Request::is('admin/profil-pondok*') ? 'text-[#c9a76d] font-bold' : 'hover:text-[#c9a76d]' }}">Profil Pondok</a>
        
        {{-- MENU BARU: PERIODE PENDAFTARAN --}}
        <a href="{{ route('admin.periode') }}" class="block px-4 py-1.5 text-sm transition {{ Request::is('admin/periode*') ? 'text-[#c9a76d] font-bold' : 'hover:text-[#c9a76d]' }}">Periode Pendaftaran</a>
    </div>
</div>

    {{-- PENDAFTARAN SANTRI --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 font-bold px-4 py-2.5 rounded-lg text-sm transition mb-2
            {{ Request::is('admin/data-pendaftar*') ? 'bg-[#c9a76d] text-white shadow-md' : 'text-white/90' }}">
            <img src="{{ asset('images/ikon-sidebar-admin.png') }}" alt="Icon" 
                 class="w-5 h-5 object-contain brightness-0 invert">
            Pendaftaran Santri
        </div>
        <div class="ml-6 border-l-2 border-white/30 space-y-1">
            <a href="{{ route('admin.pendaftar') }}" class="block px-4 py-1.5 text-sm transition {{ Request::is('admin/data-pendaftar*') ? 'text-[#c9a76d] font-bold' : 'hover:text-[#c9a76d]' }}">Data Pendaftar</a>
        </div>
    </div>

    {{-- PENGATURAN WEBSITE --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 font-bold px-4 py-2.5 rounded-lg text-sm transition mb-2
            {{ Request::is('admin/banner*', 'admin/kontak*') ? 'bg-[#c9a76d] text-white shadow-md' : 'text-white/90' }}">
            <img src="{{ asset('images/ikon-sidebar-admin.png') }}" alt="Icon" 
                 class="w-5 h-5 object-contain brightness-0 invert">
            Pengaturan Website
        </div>
        <div class="ml-6 border-l-2 border-white/30 space-y-1">
            <a href="{{ route('admin.banner') }}" class="block px-4 py-1.5 text-sm transition {{ Request::is('admin/banner*') ? 'text-[#c9a76d] font-bold' : 'hover:text-[#c9a76d]' }}">Pengaturan Banner</a>

            
            <a href="{{ route('admin.kontak') }}" class="block px-4 py-1.5 text-sm transition {{ Request::is('admin/kontak*') ? 'text-[#c9a76d] font-bold' : 'hover:text-[#c9a76d]' }}">Kontak</a>
        </div>
    </div>

</nav>

{{-- LOGOUT --}}
<div class="p-4 border-t border-white/10">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="w-full flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white font-semibold py-2.5 rounded-lg transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5m-6 14h6a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>

            Keluar
        </button>
    </form>
</div>
</aside>