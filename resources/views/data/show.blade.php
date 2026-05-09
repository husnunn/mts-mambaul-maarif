@extends('layouts.app')
@section('title', 'Detail Siswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="font-weight:800;margin:0"><i class="fas fa-user me-2"></i>Detail Siswa</h2>
    <div>
        <a href="{{ route('siswa.edit', $siswa) }}" class="btn btn-warning"><i class="fas fa-edit me-2"></i>Edit</a>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="fas fa-id-card me-2"></i>Data Pribadi</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><td class="bg-light" style="width:40%"><strong>NIS</strong></td><td>{{ $siswa->nis }}</td></tr>
                    <tr><td class="bg-light"><strong>NISN</strong></td><td>{{ $siswa->nisn ?? '-' }}</td></tr>
                    <tr><td class="bg-light"><strong>Nama</strong></td><td>{{ $siswa->nama }}</td></tr>
                    <tr><td class="bg-light"><strong>Jenis Kelamin</strong></td><td>{{ $siswa->jenis_kelamin_label }}</td></tr>
                    <tr><td class="bg-light"><strong>Tempat, Tanggal Lahir</strong></td><td>{{ $siswa->tempat_lahir ?? '-' }}, {{ $siswa->tanggal_lahir?->format('d-m-Y') ?? '-' }}</td></tr>
                    <tr><td class="bg-light"><strong>Agama</strong></td><td>{{ $siswa->agama ?? '-' }}</td></tr>
                    <tr><td class="bg-light"><strong>Kelas</strong></td><td><span class="badge bg-info">{{ $siswa->kelas ?? '-' }}</span></td></tr>
                    <tr><td class="bg-light"><strong>Status</strong></td><td><span class="badge bg-{{ $siswa->status_siswa === 'aktif' ? 'success' : 'secondary' }}">{{ ucfirst($siswa->status_siswa) }}</span></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="fas fa-map-marker-alt me-2"></i>Kontak & Alamat</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><td class="bg-light" style="width:40%"><strong>Alamat</strong></td><td>{{ $siswa->alamat ?? '-' }}</td></tr>
                    <tr><td class="bg-light"><strong>Telepon</strong></td><td>{{ $siswa->telepon ?? '-' }}</td></tr>
                    <tr><td class="bg-light"><strong>Email</strong></td><td>{{ $siswa->email ?? '-' }}</td></tr>
                    <tr><td class="bg-light"><strong>Orang Tua</strong></td><td>{{ $siswa->nama_ortu ?? '-' }}</td></tr>
                    <tr><td class="bg-light"><strong>Pekerjaan Ortu</strong></td><td>{{ $siswa->pekerjaan_ortu ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
