<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Pendaftar</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
        }

        /* ==== KOP LAPORAN ==== */
        .kop-laporan {
            text-align: center;
            border-bottom: 2px solid #1E5631;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .kop-laporan h2 {
            margin: 0;
            color: #1E5631;
            font-size: 16px;
            text-transform: uppercase;
        }
        .kop-laporan h3 {
            margin: 3px 0 0 0;
            font-size: 12px;
            color: #333;
        }

        /* ==== TABEL INFORMASI FILTER ==== */
        .info-table {
            width: 100%;
            margin-bottom: 20px;
            font-size: 11px;
        }
        .info-table td {
            padding: 3px 5px;
            vertical-align: top;
        }

        /* ==== KARTU DATA ==== */
        .card {
            border: 1px solid #000;
            padding: 8px;
            margin-bottom: 15px;
            page-break-inside: avoid; /* Mencegah kartu terpotong di tengah halaman */
        }

        .header {
            font-weight: bold;
            font-size: 12px;
            background-color: #f3f4f6; /* Warna abu-abu muda agar nama santri menonjol */
            padding: 6px;
            margin: -8px -8px 8px -8px;
            border-bottom: 1px solid #000;
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
            background-color: #f9fafb; /* Latar belakang tipis untuk sub-judul */
        }

        .label {
            display: inline-block;
            min-width: 90px; 
            font-weight: bold;
        }

        .wrap {
            word-break: break-word;
            white-space: normal;
        }

    </style>
</head>
<body>

<!-- KOP LAPORAN -->
<div class="kop-laporan">
    <h2>Laporan Data Pendaftaran Santri Baru</h2>
    <h3>Pondok Pesantren Al-Mardliyyah</h3>
</div>

<!-- INFORMASI FILTER -->
<table class="info-table">
    <tr>
        <td width="15%"><strong>Program / Jenjang</strong></td>
        <td width="2%">:</td>
        <td width="43%">{{ $namaProgram }}</td>
        
        <td width="15%"><strong>Total Data</strong></td>
        <td width="2%">:</td>
        <td width="23%">{{ count($data) }} Santri</td>
    </tr>
    <tr>
        <td><strong>Periode</strong></td>
        <td>:</td>
        <td>{{ $namaPeriode }}</td>
        
        <td><strong>Status Pendaftaran</strong></td>
        <td>:</td>
        <td>{{ $statusAktif }}</td>
    </tr>
    <tr>
        <td><strong>Dicetak Pada</strong></td>
        <td>:</td>
        <td>{{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d F Y, H:i') }} WIB</td>
        
        <td></td><td></td><td></td>
    </tr>
</table>

<!-- DATA KARTU SANTRI -->
@foreach($data as $item)
<div class="card">

    <!-- HEADER KARTU -->
    <div class="header">
        {{ $item->smart_id ?? 'PSB' . str_pad($item->id, 3, '0', STR_PAD_LEFT) }} - 
        {{ strtoupper($item->nama_lengkap) }} ({{ ucfirst($item->status) }})
    </div>

    <!-- DATA DIRI TITLE -->
    <div class="row">
        <div class="full">DATA DIRI SANTRI</div>
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
        <div class="col"><span class="label">Tgl Pendaftaran:</span> {{ $item->created_at ? $item->created_at->format('d/m/Y') : '-' }}</div>
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
        <div class="full">DATA ORANG TUA / WALI</div>
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
        <div class="col wrap"><span class="label">Alamat:</span> {{ $item->ortu->alamat ?? '-' }}</div>
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