<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orang_tua', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
            $table->string('nama_ayah', 100);
            $table->string('pekerjaan_ayah', 100)->nullable();
            $table->enum('pendidikan_ayah', ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'])->nullable();
            $table->string('nama_ibu', 100);
            $table->string('pekerjaan_ibu', 100)->nullable();
            $table->enum('pendidikan_ibu', ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'])->nullable();
            $table->text('alamat_orang_tua')->nullable();
            $table->string('no_hp_ayah', 15)->nullable();
            $table->string('no_hp_ibu', 15)->nullable();
            $table->string('nama_wali', 100)->nullable();
            $table->string('hubungan_wali', 50)->nullable();
            $table->string('pekerjaan_wali', 100)->nullable();
            $table->text('alamat_wali')->nullable();
            $table->string('no_hp_wali', 15)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orang_tua');
    }
};
