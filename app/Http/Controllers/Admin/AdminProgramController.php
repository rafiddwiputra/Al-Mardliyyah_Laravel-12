<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Public\ProgramPendidikan;
use Illuminate\Http\Request;

class AdminProgramController extends Controller
{
    public function programPendidikan()
    {
        // PERBAIKAN: Menghapus where('status', 'aktif') agar semua data tampil di admin
        $programs = ProgramPendidikan::orderBy('created_at', 'desc')
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
        try {
            $program = ProgramPendidikan::findOrFail($id);
            $program->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus');

        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect()->back()->with('error', 'Gagal! Program ini tidak dapat dihapus karena sudah dipilih oleh calon santri. Silakan ubah statusnya menjadi Nonaktif.');
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem saat mencoba menghapus data.');
        }
    }
}