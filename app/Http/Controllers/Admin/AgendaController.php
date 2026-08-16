<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderBy('tanggal', 'desc')->paginate(10);

        return view('admin.agenda.index', [
            'title' => 'Agenda',
            'agendas' => $agendas,
            'actionLabel' => 'Tambah Agenda',
            'actionRoute' => route('admin.agenda.create'),
        ]);
    }

    public function create()
    {
        return view('admin.agenda.create', [
            'title' => 'Tambah Agenda',
            'breadcrumbs' => [
                'Agenda' => route('admin.agenda.index'),
                'Tambah' => '#',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Agenda::create($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $agenda = Agenda::findOrFail($id);

        return view('admin.agenda.edit', [
            'title' => 'Edit Agenda',
            'agenda' => $agenda,
            'breadcrumbs' => [
                'Agenda' => route('admin.agenda.index'),
                'Edit' => '#',
            ],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $agenda = Agenda::findOrFail($id);

        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $agenda->update($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        Agenda::findOrFail($id)->delete();

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }
}