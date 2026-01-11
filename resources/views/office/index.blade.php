<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office - Hanglekiu Dental Specialist</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f9fc;
            color: #334155;
            font-size: 13px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background-color: #f0f0f0;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #b0b0b0;
            border-radius: 3px;
        }

        /* Styling khusus Tab Menu Kiri */
        .settings-menu-item {
            display: block;
            padding: 12px 20px;
            font-size: 14px;
            border-bottom: 1px solid #e0e0e0;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            text-decoration: none;
            color: #334155;
        }

        .settings-menu-item:hover {
            background-color: #f8fafc;
            color: #1565c0;
        }

        .settings-menu-item.active {
            background-color: #2196f3;
            color: white;
            border-bottom: 1px solid #1976d2;
        }

        /* Content Visibility Logic */
        .tab-content {
            display: none !important;
            height: 100%;
            flex-direction: column;
        }

        .tab-content.active {
            display: flex !important;
        }

        /* Stat Cards Styling */
        .stat-card {
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 20px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }

        /* Finance Card Styling */
        .finance-card {
            background-color: white;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 1.5rem 1rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .finance-card-label {
            font-size: 14px;
            color: #334155;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .finance-card-value {
            font-size: 14px;
            font-weight: bold;
        }

        .text-money-green {
            color: #22c55e;
        }

        .text-money-red {
            color: #ef4444;
        }

        /* Report List Item Styling */
        .report-item {
            margin-bottom: 2rem;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #0ea5e9;
            padding-bottom: 0.5rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
        }

        .report-title {
            color: #0284c7;
            font-weight: 700;
            font-size: 15px;
        }

        .report-desc {
            color: #334155;
            font-size: 13px;
        }

        /* Fraud Tab Styling */
        .fraud-tab {
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            background-color: #e2e8f0;
            border-right: 1px solid #cbd5e1;
            cursor: pointer;
            white-space: nowrap;
        }

        .fraud-tab.active {
            background-color: #2196f3;
            /* Blue */
            color: white;
        }

        /* Modal Styling (Popup Edit Akun) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(2px);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 0;
            border: 1px solid #888;
            width: 90%;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* Table Styling Helper */
        .custom-table th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            padding: 12px 16px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        .custom-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 13px;
        }

        .custom-table tr:hover td {
            background-color: #f8fafc;
        }

        /* --- RESPONSIVE LOGIC --- */
        .settings-mobile-menu {
            position: fixed;
            left: -100%;
            top: 0;
            bottom: 0;
            width: 280px;
            background: white;
            z-index: 300;
            transition: left 0.3s ease;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .settings-mobile-menu.active {
            left: 0;
        }

        .settings-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 290;
            display: none;
        }

        .settings-overlay.active {
            display: block;
        }

        .sidebar-backdrop {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
            display: none;
        }

        .sidebar-backdrop.active {
            display: block;
        }

        /* Main Sidebar Transition */
        #mainSidebar {
            transition: transform 0.3s ease-in-out;
            z-index: 50;
        }
    </style>
</head>

