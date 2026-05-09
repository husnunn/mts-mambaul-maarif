<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Lembaga;
use App\Models\Peminatan;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    public function index()
    {
        $lembaga = Lembaga::getLatest();
        $peminatan = Peminatan::orderBy('id')->get();

        return view('data.lembaga', compact('lembaga', 'peminatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lembaga' => 'required|string|max:100',
            'kelas' => 'nullable|string|max:10',
            'tahun_pelajaran' => 'required|string|max:20',
            'npsn' => 'required|string|max:20',
            'no_urut_madrasah' => 'required|string|max:20',
            'kabupaten_kota' => 'required|string|max:50',
            'kode_kabupaten_kota' => 'required|string|max:10',
            'provinsi' => 'required|string|max:50',
            'kode_provinsi' => 'required|string|max:10',
            'madrasah_asal' => 'nullable|string|max:100',
            'nama_kepala' => 'required|string|max:100',
            'nip_kepala' => 'nullable|string|max:50',
            'tanggal_kelulusan' => 'nullable|date',
            'nama_pengawas' => 'required|string|max:100',
            'nip_pengawas' => 'nullable|string|max:50',
            'alamat_lengkap' => 'nullable|string',
            'telepon_madrasah' => 'nullable|string|max:20',
            'email_madrasah' => 'nullable|email|max:100',
            'website_madrasah' => 'nullable|string|max:100',
            'akreditasi' => 'nullable|string|max:5',
        ]);

        // Update existing or create new
        $existing = Lembaga::getLatest();

        if ($existing) {
            $existing->update($validated);
        } else {
            Lembaga::create($validated);
        }

        // Save peminatan data
        if ($request->has('mata_pelajaran')) {
            Peminatan::truncate();

            $mataPelajaran = $request->input('mata_pelajaran', []);
            $jenisPeminatan = $request->input('jenis_peminatan', []);
            $peminatan = $request->input('peminatan', []);

            foreach ($mataPelajaran as $i => $mapel) {
                if (!empty($mapel)) {
                    Peminatan::create([
                        'mata_pelajaran' => $mapel,
                        'jenis_peminatan' => $jenisPeminatan[$i] ?? null,
                        'peminatan' => $peminatan[$i] ?? null,
                    ]);
                }
            }
        }

        Kegiatan::log('Simpan Data Lembaga', 'Menyimpan data identitas lembaga');

        return redirect()->route('lembaga.index')->with('success', 'Data lembaga berhasil disimpan!');
    }
}
