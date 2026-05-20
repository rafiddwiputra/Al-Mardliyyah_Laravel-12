@extends('layouts.app')

@section('content')
<script>
    // Paksa browser untuk mengaktifkan kembali scrollbar
    document.body.style.overflow = 'auto';
    document.documentElement.style.overflow = 'auto';
</script>

<div class="max-w-6xl mx-auto py-12 px-4">

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
                
                {{-- GARIS PENGHUBUNG --}}
                @if($number != 4)
                    <div class="absolute top-4 md:top-5 left-1/2 w-full h-[3px] -z-0 
                        {{ $number < 3 ? 'bg-[#1e4d2b]' : 'bg-gray-200' }}">
                    </div>
                @endif

                {{-- BULATAN (Responsif mengecil di HP) --}}
                <div class="z-10 flex flex-col items-center">
                    <div class="
                        w-8 h-8 md:w-11 md:h-11 flex items-center justify-center rounded-full text-sm md:text-lg font-bold shadow-sm
                        {{ $number <= 2 
                            ? 'bg-[#1e4d2b] text-white' 
                            : ($number == 3 
                                ? 'bg-[#c9a76d] text-white' 
                                : 'bg-gray-200 text-gray-400') 
                        }}
                    ">
                        {{ $number }}
                    </div>

                    {{-- LABEL TEKS (Responsif wrap di HP) --}}
                    <span class="text-[10px] md:text-xs mt-2 md:mt-3 font-bold text-gray-700 text-center absolute -bottom-8 md:-bottom-8 w-16 sm:w-20 md:w-max leading-tight break-words">
                        {{ $label }}
                    </span>
                </div>
            </div>
        @endforeach

</div>
</div>

<div class="text-center mb-6 px-4">
    <h2 class="text-2xl font-bold text-[#1E5631]">
        Formulir Pendaftaran Santri
    </h2>
    <p class="text-sm text-gray-500 mt-2">
        Langkah 3 : Lengkapi data calon santri dengan benar dan lengkap
    </p>
</div>

<div class="max-w-3xl mx-auto pb-12 px-4">

