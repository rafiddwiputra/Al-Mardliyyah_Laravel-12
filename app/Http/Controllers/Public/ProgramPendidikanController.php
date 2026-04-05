<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Public\ProgramPendidikan;
use Illuminate\Http\Request;

class ProgramPendidikanController extends Controller
{
    public function programPendidikan()
    {
        $programs = ProgramPendidikan::with('kategori')
            ->where('status', 'aktif')
            ->get()
            ->groupBy(function($item) {
                return $item->kategori->nama_kategori;
            });

        return view('pages.public.program-pendidikan', compact('programs'));
    }
}