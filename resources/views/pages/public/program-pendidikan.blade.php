@extends('layouts.app')

@section('content')

<!-- HERO -->
<div class="bg-[#1E5631] text-white py-28">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Breadcrumb -->
        <p class="text-sm text-gray-300 mb-3">
            Beranda > Program Pendidikan
        </p>

        <!-- Judul -->
        <h1 class="text-4xl font-bold mb-4 leading-tight">
            Program Pendidikan Pondok Pesantren <br>
            Al-Mardliyyah
        </h1>

        <!-- Deskripsi -->
        <p class="text-base text-gray-200 max-w-2xl leading-relaxed">
            Program pendidikan yang mendukung pembelajaran agama, pendidikan formal, dan pembinaan santri
        </p>

    </div>
</div>

<!-- TAB MENU -->
<div class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-6 flex justify-center gap-4 py-3 text-sm">

        <!-- ACTIVE -->
        <a href="/program-pendidikan"
           class="bg-[#1E5631] text-white px-4 py-2 rounded-md text-sm font-medium shadow-sm">
            Semua
        </a>

        <!-- NON ACTIVE -->
        <a href="#formal"
           class="text-[#333333] px-3 py-2 hover:text-[#1E5631]">
            Lembaga Pendidikan Formal
        </a>

        <a href="#nonformal"
           class="text-[#333333] px-3 py-2 hover:text-[#1E5631]">
            Pendidikan Non Formal
        </a>

        <a href="#unggulan"
           class="text-[#333333] px-3 py-2 hover:text-[#1E5631]">
            Program Unggulan
        </a>

    </div>
</div>

{{-- LEMBAGA PENDIDIKAN FORMAL --}}
<section id="formal" class="py-16 bg-[#F9FAFB]">

    <div class="max-w-5xl mx-auto px-6 text-center">

        <!-- Badge -->
        <div class="inline-block bg-[#D8E6E0] px-4 py-2 rounded mb-4">
            <span class="text-[#1E5631] text-sm font-medium">
                Pendidikan Formal
            </span>
        </div>

        <!-- Judul -->
        <h2 class="text-3xl font-bold text-[#1E5631] mb-4">
            Lembaga Pendidikan Formal
        </h2>

        <!-- Deskripsi -->
        <p class="text-[#4B5563] text-sm max-w-2xl mx-auto mb-12 leading-relaxed">
            Menyelenggarakan pendidikan formal terintegrasi dari tingkat dasar hingga menengah
            dengan kurikulum nasional yang dipadukan nilai-nilai keislaman.
        </p>

        <!-- Grid Card -->
        <div class="grid md:grid-cols-3 gap-6">

            <!-- CARD -->
            <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-md transition">

                <div class="h-2 bg-[#1E5631]"></div>

                <div class="p-7 min-h-[250px] text-left">

                    <!-- ICON -->
                    <div class="w-14 h-14 bg-[#E8F2EC] rounded-lg flex items-center justify-center text-2xl mb-5">
                        📘
                    </div>

                    <!-- Judul -->
                    <h3 class="text-[#1E5631] font-semibold text-lg mb-3">
                        MTs Al-Mardliyyah
                    </h3>

                    <!-- Deskripsi -->
                    <p class="text-sm text-[#4B5563] leading-relaxed">
                        Pendidikan tingkat menengah pertama berbasis kurikulum nasional
                        dan pendidikan pesantren.
                    </p>

                </div>

            </div>

            <!-- CARD -->
            <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-md transition">

                <div class="h-2 bg-[#1E5631]"></div>

                <div class="p-7 min-h-[250px] text-left">

                    <div class="w-14 h-14 bg-[#E8F2EC] rounded-lg flex items-center justify-center text-2xl mb-5">
                        📗
                    </div>

                    <h3 class="text-[#1E5631] font-semibold text-lg mb-3">
                        MA Al-Mardliyyah
                    </h3>

                    <p class="text-sm text-[#4B5563] leading-relaxed">
                        Pendidikan tingkat menengah atas dengan penguatan akademik
                        dan keislaman.
                    </p>

                </div>

            </div>

            <!-- CARD -->
            <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-md transition">

                <div class="h-2 bg-[#1E5631]"></div>

                <div class="p-7 min-h-[250px] text-left">

                    <div class="w-14 h-14 bg-[#E8F2EC] rounded-lg flex items-center justify-center text-2xl mb-5">
                        🎓
                    </div>

                    <h3 class="text-[#1E5631] font-semibold text-lg mb-3">
                        SMK Al-Mardliyyah
                    </h3>

                    <p class="text-sm text-[#4B5563] leading-relaxed">
                        Menyiapkan lulusan siap kerja dengan kompetensi vokasi modern.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- LEMBAGA PENDIDIKAN NON FORMAL --}}
