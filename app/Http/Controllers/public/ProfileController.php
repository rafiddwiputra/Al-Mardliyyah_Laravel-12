<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SejarahPondok;

class ProfileController extends Controller
{
    // HALAMAN PROFIL (LIST SEJARAH)
    public function index()
    {
        $sejarah = SejarahPondok::orderBy('tahun', 'asc')->get();

        return view('pages.public.profile.index', compact('sejarah'));
    }

    // DETAIL SEJARAH
    public function detail($tahun)
    {
        $sejarah = SejarahPondok::where('tahun', $tahun)->firstOrFail();

        return view('pages.public.profile.detail-sejarah', compact('sejarah', 'tahun'));
    }
}