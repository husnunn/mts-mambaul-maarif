@extends('layouts.app')
@section('title', 'Cetak Data')
@section('content')
<h2 class="mb-4" style="font-weight:800"><i class="fas fa-print me-2"></i>Cetak Data dan Dokumen</h2>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Dokumen Utama</div>
            <div class="card-body">
                @php
                $docs = [
                    ['icon' => 'fa-file-certificate', 'kode' => 'DKN', 'nama' => 'Daftar Kelas Nilai'],
                    ['icon' => 'fa-graduation-cap', 'kode' => 'SKL', 'nama' => 'Surat Keterangan Lulus'],
                    ['icon' => 'fa-book', 'kode' => 'COVER', 'nama' => 'Cover Buku Induk'],
                    ['icon' => 'fa-award', 'kode' => 'SKHUS', 'nama' => 'SKHUS'],
                    ['icon' => 'fa-stamp', 'kode' => 'PENGESAHAN', 'nama' => 'Dokumen Pengesahan'],
                ];
                @endphp
                @foreach($docs as $doc)
                <div class="d-flex align-items-center p-3 mb-2" style="background:var(--bg-card-hover);border-radius:12px">
                    <div class="stat-icon me-3" style="width:40px;height:40px;font-size:1rem;background:rgba(14,165,233,.15);color:var(--accent)"><i class="fas {{ $doc['icon'] }}"></i></div>
                    <div class="flex-grow-1">
                        <strong style="font-size:.85rem;color: white !important">{{ $doc['kode'] }}</strong>
                        <div style="font-size:.75rem;color:white !important">{{ $doc['nama'] }}</div>
                    </div>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-print"></i></button>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Buku Induk per Siswa</span>
                    <form method="GET" class="d-flex gap-2">
                        <select name="kelas" class="form-select form-select-sm" style="width:150px" onchange="this.form.submit()">
                            <option value="">Semua Kelas</option>
                            @foreach($kelas_list as $k)
                            <option value="{{ $k }}" {{ $kelas == $k ? 'selected' : '' }}>{{ $k }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            <div class="card-body">
                @if($siswa_list->count() > 0)
                <div class="row">
                    @foreach($siswa_list as $s)
                    <div class="col-md-6 mb-2">
                        <div class="d-flex align-items-center p-3" style="background:var(--bg-card-hover);border-radius:12px">
                            <div class="stat-icon me-3" style="width:40px;height:40px;font-size:1rem;background:rgba(99,102,241,.15);color:var(--info)"><i class="fas fa-book"></i></div>
                            <div class="flex-grow-1">
                                <strong style="font-size:.85rem;color: white !important">{{ $s->nama }}</strong>
                                <div style="font-size:.75rem;color: white !important">{{ $s->nis }} — {{ $s->kelas ?? '-' }}</div>
                            </div>
                            <a href="{{ route('cetak.buku-induk', $s) }}" class="btn btn-sm btn-primary" title="Cetak"><i class="fas fa-print"></i></a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4" style="color: white !important">
                    <i class="fas fa-info-circle fa-3x mb-3"></i>
                    <p>Tidak ada data siswa</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
