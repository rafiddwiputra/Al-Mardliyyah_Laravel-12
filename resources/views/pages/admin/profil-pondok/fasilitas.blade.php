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