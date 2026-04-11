<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilPondok;
use App\Models\Public\VisiMisi;
use Illuminate\Http\Request;

class InformasiWebsiteController extends Controller
{
    public function index()
    {
        $profil = ProfilPondok::first();

        $visi = VisiMisi::where('tipe', 'visi')->first();
        $misi = VisiMisi::where('tipe', 'misi')
                        ->orderBy('urutan')
                        ->get();

        return view('pages.admin.banner-beranda', compact('profil', 'visi', 'misi'));
    }

    public function update(Request $request)
{
    // ================= VALIDASI =================
    $request->validate([
        'nama_pondok'   => 'required|max:50',
        'tagline'       => 'nullable|string',
        'banner_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'logo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'visi'          => 'nullable|string',
        'misi.*'        => 'nullable|string',
        'deskripsi_lembaga' => 'nullable|string',
        'gambar_lembaga'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // ================= PROFIL =================
$profil = ProfilPondok::first();

if (!$profil) {
    $profil = new ProfilPondok();
    $profil->created_by = auth()->id();
    $profil->logo = 'images/default-logo.png';
}

// ================= UPLOAD FILE =================
if ($request->hasFile('banner_image')) {
    $profil->banner_image = $request->file('banner_image')->store('banner', 'public');
}

if ($request->hasFile('logo')) {
    $profil->logo = $request->file('logo')->store('logo', 'public');
}

if ($request->hasFile('gambar_lembaga')) {
    $profil->gambar_lembaga = $request->file('gambar_lembaga')->store('lembaga', 'public');
}

// ================= DATA TEXT =================
$profil->nama_pondok          = $request->nama_pondok;
$profil->tagline              = $request->tagline;
$profil->deskripsi_lembaga    = $request->deskripsi_lembaga;
$profil->updated_by           = auth()->id();

// default logo kalau kosong
if (!$profil->logo) {
    $profil->logo = 'images/default-logo.png';
}

// ================= SIMPAN =================
$profil->save();

    // ================= VISI =================
    VisiMisi::updateOrCreate(
        ['tipe' => 'visi'],
        [
            'konten'    => $request->visi,
            'updated_by'=> auth()->id()
        ]
    );

    // ================= MISI =================
    if ($request->misi) {

        VisiMisi::where('tipe', 'misi')->delete();

        foreach ($request->misi as $index => $misi) {

            if ($misi) {
                VisiMisi::create([
                    'tipe'       => 'misi',
                    'konten'     => $misi,
                    'urutan'     => $index + 1,
                    'created_by' => auth()->id()
                ]);
            }
        }
    }

    return redirect()->back()->with('success', 'Berhasil disimpan');
}
}