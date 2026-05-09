<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emis extends Model
{
    protected $table = 'emis';

    protected $fillable = [
        'npsn_sekolah_asal', 'nsm_mts', 'nama_sekolah_asal', 'alamat_sekolah_asal',
        'tahun_lulus', 'tanggal_diterima', 'kelas_diterima', 'program', 'nism',
        'nomor_kk', 'nisn', 'nik_siswa', 'nama_lengkap', 'jenis_kelamin',
        'tempat_lahir', 'tanggal_lahir', 'tanggal_gabung', 'hobi', 'cita_cita',
        'transportasi', 'jarak_km', 'jarak_jam', 'pernah_paud', 'pernah_tk',
        'anak_ke', 'jumlah_saudara_kandung', 'jumlah_saudara_tiri',
        'alamat_lengkap', 'rt', 'rw', 'desa', 'kecamatan', 'kabupaten',
        'provinsi', 'kode_pos',
        'status_ayah', 'status_tinggal_ayah', 'nik_ayah', 'nama_ayah',
        'tempat_lahir_ayah', 'tanggal_lahir_ayah', 'pendidikan_ayah',
        'pekerjaan_ayah', 'penghasilan_ayah',
        'status_ibu', 'nik_ibu', 'nama_ibu', 'tempat_lahir_ibu',
        'tanggal_lahir_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_ibu',
        'nama_wali', 'nik_wali', 'hubungan_wali', 'pendidikan_wali',
        'pekerjaan_wali', 'penghasilan_wali',
        'siswa_id',
    ];

    protected $casts = [
        'tanggal_diterima' => 'date',
        'tanggal_lahir' => 'date',
        'tanggal_gabung' => 'date',
        'tanggal_lahir_ayah' => 'date',
        'tanggal_lahir_ibu' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