<body class="bg-[#f5f9fc] text-gray-700">

    <div id="sidebarBackdrop" class="sidebar-backdrop"></div>
    @include('partials.sidebar')


    <div id="modalEditAkun" class="modal">
        <div class="modal-content relative animate-[fadeIn_0.3s_ease-out]">
            <span onclick="closeModal('modalEditAkun')"
                class="absolute top-3 right-5 text-gray-400 text-2xl font-bold cursor-pointer hover:text-gray-600 transition">&times;</span>

            <div class="p-8">
                <h2 class="text-xl font-bold text-[#2196f3] text-center mb-10">Edit Akun</h2>
                <div class="flex flex-col md:flex-row gap-8 justify-center items-start mb-12">
                    <div class="w-full md:w-1/3 flex flex-col items-center">
                        <label class="block text-xs font-bold text-gray-500 mb-2 uppercase tracking-wide">Pilih
                            Akun</label>
                        <div class="relative w-full">
                            <select
                                class="w-full border-b border-gray-400 py-2 text-center text-gray-700 font-bold focus:outline-none bg-transparent appearance-none cursor-pointer hover:border-blue-500 transition">
                                <option>Kas</option>
                                <option>Bank BCA</option>
                                <option>Bank Mandiri</option>
                            </select>
                            <i class="fas fa-caret-down absolute right-2 top-3 text-gray-400 pointer-events-none"></i>
                        </div>
                        <div class="text-center mt-3 text-green-500 font-bold text-sm">(Rp207.500.000)</div>
                        <div class="mt-6">
                            <a href="#"
                                class="text-[10px] font-bold text-gray-500 hover:text-blue-600 hover:underline uppercase transition">TAMBAH
                                METODE BAYAR</a>
                        </div>
                    </div>

                    <div class="w-full md:w-1/3 flex flex-col items-center">
                        <label class="block text-xs font-bold text-gray-500 mb-2 uppercase tracking-wide">Ganti
                            Nama</label>
                        <input type="text" value="Kas"
                            class="w-full border-b border-gray-400 py-2 text-center text-gray-700 font-bold focus:outline-none border-dashed bg-transparent hover:border-blue-500 transition">
                    </div>

                    <div class="w-full md:w-1/3 flex flex-col items-center relative">
                        <label class="block text-xs font-bold text-gray-500 mb-2 uppercase tracking-wide">Koreksi
                            Saldo</label>
                        <div
                            class="flex items-center w-full border-b border-gray-400 border-dashed hover:border-blue-500 transition">
                            <input type="text" value="Rp207.500.000"
                                class="w-full py-2 text-center text-green-600 font-bold focus:outline-none bg-transparent">
                            <button class="text-gray-400 hover:text-red-500 transition px-2"><i
                                    class="fas fa-times-circle"></i></button>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-4">
                    <button onclick="closeModal('modalEditAkun')"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-8 rounded shadow-md text-xs transition transform active:scale-95">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>

    <div class="settings-overlay" id="settingsOverlay" onclick="closeSettingsMenu()"></div>

    <div class="settings-mobile-menu" id="settingsMenu">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-blue-50">
            <h2 class="font-bold text-lg text-[#1565c0]">Menu Opsi</h2>
            <button onclick="closeSettingsMenu()" class="text-gray-500 text-2xl hover:text-red-500">&times;</button>
        </div>
        <div class="flex flex-col text-[14px]">
            <div onclick="switchTab('dashboard', this); closeSettingsMenu();" class="settings-menu-item active"
                id="mobile-tab-dashboard">Dashboard Harian</div>
            <div onclick="switchTab('keuangan', this); closeSettingsMenu();" class="settings-menu-item"
                id="mobile-tab-keuangan">Keuangan</div>
            <div onclick="switchTab('laporan', this); closeSettingsMenu();" class="settings-menu-item"
                id="mobile-tab-laporan">Laporan</div>
            <div onclick="switchTab('pasien', this); closeSettingsMenu();" class="settings-menu-item"
                id="mobile-tab-pasien">Pasien</div>
            <div onclick="switchTab('akun', this); closeSettingsMenu();" class="settings-menu-item"
                id="mobile-tab-akun">Akun</div>
            <div onclick="switchTab('fraud', this); closeSettingsMenu();" class="settings-menu-item"
                id="mobile-tab-fraud">Fraud Detection</div>
            <div onclick="switchTab('warning', this); closeSettingsMenu();" class="settings-menu-item"
                id="mobile-tab-warning">Warning</div>
            <div onclick="switchTab('merge', this); closeSettingsMenu();" class="settings-menu-item"
                id="mobile-tab-merge">Merge Rekam Medis</div>
        </div>
    </div>

    <div class="flex flex-col h-screen ml-0 md:ml-[60px] transition-all duration-300 w-full">

        <header class="bg-white px-4 md:px-8 pt-3 md:pt-4 pb-2 z-30 flex-shrink-0 shadow-sm border-b border-gray-100">
            <div class="flex justify-between md:justify-end items-center gap-3 md:gap-6 mb-2">

                <button id="sidebarToggle" class="md:hidden text-gray-600 text-xl hover:bg-gray-100 p-1 rounded">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="flex items-center gap-2 md:gap-3 ml-auto md:ml-0">
                    <div
                        class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gray-500 flex items-center justify-center text-white text-[9px] md:text-[10px] font-bold border-2 border-white shadow-sm">
                        HDS
                    </div>
                    <button
                        class="bg-[#2196f3] hover:bg-[#1e88e5] text-white px-2 md:px-4 py-1 md:py-1.5 rounded text-[11px] md:text-[13px] font-medium flex items-center gap-1 md:gap-2 shadow-sm transition">
                        <span class="hidden sm:inline">hanglekiu dent...</span>
                        <span class="sm:hidden">HDS</span>
                        <i class="fas fa-chevron-down text-[9px] md:text-[10px]"></i>
                    </button>
                </div>
                <div class="flex items-center gap-3 md:gap-5 text-gray-400">
                    <i
                        class="fas fa-question-circle cursor-pointer hover:text-blue-600 text-base md:text-lg transition"></i>
                    <i
                        class="fas fa-bell-slash cursor-pointer hover:text-blue-600 text-base md:text-lg transition hidden sm:block"></i>
                    <i class="fas fa-user-circle text-xl md:text-2xl cursor-pointer hover:text-blue-600 transition"></i>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-end pb-2">
                <div class="flex items-center justify-between w-full md:w-auto">
                    <div>
                        <h1 class="text-[20px] md:text-[28px] font-bold text-[#1565c0] leading-tight">Office</h1>
                        <p class="text-[#1976d2] text-[13px] md:text-[15px]">hanglekiu dental specialist</p>
                    </div>
                    <button onclick="toggleSettingsMenu()"
                        class="md:hidden flex items-center gap-2 bg-blue-50 text-[#1565c0] px-3 py-1.5 rounded border border-blue-100 text-xs font-bold ml-2">
                        <i class="fas fa-list-ul"></i> Menu Opsi
                    </button>
                </div>
            </div>
        </header>

        <main class="flex-1 flex overflow-hidden relative">

            <div class="shrink-0 overflow-y-auto hidden md:block bg-[#f5f9fc]"
                style="flex-grow: 0; max-width: 260px; flex-basis: 260px; padding: 24px 24px 0 24px;">
                <div
                    class="bg-white border border-gray-200 flex flex-col text-[14px] overflow-hidden rounded-sm shadow-sm">
                    <div onclick="switchTab('dashboard', this)" class="settings-menu-item active" id="tab-dashboard">
                        Dashboard Harian</div>
                    <div onclick="switchTab('keuangan', this)" class="settings-menu-item" id="tab-keuangan">Keuangan
                    </div>
                    <div onclick="switchTab('laporan', this)" class="settings-menu-item" id="tab-laporan">Laporan
                    </div>
                    <div onclick="switchTab('pasien', this)" class="settings-menu-item" id="tab-pasien">Pasien</div>
                    <div onclick="switchTab('akun', this)" class="settings-menu-item" id="tab-akun">Akun</div>
                    <div onclick="switchTab('fraud', this)" class="settings-menu-item" id="tab-fraud">Fraud Detection
                    </div>
                    <div onclick="switchTab('warning', this)" class="settings-menu-item" id="tab-warning">Warning
                    </div>
                    <div onclick="switchTab('merge', this)" class="settings-menu-item border-b-0" id="tab-merge">
                        Merge Rekam Medis</div>
                </div>
            </div>

            <div class="flex-1 p-3 md:p-6 overflow-hidden flex flex-col bg-[#f5f9fc]">

                <div id="content-dashboard" class="tab-content active overflow-y-auto">
                    <div class="flex flex-col md:flex-row justify-between items-start mb-6 gap-3">
                        <div>
                            <h2 class="text-[18px] md:text-[20px] font-bold text-[#1565c0] mb-1">Ringkasan Harian</h2>
                            <div class="flex items-center gap-2 text-gray-500 text-[11px] md:text-[13px]">
                                <i class="far fa-calendar-alt text-gray-400"></i>
                                <span>{{ \Carbon\Carbon::now()->format('d M Y') }}</span>
                            </div>
                        </div>
                        <button
                            class="bg-[#00a65a] hover:bg-green-700 text-white px-4 py-2 rounded shadow-sm text-[12px] font-bold flex items-center gap-2 transition">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="stat-card">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-gray-500 text-xs font-bold uppercase">Appointment</span>
                                <div class="w-8 h-8 rounded bg-blue-50 flex items-center justify-center text-blue-600">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </div>
                            <div class="text-2xl font-bold text-gray-800 mb-1">0</div>
                            <div class="text-gray-400 text-[11px] flex items-center gap-1">
                                <i class="fas fa-minus text-gray-300"></i> 0% dari kemarin
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-gray-500 text-xs font-bold uppercase">Total Omzet</span>
                                <div
                                    class="w-8 h-8 rounded bg-green-50 flex items-center justify-center text-green-600">
                                    <i class="fas fa-coins"></i>
                                </div>
                            </div>
                            <div class="text-2xl font-bold text-gray-800 mb-1">Rp 0</div>
                            <div class="text-gray-400 text-[11px] flex items-center gap-1">
                                <i class="fas fa-minus text-gray-300"></i> 0% dari kemarin
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-gray-500 text-xs font-bold uppercase">Pengeluaran</span>
                                <div
                                    class="w-8 h-8 rounded bg-orange-50 flex items-center justify-center text-orange-500">
                                    <i class="fas fa-receipt"></i>
                                </div>
                            </div>
                            <div class="text-2xl font-bold text-gray-800 mb-1">Rp 0</div>
                            <div class="text-gray-400 text-[11px] flex items-center gap-1">
                                <i class="fas fa-minus text-gray-300"></i> 0% dari kemarin
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-gray-500 text-xs font-bold uppercase">Saldo Harian</span>
                                <div
                                    class="w-8 h-8 rounded bg-purple-50 flex items-center justify-center text-purple-600">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                            <div class="text-2xl font-bold text-gray-800 mb-1">Rp 0</div>
                            <div class="text-gray-400 text-[11px] flex items-center gap-1">
                                <i class="fas fa-minus text-gray-300"></i> 0% dari kemarin
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-[16px] font-bold text-[#1565c0] mb-3">Detail Operasional</h3>
                        <div class="bg-white border border-gray-200 rounded-md shadow-sm overflow-hidden">
                            <div class="flex border-b border-gray-200 bg-gray-50">
                                <button
                                    class="px-6 py-3 text-sm font-bold text-white bg-[#1565c0] border-r border-blue-800 flex items-center gap-2">
                                    <i class="fas fa-users"></i> Kunjungan
                                </button>
                                <button
                                    class="px-6 py-3 text-sm font-medium text-gray-500 hover:bg-gray-100 border-r border-gray-200 flex items-center gap-2 transition">
                                    <i class="fas fa-tooth"></i> Prosedur
                                </button>
                                <button
                                    class="px-6 py-3 text-sm font-medium text-gray-500 hover:bg-gray-100 border-r border-gray-200 flex items-center gap-2 transition">
                                    <i class="fas fa-pills"></i> Resep
                                </button>
                            </div>
                            <div class="p-8 flex flex-col items-center justify-center min-h-[200px] text-center">
                                <div class="mb-3 opacity-30">
                                    <i class="fas fa-chart-bar text-4xl text-blue-400"></i>
                                    <i class="fas fa-chart-pie text-4xl text-green-400 -ml-2"></i>
                                </div>
                                <h4 class="text-gray-600 font-semibold">Belum ada data kunjungan</h4>
                                <p class="text-gray-400 text-xs mt-1">Data operasional hari ini akan muncul di sini.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-[16px] font-bold text-[#1565c0] mb-3">Breakdown Keuangan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white border border-gray-200 rounded-md shadow-sm">
                                <div
                                    class="px-4 py-3 border-b border-gray-100 bg-gray-50 flex items-center gap-2 font-bold text-gray-700 text-xs uppercase">
                                    <i class="fas fa-arrow-down text-green-500"></i> Uang Masuk
                                </div>
                                <div class="divide-y divide-gray-100">
                                    <div class="px-4 py-3 flex justify-between items-center text-sm">
                                        <span class="text-gray-500"><i
                                                class="fas fa-user-injured w-5 text-center text-gray-300"></i> Pasien
                                            Umum</span>
                                        <span class="font-bold text-gray-700">Rp 0</span>
                                    </div>
                                    <div class="px-4 py-3 flex justify-between items-center text-sm">
                                        <span class="text-gray-500"><i
                                                class="fas fa-capsules w-5 text-center text-gray-300"></i> Penjualan
                                            Obat</span>
                                        <span class="font-bold text-gray-700">Rp 0</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-md shadow-sm">
                                <div
                                    class="px-4 py-3 border-b border-gray-100 bg-gray-50 flex items-center gap-2 font-bold text-gray-700 text-xs uppercase">
                                    <i class="fas fa-arrow-up text-red-500"></i> Uang Keluar
                                </div>
                                <div class="divide-y divide-gray-100">
                                    <div class="px-4 py-3 flex justify-between items-center text-sm">
                                        <span class="text-gray-500"><i
                                                class="fas fa-boxes w-5 text-center text-gray-300"></i> Belanja
                                            Stok</span>
                                        <span class="font-bold text-gray-700">Rp 0</span>
                                    </div>
                                    <div class="px-4 py-3 flex justify-between items-center text-sm">
                                        <span class="text-gray-500"><i
                                                class="fas fa-bolt w-5 text-center text-gray-300"></i>
                                            Operasional</span>
                                        <span class="font-bold text-gray-700">Rp 0</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-md shadow-sm">
                                <div
                                    class="px-4 py-3 border-b border-gray-100 bg-gray-50 flex items-center gap-2 font-bold text-gray-700 text-xs uppercase">
                                    <i class="fas fa-balance-scale text-orange-500"></i> Hutang & Piutang
                                </div>
                                <div class="divide-y divide-gray-100">
                                    <div class="px-4 py-3 flex justify-between items-center text-sm">
                                        <span class="text-gray-500">Piutang Pasien</span>
                                        <span class="font-bold text-green-600">Rp 0</span>
                                    </div>
                                    <div class="px-4 py-3 flex justify-between items-center text-sm">
                                        <span class="text-gray-500">Hutang ke Supplier</span>
                                        <span class="font-bold text-red-600">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-6">
                        <div class="bg-green-50 border border-green-100 p-4 rounded-md text-center">
                            <div class="text-xs text-green-700 font-bold uppercase mb-1">Total Pemasukan</div>
                            <div class="text-xl font-bold text-green-700">Rp 0</div>
                        </div>
                        <div class="bg-red-50 border border-red-100 p-4 rounded-md text-center">
                            <div class="text-xs text-red-700 font-bold uppercase mb-1">Total Pengeluaran</div>
                            <div class="text-xl font-bold text-red-700">Rp 0</div>
                        </div>
                        <div class="bg-blue-50 border border-blue-100 p-4 rounded-md text-center">
                            <div class="text-xs text-blue-700 font-bold uppercase mb-1">Net Profit Hari Ini</div>
                            <div class="text-xl font-bold text-blue-700">Rp 0</div>
                        </div>
                    </div>
                </div>

                <div id="content-keuangan" class="tab-content overflow-y-auto">
                    <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center mb-6 gap-4">
                        <div class="flex flex-wrap gap-0">
                            <button
                                class="bg-[#2196f3] text-white px-4 py-2 text-sm font-medium shadow-sm hover:bg-blue-600">Ikhtisar</button>
                            <button
                                class="bg-gray-200 text-gray-600 px-4 py-2 text-sm font-medium hover:bg-gray-300 border-l border-gray-300">Pemasukan</button>
                            <button
                                class="bg-gray-200 text-gray-600 px-4 py-2 text-sm font-medium hover:bg-gray-300 border-l border-gray-300">Pengeluaran</button>
                            <button
                                class="bg-gray-200 text-gray-600 px-4 py-2 text-sm font-medium hover:bg-gray-300 border-l border-gray-300">Klaim</button>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center gap-2 w-full xl:w-auto">
                            <div
                                class="flex items-center gap-2 w-full sm:w-auto bg-white p-1 border border-gray-300 rounded">
                                <input type="text" value="01/12/2025"
                                    class="outline-none text-xs w-24 text-center text-gray-600" readonly>
                                <span class="text-gray-400">-</span>
                                <input type="text" value="22/12/2025"
                                    class="outline-none text-xs w-24 text-center text-gray-600" readonly>
                            </div>
                            <button
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-bold px-4 py-2 rounded uppercase tracking-wide w-full sm:w-auto">Filter</button>
                        </div>
                    </div>

                    <h3 class="border-b border-gray-800 pb-1 mb-4 font-bold text-gray-800 text-sm">Operasional</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <div class="finance-card">
                            <div class="finance-card-label">Pemasukan</div>
                            <div class="finance-card-value text-money-green">+ Rp7.700.000</div>
                        </div>
                        <div class="finance-card">
                            <div class="finance-card-label">Pengeluaran</div>
                            <div class="finance-card-value text-money-red">- Rp0</div>
                        </div>
                        <div class="finance-card">
                            <div class="finance-card-label">Piutang</div>
                            <div class="finance-card-value text-money-green">+ Rp0</div>
                        </div>
                        <div class="finance-card">
                            <div class="finance-card-label">Hutang</div>
                            <div class="finance-card-value text-money-red">- Rp0</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        <div class="finance-card">
                            <div class="finance-card-label">Margin</div>
                            <div class="finance-card-value text-money-green">+ Rp7.700.000</div>
                        </div>
                        <div class="finance-card">
                            <div class="finance-card-label">Margin Murni</div>
                            <div class="finance-card-value text-money-green">+ Rp7.700.000</div>
                        </div>
                        <div class="finance-card cursor-pointer hover:bg-gray-50 transition">
                            <div class="finance-card-label">Show More</div>
                            <div class="text-gray-400 text-xl"><i class="fas fa-arrow-right"></i></div>
                        </div>
                    </div>

                    <h3 class="border-b border-gray-800 pb-1 mb-4 font-bold text-gray-800 text-sm">Cover</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        <div class="finance-card">
                            <div class="finance-card-label">Langsung</div>
                            <div class="finance-card-value text-money-green">+ Rp7.700.000</div>
                        </div>
                    </div>

                    <h3 class="border-b border-gray-800 pb-1 mb-4 font-bold text-gray-800 text-sm">Total</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <div class="finance-card">
                            <div class="finance-card-label">Kas</div>
                            <div class="finance-card-value text-money-green">+ Rp207.500.000</div>
                        </div>
                        <div class="finance-card">
                            <div class="finance-card-label">Cover BPJS</div>
                            <div class="finance-card-value text-money-green">+ Rp0</div>
                        </div>
                        <div class="finance-card">
                            <div class="finance-card-label">Hutang</div>
                            <div class="finance-card-value text-money-red">- Rp0</div>
                        </div>
                        <div class="finance-card">
                            <div class="finance-card-label">Piutang</div>
                            <div class="finance-card-value text-money-green">+ Rp7.420.000</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="finance-card">
                            <div class="finance-card-label">Total Saldo</div>
                            <div class="finance-card-value text-money-green">+ Rp207.500.000</div>
                        </div>
                        <div class="finance-card">
                            <div class="finance-card-label">Total Balance</div>
                            <div class="finance-card-value text-money-green">+ Rp214.920.000</div>
                            <div class="text-[10px] text-gray-500 mt-1">Semua akun - hutang + piutang</div>
                        </div>
                    </div>
                </div>

                <div id="content-laporan" class="tab-content overflow-y-auto">
                    <div class="flex flex-wrap gap-0 mb-6">
                        <button
                            class="bg-[#2196f3] text-white px-5 py-2 text-sm font-medium shadow-sm hover:bg-blue-600">Operasional</button>
                        <button
                            class="bg-gray-200 text-gray-600 px-5 py-2 text-sm font-medium hover:bg-gray-300 border-l border-gray-300">Keuangan</button>
                        <button
                            class="bg-gray-200 text-gray-600 px-5 py-2 text-sm font-medium hover:bg-gray-300 border-l border-gray-300">BPJS</button>
                        <button
                            class="bg-gray-200 text-gray-600 px-5 py-2 text-sm font-medium hover:bg-gray-300 border-l border-gray-300">Grafik</button>
                    </div>

                    <div class="bg-white p-6 rounded-md shadow-sm border border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4">
                            <div>
                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Daftar Appointment Pasien</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Data semua pasien rawat jalan di klinik ini.</div>
                                </div>

                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Laporan Diagnosa Pasien</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Jumlah diagnosa dari semua pasien.</div>
                                </div>

                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Laporan Peresepan Obat</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Jumlah resep yang diberikan pada tiap pasien.</div>
                                </div>

                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Laporan Coret Tindakan</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Laporan tindakan yang dicoret</div>
                                </div>

                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Laporan Pasien Rujukan</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Laporan pasien yang dirujukkan ke klinik lain</div>
                                </div>

                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Laporan Kunjungan Sehat</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Laporan kunjungan sehat pasien</div>
                                </div>
                            </div>

                            <div>
                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Daftar Pasien</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Data semua pasien rawat jalan di klinik ini.</div>
                                </div>

                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Laporan Prosedur Pasien</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Jumlah tindakan yang dilakukan pada tiap pasien.</div>
                                </div>

                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Laporan Penjualan Obat</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Penjualan obat langsung dari apotek</div>
                                </div>

                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Laporan Kunjungan Pasien</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Laporan Kunjungan Pasien Baru dan Lama Setiap Bulan</div>
                                </div>

                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Laporan Pasien Dirujuk</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Laporan pasien yang dirujukkan ke klinik anda</div>
                                </div>

                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">Laporan Promotif Preventif</div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                    <div class="report-desc">Laporan promotif preventif pasien</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="content-pasien" class="tab-content overflow-y-auto">
                    <div class="flex flex-wrap gap-0 mb-6">
                        <button
                            class="bg-[#2196f3] text-white px-5 py-2 text-sm font-medium shadow-sm hover:bg-blue-600">Summary</button>
                        <button
                            class="bg-gray-200 text-gray-600 px-5 py-2 text-sm font-medium hover:bg-gray-300 border-l border-gray-300">Data
                            Pasien</button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white p-6 rounded shadow-sm text-center border border-gray-200">
                            <div class="text-gray-600 font-bold mb-2">Pasien Terdaftar</div>
                            <div class="text-xl text-gray-800">364 Pasien</div>
                        </div>
                        <div class="bg-white p-6 rounded shadow-sm text-center border border-gray-200">
                            <div class="text-gray-600 font-bold mb-2">Pasien Baru Bulan Ini</div>
                            <div class="text-xl text-gray-800">1 Pasien</div>
                        </div>
                        <div class="bg-white p-6 rounded shadow-sm text-center border border-gray-200">
                            <div class="text-gray-600 font-bold mb-2">Pasien Walk-in Hari Ini</div>
                            <div class="text-xl text-gray-800">0 Pasien</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-sm font-bold text-gray-700">Upcoming Birthdays</h4>
                        <hr class="mt-1 border-gray-300">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-8">
                        <div class="bg-white p-4 rounded border border-gray-200">
                            <h4 class="text-center text-gray-600 mb-4 font-medium">Agama</h4>
                            <div
                                class="relative h-48 border-l border-b border-gray-300 flex items-end justify-around px-4">
                                <div class="absolute left-[-25px] top-0 text-[10px] text-gray-400">360</div>
                                <div class="absolute left-[-25px] top-1/2 text-[10px] text-gray-400">180</div>
                                <div class="absolute left-[-25px] bottom-0 text-[10px] text-gray-400">0</div>

                                <div class="w-1/3 mx-2 flex flex-col items-center">
                                    <div class="w-full bg-red-200 h-1"></div>
                                    <span class="text-[10px] text-gray-500 mt-1">Islam</span>
                                </div>
                                <div class="w-1/3 mx-2 flex flex-col items-center">
                                    <div class="w-full bg-orange-200 h-40"></div>
                                    <span class="text-[10px] text-gray-500 mt-1">Tidak Tahu</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded border border-gray-200">
                            <h4 class="text-center text-gray-600 mb-4 font-medium">Golongan darah</h4>
                            <div
                                class="relative h-48 border-l border-b border-gray-300 flex items-end justify-center px-4">
                                <div class="absolute left-[-25px] top-0 text-[10px] text-gray-400">380</div>

                                <div class="w-3/4 flex flex-col items-center">
                                    <div class="w-full bg-red-300 h-40"></div>
                                    <span class="text-[10px] text-gray-500 mt-1">Tidak Tahu</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded border border-gray-200">
                            <h4 class="text-center text-gray-600 mb-4 font-medium">Pendidikan terakhir</h4>
                            <div
                                class="relative h-48 border-l border-b border-gray-300 flex items-end justify-center px-4">
                                <div class="absolute left-[-25px] top-0 text-[10px] text-gray-400">380</div>
                                <div class="w-3/4 flex flex-col items-center">
                                    <div class="w-full bg-red-300 h-40"></div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded border border-gray-200">
                            <h4 class="text-center text-gray-600 mb-4 font-medium">Pekerjaan</h4>
                            <div
                                class="relative h-48 border-l border-b border-gray-300 flex items-end justify-center px-4">
                                <div class="absolute left-[-25px] top-0 text-[10px] text-gray-400">380</div>
                                <div class="w-3/4 flex flex-col items-center">
                                    <div class="w-full bg-red-300 h-40"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="content-akun" class="tab-content overflow-y-auto">
                    <div class="flex justify-between items-center mb-6">
                        <button onclick="openModal('modalEditAkun')"
                            class="bg-[#e0e0e0] hover:bg-gray-300 text-gray-700 px-4 py-2 rounded text-sm font-bold shadow-sm uppercase transition">Edit
                            Akun</button>

                        <div class="flex items-center gap-2">
                            <div class="flex items-center gap-2 border-b border-gray-400 pb-1">
                                <input type="text" value="01/12/2025"
                                    class="outline-none text-sm w-24 text-center text-gray-600 bg-transparent"
                                    readonly>
                                <span class="text-gray-400">-</span>
                                <input type="text" value="31/12/2025"
                                    class="outline-none text-sm w-24 text-center text-gray-600 bg-transparent"
                                    readonly>
                            </div>
                            <button class="text-gray-500 hover:text-blue-600"><i class="fas fa-sync-alt"></i></button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-white p-6 rounded border border-gray-200 shadow-sm text-center">
                            <h3 class="text-green-400 font-bold text-lg mb-2">Kas</h3>
                            <div class="text-green-600 text-2xl font-bold mb-2">Rp207.500.000</div>
                            <div class="text-xs">
                                <span class="text-green-600 font-bold">+Rp7.700.000</span>
                                <span class="text-gray-400 mx-1">/</span>
                                <span class="text-red-500 font-bold">-Rp0</span>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded border border-gray-200 shadow-sm text-center">
                            <h3 class="text-blue-400 font-bold text-lg mb-2">Cover BPJS</h3>
                            <div class="text-red-500 text-2xl font-bold mb-2">Rp0</div>
                            <div class="text-xs">
                                <span class="text-green-600 font-bold">+Rp0</span>
                                <span class="text-gray-400 mx-1">/</span>
                                <span class="text-red-500 font-bold">-Rp0</span>
                            </div>
                        </div>
                    </div>

                    <div class="w-full bg-[#a5b4fc] h-64 rounded-sm border border-gray-300 relative">
                        <div
                            class="absolute bottom-0 left-0 right-0 flex justify-between px-4 pb-1 text-[10px] text-gray-600 bg-white bg-opacity-50">
                            <span>January 25</span>
                            <span>February 25</span>
                            <span>March 25</span>
                            <span>April 25</span>
                            <span>May 25</span>
                            <span>June 25</span>
                            <span>July 25</span>
                            <span>August 25</span>
                            <span>September 25</span>
                            <span>October 25</span>
                            <span>November 25</span>
                            <span>December 25</span>
                        </div>
                        <div
                            class="absolute top-0 left-0 bottom-0 flex flex-col justify-between py-4 pl-1 text-[10px] text-gray-600 bg-white bg-opacity-50 h-full">
                            <span>100%</span>
                            <span>75%</span>
                            <span>50%</span>
                            <span>25%</span>
                            <span>0%</span>
                        </div>
                        <div class="absolute bottom-6 left-10 w-4 h-20 bg-purple-600 opacity-70"></div>
                        <div class="absolute bottom-6 left-24 w-4 h-32 bg-purple-600 opacity-70"></div>
                        <div class="absolute bottom-6 left-40 w-4 h-10 bg-purple-600 opacity-70"></div>
                    </div>
                </div>

                <div id="content-fraud" class="tab-content overflow-y-auto">
                    <div class="flex overflow-x-auto border-b border-gray-300 mb-4 bg-gray-100">
                        <div class="fraud-tab active">Obat dan Tindakan Coret</div>
                        <div class="fraud-tab">Non BPJS Pembayaran Rp. 0</div>
                        <div class="fraud-tab">Void Transaksi</div>
                        <div class="fraud-tab">Cancel Appointment</div>
                        <div class="fraud-tab">Merge Rekam Medis</div>
                        <div class="fraud-tab">Overbudget Kapitasi BPJS</div>
                        <div class="fraud-tab">Audit Trail Rekam Medis</div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-between items-end mb-4 gap-4">
                        <div class="flex items-end gap-2">
                            <div>
                                <label class="block text-[10px] text-gray-500 font-bold mb-1">Dari Tanggal</label>
                                <input type="text" value="01/12/2025"
                                    class="border-b border-black py-1 text-sm w-32 focus:outline-none bg-transparent">
                            </div>
                            <div>
                                <label class="block text-[10px] text-gray-500 font-bold mb-1">Sampai Tanggal</label>
                                <input type="text" value="31/12/2025"
                                    class="border-b border-black py-1 text-sm w-32 focus:outline-none bg-transparent">
                            </div>
                            <button
                                class="bg-[#2196f3] text-white px-3 py-1.5 rounded text-xs font-bold uppercase hover:bg-blue-600 ml-2 shadow-sm">Filter</button>
                        </div>

                        <div class="flex gap-2">
                            <button
                                class="border border-blue-400 text-blue-500 px-4 py-1.5 rounded text-xs hover:bg-blue-50 font-medium">Export</button>
                            <button
                                class="border border-blue-400 text-blue-500 px-3 py-1.5 rounded text-xs hover:bg-blue-50"><i
                                    class="fas fa-print"></i></button>
                        </div>
                    </div>

                    <div class="bg-white border-t border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 w-1/6">Tanggal
                                            Didaftarkan</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 w-1/6">Tanggal
                                            Appointment</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 w-1/6">Pasien</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 w-1/6">Obat</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500">Prosedur</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr class="align-top hover:bg-gray-50 transition">
                                        <td class="py-4 px-4 text-xs text-gray-600">06-12-2025 (09:01)</td>
                                        <td class="py-4 px-4 text-xs text-gray-600">01-12-2025</td>
                                        <td class="py-4 px-4 text-xs text-gray-800 font-bold">Shiori sasaki</td>
                                        <td class="py-4 px-4 text-xs text-gray-600">Tanpa Resep</td>
                                        <td class="py-4 px-4 text-xs text-gray-600">
                                            <div class="mb-4">
                                                <div class="font-bold text-gray-700 decoration-red-500 line-through">
                                                    kontrol Ortho damon Ria Medianto</div>
                                                <div class="text-xs">Harga prosedur Rp. 500.000</div>
                                                <div class="text-xs">Diskon prosedure Rp. 0</div>
                                                <div class="text-xs">Total Harga Rp. 500.000</div>
                                                <div class="text-gray-500 mt-1 italic text-[10px]">Dicatat oleh Sonia
                                                    Novitasari jam 06-12-2025 (09:03)</div>
                                                <div class="text-red-500 font-bold text-[10px] mt-1">Dicoret oleh Sonia
                                                    Novitasari jam 06-12-2025 (09:14)</div>
                                            </div>

                                            <div class="pt-2 border-t border-dashed border-gray-300">
                                                <div class="font-bold text-gray-700">Kontrol Ortho Self Ligating</div>
                                                <div class="text-xs">Harga prosedur Rp. 500.000</div>
                                                <div class="text-xs">Diskon prosedure Rp. 0</div>
                                                <div class="text-xs">Total Harga Rp. 500.000</div>
                                                <div class="text-gray-500 mt-1 italic text-[10px]">Dicatat oleh Sonia
                                                    Novitasari jam 06-12-2025 (09:05)</div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-4 flex justify-end items-center gap-4 text-xs text-gray-500">
                            <span>Jumlah baris perhalaman: 6 <i class="fas fa-caret-down ml-1"></i></span>
                            <span>1-1 of 1</span>
                            <div class="flex gap-4">
                                <button class="hover:text-gray-800 disabled:text-gray-300"><i
                                        class="fas fa-chevron-left"></i></button>
                                <button class="hover:text-gray-800 disabled:text-gray-300"><i
                                        class="fas fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="content-warning" class="tab-content overflow-y-auto">
                    <div class="flex items-center mb-4">
                        <button class="bg-[#2196f3] text-white px-5 py-2.5 text-sm font-bold shadow-sm">Pembayaran
                            Restock Obat</button>
                        <button
                            class="bg-[#e0e0e0] text-gray-600 px-5 py-2.5 text-sm font-bold hover:bg-gray-300 transition">SIP
                            dan STR Tenaga Medis</button>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-sm shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500">Kode</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500">Supplier</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500">Detail Item</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 text-center">Jumlah</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 text-right">Total Harga
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr>
                                        <td colspan="5" class="p-6 text-sm text-gray-700">Belum ada data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div
                            class="p-4 border-t border-gray-200 flex justify-end items-center gap-6 text-xs text-gray-500">
                            <div class="flex items-center gap-1">
                                <span>Jumlah baris perhalaman:</span>
                                <span class="font-bold">6</span>
                                <i class="fas fa-caret-down"></i>
                            </div>
                            <span>0-0 dari 0 data</span>
                            <div class="flex gap-4 text-gray-400">
                                <i class="fas fa-step-backward cursor-not-allowed"></i>
                                <i class="fas fa-chevron-left cursor-not-allowed"></i>
                                <i class="fas fa-chevron-right cursor-not-allowed"></i>
                                <i class="fas fa-step-forward cursor-not-allowed"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="content-merge" class="tab-content overflow-y-auto">
                    <div class="mb-4 border-b border-gray-200 pb-2">
                        <h2 class="text-lg font-bold text-gray-800">Merge Rekam Medis</h2>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 text-xs p-3 rounded mb-6">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Data yang di-merge tidak dapat dikembalikan.
                        Data pasien sebelah kanan akan dihapus dan riwayatnya dipindahkan ke pasien sebelah kiri.
                    </div>

                    <div class="flex flex-col lg:flex-row gap-6 items-start justify-center">

                        <div class="flex-1 w-full bg-white border border-gray-300 rounded-md shadow-sm p-4 relative">
                            <div class="absolute top-0 left-0 w-full h-1 bg-green-500 rounded-t-md"></div>
                            <h3 class="font-bold text-gray-700 mb-3 text-sm">Rekam Medis TUJUAN (Disimpan)</h3>

                            <div class="relative mb-4">
                                <input type="text"
                                    class="w-full border border-gray-300 rounded text-sm py-2 pl-3 pr-8 focus:outline-none focus:border-blue-500"
                                    placeholder="Cari Pasien Tujuan...">
                                <i class="fas fa-search absolute right-3 top-2.5 text-gray-400"></i>
                            </div>

                            <div class="border border-green-200 bg-green-50 rounded p-3">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-green-200 flex items-center justify-center text-green-700 font-bold">
                                        AS</div>
                                    <div class="flex-1">
                                        <div class="font-bold text-gray-800">Andi Saputra</div>
                                        <div class="text-xs text-gray-500">RM-00123</div>

                                        <div class="mt-2 text-xs space-y-1">
                                            <div class="flex justify-between"><span class="text-gray-500">NIK:</span>
                                                <span>3372011208900001</span>
                                            </div>
                                            <div class="flex justify-between"><span class="text-gray-500">Tgl
                                                    Lahir:</span> <span>12-08-1990</span></div>
                                            <div class="flex justify-between"><span class="text-gray-500">No.
                                                    HP:</span>
                                                <span>0812-3456-7890</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="self-center text-gray-400 text-2xl">
                            <i class="fas fa-arrow-right hidden lg:block"></i>
                            <i class="fas fa-arrow-down block lg:hidden"></i>
                        </div>

                        <div class="flex-1 w-full bg-white border border-gray-300 rounded-md shadow-sm p-4 relative">
                            <div class="absolute top-0 left-0 w-full h-1 bg-red-500 rounded-t-md"></div>
                            <h3 class="font-bold text-gray-700 mb-3 text-sm">Rekam Medis SUMBER (Dihapus)</h3>

                            <div class="relative mb-4">
                                <input type="text"
                                    class="w-full border border-gray-300 rounded text-sm py-2 pl-3 pr-8 focus:outline-none focus:border-blue-500"
                                    placeholder="Cari Pasien Sumber...">
                                <i class="fas fa-search absolute right-3 top-2.5 text-gray-400"></i>
                            </div>

                            <div class="border border-red-200 bg-red-50 rounded p-3">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-red-200 flex items-center justify-center text-red-700 font-bold">
                                        AS</div>
                                    <div class="flex-1">
                                        <div class="font-bold text-gray-800">Andi S.</div>
                                        <div class="text-xs text-gray-500">RM-00199</div>

                                        <div class="mt-2 text-xs space-y-1">
                                            <div class="flex justify-between"><span class="text-gray-500">NIK:</span>
                                                <span class="text-red-500 italic">Belum ada</span>
                                            </div>
                                            <div class="flex justify-between"><span class="text-gray-500">Tgl
                                                    Lahir:</span> <span>12-08-1990</span></div>
                                            <div class="flex justify-between"><span class="text-gray-500">No.
                                                    HP:</span>
                                                <span>-</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end gap-3 border-t border-gray-200 pt-4">
                        <button
                            class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-bold rounded hover:bg-gray-300">Batal</button>
                        <button
                            class="px-4 py-2 bg-[#1565c0] text-white text-sm font-bold rounded hover:bg-blue-700">Gabungkan</button>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        // --- LOGIC SIDEBAR UTAMA MOBILE (Main Sidebar) ---
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mainSidebar = document.getElementById('appSidebar'); // Sesuaikan dengan ID di partials.sidebar
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');

        if (sidebarToggle && mainSidebar && sidebarBackdrop) {
            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                // Toggle sidebar
                mainSidebar.classList.toggle('open');
                sidebarBackdrop.classList.toggle('active');
            });

            // Tutup sidebar jika backdrop diklik
            sidebarBackdrop.addEventListener('click', function() {
                mainSidebar.classList.remove('open');
                sidebarBackdrop.classList.remove('active');
            });

            // Tutup sidebar dengan tombol Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && mainSidebar.classList.contains('open')) {
                    mainSidebar.classList.remove('open');
                    sidebarBackdrop.classList.remove('active');
                }
            });
        }

        // --- LOGIC TAB MENU MOBILE (Settings Menu - Menu Opsi) ---
        function toggleSettingsMenu() {
            const menu = document.getElementById('settingsMenu');
            const overlay = document.getElementById('settingsOverlay');
            if (menu.classList.contains('active')) {
                closeSettingsMenu();
            } else {
                menu.classList.add('active');
                overlay.classList.add('active');
            }
        }

        function closeSettingsMenu() {
            document.getElementById('settingsMenu').classList.remove('active');
            document.getElementById('settingsOverlay').classList.remove('active');
        }

        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = "none";
            }
        }

        function switchTab(tabId, element) {
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => {
                content.classList.remove('active');
            });

            const menuItems = document.querySelectorAll('.settings-menu-item');
            menuItems.forEach(item => {
                item.classList.remove('active');
            });

            const targetContent = document.getElementById('content-' + tabId);
            if (targetContent) {
                targetContent.classList.add('active');
            }

            if (element) {
                const allTabs = document.querySelectorAll('[id^="tab-"], [id^="mobile-tab-"]');
                allTabs.forEach(t => t.classList.remove('active'));

                element.classList.add('active');
                const baseId = tabId;
                const desktopTab = document.getElementById('tab-' + baseId);
                const mobileTab = document.getElementById('mobile-tab-' + baseId);

                if (desktopTab) desktopTab.classList.add('active');
                if (mobileTab) mobileTab.classList.add('active');
            }
        }
    </script>
</body>

</html>
