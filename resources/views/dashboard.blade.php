@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<h2 class="mb-4" style="font-weight:800;letter-spacing:-.02em"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h2>

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-info-text">
                <h3>{{ number_format($stats['total_siswa']) }}</h3>
                <p>Total Siswa</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
            <div class="stat-info-text">
                <h3>{{ number_format($stats['total_nilai']) }}</h3>
                <p>Data Nilai</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card stat-warning">
            <div class="stat-icon"><i class="fas fa-print"></i></div>
            <div class="stat-info-text">
                <h3>{{ number_format($stats['total_cetak']) }}</h3>
                <p>Dokumen Dicetak</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
            <div class="stat-info-text">
                <h3>{{ number_format($stats['total_kelas']) }}</h3>
                <p>Kelas Aktif</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="stat-card stat-secondary">
            <div class="stat-icon"><i class="fas fa-chart-simple"></i></div>
            <div class="stat-info-text">
                <h3>{{ number_format($stats['rata_nilai'], 2) }}</h3>
                <p>Rata-rata Nilai Keseluruhan</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-bolt me-2"></i>Quick Actions</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6"><a href="{{ route('siswa.create') }}" class="btn btn-primary w-100 py-3"><i class="fas fa-user-plus me-2"></i>Tambah Siswa</a></div>
                    <div class="col-md-6"><a href="{{ route('nilai.index') }}" class="btn btn-warning w-100 py-3"><i class="fas fa-calendar-alt me-2"></i>Input Nilai</a></div>
                    <div class="col-md-6"><a href="{{ route('cetak.index') }}" class="btn btn-info w-100 py-3"><i class="fas fa-print me-2"></i>Cetak Dokumen</a></div>
                    <div class="col-md-6"><a href="{{ route('lembaga.index') }}" class="btn btn-success w-100 py-3"><i class="fas fa-school me-2"></i>Data Lembaga</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-chart-line me-2"></i>Rata-rata Nilai per Semester</div>
            <div class="card-body"><canvas id="semesterChart" height="250"></canvas></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><i class="fas fa-history me-2"></i>Aktivitas Terbaru</div>
            <div class="card-body">
                @if($activities->count() > 0)
                <div class="table-responsive text-white">
                    <table class="table table-hover">
                        <thead><tr><th>Waktu</th><th>Aktivitas</th><th>Pengguna</th><th>Detail</th></tr></thead>
                        <tbody>
                            @foreach($activities as $act)
                            <tr>
                                <td>{{ $act->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $act->aktivitas }}</td>
                                <td>{{ $act->user?->name ?? 'Sistem' }}</td>
                                <td>{{ $act->detail ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="fas fa-info-circle fa-3x mb-3" style="color:var(--text-muted)"></i>
                    <p style="color:var(--text-muted)">Belum ada aktivitas</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('semesterChart')?.getContext('2d');
if(ctx){
    const data = @json(array_values($chartData['semester']));
    new Chart(ctx,{type:'line',data:{labels:['Sem 1','Sem 2','Sem 3','Sem 4','Sem 5','Sem 6'],datasets:[{label:'Rata-rata Nilai',data:data,backgroundColor:'rgba(14,165,233,.2)',borderColor:'#0ea5e9',borderWidth:2,tension:.4,fill:true,pointBackgroundColor:'#0ea5e9'}]},options:{responsive:true,plugins:{legend:{labels:{color:'#94a3b8'}}},scales:{y:{beginAtZero:true,max:100,ticks:{color:'#64748b'},grid:{color:'rgba(148,163,184,.1)'},title:{display:true,text:'Nilai',color:'#94a3b8'}},x:{ticks:{color:'#64748b'},grid:{color:'rgba(148,163,184,.1)'}}}}});
}
</script>
@endpush
