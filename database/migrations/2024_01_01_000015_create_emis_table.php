<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emis', function (Blueprint $table) {
            $table->id();
            // Informasi Sekolah Asal
            $table->string('npsn_sekolah_asal', 20)->nullable();
            $table->string('nsm_mts', 20)->nullable();
            $table->string('nama_sekolah_asal', 100)->nullable();
            $table->text('alamat_sekolah_asal')->nullable();
            $table->string('tahun_lulus', 4)->nullable();
            $table->date('tanggal_diterima')->nullable();
            // PPDB
            $table->string('kelas_diterima', 10)->nullable();
            $table->string('program', 50)->nullable();
            $table->string('nism', 20)->nullable();
            // Kartu Keluarga
            $table->string('nomor_kk', 20)->nullable();
            // Informasi Siswa
            $table->string('nisn', 20)->nullable();
            $table->string('nik_siswa', 20)->nullable();
            $table->string('nama_lengkap', 100);
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->date('tanggal_gabung')->nullable();
            $table->string('hobi', 100)->nullable();
            $table->string('cita_cita', 100)->nullable();
            $table->string('transportasi', 50)->nullable();
            $table->decimal('jarak_km', 5, 2)->nullable();
            $table->decimal('jarak_jam', 4, 2)->nullable();
            $table->enum('pernah_paud', ['YA', 'TIDAK'])->nullable();
            $table->enum('pernah_tk', ['YA', 'TIDAK'])->nullable();
            $table->integer('anak_ke')->nullable();
            $table->integer('jumlah_saudara_kandung')->nullable();
            $table->integer('jumlah_saudara_tiri')->nullable();
            // Alamat Siswa
            $table->text('alamat_lengkap')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('desa', 50)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->string('kabupaten', 50)->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->string('kode_pos', 10)->nullable();
            // Informasi Ayah
            $table->enum('status_ayah', ['HIDUP', 'MENINGGAL'])->nullable();
            $table->enum('status_tinggal_ayah', ['BERSAMA', 'TERPISAH'])->nullable();
            $table->string('nik_ayah', 20)->nullable();
            $table->string('nama_ayah', 100)->nullable();
            $table->string('tempat_lahir_ayah', 50)->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('pendidikan_ayah', 50)->nullable();
            $table->string('pekerjaan_ayah', 50)->nullable();
            $table->decimal('penghasilan_ayah', 12, 2)->nullable();
            // Informasi Ibu
            $table->enum('status_ibu', ['HIDUP', 'MENINGGAL'])->nullable();
            $table->string('nik_ibu', 20)->nullable();
            $table->string('nama_ibu', 100)->nullable();
            $table->string('tempat_lahir_ibu', 50)->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('pendidikan_ibu', 50)->nullable();
            $table->string('pekerjaan_ibu', 50)->nullable();
            $table->decimal('penghasilan_ibu', 12, 2)->nullable();
            // Informasi Wali
            $table->string('nama_wali', 100)->nullable();
            $table->string('nik_wali', 20)->nullable();
            $table->string('hubungan_wali', 50)->nullable();
            $table->string('pendidikan_wali', 50)->nullable();
            $table->string('pekerjaan_wali', 50)->nullable();
            $table->decimal('penghasilan_wali', 12, 2)->nullable();

            $table->foreignId('siswa_id')->nullable()->constrained('siswa')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emis');
    }
};
