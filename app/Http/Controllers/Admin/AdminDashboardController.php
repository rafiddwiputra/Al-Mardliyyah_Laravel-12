<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;
use Illuminate\Http\Request;
use App\Models\Public\PeriodePendaftaran;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // LIST PERIODE UNTUK DROPDOWN
        $listPeriode = PeriodePendaftaran::orderBy('tanggal_mulai', 'desc')->get();

        // ================= REVISI DOSEN =================
        // Jika tidak ada parameter 'periode_id' di URL (artinya admin baru buka dashboard tanpa klik filter)
        if (!$request->has('periode_id')) {
            // Cari periode yang sedang buka/aktif (asumsi kolom status = 1)
            $periodeAktif = PeriodePendaftaran::where('status', 1)->first();
            
            if ($periodeAktif) {
                // Suntikkan ID Periode Aktif ke dalam Request. 
                // Ini membuat Blade otomatis menganggap periode ini sedang di-select.
                $request->merge(['periode_id' => $periodeAktif->id_periode]);
            }
        }
        // =================================================

        // QUERY DASAR
        $query = PendaftaranSantri::with(['program', 'periode']);

        // FILTER PERIODE
        // Jika admin memilih "Semua Periode / Tahun", value-nya akan kosong dan request->filled() bernilai false.
        // Jika bernilai false, filter tidak dijalankan sehingga memunculkan semua data.
        if ($request->filled('periode_id')) {
            $query->where('id_periode', $request->periode_id);
        }

        // TOTAL
        $total = (clone $query)->count();

        // DIPROSES
        $baru = (clone $query)
            ->where('status', 'diproses')
            ->count();

        // DITERIMA
        $diterima = (clone $query)
            ->where('status', 'diterima')
            ->count();

        // DITOLAK
        $ditolak = (clone $query)
            ->where('status', 'ditolak')
            ->count();

        // DATA TERBARU
        $terbaru = (clone $query)
            ->latest()
            ->take(5)
            ->get();

        return view('pages.admin.dashboard', compact(
            'total',
            'baru',
            'diterima',
            'ditolak',
            'terbaru',
            'listPeriode'
        ));
    }
}