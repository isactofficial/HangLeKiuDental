<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        body{font-family:Instrument Sans,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial}
        .container{max-width:900px;margin:28px auto;padding:24px}
        .card{background:#fff;padding:18px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.06)}
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('/') }}">← Kembali ke Beranda</a>
        <h1>Profil Saya</h1>
        <div class="card">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Peran:</strong> {{ $user->role }}</p>
            <p><a href="#">Ubah Profil</a> (fitur edit belum diimplementasikan)</p>
        </div>
    </div>
</body>
</html>
