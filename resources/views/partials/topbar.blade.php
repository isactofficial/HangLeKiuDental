<header class="topbar">
    <div class="topbar-inner">
        <div class="topbar-left">
            <div class="page-title">Katalog Harga Prosedur</div>
            <div class="last-update">Last Update : {{ date('d F Y') }}</div>
        </div>

        <div class="topbar-center">
            <form method="GET" action="{{ route('procedures.index') }}" class="top-search">
                <input type="text" name="q" placeholder="Cari Prosedur/Tindakan" value="{{ isset($q) ? e($q) : '' }}">
                <button type="submit">Cari</button>
            </form>
        </div>

        <div class="topbar-right">
            <div class="header-icons">
                <i class="fas fa-question-circle header-icon" title="Help"></i>
                <i class="fas fa-bell header-icon" title="Notifications"></i>
            </div>

            <div class="user-dropdown-container">
                <div class="user-dropdown" onclick="toggleUserMenu()">
                    <div class="user-avatar">
                        <i class="fas fa-user" style="color:var(--accent);font-size:14px"></i>
                    </div>
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

        <div class="topbar-actions">
            <a class="btn btn-primary" href="{{ route('procedures.create') }}">Tambah Prosedur</a>
            <a class="btn btn-ghost" href="{{ route('procedures.import.form') }}">Import Harga Prosedur</a>
            <a class="btn btn-ghost" href="{{ route('procedures.export') }}">Export</a>
        </div>
    </div>

    <style>
        /* Fixed rounded topbar aligned after the sidebar (dashboard style) */
        .topbar{
            position:fixed;
            top:18px;
            left:calc(var(--sidebar-width) + 18px); /* leave space for sidebar */
            right:24px;
            background:transparent;
            z-index:140;
            pointer-events:none;
        }
        .topbar-inner{
            pointer-events:auto;
            background:var(--surface);
            border-radius:14px;
            padding:14px 20px;
            display:grid;
            grid-template-columns:auto minmax(260px, 1fr) auto;
            grid-template-areas:
                "left center right"
                "actions actions actions";
            gap:12px 16px;
            align-items:center;
            box-shadow:0 10px 30px rgba(11,16,19,0.06);
        }
        .topbar-left{grid-area:left;min-width:0;display:flex;flex-direction:column;justify-content:center}
        .page-title{font-weight:800;font-size:20px;color:var(--text)}
        .last-update{font-size:12px;color:var(--muted);margin-top:4px}
        .topbar-center{grid-area:center;min-width:260px;align-self:center}
        .topbar-right{grid-area:right;display:flex;align-items:center;gap:12px;min-width:0}
        .topbar-actions{grid-area:actions;display:flex;gap:10px;align-items:center;flex-wrap:wrap}

        .btn{padding:8px 12px;border-radius:999px;border:none;cursor:pointer;font-weight:600;display:inline-flex;align-items:center;gap:8px;text-decoration:none;white-space:nowrap}
        .btn-primary{background:var(--action);color:#fff;padding:8px 14px}
        .btn-ghost{background:var(--surface);border:1px solid rgba(0,0,0,0.06);color:var(--text);padding:8px 12px}
        .btn i{font-size:14px}
        .top-search{display:flex;gap:10px;align-items:center}
        .top-search input{flex:1;height:44px;padding:0 16px;border:1px solid rgba(0,0,0,0.06);border-radius:999px;background:#fff;color:var(--text);box-shadow:inset 0 1px 0 rgba(0,0,0,0.02)}
        .top-search button{height:44px;padding:0 16px;border-radius:999px;border:1px solid rgba(0,0,0,0.06);background:var(--surface);cursor:pointer;white-space:nowrap}
        .header-icons{display:flex;gap:12px;align-items:center}
        .header-icon{color:var(--muted);font-size:16px;cursor:pointer}
        .user-dropdown{display:inline-flex;align-items:center;gap:12px;background:var(--action);padding:8px 14px;border-radius:12px;cursor:pointer;color:#fff;box-shadow:0 8px 20px rgba(0,0,0,0.06);min-height:44px}
        .user-avatar{width:32px;height:32px;border-radius:10px;background:var(--surface);display:inline-flex;align-items:center;justify-content:center;flex:0 0 auto}
        .user-dropdown span{color:#fff;font-size:14px;font-weight:700;line-height:1}
        .user-dropdown i.fas.fa-chevron-down{color:#fff;font-size:12px}
        .user-dropdown-container{position:relative}
        .user-dropdown-menu{position:absolute;top:100%;right:0;margin-top:8px;background:#fff;border-radius:8px;box-shadow:0 6px 20px rgba(0,0,0,0.12);min-width:220px;display:none;overflow:hidden;z-index:160}
        .user-dropdown-menu.show{display:block}
        .user-dropdown-menu a,.user-dropdown-menu button{display:flex;align-items:center;gap:10px;width:100%;padding:12px 14px;color:#374151;text-decoration:none;background:none;border:none;cursor:pointer}
        .user-dropdown-menu a:hover,.user-dropdown-menu button:hover{background:#f3f4f6}
        .logout-btn{color:#dc2626;border-top:1px solid #f3f4f6;width:100%;text-align:left}
    </style>

    <style>
        /* Responsive topbar when sidebar collapses on small screens */
        @media (max-width: 768px) {
            .topbar{ left:12px; right:12px; }
            .topbar-inner{padding:10px 12px 10px 72px}
            .topbar{pointer-events:auto}

            .topbar-inner{
                grid-template-columns:1fr;
                grid-template-areas:
                    "left"
                    "center"
                    "actions"
                    "right";
                gap:10px;
            }

            .topbar-left{display:flex;align-items:center;justify-content:space-between}
            .topbar-left .page-title{font-size:16px}
            .last-update{display:none}

            .top-search{width:100%}
            .top-search input{width:100%;max-width:100%}

            .topbar-actions{justify-content:flex-start}
            /* hide less important ghost actions on mobile */
            .topbar-actions .btn.btn-ghost{display:none}
            .topbar-actions .btn.btn-primary{padding:8px 10px}

            .topbar-right{justify-content:space-between}

            /* simplify user box on mobile: show avatar only */
            .user-dropdown span{display:none}
            .user-dropdown i.fas.fa-chevron-down{display:none}
        }
    </style>

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

</header>
