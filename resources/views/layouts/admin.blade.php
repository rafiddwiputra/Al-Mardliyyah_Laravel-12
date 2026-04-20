<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Tambahkan Alpine.js jika belum ada di app.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
{{-- Inisialisasi Alpine.js: sidebarOpen default true (terbuka) --}}
<body class="bg-gray-50 font-sans" x-data="{ sidebarOpen: true }">

    <div class="flex h-screen overflow-hidden">
        
        {{-- SIDEBAR --}}
        {{-- Kita bungkus dengan transisi agar smooth saat menutup --}}
        <div :class="sidebarOpen ? 'w-64' : 'w-0'" class="transition-all duration-300 ease-in-out overflow-hidden shadow-xl">
            @include('components.admin.sidebar')
        </div>

        {{-- AREA KANAN --}}
        <div class="flex-1 flex flex-col h-screen transition-all duration-300">
            
            {{-- TOPBAR --}}
            @include('components.admin.topbar')

            {{-- AREA KONTEN UTAMA --}}
            <main class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>