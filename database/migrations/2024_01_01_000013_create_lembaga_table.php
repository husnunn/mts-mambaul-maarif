<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lembaga', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lembaga', 100);
            $table->string('kelas', 10)->nullable();
            $table->string('tahun_pelajaran', 20)->nullable();
            $table->string('npsn', 20)->nullable();
            $table->string('no_urut_madrasah', 20)->nullable();
            $table->string('kabupaten_kota', 50)->nullable();
            $table->string('kode_kabupaten_kota', 10)->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->string('kode_provinsi', 10)->nullable();
            $table->string('madrasah_asal', 100)->nullable();
            $table->string('nama_kepala', 100)->nullable();
            $table->string('nip_kepala', 50)->nullable();
            $table->date('tanggal_kelulusan')->nullable();
            $table->string('nama_pengawas', 100)->nullable();
            $table->string('nip_pengawas', 50)->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('telepon_madrasah', 20)->nullable();
            $table->string('email_madrasah', 100)->nullable();
            $table->string('website_madrasah', 100)->nullable();
            $table->string('akreditasi', 5)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lembaga');
    }
};
