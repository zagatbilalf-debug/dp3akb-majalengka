<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(10);

        return view('admin.program.index', [
            'title' => 'Program Unggulan',
            'programs' => $programs,
            'actionLabel' => 'Tambah Program',
            'actionRoute' => route('admin.program.create'),
        ]);
    }

    public function create()
    {
        return view('admin.program.create', [
            'title' => 'Tambah Program',
            'breadcrumbs' => [
                'Program Unggulan' => route('admin.program.index'),
                'Tambah' => '#',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'nullable|url|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Upload ke Cloudinary, simpan URL lengkap (bukan path lokal)
            $uploadedFile = Cloudinary::upload(
                $request->file('gambar')->getRealPath(),
                ['folder' => 'dp3akb/program']
            );
            $validated['gambar'] = $uploadedFile->getSecurePath();
        }

        Program::create($validated);

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $program = Program::findOrFail($id);

        return view('admin.program.edit', [
            'title' => 'Edit Program',
            'program' => $program,
            'breadcrumbs' => [
                'Program Unggulan' => route('admin.program.index'),
                'Edit' => '#',
            ],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $program = Program::findOrFail($id);

        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'nullable|url|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Gambar lama di Cloudinary sengaja tidak dihapus otomatis
            // (butuh public_id tersimpan terpisah kalau mau auto-delete)
            $uploadedFile = Cloudinary::upload(
                $request->file('gambar')->getRealPath(),
                ['folder' => 'dp3akb/program']
            );
            $validated['gambar'] = $uploadedFile->getSecurePath();
        }

        $program->update($validated);

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $program = Program::findOrFail($id);

        $program->delete();

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil dihapus.');
    }
}