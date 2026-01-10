<header class="header">
    <div class="header-left">
        <h1>{{ $pageTitle ?? 'Settings' }}</h1>
        <p class="muted">hanglekiu dental specialist</p>
    </div>

    <div class="header-right">
        <div class="header-icons">
            <i class="fas fa-question-circle header-icon" title="Help"></i>
            <i class="fas fa-bell header-icon" title="Notifications"></i>
        </div>

        <div class="user-dropdown-container">
            <div class="user-dropdown" role="button" tabindex="0" aria-haspopup="true" aria-expanded="false" onclick="toggleUserMenu()">
                    <div class="user-avatar">
                        @if(Auth::check() && !empty(Auth::user()->avatar))
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                        @else
                            <i class="fas fa-user avatar-icon"></i>
                        @endif
                    </div>
                    <span>{{ Auth::user()->name ?? 'User' }}</span>
                    <i class="fas fa-chevron-down"></i>
                </div>

                <div class="user-dropdown-menu" id="headerUserMenu" aria-label="User menu">
                <a href="#"><i class="fas fa-user-circle"></i> Profile</a>
                <a href="#"><i class="fas fa-cog"></i> Pengaturan</a>
                <form action="{{ route('logout') }}" method="POST" style="margin:0">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .header{background:var(--surface);padding:14px 22px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(0,0,0,0.06);box-shadow:0 2px 8px rgba(0,0,0,0.04)}
        .header-left h1{color:var(--text);font-size:20px;font-weight:600}
        .header-left .muted{color:var(--muted);font-size:13px}
        .header-right{display:flex;align-items:center;gap:16px}
        .header-icons{display:flex;gap:12px}
        .header-icon{color:var(--muted);font-size:16px}
        .user-dropdown-container{position:relative}
        .user-dropdown{display:flex;align-items:center;gap:10px;background:var(--action);padding:8px 12px;border-radius:10px;color:#fff;cursor:pointer}
        .user-avatar{width:34px;height:34px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;overflow:hidden;padding:4px;box-sizing:border-box}
        .user-avatar img{width:100%;height:100%;object-fit:cover;display:block;border-radius:50%}
        .avatar-icon{color:var(--action);font-size:14px}
        .user-dropdown-menu{position:absolute;top:100%;right:0;margin-top:8px;background:#fff;border-radius:8px;box-shadow:0 6px 20px rgba(0,0,0,0.12);min-width:180px;display:none;z-index:1000}
        .user-dropdown-menu.show{display:block}
        .user-dropdown-menu a,.user-dropdown-menu button{display:flex;align-items:center;gap:8px;padding:10px 12px;color:#374151;text-decoration:none;border:none;background:none;width:100%;cursor:pointer}
        .logout-btn{color:#dc2626;border-top:1px solid #f3f4f6;width:100%;text-align:left}
    </style>

    <script>
        function toggleUserMenu(){
            const m = document.getElementById('headerUserMenu');
            const btn = document.querySelector('.user-dropdown');
            if(!m) return;
            const isShown = m.classList.toggle('show');
            if(btn) btn.setAttribute('aria-expanded', isShown ? 'true' : 'false');
        }

        // close when clicking outside and support keyboard activation
        document.addEventListener('click', function(e){
            const menu = document.getElementById('headerUserMenu');
            const container = document.querySelector('.user-dropdown-container');
            const btn = document.querySelector('.user-dropdown');
            if(!menu || !container) return;
            if(!container.contains(e.target)){
                menu.classList.remove('show');
                if(btn) btn.setAttribute('aria-expanded','false');
            }
        });

        document.addEventListener('keydown', function(e){
            const btn = document.querySelector('.user-dropdown');
            if(!btn) return;
            if(document.activeElement === btn){
                if(e.key === 'Enter' || e.key === ' '){
                    e.preventDefault();
                    toggleUserMenu();
                }
            }
        });
    </script>

</header>
