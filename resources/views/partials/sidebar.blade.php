<button id="sidebarToggle" class="hamburger global-hamburger" aria-label="Toggle menu" title="Menu" type="button">
    <i class="fas fa-bars"></i>
</button>

<aside class="sidebar" id="appSidebar" style="overflow-y:auto;max-height:100vh;">
    <div class="sidebar-logo">
        <i class="fas fa-tooth"></i>
    </div>
    <nav class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="sidebar-item" title="Dashboard">
            <i class="fas fa-th-large"></i>
        </a>
        <a href="{{ route('registration') }}" class="sidebar-item" title="Registration">
            <i class="fas fa-calendar-alt"></i>
        </a>
        <div class="sidebar-item" title="Waktu">
            <i class="fas fa-user-clock"></i>
        </div>
        <div class="sidebar-item" title="Users">
            <i class="fas fa-users"></i>
        </div>
        <div class="sidebar-item" title="Medical">
            <i class="fas fa-notes-medical"></i>
        </div>
        <div class="sidebar-item" title="Pharmacy">
            <i class="fas fa-capsules"></i>
        </div>
        <div class="sidebar-item" title="Inventory">
            <i class="fas fa-box"></i>
        </div>
        <a href="{{ route('cashier') }}" class="sidebar-item" title="Kasir">
            <i class="fas fa-cash-register"></i>
        </a>
        <a href="{{ route('emr') }}" class="sidebar-item" title="EMR">
            <i class="fas fa-plus-square"></i>
        </a>
        <a href="{{ route('procedures.index') }}" class="sidebar-item" title="Katalog Harga Prosedur">
            <i class="fas fa-tags"></i>
        </a>
        <a href="{{ route('layanan.tambahan') }}" class="sidebar-item" title="Layanan Tambahan">
            <i class="fas fa-puzzle-piece"></i>
        </a>
        <div class="sidebar-item" title="Reports">
            <i class="fas fa-chart-bar"></i>
        </div>
        <div class="sidebar-item" title="Settings">
            <i class="fas fa-cog"></i>
        </div>
    </nav>
    <form action="{{ route('logout') }}" method="POST" style="margin-top:auto;width:100%">
        @csrf
        <button type="submit" class="sidebar-item logout-sidebar" title="Logout" style="border:none;background:transparent;width:100%;cursor:pointer">
            <i class="fas fa-sign-out-alt"></i>
        </button>
    </form>
</aside>

<div id="sidebarBackdrop" class="sidebar-backdrop" aria-hidden="true"></div>

<style>
    /* Desktop sidebar base styles (centralized) */
    .sidebar{width:60px;background:#1a365d;min-height:100vh;display:flex;flex-direction:column;align-items:center;padding:15px 0;position:fixed;left:0;top:0;z-index:100;overflow-y:auto;max-height:100vh;box-shadow: 1px 0 0 #1a365d;}
    .sidebar-logo{width:48px;height:48px;background:#3b82f6;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:30px}
    .sidebar-logo i { font-size: 32px; color: #fff; }
    .sidebar-menu .sidebar-item i { font-size: 24px; }
    .sidebar-menu{display:flex;flex-direction:column;gap:8px;width:100%}
    .sidebar-item{width:100%;padding:12px 0;display:flex;justify-content:center;color:#94a3b8;cursor:pointer;text-decoration:none;position:relative}
    .sidebar-item.active{color:#fff;background:rgba(59,130,246,0.2)}
    .sidebar-item.active::before{content:'';position:absolute;left:0;top:0;height:100%;width:3px;background:#3b82f6}
    .logout-sidebar{color:#94a3b8}
    .logout-sidebar:hover{color:#fff;background:rgba(59,130,246,0.2)}

    /* Mobile hamburger + sidebar overrides (applies after page CSS) */
    .hamburger.global-hamburger{display:none;position:fixed;left:72px;top:18px;z-index:260;background:#223a5f;color:#fff;border-radius:10px;width:40px;height:40px;border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,0,0,0.08)}
    .hamburger.global-hamburger i{font-size:18px}

    .sidebar-backdrop{display:none}

    @media (max-width: 900px){
        .hamburger.global-hamburger{display:flex}

        /* Place hamburger near the left edge of the content card on mobile */
        .hamburger.global-hamburger{left:16px}

        /* compact off-canvas sidebar for mobile: icon-only, narrow width */
        .sidebar{position:fixed;left:0;top:0;height:100vh;width:72px;transform:translateX(-100%);transition:transform .22s ease,z-index .01s;z-index:210;overflow-y:auto;padding-top:12px}
        .sidebar.open{transform:translateX(0)}

        .sidebar .sidebar-logo{width:40px;height:40px;margin:8px auto}
        .sidebar .sidebar-menu{display:flex;flex-direction:column;gap:8px;align-items:center;padding:6px 0}
        .sidebar .sidebar-item{padding:10px 0;display:flex;justify-content:center;width:100%}

        /* ensure page headers/content leave room for the hamburger */
        .main-content .header{padding-left:72px}

        /* backdrop */
        .sidebar-backdrop{display:block;position:fixed;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.35);z-index:200;opacity:0;transition:opacity .18s ease;pointer-events:none}
        .sidebar-backdrop.show{opacity:1;pointer-events:auto}
    }
</style>

<script>
    (function(){
        const toggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('appSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        if(!toggle || !sidebar) return;

        function openSidebar(){
            sidebar.classList.add('open');
            if(backdrop) backdrop.classList.add('show');
        }

        function closeSidebar(){
            sidebar.classList.remove('open');
            if(backdrop) backdrop.classList.remove('show');
        }

        toggle.addEventListener('click', function(){
            if(sidebar.classList.contains('open')) closeSidebar(); else openSidebar();
        });

        if(backdrop){
            backdrop.addEventListener('click', closeSidebar);
        }

        // Close sidebar on escape
        document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeSidebar(); });
    })();
</script>

    <script>
        // Universal hamburger visibility handler
        // - hide all hamburger buttons on desktop (>900px)
        // - on small screens, show hamburgers; if a page provides a local hamburger, prefer it and hide the global one
        (function(){
            function updateHamburgers(){
                var all = Array.from(document.querySelectorAll('.hamburger'));
                var local = document.querySelector('.hamburger:not(.global-hamburger)');
                var globalBtn = document.querySelector('.hamburger.global-hamburger');

                if(window.innerWidth > 900){
                    // Desktop: hide all hamburger controls
                    all.forEach(function(h){ h.style.display = 'none'; });
                    return;
                }

                // Small screens: restore default (let CSS control), then handle duplicates
                all.forEach(function(h){ h.style.display = ''; });

                // If a local hamburger exists, hide the global to avoid duplicate buttons
                if(local && globalBtn){
                    globalBtn.style.display = 'none';
                }
            }

            document.addEventListener('DOMContentLoaded', updateHamburgers);
            window.addEventListener('resize', updateHamburgers);
        })();
    </script>