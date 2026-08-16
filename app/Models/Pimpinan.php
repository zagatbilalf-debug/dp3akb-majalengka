<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'kategori',
        'foto',
        'status',
    ];

    public function getKategoriSlugAttribute(): string
    {
        return match ($this->kategori) {
            'Utama' => 'utama',
            'Sekretariat' => 'sekretariat',
            'Kepala Bidang' => 'bidang',
            'UPTD' => 'uptd',
            default => 'lainnya',
        };
    }
}