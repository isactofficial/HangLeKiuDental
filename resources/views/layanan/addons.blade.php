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
        body{font-family:'Poppins',sans-serif;background:var(--main-bg);color:var(--text);min-height:100vh;display:flex}
        .main-content{flex:1;margin-left:var(--sidebar-width)}
        .header{background:var(--surface);padding:18px 24px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(0,0,0,0.04);box-shadow:0 2px 6px rgba(0,0,0,0.03)}
        .header-left h1{font-size:18px;color:var(--text);margin:0}
        .header-left p{margin:0;color:var(--muted);font-size:12px}
        .content{padding:20px}
        .layout{display:grid;grid-template-columns:220px 1fr;gap:20px;align-items:start}
        .card{background:var(--surface);border-radius:10px;padding:18px;box-shadow:0 6px 20px rgba(0,0,0,0.04)}
        .left-nav .nav-item{display:block;padding:12px;border-radius:8px;margin-bottom:10px;color:var(--text);background:transparent;cursor:pointer;text-decoration:none;width:100%;}
        .left-nav .nav-item:hover,.left-nav .nav-item.active{background:var(--main-bg);color:var(--text)}
        /* User dropdown (copied from partials/topbar for consistent behaviour) */
        .user-dropdown{display:flex;align-items:center;gap:10px;background:var(--action);padding:8px 14px;border-radius:10px;cursor:pointer;color:#fff;box-shadow:0 6px 18px rgba(0,0,0,0.06)}
        .user-avatar{width:34px;height:34px;border-radius:50%;background:var(--surface);display:flex;align-items:center;justify-content:center}
        .user-dropdown span{color:#fff;font-size:15px;font-weight:600}
        .user-dropdown-container{position:relative}
        .user-dropdown-menu{position:absolute;top:100%;right:0;margin-top:8px;background:var(--surface);border-radius:8px;box-shadow:0 4px 20px rgba(0,0,0,0.08);min-width:220px;display:none;overflow:hidden;z-index:160}
        .user-dropdown-menu.show{display:block}
        .user-dropdown-menu a,.user-dropdown-menu button{display:flex;align-items:center;gap:10px;width:100%;padding:12px 14px;color:var(--text);text-decoration:none;background:none;border:none;cursor:pointer}
        .user-dropdown-menu a:hover,.user-dropdown-menu button:hover{background:var(--main-bg)}
        .logout-btn{color:#dc2626;border-top:1px solid rgba(0,0,0,0.04);width:100%;text-align:left}
        .left-nav .nav-item .meta{display:block;color:var(--muted);font-size:12px;margin-top:6px}
        .left-nav.card{align-self:start;overflow:hidden;padding:12px}
        .title-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px}
        .big-title{font-size:22px;font-weight:600;color:var(--text)}
        .meta{color:var(--muted);font-size:13px}
        .feature-list{font-size:14px;color:var(--text);line-height:1.6}
        .image-wrap .hero{width:100%;height:220px;background:var(--main-bg);border-radius:12px;display:flex;align-items:center;justify-content:center;overflow:hidden}
        .thumbs{display:flex;gap:8px}
        .thumb{width:56px;height:56px;border-radius:8px;background:var(--surface);border:1px solid rgba(0,0,0,0.04);display:flex;align-items:center;justify-content:center;overflow:hidden}
        .image-row{display:flex;justify-content:space-between;align-items:center;margin-top:10px}
        .action-buttons{display:flex;gap:8px}
        .icon-btn{width:44px;height:44px;border-radius:10px;background:var(--surface);border:1px solid rgba(0,0,0,0.04);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:18px;color:var(--muted)}
        .price-row{display:flex;justify-content:space-between;align-items:center;margin-top:12px}
        .terms-checkbox{display:flex;gap:8px;align-items:flex-start;margin-top:10px}
        .activate{margin-top:12px}
        .price-box{background:var(--surface);border-radius:10px;padding:14px;width:100%;box-shadow:0 6px 20px rgba(0,0,0,0.04)}
        .activate{background:var(--action);color:#fff;padding:10px 14px;border-radius:8px;border:none;cursor:pointer;width:100%}
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
            <div class="header-right" style="display:flex;align-items:center;gap:12px">
                <div style="display:flex;gap:12px;align-items:center">
                    <i class="fas fa-search" style="color:var(--muted)"></i>
                    <i class="fas fa-bell" style="color:var(--muted)"></i>
                </div>

                <div class="user-dropdown-container">
                    <div class="user-dropdown" onclick="toggleUserMenu()">
                        <div class="user-avatar"><i class="fas fa-user" style="color:var(--accent);font-size:14px"></i></div>
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                        <i class="fas fa-chevron-down" style="color:white;font-size:12px"></i>
                    </div>

                    <div class="user-dropdown-menu" id="topbarUserMenu">
                        <a href="#">
                            <i class="fas fa-user-circle"></i>
                            Profile
                        </a>
                        <a href="#">
                            <i class="fas fa-cog"></i>
                            Pengaturan
                        </a>
                        <form action="{{ route('logout') }}" method="POST" style="margin:0">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>
                        </form>
                    </div>
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
                                        <input type="search" placeholder="Cari nama add on" class="addons-search" style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid rgba(0,0,0,0.04);background:var(--surface);box-shadow:none;outline:none" />
                                    </div>
                                    <div class="no-results" style="display:none">Tidak ada add-on yang cocok.</div>
                            </div>

                            <div class="addons-grid">
                                <div class="addon-card">
                                    <button class="activate-small" style="position:absolute;right:12px;top:12px;background:var(--surface);border:1px solid rgba(0,0,0,0.04);padding:6px 10px;border-radius:8px;font-size:13px;color:var(--text);cursor:pointer;display:flex;align-items:center;gap:8px"><i class="fas fa-plug" style="color:var(--accent)"></i> Aktifkan</button>
                                    <h3>Discount Pack</h3>
                                    <p class="muted">Fitur yang memberikan potongan harga kepada pasien pada layanan tertentu, paket perawatan, atau pembelian produk.</p>
                                    <a href="#" class="addon-benefit" style="color:var(--accent);font-weight:600">Benefit yang didapatkan</a>
                                </div>

                                <div class="addon-card">
                                    <button class="activate-small" style="position:absolute;right:12px;top:12px;background:var(--surface);border:1px solid rgba(0,0,0,0.04);padding:6px 10px;border-radius:8px;font-size:13px;color:var(--text);cursor:pointer;display:flex;align-items:center;gap:8px"><i class="fas fa-plug" style="color:var(--accent)"></i> Aktifkan</button>
                                    <h3>Voucher Pack</h3>
                                    <p class="muted">Fitur yang memungkinkan klinik untuk menyediakan voucher khusus kepada pasien yang dapat digunakan sebagai potongan harga.</p>
                                    <a href="#" class="addon-benefit" style="color:var(--accent);font-weight:600">Benefit yang didapatkan</a>
                                </div>

                                <div class="addon-card">
                                    <button class="activate-small" style="position:absolute;right:12px;top:12px;background:var(--surface);border:1px solid rgba(0,0,0,0.04);padding:6px 10px;border-radius:8px;font-size:13px;color:var(--text);cursor:pointer;display:flex;align-items:center;gap:8px"><i class="fas fa-plug" style="color:var(--accent)"></i> Aktifkan</button>
                                    <h3>Booking Fee Pack</h3>
                                    <p class="muted">Fitur untuk menerima pembayaran awal saat pasien melakukan reservasi layanan di klinik.</p>
                                    <a href="#" class="addon-benefit" style="color:var(--accent);font-weight:600">Benefit yang didapatkan</a>
                                </div>

                                <div class="addon-card">
                                    <button class="activate-small" style="position:absolute;right:12px;top:12px;background:var(--surface);border:1px solid rgba(0,0,0,0.04);padding:6px 10px;border-radius:8px;font-size:13px;color:var(--text);cursor:pointer;display:flex;align-items:center;gap:8px"><i class="fas fa-plug" style="color:var(--accent)"></i> Aktifkan</button>
                                    <h3>Deposit Pack</h3>
                                    <p class="muted">Fitur untuk menerima pembayaran di muka yang dapat digunakan oleh pasien untuk layanan di masa mendatang.</p>
                                    <a href="#" class="addon-benefit" style="color:var(--accent);font-weight:600">Benefit yang didapatkan</a>
                                </div>

                                <div class="addon-card">
                                    <button class="activate-small" style="position:absolute;right:12px;top:12px;background:var(--surface);border:1px solid rgba(0,0,0,0.04);padding:6px 10px;border-radius:8px;font-size:13px;color:var(--text);cursor:pointer;display:flex;align-items:center;gap:8px"><i class="fas fa-plug" style="color:var(--accent)"></i> Aktifkan</button>
                                    <h3>AI Pack</h3>
                                    <p class="muted">Fitur AI yang mempercepat proses diagnosis, dokumentasi medis, dan rekomendasi perawatan.</p>
                                    <a href="#" class="addon-benefit" style="color:var(--accent);font-weight:600">Benefit yang didapatkan</a>
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

<script>
    function toggleUserMenu(){
        const m = document.getElementById('topbarUserMenu');
        if(!m) return;
        m.classList.toggle('show');
    }
    document.addEventListener('click', function(e){
        const menu = document.getElementById('topbarUserMenu');
        const container = document.querySelector('.user-dropdown-container');
        if(!menu || !container) return;
        if(!container.contains(e.target)) menu.classList.remove('show');
    });
</script>
