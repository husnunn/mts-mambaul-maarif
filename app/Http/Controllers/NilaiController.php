<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    /**
     * Halaman utama input nilai — pilih semester & kelas, lihat daftar siswa
     */
    public function index(Request $request)
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

        $mapel_list = MataPelajaran::orderBy('nama')->get();

        return view('data.nilai', compact('siswa_list', 'kelas_list', 'semester', 'kelas', 'mapel_list'));
    }

    /**
     * Form input nilai per siswa per semester
     */
    public function edit(Siswa $siswa, Request $request)
    {
        $semester = $request->input('semester', 1);

        $mapel_list = MataPelajaran::orderBy('nama')->get();

        // Get existing nilai for this student + semester
        $existing = Nilai::where('siswa_id', $siswa->id)
            ->where('semester', $semester)
            ->get()
            ->keyBy('mata_pelajaran_kode');

        return view('data.nilai-form', compact('siswa', 'semester', 'mapel_list', 'existing'));
    }

    /**
     * Simpan nilai siswa (upsert per mata pelajaran)
     */
    public function update(Request $request, Siswa $siswa)
    {
        $semester = $request->input('semester', 1);

        $request->validate([
            'nilai' => 'required|array',
            'nilai.*.pengetahuan' => 'nullable|numeric|min:0|max:100',
            'nilai.*.keterampilan' => 'nullable|numeric|min:0|max:100',
            'nilai.*.sikap' => 'nullable|string|max:2',
        ]);

        DB::transaction(function () use ($request, $siswa, $semester) {
            $nilaiData = $request->input('nilai', []);

            foreach ($nilaiData as $kodeMapel => $values) {
                $pengetahuan = $values['pengetahuan'] ?? null;
                $keterampilan = $values['keterampilan'] ?? null;
                $sikap = $values['sikap'] ?? null;

                // Skip if all values are empty
                if (is_null($pengetahuan) && is_null($keterampilan) && is_null($sikap)) {
                    // Delete existing record if all empty
                    Nilai::where('siswa_id', $siswa->id)
                        ->where('semester', $semester)
                        ->where('mata_pelajaran_kode', $kodeMapel)
                        ->delete();
                    continue;
                }

                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $siswa->id,
                        'semester' => $semester,
                        'mata_pelajaran_kode' => $kodeMapel,
                    ],
                    [
                        'nilai_pengetahuan' => $pengetahuan,
                        'nilai_keterampilan' => $keterampilan,
                        'nilai_sikap' => $sikap,
                    ]
                );
            }
        });

        $totalNilai = Nilai::where('siswa_id', $siswa->id)
            ->where('semester', $semester)
            ->count();

        Kegiatan::log('Input Nilai', "Menyimpan {$totalNilai} nilai semester {$semester} untuk siswa: {$siswa->nama} ({$siswa->nis})");

        return redirect()
            ->route('nilai.edit', ['siswa' => $siswa->id, 'semester' => $semester])
            ->with('success', "Nilai semester {$semester} untuk {$siswa->nama} berhasil disimpan! ({$totalNilai} mata pelajaran)");
    }
}
