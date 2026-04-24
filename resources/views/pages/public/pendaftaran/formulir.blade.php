@extends('layouts.app')

@section('content')
<script>
    // Paksa browser untuk mengaktifkan kembali scrollbar
    document.body.style.overflow = 'auto';
    document.documentElement.style.overflow = 'auto';
</script>

<div class="max-w-6xl mx-auto py-12 px-4">

<!-- STEP PROGRESS -->
<div class="flex items-center justify-between mb-16 px-10">

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
                    <div class="absolute top-5 left-1/2 w-full h-[3px] -z-0 
                        {{ $number < 3 ? 'bg-[#1e4d2b]' : 'bg-gray-200' }}">
                    </div>
                @endif

                {{-- BULATAN --}}
                <div class="z-10 flex flex-col items-center">
                    <div class="
                        w-11 h-11 flex items-center justify-center rounded-full text-lg font-bold shadow-sm
                        {{ $number <= 2 
                            ? 'bg-[#1e4d2b] text-white' 
                            : ($number == 3 
                                ? 'bg-[#c9a76d] text-white' 
                                : 'bg-gray-200 text-gray-400') 
                        }}
                    ">
                        {{ $number }}
                    </div>

                    <span class="text-xs mt-3 font-bold text-gray-700 text-center absolute -bottom-8 w-max">
                        {{ $label }}
                    </span>
                </div>
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
<form action="{{ route('pendaftaran.store') }}" method="POST" class="space-y-6">
    @csrf

    <!-- EMAIL -->
    <div class="bg-white border rounded-xl p-5">
        <label class="text-sm font-medium">Email</label>
        <input type="email"
       name="email"
       value="{{ $email }}"
       readonly
       class="w-full mt-2 border rounded-lg px-3 py-2 text-sm bg-gray-100">
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
                <input type="text" name="nama_lengkap" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">NISN (Nomor Induk Sekolah)</label>
                <input type="text" name="nisn" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">NIK Calon Santri (NIK Sesuai di KK)</label>
                <input type="text" name="nik" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Nomor KK</label>
                <input type="text" name="nomor_kk" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div class="col-span-2">
                <label class="font-semibold">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div class="col-span-2">
                <label class="font-semibold">Sekolah Asal</label>
                <input type="text" name="sekolah_asal" required class="w-full mt-1 border rounded-lg px-3 py-2">
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
                    <input type="radio" name="jenis_kelamin" value="Putra" required class="accent-[#1E5631]">Laki-laki
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="jenis_kelamin" value="Putri" class="accent-[#1E5631]">Perempuan
                </label>
            </div>
        </div>

        <div>
            <p class="mb-2 font-semibold">Jenjang Yang Akan Ditempuh</p>
            <div class="space-y-1">
                <label class="flex items-center gap-2">
                    <input type="radio" name="jenjang" value="SMP (Khusus Putri)" required class="accent-[#1E5631]">SMP (Khusus Putri)
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="jenjang" value="MTs (Khusus Putra)" class="accent-[#1E5631]">MTs (Khusus Putra)
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="jenjang" value="MA (Putra/Putri)" class="accent-[#1E5631]">MA (Putra/Putri)
                </label>
            </div>
        </div>

    </div>

    <!-- KANAN -->
    <div>
        <p class="mb-2 font-semibold">Dari Mana Mengetahui Pondok</p>
        <div class="space-y-1">
            <label class="flex items-center gap-2"><input type="radio" name="sumber_informasi" value="Orang Tua" required class="accent-[#1E5631]">Orang Tua</label>
            <label class="flex items-center gap-2"><input type="radio" name="sumber_informasi" value="Tetangga" class="accent-[#1E5631]">Tetangga</label>
            <label class="flex items-center gap-2"><input type="radio" name="sumber_informasi" value="Kerabat/Saudara" class="accent-[#1E5631]">Kerabat/Saudara</label>
            <label class="flex items-center gap-2"><input type="radio" name="sumber_informasi" value="Pamflet Sosialisasi" class="accent-[#1E5631]">Pamflet Sosialisasi</label>
            <label class="flex items-center gap-2"><input type="radio" name="sumber_informasi" value="Alumni" class="accent-[#1E5631]">Alumni</label>
            <label class="flex items-center gap-2"><input type="radio" name="sumber_informasi" value="Thoriqoh" class="accent-[#1E5631]">Thoriqoh</label>
            <label class="flex items-center gap-2"><input type="radio" name="sumber_informasi" value="Sosial Media" class="accent-[#1E5631]">Sosial Media</label>
            <label class="flex items-center gap-2"><input type="radio" name="sumber_informasi" value="Other" id="other_radio" class="accent-[#1E5631]">Other</label>
            <div id="other_input_container" class="hidden mt-2">
                <input type="text"
                name="sumber_informasi_lainnya"
                placeholder="Tulis sumber lainnya..."
                class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
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
                <input type="text" name="nama_ayah" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">NIK Ayah</label>
                <input type="text" name="nik_ayah" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Tanggal Lahir Ayah</label>
                <input type="date" name="tanggal_lahir_ayah" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <!-- Pendidikan Ayah -->
            <div>
                <p class="mb-2 font-semibold">Pendidikan Terakhir Ayah</p>
                <div class="space-y-1">
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ayah" value="SD/sederajat" class="accent-[#1E5631]" required>SD/sederajat</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ayah" value="SMP/SLTP/sederajat" class="accent-[#1E5631]">SMP/SLTP/sederajat</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ayah" value="SMA/SLTA/sederajat" class="accent-[#1E5631]">SMA/SLTA/sederajat</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ayah" value="Diploma III" class="accent-[#1E5631]">Diploma III</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ayah" value="Strata I" class="accent-[#1E5631]">Strata I</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ayah" value="Strata II" class="accent-[#1E5631]">Strata II</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ayah" value="Strata III" class="accent-[#1E5631]">Strata III</label>
                </div>
            </div>

            <!-- Penghasilan -->
            <div>
                <p class="mb-2 font-semibold">Penghasilan Orang Tua</p>
                <div class="space-y-1">
                    <label class="flex gap-2"><input type="radio" name="penghasilan_ortu" value="<500 Ribu" class="accent-[#1E5631]" required>&lt; 500 Ribu</label>
                    <label class="flex gap-2"><input type="radio" name="penghasilan_ortu" value="1-2 Juta" class="accent-[#1E5631]">1 - 2 Juta</label>
                    <label class="flex gap-2"><input type="radio" name="penghasilan_ortu" value="3-5 Juta" class="accent-[#1E5631]">3 - 5 Juta</label>
                    <label class="flex gap-2"><input type="radio" name="penghasilan_ortu" value=">5 Juta" class="accent-[#1E5631]">&gt; 5 Juta</label>
                </div>
            </div>

            <!-- Alamat -->
            <div>
                <label class="font-semibold">Alamat (Sesuai KK)</label>
                <textarea name="alamat" required class="w-full mt-1 border rounded-lg px-3 py-2"></textarea>
            </div>

        </div>

        <!-- ================= KANAN (IBU) ================= -->
        <div class="space-y-4">

            <div>
                <label class="font-semibold">Nama Ibu</label>
                <input type="text" name="nama_ibu" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">NIK Ibu</label>
                <input type="text" name="nik_ibu" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Tanggal Lahir Ibu</label>
                <input type="date" name="tanggal_lahir_ibu" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <!-- Pendidikan Ibu -->
            <div>
                <p class="mb-2 font-semibold">Pendidikan Terakhir Ibu</p>
                <div class="space-y-1">
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ibu" value="SD/sederajat" class="accent-[#1E5631]" required>SD/sederajat</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ibu" value="SMP/SLTP/sederajat" class="accent-[#1E5631]">SMP/SLTP/sederajat</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ibu" value="SMA/SLTA/sederajat" class="accent-[#1E5631]">SMA/SLTA/sederajat</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ibu" value="Diploma III" class="accent-[#1E5631]">Diploma III</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ibu" value="Strata I" class="accent-[#1E5631]">Strata I</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ibu" value="Strata II" class="accent-[#1E5631]">Strata II</label>
                    <label class="flex gap-2"><input type="radio" name="pendidikan_terakhir_ibu" value="Strata III" class="accent-[#1E5631]">Strata III</label>
                </div>
            </div>

            <div>
                <label class="font-semibold">Nomor WhatsApp</label>
                <input type="text" name="no_hp" required class="w-full mt-1 border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="font-semibold">Kode Pos</label>
                <input type="text" name="kode_pos" required class="w-full mt-1 border rounded-lg px-3 py-2">
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

<div class="text-sm">
<!-- UKURAN PUTRA -->
<div id="ukuran_putra" class="hidden grid grid-cols-2 gap-4">

    <div>
        <label class="font-semibold">Ukuran Baju Putra</label>
        <select name="ukuran_baju_putra" class="w-full mt-1 border rounded-lg px-3 py-2">
            <option value="">Pilih ukuran</option>
            <option>XS</option>
            <option>S</option>
            <option>M</option>
            <option>L</option>
            <option>XL</option>
            <option>XXL</option>
            <option>XXXL</option>
        </select>
    </div>

    <div>
        <label class="font-semibold">Ukuran Celana Putra</label>
        <select name="ukuran_celana_putra" class="w-full mt-1 border rounded-lg px-3 py-2">
            <option value="">Pilih ukuran</option>
            @for ($i = 27; $i <= 38; $i++)
                <option>{{ $i }}</option>
            @endfor
        </select>
    </div>

</div>

<!-- UKURAN PUTRI -->
<div id="ukuran_putri" class="hidden grid grid-cols-2 gap-4">

    <div>
        <label class="font-semibold">Ukuran Baju Putri</label>
        <select name="ukuran_baju_putri" class="w-full mt-1 border rounded-lg px-3 py-2">
            <option value="">Pilih ukuran</option>
            <option>S</option>
            <option>M</option>
            <option>L</option>
            <option>XL</option>
            <option>XXL</option>
            <option>XXXL</option>
            <option>XXXXL</option>
        </select>
    </div>

    <div>
        <label class="font-semibold">Ukuran Rok Putri</label>
        <select name="ukuran_rok_putri" class="w-full mt-1 border rounded-lg px-3 py-2">
            <option value="">Pilih ukuran</option>
            @for ($i = 33; $i <= 40; $i++)
                <option>{{ $i }}</option>
            @endfor
        </select>
    </div>

</div>
</div>

    <!-- BUTTON -->
    <div class="text-center pt-4">

        @if($status)
            <button type="submit"
                class="bg-[#C6A75E] text-white px-8 py-2 rounded-lg font-semibold">
                Lanjutkan
            </button>
        @else
            <button type="button" disabled
                class="bg-gray-400 text-white px-8 py-2 rounded-lg font-semibold cursor-not-allowed">
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
</script>

@endsection