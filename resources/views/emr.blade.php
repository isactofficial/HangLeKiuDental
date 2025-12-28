<!DOCTYPE html>
<html lang="id">
<head>
        <style>
            /* Hamburger Menu (icon button style) */
            .hamburger {
                display: inline-flex;
                background: var(--surface);
                border: none;
                padding: 0;
                cursor: pointer;
                justify-content: center;
                align-items: center;
                height: 36px;
                width: 36px;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                position: relative;
                margin-right: 12px;
                z-index: 1001;
            }
            .hamburger i {
                color: var(--accent);
                font-size: 18px;
                line-height: 1;
                display: block;
            }
            @media (max-width: 900px) {
                .hamburger {
                    position: static;
                    margin-right: 8px;
                }
                .emr-header {
                    position: relative;
                    padding-left: 12px;
                    min-height: 56px;
                }
            }
            /* Header EMR baru */
            .emr-header {
                display: flex;
                align-items: center;
                background: var(--surface);
                border-bottom: 1px solid rgba(0,0,0,0.04);
                padding: 14px 20px;
                position: relative;
                gap: 12px;
            }
            .emr-header-left {
                display: flex;
                align-items: center;
                gap: 12px;
                flex: 1;
                min-width: 0;
            }
            .emr-header-search {
                display: flex;
                align-items: center;
                gap: 10px;
                flex: 1;
                min-width: 0;
            }
            .emr-header-search input {
                flex: 1;
                width: auto;
                max-width: 520px;
                padding: 10px 14px;
                border-radius: 24px;
                border: 1px solid rgba(0,0,0,0.06);
                box-shadow: none;
                min-width: 0;
            }
            .advance-btn {
                background: var(--action);
                color: #fff;
                padding: 10px 18px;
                border-radius: 8px;
                border: none;
                font-weight: 600;
                font-size: 16px;
                margin-left: 8px;
            }
            .emr-header-right {
                display: flex;
                align-items: center;
                gap: 16px;
                margin-left: auto;
            }
            .emr-header-logo {
                width: 44px;
                height: 44px;
                border-radius: 22px;
                background: var(--surface);
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .emr-header-logo .avatar{width:36px;height:36px;border-radius:8px;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700}
            /* Hide duplicated small logo so only profile pill appears */
            .emr-header-logo{display:none}

            /* Profile pill style to match requested design */
            .user-btn{background:var(--action);color:#fff;padding:8px 12px;border-radius:10px;display:flex;align-items:center;gap:10px;cursor:pointer;border:none;font-weight:600}
            .user-avatar{width:30px;height:30px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;color:var(--action);font-weight:700}
            .user-avatar i{color:var(--action);font-size:14px}
            .user-btn span{color:#fff;font-weight:600}
            .user-btn .fa-chevron-down{color:rgba(255,255,255,0.9);font-size:12px}
            .emr-header-user {
                position: relative;
            }
            .user-btn {
                background: var(--action);
                color: #fff;
                padding: 8px 14px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                gap: 8px;
                cursor: pointer;
                border: none;
                font-weight: 500;
            }
            .dropdown-menu {
                position: absolute;
                top: 100%;
                right: 0;
                background: var(--surface);
                border: 1px solid rgba(0,0,0,0.04);
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.08);
                display: none;
                width: 160px;
                z-index: 10050;
            }
            .dropdown-item {
                display: flex;
                align-items: center;
                padding: 8px 12px;
                color: #374151;
                text-decoration: none;
                font-size: 15px;
            }
            .dropdown-item:hover {
                background: var(--main-bg);
            }
            .dropdown-item:last-child {
                color: #e11d48;
            }
            /* Floating actions */
            .floating-actions {
                position: absolute;
                right: 28px;
                top: 72px;
                display: flex;
                flex-direction: row;
                gap: 10px;
                z-index: 1000;
            }
                .floating-actions button {
                background: var(--surface);
                border: 1px solid rgba(0,0,0,0.04);
                padding: 10px;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.06);
                cursor: pointer;
                position: relative;
                overflow: hidden;
                transition: box-shadow 0.2s;
            }
            .floating-actions button:active {
                box-shadow: 0 1px 4px rgba(0,0,0,0.10);
            }
            .floating-actions button::before {
                display: none !important;
            }
            @media (max-width: 900px) {
                .emr-header-search input {
                        width: 100%;
                        max-width: none;
                    }
                .emr-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 8px;
                    padding: 16px 10px 10px 10px;
                }
                .emr-header-left {
                    width: 100%;
                    gap: 8px;
                }
                .floating-actions {
                    position: fixed;
                    right: 12px;
                    top: auto;
                    bottom: 20px;
                    flex-direction: column;
                }
            }
        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Medical Record - Hanglekiu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Poppins',sans-serif;background:var(--main-bg);color:var(--text);min-height:100vh;display:flex}
        .main{margin-left:60px;flex:1;padding:0 12px}

        /* Header area */
        .emr-header{padding:18px 28px;display:flex;align-items:center;gap:18px;border-bottom:1px solid rgba(0,0,0,0.06);background:var(--surface)}
        .search-compact{display:flex;align-items:center;gap:10px}
        .search-compact input{width:100%;max-width:420px;padding:10px 14px;border-radius:24px;border:1px solid rgba(0,0,0,0.06);box-shadow:none}
        .advance-btn{background:var(--action);color:#fff;padding:10px 16px;border-radius:8px;border:none}

        .emr-title{padding:18px 28px;background:var(--surface)}
        .emr-title h1{color:var(--text);font-size:28px;margin-bottom:6px}
        .emr-title p{color:var(--muted);margin-top:0}

        .legend{display:flex;gap:18px;align-items:center;padding:8px 28px;background:var(--surface)}
        .legend .item{display:flex;gap:8px;align-items:center;font-size:13px;color:var(--muted)}
        .dot{width:12px;height:12px;border-radius:50%;display:inline-block}

        .emr-content{padding:26px;background:var(--main-bg);min-height:60vh}
        .filter-box{background:var(--surface);padding:12px;border-radius:8px;display:inline-block;margin-bottom:24px;border:1px solid rgba(0,0,0,0.06)}

        .empty-state{background:var(--surface);border-radius:8px;padding:40px;display:flex;flex-direction:column;align-items:center;gap:12px}
        .empty-state h3{color:var(--text)}
        .empty-state p{color:var(--muted)}

        .floating-actions{position:absolute;right:40px;top:120px;display:flex;flex-direction:column;gap:12px}
        .floating-actions button{background:var(--surface);border:1px solid rgba(0,0,0,0.06);padding:10px;border-radius:8px}

        @media (max-width: 900px){
            .search-compact input{width:100%;max-width:none}
            .emr-header{flex-direction:column;align-items:flex-start;gap:8px}
            .main{margin-left:0;padding:0 10px}
            .legend{overflow-x:auto;gap:12px;padding-left:12px}
            .floating-actions{position:fixed;right:12px;top:auto;bottom:20px}
            .floating-actions button{padding:8px}
        }

        @media (max-width: 600px){
            .emr-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
                padding: 12px;
            }
            .search-compact input {
                width: 100%;
                max-width: none;
                padding: 8px;
            }
            .advance-btn {
                padding: 8px 12px;
                font-size: 14px;
            }
            .legend {
                flex-wrap: wrap;
                gap: 8px;
                padding: 8px;
            }
            .floating-actions {
                position: fixed;
                right: 8px;
                bottom: 16px;
                gap: 8px;
            }
            .floating-actions button {
                padding: 6px;
                font-size: 12px;
            }
            .emr-title h1 {
                font-size: 24px;
            }
            .emr-title p {
                font-size: 14px;
            }
            .empty-state {
                padding: 20px;
                gap: 8px;
            }
            .empty-state h3 {
                font-size: 18px;
            }
            .empty-state p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    @include('partials.sidebar')

    <main class="main">
        <!-- sidebar backdrop is provided by partials/sidebar; duplicate removed -->
        <div class="emr-header">
            <button class="hamburger" onclick="toggleSidebar()" aria-label="Menu">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
            <div class="emr-header-left">
                <div class="emr-header-search">
                    <input type="text" placeholder="Cari Pasien / No MR / No Ktp / No Asuransi..">
                    <button class="advance-btn">Advance Search</button>
                </div>
            </div>
            <div class="emr-header-right">
                    <div class="emr-header-logo">
                        <span class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}</span>
                    </div>
                        <div class="emr-header-user">
                        <div class="user-dropdown user-btn" role="button" tabindex="0">
                            <div class="user-avatar"><i class="fas fa-user" style="color:var(--accent);font-size:14px"></i></div>
                            <span>{{ auth()->user()->name ?? 'User' }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    <div class="dropdown-menu">
                        <a href="/profile" class="dropdown-item">
                            <i class="fas fa-user" style="margin-right:8px;color:var(--muted);"></i> Profile
                        </a>
                        <a href="/settings" class="dropdown-item">
                            <i class="fas fa-cog" style="margin-right:8px;color:var(--muted);"></i> Settings
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                        <a href="#" onclick="document.getElementById('logout-form').submit();" class="dropdown-item" style="color:#e11d48;">
                            <i class="fas fa-sign-out-alt" style="margin-right:8px;color:#e11d48;"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
            <div class="floating-actions">
            <button title="Print"><i class="fas fa-print" style="color:var(--accent)"></i></button>
            <button title="Refresh"><i class="fas fa-sync" style="color:var(--accent)"></i></button>
            </div>
        </div>

        <section class="emr-title">
            <h1>Electronic Medical Record</h1>
            <p>hanglekiu dental specialist</p>
        </section>

            <div class="legend">
            <div class="item"><span class="dot" style="background:#f87171"></span> Pending</div>
            <div class="item"><span class="dot" style="background:#fbbf24"></span> Confirmed</div>
            <div class="item"><span class="dot" style="background:#a78bfa"></span> Waiting</div>
            <div class="item"><span class="dot" style="background:var(--accent)"></span> Engaged</div>
            <div class="item"><span class="dot" style="background:#86efac"></span> Succeed</div>
        </div>

        <div class="emr-content">
            <div class="filter-box">
                <select style="padding:10px;border:none;background:var(--surface)">
                    <option>Semua</option>
                </select>
            </div>

            <div style="margin-top:40px;display:flex;justify-content:center">
                <div style="width:100%;max-width:780px;padding:0 12px">
                    <div class="empty-state">
                        <svg width="160" height="120" viewBox="0 0 160 120" xmlns="http://www.w3.org/2000/svg">
                            <g fill="none" stroke="var(--muted)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="18" y="30" width="48" height="48" rx="8" fill="rgba(176,141,112,0.08)" stroke="var(--muted)" />
                                <rect x="94" y="30" width="48" height="48" rx="8" fill="rgba(176,141,112,0.08)" stroke="var(--muted)" />
                                <circle cx="130" cy="22" r="12" fill="#86efac" stroke="#86efac" />
                                <path d="M126 22h8" stroke="#fff" stroke-width="3" stroke-linecap="round" />
                                <path d="M40 82v14" stroke="var(--muted)" stroke-width="4" />
                                <path d="M120 82v14" stroke="var(--muted)" stroke-width="4" />
                            </g>
                        </svg>
                        <h3>Tidak ada antrean pasien hari ini</h3>
                        <p>Gunakan search bar atau advance search pada pojok kiri atas untuk mencari pasien.</p>
                    </div>
                </div>
            </div>
        </div>

        <script>
                function toggleSidebar() {
                    document.getElementById('appSidebar').classList.toggle('open');
                    var backdrop = document.getElementById('sidebarBackdrop');
                    if (backdrop) backdrop.style.display = backdrop.style.display === 'block' ? 'none' : 'block';
                }
                document.addEventListener('DOMContentLoaded', function(){
                    var backdrop = document.getElementById('sidebarBackdrop');
                    if (backdrop) {
                        backdrop.addEventListener('click', toggleSidebar);
                    }
                });
            (function(){
                const userBtn = document.querySelector('.user-btn');
                const dropdownMenu = document.querySelector('.dropdown-menu');
                if(!userBtn || !dropdownMenu) return;

                userBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    dropdownMenu.style.display = dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '' ? 'block' : 'none';
                });

                document.addEventListener('click', (event) => {
                    if (!userBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.style.display = 'none';
                    }
                });
            })();
        </script>

        <!-- floating-actions hanya di header, hapus duplikasi di bawah -->
    </main>

</body>
</html>
