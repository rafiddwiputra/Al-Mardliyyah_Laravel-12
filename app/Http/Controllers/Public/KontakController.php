<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Public\Kontak;

class KontakController extends Controller
{
    public function index()
    {
        // Mengambil semua data kontak
        $kontaks = Kontak::all();
        
        return view('pages.public.kontak', compact('kontaks'));
    }
}