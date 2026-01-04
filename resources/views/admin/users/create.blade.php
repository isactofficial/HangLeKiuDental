<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Buat User Baru - Admin</title>
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        body{font-family:Poppins, sans-serif;background:var(--main-bg);color:var(--text)}
        .card{max-width:520px;margin:40px auto;padding:18px;background:var(--surface);border-radius:10px}
        .form-group{margin-bottom:12px}
        input,select{width:100%;padding:10px;border:1px solid #e6e6e6;border-radius:6px}
        .btn{background:var(--action);color:#fff;padding:10px;border-radius:8px;border:none}
        .muted{color:var(--muted);font-size:13px}
    </style>
</head>
<body>
    <div class="card">
        <h2>Buat User Baru</h2>
        @if(session('status'))
            <div style="background:#ecfccb;padding:10px;border-radius:6px;margin-bottom:12px">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="form-group"><input name="name" placeholder="Nama lengkap" required value="{{ old('name') }}"></div>
            <div class="form-group"><input name="email" placeholder="Email" type="email" required value="{{ old('email') }}"></div>
            <div class="form-group"><input name="password" placeholder="Password" type="password" required></div>
            <div class="form-group"><input name="password_confirmation" placeholder="Konfirmasi Password" type="password" required></div>
            <div class="form-group">
                <select name="role" required>
                    <option value="doctor">Dokter</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <button class="btn" type="submit">Buat User</button>
        </form>
    </div>
</body>
</html>
