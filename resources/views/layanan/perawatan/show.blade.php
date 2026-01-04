<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title }} - Hanglekiu Dental Specialist</title>
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        .page-wrap{max-width:1200px;margin:0 auto;padding:0 24px}
        .page-hero{background:#FAF3E9;border-radius:12px;padding:28px;margin:22px 0}
        .crumbs{font-size:13px;color:#706f6c;margin-bottom:10px}
        .crumbs a{color:#B08D70;text-decoration:none;font-weight:700}
        .page-title{margin:0;font-size:30px;color:#1b1b18}
        .page-desc{margin:10px 0 0;color:#706f6c;line-height:1.7;max-width:760px}
        .page-actions{margin-top:16px;display:flex;gap:10px;flex-wrap:wrap}
        .btn-secondary{display:inline-block;background:#fff;border:1px solid rgba(0,0,0,0.08);padding:10px 16px;border-radius:999px;color:#1b1b18;font-weight:700;text-decoration:none}
        .content-card{background:#fff;border-radius:12px;padding:18px;box-shadow:0 8px 24px rgba(0,0,0,0.06);margin:18px 0}
        .content-card h2{margin:0 0 8px;color:#B08D70}
        .content-card p{margin:0;color:#706f6c;line-height:1.7}
    </style>
</head>
<body class="bg-[#FDFDFC] text-[#1b1b18]">
    @include('partials.header')

    <main class="page-wrap">
        <section class="page-hero">
            <div class="crumbs">
                <a href="{{ url('/') }}">Beranda</a>
                <span> / </span>
                <span>Layanan & Perawatan</span>
                <span> / </span>
                <span>{{ $title }}</span>
            </div>

            <h1 class="page-title">{{ $title }}</h1>
            <p class="page-desc">
                {{ $description ?? ('Informasi singkat mengenai layanan ' . $title . '.') }}
            </p>

            <div class="page-actions">
                <a class="btn-secondary" href="{{ url('/#layanan') }}">Kembali ke daftar layanan</a>
                <a class="btn-cta" href="{{ route('booking.create') }}">Buat Janji Temu</a>
            </div>
        </section>

        <section class="content-card">
            <h2>Ringkasan</h2>
            <p>
                Jika ingin informasi lebih lengkap (indikasi, proses tindakan, estimasi durasi, dan perawatan setelah tindakan), beritahu aku konten yang mau ditonjolkan.
            </p>
        </section>
    </main>
</body>
</html>
