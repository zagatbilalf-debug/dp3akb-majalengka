<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $validated['gambar'] = $request->file('gambar')->store('program', 'public');
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
            if ($program->gambar) {
                Storage::disk('public')->delete($program->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('program', 'public');
        }

        $program->update($validated);

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $program = Program::findOrFail($id);

        if ($program->gambar) {
            Storage::disk('public')->delete($program->gambar);
        }

        $program->delete();

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil dihapus.');
    }
}