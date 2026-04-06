@extends('layouts.admin')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#1E5631]">
            Kontak
        </h1>
        <p class="text-sm text-gray-500">
            Edit informasi kontak utama pondok pesantren
        </p>
    </div>

    <div class="space-y-6">

        <!-- INFORMASI KONTAK -->
        <div class="border border-[#D9D9D9] rounded p-5">

            <!-- TITLE -->
            <div class="mb-4">
                <h2 class="text-sm font-semibold text-[#1E5631]">
                    Informasi Kontak
                </h2>
                <p class="text-xs text-gray-500">
                    Edit informasi kontak utama pondok pesantren
                </p>
            </div>

            <!-- ALAMAT -->
            <div class="mb-4">
                <label class="block text-xs text-black mb-1">
                    Alamat
                </label>
                <textarea rows="3"
                    class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">Jl. Contoh No. 123, Kecamatan Example, Kabupaten Contoh, Jawa Timur</textarea>
            </div>

            <!-- WHATSAPP -->
            <div class="mb-4">
                <label class="block text-xs text-black mb-1">
                    Nomor WhatsApp
                </label>
                <input type="text"
                    value="081234567890"
                    class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-xs text-black mb-1">
                    Email
                </label>
                <input type="email"
                    value="info@pondok.com"
                    class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
            </div>

        </div>

        <!-- MEDIA SOSIAL -->
        <div class="border border-[#D9D9D9] rounded p-5">

            <!-- TITLE -->
            <div class="mb-4">
                <h2 class="text-sm font-semibold text-[#1E5631]">
                    Media Sosial
                </h2>
                <p class="text-xs text-gray-500">
                    Edit URL media sosial pondok pesantren
                </p>
            </div>

            <!-- INSTAGRAM -->
            <div class="mb-4">
                <label class="block text-xs text-black mb-1">
                    Instagram
                </label>
                <input type="text"
                    value="https://instagram.com"
                    class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
            </div>

            <!-- YOUTUBE -->
            <div class="mb-4">
                <label class="block text-xs text-black mb-1">
                    Youtube
                </label>
                <input type="text"
                    value="https://youtube.com"
                    class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
            </div>

            <!-- FACEBOOK -->
            <div>
                <label class="block text-xs text-black mb-1">
                    Facebook
                </label>
                <input type="text"
                    value="https://facebook.com"
                    class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
            </div>

        </div>

        <!-- BUTTON -->
        <div class="flex justify-end gap-2">
            <button class="px-4 py-2 border rounded text-gray-600">
                Batal
            </button>

            <button class="px-4 py-2 bg-[#1E5631] text-white rounded">
                Simpan Perubahan
            </button>
        </div>

    </div>

</div>

@endsection