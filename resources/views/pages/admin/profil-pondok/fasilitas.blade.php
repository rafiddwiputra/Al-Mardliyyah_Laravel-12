<div>
    <div class="flex justify-end mb-4">
        {{-- Pastikan memanggil fungsi yang sesuai dengan di profil-pondok.blade.php --}}
        <button onclick="openTambahFasilitasModal()"
            class="bg-[#1E5631] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-[#17472a] transition shadow-sm">
            + Tambah Fasilitas
        </button>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-[#D9D9D9]">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-50 text-center text-xs font-bold text-gray-600 uppercase tracking-wider border-b border-[#D9D9D9]">
                    <th class="p-4 w-[25%] text-left">Nama Fasilitas</th>
                    <th class="p-4 w-[20%]">Gambar</th>
                    <th class="p-4 w-[35%] text-left">Deskripsi</th>
                    <th class="p-4 w-[20%]">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($fasilitas as $item)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="p-4 text-sm font-semibold text-[#1E5631]">
                        {{ $item->nama_fasilitas }}
                    </td>

                    <td class="p-4 text-center">
                        <div class="flex justify-center">
                            <img src="{{ asset($item->gambar) }}" 
                                 class="w-20 h-12 object-cover rounded shadow-sm border border-gray-100" 
                                 alt="{{ $item->nama_fasilitas }}">
                        </div>
                    </td>

                    <td class="p-4 text-sm text-gray-600 italic">
                        {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </td>

                    <td class="p-4">
                        <div class="flex gap-2 justify-center">
                            {{-- Fungsi Edit (Nanti kita buatkan logic-nya) --}}
                            <button onclick='prepareEditFasilitas(@json($item))'
                                class="bg-[#BFDBFE] text-[#1D4ED8] px-3 py-1.5 rounded text-[11px] font-bold hover:bg-[#adcffc] transition-colors">
                                Edit
                            </button>

                            {{-- Fungsi Hapus --}}
                            <button onclick="prepareDeleteFasilitas('{{ $item->id }}', '{{ $item->nama_fasilitas }}')"
                                class="bg-[#FECACA] text-[#B91C1C] px-3 py-1.5 rounded text-[11px] font-bold hover:bg-[#fdb7b7] transition-colors">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-10 text-center text-gray-400 italic">
                        Belum ada data fasilitas yang ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- SCRIPT KHUSUS FASILITAS --}}
<script>
    // Nanti kita tambahkan fungsi prepareEditFasilitas dan prepareDeleteFasilitas di sini
    function prepareDeleteFasilitas(id, nama) {
        // Logika hapus yang memanggil Modal Hapus Fasilitas
        const form = document.getElementById('formHapusFasilitas'); // Pastikan ID form ini ada di modal hapus
        form.action = `/admin/profil-pondok/fasilitas/${id}`;
        
        const textNama = document.getElementById('hapus_nama_fasilitas');
        if(textNama) textNama.innerText = nama;

        openHapusFasilitasModal();
    }

    // Tambahkan fungsi ini di bawah prepareDeleteFasilitas yang sudah ada
function prepareEditFasilitas(data) {
    // 1. Set Action Form
    const form = document.getElementById('formEditFasilitas');
    form.action = `/admin/profil-pondok/fasilitas/${data.id}`;

    // 2. Isi Inputan Data Lama
    document.getElementById('edit_nama_fasilitas').value = data.nama_fasilitas;
    document.getElementById('edit_deskripsi_fasilitas').value = data.deskripsi;

    // 3. Tampilkan Gambar Lama di Preview
    const preview = document.getElementById('edit_preview_fasilitas_img');
    preview.src = `/${data.gambar}`;

    // 4. Buka Modal
    openEditFasilitasModal();
}
</script>