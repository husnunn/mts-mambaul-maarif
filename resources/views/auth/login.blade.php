<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Buku Induk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body{font-family:'Inter',sans-serif;background:#0f172a;height:100vh;display:flex;align-items:center;justify-content:center;margin:0}
        .login-container{max-width:420px;width:100%;padding:0 20px}
        .login-card{background:#1e293b;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,0,.4);overflow:hidden;border:1px solid rgba(148,163,184,.1)}
        .login-header{background:linear-gradient(135deg,#1e3a5f,#2d5a8e,#0ea5e9);color:#fff;padding:40px 30px;text-align:center}
        .login-header .brand-icon{width:60px;height:60px;background:rgba(255,255,255,.15);border-radius:16px;display:inline-flex;align-items:center;justify-content:center;font-size:1.5rem;margin-bottom:16px}
        .login-header h3{font-weight:800;font-size:1.3rem;margin-bottom:4px;letter-spacing:-.02em}
        .login-header p{opacity:.85;font-size:.85rem;margin:0}
        .login-body{padding:36px}
        .login-body .form-label{color:#94a3b8;font-size:.8rem;font-weight:600}
        .login-body .form-control{background:#0f172a;border:1px solid rgba(148,163,184,.1);color:#f1f5f9;border-radius:10px;padding:12px 14px}
        .login-body .form-control:focus{border-color:#0ea5e9;box-shadow:0 0 0 3px rgba(14,165,233,.15)}
        .btn-login{background:linear-gradient(135deg,#0ea5e9,#3b7ddd);color:#fff;padding:14px;border-radius:12px;font-weight:700;width:100%;border:none;font-size:.95rem;transition:all .2s}
        .btn-login:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(14,165,233,.3);color:#fff}
        .alert{border-radius:10px;font-size:.85rem;border:none}
        .alert-danger{background:rgba(239,68,68,.15);color:#ef4444;border-left:3px solid #ef4444}
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="brand-icon"><i class="fas fa-book-open"></i></div>
                <h3>Sistem Buku Induk</h3>
                <p>MTs Mamba'ul Ma'arif Denanyar Jombang</p>
            </div>
            <div class="login-body">
                @if(session('error'))
                <div class="alert alert-danger mb-3">{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt me-2"></i>Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
