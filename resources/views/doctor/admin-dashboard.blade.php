<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter - Hanglekiu Dental</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        :root{--surface:#FFFFFF;--main-bg:#FAF9F6;--accent:#B08D70;--action:#5F6F65;--text:#484848;--muted:#94a3b8;--sidebar-width:60px}
        body{font-family:'Poppins',sans-serif;background:var(--main-bg);color:var(--text);min-height:100vh;display:flex}
        .main{flex:1;margin-left:var(--sidebar-width)}
        .header{background:var(--surface);padding:15px 25px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(0,0,0,0.06);box-shadow:0 2px 8px rgba(0,0,0,0.04)}
        .header-left h1{color:var(--text);font-size:20px;font-weight:700}
        .header-left p{color:var(--muted);font-size:12px}
        .content{padding:20px 25px}
        .card{background:var(--surface);padding:18px;border-radius:12px;box-shadow:0 6px 20px rgba(0,0,0,0.04)}
        .title-block h1{font-size:20px;color:var(--accent);margin-bottom:6px}
        .title-block p{color:var(--muted);font-size:13px}
        table{width:100%;border-collapse:collapse}
        table thead th{color:var(--muted);text-align:left;padding:10px 6px;font-size:13px}
        table tbody td{padding:12px 6px;border-top:1px solid rgba(0,0,0,0.04)}
    </style>
</head>
<body>

@include('partials.sidebar')

<div class="main">
    <header class="header">
        <div class="header-left">
            <h1>Dashboard Dokter</h1>
            <p>hanglekiu dental specialist</p>
        </div>

        <div class="header-right">
            <form method="get" action="" style="display:flex;gap:8px;align-items:center">
                <label style="color:var(--muted);font-size:13px">Tanggal</label>
                <input type="date" name="date" value="{{ $date ?? now()->toDateString() }}" onchange="this.form.submit()">
            </form>
        </div>
    </header>

    <div class="content">
        <div class="card">
            <h3 style="margin-top:0">Dashboard Dokter</h3>
            <p style="color:var(--muted)">Ringkasan hari ini untuk Semua Dokter ({{ $date }})</p>

            <div style="margin-top:12px">
                @include('doctor.partials.appointments', ['appointments' => $appointments])
            </div>
        </div>

        <div style="height:12px"></div>
    </div>
</div>

</body>
</html>

@include('partials.sidebar')

<div class="main">
    <div class="topbar">
        <div>
            <div class="title-block">
                <h1>Dashboard Dokter</h1>
                <p>hanglekiu dental specialist</p>
            </div>
        </div>

        <div style="display:flex;align-items:center;gap:12px">
            <form method="get" action="" style="display:flex;gap:8px;align-items:center">
                <label style="color:var(--muted);font-size:13px">Tanggal</label>
                <input type="date" name="date" value="{{ $date ?? now()->toDateString() }}" onchange="this.form.submit()">
            </form>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <h3 style="margin-top:0">Dashboard Dokter</h3>
            <p style="color:var(--muted)">Ringkasan hari ini untuk Semua Dokter ({{ $date }})</p>

            <div style="margin-top:12px">
                @include('doctor.partials.appointments', ['appointments' => $appointments])
            </div>
        </div>

        <div style="height:12px"></div>
    </div>
</div>
