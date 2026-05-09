<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaKelas extends Model
{
    protected $table = 'siswa_kelas';

    protected $fillable = [
        'siswa_id', 'kelas_id', 'tahun_ajaran', 'semester',
        'no_absen', 'status', 'tanggal_masuk', 'tanggal_keluar',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_keluar' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'siswa_kelas_id');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'siswa_kelas_id');
    }
}
