@extends('layouts.app')
@section('title', 'Input Nilai')
@section('content')
<h2 class="mb-4" style="font-weight:800"><i class="fas fa-chart-line me-2"></i>Input Nilai</h2>

<div class="row mb-4">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header"><i class="fas fa-calendar me-2"></i>Pilih Semester</div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    @for($i = 1; $i <= 6; $i++)
                    <a href="{{ route('nilai.index', ['semester' => $i, 'kelas' => $kelas]) }}"
                       class="btn btn-{{ $semester == $i ? 'primary' : 'secondary' }} px-4">
                        Semester {{ $i }}
                    </a>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><i class="fas fa-filter me-2"></i>Filter Kelas</div>
            <div class="card-body">
                <form method="GET" action="{{ route('nilai.index') }}">
                    <input type="hidden" name="semester" value="{{ $semester }}">
                    <select name="kelas" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Kelas</option>
                        @foreach($kelas_list as $k)
                        <option value="{{ $k }}" {{ $kelas == $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-info h-100">
            <div class="stat-icon"><i class="fas fa-info-circle"></i></div>
            <div class="stat-info-text">
                <h3>Sem {{ $semester }}</h3>
                <p>{{ $kelas ?? 'Semua Kelas' }} · {{ $siswa_list->count() }} siswa</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-users me-2"></i>Daftar Siswa — Semester {{ $semester }}</span>
        <span class="badge bg-info">{{ $mapel_list->count() }} Mata Pelajaran</span>
    </div>
    <div class="card-body">
        @if($siswa_list->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th style="text-align:center">Jumlah Nilai</th>
                        <th style="text-align:center">Rata-rata</th>
                        <th style="text-align:center;width:120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa_list as $i => $s)
                    @php
                        $nilaiCount = $s->nilai->count();
                        $avgNilai = $s->nilai->count() > 0
                            ? round($s->nilai->avg(fn($n) => (($n->nilai_pengetahuan ?? 0) + ($n->nilai_keterampilan ?? 0)) / 2), 1)
                            : 0;
                    @endphp
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $s->nis }}</td>
                        <td><strong>{{ $s->nama }}</strong></td>
                        <td><span class="badge bg-info">{{ $s->kelas ?? '-' }}</span></td>
                        <td style="text-align:center">
                            @if($nilaiCount > 0)
                            <span class="badge bg-success">{{ $nilaiCount }} mapel</span>
                            @else
                            <span class="badge bg-secondary">Belum ada</span>
                            @endif
                        </td>
                        <td style="text-align:center">
                            @if($nilaiCount > 0)
                            <strong style="color:{{ $avgNilai >= 75 ? 'var(--success)' : 'var(--warning)' }}">{{ $avgNilai }}</strong>
                            @else
                            <span style="color:var(--text-muted)">—</span>
                            @endif
                        </td>
                        <td style="text-align:center">
                            <a href="{{ route('nilai.edit', ['siswa' => $s->id, 'semester' => $semester]) }}"
                               class="btn btn-sm btn-primary">
                                <i class="fas fa-edit me-1"></i>Input Nilai
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-user-graduate fa-3x mb-3" style="color:var(--text-muted)"></i>
            <p style="color:var(--text-muted);font-size:.95rem">Pilih kelas untuk melihat daftar siswa</p>
        </div>
        @endif
    </div>
</div>
@endsection
