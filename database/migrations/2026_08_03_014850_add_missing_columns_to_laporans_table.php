<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            if (!Schema::hasColumn('laporans', 'nama_pelapor')) {
                $table->string('nama_pelapor')->after('id');
            }
            if (!Schema::hasColumn('laporans', 'kontak_pelapor')) {
                $table->string('kontak_pelapor')->after('nama_pelapor');
            }
            if (!Schema::hasColumn('laporans', 'judul')) {
                $table->string('judul')->after('kontak_pelapor');
            }
            if (!Schema::hasColumn('laporans', 'kategori')) {
                $table->string('kategori')->nullable()->after('judul');
            }
            if (!Schema::hasColumn('laporans', 'isi_laporan')) {
                $table->text('isi_laporan')->after('kategori');
            }
            if (!Schema::hasColumn('laporans', 'lokasi')) {
                $table->string('lokasi')->nullable()->after('isi_laporan');
            }
            if (!Schema::hasColumn('laporans', 'lampiran')) {
                $table->string('lampiran')->nullable()->after('lokasi');
            }
            if (!Schema::hasColumn('laporans', 'status')) {
                $table->enum('status', ['baru', 'diproses', 'selesai'])->default('baru')->after('lampiran');
            }
            if (!Schema::hasColumn('laporans', 'tanggapan')) {
                $table->text('tanggapan')->nullable()->after('status');
            }
            if (!Schema::hasColumn('laporans', 'tanggal_lapor')) {
                $table->timestamp('tanggal_lapor')->nullable()->after('tanggapan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn([
                'nama_pelapor', 'kontak_pelapor', 'judul', 'kategori',
                'isi_laporan', 'lokasi', 'lampiran', 'status',
                'tanggapan', 'tanggal_lapor',
            ]);
        });
    }
};