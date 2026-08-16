<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::latest()->paginate(10);

        return view('admin.dokumen.index', [
            'title' => 'Dokumen',
            'dokumens' => $dokumens,
            'actionLabel' => 'Tambah Dokumen',
            'actionRoute' => route('admin.dokumen.create'),
        ]);
    }

    public function create()
    {
        return view('admin.dokumen.create', [
            'title' => 'Tambah Dokumen',
            'breadcrumbs' => [
                'Dokumen' => route('admin.dokumen.index'),
                'Tambah' => '#',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        $validated['file'] = $request->file('file')->store('dokumen', 'public');

        Dokumen::create($validated);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        return view('admin.dokumen.edit', [
            'title' => 'Edit Dokumen',
            'dokumen' => $dokumen,
            'breadcrumbs' => [
                'Dokumen' => route('admin.dokumen.index'),
                'Edit' => '#',
            ],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($dokumen->file);
            $validated['file'] = $request->file('file')->store('dokumen', 'public');
        }

        $dokumen->update($validated);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        Storage::disk('public')->delete($dokumen->file);
        $dokumen->delete();

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }
}