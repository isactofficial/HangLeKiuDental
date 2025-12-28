<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Hanglekiu Dental Clinic</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        /* Admin palette variables (match sidebar / topbar) */
        :root{
            --surface: #FFFFFF;
            --main-bg: #FAF9F6;
            --accent: #B08D70; /* wood tone */
            --action: #5F6F65; /* button / action color */
            --text: #484848;
            --muted: #94a3b8;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--main-bg); color: var(--text); min-height: 100vh; display:flex; align-items:center; justify-content:center; }
        .card { background:var(--surface); padding:32px; border-radius:12px; box-shadow:0 6px 24px rgba(0,0,0,0.08); width:380px; }
        .logo-text { font-size:24px; color:var(--accent); font-weight:700; text-align:center; margin-bottom:20px; }
        .form-group { margin-bottom:18px; }
        .form-group input { width:100%; padding:12px 8px; border:none; border-bottom:1px solid #e6e6e6; outline:none; background:transparent; color:var(--text); }
        .form-group input::placeholder{ color: #9aa4a0; }
        .btn { width:100%; padding:12px; background:var(--action); color:white; border:none; border-radius:8px; cursor:pointer; font-weight:600; }
        .btn:hover{ filter:brightness(.98); transform:translateY(-1px); }
        .muted { text-align:center; margin-top:12px; font-size:14px; color:var(--muted); }
        .error { color:#dc2626; font-size:13px; margin-top:6px; }

        a.link-action{ color:var(--action); font-weight:600; text-decoration:none }
        a.link-action:hover{ text-decoration:underline }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            body { padding: 20px; }
            .card { width: 100%; max-width: 420px; padding: 24px; margin: 0 12px; }
            .logo-text { font-size: 22px; }
        }

        @media (max-width: 480px) {
            .card { padding: 18px; border-radius: 10px; }
            .logo-text { font-size: 18px; }
            .form-group input { padding: 10px 6px; font-size: 14px; }
            .btn { padding: 12px; font-size: 15px; }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo-text">Hanglekiu Dental Clinic</div>

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="name" placeholder="Nama lengkap" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password (min 8)" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required autocomplete="new-password">
            </div>

            <!-- Role selection removed for public registration; default role = Dokter -->

            <button type="submit" class="btn">Daftar</button>
        </form>

        <div class="muted">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </div>
    </div>
</body>
</html>
