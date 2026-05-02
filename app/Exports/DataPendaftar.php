<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\PendaftaranSantri;

class DataPendaftar implements FromCollection, WithHeadings
{
    public function collection()
    {
        return PendaftaranSantri::with(['program', 'ortu', 'user'])->get()->map(function ($item) {

            return [
                // =====================
                // IDENTITAS SANTRI
                // =====================
                'ID' => 'PSB' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                'Nama' => $item->nama_lengkap,
                'Email' => $item->user->email ?? '-',
                'NISN' => $item->nisn ?? '-',
                'NIK' => $item->nik ? '="' . $item->nik . '"' : '-',
                'Nomor KK' => $item->nomor_kk ? '="' . $item->nomor_kk . '"' : '-',
                'Tempat Lahir' => $item->tempat_lahir ?? '-',
                'Tanggal Lahir' => $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') : '-',
                'Jenis Kelamin' => $item->jenis_kelamin ?? '-',
                'Sekolah Asal' => $item->sekolah_asal ?? '-',
                'Jenjang' => $item->program->nama_program ?? '-',
                'Sumber Informasi' => $item->sumber_informasi ?? '-',
                'Tanggal Pendaftaran' => $item->created_at ? $item->created_at->format('d/m/Y') : '-',
                'Status' => ucfirst(strtolower($item->status ?? 'diproses')),

                // =====================
                // UKURAN
                // =====================
                'Ukuran Baju Putra' => $item->ukuran_baju_putra ?? '-',
                'Ukuran Celana Putra' => $item->ukuran_celana_putra ?? '-',
                'Ukuran Baju Putri' => $item->ukuran_baju_putri ?? '-',
                'Ukuran Rok Putri' => $item->ukuran_rok_putri ?? '-',

                // =====================
                // AYAH
                // =====================
                'Nama Ayah' => $item->ortu->nama_ayah ?? '-',
                'NIK Ayah' => $item->ortu->nik_ayah ? '="' . $item->ortu->nik_ayah . '"' : '-',
                'TTL Ayah' => $item->ortu->tanggal_lahir_ayah ? \Carbon\Carbon::parse($item->ortu->tanggal_lahir_ayah)->format('d/m/Y'): '-',
                'Pekerjaan Ayah' => $item->ortu->pekerjaan_ayah ?? '-',
                'Pendidikan Ayah' => $item->ortu->pendidikan_terakhir_ayah ?? '-',

                // =====================
                // IBU
                // =====================
                'Nama Ibu' => $item->ortu->nama_ibu ?? '-',
                'NIK Ibu' => $item->ortu->nik_ibu ? '="' . $item->ortu->nik_ibu . '"' : '-',
                'TTL Ibu' => $item->ortu->tanggal_lahir_ibu ? \Carbon\Carbon::parse($item->ortu->tanggal_lahir_ibu)->format('d/m/Y'): '-',
                'Pekerjaan Ibu' => $item->ortu->pekerjaan_ibu ?? '-',
                'Pendidikan Ibu' => $item->ortu->pendidikan_terakhir_ibu ?? '-',

                // =====================
                // DATA TAMBAHAN ORTU
                // =====================
                'No HP' => $item->ortu->no_hp ? '="' . $item->ortu->no_hp . '"' : '-',
                'Penghasilan' => "'" . ($item->ortu->penghasilan_ortu ?? '-'),
                'Alamat' => $item->ortu->alamat ?? '-',
                'Kode Pos' => "'" . ($item->ortu->kode_pos ?? '-'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'NISN',
            'NIK',
            'Nomor KK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Sekolah Asal',
            'Jenjang',
            'Sumber Informasi',
            'Tanggal Pendaftaran',
            'Status',

            'Ukuran Baju Putra',
            'Ukuran Celana Putra',
            'Ukuran Baju Putri',
            'Ukuran Rok Putri',

            'Nama Ayah',
            'NIK Ayah',
            'TTL Ayah',
            'Pekerjaan Ayah',
            'Pendidikan Ayah',

            'Nama Ibu',
            'NIK Ibu',
            'TTL Ibu',
            'Pekerjaan Ibu',
            'Pendidikan Ibu',

            'No HP',
            'Penghasilan',
            'Alamat',
            'Kode Pos',
        ];
    }
}