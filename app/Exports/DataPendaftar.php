<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\PendaftaranSantri;

class DataPendaftar implements FromCollection, WithHeadings
{
    public function collection()
    {
        return PendaftaranSantri::with('program')->get()->map(function ($item) {
            return [
                'PSB' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                $item->nama_lengkap,
                $item->program->nama_program ?? '-',
                optional($item->created_at)->format('d/m/Y'),
                ucfirst($item->status ?? 'diproses'),
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Nama', 'Program', 'Tanggal Daftar', 'Status'];
    }
}