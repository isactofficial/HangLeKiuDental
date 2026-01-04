<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier - hanglekiu dental specialist</title>
        <style>
            /* Hamburger Menu (matching Dashboard) */
                .hamburger {
                    display: none;
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
                    z-index: 1001;
                }
                .hamburger-bar {
                    display: block;
                    width: 20px;
                    height: 3px;
                    background: var(--accent);
                    margin: 3px 0;
                    border-radius: 2px;
                    transition: all 0.3s;
                }
                .hamburger i { color: var(--accent); font-size: 16px; }
                @media (max-width: 900px) {
                    .hamburger {
                        display: flex;
                        position: static;
                        margin-right: 8px;
                        flex: 0 0 auto;
                        align-self: center;
                    }
                    .cashier-header {
                        position: static;
                        padding-left: 12px;
                        padding-right: 12px;
                        min-height: auto;
                        align-items: center;
                    }
                    .kasir-title{ margin-left:0; flex:1 1 auto; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
                    .header-actions{ margin-left:0; min-width:0; }
                }
        </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        body{font-family:'Poppins',sans-serif;background:var(--main-bg);color:var(--text);min-height:100vh;display:flex}
        .main{margin-left:60px;flex:1;padding:0 12px}
        .cashier-header{padding:14px 20px;display:flex;align-items:center;gap:12px;border-bottom:1px solid rgba(0,0,0,0.06);background:var(--surface);flex-wrap:wrap;}
        .cashier-header .kasir-title{display:flex;flex-direction:column;gap:2px;min-width:220px}
        .cashier-header .kasir-title-main{font-size:26px;line-height:1.1;font-weight:700;color:#B08D70}
        .cashier-header .kasir-title-sub{font-size:14px;color:#5F6F65;opacity:1}
        .header-actions{display:flex;align-items:center;gap:12px;margin-left:auto;flex:0 0 auto;min-width:0}
        .header-hd{display:flex;align-items:center;gap:10px;position:relative;min-width:0}
        .header-logo{width:44px;height:44px;border-radius:22px;background:#e6eef6;display:flex;align-items:center;justify-content:center;flex:0 0 auto}
        .header-logo img{width:32px;height:32px;object-fit:contain;}
        .header-dropdown-btn{background:var(--action);color:#fff;padding:8px 16px;border-radius:8px;border:none;font-weight:500;display:flex;align-items:center;gap:8px;min-width:0;max-width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;position:relative;cursor:pointer;}
        .header-dropdown-btn i{margin-left:6px;}
        /* Profile pill variant (avatar + name inside rounded pill) — match dashboard `.user-dropdown` */
        .header-dropdown-btn.profile-pill{display:flex;align-items:center;gap:10px;background:var(--action);padding:8px 15px;border-radius:8px;cursor:pointer;color:#fff;font-weight:600}
        .header-dropdown-btn.profile-pill .pill-avatar{width:30px;height:30px;border-radius:50%;overflow:hidden;flex:0 0 auto;background:var(--surface);display:flex;align-items:center;justify-content:center}
        .header-dropdown-btn.profile-pill .pill-avatar img{width:26px;height:26px;object-fit:cover;border-radius:50%}
        .header-dropdown-btn.profile-pill .pill-name{font-weight:600;color:#fff;display:inline-flex;align-items:center;gap:8px;font-size:14px}
        .header-dropdown-container{position:relative}
        .header-dropdown-menu{position:absolute;top:100%;right:0;margin-top:8px;background:#fff;border-radius:8px;box-shadow:0 4px 20px rgba(0,0,0,0.15);min-width:180px;display:none;z-index:1000;overflow:hidden}
        .header-dropdown-menu.show{display:block}
        .header-dropdown-menu a, .header-dropdown-menu form button{display:flex;align-items:center;gap:10px;width:100%;padding:12px 16px;color:#374151;text-decoration:none;background:none;border:none;text-align:left;font-size:13px;cursor:pointer;transition:background 0.15s}
        .header-dropdown-menu a:hover, .header-dropdown-menu form button:hover{background:#f3f4f6}
        .header-dropdown-menu .logout{color:#dc2626;border-top:1px solid #f3f4f6}
        .header-actions .icon-btn{background:none;border:none;padding:0;cursor:pointer;font-size:20px;color:#888;transition:color 0.2s}
        .header-actions .icon-btn:hover{color:#2196f3}
        .header-actions .profile-btn{background:none;border:none;padding:0;cursor:pointer;font-size:22px;color:#888;transition:color 0.2s}
        .header-actions .profile-btn:hover{color:#2196f3}
        .cashier-content{padding:36px 0 0 0;min-height:60vh;display:flex;gap:24px}
        .cashier-sidebar{width:200px;background:var(--surface);border-radius:8px;padding:0;box-shadow:0 1px 4px rgba(0,0,0,0.03);height:fit-content;overflow:hidden}
        .cashier-sidebar .tab{padding:16px 18px;font-weight:500;cursor:pointer;border:none;outline:none;text-align:left;width:100%;background:#fff;color:#222;border-bottom:1px solid #e5e7eb;transition:background 0.2s;border-radius:0}
        .cashier-sidebar .tab.active{background:#B08D70;color:#fff;border-radius:0;}
        .cashier-sidebar .tab:last-child{border-bottom:none}
        .cashier-main{flex:1;}
        .filter-box{background:var(--surface);padding:22px 22px 18px;border-radius:10px;display:flex;flex-direction:column;gap:16px;margin-bottom:22px;border:1px solid rgba(0,0,0,0.06);box-shadow:0 1px 4px rgba(0,0,0,0.03)}

        .toolbar-row{display:flex;gap:18px;align-items:center;flex-wrap:wrap}
        .search-wrap{position:relative;flex:1 1 520px;min-width:320px}
        .search-wrap input{width:100%;height:44px;padding:10px 46px 10px 16px;border-radius:8px;border:1px solid #e5e7eb;font-size:14px;outline:none}
        .search-wrap .search-icon-btn{position:absolute;right:10px;top:50%;transform:translateY(-50%);border:none;background:transparent;color:#111827;cursor:pointer;font-size:16px;padding:6px;line-height:1}
        .search-wrap.no-icon input{padding-right:16px}

        .action-btns{display:flex;gap:14px;flex:0 0 auto;flex-wrap:wrap}
        .action-btns button{height:44px;padding:0 18px;border-radius:8px;border:none;cursor:pointer;font-weight:600;min-width:160px;box-shadow:1px 2px 6px #e5e7eb;display:inline-flex;align-items:center;justify-content:center;gap:8px}
        .action-btns .add{background:var(--action);color:#fff}
        .action-btns .export{background:var(--action);color:#fff}

        .filter-row{display:flex;gap:34px;align-items:flex-end;flex-wrap:wrap}
        .filter-field{min-width:170px}
        .filter-row label{font-size:13px;color:#64748b;margin-bottom:8px;display:block}
        .filter-row input[type="date"]{width:100%;height:36px;padding:6px 0;border:none;border-bottom:1px solid #9ca3af;border-radius:0;background:transparent;outline:none}
        .filter-row select{width:100%;height:36px;padding:6px 12px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;outline:none}
        .filter-btn{height:40px;background:#e5e7eb;color:#111827;padding:0 18px;border-radius:8px;border:none;font-weight:700;box-shadow:1px 2px 6px #e5e7eb;cursor:pointer}

        .table-footer{display:flex;justify-content:space-between;align-items:center;margin-top:18px;font-size:14px;color:#64748b;gap:16px;flex-wrap:wrap}
        .table-footer select{border:none;background:transparent;color:#B08D70;font-weight:500;outline:none}
        .table-footer .pager{display:flex;gap:10px;align-items:center;}
        .table-footer button{background:none;border:none;color:#bdbdbd;font-size:18px;cursor:pointer;padding:4px 6px;}
        .table-footer button:disabled{cursor:not-allowed;opacity:.9}
        .table-responsive{background:#fff;border-radius:8px;overflow-x:auto;box-shadow:0 1px 4px rgba(0,0,0,0.03)}
        table{width:100%;border-collapse:collapse}
        th,td{padding:14px 10px;text-align:left;border-bottom:1px solid #e5e7eb}
        th{background:#f1f5f9;color:#334155;font-size:16px}
        .empty-row{color:#64748b;text-align:center}
        @media (max-width: 1100px){
            .cashier-content{flex-direction:column;gap:12px}
            .cashier-sidebar{width:100%;display:flex;flex-direction:row;gap:0;box-shadow:none;margin-bottom:12px}
            .cashier-sidebar .tab{flex:1;text-align:center;border-radius:6px 6px 0 0;}
        }
        @media (max-width: 900px){
            .main{margin-left:0;padding:0 6px}
            /* keep header items in a responsive row where possible */
            .cashier-header{flex-direction:row;align-items:center;gap:8px;padding:10px;}
            .hamburger{display:flex;position:static;order:1;margin-right:8px}
            .kasir-title{order:2;margin-left:8px;flex:0 0 auto;white-space:nowrap}
            .header-actions{order:3;margin-left:auto;gap:8px;min-width:0}
            .header-actions .header-hd{display:flex;align-items:center;gap:8px;min-width:0}
            .cashier-content{padding:16px 0 0 0;}
        }
        @media (max-width: 600px){
            .cashier-header{flex-direction:row;align-items:center;gap:8px;padding:8px;}
            .hamburger{order:1;margin-right:8px}
            .kasir-title{order:2;font-size:16px;display:inline-block;margin-left:0;color:#B08D70;flex:1 1 auto;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
            .header-actions{order:3}
            .header-actions{gap:6px}
            .header-logo{width:32px;height:32px}
            .header-logo img{width:22px;height:22px}
            .header-dropdown-btn{padding:8px 10px;font-size:14px;min-width:0;max-width:90px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
            .cashier-sidebar .tab{padding:10px 6px;font-size:13px}
            .filter-box{padding:8px 6px}
            .filter-row input[type="text"]{padding:8px 8px}
            .filter-row input[type="date"]{padding:6px}
            .filter-row button{padding:8px 10px;font-size:13px}
            .action-btns button{padding:8px 10px;font-size:13px}
            th,td{padding:8px 6px;font-size:13px}
        }
    </style>
</head>
<body>
    @include('partials.sidebar')
        <div class="sidebar-backdrop" id="sidebarBackdrop" style="display:none;"></div>
        <div class="main">
            <div class="cashier-header">
                <button id="sidebarToggle" class="hamburger" onclick="toggleSidebar()" aria-label="Menu">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="kasir-title">
                    <div class="kasir-title-main">Cashier</div>
                    <div class="kasir-title-sub">hanglekiu dental specialist</div>
                </div>
                <div class="header-actions">
                    <div class="header-hd">
                        <button class="header-dropdown-btn profile-pill" id="hdDropdownBtn" aria-haspopup="true" aria-expanded="false">
                            <span class="pill-avatar">
                                <img src="https://ui-avatars.com/api/?name=Wildan&background=e6eef6&color=B08D70&size=64&rounded=true" alt="avatar">
                            </span>
                            <span class="pill-name">Wildan <i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="header-dropdown-menu" id="hdDropdownMenu">
                            <a href="/profile"><i class="fas fa-user" style="margin-right:8px;"></i> Profil</a>
                            <form action="{{ route('logout') }}" method="POST" style="display:block;">
                                @csrf
                                <button type="submit" class="logout"><i class="fas fa-sign-out-alt" style="margin-right:8px;"></i> Logout</button>
                            </form>
                        </div>
                    </div>
                    <button class="icon-btn" title="Help"><i class="fas fa-question-circle"></i></button>
                    <button class="icon-btn" title="Mute"><i class="fas fa-bell-slash"></i></button>
                    <button class="profile-btn" title="Profile"><i class="fas fa-user"></i></button>
                </div>
            </div>
        <div class="cashier-content">
            <div class="cashier-sidebar">
                <button class="tab active">Pembayaran</button>
                <button class="tab">Hutang & Piutang</button>
            </div>
            <div class="cashier-main">
                <div id="pembayaran-section">
                    <div class="filter-box">
                        <div class="toolbar-row">
                            <div class="search-wrap">
                                <input type="text" placeholder="Cari nama pasien, dokter atau invoice">
                                <button type="button" class="search-icon-btn" aria-label="Search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="action-btns">
                                <button class="add" id="addBtn"><i class="fas fa-plus"></i> Pembayaran</button>
                                <button class="export" id="exportBtn"><i class="fas fa-file-export"></i> Export</button>
                            </div>
                        </div>

                        <form class="filter-row" onsubmit="event.preventDefault(); alert('Filter diklik!');">
                            <div class="filter-field">
                                <label for="from_date">Dari Tanggal</label>
                                <input type="date" id="from_date" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="filter-field">
                                <label for="to_date">Sampai Tanggal</label>
                                <input type="date" id="to_date" value="{{ date('Y-m-d') }}">
                            </div>
                            <button type="submit" class="filter-btn">FILTER</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Nama Lengkap Pasien</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" class="empty-row">Tidak ada data yang bisa ditampilkan.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        <div>
                            Jumlah baris per halaman:
                            <select style="border:none;background:transparent;color:#B08D70;font-weight:500;outline:none;">
                                <option>5</option><option>10</option><option>20</option>
                            </select>
                        </div>
                        <div>0-0 dari 0 data</div>
                        <div class="pager">
                            <button disabled>&lt;|</button>
                            <button disabled>&lt;</button>
                            <button disabled>&gt;</button>
                            <button disabled>|&gt;</button>
                        </div>
                    </div>
                </div>
                <div id="hutang-section" style="display:none;">
                    <div class="filter-box">
                        <form onsubmit="event.preventDefault(); alert('Filter diklik!');">
                            <div class="filter-row">
                                <div class="filter-field">
                                    <label for="from_date_hutang">Dari Tanggal</label>
                                    <input type="date" id="from_date_hutang" value="2025-12-01">
                                </div>
                                <div class="filter-field">
                                    <label for="to_date_hutang">Sampai Tanggal</label>
                                    <input type="date" id="to_date_hutang" value="2025-12-31">
                                </div>
                                <div class="filter-field" style="min-width:140px">
                                    <label for="tipe_hutang">Tipe *</label>
                                    <select id="tipe_hutang">
                                        <option>Semua</option>
                                        <option>Pasien</option>
                                        <option>Distributor</option>
                                    </select>
                                </div>
                            </div>

                            <div class="toolbar-row" style="gap:0;">
                                <div class="search-wrap no-icon" style="flex:1 1 100%;min-width:100%">
                                    <input type="text" placeholder="Cari nama pasien, nama distributor atau nomor invoice">
                                </div>
                            </div>

                            <div style="display:flex;justify-content:flex-start;margin-top:14px;">
                                <button type="submit" class="filter-btn">FILTER</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="empty-row">Tidak ada data yang bisa ditampilkan.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer">
                        <div>
                            Jumlah baris per halaman:
                            <select style="border:none;background:transparent;color:#B08D70;font-weight:500;outline:none;">
                                <option>5</option><option>10</option><option>20</option>
                            </select>
                        </div>
                        <div>0-0 dari 0 data</div>
                        <div class="pager">
                            <button disabled>&lt;|</button>
                            <button disabled>&lt;</button>
                            <button disabled>&gt;</button>
                            <button disabled>|&gt;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Dropdown logic — toggle `.show` and aria-expanded for accessibility
        const hdDropdownBtn = document.getElementById('hdDropdownBtn');
        const hdDropdownMenu = document.getElementById('hdDropdownMenu');
        if(hdDropdownBtn && hdDropdownMenu){
            document.addEventListener('click', function(e) {
                if (hdDropdownBtn.contains(e.target)) {
                    const isOpen = hdDropdownMenu.classList.contains('show');
                    if (isOpen) {
                        hdDropdownMenu.classList.remove('show');
                        hdDropdownMenu.style.display = 'none';
                        hdDropdownBtn.setAttribute('aria-expanded', 'false');
                    } else {
                        hdDropdownMenu.classList.add('show');
                        hdDropdownMenu.style.display = 'block';
                        hdDropdownBtn.setAttribute('aria-expanded', 'true');
                    }
                } else if (!hdDropdownMenu.contains(e.target)) {
                    hdDropdownMenu.classList.remove('show');
                    hdDropdownMenu.style.display = 'none';
                    hdDropdownBtn.setAttribute('aria-expanded', 'false');
                }
            });
        }
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
        // Button click handlers
        document.getElementById('addBtn').onclick = function(){alert('Tambah Pembayaran diklik!');};
        document.getElementById('exportBtn').onclick = function(){alert('Export diklik!');};
        // Tab switch logic
        const tabPembayaran = document.querySelector('.cashier-sidebar .tab:nth-child(1)');
        const tabHutang = document.querySelector('.cashier-sidebar .tab:nth-child(2)');
        const pembayaranSection = document.getElementById('pembayaran-section');
        const hutangSection = document.getElementById('hutang-section');
        tabPembayaran.onclick = function(){
            tabPembayaran.classList.add('active');
            tabHutang.classList.remove('active');
            pembayaranSection.style.display = '';
            hutangSection.style.display = 'none';
        };
        tabHutang.onclick = function(){
            tabHutang.classList.add('active');
            tabPembayaran.classList.remove('active');
            pembayaranSection.style.display = 'none';
            hutangSection.style.display = '';
        };
    </script>
</body>
</html>
