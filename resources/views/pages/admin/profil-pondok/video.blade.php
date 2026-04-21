<div class="w-full block">
    <div class="flex justify-end mb-5">
        <button onclick="openTambahVideoModal()" 
            class="bg-[#1E5631] text-white px-5 py-2 rounded-md text-sm font-medium hover:bg-green-800 transition-colors focus:outline-none">
            + Tambah
        </button>
    </div>

    <div class="border border-[#D9D9D9] rounded-lg overflow-hidden w-full">
        <table class="w-full border-collapse text-sm">
            <thead class="bg-gray-50 border-b border-[#D9D9D9] text-[#1E5631]">
                <tr>
                    <th class="p-4 border-r border-[#D9D9D9] font-bold text-center">JUDUL</th>
                    <th class="p-4 border-r border-[#D9D9D9] font-bold text-center">DESKRIPSI</th>
                    <th class="p-4 border-r border-[#D9D9D9] font-bold text-center">GAMBAR</th>
                    <th class="p-4 font-bold text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="bg-white">
    @foreach($videos as $v)
    <tr class="border-b border-gray-100 last:border-none hover:bg-gray-50 transition-colors">
        <td class="px-5 py-6 border-r border-[#D9D9D9] font-bold text-[#1E5631] align-middle text-center">
            {{ $v->judul }}
        </td>
        <td class="px-5 py-6 border-r border-[#D9D9D9] text-gray-500 align-middle text-center">
            {{ Str::limit($v->deskripsi, 50) }}
        </td>
        <td class="px-5 py-6 border-r border-[#D9D9D9] text-center align-middle">
            <div class="w-20 h-12 bg-[#D9D9D9] rounded-md mx-auto overflow-hidden border border-gray-200">
                @if($v->thumbnail)
                    <img src="{{ asset('storage/' . $v->thumbnail) }}" class="w-full h-full object-cover">
                @else
                    <svg class="w-6 h-6 text-gray-400 m-auto" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                @endif
            </div>
        </td>
        <td class="px-5 py-6 text-center align-middle whitespace-nowrap">
    {{-- PERHATIKAN: Kita menggunakan kutip SATU onclick='...' --}}
    <button onclick='openEditVideoModal("{{ $v->id }}", @json($v->judul), @json($v->deskripsi), @json($v->link_yt), "{{ $v->thumbnail ? asset('storage/' . $v->thumbnail) : '' }}")' 
    class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded font-bold mr-2 hover:bg-blue-200 transition-colors">
    Edit
</button>
    <button onclick='openHapusVideoModal("{{ $v->id }}")' 
        class="bg-red-100 text-red-600 px-4 py-1.5 rounded font-bold hover:bg-red-200 transition-colors">
        Hapus
    </button>
</td>
    </tr>
    @endforeach
</tbody>
        </table>
    </div>
</div>