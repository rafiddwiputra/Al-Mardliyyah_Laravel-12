<!DOCTYPE html>
<html>
<head>
    <title>Data Pendaftar</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
        }

        .card {
            border: 1px solid #000;
            padding: 8px;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .header {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 12px;
        }

        .row {
            display: table;
            width: 100%;
            border-top: 1px solid #000;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
        }

        .row:last-child {
            border-bottom: 1px solid #000;
        }

        .col {
            display: table-cell;
            width: 33.33%;
            padding: 4px 8px;
            border-right: 1px solid #000;
            vertical-align: top;
        }

        .col:last-child {
            border-right: none;
        }

        .full {
            display: table-cell;
            width: 100%;
            padding: 4px 6px;
            text-align: center;
            font-weight: bold;
            font-size: 11px;
        }

        .label {
            display: inline-block;
            min-width: 100px; 
            font-weight: bold;
        }

        .wrap {
            word-break: break-word;
            white-space: normal;
        }

    </style>
</head>
<body>

<h3>Data Pendaftar</h3>

@foreach($data as $item)
<div class="card">

    <!-- HEADER -->
    <div class="header">
        {{ 'PSB' . str_pad($item->id, 3, '0', STR_PAD_LEFT) }} - 
        {{ $item->nama_lengkap }} ({{ ucfirst($item->status) }})
    </div>

    <!-- DATA DIRI TITLE -->
    <div class="row">
        <div class="full">Data Diri</div>
    </div>

    <!-- DATA DIRI -->
    <div class="row">
        <div class="col"><span class="label">NISN:</span> {{ $item->nisn ?? '-' }}</div>
        <div class="col"><span class="label">Jenis Kelamin:</span> {{ $item->jenis_kelamin }}</div>
        <div class="col"><span class="label">Sumber Informasi:</span> {{ $item->sumber_informasi }}</div>
        
    </div>

    <div class="row">
        <div class="col"><span class="label">NIK:</span> {{ $item->nik ?? '-' }}</div>
        <div class="col"><span class="label">TTL:</span> {{ $item->tempat_lahir }}, {{ $item->tanggal_lahir }}</div>
        <div class="col"><span class="label">Sekolah Asal:</span> {{ $item->sekolah_asal }}</div>
    </div>

    <div class="row">
        <div class="col"><span class="label">No KK:</span> {{ $item->nomor_kk }}</div>
        <div class="col"><span class="label">Jenjang:</span> {{ $item->program->nama_program ?? '-' }}</div>  
        <div class="col"><span class="label">Tanggal Pendaftaran:</span> {{ $item->created_at ? $item->created_at->format('d/m/Y') : '-' }}</div>
    </div>

    <div class="row">
        <div class="col">
            <span class="label">Ukuran Putra:</span> 
            {{ $item->ukuran_baju_putra ?? '-' }}/{{ $item->ukuran_celana_putra ?? '-' }}
        </div>
        <div class="col">
            <span class="label">Ukuran Putri:</span> 
            {{ $item->ukuran_baju_putri ?? '-' }}/{{ $item->ukuran_rok_putri ?? '-' }}
        </div>
        <div class="col"></div>
    </div>

    <!-- DATA ORTU TITLE -->
    <div class="row">
        <div class="full">Data Orang Tua</div>
    </div>

    <!-- DATA ORTU  -->
    <div class="row">
        <div class="col"><span class="label">Nama Ayah :</span> {{ $item->ortu->nama_ayah ?? '-' }}</div>
        <div class="col"><span class="label">Nama Ibu:</span> {{ $item->ortu->nama_ibu ?? '-' }}</div>
        <div class="col"><span class="label">No HP:</span> {{ $item->ortu->no_hp ?? '-' }}</div>
    </div>

    <div class="row">
        <div class="col"><span class="label">NIK Ayah:</span> {{ $item->ortu->nik_ayah ?? '-' }}</div>
        <div class="col"><span class="label">NIK Ibu:</span> {{ $item->ortu->nik_ibu ?? '-' }}</div>
        <div class="col"><span class="label">Penghasilan:</span> {{ $item->ortu->penghasilan_ortu ?? '-' }}</div>
    </div>

    <div class="row">
        <div class="col"><span class="label">TTL Ayah:</span> {{ $item->ortu->tanggal_lahir_ayah ?? '-' }}</div>
        <div class="col"><span class="label">TTL Ibu:</span> {{ $item->ortu->tanggal_lahir_ibu ?? '-' }}</div>
        <div class="col"><span class="label">Kode Pos:</span> {{ $item->ortu->kode_pos ?? '-' }}</div>
    </div>

    <div class="row">
        <div class="col"><span class="label">Pekerjaan:</span> {{ $item->ortu->pekerjaan_ayah ?? '-' }}</div>
        <div class="col"><span class="label">Pekerjaan:</span> {{ $item->ortu->pekerjaan_ibu ?? '-' }}</div>
        <div class="col wrap"><span class="label">Alamat:</span>{{ $item->ortu->alamat ?? '-' }}</div>
    </div>

    <div class="row">
        <div class="col"><span class="label">Pendidikan:</span> {{ $item->ortu->pendidikan_terakhir_ayah ?? '-' }}</div>
        <div class="col"><span class="label">Pendidikan:</span> {{ $item->ortu->pendidikan_terakhir_ibu ?? '-' }}</div>
        <div class="col"></div>
    </div>

</div>
@endforeach

</body>
</html>