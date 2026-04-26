<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Public\Kontak;
use Illuminate\Http\Request;

class AdminKontakController extends Controller
{
    public function index()
    {
        Kontak::firstOrCreate(
            ['id' => 1],
            ['no_hp' => '081234567890'] 
        );

        Kontak::firstOrCreate(
            ['id' => 2],
            ['no_hp' => '080987654321'] 
        );

        $kontak = Kontak::whereIn('id', [1, 2])->get();

        return view('pages.admin.kontak.kontak', compact('kontak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_hp' => 'required|string|max:15'
        ]);

        $kontak = Kontak::findOrFail($id);

        $kontak->update([
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.kontak')->with('success', 'Nomor HP berhasil diperbarui!');
    }
}