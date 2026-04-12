@extends('layouts.admin')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6 flex justify-between items-start">
    
        <div>
            <h1 class="text-2xl font-bold text-[#1E5631]">
                Profil Saya
            </h1>
            <p class="text-sm text-gray-500">
                Kelola informasi akun admin
            </p>
        </div>

        <!-- LOGOUT BUTTON -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit"
                class="bg-[#F8CFCF] text-red-600 font-semibold px-6 py-2 rounded-md text-sm hover:bg-red-200 transition">
                Logout
            </button>
        </form>

    </div>

    <!-- CARD -->
    <div class="border border-[#D9D9D9] rounded p-6">

        <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- AVATAR + INFO -->

            <div class="flex flex-col items-center text-center mb-8">

                <!-- AVATAR -->
                <div class="w-20 h-20 rounded-full overflow-hidden mb-3">
                    
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-[#1E5631] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                class="w-8 h-8 text-white" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                    d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- NAMA -->
                <h3 class="text-sm font-semibold text-[#1E5631]">
                    {{ $user->nama }}
                </h3>

                <!-- EMAIL -->
                <p class="text-xs text-gray-500 mb-3">
                    {{ $user->email }}
                </p>

                <!-- INPUT FOTO -->
                <input type="file" name="photo" id="photoInput" class="hidden">

                <label for="photoInput"
                    class="flex items-center gap-2 bg-[#1E5631] text-white text-xs px-3 py-1.5 rounded cursor-pointer">

                    <!-- ICON CAMERA -->
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="w-4 h-4" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                            d="M3 7h2l2-3h6l2 3h2a2 2 0 012 2v8a2 2 0 01-2 2H3a2 2 0 01-2-2V9a2 2 0 012-2z"/>
                        <circle cx="12" cy="13" r="3"/>
                    </svg>

                    Pilih Foto
                </label>

            </div>

            <!-- INFORMASI AKUN -->
            <div>

                <!-- TITLE -->
                <h2 class="text-[#1E5631] font-semibold mb-4">
                    Informasi Akun
                </h2>

                <!-- NAMA -->
                <div class="mb-4">
                    <label class="block text-xs text-black mb-1">
                        Nama Lengkap
                    </label>
                    <input type="text" name="nama"
                        value="{{ $user->nama }}"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="block text-xs text-black mb-1">
                        Email
                    </label>
                    <input type="email"
                        value="{{ $user->email }}"
                        readonly
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none">
                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-2 mt-6">

                <button class="px-4 py-2 text-sm bg-gray-200 rounded text-gray-700">
                    Batal
                </button>

                <button type="submit" class="px-4 py-2 text-sm bg-[#1E5631] text-white rounded">
                    Simpan Perubahan
                </button>

            </div>
        </form>

    </div>

</div>

@endsection