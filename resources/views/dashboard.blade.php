<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Hanglekiu Dental</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--main-bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar styles are centralized in partials/sidebar.blade.php */

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 60px;
            background: var(--main-bg);
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: var(--surface);
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .header-left h1 {
            color: var(--text);
            font-size: 20px;
            font-weight: 600;
        }

        .header-left p {
            color: var(--muted);
            font-size: 12px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
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

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--action);
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
        }

        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-dropdown span {
            color: white;
            font-size: 14px;
        }

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

        /* Content Area */
        .content {
            padding: 20px 25px;
        }

        /* Promo Banners Slider */
        .promo-section {
            position: relative;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .promo-slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .promo-slide {
            min-width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            padding: 0 5px;
        }

        .promo-card {
            background: var(--surface);
            border-left: 6px solid var(--accent);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .promo-content {
            flex: 1;
            z-index: 1;
        }

        .promo-badge {
            background: var(--accent);
            color: #fff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 10px;
        }

        .promo-content h3 {
            color: var(--text);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .promo-content p {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .promo-btn {
            background: var(--action);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            font-weight: 500;
        }

        .promo-image {
            width: 140px;
            height: 100px;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .promo-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .promo-emoji {
            position: absolute;
            right: 160px;
            top: 50%;
        }

        /* Make promo cards stack on smaller screens and images responsive */
        @media (max-width: 992px) {
            .promo-card {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }
            .promo-image {
                width: 100%;
                height: auto;
                margin-top: 12px;
                border-radius: 8px;
            }
            .promo-image img {
                width: 100%;
                height: auto;
                object-fit: cover;
            }
            .promo-emoji { display: none; }
            .slider-nav { width: 32px; height: 32px; }
            .slider-nav.prev { left: 8px; }
            .slider-nav.next { right: 8px; }
        }
        /* Slider Navigation */
        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.9);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e3a5f;
            font-size: 14px;
            z-index: 10;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .slider-nav:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
        }

        .slider-nav.prev {
            left: 10px;
        }

        .slider-nav.next {
            right: 10px;
        }

        .slider-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 15px;
        }

        .slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            background: white;
            width: 24px;
            border-radius: 4px;
        }

        /* Stats Grid */
        .stats-section {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* Chart Card */
        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
        }

        .chart-header {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .chart-select {
            padding: 8px 15px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 13px;
            color: #374151;
            background: white;
            cursor: pointer;
        }

        .chart-value {
            display: flex;
            align-items: baseline;
            gap: 10px;
            margin-bottom: 5px;
        }

        .chart-value h2 {
            font-size: 42px;
            font-weight: 700;
            color: #1e3a5f;
        }

        .chart-badge {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        .chart-badge.up {
            background: #dcfce7;
            color: #16a34a;
        }

        .chart-badge.down {
            background: #fee2e2;
            color: #dc2626;
        }

        .chart-subtitle {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .chart-container {
            height: 150px;
        }

        /* Stat Cards */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .stat-icon.blue {
            background: #f1f2f4;
            color: var(--accent);
        }

        .stat-icon.green {
            background: #dcfce7;
            color: #16a34a;
        }

        .stat-icon.purple {
            background: #f3e8ff;
            color: #9333ea;
        }

        .stat-icon.orange {
            background: #ffedd5;
            color: #f97316;
        }

        .stat-icon.red {
            background: #fee2e2;
            color: #dc2626;
        }

        .stat-label {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .stat-value {
            display: flex;
            align-items: baseline;
            gap: 8px;
        }

        .stat-value h3 {
            font-size: 24px;
            font-weight: 700;
            color: #1e3a5f;
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 3px;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 12px;
        }

        .stat-change.up {
            background: #dcfce7;
            color: #16a34a;
        }

        .stat-change.down {
            background: #fee2e2;
            color: #dc2626;
        }

        .stat-period {
            color: #9ca3af;
            font-size: 11px;
            margin-top: 5px;
        }

        /* Bottom Section */
        .bottom-section {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 20px;
        }

        /* Donut Chart Card */
        .donut-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
        }

        .donut-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
        }

        .donut-header h4 {
            font-size: 14px;
            color: #374151;
            font-weight: 600;
        }

        .donut-header i {
            color: #9ca3af;
            font-size: 14px;
        }

        .donut-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .donut-chart {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .donut-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .donut-center h3 {
            font-size: 28px;
            font-weight: 700;
            color: #1e3a5f;
        }

        .donut-center span {
            font-size: 11px;
            color: #6b7280;
        }

        .donut-legend {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: #374151;
        }

        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .legend-dot.blue { background: var(--accent); }
        .legend-dot.light-blue { background: #93c5fd; }
        .legend-dot.green { background: #22c55e; }
        .legend-dot.gray { background: #d1d5db; }

        .legend-value {
            margin-left: auto;
            font-weight: 600;
        }

        /* Revenue Card */
        .revenue-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
        }

        .revenue-header {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .revenue-subheader {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: #9ca3af;
            margin-bottom: 15px;
        }

        .revenue-value {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
        }

        .revenue-value h3 {
            font-size: 24px;
            font-weight: 700;
            color: #1e3a5f;
        }

        .revenue-period {
            font-size: 11px;
            color: #9ca3af;
        }

        .expense-section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #f3f4f6;
        }

        /* Stock Card */
        .stock-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
        }

        .stock-icon {
            width: 40px;
            height: 40px;
            background: #fef3c7;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f59e0b;
            margin-bottom: 12px;
        }

        .stock-label {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .stock-value h3 {
            font-size: 32px;
            font-weight: 700;
            color: #1e3a5f;
        }

        /* Queue Table Card */
        .queue-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
        }

        .queue-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .queue-header h4 {
            font-size: 14px;
            color: #374151;
            font-weight: 600;
        }

        .queue-update {
            font-size: 11px;
            color: #9ca3af;
        }

        .queue-actions {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .queue-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background: white;
            font-size: 11px;
            color: #374151;
            cursor: pointer;
        }

        .queue-table {
            width: 100%;
        }

        .queue-table th {
            text-align: left;
            padding: 10px 8px;
            font-size: 11px;
            color: #6b7280;
            font-weight: 500;
            border-bottom: 1px solid #f3f4f6;
        }

        .queue-table td {
            padding: 10px 8px;
            font-size: 12px;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
        }

        .queue-empty {
            text-align: center;
            padding: 30px;
            color: #9ca3af;
            font-size: 13px;
        }

        /* Logout Form */
        .logout-form {
            display: none;
        }

          /* Hamburger Menu (standardized) */
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
              position: absolute;
              top: 16px;
              left: 16px;
              z-index: 1001;
          }

          .hamburger i { font-size: 16px; color: var(--accent); }

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-section {
                grid-template-columns: 1fr 1fr;
            }
            .bottom-section {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 900px) {
            .hamburger {
                display: flex;
            }
            .header-left {
                position: relative;
                padding-left: 0;
            }
            .header {
                min-height: 72px;
            }
        }

        @media (max-width: 768px) {
            .promo-section,
            .stats-section,
            .bottom-section {
                grid-template-columns: 1fr !important;
            }
            .sidebar {
                width: 40px;
                min-width: 40px;
                padding: 8px 0;
            }
            .main-content {
                margin-left: 40px;
                padding: 0 2px;
            }
            .content {
                padding: 10px 2px;
            }
            .promo-card, .stat-card, .chart-card, .donut-card, .revenue-card, .stock-card, .queue-card {
                padding: 12px;
            }
            .promo-content h3, .promo-content p, .promo-btn, .stat-label, .stat-value h3, .stat-period, .chart-value h2, .chart-badge, .chart-subtitle, .donut-header h4, .donut-center h3, .donut-center span, .legend-item, .revenue-header, .revenue-value h3, .revenue-period, .stock-label, .stock-value h3, .queue-header h4, .queue-update, .queue-btn {
                font-size: 12px !important;
            }
            .queue-table, .queue-table thead, .queue-table tbody, .queue-table tr, .queue-table th, .queue-table td {
                display: block;
                width: 100%;
            }
            .queue-table thead {
                display: none;
            }
            .queue-table tr {
                margin-bottom: 14px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 1px 4px rgba(0,0,0,0.04);
                padding: 8px 0;
            }
            .queue-table td {
                padding: 8px 10px;
                font-size: 12px;
                text-align: left;
                position: relative;
                border: none;
                white-space: normal;
                word-break: break-word;
            }
                .queue-table td:before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--accent);
                display: block;
                margin-bottom: 2px;
                font-size: 11px;
            }
            .queue-table td:first-child {
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }
            .queue-table td:last-child {
                border-bottom-left-radius: 8px;
                border-bottom-right-radius: 8px;
            }
            .queue-empty {
                padding: 18px 0;
                font-size: 12px;
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
                <h1>Dashboard</h1>
                <p>hanglekiu dental specialist</p>
            </div>
            <div class="header-right">
                <div class="header-icons">
                    <i class="fas fa-search header-icon"></i>
                    <i class="fas fa-bell header-icon"></i>
                </div>
                <div class="user-dropdown-container">
                    <div class="user-dropdown" onclick="toggleUserMenu()">
                        <div class="user-avatar">
                            <i class="fas fa-user" style="color: var(--accent); font-size: 14px;"></i>
                        </div>
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                        <i class="fas fa-chevron-down" style="color: white; font-size: 12px;"></i>
                    </div>
                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <a href="#">
                            <i class="fas fa-user-circle"></i>
                            Profile
                        </a>
                        <a href="#">
                            <i class="fas fa-cog"></i>
                            Pengaturan
                        </a>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="content">
            @if(session('warning'))
                <div style="background:#fff4e5;border:1px solid #fde3b7;padding:12px;border-radius:8px;margin-bottom:12px;color:#92400e">
                    {{ session('warning') }}
                </div>
            @endif

            @if(!empty($show_doctor_panel) && $show_doctor_panel)
                <div style="margin-bottom:18px">
                    @include('doctor.partials.panel_full', ['appointments' => $appointments, 'doctor' => $doctor, 'date' => $date])
                </div>
            @endif
            @if(empty($show_doctor_panel) || !$show_doctor_panel)
            <!-- Promo Banners Slider -->
            <section class="promo-section">
                <button class="slider-nav prev" onclick="moveSlide(-1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-nav next" onclick="moveSlide(1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
                
                <div class="promo-slider" id="promoSlider">
                    <!-- Slide 1 -->
                    <div class="promo-slide">
                        <div class="promo-card">
                            <div class="promo-content">
                                <p style="font-size: 10px; color: rgba(255,255,255,0.7); margin-bottom: 5px;">Info Terbaru</p>
                                <h3>Early Access Program Kerja.id<br>(Sistem Absensi)</h3>
                                <p>Assist.id memberikan kesempatan eksklusif untuk Partner Bapak/Ibu untuk mencoba...</p>
                                <button class="promo-btn">Lihat Selengkapnya</button>
                            </div>
                            <div class="promo-image">
                                <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=200&h=150&fit=crop" alt="Dental">
                            </div>
                        </div>
                        <div class="promo-card">
                            <div class="promo-content">
                                <p style="font-size: 10px; color: rgba(255,255,255,0.7); margin-bottom: 5px;">Info Terbaru</p>
                                <h3>Early Access Program</h3>
                                <p>Assist.id memberikan kesempatan eksklusif untuk Partner Bapak/Ibu untuk mencoba...</p>
                                <button class="promo-btn">Lihat Selengkapnya</button>
                            </div>
                            <div class="promo-image">
                                <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=200&h=150&fit=crop" alt="Dental">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Slide 2 -->
                    <div class="promo-slide">
                        <div class="promo-card">
                            <div class="promo-content">
                                <p style="font-size: 10px; color: rgba(255,255,255,0.7); margin-bottom: 5px;">Promo</p>
                                <h3>Diskon 20% Perawatan Gigi</h3>
                                <p>Dapatkan diskon spesial untuk semua jenis perawatan gigi selama bulan ini...</p>
                                <button class="promo-btn">Lihat Selengkapnya</button>
                            </div>
                            <div class="promo-image">
                                <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=200&h=150&fit=crop" alt="Dental">
                            </div>
                        </div>
                        <div class="promo-card">
                            <div class="promo-content">
                                <p style="font-size: 10px; color: rgba(255,255,255,0.7); margin-bottom: 5px;">Update</p>
                                <h3>Fitur Baru: Reservasi Online</h3>
                                <p>Pasien kini bisa melakukan reservasi langsung melalui aplikasi...</p>
                                <button class="promo-btn">Lihat Selengkapnya</button>
                            </div>
                            <div class="promo-image">
                                <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=200&h=150&fit=crop" alt="Dental">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Slide 3 -->
                    <div class="promo-slide">
                        <div class="promo-card">
                            <div class="promo-content">
                                <p style="font-size: 10px; color: rgba(255,255,255,0.7); margin-bottom: 5px;">Tips</p>
                                <h3>Tips Menjaga Kesehatan Gigi</h3>
                                <p>Pelajari cara menjaga kesehatan gigi dan mulut dengan tepat...</p>
                                <button class="promo-btn">Lihat Selengkapnya</button>
                            </div>
                            <div class="promo-image">
                                <img src="https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=200&h=150&fit=crop" alt="Dental">
                            </div>
                        </div>
                        <div class="promo-card">
                            <div class="promo-content">
                                <p style="font-size: 10px; color: rgba(255,255,255,0.7); margin-bottom: 5px;">Event</p>
                                <h3>Webinar Kesehatan Gigi</h3>
                                <p>Ikuti webinar gratis bersama dokter spesialis gigi kami...</p>
                                <button class="promo-btn">Lihat Selengkapnya</button>
                            </div>
                            <div class="promo-image">
                                <img src="https://images.unsplash.com/photo-1609840114035-3c981b782dfe?w=200&h=150&fit=crop" alt="Dental">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="slider-dots">
                    <div class="slider-dot active" onclick="goToSlide(0)"></div>
                    <div class="slider-dot" onclick="goToSlide(1)"></div>
                    <div class="slider-dot" onclick="goToSlide(2)"></div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="stats-section">
                <!-- Chart Card -->
                <div class="chart-card">
                    <div class="chart-header">
                        <select class="chart-select">
                            <option>Kunjungan Sakit</option>
                            <option>Kunjungan Sehat</option>
                        </select>
                        <select class="chart-select">
                            <option>Gigi</option>
                            <option>Umum</option>
                        </select>
                        <select class="chart-select">
                            <option>Bulan</option>
                            <option>Minggu</option>
                            <option>Tahun</option>
                        </select>
                    </div>
                    <div class="chart-value">
                        <h2>262</h2>
                        <span class="chart-badge up">
                            <i class="fas fa-arrow-up"></i> 40.27%
                        </span>
                    </div>
                    <p class="chart-subtitle">dari Desember</p>
                    <div class="chart-container">
                        <canvas id="visitChart"></canvas>
                    </div>
                </div>

                <!-- Stat Cards Column 1 -->
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fas fa-clock"></i>
                        </div>
                        <p class="stat-label">Rata-Rata<br>Waktu Tunggu Dokter</p>
                        <div class="stat-value">
                            <h3>0 m 5 s</h3>
                            <span class="stat-change down">
                                <i class="fas fa-arrow-down"></i> 76.19%
                            </span>
                        </div>
                        <p class="stat-period">dari Desember</p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green">
                            <i class="fas fa-users"></i>
                        </div>
                        <p class="stat-label">Pasien Terdaftar</p>
                        <div class="stat-value">
                            <h3>364</h3>
                            <span class="stat-change up">
                                <i class="fas fa-arrow-up"></i> 0.27%
                            </span>
                        </div>
                        <p class="stat-period">dari Desember</p>
                    </div>
                </div>

                <!-- Stat Cards Column 2 -->
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <p class="stat-label">Pasien Baru</p>
                        <div class="stat-value">
                            <h3>1</h3>
                            <span class="stat-change down">
                                <i class="fas fa-arrow-down"></i> 83.33%
                            </span>
                        </div>
                        <p class="stat-period">dari Desember</p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon orange">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <p class="stat-label">Rata-Rata<br>Waktu Konsultasi</p>
                        <div class="stat-value">
                            <h3>260 m 16 s</h3>
                            <span class="stat-change up">
                                <i class="fas fa-arrow-up"></i> 272.2%
                            </span>
                        </div>
                        <p class="stat-period">dari Desember</p>
                    </div>
                </div>
            </section>

            <!-- Bottom Section -->
            <section class="bottom-section">
                <!-- Donut Chart -->
                <div class="donut-card">
                    <div class="donut-header">
                        <h4>Total Kunjungan</h4>
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <p style="font-size: 11px; color: #9ca3af; margin-bottom: 15px;">Total Terhitung BPJS</p>
                    <div class="donut-content">
                        <div class="donut-chart">
                            <canvas id="donutChart"></canvas>
                            <div class="donut-center">
                                <h3>285</h3>
                                <span>Pasien</span>
                            </div>
                        </div>
                        <div class="donut-legend">
                            <div class="legend-item">
                                <span class="legend-dot blue"></span>
                                Rawat Jalan
                                <span class="legend-value">285</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-dot light-blue"></span>
                                Rawat Inap
                                <span class="legend-value">0</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-dot green"></span>
                                Kunjungan Sehat
                                <span class="legend-value">0</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-dot gray"></span>
                                Apotek
                                <span class="legend-value">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue -->
                <div class="revenue-card">
                    <p class="revenue-header">Pendapatan Bulan Ini</p>
                    <div class="revenue-value">
                        <h3>Rp7.700.000</h3>
                        <span class="stat-change down">
                            <i class="fas fa-arrow-down"></i> 56.49%
                        </span>
                    </div>
                    <p class="revenue-period">dari Desember</p>

                    <div class="expense-section">
                        <p class="revenue-header">Pengeluaran Bulan Ini</p>
                        <div class="revenue-value">
                            <h3>Rp0</h3>
                            <span class="stat-change down">
                                <i class="fas fa-arrow-down"></i> 100%
                            </span>
                        </div>
                        <p class="revenue-period">dari Desember</p>
                    </div>
                </div>

                <!-- Stock -->
                <div class="stock-card">
                    <div class="stock-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <p class="stock-label">Stok Menipis</p>
                    <div class="stock-value">
                        <h3>0</h3>
                    </div>

                    <div style="margin-top: 25px; padding-top: 15px; border-top: 1px solid #f3f4f6;">
                        <div class="stat-icon blue" style="margin-bottom: 12px;">
                            <i class="fas fa-prescription-bottle-alt"></i>
                        </div>
                        <p class="stat-label">Rata-Rata<br>Waktu Tunggu Apotek</p>
                        <div class="stat-value">
                            <h3>0 m 0 s</h3>
                            <span class="stat-change down">
                                <i class="fas fa-arrow-down"></i> 100%
                            </span>
                        </div>
                        <p class="stat-period">dari Desember</p>
                    </div>
                </div>

                <!-- Queue Table -->
                <div class="queue-card">
                    <div class="queue-header">
                        <h4>Pasien AntriCepat</h4>
                        <span class="queue-update">Last Update -</span>
                    </div>
                    <div class="queue-actions">
                        <button class="queue-btn">
                            <i class="fas fa-sort"></i> SORTIR
                        </button>
                        <button class="queue-btn">
                            <i class="fas fa-filter"></i> FILTER
                        </button>
                        <button class="queue-btn" style="background: var(--action); color: white; border-color: var(--action);">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <table class="queue-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tenaga Medis</th>
                                <th>Jadwal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="Nama" colspan="3" class="queue-empty">
                                    Tidak ada antrian
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            @endif
        </div>
    </main>

    <!-- Logout Form (Hidden) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
    </form>

    <script>
                // Redirect to login after logout
                document.addEventListener('DOMContentLoaded', function() {
                    var logoutForm = document.getElementById('logout-form');
                    if (!logoutForm) return;
                    logoutForm.addEventListener('submit', function() {
                        setTimeout(function() {
                            window.location.href = '/login';
                        }, 300);
                    });
                });
        // Visit Chart
        const visitCtx = document.getElementById('visitChart').getContext('2d');
        new Chart(visitCtx, {
            type: 'bar',
            data: {
                labels: ['-7H', '-6H', '-5H', '-4H', '-3H', '-2H', '-1H', '0', '1', '2', '3', '4', '5', '6', '7'],
                datasets: [{
                    data: [2, 4, 8, 12, 8, 15, 18, 22, 35, 28, 42, 38, 32, 25, 20],
                        backgroundColor: '#B08D70',
                    borderRadius: 4,
                    barThickness: 12
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#9ca3af', font: { size: 10 } }
                    },
                    y: {
                        grid: { color: '#f3f4f6' },
                        ticks: { color: '#9ca3af', font: { size: 10 } }
                    }
                }
            }
        });

        // Donut Chart
        const donutCtx = document.getElementById('donutChart').getContext('2d');
        new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Rawat Jalan', 'Rawat Inap', 'Kunjungan Sehat', 'Apotek'],
                datasets: [{
                    data: [285, 0, 0, 0],
                        backgroundColor: ['#B08D70', '#93c5fd', '#22c55e', '#d1d5db'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutout: '70%',
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Promo Slider
        let currentSlide = 0;
        const totalSlides = 3;
        const slider = document.getElementById('promoSlider');
        const dots = document.querySelectorAll('.slider-dot');

        function updateSlider() {
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        function moveSlide(direction) {
            currentSlide += direction;
            if (currentSlide < 0) currentSlide = totalSlides - 1;
            if (currentSlide >= totalSlides) currentSlide = 0;
            updateSlider();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        // Auto slide every 5 seconds
        setInterval(() => {
            moveSlide(1);
        }, 5000);

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

        // Close off-canvas sidebar when a menu item is clicked (mobile)
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
<style>
    /* Global responsive tweaks applied at the end to override inline rules where needed */
    @media (max-width: 1200px) {
        .main-content { padding: 12px; }
        .stats-section { grid-template-columns: 1fr 1fr; }
        .bottom-section { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 992px) {
        .header { padding: 10px; }
        .header-left { flex-direction: column; gap: 8px; }
        .search-box { min-width: 0; width: 100%; }
        .promo-slide { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .main-content { margin-left: 0; padding: 8px; }
        .sidebar { transform: translateX(-110%); }
        .sidebar.open { transform: translateX(0); }
        .hamburger { left: 8px; top: 8px; }
        .promo-card, .stat-card, .chart-card { padding: 12px; }
        .page-title h1 { font-size: 18px; }
    }

    @media (max-width: 480px) {
        .header-left h1 { font-size: 16px; }
        .header-right { gap: 8px; }
    }

    /* Doctor panel tidy styles */
    .doctor-panel { max-width: 1100px; margin: 0; }
    .doctor-panel .panel-card { background: #ffffff; padding: 18px; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.04); margin-bottom: 16px; }
    .doctor-panel .panel-title { margin: 0 0 6px 0; font-size: 18px; font-weight: 700; color: #2b2b2b; }
    .doctor-panel .panel-subtitle { margin: 0 0 12px 0; font-size: 13px; color: #94a3b8; }
    .doctor-panel .panel-title-small { margin: 0 0 8px 0; font-size: 16px; font-weight: 600; color: #2b2b2b; }
    .doctor-panel .panel-actions { display:flex; gap:12px; margin-top:12px; }
    .doctor-panel .action-link { color: #5b21b6; text-decoration: underline; font-weight:500 }
    .doctor-panel table thead th { color:#94a3b8; font-size:13px; font-weight:600; padding:10px 6px; text-align:left }
    .doctor-panel table tbody td { padding:14px 6px; vertical-align:top; border-top:1px solid #eef2f7; color:#484848 }
    .doctor-panel .panel-body { margin-top:6px }
    .doctor-panel .panel-header { display:flex; justify-content:space-between; align-items:flex-start; gap:16px }
    .panel-date-controls { display:flex; align-items:center; gap:10px }
    .panel-date-controls .date-arrow { background:transparent;border:1px solid rgba(0,0,0,0.06);width:34px;height:34px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;color:var(--accent);font-size:18px }
    .panel-date-controls .date-display { text-align:left }
    .panel-date-controls .day-name{ font-weight:700; color:var(--accent); font-size:14px }
    .panel-date-controls .date-text{ font-size:13px; color:var(--muted) }
    .panel-date-controls .today-btn{ background:var(--action); color:#fff; padding:8px 12px; border-radius:8px; border:none; cursor:pointer }
    .doctor-panel .panel-header { display:flex; justify-content:space-between; align-items:flex-start; gap:16px }
    .doctor-panel .panel-date-form input[type="date"] { padding:6px 8px; border:1px solid #e6e9ee; border-radius:6px; background:white }
</style>

</body>
</html>
