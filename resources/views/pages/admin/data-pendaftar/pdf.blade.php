<!DOCTYPE html>
<html>
<head>
    <title>Data Pendaftar</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; font-size: 12px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h3>Data Pendaftar</h3>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Program</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>PSB{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</td>
            <td>{{ $item->nama_lengkap }}</td>
            <td>{{ $item->program->nama_program ?? '-' }}</td>
            <td>{{ $item->created_at->format('d/m/Y') }}</td>
            <td>{{ ucfirst($item->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>