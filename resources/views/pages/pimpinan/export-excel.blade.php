<table>
    <tr>
        <th colspan="6" style="text-align: center; font-size: 14px; font-weight: bold;">
            Laporan Data Pendaftar Santri - Pondok Pesantren Al-Mardliyyah
        </th>
    </tr>
    <tr>
        <th colspan="6" style="text-align: center;">
            Periode: {{ $periodeAktif ? $periodeAktif->nama_periode : 'Semua Periode / Tahun' }}
        </th>
    </tr>
    <tr></tr> <!-- Baris kosong untuk jarak -->
    
    <tr>
        <th style="font-weight: bold; border: 1px solid #000;">No</th>
        <th style="font-weight: bold; border: 1px solid #000;">Nama Lengkap</th>
        <th style="font-weight: bold; border: 1px solid #000;">Program Pendidikan</th>
        <th style="font-weight: bold; border: 1px solid #000;">L/P</th>
        <th style="font-weight: bold; border: 1px solid #000;">Tanggal Daftar</th>
        <th style="font-weight: bold; border: 1px solid #000;">Status</th>
    </tr>
    
    @foreach($pendaftar as $index => $santri)
    <tr>
        <td style="border: 1px solid #000;">{{ $index + 1 }}</td>
        <td style="border: 1px solid #000;">{{ $santri->nama_lengkap }}</td>
        <td style="border: 1px solid #000;">{{ $santri->program->nama_program ?? '-' }}</td>
        <td style="border: 1px solid #000;">{{ $santri->jenis_kelamin }}</td>
        <td style="border: 1px solid #000;">{{ $santri->created_at->format('d/m/Y') }}</td>
        <td style="border: 1px solid #000;">{{ ucfirst($santri->status) }}</td>
    </tr>
    @endforeach
</table>