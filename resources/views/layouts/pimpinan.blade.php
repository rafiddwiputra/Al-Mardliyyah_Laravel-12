<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pimpinan Panel - Al-Mardliyyah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>

<body class="bg-[#F5F7F6] h-screen overflow-hidden">

<div x-data="{ sidebarOpen: true }" class="flex h-screen overflow-hidden">

    {{-- ================= SIDEBAR ================= --}}
<aside
    x-show="sidebarOpen"
    x-transition
    class="fixed left-0 top-0 w-64 bg-[#1e4d2b] h-screen flex flex-col text-white shadow-2xl z-50">

    {{-- LOGO --}}
    <div class="p-6 border-b border-white/10">
        <h2 class="text-xl font-bold text-center">
            Pimpinan Panel
        </h2>
    </div>

    {{-- NAVIGASI --}}
    <nav class="flex-1 px-4 py-6">


        {{-- DASHBOARD --}}
<!-- <div class="mb-6">

    <div class="flex items-center gap-3 font-bold px-4 py-2.5 rounded-lg text-sm transition mb-2
        {{ Request::is('pimpinan/dashboard*') ? 'bg-[#c9a76d] text-white shadow-md' : 'text-white/90' }}">

        <img src="{{ asset('images/ikon-sidebar-admin.png') }}"
            alt="Icon"
            class="w-5 h-5 object-contain brightness-0 invert">

        Dashboard
    </div>

    <div class="ml-6 border-l-2 border-white/30 space-y-1">

        <a href="{{ route('pimpinan.dashboard') }}"
        class="block px-4 py-1.5 text-sm transition
        {{ Request::is('pimpinan/dashboard*') ? 'text-[#c9a76d] font-bold' : 'hover:text-[#c9a76d]' }}">

            Dashboard Utama

        </a>

    </div>

</div> -->

        {{-- LAPORAN --}}
        <div class="mb-6">

            <div class="flex items-center gap-3 font-bold px-4 py-2.5 rounded-lg text-sm transition mb-2
                {{ Request::is('pimpinan/laporan*') ? 'bg-[#c9a76d] text-white shadow-md' : 'text-white/90' }}">

                <img src="{{ asset('images/ikon-sidebar-admin.png') }}"
                    alt="Icon"
                    class="w-5 h-5 object-contain brightness-0 invert">

                Laporan
            </div>

            <div class="ml-6 border-l-2 border-white/30 space-y-1">
                <a href="/pimpinan/laporan"
                class="block px-4 py-1.5 text-sm transition
                {{ Request::is('pimpinan/laporan*') ? 'text-[#c9a76d] font-bold' : 'hover:text-[#c9a76d]' }}">
                    Data Laporan
                </a>
            </div>

        </div>

        {{-- MANAJEMEN ADMIN --}}
        <div class="mb-6">

            <div class="flex items-center gap-3 font-bold px-4 py-2.5 rounded-lg text-sm transition mb-2
                {{ Request::is('pimpinan/admin*') ? 'bg-[#c9a76d] text-white shadow-md' : 'text-white/90' }}">

                <img src="{{ asset('images/ikon-sidebar-admin.png') }}"
                    alt="Icon"
                    class="w-5 h-5 object-contain brightness-0 invert">

                Manajemen Admin
            </div>

            <div class="ml-6 border-l-2 border-white/30 space-y-1">
                <a href="{{ route('pimpinan.admin.index') }}"
                class="block px-4 py-1.5 text-sm transition
                {{ Request::is('pimpinan/admin*') ? 'text-[#c9a76d] font-bold' : 'hover:text-[#c9a76d]' }}">
                    Data Admin
                </a>
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

                Logout
            </button>

        </form>
    </div>

</aside>

    {{-- ================= MAIN ================= --}}
    <div class="flex-1 flex flex-col ml-64 overflow-hidden">

        {{-- ================= TOPBAR ================= --}}
<header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-6 sticky top-0 z-[9999] relative">

    {{-- SISI KIRI --}}
    <div class="flex items-center gap-4">

        <button @click="sidebarOpen = !sidebarOpen"
            class="text-[#1e4d2b] hover:bg-gray-100 p-2 rounded-lg transition-colors focus:outline-none">

            <svg class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>

        </button>

        <h1 class="text-[#1e4d2b] font-bold text-lg hidden md:block">
            Pondok Pesantren Al-Mardliyyah
        </h1>

    </div>

    {{-- PROFILE --}}
   <a href="{{ route('pimpinan.profil') }}"
    class="flex items-center gap-3 bg-gray-100 px-4 py-1.5 rounded-full border border-gray-200 shadow-sm cursor-pointer hover:bg-gray-200 transition">

        <div class="text-right">
            <p class="text-[10px] font-bold text-gray-500 leading-none">
                {{ ucfirst(strtolower(collect(explode(' ', trim(Auth::user()->nama ?? 'User')))->first())) }}
            </p>

            <p class="text-[10px] text-gray-400">
                Pimpinan
            </p>
        </div>

        <div class="w-8 h-8 rounded-full overflow-hidden border border-white">

            @if(Auth::user()->foto)
                <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                    class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-500"
                        fill="currentColor"
                        viewBox="0 0 24 24">

                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>

                    </svg>
                </div>
            @endif

        </div>

    </a>

</header>

        {{-- ================= CONTENT ================= --}}
        <main class="flex-1 overflow-y-auto p-8">

            {{-- WRAPPER CARD --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm min-h-[300px]">

                @yield('content')

            </div>

        </main>

    </div>

</body>
</html>