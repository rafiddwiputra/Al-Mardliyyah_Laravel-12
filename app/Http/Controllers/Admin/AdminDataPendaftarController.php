<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataPendaftar;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminDataPendaftarController extends Controller
{
    public function index(Request $request)
    {
        $query = PendaftaranSantri::with(['ortu', 'user', 'program']);

        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // cari nama
                $q->where('nama_lengkap', 'like', '%' . $search . '%');

                // kalau input PSB001
                if (str_starts_with(strtoupper($search), 'PSB')) {
                    $id = (int) filter_var($search, FILTER_SANITIZE_NUMBER_INT);
                    if ($id) {
                        $q->orWhere('id', $id);
                    }
                } 
                // kalau angka langsung
                elseif (is_numeric($search)) {
                    $q->orWhere('id', $search);
                }
            });
        }

        $data = $query->latest()->paginate(10);

        return view('pages.admin.data-pendaftar.data', compact('data'));
    }

    public function show($id)
    {
        $data = PendaftaranSantri::with(['ortu', 'user', 'program'])->findOrFail($id);

        return view('pages.admin.data-pendaftar.detail-data', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        $data = PendaftaranSantri::findOrFail($id);

        $data->status = $request->status;
        $data->save();

        return back();
    }

    public function exportExcel()
    {
        $data = \App\Models\PendaftaranSantri::with(['program', 'ortu'])->get();

        $filename = "data_pendaftar.csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // HEADER KOLOM
            fputcsv($file, [
                'ID',
                'Nama',
                'NISN',
                'NIK',
                'Tempat Lahir',
                'Tanggal Lahir',
                'No KK',
                'Jenis Kelamin',
                'Sekolah Asal',
                'Program',
                'Sumber Informasi',

                'Ukuran Baju Putra',
                'Ukuran Celana Putra',
                'Ukuran Baju Putri',
                'Ukuran Rok Putri',

                'Tanggal Daftar',
                'Status',

                // AYAH
                'Nama Ayah',
                'NIK Ayah',
                'Tanggal Lahir Ayah',
                'Pekerjaan Ayah',
                'Pendidikan Ayah',

                // IBU
                'Nama Ibu',
                'NIK Ibu',
                'Tanggal Lahir Ibu',
                'Pekerjaan Ibu',
                'Pendidikan Ibu',

                // UMUM
                'No HP',
                'Penghasilan',
                'Alamat',
                'Kode Pos'
            ]);

            // DATA
            foreach ($data as $item) {
                fputcsv($file, [
                    'PSB' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                    $item->nama_lengkap,
                    $item->nisn,
                    $item->nik,
                    $item->tempat_lahir,
                    $item->tanggal_lahir,
                    $item->nomor_kk,
                    $item->jenis_kelamin,
                    $item->sekolah_asal,
                    $item->program->nama_program ?? '-',
                    $item->sumber_informasi,

                    $item->ukuran_baju_putra,
                    $item->ukuran_celana_putra,
                    $item->ukuran_baju_putri,
                    $item->ukuran_rok_putri,

                    $item->created_at ? $item->created_at->format('d/m/Y') : '-',
                    ucfirst($item->status ?? 'diproses'),

                    // AYAH
                    $item->ortu->nama_ayah ?? '-',
                    $item->ortu->nik_ayah ?? '-',
                    $item->ortu?->tanggal_lahir_ayah ?? '-',
                    $item->ortu->pekerjaan_ayah ?? '-',
                    $item->ortu->pendidikan_terakhir_ayah ?? '-',

                    // IBU
                    $item->ortu->nama_ibu ?? '-',
                    $item->ortu->nik_ibu ?? '-',
                    $item->ortu?->tanggal_lahir_ibu ?? '-',
                    $item->ortu->pekerjaan_ibu ?? '-',
                    $item->ortu->pendidikan_terakhir_ibu ?? '-',

                    // UMUM
                    $item->ortu->no_hp ?? '-',
                    $item->ortu->penghasilan_ortu ?? '-',
                    $item->ortu->alamat ?? '-',
                    $item->ortu->kode_pos ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPDF()
    {
        $data = \App\Models\PendaftaranSantri::with(['program', 'ortu'])->get();

        $pdf = Pdf::loadView('pages.admin.data-pendaftar.pdf', compact('data'))
          ->setPaper('a4', 'landscape');

        return $pdf->download('data_pendaftar.pdf');
    }
    
}