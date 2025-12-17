<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Medical Record - Hanglekiu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Poppins',sans-serif;background:#f5f7fa;min-height:100vh;display:flex}
        .main{margin-left:60px;flex:1;padding:0 12px}

        /* Header area */
        .emr-header{padding:18px 28px;display:flex;align-items:center;gap:18px;border-bottom:1px solid #eef2f6;background:#fff}
        .search-compact{display:flex;align-items:center;gap:10px}
        .search-compact input{width:100%;max-width:420px;padding:10px 14px;border-radius:24px;border:1px solid #e6eef6;box-shadow:none}
        .advance-btn{background:#2b6cb0;color:#fff;padding:10px 16px;border-radius:8px;border:none}

        .emr-title{padding:18px 28px;background:#fff}
        .emr-title h1{color:#1e3a8a;font-size:28px;margin-bottom:6px}
        .emr-title p{color:#64748b;margin-top:0}

        .legend{display:flex;gap:18px;align-items:center;padding:8px 28px;background:#fff}
        .legend .item{display:flex;gap:8px;align-items:center;font-size:13px;color:#6b7280}
        .dot{width:12px;height:12px;border-radius:50%;display:inline-block}

        .emr-content{padding:26px;background:#f1f6fb;min-height:60vh}
        .filter-box{background:#fff;padding:12px;border-radius:8px;display:inline-block;margin-bottom:24px;border:1px solid #eef2f6}

        .empty-state{background:#f8fafc;border-radius:8px;padding:40px;display:flex;flex-direction:column;align-items:center;gap:12px}
        .empty-state h3{color:#1f4a8a}
        .empty-state p{color:#7b8794}

        .floating-actions{position:absolute;right:40px;top:120px;display:flex;flex-direction:column;gap:12px}
        .floating-actions button{background:#fff;border:1px solid #e6eef6;padding:10px;border-radius:8px}

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
        <header class="emr-header">
            <div class="search-compact">
                <input type="text" placeholder="Cari Pasien / No MR / No Ktp / No Asuransi..">
                <button class="advance-btn">Advance Search</button>
            </div>

            <div style="flex:1"></div>

            <div style="display:flex;gap:12px;align-items:center">
                <div style="width:44px;height:44px;border-radius:22px;background:#e6eef6;display:flex;align-items:center;justify-content:center">
                    <img src="/css/responsive.css" alt="logo" style="width:26px;height:26px;opacity:0.8">
                </div>
                <div class="user-dropdown" style="position:relative;">
                    <button class="user-btn" style="background:#2b8cf2;color:#fff;padding:8px 14px;border-radius:8px;display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <i class="fas fa-user"></i>
                        <span>Admin</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu" style="position:absolute;top:100%;right:0;background:#fff;border:1px solid #e6eef6;border-radius:8px;box-shadow:0 4px 6px rgba(0,0,0,0.1);display:none;width:160px;">
                        <a href="/profile" class="dropdown-item" style="display:flex;align-items:center;padding:8px 12px;color:#374151;text-decoration:none;">
                            <i class="fas fa-user" style="margin-right:8px;color:#6b7280;"></i> Profile
                        </a>
                        <a href="/settings" class="dropdown-item" style="display:flex;align-items:center;padding:8px 12px;color:#374151;text-decoration:none;">
                            <i class="fas fa-cog" style="margin-right:8px;color:#6b7280;"></i> Settings
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                        <a href="#" onclick="document.getElementById('logout-form').submit();" class="dropdown-item" style="display:flex;align-items:center;padding:8px 12px;color:#e11d48;text-decoration:none;">
                            <i class="fas fa-sign-out-alt" style="margin-right:8px;color:#e11d48;"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <section class="emr-title">
            <h1>Electronic Medical Record</h1>
            <p>hanglekiu dental specialist</p>
        </section>

        <div class="legend">
            <div class="item"><span class="dot" style="background:#f87171"></span> Pending</div>
            <div class="item"><span class="dot" style="background:#fbbf24"></span> Confirmed</div>
            <div class="item"><span class="dot" style="background:#a78bfa"></span> Waiting</div>
            <div class="item"><span class="dot" style="background:#60a5fa"></span> Engaged</div>
            <div class="item"><span class="dot" style="background:#86efac"></span> Succeed</div>
        </div>

        <div class="emr-content">
            <div class="filter-box">
                <select style="padding:10px;border:none;background:#fff">
                    <option>Semua</option>
                </select>
            </div>

            <div style="margin-top:40px;display:flex;justify-content:center">
                <div style="width:100%;max-width:780px;padding:0 12px">
                    <div class="empty-state">
                        <svg width="160" height="120" viewBox="0 0 160 120" xmlns="http://www.w3.org/2000/svg">
                            <g fill="none" stroke="#374151" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="18" y="30" width="48" height="48" rx="8" fill="#efe6ff" stroke="#374151" />
                                <rect x="94" y="30" width="48" height="48" rx="8" fill="#efe6ff" stroke="#374151" />
                                <circle cx="130" cy="22" r="12" fill="#22c55e" stroke="#22c55e" />
                                <path d="M126 22h8" stroke="#fff" stroke-width="3" stroke-linecap="round" />
                                <path d="M40 82v14" stroke="#374151" stroke-width="4" />
                                <path d="M120 82v14" stroke="#374151" stroke-width="4" />
                            </g>
                        </svg>
                        <h3>Tidak ada antrean pasien hari ini</h3>
                        <p>Gunakan search bar atau advance search pada pojok kiri atas untuk mencari pasien.</p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const userBtn = document.querySelector('.user-btn');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            userBtn.addEventListener('click', () => {
                dropdownMenu.style.display = dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '' ? 'block' : 'none';
            });

            document.addEventListener('click', (event) => {
                if (!userBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.style.display = 'none';
                }
            });
        </script>

        <div class="floating-actions">
            <button title="Print"><i class="fas fa-print" style="color:#2b6cb0"></i></button>
            <button title="Refresh"><i class="fas fa-sync" style="color:#2b6cb0"></i></button>
        </div>
    </main>

</body>
</html>
