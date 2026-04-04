<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProgramPendidikanController extends Controller
{
    public function programPendidikan()
    {
        return view('pages.public.program-pendidikan');
    }
}
