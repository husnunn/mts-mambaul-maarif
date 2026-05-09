<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function index(Request $request)
    {
        $kelas = $request->input('kelas');
        $semester = $request->input('semester');

        $siswa_list = Siswa::query()
            ->when($kelas, fn($q) => $q->where('kelas', $kelas))
            ->orderBy('nama')
            ->get();

        $kelas_list = Siswa::whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        return view('cetak.index', compact('siswa_list', 'kelas_list', 'kelas', 'semester'));
    }

    public function bukuInduk(Siswa $siswa)
    {
        $siswa->load(['orangTua', 'nilai', 'prestasi', 'pelanggaran']);

        Kegiatan::log('Cetak Buku Induk', "Mencetak buku induk siswa: {$siswa->nama}");

        return view('cetak.buku-induk', compact('siswa'));
    }
}
