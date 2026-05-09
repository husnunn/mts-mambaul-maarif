<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Default admin user (password: admin123)
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@mts-mambaulmaarif.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // 2. Default settings
        $settings = [
            ['setting_key' => 'app_name', 'setting_value' => 'Sistem Buku Induk Siswa', 'setting_group' => 'general', 'keterangan' => 'Nama Aplikasi'],
            ['setting_key' => 'school_name', 'setting_value' => "MTS Mamba'ul Ma'arif", 'setting_group' => 'general', 'keterangan' => 'Nama Sekolah'],
            ['setting_key' => 'school_address', 'setting_value' => 'Denanyar Jombang', 'setting_group' => 'general', 'keterangan' => 'Alamat Sekolah'],
            ['setting_key' => 'school_phone', 'setting_value' => '', 'setting_group' => 'general', 'keterangan' => 'Telepon Sekolah'],
            ['setting_key' => 'school_email', 'setting_value' => '', 'setting_group' => 'general', 'keterangan' => 'Email Sekolah'],
            ['setting_key' => 'current_year', 'setting_value' => '2024/2025', 'setting_group' => 'academic', 'keterangan' => 'Tahun Ajaran Berjalan'],
            ['setting_key' => 'semester', 'setting_value' => '1', 'setting_group' => 'academic', 'keterangan' => 'Semester Berjalan'],
            ['setting_key' => 'max_absence', 'setting_value' => '15', 'setting_group' => 'academic', 'keterangan' => 'Maksimal Ketidakhadiran'],
            ['setting_key' => 'logo_url', 'setting_value' => '', 'setting_group' => 'appearance', 'keterangan' => 'URL Logo Sekolah'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        // 3. Default classes
        $kelas = [
            ['nama_kelas' => 'VII A', 'tingkat' => '7', 'tahun_ajaran' => '2024/2025', 'kapasitas' => 40],
            ['nama_kelas' => 'VII B', 'tingkat' => '7', 'tahun_ajaran' => '2024/2025', 'kapasitas' => 40],
            ['nama_kelas' => 'VIII A', 'tingkat' => '8', 'tahun_ajaran' => '2024/2025', 'kapasitas' => 40],
            ['nama_kelas' => 'VIII B', 'tingkat' => '8', 'tahun_ajaran' => '2024/2025', 'kapasitas' => 40],
            ['nama_kelas' => 'IX A', 'tingkat' => '9', 'tahun_ajaran' => '2024/2025', 'kapasitas' => 40],
            ['nama_kelas' => 'IX B', 'tingkat' => '9', 'tahun_ajaran' => '2024/2025', 'kapasitas' => 40],
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }

        // 4. Default mata pelajaran (subjects)
        $mapel = [
            ['kode' => 'AQH', 'nama' => 'Al-Quran Hadits', 'kategori' => 'Agama'],
            ['kode' => 'AKH', 'nama' => 'Akidah Akhlak', 'kategori' => 'Agama'],
            ['kode' => 'FIQ', 'nama' => 'Fiqih', 'kategori' => 'Agama'],
            ['kode' => 'SKI', 'nama' => 'SKI', 'kategori' => 'Agama'],
            ['kode' => 'PPKN', 'nama' => 'Pendidikan Pancasila dan Kewarganegaraan', 'kategori' => 'Umum'],
            ['kode' => 'BIN', 'nama' => 'Bahasa Indonesia', 'kategori' => 'Umum'],
            ['kode' => 'BAR', 'nama' => 'Bahasa Arab', 'kategori' => 'Agama'],
            ['kode' => 'MTK', 'nama' => 'Matematika', 'kategori' => 'Umum'],
            ['kode' => 'IPA', 'nama' => 'Ilmu Pengetahuan Alam', 'kategori' => 'Umum'],
            ['kode' => 'IPS', 'nama' => 'Ilmu Pengetahuan Sosial', 'kategori' => 'Umum'],
            ['kode' => 'BIG', 'nama' => 'Bahasa Inggris', 'kategori' => 'Umum'],
            ['kode' => 'SNB', 'nama' => 'Seni Budaya', 'kategori' => 'Umum'],
            ['kode' => 'PJO', 'nama' => 'Pendidikan Jasmani dan Olahraga', 'kategori' => 'Umum'],
            ['kode' => 'PRK', 'nama' => 'Prakarya', 'kategori' => 'Umum'],
            ['kode' => 'ASW', 'nama' => 'Aswaja', 'kategori' => 'Peminatan'],
        ];

        foreach ($mapel as $m) {
            MataPelajaran::create($m);
        }

        // 5. Sample students
        $siswa_data = [
            ['nis' => '2024001', 'nisn' => '1234567890', 'nama' => 'Ahmad Fauzi', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Jombang', 'tanggal_lahir' => '2010-05-15', 'agama' => 'Islam', 'alamat' => 'Jl. Merdeka No. 12, Denanyar', 'kelas' => 'VII-A', 'status_siswa' => 'aktif'],
            ['nis' => '2024002', 'nisn' => '1234567891', 'nama' => 'Siti Aminah', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Jombang', 'tanggal_lahir' => '2010-08-20', 'agama' => 'Islam', 'alamat' => 'Jl. Diponegoro No. 45, Denanyar', 'kelas' => 'VII-A', 'status_siswa' => 'aktif'],
            ['nis' => '2024003', 'nisn' => '1234567892', 'nama' => 'Budi Santoso', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Jombang', 'tanggal_lahir' => '2009-12-10', 'agama' => 'Islam', 'alamat' => 'Jl. Sudirman No. 8, Denanyar', 'kelas' => 'VII-B', 'status_siswa' => 'aktif'],
        ];

        foreach ($siswa_data as $index => $data) {
            $data['no_urut'] = $index + 1;
            Siswa::create($data);
        }
    }
}
