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
            <div class="actions">
                <button class="btn btn-primary">Tambah Prosedur</button>
                <button class="btn btn-ghost">Import Harga Prosedur</button>
                <button class="btn btn-ghost">Export</button>
            </div>

            <div class="header-icons">
                <i class="fas fa-question-circle header-icon" title="Help"></i>
                <i class="fas fa-bell header-icon" title="Notifications"></i>
            </div>

            <div class="user-dropdown-container">
                <div class="user-dropdown" onclick="toggleUserMenu()">
                    <div class="user-avatar">
                        <i class="fas fa-user" style="color:#3b82f6;font-size:14px"></i>
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
    </div>

    <style>
        /* Fixed rounded topbar aligned after the sidebar */
        .topbar{
            position:fixed;
            top:12px;
            left:72px; /* leave space for sidebar */
            right:24px;
            background:transparent;
            z-index:140;
            pointer-events:none;
        }
        .topbar-inner{pointer-events:auto;background:#fff;border-radius:12px;padding:12px 18px;display:flex;align-items:center;gap:18px;box-shadow:0 10px 30px rgba(2,6,23,0.06);flex-wrap:wrap}
        .topbar-left{flex:0 0 auto;min-width:0}
        .page-title{font-weight:700;font-size:18px;color:#0f172a}
        .last-update{font-size:12px;color:#6b7280;margin-top:4px}
        .topbar-center{flex:1;min-width:160px}
        .btn{padding:8px 14px;border-radius:8px;border:none;cursor:pointer;font-weight:600}
        .btn-primary{background:linear-gradient(135deg,#5BA3E0 0%,#3B82C4 100%);color:#fff}
        .btn-ghost{background:#fff;border:1px solid #e5e7eb;color:#374151}
        .top-search{display:flex;gap:10px;align-items:center}
        .top-search input{flex:1;padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px}
        .top-search button{padding:8px 12px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;cursor:pointer}
        .topbar-right{display:flex;align-items:center;gap:12px;flex:0 0 auto;min-width:0}
        .header-icons{display:flex;gap:12px;align-items:center}
        .header-icon{color:#64748b;font-size:16px;cursor:pointer}
        .user-dropdown{display:flex;align-items:center;gap:10px;background:#3b82f6;padding:8px 14px;border-radius:10px;cursor:pointer;color:#fff;box-shadow:0 6px 18px rgba(59,130,246,0.12)}
        .user-avatar{width:34px;height:34px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center}
        .user-dropdown span{color:#fff;font-size:15px;font-weight:600}
        .user-dropdown-container{position:relative}
        .user-dropdown-menu{position:absolute;top:100%;right:0;margin-top:8px;background:#fff;border-radius:8px;box-shadow:0 4px 20px rgba(0,0,0,0.12);min-width:220px;display:none;overflow:hidden;z-index:160}
        .user-dropdown-menu.show{display:block}
        .user-dropdown-menu a,.user-dropdown-menu button{display:flex;align-items:center;gap:10px;width:100%;padding:12px 14px;color:#374151;text-decoration:none;background:none;border:none;cursor:pointer}
        .user-dropdown-menu a:hover,.user-dropdown-menu button:hover{background:#f3f4f6}
        .logout-btn{color:#dc2626;border-top:1px solid #f3f4f6;width:100%;text-align:left}
    </style>

    <style>
        /* Responsive topbar when sidebar collapses on small screens */
        @media (max-width: 768px) {
            .topbar{ left:12px; right:12px; }
            /* leave space for the mobile hamburger on the left */
            .topbar-inner{padding:10px 12px 10px 64px}
            .topbar{pointer-events:auto}

            /* Stack and reflow topbar sections */
            .topbar-left{width:100%;order:1;display:flex;align-items:center;justify-content:space-between}
            .topbar-left .page-title{font-size:16px}
            .last-update{display:none}

            .topbar-center{width:100%;order:2;margin-top:8px}
            .top-search{width:100%;display:flex}
            .top-search input{width:100%;max-width:100%}

            .topbar-right{width:100%;order:3;margin-top:8px;justify-content:space-between}
            .actions{display:flex;gap:8px;align-items:center}

            /* hide less important ghost actions on mobile to prevent overflow */
            .actions .btn.btn-ghost{display:none}
            .actions .btn.btn-primary{padding:8px 10px}

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
