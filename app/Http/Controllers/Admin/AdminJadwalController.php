<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Public\InformasiPendaftaran;
use Illuminate\Http\Request;

class AdminJadwalController extends Controller
{
    public function index()
    {
        $data = InformasiPendaftaran::latest()->get();
        return view('pages.admin.jadwal.jadwal', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        $deskripsi = $request->tanggal_mulai . ' - ' . $request->tanggal_selesai;

        InformasiPendaftaran::create([
            'judul' => $request->judul,
            'deskripsi' => $deskripsi,
            'created_by' => auth()->id()
        ]);

        return redirect()->route('admin.jadwal')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        $data = InformasiPendaftaran::findOrFail($id);

        $deskripsi = $request->tanggal_mulai . ' - ' . $request->tanggal_selesai;

        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $deskripsi,
            'updated_by' => auth()->id()
        ]);

        return redirect()->route('admin.jadwal')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = InformasiPendaftaran::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.jadwal')->with('success', 'Data berhasil dihapus!');
    }
}