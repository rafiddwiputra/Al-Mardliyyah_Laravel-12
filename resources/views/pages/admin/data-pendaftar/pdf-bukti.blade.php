<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - {{ $data->nama_lengkap }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #1E5631; }
        .title { text-align: center; font-weight: bold; text-decoration: underline; margin-bottom: 20px; }
        .table-data { width: 100%; border-collapse: collapse; }
        .table-data td { padding: 8px; vertical-align: top; }
        .table-data td:first-child { width: 30%; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h2>PONDOK PESANTREN AL-MARDLIYYAH</h2>
        <p style="margin: 0;">Bukti Penerimaan Santri Baru</p>
    </div>

    <div class="title">TANDA BUKTI LULUS SELEKSI</div>

    <p>Berdasarkan hasil seleksi, calon santri di bawah ini dinyatakan <strong>DITERIMA</strong>:</p>

    <table class="table-data">
        <tr>
            <td>ID Pendaftaran</td>
            <td>: {{ $data->smart_id ?? '-' }}</td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>: {{ $data->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Program Pilihan</td>
            <td>: {{ $data->program->nama_program ?? '-' }}</td>
        </tr>
        <tr>
            <td>Nama Ayah</td>
            <td>: {{ $data->ortu->nama_ayah ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Diterima</td>
            <td>: {{ \Carbon\Carbon::now()->format('d F Y') }}</td>
        </tr>
    </table>

    <div style="margin-top: 50px; text-align: right;">
        <p>Panitia Penerimaan,</p>
        <br><br><br>
        <p><strong>( Admin Al-Mardliyyah )</strong></p>
    </div>

</body>
</html>