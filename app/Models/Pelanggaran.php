<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    protected $table = 'pelanggaran';

    protected $fillable = [
        'siswa_id', 'jenis_pelanggaran', 'kategori', 'tanggal',
        'poin', 'keterangan', 'tindakan', 'penanggung_jawab', 'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'poin' => 'integer',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
