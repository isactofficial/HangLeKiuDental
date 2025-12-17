<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Hanglekiu Dental</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 60px;
            background: #1a365d;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px 0;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .sidebar-logo i {
            color: white;
            font-size: 20px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
        }

        .sidebar-item {
            width: 100%;
            padding: 12px 0;
            display: flex;
            justify-content: center;
            color: #94a3b8;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            text-decoration: none;
        }

        .sidebar-item:hover,
        .sidebar-item.active {
            color: white;
            background: rgba(59, 130, 246, 0.2);
        }

        .sidebar-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: #3b82f6;
        }

        .sidebar-item i {
            font-size: 18px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 60px;
            background: #f5f7fa;
            min-height: 100vh;
            max-width: 100vw;
        }

        /* Header */
        .header {
            background: #1e3a5f;
            padding: 12px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 25px;
            padding: 8px 20px;
            gap: 10px;
            min-width: 320px;
        }

        .search-box input {
            border: none;
            outline: none;
            font-size: 13px;
            color: #64748b;
            width: 100%;
        }

        .search-box i {
            color: #3b82f6;
        }

        .btn-pendaftaran {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-pendaftaran:hover {
            background: #2563eb;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-logo {
            width: 45px;
            height: 45px;
            background: #6b7280;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #3b82f6;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
        }

        .user-dropdown span {
            color: white;
            font-size: 14px;
        }

        .header-icons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .header-icon {
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        /* Page Title */
        .page-title {
            background: #1e3a5f;
            padding: 15px 25px 25px;
        }

        .page-title h1 {
            color: white;
            font-size: 24px;
            font-weight: 600;
        }

        .page-title p {
            color: #94a3b8;
            font-size: 13px;
        }

        /* Content Area */
        .content {
            padding: 25px;
            display: flex;
            gap: 20px;
        }

        /* Left Menu */
        .left-menu {
            width: 220px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .menu-item {
            padding: 15px 20px;
            color: #1e3a5f;
            font-size: 14px;
            cursor: pointer;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background: #f8fafc;
        }

        .menu-item.active {
            background: #f97316;
            color: white;
            border-left-color: #ea580c;
        }

        /* Main Panel */
        .main-panel {
            flex: 1;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        /* Panel Header */
        .panel-header {
            padding: 20px 25px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .panel-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .panel-title h2 {
            font-size: 20px;
            color: #1e3a5f;
            font-weight: 600;
        }

        .panel-title i {
            color: #94a3b8;
            font-size: 18px;
        }

        .panel-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-info {
            width: 32px;
            height: 32px;
            border: 1px solid #e2e8f0;
            border-radius: 50%;
            background: white;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-export {
            padding: 8px 20px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: white;
            color: #374151;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-print {
            width: 36px;
            height: 36px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: white;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Filters */
        .filters {
            padding: 20px 25px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: flex-end;
            border-bottom: 1px solid #f1f5f9;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-label {
            font-size: 11px;
            color: #3b82f6;
        }

        .filter-input {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 13px;
            color: #374151;
            background: white;
            cursor: pointer;
            min-width: 160px;
        }

        .filter-input i {
            color: #94a3b8;
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 13px;
            color: #374151;
            background: white;
            cursor: pointer;
            min-width: 180px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 35px;
        }

        .btn-add {
            width: 40px;
            height: 40px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .search-patient {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: white;
            min-width: 250px;
        }

        .search-patient input {
            border: none;
            outline: none;
            font-size: 13px;
            color: #374151;
            width: 100%;
        }

        .search-patient input::placeholder {
            color: #94a3b8;
        }

        .search-patient i {
            color: #94a3b8;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: #f8fafc;
            padding: 15px 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
        }

        .data-table td {
            padding: 15px 12px;
            font-size: 13px;
            color: #374151;
            border-bottom: 1px solid #f1f5f9;
        }

        .data-table tbody tr:hover {
            background: #f8fafc;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-succeed {
            background: #fef3c7;
            color: #d97706;
        }

        .status-pending {
            background: #dbeafe;
            color: #2563eb;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #dc2626;
        }

        .poli-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #e0f2fe;
            color: #0284c7;
            border-radius: 4px;
            font-size: 12px;
        }

        /* User Dropdown Menu */
        .user-dropdown-container {
            position: relative;
        }

        .user-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            min-width: 180px;
            display: none;
            z-index: 1000;
            overflow: hidden;
        }

        .user-dropdown-menu.show {
            display: block;
        }

        .user-dropdown-menu a,
        .user-dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 12px 16px;
            color: #374151;
            text-decoration: none;
            font-size: 13px;
            border: none;
            background: none;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .user-dropdown-menu a:hover,
        .user-dropdown-menu button:hover {
            background: #f3f4f6;
        }

        .user-dropdown-menu .logout-btn {
            color: #dc2626;
            border-top: 1px solid #f3f4f6;
        }

        .user-dropdown-menu .logout-btn:hover {
            background: #fee2e2;
        }

        /* Chat Button */
        .chat-button {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 55px;
            height: 55px;
            background: #3b82f6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .filters {
                flex-direction: column;
                align-items: stretch;
            }
            .filter-group {
                width: 100%;
            }
            .filter-input,
            .filter-select,
            .search-patient {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                min-width: 0;
                padding: 0;
                overflow: hidden;
                position: fixed;
                left: 0;
                top: 0;
                height: 0;
                z-index: 100;
                transition: width 0.3s, height 0.3s;
            }
            .main-content {
                margin-left: 0;
            }
            .content {
                flex-direction: column;
            }
            .left-menu {
                width: 100%;
            }
            .chat-button {
                right: 10px;
                bottom: 10px;
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
            .header {
                flex-direction: column;
                gap: 10px;
                padding: 10px 10px;
            }
            .header-left {
                width: 100%;
                flex-direction: column;
                gap: 8px;
            }
            .search-box {
                min-width: 0;
                width: 100%;
                padding: 8px 10px;
            }
            .btn-pendaftaran {
                width: 100%;
                justify-content: center;
            }
            .header-right {
                width: 100%;
                justify-content: flex-end;
            }
            .page-title {
                padding: 10px 10px 15px;
            }
            .filters {
                padding: 10px 10px;
                gap: 10px;
            }
            .filter-input,
            .filter-select,
            .search-patient {
                min-width: 0;
                width: 100%;
            }
            .table-container {
                padding: 0 2px;
            }
            /* Responsive Table as Card */
            .data-table, .data-table thead, .data-table tbody, .data-table tr, .data-table th, .data-table td {
                display: block;
                width: 100%;
            }
            .data-table thead {
                display: none;
            }
            .data-table tr {
                margin-bottom: 18px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 1px 4px rgba(0,0,0,0.04);
                padding: 10px 0;
            }
            .data-table td {
                padding: 8px 12px;
                font-size: 13px;
                text-align: left;
                position: relative;
                border: none;
                white-space: normal;
                word-break: break-word;
            }
            .data-table td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #3b82f6;
                display: block;
                margin-bottom: 2px;
                font-size: 12px;
            }
            .data-table td:first-child {
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }
            .data-table td:last-child {
                border-bottom-left-radius: 8px;
                border-bottom-right-radius: 8px;
            }
        }

        @media (max-width: 500px) {
            .main-content {
                padding: 0;
            }
            .header {
                padding: 6px 4px;
            }
            .page-title {
                padding: 6px 4px 10px;
            }
            .filters {
                padding: 6px 4px;
            }
            .left-menu {
                border-radius: 0;
                box-shadow: none;
            }
            .main-panel {
                border-radius: 0;
                box-shadow: none;
            }
            .table-container {
                padding: 0;
            }
            .data-table th,
            .data-table td {
                padding: 6px 2px;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    @include('partials.sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <div class="search-box">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Cari Pasien / No MR / No Ktp / No Asuransi...">
                </div>
                <button class="btn-pendaftaran">
                    Pendaftaran Baru
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            <div class="header-right">
                <div class="header-logo">HDS</div>
                <div class="user-dropdown-container">
                    <div class="user-dropdown" onclick="toggleUserMenu()">
                        <span>{{ Auth::user()->name ?? 'hangleki' }}</span>
                        <i class="fas fa-chevron-down" style="color: white; font-size: 12px;"></i>
                    </div>
                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <a href="#">
                            <i class="fas fa-user-circle"></i>
                            Profile
                        </a>
                            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                    </div>
                </div>
                <div class="header-icons">
                    <i class="fas fa-question-circle header-icon"></i>
                    <i class="fas fa-bell header-icon"></i>
                    <i class="fas fa-user-circle header-icon"></i>
                </div>
            </div>
        </header>

        <!-- Page Title -->
        <div class="page-title">
            <h1>Registration</h1>
            <p>hanglekiu dental specialist</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Left Menu -->
            <div class="left-menu">
                <div class="menu-item active">Rawat Jalan Poli</div>
                <div class="menu-item">AntriCepat</div>
                <div class="menu-item">Gawat Darurat</div>
                <div class="menu-item">Kunjungan Sehat</div>
                <div class="menu-item">Promotif Preventif</div>
                <div class="menu-item">Kegiatan Kelompok</div>
                <div class="menu-item">Antrian Awal</div>
                <div class="menu-item">Screen Antrian</div>
            </div>

            <!-- Main Panel -->
            <div class="main-panel">
                <!-- Panel Header -->
                <div class="panel-header">
                    <div class="panel-title">
                        <h2>Rawat Jalan Poli</h2>
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="panel-actions">
                        <button class="btn-info">
                            <i class="fas fa-info"></i>
                        </button>
                        <button class="btn-export">
                            EXPORT
                        </button>
                        <button class="btn-print">
                            <i class="fas fa-print"></i>
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filters">
                    <div class="filter-group">
                        <span class="filter-label">Tanggal Kunjungan</span>
                        <div class="filter-input">
                            <span>{{ date('d/m/Y') }}</span>
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>
                    <button class="btn-add">
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="filter-group">
                        <span class="filter-label">Tenaga Medis *</span>
                        <select class="filter-select">
                            <option>Semua Tenaga Medis</option>
                            <option>Dr. Ahmad</option>
                            <option>Dr. Siti</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <span class="filter-label">Metode Pembayaran *</span>
                        <select class="filter-select">
                            <option>Semua Metode Pembayar...</option>
                            <option>Tunai</option>
                            <option>BPJS</option>
                            <option>Asuransi</option>
                        </select>
                    </div>
                    <div class="search-patient">
                        <input type="text" placeholder="Nama Pasien, Nomor MR">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="filter-group">
                        <span class="filter-label">Poli *</span>
                        <select class="filter-select">
                            <option>Semua Poli</option>
                            <option>Gigi</option>
                            <option>Umum</option>
                        </select>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Tanggal Dibuat</th>
                                <th>No</th>
                                <th>Poli</th>
                                <th>Nama Pasien</th>
                                <th>Rencana Tindakan</th>
                                <th>Rencana Paket</th>
                                <th>Tenaga Medis</th>
                                <th>Tipe Bayar</th>
                                <th>Rujuk BPJS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="Status"><span class="status-badge status-succeed">Succeed</span></td>
                                <td data-label="Tanggal Kunjungan">15/12/2025, 12:00</td>
                                <td data-label="Tanggal Dibuat">15/12/2025, 10:24</td>
                                <td data-label="No">1</td>
                                <td data-label="Poli"><span class="poli-badge">Gigi</span></td>
                                <td data-label="Nama Pasien">Agasya, MR000074, 30 Tahun</td>
                                <td data-label="Rencana Tindakan">Scaling</td>
                                <td data-label="Rencana Paket">-</td>
                                <td data-label="Tenaga Medis">Dr. Ahmad</td>
                                <td data-label="Tipe Bayar">Tunai</td>
                                <td data-label="Rujuk BPJS">-</td>
                            </tr>
                            <tr>
                                <td data-label="Status"><span class="status-badge status-succeed">Succeed</span></td>
                                <td data-label="Tanggal Kunjungan">15/12/2025, 12:15</td>
                                <td data-label="Tanggal Dibuat">15/12/2025, 11:31</td>
                                <td data-label="No">2</td>
                                <td data-label="Poli"><span class="poli-badge">Gigi</span></td>
                                <td data-label="Nama Pasien">Alex, 230769, 1 Tahun</td>
                                <td data-label="Rencana Tindakan">Konsultasi</td>
                                <td data-label="Rencana Paket">-</td>
                                <td data-label="Tenaga Medis">Dr. Siti</td>
                                <td data-label="Tipe Bayar">BPJS</td>
                                <td data-label="Rujuk BPJS">Ya</td>
                            </tr>
                            <tr>
                                <td data-label="Status"><span class="status-badge status-succeed">Succeed</span></td>
                                <td data-label="Tanggal Kunjungan">15/12/2025, 12:30</td>
                                <td data-label="Tanggal Dibuat">15/12/2025, 11:21</td>
                                <td data-label="No">3</td>
                                <td data-label="Poli"><span class="poli-badge">Gigi</span></td>
                                <td data-label="Nama Pasien">Obby, 230739, 35 Tahun</td>
                                <td data-label="Rencana Tindakan">Cabut Gigi</td>
                                <td data-label="Rencana Paket">-</td>
                                <td data-label="Tenaga Medis">Dr. Ahmad</td>
                                <td data-label="Tipe Bayar">Tunai</td>
                                <td data-label="Rujuk BPJS">-</td>
                            </tr>
                            <tr>
                                <td data-label="Status"><span class="status-badge status-pending">Pending</span></td>
                                <td data-label="Tanggal Kunjungan">15/12/2025, 13:00</td>
                                <td data-label="Tanggal Dibuat">15/12/2025, 12:05</td>
                                <td data-label="No">4</td>
                                <td data-label="Poli"><span class="poli-badge">Gigi</span></td>
                                <td data-label="Nama Pasien">Rina, 230845, 28 Tahun</td>
                                <td data-label="Rencana Tindakan">Tambal Gigi</td>
                                <td data-label="Rencana Paket">Paket Perawatan</td>
                                <td data-label="Tenaga Medis">Dr. Siti</td>
                                <td data-label="Tipe Bayar">Asuransi</td>
                                <td data-label="Rujuk BPJS">-</td>
                            </tr>
                            <tr>
                                <td data-label="Status"><span class="status-badge status-pending">Pending</span></td>
                                <td data-label="Tanggal Kunjungan">15/12/2025, 13:30</td>
                                <td data-label="Tanggal Dibuat">15/12/2025, 12:15</td>
                                <td data-label="No">5</td>
                                <td data-label="Poli"><span class="poli-badge">Gigi</span></td>
                                <td data-label="Nama Pasien">Budi, 230901, 42 Tahun</td>
                                <td data-label="Rencana Tindakan">Pemasangan Behel</td>
                                <td data-label="Rencana Paket">Paket Ortodonti</td>
                                <td data-label="Tenaga Medis">Dr. Ahmad</td>
                                <td data-label="Tipe Bayar">Tunai</td>
                                <td data-label="Rujuk BPJS">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Chat Button -->
    <div class="chat-button">
        <i class="fas fa-comment"></i>
    </div>

    <script>
        // User Dropdown Menu
        function toggleUserMenu() {
            const menu = document.getElementById('userDropdownMenu');
            menu.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const container = document.querySelector('.user-dropdown-container');
            const menu = document.getElementById('userDropdownMenu');
            if (container && !container.contains(event.target)) {
                menu.classList.remove('show');
            }
        });

        // Menu item click handler
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Logout form: try AJAX POST then redirect to login as fallback
        (function() {
            const logoutForm = document.getElementById('logoutForm');
            if (!logoutForm) return;

            logoutForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const action = this.action;
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                }).then(resp => {
                    // on success (204 or 200/302), redirect to login
                    window.location.href = '{{ route('login') }}';
                }).catch(() => {
                    // fallback: redirect anyway
                    window.location.href = '{{ route('login') }}';
                });
            });
        })();
    </script>

    <style>
        /* Registration page responsive overrides */
        @media (max-width: 992px) {
            .content { padding: 12px; }
            .left-menu { width: 100%; order: 1; }
            .main-panel { order: 2; }
            .filters { flex-direction: column; align-items: stretch; }
        }

        @media (max-width: 768px) {
            .main-content { margin-left: 0; padding: 8px; }
            .hamburger { left: 8px; top: 8px; }
            .left-menu { width: 100%; }
            .menu-item { padding: 12px 16px; }
        }

        @media (max-width: 480px) {
            .panel-title h2 { font-size: 16px; }
            .filter-label { font-size: 11px; }
        }
    </style>

    <script>
        // Ensure clicking sidebar items hides off-canvas sidebar (mobile)
        document.addEventListener('DOMContentLoaded', function(){
            document.querySelectorAll('.sidebar-item').forEach(el=>{
                el.addEventListener('click', function(){
                    const sb = document.getElementById('appSidebar');
                    const bp = document.getElementById('sidebarBackdrop');
                    if(sb && sb.classList.contains('open')) sb.classList.remove('open');
                    if(bp && bp.classList.contains('show')) bp.classList.remove('show');
                });
            });
        });
    </script>

    </body>
    </html>
