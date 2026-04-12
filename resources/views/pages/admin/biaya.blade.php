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

    <div class="flex justify-end mb-4">
    <button onclick="showTambah()"
        class="bg-[#1E5631] text-white px-4 py-2 rounded-md text-sm">
        + Tambah Biaya
    </button>
</div>

    <div id="formTambah" class="hidden mb-6">
    <form action="{{ route('admin.biaya.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-xl shadow p-5">

            <input type="text" name="judul"
                placeholder="Judul biaya"
                class="w-full border mb-3 px-3 py-2 text-sm">

            <input type="number" name="deskripsi"
                placeholder="Nominal biaya"
                class="w-full border mb-3 px-3 py-2 text-sm">

            <div class="flex gap-2">
                <button type="submit"
                    class="bg-[#1E5631] text-white px-4 py-2 rounded text-sm">
                    Simpan
                </button>

                <button type="button" onclick="hideTambah()"
                    class="bg-gray-400 text-white px-4 py-2 rounded text-sm">
                    Batal
                </button>
            </div>

        </div>
    </form>
</div>

    <!-- GRID -->
    <div class="grid md:grid-cols-2 gap-6 mb-6">

        @foreach($biaya as $item)
<div class="bg-white rounded-xl shadow p-5 relative">

    <div class="absolute left-0 top-0 h-full w-1 bg-[#1E5631] rounded-l-xl"></div>

    <div class="ml-2">

        <p class="text-sm font-bold text-[#1E5631] mb-1">
            {{ $item->judul }}
        </p>

        <!-- FORM UPDATE -->
        <form action="{{ route('admin.biaya.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <p id="text-{{ $item->id }}"
               class="text-lg font-bold text-[#C6A75E] mb-4">
                Rp {{ number_format($item->deskripsi,0,',','.') }}
            </p>

            <input id="input-{{ $item->id }}"
                   type="number"
                   name="deskripsi"
                   value="{{ $item->deskripsi }}"
                   class="hidden w-full border border-[#C6A75E] px-3 py-2 mb-4 text-sm">

            <div class="flex gap-2">

                <button type="button"
                    id="editBtn-{{ $item->id }}"
                    onclick="startEdit({{ $item->id }})"
                    class="w-full bg-[#1E5631] text-white py-2 rounded-md text-sm">
                    Edit
                </button>

                <button type="submit"
                    id="saveBtn-{{ $item->id }}"
                    class="hidden w-full bg-[#1E5631] text-white py-2 rounded-md text-sm">
                    Simpan
                </button>

                <button type="button"
                    id="cancelBtn-{{ $item->id }}"
                    onclick="cancelEdit({{ $item->id }})"
                    class="hidden w-full bg-gray-400 text-white py-2 rounded-md text-sm">
                    Batal
                </button>

            </div>
        </form>

        <!-- FORM DELETE (WAJIB DI LUAR) -->
        <form action="{{ route('admin.biaya.destroy', $item->id) }}" method="POST"
            onsubmit="return confirm('Yakin mau hapus data ini?')"
            class="mt-2">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="w-full bg-red-600 text-white py-2 rounded-md text-sm">
                Hapus
            </button>
        </form>

    </div>

</div>
@endforeach

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

function showTambah() {
    document.getElementById('formTambah').classList.remove('hidden');
}

function hideTambah() {
    document.getElementById('formTambah').classList.add('hidden');
}
</script>

@endsection