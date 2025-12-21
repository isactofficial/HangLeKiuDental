<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Telekonsultasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        body{font-family:'Poppins',sans-serif;background:#f3f6fa;min-height:100vh;display:flex}
        .main-content{flex:1;margin-left:60px}
        .header{background:#f8fafc;padding:18px 24px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #eef2f7}
        .header-left h1{font-size:18px;color:#0f172a;margin:0}
        .header-left p{margin:0;color:#6b7280;font-size:12px}
        .content{padding:20px}
        .layout{display:grid;grid-template-columns:220px 1fr 360px;gap:20px;align-items:start}
        .card{background:#fff;border-radius:10px;padding:18px;box-shadow:0 6px 20px rgba(11,22,39,0.04)}
        .left-nav .nav-item{display:block;padding:12px;border-radius:8px;margin-bottom:10px;color:#0f172a;background:transparent;cursor:pointer;text-decoration:none;width:100%;}
        .left-nav .nav-item:hover,
        .left-nav .nav-item:active,
        .left-nav .nav-item.active{
            background:#eef2ff;
            color:#0f172a;
            box-shadow:none;
        }
        .left-nav .nav-item .meta{display:block;color:#6b7280;font-size:12px;margin-top:6px}
        .left-nav.card{align-self:start;overflow:hidden;padding:12px}
        .title-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px}
        .big-title{font-size:22px;font-weight:600;color:#0f172a}
        .meta{color:#6b7280;font-size:13px}
        .feature-list{font-size:14px;color:#374151;line-height:1.6}
        .right-side .image-wrap{display:flex;flex-direction:column;gap:12px}
        .image-wrap .hero{width:100%;height:220px;background:#eef2f7;border-radius:12px;display:flex;align-items:center;justify-content:center;overflow:hidden;padding:6px}
        .thumbs{display:flex;gap:10px;align-items:center}
        .thumb{width:60px;height:48px;border-radius:8px;background:#fff;border:1px solid #eef2f7;display:flex;align-items:center;justify-content:center;overflow:hidden;padding:4px}
        .image-row{display:flex;justify-content:space-between;align-items:center;margin-top:12px}
        .action-buttons{display:flex;gap:8px}
        .icon-btn{width:44px;height:44px;border-radius:10px;background:#fff;border:1px solid #eef2f7;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:18px;color:#374151}
        .price-row{display:flex;justify-content:space-between;align-items:center;margin-top:14px}
        .price-row .muted{margin:0}
        .price-row .price-free{font-weight:700;color:#0f172a}
        .terms-checkbox{display:flex;gap:8px;align-items:flex-start;margin-top:10px}
        .terms-checkbox input[type="checkbox"]{width:18px;height:18px;border-radius:4px;margin-top:4px}
        .activate{margin-top:12px}
        .price-box{background:#fff;border-radius:10px;padding:14px;box-shadow:0 6px 20px rgba(11,22,39,0.04)}
        .price-free{color:#0f172a;font-weight:700}
        .activate{background:#2563eb;color:#fff;padding:10px 14px;border-radius:8px;border:none;cursor:pointer;width:100%}
        .muted{color:#6b7280;font-size:13px}
        /* Responsive breakpoints: desktop, tablet, mobile */
        @media (min-width:1200px){
            .layout{grid-template-columns:220px 1fr 360px}
            .main-content{margin-left:60px}
        }

        @media (min-width:768px) and (max-width:1199px){
            .layout{grid-template-columns:200px 1fr 320px;gap:16px}
            .image-wrap .hero{height:200px}
            .thumb{width:52px;height:44px}
        }

        @media (max-width:767px){
            .layout{grid-template-columns:1fr;gap:12px}
            .main-content{margin-left:0}
            /* Keep left-nav vertical but size each item to its text */
            .left-nav.card{order:0;display:block;padding:8px;border-radius:10px;text-align:center}
            .left-nav .nav-item{display:inline-block;padding:8px 12px;border-radius:8px;margin:8px 0;min-width:0;white-space:nowrap}
            .left-nav .nav-item .meta{display:none}
            .card{padding:12px}
            .price-box{padding:12px}
            .image-wrap .hero{height:160px;border-radius:10px}
            .thumb{width:44px;height:44px}
            .icon-btn{width:40px;height:40px}
            .price-row{flex-direction:row;gap:8px}
            .terms-checkbox{align-items:flex-start}
            .activate{width:100%}
        }

        /* Collapsible styles */
        .collapse-toggle{width:100%;display:flex;justify-content:space-between;align-items:center;padding:12px;border-radius:8px;border:1px solid #eef2f7;background:#fff;cursor:pointer;font-size:14px;font-weight:600}
        .collapse-toggle:hover{background:#f8fafc}
        .collapse-toggle:focus{outline:none;box-shadow:0 0 0 3px rgba(59,130,246,0.12)}
        .collapse-content{overflow:hidden;max-height:0;transition:max-height 280ms ease;padding:0 4px}
        .collapsible.open .collapse-content{max-height:1000px;padding-top:12px}
        .chevron{transition:transform 200ms ease;color:#374151}
        .collapsible.open .chevron{transform:rotate(180deg)}
        .terms-card .btn-terms{font-weight:600}
        .terms-row:hover{background:#fbfdff}
    </style>
</head>
<body>
    @include('partials.sidebar')

    <main class="main-content">
        <header class="header">
            <div class="header-left">
                <h1>Layanan Tambahan</h1>
                <p>hanglekiu dental specialist</p>
            </div>
            <div class="header-right">
                <div style="display:flex;gap:12px;align-items:center">
                    <i class="fas fa-search" style="color:#6b7280"></i>
                    <i class="fas fa-bell" style="color:#6b7280"></i>
                    <div style="background:#3b82f6;color:#fff;padding:8px 12px;border-radius:8px">{{ Auth::user()->name ?? 'Admin' }}</div>
                </div>
            </div>
        </header>

        <div class="content">
            <div class="layout">
                <aside class="left-nav card">
                    <a href="{{ url('/layanan-tambahan') }}" class="nav-item">AntriCepat<br><span class="meta">Online Appointment</span></a>
                    <a href="{{ url('/layanan/telekonsultasi') }}" class="nav-item active">Telekonsultasi</a>
                    <a href="{{ url('/layanan/add-ons') }}" class="nav-item">Add Ons</a>
                </aside>

                <section class="card">
                    <div class="title-row">
                        <div>
                            <h2 class="big-title">Telekonsultasi</h2>
                            <p class="meta">Konsultasi dokter lewat genggaman Anda, kapan saja dan di mana saja.</p>
                            <div class="muted" style="margin-top:8px;display:flex;align-items:center;gap:8px">
                                <i class="fas fa-info-circle" style="color:#6b7280;font-size:16px"></i>
                                <div>1.570 klinik telah menggunakan fitur ini.</div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:8px;">
                        <div class="collapsible" style="margin-bottom:12px;">
                            <button class="collapse-toggle" aria-expanded="false" type="button">
                                <strong>Keuntungan</strong>
                                <i class="fas fa-chevron-down chevron" aria-hidden="true" style="margin-left:8px"></i>
                            </button>

                            <div class="collapse-content">
                                <div class="card" style="padding:12px;margin-top:8px">
                                    <div class="feature-list">
                                        <p><strong>Bagi Pasien :</strong></p>
                                        <ul>
                                            <li><strong>Booking Cepat dan Mudah:</strong> Tak perlu antre lama, booking janji dokter kapanpun lewat smartphone.</li>
                                            <li><strong>Hemat Waktu dan Biaya:</strong> Hindari macet dan antrean panjang, nikmati waktu tunggu yang lebih singkat dan hemat biaya transportasi.</li>
                                            <li><strong>Ingat Janji Pasti:</strong> Dapatkan pengingat janji otomatis, sehingga tidak perlu khawatir lupa jadwal konsultasi.</li>
                                        </ul>

                                        <p style="margin-top:8px"><strong>Bagi Klinik :</strong></p>
                                        <ul>
                                            <li><strong>Manajemen Jadwal Efektif:</strong> Atur jadwal dokter dan pasien dengan lebih rapi, hindari penumpukan pasien dan tingkatkan efisiensi pelayanan.</li>
                                            <li><strong>Reputasi Meningkat:</strong> Ciptakan citra profesional dan modern dengan layanan AntriCepat yang mudah diakses pasien.</li>
                                            <li><strong>Pasien Puas, Fasilitas Bahagia:</strong> Tingkatkan kepuasan pasien dengan pelayanan yang lebih cepat dan terarah, berujung pada reputasi dan profit yang lebih baik.</li>
                                            <li><strong>Kurangi Antrean Panjang:</strong> Hindari penumpukan pasien di ruang tunggu, ciptakan lingkungan yang lebih nyaman dan aman bagi pasien dan staf.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top:14px">
                            <a href="#" class="terms-row" style="display:flex;justify-content:space-between;align-items:center;padding:12px;border:1px solid #eef2f7;border-radius:8px;background:#fff;text-decoration:none;color:inherit">
                                <div style="display:flex;flex-direction:column;gap:4px">
                                    <span style="color:#2563eb;font-weight:600">Syarat dan Ketentuan</span>
                                    <span class="muted" style="font-size:13px">Baca syarat lengkap sebelum mengaktivasi layanan.</span>
                                </div>
                                <div style="display:flex;align-items:center;gap:10px">
                                    <i class="fas fa-external-link-alt" style="color:#2563eb;font-size:13px"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </section>

                <aside style="display:flex;flex-direction:column;gap:12px">
                    <div class="price-box">
                        <div class="image-wrap">
                            <div class="hero">
                                <img src="{{ asset('assets/telekonsultasi1.png') }}" alt="Telekonsultasi" style="width:100%;height:100%;object-fit:cover">
                            </div>
                            <div class="image-row">
                                <div class="thumbs">
                                    <div class="thumb"><img src="{{ asset('assets/telekonsultasi2.png') }}" alt="" style="width:100%;height:100%;object-fit:cover"></div>
                                    <div class="thumb"><img src="{{ asset('assets/telekonsultasi3.png') }}" alt="" style="width:100%;height:100%;object-fit:cover"></div>
                                    <div class="thumb"><img src="{{ asset('assets/telekonsultasi4.png') }}" alt="" style="width:100%;height:100%;object-fit:cover"></div>
                                </div>
                                <div class="action-buttons">
                                    <button class="icon-btn" aria-label="Bantuan"><i class="fas fa-question"></i></button>
                                    <button class="icon-btn" aria-label="Chat"><i class="fab fa-whatsapp"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="price-row">
                            <p class="muted">Total Harga</p>
                            <div class="price-free">Gratis</div>
                        </div>

                        <div class="terms-checkbox">
                            <input type="checkbox" id="agree-tele" />
                            <label for="agree-tele" class="muted" style="line-height:1.4">Saya telah membaca serta menyetujui semua syarat dan ketentuan yang berlaku.</label>
                        </div>

                        <div>
                            <button class="activate">Aktivasi Sekarang</button>
                        </div>
                    </div>

                    <div class="card muted" style="text-align:center">
                        <i class="fas fa-info-circle" style="color:#3b82f6;font-size:20px;margin-bottom:8px"></i>
                        <div style="font-size:13px">Butuh bantuan? Hubungi tim support kami.</div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        document.querySelectorAll('.collapsible').forEach(function(el){
            var toggle = el.querySelector('.collapse-toggle');
            var content = el.querySelector('.collapse-content');
            // start collapsed (false)
            toggle.setAttribute('aria-expanded','false');
            el.classList.remove('open');

            toggle.addEventListener('click', function(){
                var expanded = toggle.getAttribute('aria-expanded') === 'true';
                toggle.setAttribute('aria-expanded', String(!expanded));
                if(expanded){
                    el.classList.remove('open');
                } else {
                    el.classList.add('open');
                }
            });
        });
    });
</script>

</body>
</html>
