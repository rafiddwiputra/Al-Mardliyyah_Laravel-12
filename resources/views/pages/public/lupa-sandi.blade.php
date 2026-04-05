@extends('pages.auth.auth')

@section('content')

<div class="h-screen bg-[#1E5631] flex items-center justify-center px-4">

    <!-- CARD -->
    <div class="bg-white w-full max-w-sm rounded-lg shadow-md px-5 py-4">

        <!-- JUDUL -->
        <h2 class="text-center text-sm font-bold text-[#1E5631] mb-1">
            Lupa Kata Sandi
        </h2>

        <!-- DESKRIPSI -->
        <p class="text-center text-[11px] text-gray-500 mb-3 leading-tight">
            Masukkan email untuk mendapatkan kode verifikasi
        </p>

        <!-- FORM -->
        <div class="space-y-2">

            <!-- EMAIL -->
            <div>
                <label class="text-[11px] font-semibold">
                    Email <span class="text-red-500">*</span>
                </label>

                <div class="flex items-center gap-2 mt-1">
                    <input 
                        type="email"
                        class="flex-1 py-1 px-2 border border-gray-300 rounded-md text-[11px] focus:ring-1 focus:ring-[#1E5631]"
                        placeholder="Email"
                    >

                    <button class="bg-[#C6A75E] text-white px-2 py-1 text-[11px] rounded-md whitespace-nowrap">
                        Kirim Kode
                    </button>
                </div>
            </div>

            <!-- KODE -->
            <div>
                <label class="text-[11px] font-semibold">
                    Kode Verifikasi <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text"
                    class="w-full mt-1 py-1 px-2 border border-gray-300 rounded-md text-[11px] focus:ring-1 focus:ring-[#1E5631]"
                    placeholder="Kode Verifikasi"
                >
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="text-[11px] font-semibold">
                    Kata Sandi <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password"
                    class="w-full mt-1 py-1 px-2 border border-gray-300 rounded-md text-[11px] focus:ring-1 focus:ring-[#1E5631]"
                    placeholder="Kata Sandi"
                >
            </div>

            <!-- KONFIRMASI -->
            <div>
                <label class="text-[11px] font-semibold">
                    Konfirmasi <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password"
                    class="w-full mt-1 py-1 px-2 border border-gray-300 rounded-md text-[11px] focus:ring-1 focus:ring-[#1E5631]"
                    placeholder="Konfirmasi Kata Sandi"
                >
            </div>

        </div>

        <!-- BUTTON -->
        <div class="flex justify-center mt-3">
            <button class="bg-[#C6A75E] text-white px-4 py-1 text-[11px] rounded-md">
                Simpan Perubahan
            </button>
        </div>

    </div>

</div>

@endsection