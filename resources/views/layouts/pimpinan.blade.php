<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pimpinan Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="w-64 bg-[#1E5631] text-white min-h-screen transition-all duration-300 hidden">

        <!-- TITLE -->
        <div class="px-5 py-4 border-b border-white/20">
            <h1 class="text-lg font-bold">SuperAdmin Panel</h1>
        </div>

        <!-- MENU -->
        <div class="p-4">
            <a href="/pimpinan/laporan"
               class="flex items-center gap-3 px-3 py-2 rounded-md bg-[#D1A954] text-white text-sm font-medium">
                📊 Laporan
            </a>
        </div>

    </aside>

    <!-- MAIN -->
    <div id="mainContent" class="flex-1 flex flex-col transition-all duration-300">

        <!-- TOPBAR -->
        <div class="bg-white border-b px-6 py-3 flex items-center justify-between">

            <!-- LEFT -->
            <div class="flex items-center gap-3">

                <!-- BUTTON -->
                <button onclick="toggleSidebar()" class="text-[#1E5631] text-xl">
                    ☰
                </button>

                <h2 class="font-bold text-[#1E5631]">
                    Pondok Pesantren Al-Mardliyyah
                </h2>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-md">
                <span class="text-xs text-gray-600">Admin User</span>
                <div class="w-5 h-5 bg-gray-300 rounded-full flex items-center justify-center text-xs">
                    👤
                </div>
            </div>

        </div>

        <!-- CONTENT -->
        <main class="p-6">
            @yield('content')
        </main>

    </div>

    <!-- SCRIPT -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');

            sidebar.classList.toggle('hidden');
        }
    </script>

</body>
</html>