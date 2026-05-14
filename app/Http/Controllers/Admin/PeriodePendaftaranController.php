<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Public\PeriodePendaftaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeriodePendaftaranController extends Controller
{
    public function index()
    {
        // Fitur Cerdas: Mengecek dan mengubah status otomatis jika periode sudah lewat batas waktu
        $periodes = PeriodePendaftaran::all();
        $hariIni = Carbon::now();

        foreach ($periodes as $p) {
            if ($p->status == 1 && $p->tanggal_selesai) {
                $batasAkhir = Carbon::parse($p->tanggal_selesai)->endOfDay();
                if ($hariIni->greaterThan($batasAkhir)) {
                    $p->update(['status' => 0]); // Otomatis nonaktif
                }
            }
        }

        // Ambil data terbaru untuk ditampilkan ke tabel
        $data = PeriodePendaftaran::orderBy('tanggal_mulai', 'desc')->get();
        
        return view('pages.admin.periode.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:50',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'persyaratan' => 'nullable|string', 
            'biaya' => 'nullable|string',           
            'jadwal_tambahan' => 'nullable|string', 
            'status' => 'required|integer',
            // Tambahkan validasi kolom PDF baru
            'jadwal_seleksi_tanggal' => 'nullable|string',
            'jadwal_seleksi_ruang' => 'nullable|string',
            'jadwal_seleksi_waktu' => 'nullable|string',
            'jadwal_wawancara_tanggal' => 'nullable|string',
            'jadwal_wawancara_ruang' => 'nullable|string',
            'jadwal_wawancara_waktu' => 'nullable|string',
        ]);

        PeriodePendaftaran::create($request->all());

        return redirect()->back()->with('success', 'Periode Pendaftaran baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id_periode)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:50',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'persyaratan' => 'nullable|string',
            'biaya' => 'nullable|string',
            'jadwal_tambahan' => 'nullable|string',
            'status' => 'required|integer',
            // Tambahkan validasi kolom PDF baru
            'jadwal_seleksi_tanggal' => 'nullable|string',
            'jadwal_seleksi_ruang' => 'nullable|string',
            'jadwal_seleksi_waktu' => 'nullable|string',
            'jadwal_wawancara_tanggal' => 'nullable|string',
            'jadwal_wawancara_ruang' => 'nullable|string',
            'jadwal_wawancara_waktu' => 'nullable|string',
        ]);

        $periode = PeriodePendaftaran::findOrFail($id_periode);
        
        // Logika pencegah admin mengaktifkan manual jika tanggal sudah expired
        $statusBaru = $request->status;
        $batasAkhir = Carbon::parse($request->tanggal_selesai)->endOfDay();
        if (Carbon::now()->greaterThan($batasAkhir)) {
            $statusBaru = 0; // Paksa nonaktif jika expired
        }

        $periode->update([
            'nama_periode' => $request->nama_periode,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'persyaratan' => $request->persyaratan,
            'biaya' => $request->biaya,
            'jadwal_tambahan' => $request->jadwal_tambahan,
            'status' => $statusBaru,
            // Tambahkan baris ini agar kolom baru ikut tersimpan saat update
            'jadwal_seleksi_tanggal' => $request->jadwal_seleksi_tanggal,
            'jadwal_seleksi_ruang' => $request->jadwal_seleksi_ruang,
            'jadwal_seleksi_waktu' => $request->jadwal_seleksi_waktu,
            'jadwal_wawancara_tanggal' => $request->jadwal_wawancara_tanggal,
            'jadwal_wawancara_ruang' => $request->jadwal_wawancara_ruang,
            'jadwal_wawancara_waktu' => $request->jadwal_wawancara_waktu,
        ]);

        return redirect()->back()->with('success', 'Periode Pendaftaran berhasil diperbarui!');
    }

    public function destroy($id_periode)
    {
        $periode = PeriodePendaftaran::findOrFail($id_periode);
        $periode->delete();

        return redirect()->back()->with('success', 'Periode Pendaftaran berhasil dihapus!');
    }
}