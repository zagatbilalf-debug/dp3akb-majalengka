<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
  public function index()
{
    $beritas = Berita::latest()->paginate(10);

    $kategoriList = Berita::whereNotNull('kategori')
        ->distinct()
        ->pluck('kategori');

    return view('admin.berita.index', [
        'title' => 'Berita',
        'beritas' => $beritas,
        'kategoriList' => $kategoriList,
        'actionLabel' => 'Tambah Berita',
        'actionRoute' => route('admin.berita.create'),
    ]);
}

    public function create()
    {
        return view('admin.berita.create', [
            'title' => 'Tambah Berita',
            'breadcrumbs' => [
                'Berita' => route('admin.berita.index'),
                'Tambah' => '#',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'konten' => 'required|string',
            'status' => 'required|in:draft,publish',
            'tanggal_terbit' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $berita = Berita::findOrFail($id);

        return view('admin.berita.edit', [
            'title' => 'Edit Berita',
            'berita' => $berita,
            'breadcrumbs' => [
                'Berita' => route('admin.berita.index'),
                'Edit' => '#',
            ],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'konten' => 'required|string',
            'status' => 'required|in:draft,publish',
            'tanggal_terbit' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
    public function uploadImage(Request $request)
{
    $request->validate([
        'upload' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $path = $request->file('upload')->store('berita/konten', 'public');

    // Format response WAJIB seperti ini, sesuai spesifikasi CKEditor 5 upload adapter
    return response()->json([
        'url' => Storage::url($path),
    ]);
}
}