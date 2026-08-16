<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PimpinanController extends Controller
{
    public function index()
    {
        $pimpinans = Pimpinan::orderBy('kategori')->orderBy('nama')->paginate(10);

        return view('admin.pimpinan.index', [
            'title' => 'Pimpinan',
            'pimpinans' => $pimpinans,
            'actionLabel' => 'Tambah Pimpinan',
            'actionRoute' => route('admin.pimpinan.create'),
        ]);
    }

    public function create()
    {
        return view('admin.pimpinan.create', [
            'title' => 'Tambah Pimpinan',
            'breadcrumbs' => [
                'Pimpinan' => route('admin.pimpinan.index'),
                'Tambah' => '#',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:255',
            'kategori' => 'required|in:Utama,Sekretariat,Kepala Bidang,UPTD',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['foto'] = $request->file('foto')->store('pimpinan', 'public');

        Pimpinan::create($validated);

        return redirect()->route('admin.pimpinan.index')
            ->with('success', 'Data pimpinan berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $pimpinan = Pimpinan::findOrFail($id);

        return view('admin.pimpinan.edit', [
            'title' => 'Edit Pimpinan',
            'pimpinan' => $pimpinan,
            'breadcrumbs' => [
                'Pimpinan' => route('admin.pimpinan.index'),
                'Edit' => '#',
            ],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $pimpinan = Pimpinan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:255',
            'kategori' => 'required|in:Utama,Sekretariat,Kepala Bidang,UPTD',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($pimpinan->foto);
            $validated['foto'] = $request->file('foto')->store('pimpinan', 'public');
        }

        $pimpinan->update($validated);

        return redirect()->route('admin.pimpinan.index')
            ->with('success', 'Data pimpinan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pimpinan = Pimpinan::findOrFail($id);

        Storage::disk('public')->delete($pimpinan->foto);
        $pimpinan->delete();

        return redirect()->route('admin.pimpinan.index')
            ->with('success', 'Data pimpinan berhasil dihapus.');
    }
}