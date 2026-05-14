<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSantri;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class StatusPendaftaranController extends Controller
{
    public function index()
    {
        $data = PendaftaranSantri::where('users_id', Auth::id())->first();

        if (!$data) {
            return view('pages.public.pendaftaran.status-pendaftaran.belum');
        }

        $status = strtolower(trim($data->status));

        switch ($status) {
    case 'diterima':
        return view('pages.public.pendaftaran.status-pendaftaran.diterima', compact('data'));
    case 'ditolak':
        return view('pages.public.pendaftaran.status-pendaftaran.ditolak', compact('data'));
    default:
        return view('pages.public.pendaftaran.status-pendaftaran.proses', compact('data'));
}
    }

        public function cetakBuktiUser()
    {
        // 1. Ambil data pendaftaran milik user yang sedang login saja (keamanan)
        $data = PendaftaranSantri::with(['user', 'ortu', 'program', 'periode'])
                    ->where('users_id', Auth::id())
                    ->firstOrFail();

        // 2. Pastikan statusnya benar-benar diterima
        if (strtolower($data->status) !== 'diterima') {
            return redirect()->back()->with('error', 'Bukti pendaftaran belum tersedia.');
        }

        // 3. Gunakan template PDF sementara yang sama dengan milik admin
        $pdf = Pdf::loadView('pages.admin.data-pendaftar.pdf-bukti', compact('data'))
                  ->setPaper('a4', 'portrait');

        return $pdf->stream('Bukti_Pendaftaran_' . $data->nama_lengkap . '.pdf');
    }
}