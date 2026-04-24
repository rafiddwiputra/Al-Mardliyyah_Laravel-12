<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Public\InformasiPendaftaran;
use Illuminate\Http\Request;
use App\Models\PendaftaranSantri;
use App\Models\DataOrtu;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function pendaftaran()
    {
        // Mengambil semua data informasi pendaftaran

        $informasi = InformasiPendaftaran::orderBy('created_at', 'asc')->get();

        $status = InformasiPendaftaran::latest()->value('status') ?? 0;

        return view('pages.public.pendaftaran.pendaftaran', compact('informasi', 'status'));
    }

    public function uploadDokumen()
{
    $status = InformasiPendaftaran::latest()->value('status') ?? 0;

    // JIKA pendaftaran tutup DAN user BELUM login, baru tendang keluar
    if (!$status && !auth()->check()) {
        return redirect('/pendaftaran')->with('error', 'Pendaftaran sedang ditutup');
    }

    return view('pages.public.pendaftaran.upload', compact('status'));
}

public function formulir()
{
    $status = InformasiPendaftaran::latest()->value('status') ?? 0;

    // JIKA pendaftaran tutup DAN user BELUM login, baru tendang keluar
    if (!$status && !auth()->check()) {
        return redirect('/pendaftaran')->with('error', 'Pendaftaran sedang ditutup');
    }
    $email = Auth::user()->email;

    return view('pages.public.pendaftaran.formulir', compact('status', 'email'));
}

public function store(Request $request)
{
    // VALIDASI (opsional tapi disarankan)
    $request->validate([
        'nama_lengkap' => 'required',
        'nik' => 'required|unique:pendaftaran_santri,nik',
        'nama_ayah' => 'required',
        'nama_ibu' => 'required',
    ]);

        // ================= MAPPING PROGRAM =================
    $mappingProgram = [
        'SMP (Khusus Putri)' => 1,
        'MTs (Khusus Putra)' => 2,
        'MA (Putra/Putri)' => 3,
    ];

    $program_id = $mappingProgram[$request->jenjang] ?? null;

    if (!$program_id) {
        return back()->with('error', 'Program tidak valid!');
    }

    // ================= SIMPAN DATA ORTU =================
    $ortu = DataOrtu::create ([
        'nama_ayah' => $request->nama_ayah,
        'nik_ayah' => $request->nik_ayah,
        'tempat_lahir_ayah' => '-', // sementara
        'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
        'pekerjaan_ayah' => $request->pekerjaan_ayah,
        'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,

        'nama_ibu' => $request->nama_ibu,
        'nik_ibu' => $request->nik_ibu,
        'tempat_lahir_ibu' => '-',
        'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
        'pekerjaan_ibu' => $request->pekerjaan_ibu,
        'pendidikan_terakhir_ibu' => $request->pendidikan_terakhir_ibu,

        'penghasilan_ortu' => $request->penghasilan_ortu,
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat,
        'kode_pos' => $request->kode_pos,
    ]);

    // ================= SIMPAN DATA SANTRI =================
    PendaftaranSantri::create([
        'users_id' => Auth::id(),
        'data_ortu_id' => $ortu->id,
        'program_id' => $program_id, 

        'nama_lengkap' => $request->nama_lengkap,
        'nisn' => $request->nisn,
        'nik' => $request->nik,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'nomor_kk' => $request->nomor_kk,
        'jenis_kelamin' => $request->jenis_kelamin,
        'sekolah_asal' => $request->sekolah_asal,
        'jenjang' => $request->jenjang,
        'sumber_informasi' => $request->sumber_informasi == 'Other'
        ? $request->sumber_informasi_lainnya
        : $request->sumber_informasi,

        // ================= DATA UKURAN =================
        'ukuran_baju_putra' => $request->ukuran_baju_putra,
        'ukuran_celana_putra' => $request->ukuran_celana_putra,
        'ukuran_baju_putri' => $request->ukuran_baju_putri,
        'ukuran_rok_putri' => $request->ukuran_rok_putri,

        // sementara kosong (step upload nanti)
        'foto_santri' => '-',
        'akta_kelahiran' => '-',
        'kartu_keluarga' => '-',
        'ktp_ayah' => '-',
        'ktp_ibu' => '-',
    ]);

    return redirect()->route('upload.dokumen')
        ->with('success', 'Data berhasil disimpan!');
}

}