<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $kelas = $request->input('kelas');

        $query = Siswa::query()->orderBy('no_urut')->orderBy('nama');

        if ($keyword) {
            $query->search($keyword);
        }

        if ($kelas) {
            $query->byKelas($kelas);
        }

        $siswa_list = $query->paginate(20);
        $kelas_list = Siswa::whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        return view('data.index', compact('siswa_list', 'kelas_list', 'keyword', 'kelas'));
    }

    public function create()
    {
        return view('data.form', ['siswa_data' => null, 'action' => 'add']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:20|unique:siswa,nis',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'nullable|string|max:10',
            'nisn' => 'nullable|string|max:20',
            'no_peserta_um' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'tempat_gabung' => 'nullable|string|max:50',
            'tanggal_gabung' => 'nullable|date',
            'nama_ortu' => 'nullable|string|max:100',
            'pekerjaan_ortu' => 'nullable|string|max:50',
            'no_skl' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'agama' => 'nullable|string|max:20',
            'status_keluarga' => 'nullable|string|max:30',
            'anak_ke' => 'nullable|integer|min:0',
            'jumlah_saudara_kandung' => 'nullable|integer|min:0',
            'jumlah_saudara_tiri' => 'nullable|integer|min:0',
        ]);

        $validated['no_urut'] = Siswa::getNextNoUrut();

        Siswa::create($validated);

        Kegiatan::log('Tambah Siswa', "Menambahkan siswa: {$validated['nama']} ({$validated['nis']})");

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function show(Siswa $siswa)
    {
        $siswa->load(['orangTua', 'nilai', 'mutasi', 'pelanggaran', 'prestasi', 'emis']);
        return view('data.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        return view('data.form', ['siswa_data' => $siswa, 'action' => 'edit']);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:20|unique:siswa,nis,' . $siswa->id,
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'nullable|string|max:10',
            'nisn' => 'nullable|string|max:20',
            'no_peserta_um' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'tempat_gabung' => 'nullable|string|max:50',
            'tanggal_gabung' => 'nullable|date',
            'nama_ortu' => 'nullable|string|max:100',
            'pekerjaan_ortu' => 'nullable|string|max:50',
            'no_skl' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'agama' => 'nullable|string|max:20',
            'status_keluarga' => 'nullable|string|max:30',
            'anak_ke' => 'nullable|integer|min:0',
            'jumlah_saudara_kandung' => 'nullable|integer|min:0',
            'jumlah_saudara_tiri' => 'nullable|integer|min:0',
        ]);

        $siswa->update($validated);

        Kegiatan::log('Edit Siswa', "Mengubah data siswa: {$siswa->nama} ({$siswa->nis})");

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        $nama = $siswa->nama;
        $nis = $siswa->nis;

        $siswa->delete();

        Kegiatan::log('Hapus Siswa', "Menghapus siswa: {$nama} ({$nis})");

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }

    // Nilai (Grades) management
    public function nilaiIndex(Request $request)
    {
        $semester = $request->input('semester', 1);
        $kelas = $request->input('kelas');

        $query = Siswa::query()->orderBy('nama');

        if ($kelas) {
            $query->where('kelas', $kelas);
        }

        $siswa_list = $query->with(['nilai' => function ($q) use ($semester) {
            $q->where('semester', $semester);
        }])->get();

        $kelas_list = Siswa::whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        return view('data.nilai', compact('siswa_list', 'kelas_list', 'semester', 'kelas'));
    }
}
