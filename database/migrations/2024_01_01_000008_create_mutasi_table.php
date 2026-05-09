<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mutasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
            $table->enum('jenis_mutasi', ['masuk', 'keluar', 'pindah']);
            $table->date('tanggal_mutasi');
            $table->string('sekolah_asal_tujuan', 100)->nullable();
            $table->text('alasan')->nullable();
            $table->string('no_surat', 50)->nullable();
            $table->string('dokumen', 255)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mutasi');
    }
};
