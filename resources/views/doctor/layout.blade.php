<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Panel Dokter') - Hanglekiu Dental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        :root{--surface:#FFFFFF;--main-bg:#FAF9F6;--accent:#B08D70;--action:#5F6F65;--text:#484848;--muted:#94a3b8;--sidebar-width:60px}
        body{font-family:'Poppins',sans-serif;background:var(--main-bg);color:var(--text);min-height:100vh;display:flex}
        .main{flex:1;margin-left:var(--sidebar-width)}
        .header{background:var(--surface);padding:15px 22px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(0,0,0,0.06);box-shadow:0 2px 8px rgba(0,0,0,0.04)}
        .header-left h1{color:var(--text);font-size:18px;font-weight:700}
        .header-left p{color:var(--muted);font-size:13px}
        .content{padding:20px 22px}
        .card{background:var(--surface);padding:18px;border-radius:12px;box-shadow:0 6px 20px rgba(0,0,0,0.04)}
            /* Doctor panel styles to match admin */
            .doctor-panel { max-width: 1100px; margin: 0; }
            .doctor-panel .panel-card { background: #ffffff; padding: 18px; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.04); margin-bottom: 16px; }
            .doctor-panel .panel-title { margin: 0 0 6px 0; font-size: 18px; font-weight: 700; color: #2b2b2b; }
            .doctor-panel .panel-subtitle { margin: 0 0 12px 0; font-size: 13px; color: #94a3b8; }
            .doctor-panel .panel-title-small { margin: 0 0 8px 0; font-size: 16px; font-weight: 600; color: #2b2b2b; }
            .doctor-panel .panel-actions { display:flex; gap:12px; margin-top:12px; }
            .doctor-panel .action-link { color: #5b21b6; text-decoration: underline; font-weight:500 }
            .doctor-panel table thead th { color:#94a3b8; font-size:13px; font-weight:600; padding:10px 6px; text-align:left }
            .doctor-panel table tbody td { padding:14px 6px; vertical-align:top; border-top:1px solid #eef2f7; color:#484848 }
            .doctor-panel .panel-body { margin-top:6px }
            /* Calendar header controls */
            .doctor-panel .panel-header { display:flex; justify-content:space-between; align-items:center; gap:12px }
            .doctor-panel .panel-date-controls { display:flex; align-items:center; gap:12px }
            .doctor-panel .date-arrow { background:#fff; border:1px solid rgba(0,0,0,0.06); padding:6px 10px; border-radius:8px; cursor:pointer; font-size:18px; line-height:1 }
            .doctor-panel .date-display { display:flex; flex-direction:column; align-items:flex-start }
            .doctor-panel .day-name { color:#b08d70; font-weight:600; margin-bottom:2px; font-size:14px }
            .doctor-panel .date-text { color:#94a3b8; font-size:13px }
            .doctor-panel .today-btn { background:#566b60; color:#fff; border:none; padding:8px 12px; border-radius:8px; cursor:pointer; font-weight:600 }

            /* Profile dropdown in header */
            .profile-dropdown{position:relative}
            .profile-btn{display:flex;align-items:center;gap:8px;border:none;background:transparent;cursor:pointer;padding:6px 8px;border-radius:8px}
            .profile-btn .avatar{display:inline-flex;width:34px;height:34px;border-radius:8px;background:var(--accent);color:#fff;align-items:center;justify-content:center;font-weight:700}
            .profile-btn .profile-name{color:var(--text);font-weight:600}
            .profile-menu{position:absolute;right:0;top:calc(100% + 8px);background:var(--surface);border-radius:8px;box-shadow:0 6px 20px rgba(0,0,0,0.08);overflow:hidden;min-width:140px;display:none;flex-direction:column}
            .profile-menu .profile-menu-item{display:block;padding:10px 12px;color:var(--text);text-decoration:none;border-bottom:1px solid rgba(0,0,0,0.04);background:transparent;text-align:left}
            .profile-menu .profile-menu-item:hover{background:rgba(0,0,0,0.03)}
            .profile-menu .logout-btn{width:100%;border:none;background:transparent;padding:10px 12px;color:#e11d48;text-align:left}
    </style>
</head>
<body>

    @include('partials.sidebar')

    <div class="main">
        <header class="header">
            <div class="header-left">
                <h1>@yield('title', 'Panel Dokter')</h1>
                <p>Halo, {{ auth()->user()->name }}</p>
            </div>

            <div class="header-right">
                <div class="profile-dropdown" id="profileDropdown">
                    <button class="profile-btn" type="button" id="profileToggle">
                        <span class="avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                        <span class="profile-name">{{ auth()->user()->name }}</span>
                        <i class="fas fa-caret-down" style="margin-left:8px;color:var(--muted)"></i>
                    </button>
                    <div class="profile-menu" id="profileMenu" aria-hidden="true">
                        <a href="#" class="profile-menu-item">Profil</a>
                        <form action="{{ route('logout') }}" method="POST" style="margin:0">
                            @csrf
                            <button type="submit" class="profile-menu-item logout-btn">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="content">
            @yield('content')
        </div>
    </div>

</body>
<script>
    // simple toggle for profile dropdown
    (function(){
        document.addEventListener('click', function(e){
            var toggle = document.getElementById('profileToggle');
            var menu = document.getElementById('profileMenu');
            if(!toggle || !menu) return;
            if(toggle.contains(e.target)){
                // toggle
                var visible = menu.style.display === 'flex';
                menu.style.display = visible ? 'none' : 'flex';
            } else {
                // click outside -> hide
                if(!menu.contains(e.target)) menu.style.display = 'none';
            }
        });
    })();
</script>
</html>

