<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Public\InformasiPendaftaran;
use Illuminate\Http\Request;
use App\Models\PendaftaranSantri;
use App\Models\DataOrtu;
use Illuminate\Validation\Rule;
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

    if (!$status && !auth()->check()) {
        return redirect('/pendaftaran')->with('error', 'Pendaftaran sedang ditutup');
    }

    $santri = PendaftaranSantri::where('users_id', Auth::id())->first();

    return view('pages.public.pendaftaran.upload', compact('status', 'santri'));
}

public function formulir()
{
    $status = InformasiPendaftaran::latest()->value('status') ?? 0;

    if (!$status && !auth()->check()) {
        return redirect('/pendaftaran')->with('error', 'Pendaftaran sedang ditutup');
    }

    $email = Auth::user()->email;

    // ambil data lama user
    $data = PendaftaranSantri::with('ortu')
        ->where('users_id', Auth::id())
        ->first();

    return view('pages.public.pendaftaran.formulir', compact('status', 'email', 'data'));
}

public function store(Request $request)
{
    $existing = PendaftaranSantri::where('users_id', Auth::id())->first();

    $request->validate([
        'nama_lengkap' => 'required',
        'nik' => [
            'required',
            Rule::unique('pendaftaran_santri', 'nik')
                ->ignore($existing?->id),
        ],
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

    // ================= DATA ORTU =================
    if ($existing && $existing->ortu) {
        $ortu = $existing->ortu;
        $ortu->update([
            'nama_ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,

            'nama_ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'pendidikan_terakhir_ibu' => $request->pendidikan_terakhir_ibu,

            'penghasilan_ortu' => $request->penghasilan_ortu,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
        ]);
    } else {
        $ortu = DataOrtu::create([
            'nama_ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'tempat_lahir_ayah' => '-',
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
    }

    // ================= DATA SANTRI =================
    if ($existing) {
        $existing->update([
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

            'ukuran_baju_putra' => $request->ukuran_baju_putra,
            'ukuran_celana_putra' => $request->ukuran_celana_putra,
            'ukuran_baju_putri' => $request->ukuran_baju_putri,
            'ukuran_rok_putri' => $request->ukuran_rok_putri,
        ]);
    } else {
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

            'foto_santri' => '-',
    'akta_kelahiran' => '-',
    'kartu_keluarga' => '-',
    'ktp_ayah' => '-',
    'ktp_ibu' => '-',
    'sertifikat' => null,
        ]);
    }

    return redirect()->route('upload.dokumen')
        ->with('success', 'Data berhasil disimpan!');
}

public function storeDokumen(Request $request)
{
    $santri = PendaftaranSantri::where('users_id', Auth::id())->first();

    if (!$santri) {
        return back()->with('error', 'Data tidak ditemukan!');
    }

    $request->validate([
        'foto_santri' => ($santri->foto_santri == '-' ? 'required' : 'nullable') . '|file|mimes:jpg,jpeg,png,pdf|max:1024',
        'akta_kelahiran' => ($santri->akta_kelahiran == '-' ? 'required' : 'nullable') . '|file|mimes:jpg,jpeg,png,pdf|max:1024',
        'kartu_keluarga' => ($santri->kartu_keluarga == '-' ? 'required' : 'nullable') . '|file|mimes:jpg,jpeg,png,pdf|max:1024',
        'ktp_ayah' => ($santri->ktp_ayah == '-' ? 'required' : 'nullable') . '|file|mimes:jpg,jpeg,png,pdf|max:1024',
        'ktp_ibu' => ($santri->ktp_ibu == '-' ? 'required' : 'nullable') . '|file|mimes:jpg,jpeg,png,pdf|max:1024',
        'sertifikat' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1024',
    ], [
        '*.required' => 'File wajib diupload!',
        '*.max' => 'Ukuran file maksimal 1 MB!',
        '*.mimes' => 'Format harus PDF/JPG/PNG!',
    ]);

    $santri = PendaftaranSantri::where('users_id', Auth::id())->first();

    if (!$santri) {
        return back()->with('error', 'Data tidak ditemukan!');
    }

    $upload = function ($file, $folder) {
    if (!$file) return null;

    $nama = time().'_'.$file->getClientOriginalName();
    $file->move(public_path('images/'.$folder), $nama);

    return $folder.'/'.$nama;
};

    $santri->update([
    'foto_santri' => $request->file('foto_santri') ? $upload($request->file('foto_santri'), 'foto') : $santri->foto_santri,
    'akta_kelahiran' => $request->file('akta_kelahiran') ? $upload($request->file('akta_kelahiran'), 'akta') : $santri->akta_kelahiran,
    'kartu_keluarga' => $request->file('kartu_keluarga') ? $upload($request->file('kartu_keluarga'), 'kk') : $santri->kartu_keluarga,
    'ktp_ayah' => $request->file('ktp_ayah') ? $upload($request->file('ktp_ayah'), 'ktp_ayah') : $santri->ktp_ayah,
    'ktp_ibu' => $request->file('ktp_ibu') ? $upload($request->file('ktp_ibu'), 'ktp_ibu') : $santri->ktp_ibu,
    'sertifikat' => $request->file('sertifikat') ? $upload($request->file('sertifikat'), 'sertifikat') : $santri->sertifikat,
]);

    return redirect()->route('status.pendaftaran')
        ->with('success', 'Dokumen berhasil diupload!');
}

}