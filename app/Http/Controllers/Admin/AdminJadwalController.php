<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Public\InformasiPendaftaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminJadwalController extends Controller
{
    public function index()
    {
        $jadwal = InformasiPendaftaran::firstOrCreate(
            ['judul' => 'Jadwal Pendaftaran'],
            [
                'deskripsi' => 'Belum ada informasi...',
                'tanggal_mulai' => null,
                'tanggal_selesai' => null,
                'status' => 0
            ]
        );

        if ($jadwal->status == 1 && $jadwal->tanggal_selesai) {
            $hariIni = Carbon::now();
            $batasAkhir = Carbon::parse($jadwal->tanggal_selesai)->endOfDay();

            if ($hariIni->greaterThan($batasAkhir)) {
                $jadwal->update(['status' => 0]);
            }
        }

        $data = InformasiPendaftaran::where('judul', 'Jadwal Pendaftaran')->get(); 
        
        return view('pages.admin.jadwal.jadwal', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|boolean',
            'deskripsi' => 'nullable|string'
        ]);

        $data = InformasiPendaftaran::findOrFail($id);
        $statusBaru = $request->status;
        if ($request->tanggal_mulai && $request->tanggal_selesai) {
            $hariIni = Carbon::now();
            $batasAkhir = Carbon::parse($request->tanggal_selesai)->endOfDay();
            
            if ($hariIni->greaterThan($batasAkhir)) {
                $statusBaru = 0; 
            } else {
                $statusBaru = 1;
            }
        }

        $data->update([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $statusBaru,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->back()->with('success', 'Jadwal Pendaftaran berhasil diperbarui!');
    }
}