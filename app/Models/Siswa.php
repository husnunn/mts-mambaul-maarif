<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'no_urut', 'no_peserta_um', 'nisn', 'nis', 'nama', 'jenis_kelamin',
        'tempat_lahir', 'tanggal_lahir', 'kelas', 'tempat_gabung',
        'tanggal_gabung', 'bulan_gabung', 'nama_ortu', 'pekerjaan_ortu',
        'no_skl', 'alamat', 'telepon', 'email', 'agama', 'status_keluarga',
        'anak_ke', 'jumlah_saudara_kandung', 'jumlah_saudara_tiri', 'foto',
        'status_siswa',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_gabung' => 'date',
        'anak_ke' => 'integer',
        'jumlah_saudara_kandung' => 'integer',
        'jumlah_saudara_tiri' => 'integer',
        'no_urut' => 'integer',
    ];

    // Relationships
    public function orangTua()
    {
        return $this->hasOne(OrangTua::class);
    }

    public function siswaKelas()
    {
        return $this->hasMany(SiswaKelas::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function mutasi()
    {
        return $this->hasMany(Mutasi::class);
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function emis()
    {
        return $this->hasOne(Emis::class);
    }

    // Scopes
    public function scopeAktif($query)
    {
        return $query->where('status_siswa', 'aktif');
    }

    public function scopeByKelas($query, $kelas)
    {
        if ($kelas) {
            return $query->where('kelas', $kelas);
        }
        return $query;
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('nama', 'like', "%{$keyword}%")
              ->orWhere('nis', 'like', "%{$keyword}%")
              ->orWhere('nisn', 'like', "%{$keyword}%")
              ->orWhere('no_peserta_um', 'like', "%{$keyword}%");
        });
    }

    // Accessors
    public function getJenisKelaminLabelAttribute(): string
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    // Auto-generate bulan_gabung
    protected static function booted()
    {
        static::saving(function ($siswa) {
            if ($siswa->tanggal_gabung) {
                $siswa->bulan_gabung = $siswa->tanggal_gabung->translatedFormat('F');
            }
        });
    }

    /**
     * Get the next available no_urut
     */
    public static function getNextNoUrut(): int
    {
        return (static::max('no_urut') ?? 0) + 1;
    }
}
