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
                    <th class="p-4 border-r border-[#D9D9D9] font-semibold text-center">JUDUL</th>
                    <th class="p-4 border-r border-[#D9D9D9] font-semibold text-center">DESKRIPSI</th>
                    <th class="p-4 border-r border-[#D9D9D9] font-semibold text-center">GAMBAR</th>
                    <th class="p-4 font-semibold text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr class="border-b border-gray-100 last:border-none hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-6 border-r border-[#D9D9D9] font-bold text-[#1E5631] align-middle text-center">
                        Profil Video 1
                    </td>
                    <td class="px-5 py-6 border-r border-[#D9D9D9] text-gray-500 align-middle text-center">
                        Video profil pondok Al-Mardliyyah bagian 1
                    </td>
                    <td class="px-5 py-6 border-r border-[#D9D9D9] text-center align-middle">
                        <div class="w-20 h-12 bg-[#D9D9D9] rounded-md mx-auto object-cover flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </td>
                    <td class="px-5 py-6 text-center align-middle whitespace-nowrap">
                        <button class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded font-bold mr-2 hover:bg-blue-200 transition-colors">
                            Edit
                        </button>
                        <button class="bg-red-100 text-red-600 px-4 py-1.5 rounded font-bold hover:bg-red-200 transition-colors">
                            Hapus
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>