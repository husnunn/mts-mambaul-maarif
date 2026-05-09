<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Setting;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = $this->getStatistics();
        $activities = $this->getRecentActivities();
        $chartData = $this->getChartData();

        return view('dashboard', compact('stats', 'activities', 'chartData'));
    }

    private function getStatistics(): array
    {
        $stats = [
            'total_siswa' => 0,
            'total_nilai' => 0,
            'total_kelas' => 0,
            'total_cetak' => 0,
            'rata_nilai' => 0,
        ];

        try {
            $stats['total_siswa'] = Siswa::count();
        } catch (\Exception $e) {
            // keep default
        }

        try {
            $stats['total_nilai'] = Nilai::count();
        } catch (\Exception $e) {
            // keep default
        }

        try {
            $stats['total_kelas'] = Siswa::whereNotNull('kelas')
                ->where('kelas', '!=', '')
                ->distinct('kelas')
                ->count('kelas');
        } catch (\Exception $e) {
            // keep default
        }

        try {
            $stats['total_cetak'] = Kegiatan::where('aktivitas', 'like', '%Cetak%')->count();
        } catch (\Exception $e) {
            // keep default
        }

        try {
            $avg = Nilai::avg(DB::raw('(nilai_pengetahuan + nilai_keterampilan) / 2'));
            $stats['rata_nilai'] = $avg ? round($avg, 2) : 0;
        } catch (\Exception $e) {
            // keep default
        }

        return $stats;
    }

    private function getRecentActivities()
    {
        try {
            return Kegiatan::with('user')
                ->latest()
                ->limit(10)
                ->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getChartData(): array
    {
        $chartData = [
            'semester' => [],
            'mapel' => [],
        ];

        // Data per semester
        for ($i = 1; $i <= 6; $i++) {
            try {
                $avg = Nilai::where('semester', $i)
                    ->avg(DB::raw('(nilai_pengetahuan + nilai_keterampilan) / 2'));
                $chartData['semester'][$i] = $avg ? round($avg, 2) : 0;
            } catch (\Exception $e) {
                $chartData['semester'][$i] = 0;
            }
        }

        // Data per mapel
        try {
            $chartData['mapel'] = Nilai::select('mata_pelajaran_kode')
                ->join('mata_pelajaran', 'nilai.mata_pelajaran_kode', '=', 'mata_pelajaran.kode')
                ->selectRaw('mata_pelajaran.nama, AVG((nilai_pengetahuan + nilai_keterampilan) / 2) as rata')
                ->groupBy('mata_pelajaran.nama', 'mata_pelajaran_kode')
                ->orderByDesc('rata')
                ->limit(10)
                ->get()
                ->toArray();
        } catch (\Exception $e) {
            $chartData['mapel'] = [];
        }

        return $chartData;
    }
}