@if ($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-5 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('pendaftaran.store') }}" method="POST" class="space-y-6">
    @csrf

    <div class="bg-white border rounded-xl p-5 shadow-sm">
        <label class="text-sm font-medium">Email Pendaftar</label>
        <input type="email"
       name="email"
       value="{{ $email }}"
       readonly
       class="w-full mt-2 border rounded-lg px-3 py-2 text-sm bg-gray-100 text-gray-600 cursor-not-allowed">
    </div>


    <div class="bg-white border rounded-xl p-6 shadow-sm">

    <div class="flex items-start gap-3 mb-6">
                <div class="w-5 h-5 bg-[#1E5631] rounded-md mt-0.5"></div>
                <h3 class="font-bold text-[#1E5631] text-lg">Data Calon Santri</h3>
    </div>

        {{-- Mengubah grid menjadi responsif (1 kolom di HP, 2 kolom di PC) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">

            <div class="col-span-1 md:col-span-2">
                <label class="font-semibold">Nama Lengkap Santri</label>
                <input type="text" name="nama_lengkap" 
                value="{{ old('nama_lengkap', $data->nama_lengkap ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <label class="font-semibold">NISN (Nomor Induk Siswa Nasional)</label>
                <input type="text" name="nisn" 
                value="{{ old('nisn', $data->nisn ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <label class="font-semibold">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" 
                value="{{ old('tanggal_lahir', $data->tanggal_lahir ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <label class="font-semibold">NIK Calon Santri (Sesuai KK)</label>
                <input type="text" name="nik" 
                value="{{ old('nik', $data->nik ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <label class="font-semibold">Nomor Kartu Keluarga (KK)</label>
                <input type="text" name="nomor_kk" 
                value="{{ old('nomor_kk', $data->nomor_kk ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div class="col-span-1 md:col-span-2">
                <label class="font-semibold">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" 
                value="{{ old('tempat_lahir', $data->tempat_lahir ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div class="col-span-1 md:col-span-2">
                <label class="font-semibold">Sekolah Asal</label>
                <input type="text" name="sekolah_asal" 
                value="{{ old('sekolah_asal', $data->sekolah_asal ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 text-sm border-t pt-6">

            <div class="space-y-4">

                <div>
                    <p class="mb-2 font-semibold">Jenis Kelamin</p>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_kelamin" value="Putra" 
                            {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Putra' ? 'checked' : '' }}
                            required class="accent-[#1E5631] w-4 h-4">Laki-laki
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_kelamin" value="Putri" 
                            {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Putri' ? 'checked' : '' }}
                            class="accent-[#1E5631] w-4 h-4">Perempuan
                        </label>
                    </div>
                </div>

                <div>
                    <p class="mb-2 font-semibold">Jenjang Yang Akan Ditempuh</p>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenjang" value="SMP (Khusus Putri)" 
                            {{ old('jenjang', $data->jenjang ?? '') == 'SMP (Khusus Putri)' ? 'checked' : '' }}
                            required class="accent-[#1E5631] w-4 h-4">SMP (Khusus Putri)
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenjang" value="MTs (Khusus Putra)" 
                            {{ old('jenjang', $data->jenjang ?? '') == 'MTs (Khusus Putra)' ? 'checked' : '' }}
                            class="accent-[#1E5631] w-4 h-4">MTs (Khusus Putra)
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenjang" value="MA (Putra/Putri)" 
                            {{ old('jenjang', $data->jenjang ?? '') == 'MA (Putra/Putri)' ? 'checked' : '' }}
                            class="accent-[#1E5631] w-4 h-4">MA (Putra/Putri)
                        </label>
                    </div>
                </div>

            </div>

            <div>
                <p class="mb-2 font-semibold">Dari Mana Mengetahui Pondok</p>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="sumber_informasi" value="Orang Tua" {{ old('sumber_informasi', $data->sumber_informasi ?? '') == 'Orang Tua' ? 'checked' : '' }} required class="accent-[#1E5631] w-4 h-4">Orang Tua</label>
                    <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="sumber_informasi" value="Tetangga" {{ old('sumber_informasi', $data->sumber_informasi ?? '') == 'Tetangga' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Tetangga</label>
                    <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="sumber_informasi" value="Kerabat/Saudara" {{ old('sumber_informasi', $data->sumber_informasi ?? '') == 'Kerabat/Saudara' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Kerabat/Saudara</label>
                    <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="sumber_informasi" value="Pamflet Sosialisasi" {{ old('sumber_informasi', $data->sumber_informasi ?? '') == 'Pamflet Sosialisasi' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Pamflet Sosialisasi</label>
                    <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="sumber_informasi" value="Alumni" {{ old('sumber_informasi', $data->sumber_informasi ?? '') == 'Alumni' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Alumni</label>
                    <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="sumber_informasi" value="Thoriqoh" {{ old('sumber_informasi', $data->sumber_informasi ?? '') == 'Thoriqoh' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Thoriqoh</label>
                    <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="sumber_informasi" value="Sosial Media"{{ old('sumber_informasi', $data->sumber_informasi ?? '') == 'Sosial Media' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Sosial Media</label>
                    <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="sumber_informasi" value="Other" id="other_radio" {{ !in_array(old('sumber_informasi', $data->sumber_informasi ?? ''), ['Orang Tua','Tetangga','Kerabat/Saudara','Pamflet Sosialisasi','Alumni','Thoriqoh','Sosial Media']) ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Lainnya</label>
                    
                    <div id="other_input_container" class="hidden mt-2 ml-6">
                        <input type="text"
                        name="sumber_informasi_lainnya"
                        placeholder="Tulis sumber lainnya..."
                        value="{{ old('sumber_informasi_lainnya') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-white border rounded-xl p-6 shadow-sm">

    <div class="flex items-start gap-3 mb-6">
                <div class="w-5 h-5 bg-[#1E5631] rounded-md mt-0.5"></div>
                <h3 class="font-bold text-[#1E5631] text-lg">Data Orang Tua</h3>
    </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-6 text-sm">

            <div class="space-y-4">
            <h4 class="font-bold text-gray-700 border-b pb-2">Data Ayah</h4>
            <div>
                <label class="font-semibold">Nama Ayah</label>
                <input type="text" name="nama_ayah" 
                value="{{ old('nama_ayah', $data->ortu->nama_ayah ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <label class="font-semibold">NIK Ayah</label>
                <input type="text" name="nik_ayah" 
                value="{{ old('nik_ayah', $data->ortu->nik_ayah ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <label class="font-semibold">Tanggal Lahir Ayah</label>
                <input type="date" name="tanggal_lahir_ayah" 
                value="{{ old('tanggal_lahir_ayah', $data->ortu->tanggal_lahir_ayah ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <label class="font-semibold">Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" 
                value="{{ old('pekerjaan_ayah', $data->ortu->pekerjaan_ayah ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <p class="mb-2 font-semibold">Pendidikan Terakhir Ayah</p>
                <div class="space-y-2">
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ayah" value="SD/sederajat" class="accent-[#1E5631] w-4 h-4" {{ old('pendidikan_terakhir_ayah', $data->ortu->pendidikan_terakhir_ayah ?? '') == 'SD/sederajat' ? 'checked' : '' }} required>SD/sederajat</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ayah" value="SMP/SLTP/sederajat" {{ old('pendidikan_terakhir_ayah', $data->ortu->pendidikan_terakhir_ayah ?? '') == 'SMP/SLTP/sederajat' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">SMP/SLTP/sederajat</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ayah" value="SMA/SLTA/sederajat" {{ old('pendidikan_terakhir_ayah', $data->ortu->pendidikan_terakhir_ayah ?? '') == 'SMA/SLTA/sederajat' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">SMA/SLTA/sederajat</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ayah" value="Diploma III" {{ old('pendidikan_terakhir_ayah', $data->ortu->pendidikan_terakhir_ayah ?? '') == 'Diploma III' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Diploma III</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ayah" value="Strata I" {{ old('pendidikan_terakhir_ayah', $data->ortu->pendidikan_terakhir_ayah ?? '') == 'Strata I' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Strata I</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ayah" value="Strata II" {{ old('pendidikan_terakhir_ayah', $data->ortu->pendidikan_terakhir_ayah ?? '') == 'Strata II' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Strata II</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ayah" value="Strata III" {{ old('pendidikan_terakhir_ayah', $data->ortu->pendidikan_terakhir_ayah ?? '') == 'Strata III' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Strata III</label>
                </div>
            </div>

            <div>
                <p class="mb-2 font-semibold">Penghasilan Orang Tua (Gabungan)</p>
                <div class="space-y-2">
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="penghasilan_ortu" value="<500 Ribu" {{ old('penghasilan_ortu', $data->ortu->penghasilan_ortu ?? '') == '<500 Ribu' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4" required>&lt; 500 Ribu</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="penghasilan_ortu" value="1-2 Juta" {{ old('penghasilan_ortu', $data->ortu->penghasilan_ortu ?? '') == '1-2 Juta' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">1 - 2 Juta</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="penghasilan_ortu" value="3-5 Juta" {{ old('penghasilan_ortu', $data->ortu->penghasilan_ortu ?? '') == '3-5 Juta' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">3 - 5 Juta</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="penghasilan_ortu" value=">5 Juta" {{ old('penghasilan_ortu', $data->ortu->penghasilan_ortu ?? '') == '>5 Juta' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">&gt; 5 Juta</label>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="font-semibold">Alamat Lengkap (Sesuai KK)</label>
                <textarea name="alamat" required class="w-full mt-1 border rounded-lg px-3 py-2 h-24 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">{{ old('alamat', $data->ortu->alamat ?? '') }}</textarea>
            </div>

        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-700 border-b pb-2">Data Ibu</h4>
            <div>
                <label class="font-semibold">Nama Ibu</label>
                <input type="text" name="nama_ibu" 
                value="{{ old('nama_ibu', $data->ortu->nama_ibu ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <label class="font-semibold">NIK Ibu</label>
                <input type="text" name="nik_ibu" 
                value="{{ old('nik_ibu', $data->ortu->nik_ibu ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <label class="font-semibold">Tanggal Lahir Ibu</label>
                <input type="date" name="tanggal_lahir_ibu" 
                value="{{ old('tanggal_lahir_ibu', $data->ortu->tanggal_lahir_ibu ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <label class="font-semibold">Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" 
                value="{{ old('pekerjaan_ibu', $data->ortu->pekerjaan_ibu ?? '') }}"
                required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <p class="mb-2 font-semibold">Pendidikan Terakhir Ibu</p>
                <div class="space-y-2">
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ibu" value="SD/sederajat" {{ old('pendidikan_terakhir_ibu', $data->ortu->pendidikan_terakhir_ibu ?? '') == 'SD/sederajat' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4" required>SD/sederajat</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ibu" value="SMP/SLTP/sederajat" {{ old('pendidikan_terakhir_ibu', $data->ortu->pendidikan_terakhir_ibu ?? '') == 'SMP/SLTP/sederajat' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">SMP/SLTP/sederajat</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ibu" value="SMA/SLTA/sederajat" {{ old('pendidikan_terakhir_ibu', $data->ortu->pendidikan_terakhir_ibu ?? '') == 'SMA/SLTA/sederajat' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">SMA/SLTA/sederajat</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ibu" value="Diploma III" {{ old('pendidikan_terakhir_ibu', $data->ortu->pendidikan_terakhir_ibu ?? '') == 'Diploma III' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Diploma III</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ibu" value="Strata I" {{ old('pendidikan_terakhir_ibu', $data->ortu->pendidikan_terakhir_ibu ?? '') == 'Strata I' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Strata I</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ibu" value="Strata II" {{ old('pendidikan_terakhir_ibu', $data->ortu->pendidikan_terakhir_ibu ?? '') == 'Strata II' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Strata II</label>
                    <label class="flex gap-2 cursor-pointer"><input type="radio" name="pendidikan_terakhir_ibu" value="Strata III" {{ old('pendidikan_terakhir_ibu', $data->ortu->pendidikan_terakhir_ibu ?? '') == 'Strata III' ? 'checked' : '' }} class="accent-[#1E5631] w-4 h-4">Strata III</label>
                </div>
            </div>

            <div>
                <label class="font-semibold">Nomor WhatsApp Aktif</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $data->ortu->no_hp ?? '') }}" required class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

            <div>
                <label class="font-semibold">Kode Pos</label>
                <input type="text" 
                    name="kode_pos" 
                    value="{{ old('kode_pos', $data->ortu->kode_pos ?? '') }}" 
                    required 
                    maxlength="5" 
                    inputmode="numeric"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    placeholder="Contoh: 63111"
                    class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            </div>

        </div>

        </div>

    </div>

    <div class="bg-white border rounded-xl p-6 shadow-sm">

    <div class="flex items-start gap-3 mb-6">
                <div class="w-5 h-5 bg-[#1E5631] rounded-md mt-0.5"></div>
                <h3 class="font-bold text-[#1E5631] text-lg">Data Ukuran Seragam</h3>
    </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 text-center">

        <div>
            <p class="font-semibold text-[#1E5631] mb-3 text-sm md:text-base">
                PANDUAN UKURAN<br> SERAGAM PUTRA
            </p>
            <img src="{{ asset('images/ukuran-putra.jpg') }}"
                 class="w-full rounded-lg shadow border object-cover">
        </div>

        <div>
            <p class="font-semibold text-[#1E5631] mb-3 text-sm md:text-base">
                PANDUAN UKURAN<br> SERAGAM PUTRI
            </p>
            <img src="{{ asset('images/ukuran-putri.jpg') }}"
                 class="w-full rounded-lg shadow border object-cover">
        </div>

    </div>

<div class="text-sm">
<div id="ukuran_putra" class="hidden grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg border">

    <div>
        <label class="font-semibold">Ukuran Baju Putra</label>
        <select name="ukuran_baju_putra" class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            <option value="">Pilih ukuran</option>
            <option {{ old('ukuran_baju_putra', $data->ukuran_baju_putra ?? '') == 'XS' ? 'selected' : '' }}>XS</option>
            <option {{ old('ukuran_baju_putra', $data->ukuran_baju_putra ?? '') == 'S' ? 'selected' : '' }}>S</option>
            <option {{ old('ukuran_baju_putra', $data->ukuran_baju_putra ?? '') == 'M' ? 'selected' : '' }}>M</option>
            <option {{ old('ukuran_baju_putra', $data->ukuran_baju_putra ?? '') == 'L' ? 'selected' : '' }}>L</option>
            <option {{ old('ukuran_baju_putra', $data->ukuran_baju_putra ?? '') == 'XL' ? 'selected' : '' }}>XL</option>
            <option {{ old('ukuran_baju_putra', $data->ukuran_baju_putra ?? '') == 'XXL' ? 'selected' : '' }}>XXL</option>
            <option {{ old('ukuran_baju_putra', $data->ukuran_baju_putra ?? '') == 'XXXL' ? 'selected' : '' }}>XXXL</option>
        </select>
    </div>

    <div>
        <label class="font-semibold">Ukuran Celana Putra</label>
        <select name="ukuran_celana_putra" class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            <option value="">Pilih ukuran</option>
            @for ($i = 27; $i <= 38; $i++)
                <option {{ old('ukuran_celana_putra', $data->ukuran_celana_putra ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
    </div>

</div>

<div id="ukuran_putri" class="hidden grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg border">

    <div>
        <label class="font-semibold">Ukuran Baju Putri</label>
        <select name="ukuran_baju_putri" class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            <option value="">Pilih ukuran</option>
            <option {{ old('ukuran_baju_putri', $data->ukuran_baju_putri ?? '') == 'S' ? 'selected' : '' }}>S</option>
            <option {{ old('ukuran_baju_putri', $data->ukuran_baju_putri ?? '') == 'M' ? 'selected' : '' }}>M</option>
            <option {{ old('ukuran_baju_putri', $data->ukuran_baju_putri ?? '') == 'L' ? 'selected' : '' }}>L</option>
            <option {{ old('ukuran_baju_putri', $data->ukuran_baju_putri ?? '') == 'XL' ? 'selected' : '' }}>XL</option>
            <option {{ old('ukuran_baju_putri', $data->ukuran_baju_putri ?? '') == 'XXL' ? 'selected' : '' }}>XXL</option>
            <option {{ old('ukuran_baju_putri', $data->ukuran_baju_putri ?? '') == 'XXXL' ? 'selected' : '' }}>XXXL</option>
            <option {{ old('ukuran_baju_putri', $data->ukuran_baju_putri ?? '') == 'XXXXL' ? 'selected' : '' }}>XXXXL</option>
        </select>
    </div>

    <div>
        <label class="font-semibold">Ukuran Rok Putri</label>
        <select name="ukuran_rok_putri" class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-1 focus:ring-[#1E5631] focus:outline-none">
            <option value="">Pilih ukuran</option>
            @for ($i = 33; $i <= 40; $i++)
                <option {{ old('ukuran_rok_putri', $data->ukuran_rok_putri ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
    </div>

</div>
</div>
</div>

    <div class="text-center pt-8">

        @if($status)
            <button type="submit"
                class="w-full md:w-auto bg-[#C6A75E] text-white px-12 py-3 rounded-lg font-semibold hover:bg-[#b8954d] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                Simpan & Lanjutkan
            </button>
        @else
            <button type="button" disabled
                class="w-full md:w-auto bg-gray-400 text-white px-12 py-3 rounded-lg font-semibold cursor-not-allowed">
                Pendaftaran Ditutup
            </button>
        @endif

    </div>

</form>

</div>

<script>
    const radios = document.querySelectorAll('input[name="sumber_informasi"]');
    const otherInput = document.getElementById('other_input_container');

    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'Other') {
                otherInput.classList.remove('hidden');
            } else {
                otherInput.classList.add('hidden');
            }
        });
    });

    const genderRadios = document.querySelectorAll('input[name="jenis_kelamin"]');
    const ukuranPutra = document.getElementById('ukuran_putra');
    const ukuranPutri = document.getElementById('ukuran_putri');

    genderRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'Putra') {
                ukuranPutra.classList.remove('hidden');
                ukuranPutri.classList.add('hidden');
            } else if (this.value === 'Putri') {
                ukuranPutri.classList.remove('hidden');
                ukuranPutra.classList.add('hidden');
            }
        });
    });

window.addEventListener('DOMContentLoaded', function () {
    const selectedGender = document.querySelector('input[name="jenis_kelamin"]:checked');

    if (selectedGender) {
        if (selectedGender.value === 'Putra') {
            ukuranPutra.classList.remove('hidden');
        } else if (selectedGender.value === 'Putri') {
            ukuranPutri.classList.remove('hidden');
        }
    }
});
</script>

@endsection