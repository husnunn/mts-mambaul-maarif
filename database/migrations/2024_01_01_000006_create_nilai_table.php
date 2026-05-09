<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
            $table->integer('semester');
            $table->string('mata_pelajaran_kode', 20);
            $table->decimal('nilai_pengetahuan', 5, 2)->nullable();
            $table->decimal('nilai_keterampilan', 5, 2)->nullable();
            $table->string('nilai_sikap', 2)->nullable();
            $table->timestamps();

            $table->unique(['siswa_id', 'semester', 'mata_pelajaran_kode'], 'unique_nilai');
            $table->index('siswa_id');
            $table->index('semester');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
