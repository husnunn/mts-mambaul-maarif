@extends('layouts.app')
@section('title', 'Data Siswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="font-weight:800;letter-spacing:-.02em;margin:0"><i class="fas fa-database me-2"></i>Data Siswa</h2>
    <a href="{{ route('siswa.create') }}" class="btn btn-primary"><i class="fas fa-user-plus me-2"></i>Tambah Siswa</a>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('siswa.index') }}" class="d-flex gap-2 flex-wrap">
            <div class="input-group" style="max-width:350px">
                <input type="text" name="keyword" class="form-control" placeholder="Cari NIS / Nama..." value="{{ $keyword ?? '' }}">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
            <select name="kelas" class="form-select" style="max-width:180px" onchange="this.form.submit()">
                <option value="">Semua Kelas</option>
                @foreach($kelas_list as $k)
                <option value="{{ $k }}" {{ ($kelas ?? '') == $k ? 'selected' : '' }}>{{ $k }}</option>
                @endforeach
            </select>
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary"><i class="fas fa-redo"></i></a>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive text-white">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th><th>NIS</th><th>Nama Siswa</th><th>Kelas</th><th>JK</th><th>Telepon</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswa_list as $i => $s)
                    <tr>
                        <td>{{ $siswa_list->firstItem() + $i }}</td>
                        <td>{{ $s->nis }}</td>
                        <td>{{ $s->nama }}</td>
                        <td><span class="badge bg-info">{{ $s->kelas ?? '-' }}</span></td>
                        <td>{{ $s->jenis_kelamin_label }}</td>
                        <td>{{ $s->telepon ?? '-' }}</td>
                        <td>
                            <a href="{{ route('siswa.show', $s) }}" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('siswa.edit', $s) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('siswa.destroy', $s) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus data siswa ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-4" style="color:var(--text-muted)">Tidak ada data siswa</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $siswa_list->withQueryString()->links() }}
    </div>
</div>
@endsection
