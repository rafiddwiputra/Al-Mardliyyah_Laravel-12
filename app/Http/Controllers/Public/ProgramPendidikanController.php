<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Public\ProgramPendidikan;
use Illuminate\Http\Request;

class ProgramPendidikanController extends Controller
{
    public function programPendidikan()
    {
        $programs = ProgramPendidikan::where('status', 'aktif')
            ->get()
            ->groupBy('nama_kategori');

        return view('pages.public.program-pendidikan', compact('programs'));
    }
}