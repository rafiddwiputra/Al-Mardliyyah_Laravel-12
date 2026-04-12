<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Public\Kontak;
use Illuminate\Http\Request;

class AdminKontakController extends Controller
{
    // TAMPILKAN HALAMAN KONTAK
    public function index()
    {
        $kontak = Kontak::all();

        return view('pages.admin.kontak.kontak', compact('kontak'));
    }

    public function store(Request $request)
    {
        Kontak::create([
            'tipe' => $request->tipe,
            'judul' => $request->judul,
            'nilai' => $request->nilai,
            'link' => $request->link,
            'icon' => $request->icon,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.kontak');
    }

    public function update(Request $request, $id)
    {
        $kontak = Kontak::findOrFail($id);

        $kontak->update([
            'tipe' => $request->tipe,
            'judul' => $request->judul,
            'nilai' => $request->nilai,
            'link' => $request->link,
            'icon' => $request->icon,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('admin.kontak');
    }

    public function destroy($id)
    {
        Kontak::findOrFail($id)->delete();

        return redirect()->route('admin.kontak');
    }
}