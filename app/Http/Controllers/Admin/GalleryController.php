<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('admin.gallery.index', [
            'title' => 'Gallery Penghargaan',
            'galleries' => $galleries,
            'actionLabel' => 'Tambah Penghargaan',
            'actionRoute' => route('admin.gallery.create'),
        ]);
    }

    public function create()
    {
        return view('admin.gallery.create', [
            'title' => 'Tambah Penghargaan',
            'breadcrumbs' => [
                'Gallery Penghargaan' => route('admin.gallery.index'),
                'Tambah' => '#',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|string|max:4',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['foto'] = $request->file('foto')->store('gallery', 'public');

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Penghargaan berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('admin.gallery.edit', [
            'title' => 'Edit Penghargaan',
            'gallery' => $gallery,
            'breadcrumbs' => [
                'Gallery Penghargaan' => route('admin.gallery.index'),
                'Edit' => '#',
            ],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|string|max:4',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($gallery->foto);
            $validated['foto'] = $request->file('foto')->store('gallery', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Penghargaan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        Storage::disk('public')->delete($gallery->foto);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Penghargaan berhasil dihapus.');
    }
}