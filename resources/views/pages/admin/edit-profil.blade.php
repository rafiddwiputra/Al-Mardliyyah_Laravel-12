@extends('layouts.admin')

@section('content')

{{-- ================= TOAST NOTIFICATION CONTAINER ================= --}}
{{-- Container dibuat 'fixed' di pojok kanan atas, menimpa elemen lain (z-[9999]) --}}
<div id="toast-container" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 items-end pointer-events-none">
    
    @if(session('success'))
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-green-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Berhasil</h4>
                <p class="text-xs text-gray-500 mt-0.5">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-red-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Gagal</h4>
                <p class="text-xs text-gray-500 mt-0.5">{{ session('error') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-red-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Peringatan</h4>
                <ul class="list-disc list-inside mt-1 text-xs text-gray-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

</div>
{{-- ================= END TOAST CONTAINER ================= --}}

<div class="p-6">

    <div class="mb-6 flex justify-between items-start">
    
        <div>
            <h1 class="text-2xl font-bold text-[#1E5631]">
                Profil Saya
            </h1>
            <p class="text-sm text-gray-500">
                Kelola informasi akun admin
            </p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-[#F8CFCF] text-red-600 font-semibold px-6 py-2 rounded-md text-sm hover:bg-red-200 transition">
                Logout
            </button>
        </form>

    </div>

    <div class="border border-[#D9D9D9] rounded p-6">

        <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col items-center text-center mb-8">

                <div class="w-20 h-20 rounded-full overflow-hidden mb-3 bg-gray-100 flex items-center justify-center">
                    
                    @if($user->foto)
                        <img src="{{ asset('storage/' . $user->foto) }}"
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

                <h3 class="text-sm font-semibold text-[#1E5631]">
                    {{ $user->nama }}
                </h3>

                <p class="text-xs text-gray-500 mb-3">
                    {{ $user->email }}
                </p>

                <input type="file" name="foto" id="fotoInput" class="hidden">

                <label for="fotoInput"
                    class="flex items-center gap-2 bg-[#1E5631] text-white text-xs px-3 py-1.5 rounded cursor-pointer hover:bg-green-800 transition">
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

            <div>
                <h2 class="text-[#1E5631] font-semibold mb-4">
                    Informasi Akun
                </h2>

                <div class="mb-4">
                    <label class="block text-xs text-black mb-1">
                        Nama Lengkap
                    </label>
                    <input type="text" name="nama"
                        value="{{ $user->nama }}"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none focus:border-[#1E5631]">
                </div>

                <div class="mb-4">
                    <label class="block text-xs text-black mb-1">
                        Nomor HP
                    </label>
                    <input type="text" name="no_hp"
                        value="{{ $user->no_hp }}"
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none focus:border-[#1E5631]">
                </div>

                <div>
                    <label class="block text-xs text-black mb-1">
                        Email
                    </label>
                    <input type="email"
                        value="{{ $user->email }}"
                        readonly
                        class="w-full border border-[#D9D9D9] rounded px-3 py-2 text-sm focus:outline-none bg-gray-100 cursor-not-allowed">
                </div>

            </div>

            <div class="flex justify-end gap-2 mt-6">
                <button type="button" class="px-4 py-2 text-sm bg-gray-200 rounded text-gray-700 hover:bg-gray-300 transition">
                    Batal
                </button>

                <button type="submit" class="px-4 py-2 text-sm bg-[#1E5631] text-white rounded hover:bg-green-800 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>

</div>

{{-- ================= SCRIPT ANIMASI TOAST ================= --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toasts = document.querySelectorAll('.toast-alert');
        
        toasts.forEach(function(toast, index) {
            // 1. Efek Slide-In (Melesat masuk dari kanan)
            // Diberi jeda sedikit agar halus
            setTimeout(function() {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 100 + (index * 150)); 

            // 2. Efek Slide-Out (Keluar otomatis setelah 4 detik)
            setTimeout(function() {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-full', 'opacity-0');
                
                // 3. Hapus bersih dari HTML setelah animasi selesai (500ms)
                setTimeout(function() {
                    toast.remove();
                }, 500);
            }, 4000); 
        });
    });
</script>

@endsection