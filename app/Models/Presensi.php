<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';

    protected $fillable = [
        'siswa_kelas_id', 'tanggal', 'status', 'keterangan',
        'jam_masuk', 'jam_keluar',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function siswaKelas()
    {
        return $this->belongsTo(SiswaKelas::class);
    }
}
