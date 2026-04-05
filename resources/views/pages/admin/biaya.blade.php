@extends('layouts.admin')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold text-[#1E5631]">
        Biaya Pendidikan
    </h2>
    <p class="text-sm text-gray-500 mb-6">
        Kelola informasi biaya pendidikan pondok
    </p>

    @php
    $biaya = [
        ['id'=>1,'judul'=>'Biaya Pendaftaran','harga'=>'150000'],
        ['id'=>2,'judul'=>'Biaya Perlengkapan Santri','harga'=>'2500000'],
        ['id'=>3,'judul'=>'SPP Bulanan','harga'=>'750000'],
        ['id'=>4,'judul'=>'Biaya Asrama','harga'=>'500000'],
    ];
    @endphp

    <!-- GRID -->
    <div class="grid md:grid-cols-2 gap-6 mb-6">

        @foreach($biaya as $item)
        <div class="bg-white rounded-xl shadow p-5 relative">

            <!-- GARIS KIRI -->
            <div class="absolute left-0 top-0 h-full w-1 bg-[#1E5631] rounded-l-xl"></div>

            <div class="ml-2">

                <p class="text-sm font-bold text-[#1E5631] mb-1">
                    {{ $item['judul'] }}
                </p>

                <!-- TEXT MODE -->
                <p id="text-{{ $item['id'] }}"
                   class="text-lg font-bold text-[#C6A75E] mb-4">
                    RP {{ number_format($item['harga'],0,',','.') }}
                </p>

                <!-- INPUT MODE -->
                <input id="input-{{ $item['id'] }}"
                       type="number"
                       value="{{ $item['harga'] }}"
                       class="hidden w-full border border-[#C6A75E] text-[#1E5631] px-3 py-2 mb-4 text-sm">

                <!-- BUTTON -->
                <div class="flex gap-2">

    <!-- EDIT -->
    <button id="editBtn-{{ $item['id'] }}"
        onclick="startEdit({{ $item['id'] }})"
        class="w-full bg-[#1E5631] font-bold text-white py-2 rounded-md text-sm">
        Edit
    </button>

    <!-- SIMPAN -->
    <button id="saveBtn-{{ $item['id'] }}"
        onclick="cancelEdit({{ $item['id'] }})"
        class="hidden w-full bg-[#1E5631] font-bold text-white py-2 rounded-md text-sm">
        Simpan
    </button>

    <!-- BATAL -->
    <button id="cancelBtn-{{ $item['id'] }}"
        onclick="cancelEdit({{ $item['id'] }})"
        class="hidden w-full bg-[#D9D9D9] border border-gray-300 font-bold text-[#FFFFFF] py-2 rounded-md text-sm">
        Batal
    </button>

</div>

            </div>

        </div>
        @endforeach

    </div>

    <!-- NOTE -->
    <div class="bg-[#EBFFE8] border border-[#D9D9D9] rounded-xl p-5">

        <p class="text-xs font-bold text-[#1E5631] mb-4">
            Catatan: Perubahan biaya akan berlaku untuk pendaftar baru
        </p>

        <button class="bg-[#1E5631] font-bold text-white px-6 py-2 rounded-lg text-sm">
            Simpan Semua Perubahan
        </button>

    </div>

</div>

<script>
function startEdit(id){
    document.getElementById('text-'+id).classList.add('hidden');
    document.getElementById('input-'+id).classList.remove('hidden');

    document.getElementById('editBtn-'+id).classList.add('hidden');
    document.getElementById('saveBtn-'+id).classList.remove('hidden');
    document.getElementById('cancelBtn-'+id).classList.remove('hidden');
}

function cancelEdit(id){
    document.getElementById('text-'+id).classList.remove('hidden');
    document.getElementById('input-'+id).classList.add('hidden');

    document.getElementById('editBtn-'+id).classList.remove('hidden');
    document.getElementById('saveBtn-'+id).classList.add('hidden');
    document.getElementById('cancelBtn-'+id).classList.add('hidden');
}
</script>

@endsection