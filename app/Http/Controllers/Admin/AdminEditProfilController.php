<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminEditProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('pages.admin.edit-profil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $user->name = $request->name;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // simpan ke storage
            $path = $file->store('foto-profil', 'public');

            // simpan ke database
            $user->photo = $path;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}