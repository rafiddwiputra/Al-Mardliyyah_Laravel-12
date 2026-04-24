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
        <p class="text-sm font-medium text-gray-800">
        {{ $data->user->email ?? '-' }}</p>
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
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->nama_lengkap }} </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">NISN (Nomor Induk Sekolah)</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->nisn }} </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">NIK Calon Santri</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->nik }} </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Tempat Lahir</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->tempat_lahir }} </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Jenis Kelamin</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->jenis_kelamin }} </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Jenjang</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->program->nama_program ?? '-' }}
                    </p>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="space-y-4">

                <div>
                    <p class="text-xs text-gray-500">Tanggal Lahir</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d/m/Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Nomor KK</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->nomor_kk ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Sekolah Asal</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->sekolah_asal }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Sumber Informasi</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->sumber_informasi ?? '-' }}
                    </p>
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
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu->nama_ayah ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">NIK Ayah</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu->nik_ayah ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Tanggal Lahir Ayah</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu && $data->ortu->tanggal_lahir_ayah 
                        ? \Carbon\Carbon::parse($data->ortu->tanggal_lahir_ayah)->format('d/m/Y') 
                        : '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Pekerjaan Ayah</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu->pekerjaan_ayah ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Pendidikan Ayah</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu->pendidikan_terakhir_ayah ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Penghasilan</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu->penghasilan_ortu ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Alamat</p>
                    <p class="text-sm font-medium text-gray-800 leading-relaxed">
                        {{ $data->ortu->alamat ?? '-' }}
                    </p>
                </div>

            </div>

            <!-- IBU -->
            <div class="space-y-4">

                <div>
                    <p class="text-xs text-gray-500">Nama Ibu</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu->nama_ibu ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">NIK Ibu</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu->nik_ibu ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Tanggal Lahir Ibu</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu && $data->ortu->tanggal_lahir_ibu 
                        ? \Carbon\Carbon::parse($data->ortu->tanggal_lahir_ibu)->format('d/m/Y') 
                        : '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Pekerjaan Ibu</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu->pekerjaan_ibu ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Pendidikan Ibu</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu->pendidikan_terakhir_ibu ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">No WhatsApp</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu->no_hp ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Kode Pos</p>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $data->ortu->kode_pos ?? '-' }}
                    </p>
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
            @if($data->jenis_kelamin == 'Putra')
            Baju : {{ $data->ukuran_baju_putra ?? '-' }},
            Celana : {{ $data->ukuran_celana_putra ?? '-' }}
            @else
            Baju : {{ $data->ukuran_baju_putri ?? '-' }},
            Rok : {{ $data->ukuran_rok_putri ?? '-' }}
            @endif
        </p>
    </div>

    <!-- STATUS -->
    <div class="bg-white border rounded-xl p-6 mb-6">
        <h3 class="text-sm font-bold text-[#1E5631] mb-4">
            Status Pendaftaran
        </h3>

        <div class="grid md:grid-cols-2 gap-6 text-sm">

        @php
        $status = $data->status;

        $color = match($status) {
        'diterima' => 'bg-green-100 text-green-700',
        'ditolak' => 'bg-red-100 text-red-600',
        default => 'bg-blue-100 text-blue-600'
        };
        @endphp

            <div>
                <p class="text-xs text-gray-500 mb-1">Status Saat Ini</p>
                <span class="text-xs font-medium px-3 py-1 rounded {{ $color }}">
                    {{ ucfirst($data->status) }}
                </span>
            </div>

            <div>
                <p class="text-xs text-gray-500 mb-1">Tanggal Pendaftaran</p>
                <p class="text-sm font-medium text-gray-800">
                    {{ $data->created_at->format('d/m/Y') }}
                </p>
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
    ["nama"=>"Foto Santri", "file"=>$data->foto_santri],
    ["nama"=>"Akta Kelahiran", "file"=>$data->akta_kelahiran],
    ["nama"=>"Kartu Keluarga", "file"=>$data->kartu_keluarga],
    ["nama"=>"KTP Ayah", "file"=>$data->ktp_ayah],
    ["nama"=>"KTP Ibu", "file"=>$data->ktp_ibu],
    ["nama"=>"Sertifikat", "file"=>$data->sertifikat],
    ];
    @endphp

    <div class="space-y-3">
@foreach($dokumen as $doc)

@php
$filePath = $doc['file'] ? asset('images/'.$doc['file']) : null;
@endphp

<div 
    @if($filePath)
        onclick="openModal('{{ $filePath }}')"
    @endif
    class="flex items-center justify-between px-4 py-2 rounded-lg transition
    {{ $filePath 
        ? 'bg-gray-50 hover:bg-gray-100 cursor-pointer' 
        : 'bg-gray-100 opacity-60 cursor-not-allowed' }}">

    <!-- LEFT -->
    <div class="flex items-center gap-3">
        <div class="bg-[#1E5631] text-white text-[10px] px-2 py-1 rounded">
            {{ Str::contains($doc['file'], '.pdf') ? 'PDF' : 'IMG' }}
        </div>

        <p class="text-sm text-gray-700">
            {{ $doc['nama'] }}

            @if(!$filePath)
                <span class="text-red-500 text-xs">(Belum upload)</span>
            @endif
        </p>
    </div>

    <!-- RIGHT -->
    <p class="text-xs text-[#1E5631] font-medium">
        {{ $filePath 
            ? $data->updated_at->format('d M Y - H:i') 
            : '-' }}
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

    const lowerFile = file.toLowerCase();

    if (lowerFile.endsWith('.pdf')) {
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