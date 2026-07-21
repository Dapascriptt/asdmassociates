<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — ASDM Associates</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{
            font-family:'Plus Jakarta Sans',system-ui,sans-serif;
            background:#f7fdf8;min-height:100vh;
            display:flex;align-items:center;justify-content:center;padding:20px;
        }
        .login-card{
            width:100%;max-width:380px;
            background:#fff;border:1px solid #e2e8e4;
            border-radius:10px;padding:32px 28px;
            box-shadow:0 1px 3px rgba(0,0,0,.06);
        }
        .login-brand{display:flex;align-items:center;gap:10px;margin-bottom:24px}
        .brand-logo{
            width:36px;height:36px;border-radius:8px;
            background:#166534;display:flex;align-items:center;justify-content:center;
            font-weight:700;font-size:.9rem;color:#fff;
        }
        .brand-info h1{font-size:.88rem;font-weight:700;color:#1a2e1f}
        .brand-info p{font-size:.68rem;color:#7c9484;margin-top:1px}
        .login-heading{font-size:.95rem;font-weight:700;color:#1a2e1f;margin-bottom:3px}
        .login-sub{font-size:.78rem;color:#7c9484;margin-bottom:20px}
        .form-group{display:flex;flex-direction:column;gap:4px;margin-bottom:12px}
        label{font-size:.75rem;font-weight:500;color:#4a6350}
        .form-control{
            background:#fff;border:1px solid #e2e8e4;border-radius:6px;
            color:#1a2e1f;padding:9px 11px;font-size:.82rem;font-family:inherit;
            transition:border-color .15s,box-shadow .15s;outline:none;width:100%;
        }
        .form-control:focus{border-color:#166534;box-shadow:0 0 0 3px rgba(22,101,52,.1)}
        .form-control::placeholder{color:#7c9484}
        .form-error{font-size:.7rem;color:#b91c1c;margin-top:2px}
        .checkbox-row{display:flex;align-items:center;gap:6px;margin-bottom:16px}
        .checkbox-row input{accent-color:#166534}
        .checkbox-row label{font-size:.75rem;color:#7c9484;cursor:pointer;margin:0}
        .btn-login{
            width:100%;padding:10px;border:none;border-radius:7px;
            background:#166534;color:#fff;font-size:.82rem;font-weight:600;
            cursor:pointer;font-family:inherit;transition:background .15s;
        }
        .btn-login:hover{background:#15803d}
        .alert-error{
            background:#fef2f2;border:1px solid rgba(185,28,28,.12);
            border-radius:6px;padding:9px 12px;font-size:.78rem;color:#b91c1c;margin-bottom:14px;
        }
        .alert-success{
            background:#f0fdf4;border:1px solid rgba(22,101,52,.12);
            border-radius:6px;padding:9px 12px;font-size:.78rem;color:#166534;margin-bottom:14px;
        }
        .divider{height:1px;background:#e2e8e4;margin:18px 0}
        .back-link{display:block;text-align:center;font-size:.72rem;color:#7c9484;transition:color .15s}
        .back-link:hover{color:#166534}
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-brand">
            <div class="brand-logo">A</div>
            <div class="brand-info">
                <h1>ASDM Associates</h1>
                <p>Panel Admin</p>
            </div>
        </div>

        <h2 class="login-heading">Masuk ke Panel</h2>
        <p class="login-sub">Kelola konten website ASDM Associates</p>

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                       placeholder="email@domain.com" value="{{ old('email') }}"
                       autocomplete="email" required autofocus>
                @error('email')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control"
                       placeholder="Password" autocomplete="current-password" required>
                @error('password')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="checkbox-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <div class="divider"></div>
        <a href="{{ url('/') }}" class="back-link">Kembali ke Website</a>
    </div>
</body>
</html>
