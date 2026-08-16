<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;

class PesanController extends Controller
{
    public function index()
    {
        $pesans = Pesan::latest()->paginate(10);

        return view('admin.pesan.index', [
            'title' => 'Pesan Masuk',
            'pesans' => $pesans,
        ]);
    }

    public function show(string $id)
    {
        $pesan = Pesan::findOrFail($id);

        if ($pesan->status === 'belum_dibaca') {
            $pesan->update(['status' => 'dibaca']);
        }

        return view('admin.pesan.show', [
            'title' => 'Detail Pesan',
            'pesan' => $pesan,
            'breadcrumbs' => [
                'Pesan' => route('admin.pesan.index'),
                'Detail' => '#',
            ],
        ]);
    }

    public function destroy(string $id)
    {
        Pesan::findOrFail($id)->delete();

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}