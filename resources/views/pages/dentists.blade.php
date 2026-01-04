<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Our Dentists - Hanglekiu Dental Specialist</title>
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        .page-wrap{max-width:1200px;margin:0 auto;padding:0 24px}
        .page-hero{background:#FAF3E9;border-radius:12px;padding:28px;margin:22px 0}
        .page-title{margin:0;font-size:30px;color:#1b1b18}
        .page-desc{margin:10px 0 0;color:#706f6c;line-height:1.7;max-width:760px}
        .grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;margin:18px 0 30px}
        .card{background:#fff;border-radius:12px;padding:18px;box-shadow:0 8px 24px rgba(0,0,0,0.06)}
        .name{font-weight:800;margin:0 0 4px}
        .meta{color:#706f6c;margin:0;line-height:1.6}
        @media (max-width: 992px){.grid{grid-template-columns:repeat(2,minmax(0,1fr));}}
        @media (max-width: 640px){.grid{grid-template-columns:1fr;}}
    </style>
</head>
<body class="bg-[#FDFDFC] text-[#1b1b18]">
    @include('partials.header')

    <main class="page-wrap">
        <section class="page-hero">
            <h1 class="page-title">Our Dentists</h1>
            <p class="page-desc">Kenali dokter gigi kami. Pilih jadwal dan buat janji temu sesuai kebutuhan perawatan Anda.</p>
        </section>

        <section class="grid">
            @forelse($doctors as $doctor)
                <div class="card">
                    <p class="name">{{ $doctor->name }}</p>
                    @if(!empty($doctor->specialization))
                        <p class="meta">Spesialisasi: {{ $doctor->specialization }}</p>
                    @endif
                    @if(!empty($doctor->practice_hours))
                        <p class="meta">Jam praktik: {{ $doctor->practice_hours }}</p>
                    @endif
                </div>
            @empty
                <div class="card" style="grid-column:1/-1">
                    <p class="meta">Data dokter belum tersedia.</p>
                </div>
            @endforelse
        </section>
    </main>
</body>
</html>
