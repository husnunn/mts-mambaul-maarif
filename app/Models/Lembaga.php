<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table = 'lembaga';

    protected $fillable = [
        'nama_lembaga', 'kelas', 'tahun_pelajaran', 'npsn', 'no_urut_madrasah',
        'kabupaten_kota', 'kode_kabupaten_kota', 'provinsi', 'kode_provinsi',
        'madrasah_asal', 'nama_kepala', 'nip_kepala', 'tanggal_kelulusan',
        'nama_pengawas', 'nip_pengawas', 'alamat_lengkap', 'telepon_madrasah',
        'email_madrasah', 'website_madrasah', 'akreditasi',
    ];

    protected $casts = [
        'tanggal_kelulusan' => 'date',
    ];

    /**
     * Get the latest lembaga data or null
     */
    public static function getLatest(): ?self
    {
        return static::latest()->first();
    }
}
