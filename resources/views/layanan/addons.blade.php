<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Ons</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        /* reuse same styles as layanan pages (kept local for simplicity) */
        body{font-family:'Poppins',sans-serif;background:#f3f6fa;min-height:100vh;display:flex}
        .main-content{flex:1;margin-left:60px}
        .header{background:#f8fafc;padding:18px 24px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #eef2f7}
        .header-left h1{font-size:18px;color:#0f172a;margin:0}
        .header-left p{margin:0;color:#6b7280;font-size:12px}
        .content{padding:20px}
        .layout{display:grid;grid-template-columns:220px 1fr;gap:20px;align-items:start}
        .card{background:#fff;border-radius:10px;padding:18px;box-shadow:0 6px 20px rgba(11,22,39,0.04)}
        .left-nav .nav-item{display:block;padding:12px;border-radius:8px;margin-bottom:10px;color:#0f172a;background:transparent;cursor:pointer;text-decoration:none;width:100%;}
        .left-nav .nav-item:hover,.left-nav .nav-item.active{background:#eef2ff;color:#0f172a}
        .left-nav .nav-item .meta{display:block;color:#6b7280;font-size:12px;margin-top:6px}
        .left-nav.card{align-self:start;overflow:hidden;padding:12px}
        .title-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px}
        .big-title{font-size:22px;font-weight:600;color:#0f172a}
        .meta{color:#6b7280;font-size:13px}
        .feature-list{font-size:14px;color:#374151;line-height:1.6}
        .image-wrap .hero{width:100%;height:220px;background:#eef2f7;border-radius:12px;display:flex;align-items:center;justify-content:center;overflow:hidden}
        .thumbs{display:flex;gap:8px}
        .thumb{width:56px;height:56px;border-radius:8px;background:#fff;border:1px solid #eef2f7;display:flex;align-items:center;justify-content:center;overflow:hidden}
        .image-row{display:flex;justify-content:space-between;align-items:center;margin-top:10px}
        .action-buttons{display:flex;gap:8px}
        .icon-btn{width:44px;height:44px;border-radius:10px;background:#fff;border:1px solid #eef2f7;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:18px;color:#374151}
        .price-row{display:flex;justify-content:space-between;align-items:center;margin-top:12px}
        .terms-checkbox{display:flex;gap:8px;align-items:flex-start;margin-top:10px}
        .activate{margin-top:12px}
        .price-box{background:#fff;border-radius:10px;padding:14px;width:100%;box-shadow:0 6px 20px rgba(11,22,39,0.04)}
        .activate{background:#2563eb;color:#fff;padding:10px 14px;border-radius:8px;border:none;cursor:pointer;width:100%}
        @media (max-width:767px){.layout{grid-template-columns:1fr;gap:12px}.main-content{margin-left:0}.left-nav.card{order:0;display:block;padding:8px;border-radius:10px;text-align:center}.left-nav .nav-item{display:inline-block;padding:8px 12px;border-radius:8px;margin:8px 0;min-width:0;white-space:nowrap}.left-nav .nav-item .meta{display:none}}
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
                    <a href="{{ url('/layanan/telekonsultasi') }}" class="nav-item">Telekonsultasi</a>
                    <a href="{{ url('/layanan/add-ons') }}" class="nav-item active">Add Ons</a>
                </aside>

                <style>
                    .addons-search { font-size:14px; }
                    .addons-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap:16px; }
                    .addon-card { background:#fff;border:1px solid #eef2f7;border-radius:8px;padding:18px;box-shadow:0 1px 0 rgba(16,24,40,0.03);position:relative;min-height:130px }
                    .addon-card h3{margin:0 0 6px 0;font-size:16px}
                    .addon-card .muted{color:#6b7280;font-size:13px;margin-bottom:12px}
                    .activate-small{position:absolute;right:12px;top:12px;background:#fff;border:1px solid #e6edf5;padding:6px 10px;border-radius:8px;font-size:13px;color:#0f172a;cursor:pointer;display:flex;align-items:center;gap:8px}
                    .activate-small i{font-size:14px;color:#2563eb}
                    .addon-benefit{display:inline-block;color:#2563eb;font-weight:600;text-decoration:none;font-size:13px}
                    .no-results{color:#6b7280;font-size:14px;padding:8px 0}
                    @media (max-width: 767px){
                        .addons-grid{grid-template-columns:repeat(1,1fr)}
                        .activate-small{padding:6px 10px}
                    }
                </style>

                <section class="card">
                    <div class="title-row" style="flex-direction:column;align-items:flex-start;gap:12px">
                        <div style="width:100%">
                            <h2 class="big-title">Add Ons</h2>
                            <p class="meta">Tambahan layanan untuk meningkatkan pengalaman pasien dan operasional klinik.</p>
                        </div>

                        <div style="width:100%">
                            <div style="margin-bottom:12px">
                                <div style="position:relative">
                                        <input type="search" placeholder="Cari nama add on" class="addons-search" style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #e6edf5;background:#fff;box-shadow:none;outline:none" />
                                    </div>
                                    <div class="no-results" style="display:none">Tidak ada add-on yang cocok.</div>
                            </div>

                            <div class="addons-grid">
                                <div class="addon-card">
                                    <button class="activate-small"><i class="fas fa-plug"></i> Aktifkan</button>
                                    <h3>Discount Pack</h3>
                                    <p class="muted">Fitur yang memberikan potongan harga kepada pasien pada layanan tertentu, paket perawatan, atau pembelian produk.</p>
                                    <a href="#" class="addon-benefit">Benefit yang didapatkan</a>
                                </div>

                                <div class="addon-card">
                                    <button class="activate-small"><i class="fas fa-plug"></i> Aktifkan</button>
                                    <h3>Voucher Pack</h3>
                                    <p class="muted">Fitur yang memungkinkan klinik untuk menyediakan voucher khusus kepada pasien yang dapat digunakan sebagai potongan harga.</p>
                                    <a href="#" class="addon-benefit">Benefit yang didapatkan</a>
                                </div>

                                <div class="addon-card">
                                    <button class="activate-small"><i class="fas fa-plug"></i> Aktifkan</button>
                                    <h3>Booking Fee Pack</h3>
                                    <p class="muted">Fitur untuk menerima pembayaran awal saat pasien melakukan reservasi layanan di klinik.</p>
                                    <a href="#" class="addon-benefit">Benefit yang didapatkan</a>
                                </div>

                                <div class="addon-card">
                                    <button class="activate-small"><i class="fas fa-plug"></i> Aktifkan</button>
                                    <h3>Deposit Pack</h3>
                                    <p class="muted">Fitur untuk menerima pembayaran di muka yang dapat digunakan oleh pasien untuk layanan di masa mendatang.</p>
                                    <a href="#" class="addon-benefit">Benefit yang didapatkan</a>
                                </div>

                                <div class="addon-card">
                                    <button class="activate-small"><i class="fas fa-plug"></i> Aktifkan</button>
                                    <h3>AI Pack</h3>
                                    <p class="muted">Fitur AI yang mempercepat proses diagnosis, dokumentasi medis, dan rekomendasi perawatan.</p>
                                    <a href="#" class="addon-benefit">Benefit yang didapatkan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Right sidebar removed as requested -->
            </div>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
        document.querySelectorAll('.collapsible').forEach(function(el){
            var toggle = el.querySelector('.collapse-toggle');
            var content = el.querySelector('.collapse-content');
            toggle.setAttribute('aria-expanded','false');
            el.classList.remove('open');
            toggle.addEventListener('click', function(){
                var expanded = toggle.getAttribute('aria-expanded') === 'true';
                toggle.setAttribute('aria-expanded', String(!expanded));
                if(expanded){ el.classList.remove('open'); } else { el.classList.add('open'); }
            });
        });

        // Add-ons client-side search
        var searchInput = document.querySelector('.addons-search');
        var grid = document.querySelector('.addons-grid');
        var noResults = document.querySelector('.no-results');
        if(searchInput && grid){
            searchInput.addEventListener('input', function(){
                var q = this.value.trim().toLowerCase();
                var cards = grid.querySelectorAll('.addon-card');
                var visible = 0;
                cards.forEach(function(card){
                    var title = (card.querySelector('h3') && card.querySelector('h3').textContent || '').toLowerCase();
                    var desc = (card.querySelector('.muted') && card.querySelector('.muted').textContent || '').toLowerCase();
                    if(!q || title.indexOf(q) !== -1 || desc.indexOf(q) !== -1){
                        card.style.display = '';
                        visible++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                if(noResults) noResults.style.display = (visible === 0 ? 'block' : 'none');
            });
        }
    });
    </script>

</body>
</html>
