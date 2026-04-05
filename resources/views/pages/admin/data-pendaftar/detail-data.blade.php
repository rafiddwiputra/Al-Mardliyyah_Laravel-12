@extends('layouts.admin')

@section('content')

<div class="p-6 max-w-5xl">

    <!-- TITLE -->
    <h2 class="text-2xl font-bold text-[#1E5631] mb-1">
        Detail Pendaftar
    </h2>
    <p class="text-sm text-gray-500 mb-6">
        Data Lengkap Pendaftar
    </p>

    <!-- EMAIL -->
    <div class="bg-white border rounded-xl p-6 mb-6">
        <p class="text-xs text-gray-500 mb-1">Email</p>
        <p class="text-sm font-medium text-gray-800">ahmad@gmail.com</p>
    </div>

    <!-- DATA SANTRI -->
    <div class="bg-white border rounded-xl p-6 mb-6">

        <h3 class="text-sm font-bold text-[#1E5631] mb-4">
            Data Santri
        </h3>

        <div class="grid md:grid-cols-2 gap-6 text-sm">

            <!-- LEFT -->
            <div class="space-y-4">

                <div>
                    <p class="text-xs text-gray-500">Nama Lengkap Santri</p>
                    <p class="text-sm font-medium text-gray-800">Ahmad Fauzi</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">NISN (Nomor Induk Sekolah)</p>
                    <p class="text-sm font-medium text-gray-800">1289856660</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">NIK Calon Santri</p>
                    <p class="text-sm font-medium text-gray-800">5678904125400987</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Tempat Lahir</p>
                    <p class="text-sm font-medium text-gray-800">Kota Madiun</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Jenis Kelamin</p>
                    <p class="text-sm font-medium text-gray-800">Laki - Laki</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Jenjang</p>
                    <p class="text-sm font-medium text-gray-800">MTs (khusus putra)</p>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="space-y-4">

                <div>
                    <p class="text-xs text-gray-500">Tanggal Lahir</p>
                    <p class="text-sm font-medium text-gray-800">06/06/2009</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Nomor KK</p>
                    <p class="text-sm font-medium text-gray-800">2433097865437711</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Sekolah Asal</p>
                    <p class="text-sm font-medium text-gray-800">SDN 2 Madiun</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Sumber Informasi</p>
                    <p class="text-sm font-medium text-gray-800">Sosial Media</p>
                </div>

            </div>

        </div>

    </div>

    <!-- DATA ORANG TUA -->
    <div class="bg-white border rounded-xl p-6 mb-6">

        <h3 class="text-sm font-bold text-[#1E5631] mb-4">
            Data Orang Tua
        </h3>

        <div class="grid md:grid-cols-2 gap-6 text-sm">

            <!-- AYAH -->
            <div class="space-y-4">

                <div>
                    <p class="text-xs text-gray-500">Nama Ayah</p>
                    <p class="text-sm font-medium text-gray-800">Riski</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">NIK Ayah</p>
                    <p class="text-sm font-medium text-gray-800">5678112340985543</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Tanggal Lahir Ayah</p>
                    <p class="text-sm font-medium text-gray-800">08/02/1978</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Pekerjaan Ayah</p>
                    <p class="text-sm font-medium text-gray-800">Karyawan Swasta</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Pendidikan Ayah</p>
                    <p class="text-sm font-medium text-gray-800">SMP/SLTP</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Penghasilan</p>
                    <p class="text-sm font-medium text-gray-800">1 - 2 Juta</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Alamat</p>
                    <p class="text-sm font-medium text-gray-800 leading-relaxed">
                        Jl. Cokroaminoto Kota Madiun
                    </p>
                </div>

            </div>

            <!-- IBU -->
            <div class="space-y-4">

                <div>
                    <p class="text-xs text-gray-500">Nama Ibu</p>
                    <p class="text-sm font-medium text-gray-800">Fatimah</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">NIK Ibu</p>
                    <p class="text-sm font-medium text-gray-800">567811056783344</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Tanggal Lahir Ibu</p>
                    <p class="text-sm font-medium text-gray-800">25/09/1978</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Pekerjaan Ibu</p>
                    <p class="text-sm font-medium text-gray-800">Ibu Rumah Tangga</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Pendidikan Ibu</p>
                    <p class="text-sm font-medium text-gray-800">SMP/SLTP</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">No WhatsApp</p>
                    <p class="text-sm font-medium text-gray-800">08765444909</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Kode Pos</p>
                    <p class="text-sm font-medium text-gray-800">3519</p>
                </div>

            </div>

        </div>

    </div>

    <!-- DATA UKURAN -->
    <div class="bg-white border rounded-xl p-6 mb-6">
        <h3 class="text-sm font-bold text-[#1E5631] mb-4">
            Data Ukuran Seragam
        </h3>
        <p class="text-sm font-medium text-gray-800">
            Baju : M, Celana : 35
        </p>
    </div>

    <!-- STATUS -->
    <div class="bg-white border rounded-xl p-6 mb-6">
        <h3 class="text-sm font-bold text-[#1E5631] mb-4">
            Status Pendaftaran
        </h3>

        <div class="grid md:grid-cols-2 gap-6 text-sm">

            <div>
                <p class="text-xs text-gray-500 mb-1">Status Saat Ini</p>
                <span class="text-xs font-medium px-3 py-1 rounded bg-red-100 text-red-600">
                    Ditolak
                </span>
            </div>

            <div>
                <p class="text-xs text-gray-500 mb-1">Tanggal Pendaftaran</p>
                <p class="text-sm font-medium text-gray-800">14/3/2026</p>
            </div>

        </div>
    </div>

    <!-- DOKUMEN -->
