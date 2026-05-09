@extends('layouts.app')
@section('title', 'Data Lembaga')
@section('content')
<h2 class="mb-4" style="font-weight:800"><i class="fas fa-school me-2"></i>Data Lembaga</h2>

<div class="card">
    <div class="card-header"><i class="fas fa-university me-2"></i>IDENTITAS MADRASAH</div>
    <div class="card-body">
        <form method="POST" action="{{ route('lembaga.store') }}">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr><td class="bg-light" style="width:40%"><strong>NAMA LEMBAGA</strong></td><td><input type="text" class="form-control form-control-sm" name="nama_lembaga" value="{{ old('nama_lembaga', $lembaga->nama_lembaga ?? "MTs MAMBA'UL MA'ARIF") }}" required></td></tr>
                        <tr><td class="bg-light"><strong>KELAS</strong></td><td><select class="form-select form-select-sm" name="kelas"><option value="">Pilih</option>@foreach(['VII','VIII','IX'] as $k)<option value="{{ $k }}" {{ old('kelas', $lembaga?->kelas) == $k ? 'selected' : '' }}>{{ $k }}</option>@endforeach</select></td></tr>
                        <tr><td class="bg-light"><strong>TAHUN PELAJARAN</strong></td><td><input type="text" class="form-control form-control-sm" name="tahun_pelajaran" value="{{ old('tahun_pelajaran', $lembaga->tahun_pelajaran ?? '2024/2025') }}" required></td></tr>
                        <tr><td class="bg-light"><strong>NPSN</strong></td><td><input type="text" class="form-control form-control-sm" name="npsn" value="{{ old('npsn', $lembaga->npsn ?? '20582346') }}" required></td></tr>
                        <tr><td class="bg-light"><strong>NO. URUT MADRASAH</strong></td><td><input type="text" class="form-control form-control-sm" name="no_urut_madrasah" value="{{ old('no_urut_madrasah', $lembaga->no_urut_madrasah ?? '523') }}" required></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr><td class="bg-light" style="width:40%"><strong>KAB/KOTA</strong></td><td><input type="text" class="form-control form-control-sm" name="kabupaten_kota" value="{{ old('kabupaten_kota', $lembaga->kabupaten_kota ?? 'Jombang') }}" required></td></tr>
                        <tr><td class="bg-light"><strong>KODE KAB/KOTA</strong></td><td><input type="text" class="form-control form-control-sm" name="kode_kabupaten_kota" value="{{ old('kode_kabupaten_kota', $lembaga->kode_kabupaten_kota ?? '15') }}" required></td></tr>
                        <tr><td class="bg-light"><strong>PROVINSI</strong></td><td><input type="text" class="form-control form-control-sm" name="provinsi" value="{{ old('provinsi', $lembaga->provinsi ?? 'Jawa Timur') }}" required></td></tr>
                        <tr><td class="bg-light"><strong>KODE PROVINSI</strong></td><td><input type="text" class="form-control form-control-sm" name="kode_provinsi" value="{{ old('kode_provinsi', $lembaga->kode_provinsi ?? '13') }}" required></td></tr>
                        <tr><td class="bg-light"><strong>MADRASAH ASAL</strong></td><td><input type="text" class="form-control form-control-sm" name="madrasah_asal" value="{{ old('madrasah_asal', $lembaga?->madrasah_asal) }}"></td></tr>
                    </table>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr><td class="bg-light" style="width:40%"><strong>NAMA KEPALA</strong></td><td><input type="text" class="form-control form-control-sm" name="nama_kepala" value="{{ old('nama_kepala', $lembaga->nama_kepala ?? 'YUSUF, S.Ag') }}" required></td></tr>
                        <tr><td class="bg-light"><strong>NIP KEPALA</strong></td><td><input type="text" class="form-control form-control-sm" name="nip_kepala" value="{{ old('nip_kepala', $lembaga?->nip_kepala) }}"></td></tr>
                        <tr><td class="bg-light"><strong>TANGGAL KELULUSAN</strong></td><td><input type="date" class="form-control form-control-sm" name="tanggal_kelulusan" value="{{ old('tanggal_kelulusan', $lembaga?->tanggal_kelulusan?->format('Y-m-d')) }}"></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr><td class="bg-light" style="width:40%"><strong>NAMA PENGAWAS</strong></td><td><input type="text" class="form-control form-control-sm" name="nama_pengawas" value="{{ old('nama_pengawas', $lembaga->nama_pengawas ?? 'DrS. UBAIDILLAH') }}" required></td></tr>
                        <tr><td class="bg-light"><strong>NIP PENGAWAS</strong></td><td><input type="text" class="form-control form-control-sm" name="nip_pengawas" value="{{ old('nip_pengawas', $lembaga?->nip_pengawas) }}"></td></tr>
                    </table>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>Alamat Lengkap</strong></label>
                        <textarea class="form-control" name="alamat_lengkap" rows="3">{{ old('alamat_lengkap', $lembaga?->alamat_lengkap) }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>Telepon</strong></label>
                        <input type="text" class="form-control" name="telepon_madrasah" value="{{ old('telepon_madrasah', $lembaga?->telepon_madrasah) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Email</strong></label>
                        <input type="email" class="form-control" name="email_madrasah" value="{{ old('email_madrasah', $lembaga?->email_madrasah) }}">
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label"><strong>Website</strong></label>
                    <input type="text" class="form-control" name="website_madrasah" value="{{ old('website_madrasah', $lembaga?->website_madrasah) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label"><strong>Akreditasi</strong></label>
                    <select class="form-select" name="akreditasi">
                        <option value="">Pilih</option>
                        @foreach(['A' => 'A (Unggul)', 'B' => 'B (Baik)', 'C' => 'C (Cukup)', 'TT' => 'Belum Terakreditasi'] as $v => $l)
                        <option value="{{ $v }}" {{ old('akreditasi', $lembaga?->akreditasi) == $v ? 'selected' : '' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan Data Lembaga</button>
            </div>
        </form>
    </div>
</div>
@endsection
