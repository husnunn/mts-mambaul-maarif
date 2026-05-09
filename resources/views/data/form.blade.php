@extends('layouts.app')
@section('title', $action === 'edit' ? 'Edit Siswa' : 'Tambah Siswa')
@section('content')
<h2 class="mb-4" style="font-weight:800"><i class="fas fa-{{ $action === 'edit' ? 'edit' : 'user-plus' }} me-2"></i>{{ $action === 'edit' ? 'Edit Data Siswa' : 'Tambah Siswa Baru' }}</h2>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ $siswa_data ? route('siswa.update', $siswa_data) : route('siswa.store') }}">
            @csrf
            @if($siswa_data) @method('PUT') @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">NIS <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{ old('nis', $siswa_data?->nis) }}" required>
                        @error('nis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NISN</label>
                        <input type="text" class="form-control" name="nisn" value="{{ old('nisn', $siswa_data?->nisn) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $siswa_data?->nama) }}" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kelas</label>
                                <select class="form-select" name="kelas">
                                    <option value="">Pilih Kelas</option>
                                    @foreach(['VII-A','VII-B','VIII-A','VIII-B','IX-A','IX-B'] as $k)
                                    <option value="{{ $k }}" {{ old('kelas', $siswa_data?->kelas) == $k ? 'selected' : '' }}>{{ $k }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                                    <option value="">Pilih</option>
                                    <option value="L" {{ old('jenis_kelamin', $siswa_data?->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $siswa_data?->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa_data?->tempat_lahir) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa_data?->tanggal_lahir?->format('Y-m-d')) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="2">{{ old('alamat', $siswa_data?->alamat) }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Orang Tua</label>
                                <input type="text" class="form-control" name="nama_ortu" value="{{ old('nama_ortu', $siswa_data?->nama_ortu) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Telepon</label>
                                <input type="text" class="form-control" name="telepon" value="{{ old('telepon', $siswa_data?->telepon) }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $siswa_data?->email) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Agama</label>
                        <select class="form-select" name="agama">
                            @foreach(['Islam','Kristen','Katolik','Hindu','Budha','Konghucu'] as $a)
                            <option value="{{ $a }}" {{ old('agama', $siswa_data?->agama ?? 'Islam') == $a ? 'selected' : '' }}>{{ $a }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
