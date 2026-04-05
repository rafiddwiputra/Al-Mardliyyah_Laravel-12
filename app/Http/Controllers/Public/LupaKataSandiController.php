<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LupaKataSandiController extends Controller
{
    public function lupaSandi()
    {
    return view('pages.public.lupa-sandi');
    }
}
