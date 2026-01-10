<aside class="sidebar-doctor" style="height:100vh;position:fixed;left:0;top:0;z-index:100">
    <div class="sd-header" style="padding:18px 16px;background:var(--surface);border-right:1px solid rgba(0,0,0,0.04);">
        <div style="display:flex;align-items:center;gap:12px">
            <div style="width:40px;height:40px;border-radius:8px;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700">DR</div>
            <div>
                <div style="font-weight:700">{{ auth()->user()->name }}</div>
                <div style="font-size:12px;color:var(--muted)">Dokter</div>
            </div>
        </div>
    </div>

    <nav style="width:220px;background:transparent;padding:14px;display:flex;flex-direction:column;gap:8px">
        <a href="{{ route('doctor.dashboard') }}" class="sd-item" style="display:flex;gap:10px;align-items:center;padding:10px;border-radius:8px;text-decoration:none;color:var(--text);background:rgba(176,141,112,0.04)">
            <i class="fas fa-user-md"></i>
            <span>Dashboard Dokter</span>
        </a>

        <div style="margin-top:auto;padding-top:12px">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="width:100%;display:flex;gap:10px;align-items:center;padding:10px;border-radius:8px;border:none;background:transparent;color:var(--text);cursor:pointer">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <style>
        :root{--surface:#FFFFFF;--main-bg:#FAF9F6;--accent:#B08D70;--action:#5F6F65;--text:#484848;--muted:#94a3b8}
        .sidebar-doctor{width:220px}
        .sd-item i{width:22px;text-align:center}
    </style>
</aside>

<div style="width:220px;flex:0 0 220px"></div>
