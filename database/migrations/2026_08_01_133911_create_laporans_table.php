<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelapor');
            $table->string('kontak_pelapor');
            $table->string('judul');
            $table->string('kategori')->nullable();
            $table->text('isi_laporan');
            $table->string('lokasi')->nullable();
            $table->string('lampiran')->nullable();
            $table->enum('status', ['baru', 'diproses', 'selesai'])->default('baru');
            $table->text('tanggapan')->nullable();
            $table->timestamp('tanggal_lapor')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};