<div id="toast-container" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 items-end pointer-events-none">
    
    @if(session('success'))
        <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-green-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
            <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800">Berhasil</h4>
                <p class="text-xs text-gray-500 mt-0.5">
                    {{ session('success') }}
                </p>
            </div>

            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
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
                <p class="text-xs text-gray-500 mt-0.5">
                    {{ session('error') }}
                </p>
            </div>

            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
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
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

</div>

<div>
    <div class="flex justify-end mb-4">
        {{-- Pastikan memanggil fungsi yang sesuai dengan di profil-pondok.blade.php --}}
        <button onclick="openTambahFasilitasModal()"
            class="bg-[#1E5631] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-[#17472a] transition shadow-sm">
            + Tambah Fasilitas
        </button>
    </div>
</div>

<div class="overflow-x-auto border border-[#D9D9D9] rounded-lg">
    <table class="w-full text-sm text-left">
        {{-- Header Warna Konsisten --}}
        <thead class="bg-[#F9FAFB] border-b border-[#D9D9D9] text-[#1E5631] font-bold text-center">
            <tr>
                <th class="px-6 py-4 border-r border-[#D9D9D9] w-1/4 uppercase tracking-wider">Nama Fasilitas</th>
                <th class="px-6 py-4 border-r border-[#D9D9D9] w-1/3 uppercase tracking-wider">Deskripsi</th>
                <th class="px-6 py-4 border-r border-[#D9D9D9] uppercase tracking-wider">Gambar</th>
                <th class="px-6 py-4 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach($fasilitas as $item)
            <tr class="border-b border-[#D9D9D9] last:border-0 hover:bg-gray-50 transition-colors">
                <td class="px-6 py-6 border-r border-[#D9D9D9] font-bold text-[#1E5631]">
                    {{ $item->nama_fasilitas }}
                </td>
                
                <td class="px-6 py-6 border-r border-[#D9D9D9] text-gray-600 leading-relaxed">
                    {{ $item->deskripsi }}
                </td>
                
                <td class="px-6 py-6 border-r border-[#D9D9D9] text-center">
    @if($item->gambar)
        <img src="{{ asset($item->gambar) }}" class="inline-block w-20 h-12 object-cover rounded-md border border-gray-200">
    @else
        <div class="inline-block w-20 h-12 bg-[#D9D9D9] rounded-md"></div>
    @endif
</td>
                   <td class="px-5 py-6 text-center align-middle whitespace-nowrap">
    <button onclick="openEditFasilitasModal('{{ $item->id }}', '{{ $item->nama_fasilitas }}', '{{ $item->deskripsi }}', '{{ asset($item->gambar) }}')" 
    class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded font-bold mr-2 hover:bg-blue-200 transition-colors focus:outline-none">
    Edit
</button>

   <button onclick="openHapusFasilitasModal('{{ $item->id }}', '{{ $item->nama_fasilitas }}')" 
    class="bg-red-100 text-red-600 px-4 py-1.5 rounded font-bold hover:bg-red-200 transition-colors focus:outline-none">
    Hapus
</button>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const toasts = document.querySelectorAll('.toast-alert');

    toasts.forEach(function(toast, index) {

        setTimeout(function() {
            toast.classList.remove('translate-x-full', 'opacity-0');
            toast.classList.add('translate-x-0', 'opacity-100');
        }, 100 + (index * 150));

        setTimeout(function() {
            toast.classList.remove('translate-x-0', 'opacity-100');
            toast.classList.add('translate-x-full', 'opacity-0');

            setTimeout(function() {
                toast.remove();
            }, 500);

        }, 4000);
    });
});
</script>