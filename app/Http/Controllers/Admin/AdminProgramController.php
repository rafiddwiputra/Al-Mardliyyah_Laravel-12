<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Public\ProgramPendidikan;
use App\Models\Public\KategoriProgram;
use Illuminate\Http\Request;

class AdminProgramController extends Controller
{
    public function programPendidikan()
    {
        $programs = ProgramPendidikan::with('kategori')
            ->where('status', 'aktif')
            ->get()
            ->groupBy(function($item) {
                return $item->kategori->nama_kategori;
            });

            $kategori = KategoriProgram::all();

        return view('pages.admin.program-pendidikan.program-pendidikan', compact('programs', 'kategori'));
    }

    public function store(Request $request)
    {
        ProgramPendidikan::create([
            'kategori_id' => $request->kategori_id,
            'nama_program' => $request->nama_program,
            'deskripsi' => $request->deskripsi,
            'status' => $request->has('status') ? 'aktif' : 'nonaktif',
            'created_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Program berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
    $program = ProgramPendidikan::findOrFail($id);

    $program->update([
        'nama_program' => $request->nama_program,
        'deskripsi' => $request->deskripsi,
        'kategori_id' => $request->kategori_id,
        'status' => $request->has('status') ? 'aktif' : 'nonaktif',
        'updated_by' => auth()->id()
    ]);

    return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
    $program = ProgramPendidikan::findOrFail($id);
    $program->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

}