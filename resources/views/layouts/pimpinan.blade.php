<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pimpinan Panel - Al-Mardliyyah</title>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>

<body class="bg-[#F5F7F6] flex min-h-screen">

    {{-- ================= SIDEBAR ================= --}}
    <aside id="sidebar"
        class="w-72 bg-[#1E5631] text-white min-h-screen transition-all duration-300 flex flex-col shadow-2xl">

        {{-- LOGO / TITLE --}}
        <div class="px-6 py-5 border-b border-white/10">

            <div class="flex items-center gap-3">

                <div>
                    <h1 class="font-bold text-lg leading-tight">
                        Pimpinan Panel
                    </h1>
                </div>

            </div>

        </div>

        {{-- MENU --}}
        <div class="flex-1 px-4 py-6 space-y-2">

            {{-- Laporan --}}
            <a href="/pimpinan/laporan"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 text-white text-base font-medium transition"

                <i class="fas fa-file-alt text-base"></i>

                Laporan
            </a>

            {{-- Manajemen Admin --}}
            <a href="{{ route('pimpinan.admin.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 text-white text-base font-medium transition"

                <i class="fas fa-user-shield text-base"></i>

                Manajemen Admin
            </a>

        </div>


    </aside>

    {{-- ================= MAIN ================= --}}
    <div class="flex-1 flex flex-col">

        {{-- ================= TOPBAR ================= --}}
        <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-6 sticky top-0 z-40">

            {{-- SISI KIRI --}}
            <div class="flex items-center gap-4">

                {{-- BURGER BUTTON --}}
                <button onclick="toggleSidebar()"
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
            <div class="flex items-center gap-3 bg-gray-100 px-4 py-1.5 rounded-full border border-gray-200 shadow-sm">

                <div class="text-right">
                    <p class="text-[10px] font-bold text-gray-500 leading-none">
                        Admin User
                    </p>

                    <p class="text-[10px] text-gray-400">
                        Pimpinan
                    </p>
                </div>

                <div class="w-8 h-8 rounded-full bg-[#E8F2EC] flex items-center justify-center">
                    <i class="fas fa-user text-[#1E5631] text-xs"></i>
                </div>

            </div>

        </header>

        {{-- ================= CONTENT ================= --}}
        <main class="p-8">

            {{-- WRAPPER CARD --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm min-h-[300px]">

                @yield('content')

            </div>

        </main>

    </div>

    {{-- ================= SCRIPT ================= --}}
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');

            sidebar.classList.toggle('hidden');
        }
    </script>

</body>
</html>