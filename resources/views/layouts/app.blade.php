<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/logo-pondok.png') }}" type="image/png">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        .scroll-elegan::-webkit-scrollbar { width: 5px; }
        .scroll-elegan::-webkit-scrollbar-track { background: transparent; }
        .scroll-elegan::-webkit-scrollbar-thumb { background: #D8E6E0; border-radius: 10px; }
        .scroll-elegan::-webkit-scrollbar-thumb:hover { background: #1E5631; }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); } 
        }
        .animate-heartbeat {
            animation: heartbeat 2s infinite ease-in-out;
        }
    </style>

<!-- Kode ini berfungsi untuk menentukan tampilan dan perilaku halaman web, termasuk ikon dan font -->
</head>
<body class="bg-white">

    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer', ['showCTA' => $showCTA ?? false])

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true, 
            offset: 50, 
        });
    </script>

</body>
</html>