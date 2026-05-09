<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <header class="main-header">
        <div class="header-content">
            <div style="display:flex;align-items:center;gap:12px">
                <button class="sidebar-toggle" onclick="document.querySelector('.main-sidebar').classList.toggle('show')">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{ route('dashboard') }}" class="header-brand">
                    <div class="header-brand-icon"><i class="fas fa-book-open"></i></div>
                    <div>
                        <h1>Sistem Buku Induk</h1>
                        <small>MTs Mamba'ul Ma'arif — Denanyar Jombang</small>
                    </div>
                </a>
            </div>
            <div class="header-right">
                <div class="header-user">
                    <div>
                        <div class="header-user-name">{{ Auth::user()->name }}</div>
                        <div class="header-user-role">{{ ucfirst(Auth::user()->role) }}</div>
                    </div>
                    <div class="header-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin:0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-logout"><i class="fas fa-sign-out-alt"></i></button>
                </form>
            </div>
        </div>
    </header>

    <aside class="main-sidebar">
        <p class="sidebar-section-title">Menu Utama</p>
        <ul class="sidebar-nav">
            <li class="sidebar-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a>
            </li>
            <li class="sidebar-nav-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                <a href="{{ route('siswa.index') }}"><span class="nav-icon"><i class="fas fa-database"></i></span> Input Data</a>
            </li>
            <li class="sidebar-nav-item {{ request()->routeIs('cetak.*') ? 'active' : '' }}">
                <a href="{{ route('cetak.index') }}"><span class="nav-icon"><i class="fas fa-print"></i></span> Cetak Data</a>
            </li>
        </ul>
        <div class="sidebar-divider"></div>
        <p class="sidebar-section-title">Pengaturan</p>
        <ul class="sidebar-nav">
            <li class="sidebar-nav-item {{ request()->routeIs('lembaga.*') ? 'active' : '' }}">
                <a href="{{ route('lembaga.index') }}"><span class="nav-icon"><i class="fas fa-school"></i></span> Data Lembaga</a>
            </li>
            <li class="sidebar-nav-item {{ request()->routeIs('nilai.*') ? 'active' : '' }}">
                <a href="{{ route('nilai.index') }}"><span class="nav-icon"><i class="fas fa-chart-line"></i></span> Input Nilai</a>
            </li>
        </ul>
        <div class="sidebar-divider"></div>
        <ul class="sidebar-nav">
            <li class="sidebar-nav-item">
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-sidebar').submit();">
                    <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span> Logout
                </a>
                <form id="logout-sidebar" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
            </li>
        </ul>
    </aside>

    <main class="main-content animate-fade-in">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show"><i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @yield('content')
        <div class="main-footer">&copy; {{ date('Y') }} Sistem Buku Induk Siswa — MTs Mamba'ul Ma'arif Denanyar Jombang</div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
