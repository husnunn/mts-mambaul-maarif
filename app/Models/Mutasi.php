<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table = 'mutasi';

    protected $fillable = [
        'siswa_id', 'jenis_mutasi', 'tanggal_mutasi',
        'sekolah_asal_tujuan', 'alasan', 'no_surat', 'dokumen', 'keterangan',
    ];

    protected $casts = [
        'tanggal_mutasi' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
