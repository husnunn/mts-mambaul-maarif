<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $table = 'orang_tua';

    protected $fillable = [
        'siswa_id', 'nama_ayah', 'pekerjaan_ayah', 'pendidikan_ayah',
        'nama_ibu', 'pekerjaan_ibu', 'pendidikan_ibu', 'alamat_orang_tua',
        'no_hp_ayah', 'no_hp_ibu', 'nama_wali', 'hubungan_wali',
        'pekerjaan_wali', 'alamat_wali', 'no_hp_wali',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
