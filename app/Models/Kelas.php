<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas', 'tingkat', 'tahun_ajaran', 'wali_kelas_id',
        'kapasitas', 'keterangan',
    ];

    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id');
    }

    public function siswaKelas()
    {
        return $this->hasMany(SiswaKelas::class);
    }

    public function siswa()
    {
        return $this->hasManyThrough(Siswa::class, SiswaKelas::class, 'kelas_id', 'id', 'id', 'siswa_id');
    }
}
