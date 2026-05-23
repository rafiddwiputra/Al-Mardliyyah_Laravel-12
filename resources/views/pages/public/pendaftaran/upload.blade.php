@extends('layouts.app')

@section('content')

{{-- Perubahan Padding Kontainer Utama agar tidak "kurus" di HP (px-2 sm:px-6 md:px-10) --}}
<div class="max-w-6xl mx-auto py-12 px-2 sm:px-6 md:px-10">

    <div class="flex items-center justify-between mb-20 md:mb-16 px-2 sm:px-6 md:px-10">

        @php
            $steps = [
                1 => 'Buat Akun',              
                2 => 'Isi Formulir',
                3 => 'Upload Dokumen',
                4 => 'Status Pendaftaran'
            ];
        @endphp

        @foreach($steps as $number => $label)
            <div class="flex flex-col items-center flex-1 relative">
                
                {{-- GARIS PENGHUBUNG (Perubahan: top-4 md:top-5 biar senter saat bulatan mengecil) --}}
                @if($number != 4)
                    <div class="absolute top-4 md:top-5 left-1/2 w-full h-[3px] -z-0 
                        {{ $number < 4 ? 'bg-[#1e4d2b]' : 'bg-gray-200' }}">
                    </div>
                @endif

                {{-- BULATAN (Perubahan: Responsif mengecil di HP w-8 md:w-11, text-sm md:text-lg) --}}
                <div class="z-10 flex flex-col items-center">
                    <div class="
                        w-8 h-8 md:w-11 md:h-11 flex items-center justify-center rounded-full text-sm md:text-lg font-bold shadow-sm transition-all duration-300
                        {{ $number <= 3 
                            ? 'bg-[#1e4d2b] text-white' 
                            : ($number == 4 
                                ? 'bg-[#c9a76d] text-white' 
                                : 'bg-gray-200 text-gray-400') 
                        }}
                    ">
                        {{ $number }}
                    </div>

                    {{-- LABEL TEKS (Perubahan Total Biar Gak Tabrakan di HP): 
                         text-[10px] md:text-xs, w-16 sm:w-20 md:w-max, mt-2 md:mt-3, leading-tight, break-words --}}
                    <span class="text-[10px] md:text-xs mt-2 md:mt-3 font-bold text-gray-700 text-center absolute -bottom-8 md:-bottom-8 w-16 sm:w-20 md:w-max leading-tight break-words transition-all duration-300">
                        {{ $label }}
                    </span>
                </div>
            </div>
        @endforeach

    </div>
</div>

{{-- Perubahan Margin & Text-Size Title (text-2xl md:text-3xl, px-4) --}}
<div class="text-center mb-8 px-4">
    <h2 class="text-2xl md:text-3xl font-bold text-[#1E5631]">
        Upload Dokumen Persyaratan
    </h2>
    <p class="text-sm md:text-base text-gray-500 mt-2">
        Langkah 3 : Lengkapi dokumen yang diperlukan untuk proses verifikasi
    </p>
</div>

