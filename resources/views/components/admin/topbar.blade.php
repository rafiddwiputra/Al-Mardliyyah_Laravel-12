<header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-6 sticky top-0 z-40">
    
    {{-- SISI KIRI: BURGER & JUDUL --}}
    <div class="flex items-center gap-4">
        {{-- Tombol Burger dengan fungsi klik --}}
        <button @click="sidebarOpen = !sidebarOpen" class="text-[#1e4d2b] hover:bg-gray-100 p-2 rounded-lg transition-colors focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        
        <h1 class="text-[#1e4d2b] font-bold text-lg hidden md:block">
            Pondok Pesantren Al-Mardliyyah
        </h1>
    </div>

    {{-- SISI KANAN: PROFILE USER --}}
    <div class="flex items-center gap-3 bg-gray-100 px-4 py-1.5 rounded-full border border-gray-200 shadow-sm cursor-pointer hover:bg-gray-200 transition">
        <div class="text-right">
            <p class="text-[10px] font-bold text-gray-500 leading-none uppercase">Admin User</p>
        </div>
        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center border border-white">
            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
            </svg>
        </div>
    </div>

</header>