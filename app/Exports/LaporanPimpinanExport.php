<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder; 
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;               
use PhpOffice\PhpSpreadsheet\Cell\DataType;           
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;


class LaporanPimpinanExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithCustomValueBinder
{
    protected $pendaftar;

    public function __construct($pendaftar)
    {
        $this->pendaftar = $pendaftar;
    }

    public function collection()
    {
        return $this->pendaftar;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIK',
            'Tempat Tanggal Lahir',
            'Jenjang Pendidikan',
            'Asal Sekolah',
            'NISN',
            'Alamat Lengkap',
            'Nama Ayah',
            'NIK Ayah',
            'Pekerjaan Ayah',
            'Nama Ibu',
            'NIK Ibu',
            'Pekerjaan Ibu',
            'Penghasilan Orang Tua',
            'Dari Jalur Apa Mengetahui Al Mardliyyah'
        ];
    }

    public function map($santri): array
    {
        $ttl = $santri->tempat_lahir . ', ' . Carbon::parse($santri->tanggal_lahir)->translatedFormat('d F Y');

        return [
            $santri->nama_lengkap,
            $santri->nik,
            $ttl,
            $santri->program->nama_program ?? '-',
            $santri->sekolah_asal,
            $santri->nisn,
            $santri->ortu->alamat ?? '-',
            $santri->ortu->nama_ayah ?? '-',
            $santri->ortu->nik_ayah ?? '-',
            $santri->ortu->pekerjaan_ayah ?? '-',
            $santri->ortu->nama_ibu ?? '-',
            $santri->ortu->nik_ibu ?? '-',
            $santri->ortu->pekerjaan_ibu ?? '-',
            $santri->ortu->penghasilan_ortu ?? '-',
            $santri->sumber_informasi
        ];
    }

    /**
     * FUNGSI AJAIB: Mencegat NIK & NISN dan memaksanya jadi String murni.
     */
    public function bindValue(Cell $cell, $value)
    {
        $column = $cell->getColumn();

        // Jika data masuk ke Kolom B(NIK), F(NISN), I(NIK Ayah), L(NIK Ibu)
        if (in_array($column, ['B', 'F', 'I', 'L'])) {
            // Paksa Excel membacanya sebagai TYPE_STRING tanpa perlu tanda kutip
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }

        // Untuk kolom lainnya, biarkan format default berjalan
        return parent::bindValue($cell, $value);
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $rangeAll = 'A1:' . $highestColumn . $highestRow;

        // 1. Set FONT GLOBAL ke Times New Roman
        $sheet->getStyle($rangeAll)->getFont()->setName('Times New Roman');

        // 2. Berikan BORDER ke semua sel
        $sheet->getStyle($rangeAll)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // 3. Style khusus HEADER (Baris 1)
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 11,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'E2EFDA'], // Warna biru/abu muda
                ],
            ],
        ];
    }
}