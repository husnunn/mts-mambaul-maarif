<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->integer('no_urut')->nullable();
            $table->string('no_peserta_um', 20)->nullable();
            $table->string('nisn', 20)->nullable()->unique();
            $table->string('nis', 20)->unique();
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('kelas', 10)->nullable();
            $table->string('tempat_gabung', 50)->nullable();
            $table->date('tanggal_gabung')->nullable();
            $table->string('bulan_gabung', 20)->nullable();
            $table->string('nama_ortu', 100)->nullable();
            $table->string('pekerjaan_ortu', 50)->nullable();
            $table->string('no_skl', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('agama', 20)->nullable()->default('Islam');
            $table->string('status_keluarga', 30)->nullable();
            $table->integer('anak_ke')->nullable()->default(0);
            $table->integer('jumlah_saudara_kandung')->nullable()->default(0);
            $table->integer('jumlah_saudara_tiri')->nullable()->default(0);
            $table->string('foto', 255)->nullable();
            $table->enum('status_siswa', ['aktif', 'alumni', 'pindah', 'keluar', 'drop_out'])->default('aktif');
            $table->timestamps();

            $table->index('nis');
            $table->index('nisn');
            $table->index('kelas');
            $table->index('nama');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
