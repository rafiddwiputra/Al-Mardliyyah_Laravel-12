@extends('layouts.app')

@section('content')

<!-- STEP PROGRESS -->
<div class="max-w-4xl mx-auto pt-10 mb-12">

    @php
    $labels = ['Buat Akun', 'Login', 'Isi Formulir', 'Upload Dokumen', 'Status Pendaftaran'];
    @endphp

    <div class="flex items-center justify-between relative">

        <!-- GARIS FULL -->
        <div class="absolute top-5 left-0 w-full h-1 bg-gray-200"></div>

        <!-- GARIS AKTIF -->
        <div class="absolute top-5 left-0 h-1 bg-[#1E5631]" style="width: 50%"></div>

        @foreach([1,2,3,4,5] as $step)
        <div class="flex flex-col items-center relative z-10">

            <!-- BULATAN -->
            <div class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-semibold
                {{ $step <= 3 ? 'bg-[#1E5631] text-white' : 'bg-gray-200 text-gray-400' }}">
                {{ $step }}
            </div>

            <!-- LABEL -->
            <p class="mt-2 text-xs
                {{ $step <= 3 ? 'text-[#1E5631] font-medium' : 'text-gray-400' }}">
                {{ $labels[$step-1] }}
            </p>

        </div>
        @endforeach

    </div>

</div>

<!-- TITLE -->
<div class="text-center mb-6">
    <h2 class="text-2xl font-bold text-[#1E5631]">
        Formulir Pendaftaran Santri
    </h2>
    <p class="text-sm text-gray-500">
        Langkah 3 : Lengkapi data calon santri dengan benar dan lengkap
    </p>
</div>

<!-- CONTENT -->
 <div class="max-w-xl mx-auto pb-12">
<form action="/upload-dokumen" method="GET" class="space-y-6">

    <!-- EMAIL -->
    <div class="bg-white border rounded-xl p-5">
        <label class="text-sm font-medium">Email</label>
        <input type="email" required class="w-full mt-2 border rounded-lg px-3 py-2 text-sm" placeholder="email@gmail.com">
    </div>


    <!-- DATA CALON SANTRI -->
    <div class="bg-white border rounded-xl p-6">

    <div class="flex items-start gap-3 mb-4">
                <div class="w-5 h-5 bg-[#1E5631] rounded-md mt-1"></div>
                <h3 class="font-bold text-[#1E5631] mb-4">Data Calon Santri</h3>
    </div>

        <div class="grid grid-cols-2 gap-6 text-sm">

            <div class="col-span-2">
                <label class="font-semibold">Nama Lengkap Santri</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">NISN (Nomor Induk Sekolah)</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Tanggal Lahir</label>
                <input type="date" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">NIK Calon Santri (NIK Sesuai di KK)</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Nomor KK</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div class="col-span-2">
                <label class="font-semibold">Tempat Lahir</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div class="col-span-2">
                <label class="font-semibold">Sekolah Asal</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

        </div>

        <!-- RADIO -->
<div class="grid grid-cols-2 gap-6 mt-6 text-sm">

    <!-- KIRI -->
    <div class="space-y-4">

        <div>
            <p class="mb-2 font-semibold">Jenis Kelamin</p>
            <div class="space-y-1">
                <label class="flex items-center gap-2">
                    <input type="radio" name="jk" required class="accent-[#1E5631]"> Laki-laki
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="jk" class="accent-[#1E5631]"> Perempuan
                </label>
            </div>
        </div>

        <div>
            <p class="mb-2 font-semibold">Jenjang Yang Akan Ditempuh</p>
            <div class="space-y-1">
                <label class="flex items-center gap-2">
                    <input type="radio" name="jenjang" required class="accent-[#1E5631]"> SMP (Khusus Putri)
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="jenjang" class="accent-[#1E5631]"> MTs (Khusus Putra)
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="jenjang" class="accent-[#1E5631]"> MA (Putra/Putri)
                </label>
            </div>
        </div>

    </div>

    <!-- KANAN -->
    <div>
        <p class="mb-2 font-semibold">Dari Mana Mengetahui Pondok</p>
        <div class="space-y-1">
            <label class="flex items-center gap-2"><input type="radio" name="info" required class="accent-[#1E5631]"> Orang Tua</label>
            <label class="flex items-center gap-2"><input type="radio" name="info" class="accent-[#1E5631]"> Tetangga</label>
            <label class="flex items-center gap-2"><input type="radio" name="info" class="accent-[#1E5631]"> Kerabat/Saudara</label>
            <label class="flex items-center gap-2"><input type="radio" name="info" class="accent-[#1E5631]"> Pamflet Sosialisasi</label>
            <label class="flex items-center gap-2"><input type="radio" name="info" class="accent-[#1E5631]"> Alumni</label>
            <label class="flex items-center gap-2"><input type="radio" name="info" class="accent-[#1E5631]"> Thoriqoh</label>
            <label class="flex items-center gap-2"><input type="radio" name="info" class="accent-[#1E5631]"> Sosial Media</label>
            <label class="flex items-center gap-2"><input type="radio" name="info" class="accent-[#1E5631]"> Other</label>
        </div>
    </div>