<div class="bg-white border rounded-xl p-6 mb-6">

    <h3 class="text-sm font-bold text-[#1E5631] mb-4">
        Dokumen Persyaratan
    </h3>

    @php
$dokumen = [
    ["nama"=>"Dokumen Foto Formal.jpg", "file"=>"https://picsum.photos/800/600"],
    ["nama"=>"Dokumen Akta Kelahiran.pdf", "file"=>"https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf"],
    ["nama"=>"Dokumen KK.pdf", "file"=>"https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf"],
    ["nama"=>"Dokumen KTP Ayah.jpg", "file"=>"https://picsum.photos/800/601"],
    ["nama"=>"Dokumen KTP Ibu.jpg", "file"=>"https://picsum.photos/800/602"],
    ["nama"=>"Sertifikat.pdf", "file"=>"https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf"]
];
@endphp

    <div class="space-y-3">
    @foreach($dokumen as $doc)
    <div onclick="openModal('{{ $doc['file'] }}')"
        class="flex items-center justify-between bg-gray-50 px-4 py-2 rounded-lg cursor-pointer hover:bg-gray-100 transition">

        <div class="flex items-center gap-3">
            <div class="bg-[#1E5631] text-white text-[10px] px-2 py-1 rounded">
                FILE
            </div>
            <p class="text-sm text-gray-700">{{ $doc['nama'] }}</p>
        </div>

        <p class="text-xs text-[#1E5631] font-medium">
            12 Mar 2026 - 11:04
        </p>

    </div>
    @endforeach
</div>
</div>

    <!-- BUTTON -->
    <div>
        <a href="/admin/data-pendaftar"
           class="border border-[#1E5631] text-[#1E5631] px-5 py-2 rounded-lg text-sm hover:bg-[#1E5631] hover:text-white transition">
            ← Kembali
        </a>
    </div>

</div>

<!-- MODAL PREVIEW -->
<div id="fileModal"
    class="fixed inset-0 bg-black/80 hidden z-50 items-center justify-center">

    <!-- CLOSE -->
    <button onclick="closeModal()"
        class="absolute top-5 right-5 text-white text-3xl">
        ✕
    </button>

    <!-- CONTENT -->
    <div class="w-[90%] h-[90%] bg-white rounded-lg overflow-hidden flex items-center justify-center">

        <!-- IMAGE -->
        <img id="modalImage"
            class="hidden max-h-full object-contain">

        <!-- PDF -->
        <iframe id="modalPDF"
            class="hidden w-full h-full"></iframe>

    </div>
</div>

<script>
function openModal(file) {
    const modal = document.getElementById('fileModal');
    const img = document.getElementById('modalImage');
    const pdf = document.getElementById('modalPDF');

    // reset
    img.classList.add('hidden');
    pdf.classList.add('hidden');

    if (file.endsWith('.pdf')) {
        pdf.src = file;
        pdf.classList.remove('hidden');
    } else {
        img.src = file;
        img.classList.remove('hidden');
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('fileModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

@endsection