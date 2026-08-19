<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        // Whitelist kolom yang boleh di-sort dari URL, biar orang gak bisa
        // nyuntik nama kolom sembarangan lewat query string (?sort=...)
        $sortable = ['judul', 'status', 'tanggal_terbit'];

        $sort = $request->query('sort');
        $direction = $request->query('direction') === 'desc' ? 'desc' : 'asc';

        $query = Berita::query();

        if ($sort && in_array($sort, $sortable, true)) {
            $query->orderBy($sort, $direction)
                ->orderByDesc('id'); // tie-breaker biar urutan antar baris yang nilainya sama tetap stabil
        } else {
            $query->latest();
        }

        $beritas = $query->paginate(10)->appends($request->except('page'));

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
            // Upload ke Cloudinary, simpan URL lengkap (bukan path lokal)
            $uploadedFile = Cloudinary::upload(
                $request->file('gambar')->getRealPath(),
                ['folder' => 'dp3akb/berita']
            );
            $validated['gambar'] = $uploadedFile->getSecurePath();
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
            // Gambar lama di Cloudinary sengaja tidak dihapus otomatis
            // (butuh public_id tersimpan terpisah kalau mau auto-delete)
            $uploadedFile = Cloudinary::upload(
                $request->file('gambar')->getRealPath(),
                ['folder' => 'dp3akb/berita']
            );
            $validated['gambar'] = $uploadedFile->getSecurePath();
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uploadedFile = Cloudinary::upload(
            $request->file('upload')->getRealPath(),
            ['folder' => 'dp3akb/berita/konten']
        );

        return response()->json([
            'url' => $uploadedFile->getSecurePath(),
        ]);
    }
}