</div>
</div>

    <!-- DATA ORANG TUA -->
    <div class="bg-white border rounded-xl p-6">

    <div class="flex items-start gap-3 mb-4">
                <div class="w-5 h-5 bg-[#1E5631] rounded-md mt-1"></div>
                <h3 class="font-bold text-[#1E5631] mb-4">Data Orang Tua</h3>
    </div>

        <div class="grid grid-cols-2 gap-4 text-sm">

            <!-- ================= KIRI (AYAH) ================= -->
        <div class="space-y-4">

            <div>
                <label class="font-semibold">Nama Ayah</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">NIK Ayah</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Tanggal Lahir Ayah</label>
                <input type="date" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Pekerjaan Ayah</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <!-- Pendidikan Ayah -->
            <div>
                <p class="mb-2 font-semibold">Pendidikan Terakhir Ayah</p>
                <div class="space-y-1">
                    <label class="flex gap-2"><input type="radio" name="pend_ayah" class="accent-[#1E5631]" required> SD/Sederajat</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ayah" class="accent-[#1E5631]"> SMP/SLTP</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ayah" class="accent-[#1E5631]"> SMA/SLTA</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ayah" class="accent-[#1E5631]"> Diploma III</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ayah" class="accent-[#1E5631]"> Strata I</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ayah" class="accent-[#1E5631]"> Strata II</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ayah" class="accent-[#1E5631]"> Strata III</label>
                </div>
            </div>

            <!-- Penghasilan -->
            <div>
                <p class="mb-2 font-semibold">Penghasilan Orang Tua</p>
                <div class="space-y-1">
                    <label class="flex gap-2"><input type="radio" name="penghasilan" class="accent-[#1E5631]" required> &lt; 500 Ribu</label>
                    <label class="flex gap-2"><input type="radio" name="penghasilan" class="accent-[#1E5631]"> 1 - 2 Juta</label>
                    <label class="flex gap-2"><input type="radio" name="penghasilan" class="accent-[#1E5631]"> 3 - 5 Juta</label>
                    <label class="flex gap-2"><input type="radio" name="penghasilan" class="accent-[#1E5631]"> &gt; 5 Juta</label>
                </div>
            </div>

            <!-- Alamat -->
            <div>
                <label class="font-semibold">Alamat (Sesuai KK)</label>
                <textarea required class="w-full mt-1 border rounded-lg px-3 py-2"></textarea>
            </div>

        </div>

        <!-- ================= KANAN (IBU) ================= -->
        <div class="space-y-4">

            <div>
                <label class="font-semibold">Nama Ibu</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">NIK Ibu</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Tanggal Lahir Ibu</label>
                <input type="date" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Pekerjaan Ibu</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <!-- Pendidikan Ibu -->
            <div>
                <p class="mb-2 font-semibold">Pendidikan Terakhir Ibu</p>
                <div class="space-y-1">
                    <label class="flex gap-2"><input type="radio" name="pend_ibu" class="accent-[#1E5631]" required> SD/Sederajat</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ibu" class="accent-[#1E5631]"> SMP/SLTP</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ibu" class="accent-[#1E5631]"> SMA/SLTA</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ibu" class="accent-[#1E5631]"> Diploma III</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ibu" class="accent-[#1E5631]"> Strata I</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ibu" class="accent-[#1E5631]"> Strata II</label>
                    <label class="flex gap-2"><input type="radio" name="pend_ibu" class="accent-[#1E5631]"> Strata III</label>
                </div>
            </div>

            <div>
                <label class="font-semibold">Nomor WhatsApp</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Kode Pos</label>
                <input type="text" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

        </div>

    </div>

</div>

    <!-- DATA UKURAN -->
    <div class="bg-white border rounded-xl p-6">

    <div class="flex items-start gap-3 mb-4">
                <div class="w-5 h-5 bg-[#1E5631] rounded-md mt-1"></div>
                <h3 class="font-bold text-[#1E5631] mb-4">Data Ukuran Seragam</h3>
    </div>

        <!-- PANDUAN GAMBAR -->
    <div class="grid md:grid-cols-2 gap-6 mb-6 text-center">

        <!-- PUTRA -->
        <div>
            <p class="font-semibold text-[#1E5631] mb-3">
                PANDUAN UKURAN<br> SERAGAM PUTRA
            </p>
            <img src="{{ asset('images/ukuran-putra.jpg') }}"
                 class="w-full rounded-lg shadow border">
        </div>

        <!-- PUTRI -->
        <div>
            <p class="font-semibold text-[#1E5631] mb-3">
                PANDUAN UKURAN<br> SERAGAM PUTRI
            </p>
            <img src="{{ asset('images/ukuran-putri.jpg') }}"
                 class="w-full rounded-lg shadow border">
        </div>

    </div>

    <!-- INSTRUKSI -->
    <p class="font-semibold">
        SILAHKAN TULIS UKURAN SERAGAM SANTRI SESUAI KRITERIA YANG SUDAH TERTERA PADA PANDUAN DI ATAS
        <span class="text-red-500">*</span>
    </p>

    <p class="text-sm text-red-500 mb-4">
        (Format Penulisan = Baju : M , Rok/Celana : 35)
    </p>

    <!-- INPUT -->
    <input type="text"
           required
           placeholder="Contoh: Baju : M, Celana : 32"
           class="w-full border rounded-lg px-3 py-2 text-sm">

</div>

    <!-- BUTTON -->
    <div class="text-center pt-4">
        <button type="submit"
            class="bg-[#C6A75E] text-[#FFFFFF] px-8 py-2 rounded-lg font-semibold">
            Lanjutkan
        </button>
    </div>

</form>

</div>

@endsection