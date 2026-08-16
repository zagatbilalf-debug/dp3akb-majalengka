<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanPublicController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Pesan::create([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'subjek' => $validated['subject'],
            'pesan' => $validated['message'],
            'status' => 'belum_dibaca',
        ]);

        return response()->json([
            'message' => 'Pesan Anda telah terkirim. Terima kasih telah menghubungi kami.',
        ]);
    }
}