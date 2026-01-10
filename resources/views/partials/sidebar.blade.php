<button id="sidebarToggle" class="hamburger global-hamburger" aria-label="Toggle menu" title="Menu" type="button">
    <i class="fas fa-bars"></i>
</button>

@php
    $isDoctor = auth()->check() && method_exists(auth()->user(), 'isDoctor') && auth()->user()->isDoctor();
    $isAdmin = auth()->check() && method_exists(auth()->user(), 'isAdmin') && auth()->user()->isAdmin();
@endphp

<aside class="sidebar" id="appSidebar" style="overflow-y:auto;max-height:100vh;">
    <div class="sidebar-logo">
        <i class="fas fa-tooth"></i>
    </div>
    <nav class="sidebar-menu">
        @if($isDoctor && !$isAdmin)
            <a href="{{ route('doctor.dashboard') }}" class="sidebar-item" title="Dashboard Dokter">
                <i class="fas fa-user-md"></i>
            </a>
        @else
            @if($isAdmin)
                <a href="{{ route('dashboard') }}" class="sidebar-item" title="Dashboard">
                    <i class="fas fa-th-large"></i>
                </a>
                <a href="{{ route('registration') }}" class="sidebar-item" title="Registration">
                    <i class="fas fa-calendar-alt"></i>
                </a>
            @endif

            {{-- Doctor dashboard: visible to doctors and admins --}}
            @if(auth()->check() && method_exists(auth()->user(), 'isDoctor') && (auth()->user()->isDoctor() || auth()->user()->isAdmin()))
                <a href="{{ route('doctor.dashboard') }}" class="sidebar-item" title="Dashboard Dokter">
                    <i class="fas fa-user-md"></i>
                </a>
            @endif

            <a href="{{ route('rawat.jalan') }}" class="sidebar-item" title="Rawat Jalan">
                <i class="fas fa-clinic-medical"></i>
            </a>
            <!-- removed unused icon-only items: Waktu, Users, Medical, Pharmacy, Inventory -->
            <a href="{{ route('cashier') }}" class="sidebar-item" title="Kasir">
                <i class="fas fa-cash-register"></i>
            </a>
            <a href="{{ route('emr') }}" class="sidebar-item" title="EMR">
                <i class="fas fa-plus-square"></i>
            </a>
            <a href="{{ route('procedures.index') }}" class="sidebar-item" title="Katalog Harga Prosedur">
                <i class="fas fa-tags"></i>
            </a>
            @unless($isAdmin)
                <a href="{{ route('layanan.tambahan') }}" class="sidebar-item" title="Layanan Tambahan">
                    <i class="fas fa-puzzle-piece"></i>
                </a>
            @endunless
            <!-- keep Settings item as requested -->
            @if($isAdmin)
                <a href="{{ route('admin.users.index') }}" class="sidebar-item" title="Settings">
                    <i class="fas fa-cog"></i>
                </a>
            @else
                <div class="sidebar-item" title="Settings">
                    <i class="fas fa-cog"></i>
                </div>
            @endif
        @endif
    </nav>
    <!-- logout moved to header/profile dropdown for doctor views -->
</aside>

<div id="sidebarBackdrop" class="sidebar-backdrop" aria-hidden="true"></div>

<style>
    :root{
        --surface: #FFFFFF; /* Sidebar/Header surface */
        --main-bg: #FAF9F6; /* Main background warm off-white */
        --accent: #B08D70; /* Wood tone accent */
        --action: #5F6F65; /* Button / action color (deep sage) */
        --text: #484848; /* Soft black text */
        --muted: #94a3b8; /* fallback muted */
    }
    :root{
        --sidebar-width:72px; /* desktop sidebar width (wider for circular icons) */
        --sidebar-compact-left:84px; /* default left offset used by topbar/hamburger */
    }
    /* Desktop sidebar base styles (centralized) */
    .sidebar{width:var(--sidebar-width);background:var(--surface);min-height:100vh;display:flex;flex-direction:column;align-items:center;padding:15px 0;position:fixed;left:0;top:0;z-index:100;overflow-y:auto;max-height:100vh;box-shadow:0 1px 3px rgba(0,0,0,0.06)}
    .sidebar-logo{width:56px;height:56px;background:var(--accent);border-radius:14px;display:flex;align-items:center;justify-content:center;margin-bottom:28px}
    .sidebar-logo i { font-size: 28px; color: #fff; }
    .sidebar-menu .sidebar-item i { font-size: 20px; }
    .sidebar-menu{display:flex;flex-direction:column;gap:12px;width:100%;align-items:center}
    .sidebar-item{width:48px;height:48px;display:flex;align-items:center;justify-content:center;color:var(--muted);cursor:pointer;text-decoration:none;position:relative;border-radius:12px}
    .sidebar-item:hover{background:rgba(0,0,0,0.03);color:var(--accent)}
    .sidebar-item.active{color:var(--accent);background:rgba(176,141,112,0.06)}
    .sidebar-item.active::before{content:'';position:absolute;left:-8px;top:6px;height:36px;width:4px;background:var(--accent);border-radius:4px}
    .logout-sidebar{color:var(--muted)}
    .logout-sidebar:hover{color:var(--surface);background:rgba(176,141,112,0.08)}

    /* Ensure main content leaves room for the sidebar on larger screens */
    .main{margin-left:var(--sidebar-width);transition:margin-left .18s ease}


    /* Mobile hamburger + sidebar overrides (applies after page CSS) */
    .hamburger.global-hamburger{display:none;position:fixed;left:calc(var(--sidebar-width) + 12px);top:18px;z-index:260;background:var(--surface);color:var(--accent);border-radius:8px;width:36px;height:36px;border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,0,0,0.08)}
    .hamburger.global-hamburger i{font-size:16px;color:var(--accent)}

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

        /* On small screens, remove left margin so content is full width */
        .main{margin-left:0}

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
        // Global logout handler: submit logout via fetch then redirect to login
        (function(){
            function getCsrf(){
                var m = document.querySelector('meta[name="csrf-token"]');
                if(m) return m.getAttribute('content');
                var t = document.querySelector('input[name="_token"]');
                return t ? t.value : null;
            }

            document.addEventListener('DOMContentLoaded', function(){
                var forms = Array.from(document.querySelectorAll('form[action*="logout"]'));
                if(!forms.length) return;
                forms.forEach(function(f){
                    // avoid double-binding
                    if(f.__logout_bound) return; f.__logout_bound = true;
                    f.addEventListener('submit', function(e){
                        e.preventDefault();
                        var action = this.action;
                        var token = getCsrf();
                        // send POST request, then redirect to login regardless of outcome
                        fetch(action, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': token || '',
                                'Accept': 'application/json',
                                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                            },
                            body: new URLSearchParams()
                        }).then(function(){
                            window.location.href = '{{ route('login') }}';
                        }).catch(function(){
                            window.location.href = '{{ route('login') }}';
                        });
                    });
                });
            });
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