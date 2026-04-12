<div class="space-y-6">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 class="text-lg font-bold text-[#1E5631]">Timeline Sejarah</h3>
            <p class="text-xs text-gray-500">Daftar peristiwa penting perjalanan pondok pesantren</p>
        </div>
        <button type="button" onclick="openModal('tambahSejarahModal')" 
            class="bg-[#1E5631] text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md hover:bg-[#164227] transition-all">
            + Tambah Sejarah
        </button>
    </div>

    <div class="bg-white border border-[#D9D9D9] rounded-xl overflow-hidden">
        <table class="w-full text-left text-sm table-fixed">
            <thead class="bg-gray-50 border-b border-[#D9D9D9] text-[#1E5631] font-bold uppercase text-[10px] tracking-widest text-center">
                <tr>
                    <th class="px-6 py-4 w-[20%]">Tahun</th>
                    <th class="px-6 py-4 w-[60%]">Peristiwa / Judul</th>
                    <th class="px-6 py-4 w-[20%]">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($sejarahs as $item)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 font-bold text-[#1E5631] text-center">{{ $item->tahun }}</td>
                    <td class="px-6 py-4">
                        <span class="block font-semibold text-gray-800">{{ $item->judul }}</span>
                        <span class="text-xs text-gray-500 line-clamp-1 italic">{{ $item->deskripsi_singkat }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <button onclick='prepareEditSejarah(@json($item))' class="bg-[#CCE3FD] text-[#2D7FF9] font-bold text-[11px] px-4 py-1.5 rounded-md">Edit</button>
                            <button onclick="prepareDeleteSejarah('{{ $item->id }}', '{{ $item->judul }}')" class="bg-[#FEE2E2] text-[#EF4444] font-bold text-[11px] px-4 py-1.5 rounded-md">Hapus</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">Belum ada data sejarah.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('pages.admin.profil-pondok.sejarah-tambah')
@include('pages.admin.profil-pondok.sejarah-edit') 
@include('pages.admin.profil-pondok.sejarah-hapus')

<script>
    function prepareEditSejarah(data) {
    const form = document.getElementById('formEditSejarah');
    form.action = `/admin/profil-pondok/sejarah/${data.id}`;
    document.getElementById('edit_tahun').value = data.tahun;
    document.getElementById('edit_judul').value = data.judul;
    document.getElementById('edit_deskripsi_singkat').value = data.deskripsi_singkat;
    document.getElementById('edit_konten_detail').value = data.konten_detail;
    const preview = document.getElementById('edit_preview_sejarah');
    preview.src = data.gambar ? `/${data.gambar}` : '/images/no-image.png';
    openModal('editSejarahModal');
}

function prepareDeleteSejarah(id, judul) {
    const form = document.getElementById('formHapusSejarah');
    // Sesuaikan URL dengan route DELETE di web.php
    form.action = `/admin/profil-pondok/sejarah/${id}`;
    
    // Tampilkan judul di dalam modal konfirmasi
    document.getElementById('hapus_judul_sejarah').innerText = judul;
    
    openModal('deleteSejarahModal');
}
</script>