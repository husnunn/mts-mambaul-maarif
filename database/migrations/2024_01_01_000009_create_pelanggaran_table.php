<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
            $table->string('jenis_pelanggaran', 100);
            $table->enum('kategori', ['ringan', 'sedang', 'berat'])->default('ringan');
            $table->date('tanggal');
            $table->integer('poin')->default(0);
            $table->text('keterangan')->nullable();
            $table->text('tindakan')->nullable();
            $table->string('penanggung_jawab', 100)->nullable();
            $table->enum('status', ['tertunda', 'diproses', 'selesai'])->default('tertunda');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggaran');
    }
};