<section id="nonformal" class="py-16 bg-white">

    <div class="max-w-5xl mx-auto px-6 text-center">

        <!-- Badge -->
        <div class="inline-block bg-[#D8E6E0] px-4 py-2 rounded mb-4">
            <span class="text-[#1E5631] text-sm font-medium">
                Pendidikan Non Formal
            </span>
        </div>

        <!-- Judul -->
        <h2 class="text-3xl font-bold text-[#1E5631] mb-4">
            Lembaga Pendidikan Non Formal
        </h2>

        <!-- Deskripsi -->
        <p class="text-[#4B5563] text-sm max-w-2xl mx-auto mb-12 leading-relaxed">
            Program pendidikan non formal yang mendukung penguatan keilmuan agama,
            keterampilan, dan pembinaan karakter santri.
        </p>

        <!-- CARD CENTER -->
        <div class="flex justify-center">

            <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-md transition w-full max-w-xl">
                <!-- AKSEN HIJAU -->
                <div class="h-2 bg-[#1E5631]"></div>

                <div class="p-8 min-h-[240px] text-left">

                    <!-- ICON -->
                    <div class="w-14 h-14 bg-[#E8F2EC] rounded-lg flex items-center justify-center text-2xl mb-5">
                        📚
                    </div>

                    <!-- Judul -->
                    <h3 class="text-[#1E5631] font-semibold text-xl mb-3">
                        Madrasah Diniyah
                    </h3>

                    <!-- Deskripsi -->
                    <p class="text-sm text-[#4B5563] leading-relaxed">
                        Program pendidikan diniyah yang fokus pada pembelajaran kitab kuning,
                        tahsin, tahfidz, fiqih, akhlak, dan penguatan dasar-dasar ilmu agama Islam
                        sebagai pondasi utama pembentukan karakter santri.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- PROGRAM UNGGULAN --}}
<section id="formal" class="py-16 bg-[#F9FAFB]">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <!-- BADGE -->
        <div class="inline-block bg-[#D8E6E0] px-4 py-2 rounded mb-4">
            <span class="text-[#1E5631] text-sm font-medium">
                Program Unggulan
            </span>
        </div>

        <!-- JUDUL -->
        <h2 class="text-2xl font-bold text-[#1E5631] mb-4">
            Program Keunggulan
        </h2>

        <!-- DESKRIPSI -->
        <p class="text-[#333333] text-sm max-w-2xl mx-auto mb-10">
           Fasilitas lengkap dan modern untuk mendukung pembelajaran optimal
        </p>

        <!-- CARD GRID -->
        <div class="grid md:grid-cols-3 gap-8 justify-items-center">

            <!-- CARD -->
            <div class="bg-[#FAFAFA] p-6 rounded-lg shadow text-left w-72 h-80 hover:shadow-md transition">

                <!-- FOTO -->
                    <div class="w-full h-40 mb-4 overflow-hidden rounded-md">
                        <img src="/images/pimpinan1.jpg"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Nama Program -->
                    <h3 class="text-[#1E5631] font-semibold text-lg mb-2">
                        Tahfidzul Qur'an
                    </h3>

                    <!-- DESKRIPSI -->
                    <p class="text-[#333333] text-sm mb-4">
                       Asrama nyaman dengan kapasitas 500 santri
                    </p>

            </div>

            <!-- CARD -->
            <div class="bg-[#FAFAFA] p-6 rounded-lg shadow text-left w-72 h-80 hover:shadow-md transition">

                <!-- FOTO -->
                    <div class="w-full h-40 mb-4 overflow-hidden rounded-md">
                        <img src="/images/pimpinan1.jpg"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Nama Program -->
                    <h3 class="text-[#1E5631] font-semibold text-lg mb-2">
                        Takhasus Kitab Kuning
                    </h3>

                    <!-- DESKRIPSI -->
                    <p class="text-[#333333] text-sm mb-4">
                       Asrama nyaman dengan kapasitas 500 santri
                    </p>

            </div>

            <!-- CARD -->
            <div class="bg-[#FAFAFA] p-6 rounded-lg shadow text-left w-72 h-80 hover:shadow-md transition">

                <!-- FOTO -->
                    <div class="w-full h-40 mb-4 overflow-hidden rounded-md">
                        <img src="/images/pimpinan1.jpg"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Nama Program -->
                    <h3 class="text-[#1E5631] font-semibold text-lg mb-2">
                        Bahasa Inggris
                    </h3>

                    <!-- DESKRIPSI -->
                    <p class="text-[#333333] text-sm mb-4">
                       Asrama nyaman dengan kapasitas 500 santri
                    </p>

            </div>

        </div>

    </div>
</section>

@endsection