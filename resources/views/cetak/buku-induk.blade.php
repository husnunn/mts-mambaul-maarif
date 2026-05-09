<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Induk - {{ $siswa->nama }}</title>
    <style>
        body{font-family:'Times New Roman',serif;margin:20px;font-size:12pt;color:#000}
        .header{text-align:center;margin-bottom:30px;border-bottom:3px double #000;padding-bottom:15px}
        .header h2{margin:0;font-size:16pt}
        .header h3{margin:5px 0;font-size:14pt}
        .header p{margin:2px 0;font-size:10pt}
        table{width:100%;border-collapse:collapse;margin-bottom:15px}
        table.data-table td,table.data-table th{border:1px solid #000;padding:5px 8px;font-size:10pt}
        table.data-table th{background:#f0f0f0;text-align:center;font-weight:bold}
        .section-title{font-weight:bold;font-size:11pt;margin:15px 0 8px;text-transform:uppercase;border-bottom:1px solid #000;padding-bottom:3px}
        .info-row td{padding:3px 8px;font-size:10pt}
        .info-row td:first-child{width:35%;font-weight:bold}
        @media print{body{margin:0;padding:15px}.no-print{display:none}}
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom:20px;text-align:center">
        <button onclick="window.print()" style="padding:10px 30px;font-size:14px;cursor:pointer;background:#0ea5e9;color:#fff;border:none;border-radius:8px">
            <i class="fas fa-print"></i> Cetak Sekarang
        </button>
        <a href="{{ route('cetak.index') }}" style="margin-left:10px;padding:10px 20px;font-size:14px;text-decoration:none;color:#666">← Kembali</a>
    </div>

    <div class="header">
        <h2>BUKU INDUK SISWA</h2>
        <h3>MTs MAMBA'UL MA'ARIF</h3>
        <p>Denanyar Jombang — Jawa Timur</p>
    </div>

    <div class="section-title">A. KETERANGAN PRIBADI SISWA</div>
    <table>
        <tr class="info-row"><td>1. Nama Lengkap</td><td>: {{ $siswa->nama }}</td></tr>
        <tr class="info-row"><td>2. NIS</td><td>: {{ $siswa->nis }}</td></tr>
        <tr class="info-row"><td>3. NISN</td><td>: {{ $siswa->nisn ?? '-' }}</td></tr>
        <tr class="info-row"><td>4. Jenis Kelamin</td><td>: {{ $siswa->jenis_kelamin_label }}</td></tr>
        <tr class="info-row"><td>5. Tempat, Tanggal Lahir</td><td>: {{ $siswa->tempat_lahir ?? '-' }}, {{ $siswa->tanggal_lahir?->format('d F Y') ?? '-' }}</td></tr>
        <tr class="info-row"><td>6. Agama</td><td>: {{ $siswa->agama ?? '-' }}</td></tr>
        <tr class="info-row"><td>7. Alamat</td><td>: {{ $siswa->alamat ?? '-' }}</td></tr>
        <tr class="info-row"><td>8. Telepon</td><td>: {{ $siswa->telepon ?? '-' }}</td></tr>
        <tr class="info-row"><td>9. Kelas</td><td>: {{ $siswa->kelas ?? '-' }}</td></tr>
        <tr class="info-row"><td>10. Status</td><td>: {{ ucfirst($siswa->status_siswa) }}</td></tr>
    </table>

    <div class="section-title">B. KETERANGAN ORANG TUA/WALI</div>
    <table>
        <tr class="info-row"><td>1. Nama Orang Tua</td><td>: {{ $siswa->nama_ortu ?? '-' }}</td></tr>
        <tr class="info-row"><td>2. Pekerjaan</td><td>: {{ $siswa->pekerjaan_ortu ?? '-' }}</td></tr>
        @if($siswa->orangTua)
        <tr class="info-row"><td>3. Nama Ayah</td><td>: {{ $siswa->orangTua->nama_ayah ?? '-' }}</td></tr>
        <tr class="info-row"><td>4. Nama Ibu</td><td>: {{ $siswa->orangTua->nama_ibu ?? '-' }}</td></tr>
        @endif
    </table>

    @if($siswa->nilai->count() > 0)
    <div class="section-title">C. DATA NILAI</div>
    <table class="data-table">
        <thead><tr><th>No</th><th>Mata Pelajaran</th><th>Semester</th><th>Pengetahuan</th><th>Keterampilan</th><th>Sikap</th></tr></thead>
        <tbody>
            @foreach($siswa->nilai as $i => $n)
            <tr>
                <td style="text-align:center">{{ $i + 1 }}</td>
                <td>{{ $n->mata_pelajaran_kode }}</td>
                <td style="text-align:center">{{ $n->semester }}</td>
                <td style="text-align:center">{{ $n->nilai_pengetahuan ?? '-' }}</td>
                <td style="text-align:center">{{ $n->nilai_keterampilan ?? '-' }}</td>
                <td style="text-align:center">{{ $n->nilai_sikap ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</body>
</html>
