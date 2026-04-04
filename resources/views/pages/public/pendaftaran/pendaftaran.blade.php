@extends('layouts.app')

@section('content')


<!-- HERO -->
<div class="bg-[#1E5631] text-white px-20 py-20">
    <p class="text-sm mb-4">Beranda > Pendaftaran</p>

    <h1 class="text-3xl font-bold mb-4">
        Pendaftaran Santri Baru
    </h1>

    <p class="max-w-2xl text-sm leading-relaxed">
        Pondok Pesantren Al-Mardliyyah membuka pendaftaran santri baru tahun ajaran 2026/2027. Bergabunglah bersama kami untuk pendidikan Islam
        yang berkualitas dan berakhlak mulia.
    </p>
</div>

<!-- CONTENT -->
<div class="bg-[#F5F7F6] py-16">

    <!-- INFORMASI PENDAFTARAN -->
    <div class="max-w-3xl mx-auto text-center mb-16">

        <div class="inline-block bg-[#D8E6E0] text-[#1E5631] px-4 py-1 rounded-lg text-sm mb-4">
            Informasi Pendaftaran
        </div>

        <h2 class="text-2xl font-semibold text-[#1E5631] mb-2">
            Yang Perlu Anda Ketahui
        </h2>

        <p class="text-sm text-gray-600 mb-10">
            Informasi lengkap mengenai persyaratan, jadwal, alur, dan biaya pendaftaran
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">

            <!-- CARD 1 -->
            <div class="bg-white p-5 rounded-xl shadow">
                <div class="text-[#1E5631] text-2xl mb-3">📄</div>
                <h4 class="font-semibold text-[#1E5631] mb-2 text-sm">Persyaratan Pendaftaran</h4>
                <ul class="text-xs text-gray-600 space-y-1">
                    <li>• Pas foto 3x4 (Background Merah)</li>
                    <li>• Akta Kelahiran</li>
                    <li>• Kartu Keluarga</li>
                    <li>• KTP Ayah</li>
                    <li>• KTP Ibu</li>
                    <li>• Sertifikat/Piagam Penghargaan</li>
                </ul>
            </div>

            <!-- CARD 2 -->
            <div class="bg-white p-5 rounded-xl shadow">
                <div class="text-[#1E5631] text-2xl mb-3">📄</div>
                <h4 class="font-semibold text-[#1E5631] mb-2 text-sm">Jadwal Pendaftaran</h4>
                <ul class="text-xs text-gray-600 space-y-1">
                    <li>• Pembukaan: 1 April 2026</li>
                    <li>• Penutupan: 30 Juni 2026</li>
                    <li>• Tes Seleksi: 5–10 Juli 2026</li>
                    <li>• Pengumuman: 15 Juli 2026</li>
                </ul>
            </div>

            <!-- CARD 3 -->
            <div class="bg-white p-5 rounded-xl shadow">
                <div class="text-[#1E5631] text-2xl mb-3">📄</div>
                <h4 class="font-semibold text-[#1E5631] mb-2 text-sm">Biaya Pendaftaran</h4>
                <ul class="text-xs text-gray-600 space-y-1">
                    <li>• Formulir: Rp xxx</li>
                    <li>• xxx</li>
                    <li>• xxx</li>
                    <li>• xxx</li>
                </ul>
            </div>

        </div>
    </div>

    <!-- LANGKAH PENDAFTARAN -->
    <div class="max-w-6xl mx-auto text-center">

        <div class="inline-block bg-[#D8E6E0] text-[#1E5631] px-4 py-1 rounded-lg text-sm mb-4">
            Alur Pendaftaran
        </div>

        <h2 class="text-2xl font-semibold text-[#1E5631] mb-2">
            Langkah Pendaftaran
        </h2>

        <p class="text-sm text-gray-600 mb-10">
            Ikuti langkah-langkah berikut untuk menyelesaikan pendaftaran!
        </p>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 text-left">

            <!-- STEP 1 -->
            <div class="bg-white p-5 rounded-xl shadow relative">
                <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm">
                    1
                </div>
                <div class="w-10 h-10 bg-gray-200 rounded mb-3"></div>
                <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Buat Akun</h4>
                <p class="text-xs text-gray-600">
                    Daftarkan akun baru dengan mengisi data diri yang valid seperti nama, email, nomor hp dan kata sandi untuk memulai proses pendaftaran
                </p>
            </div>

            <!-- STEP 2 -->
            <div class="bg-white p-5 rounded-xl shadow relative">
                <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm">
                    2
                </div>
                <div class="w-10 h-10 bg-gray-200 rounded mb-3"></div>
                <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Login</h4>
                <p class="text-xs text-gray-600">
                    Silakan masuk menggunakan email dan kata sandi yang telah didaftarkan untuk melanjutkan proses pendaftaran
                </p>
            </div>

            <!-- STEP 3 -->
            <div class="bg-white p-5 rounded-xl shadow relative">
                <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm">
                    3
                </div>
                <div class="w-10 h-10 bg-gray-200 rounded mb-3"></div>
                <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Isi Formulir</h4>
                <p class="text-xs text-gray-600">
                    Lengkapi formulir pendaftaran online dengan data diri calon santri dan orang tua/wali yang valid
                </p>
            </div>

            <!-- STEP 4 -->
            <div class="bg-white p-5 rounded-xl shadow relative">
                <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm">
                    4
                </div>
                <div class="w-10 h-10 bg-gray-200 rounded mb-3"></div>
                <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Upload Dokumen</h4>
                <p class="text-xs text-gray-600">
                    Upload dokumen yang diperlukan seperti pas foto, Akta Kelahiran, KK, KTP Ayah, KTP Ibu, dan Sertifikat atau Penghargaan
                </p>
            </div>

            <!-- STEP 5 -->
            <div class="bg-white p-5 rounded-xl shadow relative">
                <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm">
                    5
                </div>
                <div class="w-10 h-10 bg-gray-200 rounded mb-3"></div>
                <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Status Pendaftaran</h4>
                <p class="text-xs text-gray-600">
                    Pantau status pendaftaran Anda secara berkala untuk mengetahui hasil pendaftaran
                </p>
            </div>

        </div>

    </div>

</div>

<!-- CTA -->
<div class="bg-[#4F7C5C] text-white py-20 text-center">

    <h3 class="text-2xl font-semibold mb-4">
        Pendaftaran Santri Baru Telah Dibuka
    </h3>

    <p class="text-sm mb-8 max-w-xl mx-auto text-gray-200">
        Bergabunglah dengan ribuan santri kami dan mulai perjalanan
        pendidikan Anda di Pondok Pesantren Al-Mardliyyah
    </p>

    <a href="/registrasi"
       class="bg-[#C6A75E] text-[#1E5631] px-6 py-2 rounded-lg font-semibold inline-block">
        Daftar Sekarang
    </a>

</div>

</div>

@endsection