@extends('layouts.app')
@section('title', 'Input Nilai - ' . $siswa->nama)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 style="font-weight:800;margin:0"><i class="fas fa-edit me-2"></i>Input Nilai</h2>
        <p class="mb-0 mt-1" style="color:var(--text-secondary)">Semester {{ $semester }} — {{ $siswa->nama }} ({{ $siswa->nis }})</p>
    </div>
    <a href="{{ route('nilai.index', ['semester' => $semester, 'kelas' => $siswa->kelas]) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

{{-- Student info card --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
            <div class="stat-info-text">
                <h3 style="font-size:1.1rem">{{ $siswa->nama }}</h3>
                <p>{{ $siswa->nis }} · {{ $siswa->kelas ?? '-' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="fas fa-calendar"></i></div>
            <div class="stat-info-text">
                <h3>Sem {{ $semester }}</h3>
                <p>Semester Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info-text">
                <h3>{{ $existing->count() }}</h3>
                <p>Nilai Terisi</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        {{-- Semester navigation --}}
        <div class="card h-100">
            <div class="card-body d-flex flex-wrap gap-1 align-items-center justify-content-center">
                @for($i = 1; $i <= 6; $i++)
                <a href="{{ route('nilai.edit', ['siswa' => $siswa->id, 'semester' => $i]) }}"
                   class="btn btn-sm btn-{{ $semester == $i ? 'primary' : 'secondary' }}">
                    Sem {{ $i }}
                </a>
                @endfor
            </div>
        </div>
    </div>
</div>

{{-- Nilai form --}}
<div class="card">
    <div class="card-header">
        <i class="fas fa-table me-2"></i>Daftar Nilai Mata Pelajaran — Semester {{ $semester }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('nilai.update', $siswa) }}" id="nilaiForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="semester" value="{{ $semester }}">

            <div class="table-responsive">
                <table class="table table-hover" id="nilaiTable">
                    <thead>
                        <tr>
                            <th style="width:50px">No</th>
                            <th style="width:80px">Kode</th>
                            <th>Mata Pelajaran</th>
                            <th style="width:70px;text-align:center">Kategori</th>
                            <th style="width:130px;text-align:center">Pengetahuan</th>
                            <th style="width:130px;text-align:center">Keterampilan</th>
                            <th style="width:100px;text-align:center">Sikap</th>
                            <th style="width:80px;text-align:center">Rata²</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mapel_list as $i => $mapel)
                        @php
                            $val = $existing->get($mapel->kode);
                            $pengetahuan = old("nilai.{$mapel->kode}.pengetahuan", $val?->nilai_pengetahuan);
                            $keterampilan = old("nilai.{$mapel->kode}.keterampilan", $val?->nilai_keterampilan);
                            $sikap = old("nilai.{$mapel->kode}.sikap", $val?->nilai_sikap);
                        @endphp
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><span class="badge bg-info">{{ $mapel->kode }}</span></td>
                            <td><strong>{{ $mapel->nama }}</strong></td>
                            <td style="text-align:center">
                                <span class="badge bg-{{ $mapel->kategori === 'Agama' ? 'success' : ($mapel->kategori === 'Peminatan' ? 'warning' : 'secondary') }}">
                                    {{ $mapel->kategori }}
                                </span>
                            </td>
                            <td>
                                <input type="number" step="0.01" min="0" max="100"
                                       class="form-control form-control-sm text-center nilai-input"
                                       name="nilai[{{ $mapel->kode }}][pengetahuan]"
                                       value="{{ $pengetahuan }}"
                                       data-row="{{ $i }}" data-type="p"
                                       placeholder="0-100">
                            </td>
                            <td>
                                <input type="number" step="0.01" min="0" max="100"
                                       class="form-control form-control-sm text-center nilai-input"
                                       name="nilai[{{ $mapel->kode }}][keterampilan]"
                                       value="{{ $keterampilan }}"
                                       data-row="{{ $i }}" data-type="k"
                                       placeholder="0-100">
                            </td>
                            <td>
                                <select class="form-select form-select-sm text-center"
                                        name="nilai[{{ $mapel->kode }}][sikap]">
                                    <option value="">—</option>
                                    @foreach(['A' => 'A (Sangat Baik)', 'B' => 'B (Baik)', 'C' => 'C (Cukup)', 'D' => 'D (Kurang)'] as $code => $label)
                                    <option value="{{ $code }}" {{ $sikap === $code ? 'selected' : '' }}>{{ $code }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="text-align:center">
                                <strong class="rata-rata" id="rata-{{ $i }}" style="color:var(--accent)">
                                    @if($pengetahuan && $keterampilan)
                                        {{ number_format(($pengetahuan + $keterampilan) / 2, 1) }}
                                    @else
                                        —
                                    @endif
                                </strong>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background:rgba(255,255,255,.05)">
                            <td colspan="4" style="text-align:right"><strong>Rata-rata Keseluruhan</strong></td>
                            <td style="text-align:center"><strong id="avg-pengetahuan" style="color:var(--accent)">—</strong></td>
                            <td style="text-align:center"><strong id="avg-keterampilan" style="color:var(--accent)">—</strong></td>
                            <td></td>
                            <td style="text-align:center"><strong id="avg-total" style="color:var(--success);font-size:1.1rem">—</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div style="color:var(--text-muted);font-size:.82rem">
                    <i class="fas fa-info-circle me-1"></i>
                    Kosongkan field untuk menghapus nilai. Nilai akan tersimpan otomatis per mata pelajaran.
                </div>
                <div>
                    <a href="{{ route('nilai.index', ['semester' => $semester, 'kelas' => $siswa->kelas]) }}"
                       class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Simpan Semua Nilai
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.nilai-input');

    function calcAverages() {
        const rows = {{ $mapel_list->count() }};
        let totalP = 0, totalK = 0, countP = 0, countK = 0;

        for (let i = 0; i < rows; i++) {
            const pInput = document.querySelector(`[data-row="${i}"][data-type="p"]`);
            const kInput = document.querySelector(`[data-row="${i}"][data-type="k"]`);
            const rataEl = document.getElementById(`rata-${i}`);

            const p = parseFloat(pInput?.value) || 0;
            const k = parseFloat(kInput?.value) || 0;

            if (pInput?.value && kInput?.value) {
                const avg = ((p + k) / 2).toFixed(1);
                rataEl.textContent = avg;
                rataEl.style.color = avg >= 75 ? 'var(--success)' : 'var(--warning)';
            } else if (pInput?.value || kInput?.value) {
                rataEl.textContent = (p || k).toFixed(1);
                rataEl.style.color = 'var(--text-muted)';
            } else {
                rataEl.textContent = '—';
                rataEl.style.color = 'var(--text-muted)';
            }

            if (pInput?.value) { totalP += p; countP++; }
            if (kInput?.value) { totalK += k; countK++; }
        }

        document.getElementById('avg-pengetahuan').textContent = countP ? (totalP / countP).toFixed(1) : '—';
        document.getElementById('avg-keterampilan').textContent = countK ? (totalK / countK).toFixed(1) : '—';

        if (countP && countK) {
            const total = ((totalP / countP) + (totalK / countK)) / 2;
            const el = document.getElementById('avg-total');
            el.textContent = total.toFixed(1);
            el.style.color = total >= 75 ? 'var(--success)' : 'var(--warning)';
        } else {
            document.getElementById('avg-total').textContent = '—';
        }
    }

    inputs.forEach(input => input.addEventListener('input', calcAverages));
    calcAverages(); // initial
});
</script>
@endpush