{{-- Perubahan Padding Kontainer Form (px-4) --}}
<div class="max-w-2xl mx-auto pb-12 px-4">

    <div class="bg-white border rounded-xl p-5 mb-6 shadow-sm">
        <p class="text-sm font-semibold text-[#1E5631] mb-3">Progress Upload</p>
        <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
            <div id="progress-bar" class="bg-[#1E5631] h-2 rounded-full w-0 transition-all duration-300"></div>
        </div>
    </div>


    <form action="{{ route('upload.dokumen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf

        @php
        $dokumen = [
            [
                'judul' => 'Upload foto santri formal 3x4 (background merah)',
                'format' => 'Format: PDF, Max 1 MB'
            ],
            [
                'judul' => 'Upload Akta Kelahiran',
                'format' => 'Format: PDF, Max 1 MB'
            ],
            [
                'judul' => 'Upload Kartu Keluarga',
                'format' => 'Format: PDF, Max 1 MB'
            ],
            [
                'judul' => 'Upload KTP Ayah',
                'format' => 'Format: PDF, Max 1 MB'
            ],
            [
                'judul' => 'Upload KTP Ibu',
                'format' => 'Format: PDF, Max 1 MB'
            ],
            [
                'judul' => 'Upload Sertifikat/Piagam (Opsional)',
                'format' => 'Format: PDF, Max 1 MB'
            ],
        ];
        @endphp

        @php
        $fields = [
        'foto_santri',
        'akta_kelahiran',
        'kartu_keluarga',
        'ktp_ayah',
        'ktp_ibu',
        'sertifikat'
        ];
        @endphp

        @foreach($dokumen as $index => $item)
        <div class="bg-white border rounded-xl p-6 shadow-sm">

            {{-- BLOK PHP DIPINDAH KE ATAS SINI AGAR BISA DIBACA OLEH INPUT DAN TOMBOL --}}
            @php
                $fieldName = $fields[$index];
                $file = $santri->$fieldName ?? null;
                
                // Menentukan nama sub-folder untuk Route Dokumen
                $subFolder = '';
                if ($fieldName == 'foto_santri') $subFolder = 'foto';
                elseif ($fieldName == 'akta_kelahiran') $subFolder = 'akta';
                elseif ($fieldName == 'kartu_keluarga') $subFolder = 'kk';
                elseif ($fieldName == 'ktp_ayah') $subFolder = 'ktp_ayah';
                elseif ($fieldName == 'ktp_ibu') $subFolder = 'ktp_ibu';
                elseif ($fieldName == 'sertifikat') $subFolder = 'sertifikat';
            @endphp

            <div class="flex items-start gap-3 mb-4">
                <div class="w-5 h-5 bg-[#1E5631] rounded-md mt-1 shrink-0"></div>
                <div>
                    <p class="text-sm font-semibold text-[#1E5631]">
                        {{ $item['judul'] }}
                    </p>
                    <p class="text-xs text-gray-400">
                        {{ $item['format'] }}
                    </p>
                </div>
            </div>

            <label class="w-full border border-gray-200 rounded-lg p-6 flex flex-col items-center justify-center text-center text-gray-400 cursor-pointer hover:border-[#2F855A] transition bg-gray-50 mb-3">

                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-7 h-7 mb-2 text-gray-400" 
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M12 12v-8m0 0l-3 3m3-3l3 3" />
                </svg>

                <p class="text-sm text-gray-400">
                    Klik untuk upload dokumen baru
                </p>

                <p class="text-sm text-green-600 mt-2 file-name hidden"></p>
                <p class="text-sm text-red-500 mt-1 error-message hidden"></p>

                {{-- Sekarang $fieldName sudah terbaca dengan aman --}}
                <input type="file" name="{{ $fieldName }}" class="hidden file-input" accept=".jpg,.jpeg,.png,.pdf">

            </label>

            @if($file && $file != '-')
                <div class="flex items-center justify-between bg-green-50 px-4 py-3 rounded-lg border border-green-200 mt-4">
                    <p class="text-green-700 text-sm font-semibold">
                        ✓ Dokumen Tersimpan
                    </p>
                    
                    <a href="{{ route('dokumen.show', ['folder' => $subFolder, 'nama' => basename($file)]) }}" 
                       target="_blank"
                       class="bg-[#1E5631] text-white px-4 py-1.5 rounded-md text-sm hover:bg-[#153e23] transition-colors shadow-sm">
                        Lihat File
                    </a>
                </div>
            @endif

        </div>
        @endforeach
        
        {{-- Perubahan button biar lebar penuh di HP (w-full md:w-auto, px-12 py-3) --}}
        <div class="text-center pt-6">
            <button type="submit"
                class="w-full md:w-auto bg-[#C6A75E] text-white px-12 py-3 rounded-lg font-semibold hover:bg-[#b8954d] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                Kirim Dokumen
            </button>
        </div>

    </form>

</div>

{{-- Script Javascript tetap sama --}}
<script>
document.querySelectorAll('.file-input').forEach((input) => {
    input.addEventListener('change', function() {
        let fileName = this.files[0]?.name;

        let label = this.closest('label');
        let text = label.querySelector('.file-name');

        if(fileName){
            text.textContent = "File: " + fileName;
            text.classList.remove('hidden');
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {

    const inputs = document.querySelectorAll('.file-input');
    const progressBar = document.getElementById('progress-bar');

    function updateProgress() {
        let total = inputs.length;
        let uploaded = 0;

        inputs.forEach(input => {
            if (input.files.length > 0) {
                uploaded++;
            }
        });

        let percent = (uploaded / total) * 100;
        progressBar.style.width = percent + "%";
    }

    inputs.forEach((input) => {
        input.addEventListener('change', function() {

            let file = this.files[0];
            let maxSize = 1024 * 1024; // 1MB

            let label = this.closest('label');
            let fileText = label.querySelector('.file-name');
            let errorText = label.querySelector('.error-message');

            // RESET pesan
            errorText.classList.add('hidden');
            fileText.classList.add('hidden');

            // 🚨 VALIDASI CLIENT-SIDE
            if (file && file.size > maxSize) {
                errorText.textContent = "Ukuran file maksimal 1 MB!";
                errorText.classList.remove('hidden');
                this.value = '';
                return;
            }

            // tampilkan nama file
            if(file){
                fileText.textContent = file.name;
                fileText.classList.remove('hidden');
            }

            updateProgress();
        });
    });

});

</script>

@endsection