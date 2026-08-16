<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelapor',
        'kontak_pelapor',
        'judul',
        'kategori',
        'isi_laporan',
        'lokasi',
        'lampiran',
        'status',
        'tanggapan',
        'tanggal_lapor',
    ];

    protected $casts = [
        'tanggal_lapor' => 'datetime',
    ];
}