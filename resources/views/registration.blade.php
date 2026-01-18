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
        :root{ --sidebar-width:60px; --sidebar-compact-left:72px; }
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
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--surface);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px 0;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            border-right: 1px solid rgba(0,0,0,0.04);
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: var(--accent);
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
            color: var(--muted);
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            text-decoration: none;
        }

        .sidebar-item:hover,
        .sidebar-item.active {
            color: var(--text);
            background: rgba(0,0,0,0.03);
        }

        .sidebar-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--accent);
        }

        .sidebar-item i {
            font-size: 18px;
            color: inherit;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            background: var(--main-bg);
            min-height: 100vh;
            max-width: 100vw;
        }

        /* Header */
        .header {
            background: var(--surface);
            padding: 12px 25px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(0,0,0,0.04);
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }

        /* Note: main-content already offsets for the sidebar via margin-left */

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1 1 auto;
            min-width: 0; /* allow children to shrink */
        }

        .search-box {
            display: flex;
            align-items: center;
            background: #ffffff;
            border-radius: 25px;
            padding: 8px 16px;
            gap: 10px;
            min-width: 0;
            flex: 1 1 320px; /* allow it to grow/shrink */
            max-width: 720px;
            position: relative;
            border: 1px solid rgba(15, 23, 42, 0.10);
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.06);
            min-height: 42px;
        }

        .search-box:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.06);
        }

        .global-search-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12);
            overflow: hidden;
            z-index: 999;
            display: none;
        }

        .global-search-item {
            padding: 10px 12px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .global-search-item:hover,
        .global-search-item.active {
            background: rgba(0,0,0,0.04);
        }

        .global-search-item .name {
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.2;
        }

        .global-search-item .meta {
            font-size: 12px;
            color: #64748b;
        }

        .global-search-empty {
            padding: 12px;
            color: #64748b;
            font-size: 12px;
        }

        .search-box input {
            border: none;
            outline: none;
            font-size: 13px;
            color: #64748b;
            width: 100%;
        }

        .search-box i {
            color: var(--accent);
        }

        .btn-pendaftaran {
            background: var(--action);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            flex: 0 0 auto;
            margin-left: auto; /* push to the right inside header-left (desktop) */
        }

        .btn-pendaftaran:hover {
            background: rgba(95,111,101,0.92);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 0 0 auto;
            min-width: 0;
            margin-left: auto; /* push to far right */
            order: 2;
            justify-content: flex-end;
        }

        .header-logo {
            width: 40px;
            height: 40px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 600;
            flex: 0 0 auto;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--action);
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
            flex: 0 0 auto;
        }

        .user-dropdown .user-avatar {
            width: 26px;
            height: 26px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
        }

        .user-dropdown .user-avatar i {
            color: #64748b;
            font-size: 14px;
        }

        .user-dropdown .user-name {
            color: white;
            font-size: 14px;
            white-space: nowrap;
        }

        .header-icons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .header-icon {
            color: var(--muted);
            font-size: 18px;
            cursor: pointer;
        }

        /* Page Title */
        .page-title {
            background: var(--surface);
            padding: 15px 25px 25px;
        }

        .page-title h1 {
            color: var(--text);
            font-size: 24px;
            font-weight: 600;
        }

        .page-title p {
            color: var(--muted);
            font-size: 13px;
        }

        /* Content Area */
        .content {
            padding: 25px;
            display: flex;
            gap: 20px;
            justify-content: flex-start; /* let main panel fill available width */
        }

        /* Left Menu (hidden on this simplified page) */
        .left-menu { display:none }

        /* Section tab removed per request (was above the panel) */

        /* Make main panel fill available content area */
        .main-panel{flex:1;width:100%;max-width:none}

        @media (max-width: 768px) {
            .main-panel{max-width:100%}
        }

        .menu-item {
            padding: 15px 20px;
            color: var(--text);
            font-size: 14px;
            cursor: pointer;
            border-left: 4px solid transparent;
            transition: all 0.2s ease;
        }

        .menu-item:hover {
            background: var(--main-bg);
        }

        .menu-item.active {
            background: var(--action);
            color: white;
            border-left-color: var(--accent);
        }

        /* Main Panel */
        .main-panel {
            flex: 1;
            background: var(--surface);
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        /* Panel Header */
        .panel-header {
            padding: 20px 25px;
            border-bottom: 1px solid rgba(0,0,0,0.04);
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
            color: var(--text);
            font-weight: 600;
        }

        .panel-title i {
            color: var(--muted);
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
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 50%;
            background: var(--surface);
            color: var(--muted);
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
            color: var(--accent);
        }

        .filter-input {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 6px;
            font-size: 13px;
            color: var(--text);
            background: var(--surface);
            cursor: pointer;
            min-width: 160px;
            position: relative;
        }

        .filter-input i {
            color: var(--muted);
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Date input: hide native calendar icon (avoid double icons) */
        .filter-input .filter-date {
            -webkit-appearance: none;
            appearance: none;
            padding-right: 34px;
        }

        .filter-input .filter-date::-webkit-calendar-picker-indicator {
            opacity: 0;
            position: absolute;
            right: 8px;
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .filter-input .filter-date::-webkit-inner-spin-button,
        .filter-input .filter-date::-webkit-clear-button {
            display: none;
        }

        /* Date range popover (opened by + button) */
        .date-range-container { position: relative; display: flex; align-items: flex-end; }

        .date-range-popover {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: var(--surface);
            border: 1px solid rgba(0,0,0,0.10);
            border-radius: 8px;
            padding: 10px 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.10);
            z-index: 1000;
            display: none;
            min-width: 420px;
        }

        .date-range-popover.open { display: block; }

        .date-range-row { display: flex; align-items: flex-start; gap: 10px; }
        .date-range-field { display: flex; flex-direction: column; gap: 6px; }
        .date-range-sep { padding-top: 8px; color: var(--muted); }

        .date-range-input {
            position: relative;
            display: flex;
            align-items: center;
            width: 170px;
            padding: 8px 10px;
            border-bottom: 1px solid rgba(0,0,0,0.20);
            background: transparent;
        }

        .date-range-input input {
            border: none;
            outline: none;
            background: transparent;
            color: var(--text);
            font-size: 14px;
            width: 100%;
            padding-right: 28px;
            -webkit-appearance: none;
            appearance: none;
        }

        .date-range-input i {
            position: absolute;
            right: 6px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }

        .date-range-input input::-webkit-calendar-picker-indicator {
            opacity: 0;
            position: absolute;
            right: 0;
            width: 28px;
            height: 28px;
            cursor: pointer;
        }

        .date-range-label { font-size: 12px; color: var(--muted); }

        .date-range-clear {
            border: none;
            background: transparent;
            color: var(--muted);
            cursor: pointer;
            padding: 6px;
            line-height: 1;
        }

        .date-range-clear:hover { color: var(--text); }

        @media (max-width: 768px) {
            .date-range-popover {
                min-width: 0;
                width: min(360px, calc(100vw - 24px));
                padding-top: 28px;
            }

            .date-range-row { flex-wrap: wrap; gap: 8px; }
            .date-range-field { flex: 1 1 160px; }
            .date-range-sep { display: none; }

            .date-range-input { width: 100%; }
            .date-range-input input { font-size: 13px; }

            .date-range-clear {
                position: absolute;
                top: 6px;
                right: 6px;
            }
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 6px;
            font-size: 13px;
            color: var(--text);
            background: var(--surface);
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
            background: var(--surface);
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 6px;
            color: var(--muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .btn-filter {
            height: 40px;
            padding: 0 18px;
            border: none;
            border-radius: 8px;
            background: #e9eef5;
            color: #111827;
            font-weight: 600;
            letter-spacing: 0.3px;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        .btn-filter:hover { filter: brightness(.99); }

        .search-patient {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 6px;
            background: var(--surface);
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
            background: var(--main-bg);
            padding: 15px 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            border-bottom: 1px solid rgba(0,0,0,0.04);
        }

        .data-table td {
            padding: 15px 12px;
            font-size: 13px;
            color: var(--text);
            border-bottom: 1px solid rgba(0,0,0,0.03);
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
            overflow: visible; /* ensure menu can overflow container */
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
            z-index: 99999; /* bring above other stacking contexts */
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
                display: flex;
                flex-direction: column;
            }

            /* Mobile: show page title first, then header controls */
            .page-title { order: 1; }
            .header { order: 2; }
            .content { order: 3; }
            .content {
                flex-direction: column;
                padding: 12px;
                gap: 12px;
            }
            .left-menu {
                width: 100%;
            }

            .page-title {
                padding: 10px 10px 15px;
            }

            .panel-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                padding: 12px;
            }

            .panel-actions {
                width: 100%;
                justify-content: flex-end;
                gap: 10px;
            }

            .filters {
                padding: 10px 10px;
                gap: 10px;
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group,
            .search-patient {
                width: 100%;
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
                        color: var(--accent);
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

        /* Medium screen improvements */
        @media (max-width: 992px) {
            .header { align-items: flex-start; }
            .header-left { flex-wrap: wrap; }
            .header-right { margin-top: 6px; width: 100%; display:flex; justify-content:flex-end; gap: 12px; }
            .btn-pendaftaran { margin-left: 0; }
            .hamburger { display: flex !important; background: var(--surface); color: var(--accent); height:36px; width:36px; border-radius:8px; padding:0; justify-content:center; align-items:center }
            .left-menu { width: 100%; }
            .main-panel { width: 100%; }
            .content { gap: 12px; }
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
                    <input id="globalPatientSearch" type="text" autocomplete="off" placeholder="Cari Pasien / No MR ">
                    <div id="globalSearchDropdown" class="global-search-dropdown" aria-label="Hasil pencarian pasien"></div>
                </div>
            </div>
            <div class="header-right">
                <div class="user-dropdown-container">
                    <div class="user-dropdown" onclick="toggleUserMenu()">
                        <span class="user-avatar" aria-hidden="true"><i class="fas fa-user"></i></span>
                        <span class="user-name">{{ Auth::user()->name ?? 'hangleki' }}</span>
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
            </div>
        </header>

        <!-- Page Title -->
        <div class="page-title">
            <h1>Registration</h1>
            <p>hanglekiu dental specialist</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- (section tab removed) -->

            <!-- Main Panel -->
            <div class="main-panel">
                <!-- Panel Header -->
                <div class="panel-header">
                    <div class="panel-title">
                        <h2>Rawat Jalan Poli</h2>
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="panel-actions">
                        <button class="btn-info" title="Info">
                            <i class="fas fa-info"></i>
                        </button>
                        <button id="exportBtn" class="btn-export">
                            EXPORT
                        </button>
                        <button id="printBtn" class="btn-print" title="Print">
                            <i class="fas fa-print" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filters">
                    {{-- Keep a hidden single-date fallback (used only when date range is empty) --}}
                    <input id="visitDate" type="hidden" value="{{ $date ?? now()->toDateString() }}">

                    <div class="filter-group">
                        <span class="filter-label">Dari Tanggal</span>
                        <div class="date-range-input">
                            <input id="dateFrom" type="date" value="{{ ($dateFrom ?: ($date ?? now()->toDateString())) }}">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>

                    <div class="filter-group">
                        <span class="filter-label">Sampai Tanggal</span>
                        <div class="date-range-input">
                            <input id="dateTo" type="date" value="{{ ($dateTo ?: ($date ?? now()->toDateString())) }}">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>

                    <button id="filterBtn" class="btn-filter" type="button">FILTER</button>
                    <div class="filter-group">
                        <span class="filter-label">Tenaga Medis *</span>
                        <select id="doctorFilter" class="filter-select">
                            <option value="">Semua Tenaga Medis</option>
                            @foreach(($doctors ?? collect()) as $d)
                                <option value="{{ $d->id }}" {{ (string)($selectedDoctorId ?? '') === (string)$d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <span class="filter-label">Metode Pembayaran *</span>
                        <select id="paymentFilter" class="filter-select">
                            <option value="">Semua Metode Pembayaran</option>
                            @php $paySel = (string)($selectedPayment ?? ''); @endphp
                            @foreach(['Langsung','Tunai','BPJS','Asuransi'] as $pm)
                                <option value="{{ $pm }}" {{ $paySel === (string)$pm ? 'selected' : '' }}>{{ $pm }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-patient">
                        <input id="searchFilter" type="text" value="{{ $q ?? '' }}" placeholder="Nama Pasien, Booking Code">
                        <i id="searchButton" class="fas fa-search" style="cursor:pointer"></i>
                    </div>
                    <div class="filter-group">
                        <span class="filter-label">Poli *</span>
                        @php $poliSel = (string)($selectedPoli ?? ''); @endphp
                        <select id="poliFilter" class="filter-select">
                            <option value="" {{ $poliSel === '' ? 'selected' : '' }}>Semua Poli</option>
                            <option value="Gigi" {{ $poliSel === 'Gigi' ? 'selected' : '' }}>Gigi</option>
                            <option value="Umum" {{ $poliSel === 'Umum' ? 'selected' : '' }}>Umum</option>
                        </select>
                    </div>
                </div>

                <!-- Print Header (only visible when printing) -->
                <div class="print-only print-header">
                    <div class="print-header-left">
                        <div class="print-logo">
                            <img src="{{ asset('assets/logo2.jpeg') }}" alt="Logo" loading="eager">
                        </div>
                    </div>
                    <div class="print-header-right">
                        <div class="print-clinic-name">Hanglekiu Dental Specialist</div>
                        <div class="print-clinic-address">
                            <div>Jl. R. Haji Leki Kiu V No. 1</div>
                            <div>Kebon Jeruk, Kota Jakarta Selatan</div>
                            <div>Daerah Khusus Ibukota Jakarta</div>
                        </div>
                        <div class="print-meta">
                            <span>Tanggal: {{ \Carbon\Carbon::parse($date ?? now()->toDateString())->format('d/m/Y') }}</span>
                            @if(!empty($selectedDoctorId))
                                <span>• Dokter: {{ optional(($doctors ?? collect())->firstWhere('id', (int)$selectedDoctorId))->name ?? '-' }}</span>
                            @endif
                            @if(!empty($selectedPayment))
                                <span>• Bayar: {{ $selectedPayment }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="col-status">Status</th>
                                <th class="col-visit-date">Tanggal</th>
                                <th class="col-visit-time">Jam</th>
                                <th class="no-print col-created">Tanggal Dibuat</th>
                                <th class="no-print col-poli">Poli</th>
                                <th class="col-patient-name">Nama</th>
                                <th class="col-invoice">Invoice</th>
                                <th class="col-age">Umur</th>
                                <th class="col-procedure">Rencana Tindakan</th>
                                <th class="col-doctor">Tenaga Medis</th>
                                <th class="col-payment">Tipe Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $rows = $appointments ?? collect();
                            @endphp

                            @forelse($rows as $i => $a)
                                @php
                                    $statusRaw = strtolower((string) ($a->status ?? ''));
                                    $statusText = $a->status ? ucfirst($statusRaw) : '-';
                                    $statusClass = 'status-succeed';
                                    if (in_array($statusRaw, ['pending'], true)) {
                                        $statusClass = 'status-pending';
                                    } elseif (in_array($statusRaw, ['cancelled', 'canceled'], true)) {
                                        $statusClass = 'status-cancelled';
                                    }

                                    $visitDate = $a->start_at ? \Carbon\Carbon::parse($a->start_at)->format('d/m/Y') : '-';
                                    $visitTime = $a->start_at ? \Carbon\Carbon::parse($a->start_at)->format('H:i') : '-';
                                    $createdAt = $a->created_at ? \Carbon\Carbon::parse($a->created_at)->format('d/m/Y') : '-';

                                    $patientName = \Illuminate\Support\Str::title(preg_replace('/\s+/', ' ', trim((string) ($a->patient_name ?? ''))));
                                    $invoice = $a->medical_record_number ?: '-';

                                    $ageText = null;
                                    if (!empty($a->patient_birth_date)) {
                                        $ageYears = \Carbon\Carbon::parse($a->patient_birth_date)->age;
                                        $ageText = $ageYears . ' Tahun';
                                    }

                                    $poli = 'Gigi';
                                    $procedure = $a->procedure ?: '-';
                                    $doctorName = $a->doctor?->name ?: '-';
                                    $payment = $a->payment_method ?: 'Langsung';
                                @endphp

                                <tr>
                                    <td class="col-status" data-label="Status"><span class="status-badge {{ $statusClass }}">{{ $statusText }}</span></td>
                                    <td class="col-visit-date" data-label="Tanggal">{{ $visitDate }}</td>
                                    <td class="col-visit-time" data-label="Jam">{{ $visitTime }}</td>
                                    <td class="no-print col-created" data-label="Tanggal Dibuat">{{ $createdAt }}</td>
                                    <td class="no-print col-poli" data-label="Poli"><span class="poli-badge">{{ $poli }}</span></td>
                                    <td class="col-patient-name" data-label="Nama">{{ $patientName ?: '-' }}</td>
                                    <td class="col-invoice" data-label="Invoice">{{ $invoice }}</td>
                                    <td class="col-age" data-label="Umur">{{ $ageText ?? '-' }}</td>
                                    <td class="col-procedure" data-label="Rencana Tindakan">{{ $procedure }}</td>
                                    <td class="col-doctor" data-label="Tenaga Medis">{{ $doctorName }}</td>
                                    <td class="col-payment" data-label="Tipe Bayar">{{ $payment }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" style="padding:18px 12px;color:var(--muted);text-align:center">Belum ada booking pada tanggal ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    

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

        // Global patient search (header) -> jump to EMR
        (function(){
            const input = document.getElementById('globalPatientSearch');
            const dropdown = document.getElementById('globalSearchDropdown');
            const container = document.querySelector('.search-box');
            if (!input || !dropdown || !container) return;

            let timer = null;
            let abortCtrl = null;
            let results = [];
            let activeIndex = -1;

            function closeDropdown() {
                dropdown.style.display = 'none';
                dropdown.innerHTML = '';
                results = [];
                activeIndex = -1;
            }

            function openDropdown() {
                dropdown.style.display = 'block';
            }

            function setActiveIndex(nextIndex) {
                activeIndex = nextIndex;
                const items = dropdown.querySelectorAll('.global-search-item');
                items.forEach((el, idx) => {
                    if (idx === activeIndex) el.classList.add('active');
                    else el.classList.remove('active');
                });
            }

            function render() {
                dropdown.innerHTML = '';

                if (!results.length) {
                    const empty = document.createElement('div');
                    empty.className = 'global-search-empty';
                    empty.textContent = 'Tidak ada hasil.';
                    dropdown.appendChild(empty);
                    openDropdown();
                    return;
                }

                results.forEach((row, idx) => {
                    const item = document.createElement('div');
                    item.className = 'global-search-item';
                    item.setAttribute('role', 'button');
                    item.tabIndex = 0;
                    item.dataset.url = row.emr_url;

                    const name = document.createElement('div');
                    name.className = 'name';
                    name.textContent = row.name || '-';

                    const meta = document.createElement('div');
                    meta.className = 'meta';
                    const parts = [];
                    if (row.mrn) parts.push('MR: ' + row.mrn);
                    if (row.phone) parts.push('HP: ' + row.phone);
                    if (row.last_visit) parts.push('Terakhir: ' + row.last_visit);
                    meta.textContent = parts.join(' • ');

                    item.appendChild(name);
                    item.appendChild(meta);

                    item.addEventListener('click', () => {
                        if (row.emr_url) window.location.href = row.emr_url;
                    });

                    item.addEventListener('mouseenter', () => setActiveIndex(idx));
                    dropdown.appendChild(item);
                });

                openDropdown();
                setActiveIndex(0);
            }

            async function doSearch(q) {
                if (abortCtrl) abortCtrl.abort();
                abortCtrl = new AbortController();

                const url = new URL('{{ route('patients.search') }}', window.location.origin);
                url.searchParams.set('q', q);

                try {
                    const resp = await fetch(url.toString(), {
                        headers: { 'Accept': 'application/json' },
                        signal: abortCtrl.signal,
                    });
                    if (!resp.ok) throw new Error('Request failed');
                    const data = await resp.json();
                    results = Array.isArray(data) ? data : [];
                    render();
                } catch (e) {
                    if (e.name === 'AbortError') return;
                    closeDropdown();
                }
            }

            input.addEventListener('input', function(){
                const q = (this.value || '').trim();
                if (timer) clearTimeout(timer);
                if (q.length < 2) {
                    closeDropdown();
                    return;
                }
                timer = setTimeout(() => doSearch(q), 250);
            });

            input.addEventListener('keydown', function(e){
                if (dropdown.style.display !== 'block') return;
                const items = dropdown.querySelectorAll('.global-search-item');
                if (!items.length) return;

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    setActiveIndex(Math.min(activeIndex + 1, items.length - 1));
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    setActiveIndex(Math.max(activeIndex - 1, 0));
                } else if (e.key === 'Enter') {
                    e.preventDefault();
                    const el = items[activeIndex] || items[0];
                    const url = el?.dataset?.url;
                    if (url) window.location.href = url;
                } else if (e.key === 'Escape') {
                    closeDropdown();
                }
            });

            input.addEventListener('focus', function(){
                if (results.length) openDropdown();
            });

            document.addEventListener('click', function(e){
                if (!container.contains(e.target)) {
                    closeDropdown();
                }
            });
        })();

        // Registration filters handlers
        (function(){
            function applyFilters(){
                const url = new URL(window.location.href);
                const date = document.getElementById('visitDate')?.value || '';
                const dateFrom = document.getElementById('dateFrom')?.value || '';
                const dateTo = document.getElementById('dateTo')?.value || '';
                const doctor = document.getElementById('doctorFilter')?.value || '';
                const payment = document.getElementById('paymentFilter')?.value || '';
                const q = document.getElementById('searchFilter')?.value || '';
                const poli = document.getElementById('poliFilter')?.value || '';

                // Use date range when either side is set (backend supports one-sided ranges)
                if (dateFrom || dateTo) {
                    url.searchParams.set('date_from', dateFrom);
                    url.searchParams.set('date_to', dateTo);
                    url.searchParams.delete('date');
                } else {
                    url.searchParams.delete('date_from');
                    url.searchParams.delete('date_to');
                    if(date) url.searchParams.set('date', date); else url.searchParams.delete('date');
                }
                if(doctor) url.searchParams.set('doctor', doctor); else url.searchParams.delete('doctor');
                if(payment) url.searchParams.set('payment', payment); else url.searchParams.delete('payment');
                if(q) url.searchParams.set('q', q); else url.searchParams.delete('q');
                if(poli) url.searchParams.set('poli', poli); else url.searchParams.delete('poli');

                window.location.href = url.toString();
            }

            // Date range: apply only when user clicks FILTER (matches requested UI)
            const filterBtn = document.getElementById('filterBtn');
            if(filterBtn){
                filterBtn.addEventListener('click', applyFilters);
            }
            const fromEl = document.getElementById('dateFrom');
            const toEl = document.getElementById('dateTo');
            function onDateKeydown(ev){ if(ev.key === 'Enter') applyFilters(); }
            if(fromEl) fromEl.addEventListener('keydown', onDateKeydown);
            if(toEl) toEl.addEventListener('keydown', onDateKeydown);
            const doctorEl = document.getElementById('doctorFilter');
            if(doctorEl){
                doctorEl.addEventListener('change', applyFilters);
            }
            const paymentEl = document.getElementById('paymentFilter');
            if(paymentEl){
                paymentEl.addEventListener('change', applyFilters);
            }
            const poliEl = document.getElementById('poliFilter');
            if(poliEl){
                poliEl.addEventListener('change', applyFilters);
            }
            const searchEl = document.getElementById('searchFilter');
            if(searchEl){
                searchEl.addEventListener('keydown', function(ev){
                    if(ev.key === 'Enter') applyFilters();
                });
            }
            const searchBtn = document.getElementById('searchButton');
            if(searchBtn){
                searchBtn.addEventListener('click', applyFilters);
            }

            // Export CSV using current filters
            const exportBtn = document.getElementById('exportBtn');
            if(exportBtn){
                exportBtn.addEventListener('click', function(){
                    const url = new URL(window.location.origin + '/registration/export');
                    const date = document.getElementById('visitDate')?.value || '';
                    const dateFrom = document.getElementById('dateFrom')?.value || '';
                    const dateTo = document.getElementById('dateTo')?.value || '';
                    const doctor = document.getElementById('doctorFilter')?.value || '';
                    const payment = document.getElementById('paymentFilter')?.value || '';
                    const q = document.getElementById('searchFilter')?.value || '';
                    const poli = document.getElementById('poliFilter')?.value || '';

                    if (dateFrom || dateTo) {
                        url.searchParams.set('date_from', dateFrom);
                        url.searchParams.set('date_to', dateTo);
                    } else {
                        if(date) url.searchParams.set('date', date);
                    }
                    if(doctor) url.searchParams.set('doctor', doctor);
                    if(payment) url.searchParams.set('payment', payment);
                    if(q) url.searchParams.set('q', q);
                    if(poli) url.searchParams.set('poli', poli);

                    window.location.href = url.toString();
                });
            }

            // Print current page
            const printBtn = document.getElementById('printBtn');
            if(printBtn){
                printBtn.addEventListener('click', function(){
                    window.print();
                });
            }
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

        /* Print template */
        .print-only { display: none; }
        .print-cell-only { display: none; }

        .print-header {
            display: none;
            gap: 14px;
            align-items: flex-start;
            padding: 16px 18px 10px;
        }

        .print-logo {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .print-logo img {
            width: 64px;
            height: 64px;
            object-fit: contain;
            display: block;
        }

        .print-clinic-name {
            font-weight: 700;
            font-size: 14px;
            color: #111827;
            margin-bottom: 4px;
        }

        .print-clinic-address {
            font-size: 11px;
            color: #374151;
            line-height: 1.35;
            margin-bottom: 6px;
        }

        .print-meta {
            font-size: 11px;
            color: #111827;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        @media print {
            @page { size: A4 landscape; margin: 12mm; }

            body {
                display: block !important;
            }

            .content {
                display: block !important;
                gap: 0 !important;
            }

            body {
                background: #fff !important;
                color: #111827 !important;
            }

            .no-print {
                display: none !important;
            }

            /* Hide app chrome */
            .sidebar,
            .hamburger,
            .header,
            .page-title,
            .filters,
            .panel-actions,
            .btn-add,
            .chat-button {
                display: none !important;
            }

            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }

            .content {
                padding: 0 !important;
            }

            .main-panel {
                box-shadow: none !important;
                border-radius: 0 !important;
                overflow: visible !important;
            }

            .panel-header {
                border-bottom: none !important;
                padding: 0 !important;
            }

            .panel-title {
                display: none !important;
            }

            .print-only {
                display: block !important;
            }

            .print-cell-only {
                display: table-cell !important;
            }

            .print-header {
                display: flex !important;
            }

            .table-container {
                overflow: visible !important;
                width: 100% !important;
            }

            .data-table {
                width: 100% !important;
                table-layout: fixed !important;
                border-collapse: collapse !important;
                display: table !important;
            }

            /* Override mobile "table-as-cards" rules for printing */
            .data-table thead {
                display: table-header-group !important;
            }

            .data-table tbody {
                display: table-row-group !important;
            }

            .data-table tr {
                display: table-row !important;
                margin: 0 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                padding: 0 !important;
                background: transparent !important;
            }

            .data-table th,
            .data-table td {
                display: table-cell !important;
            }

            /* Ensure print-only / no-print utilities win against table-cell overrides */
            .data-table th.no-print,
            .data-table td.no-print {
                display: none !important;
            }

            .data-table th.print-cell-only,
            .data-table td.print-cell-only {
                display: table-cell !important;
            }

            .data-table td:before {
                content: none !important;
                display: none !important;
            }

            .data-table th,
            .data-table td {
                border: 1px solid #9ca3af !important;
                padding: 4px 4px !important;
                font-size: 9px !important;
                line-height: 1.2 !important;
                vertical-align: top;
                background: #fff !important;
                color: #111827 !important;
                white-space: normal !important;
                word-break: normal !important;
                overflow-wrap: break-word !important;
            }

            /* Column sizing hints (matches the sample print table) */
            .data-table th.col-status,
            .data-table td.col-status { width: 8%; }
            .data-table th.col-visit-date,
            .data-table td.col-visit-date { width: 10%; }
            .data-table th.col-visit-time,
            .data-table td.col-visit-time { width: 6%; }
            .data-table th.col-patient-name,
            .data-table td.col-patient-name { width: 14%; }
            .data-table th.col-invoice,
            .data-table td.col-invoice { width: 9%; }
            .data-table th.col-age,
            .data-table td.col-age { width: 5%; }
            .data-table th.col-procedure,
            .data-table td.col-procedure { width: 16%; }
            .data-table th.col-doctor,
            .data-table td.col-doctor { width: 16%; }
            .data-table th.col-payment,
            .data-table td.col-payment { width: 8%; }

            .data-table th {
                font-weight: 700;
                background: #fff !important;
            }

            .status-badge,
            .poli-badge {
                background: transparent !important;
                color: #111827 !important;
                border: none !important;
                padding: 0 !important;
                font-weight: 600;
            }

            .status-succeed { color: #16a34a !important; }
            .status-pending { color: #2563eb !important; }
            .status-cancelled { color: #dc2626 !important; }

            /* Ensure header prints on each page */
            thead { display: table-header-group; }
            tfoot { display: table-footer-group; }

            /* Avoid row splitting */
            tr { page-break-inside: avoid; }
        }

        @media (max-width: 768px) {
            .main-content { margin-left: 0; padding: 8px; display: flex; flex-direction: column; }

            /* Mobile: show page title first, then header controls */
            .page-title { order: 1; }
            .header { order: 2; }
            .content { order: 3; }
            .hamburger { left: 8px; top: 8px; display:flex; background: var(--surface); color: var(--accent); height:36px; width:36px; border-radius:8px; padding:0; justify-content:center; align-items:center }
            .left-menu { width: 100%; }
            .menu-item { padding: 12px 16px; }

            /* Keep header items on a single responsive row when possible */
            .header { flex-direction: row; flex-wrap: wrap; align-items: center; gap: 8px; padding: 8px 10px; }
            .header-left { flex-direction: row; align-items: center; gap: 8px; flex: 1 1 100%; min-width: 0; }
            .search-box { flex: 1 1 220px; min-width: 0; max-width: none; }
            .btn-pendaftaran { flex: 0 0 auto; padding: 8px 12px; }

            /* Header right row: keep items aligned to the right */
            .header-right { flex: 1 1 100%; width: 100%; margin-left: 0; order: 3; display: flex; align-items: center; justify-content: flex-end; gap: 8px; flex-wrap: nowrap; }
            .header-logo { width: 34px; height: 34px; font-size: 11px; }
            .user-dropdown { padding: 6px 10px; }
            .user-dropdown span { max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: inline-block; vertical-align: bottom; }
            .header-icon { font-size: 16px; }

            /* Avoid hamburger overlaying the page title/header */
            .page-title { padding-left: 54px; padding-right: 10px; }
            .page-title h1 { font-size: 20px; }
            .page-title p { font-size: 12px; }
            .header { padding-left: 54px; }
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
