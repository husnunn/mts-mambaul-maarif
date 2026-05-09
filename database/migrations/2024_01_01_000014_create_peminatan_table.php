<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminatan', function (Blueprint $table) {
            $table->id();
            $table->string('mata_pelajaran', 100);
            $table->string('jenis_peminatan', 50)->nullable();
            $table->string('peminatan', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminatan');
    }
};
