<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Public\ProgramPendidikan;
use Illuminate\Http\Request;

class AdminProgramController extends Controller
{
    public function programPendidikan()
    {
        $programs = ProgramPendidikan::where('status', 'aktif')
            ->get()
            ->groupBy('nama_kategori');

        $kategori = ['lembaga pendidikan', 'program pendidikan'];

        return view('pages.admin.program-pendidikan.program-pendidikan', compact('programs', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|in:lembaga pendidikan,program pendidikan',
            'nama_program' => 'required|string|max:100', 
            'deskripsi' => 'nullable|string',
        ]);

        ProgramPendidikan::create([
            'nama_kategori' => $request->nama_kategori, 
            'nama_program' => $request->nama_program,
            'deskripsi' => $request->deskripsi,
            'status' => $request->has('status') ? 'aktif' : 'nonaktif',
            'users_id' => auth()->id() 
        ]);

        return redirect()->back()->with('success', 'Program berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|in:lembaga pendidikan,program pendidikan',
            'nama_program' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $program = ProgramPendidikan::findOrFail($id);

        $program->update([
            'nama_kategori' => $request->nama_kategori,
            'nama_program' => $request->nama_program,
            'deskripsi' => $request->deskripsi,
            'status' => $request->has('status') ? 'aktif' : 'nonaktif',
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