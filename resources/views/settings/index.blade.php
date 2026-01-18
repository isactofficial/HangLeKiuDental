<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Hanglekiu Dental Specialist</title>
    <script>
        tailwind = {
            config: {
                theme: {
                    extend: {
                        zIndex: {
                            '400': '400'
                        }
                    }
                }
            }
        }
    </script>
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

        /* Styling khusus Tab Menu Kiri (Settings Menu) */
        .settings-menu-box {
            background: #fff;
            border-radius: 8px;
            padding: 0;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .settings-menu-item {
            display: block;
            padding: 16px 18px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            outline: none;
            text-align: left;
            width: 100%;
            background: #fff;
            color: #222;
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.2s;
            position: relative;
            text-decoration: none;
            user-select: none;
        }

        .settings-menu-item.default:hover {
            background: #f5f5f5;
        }

        .settings-menu-item.active {
            background: #B08D70;
            color: #fff;
        }

        .settings-menu-item:last-child {
            border-bottom: none;
        }

        /* Table Styles */
        .settings-table th {
            background-color: #e3f2fd;
            color: #475569;
            font-weight: 600;
            font-size: 13px;
            padding: 12px 16px;
            text-align: left;
        }

        .settings-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .tab-content {
            display: none !important;
            height: 100%;
            flex-direction: column;
        }

        .tab-content.active {
            display: flex !important;
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
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .settings-mobile-menu.active {
            left: 0;
        }

        /* Overlay Khusus Settings Menu */
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

        /* 2. Responsive Table */
        @media (max-width: 768px) {
            .settings-table thead {
                display: none;
            }

            .settings-table tbody tr {
                display: block;
                margin-bottom: 16px;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                overflow: hidden;
            }

            .settings-table tbody td {
                display: flex;
                justify-content: space-between;
                padding: 10px 16px;
                border-bottom: 1px solid #f3f4f6;
            }

            .settings-table tbody td:last-child {
                border-bottom: none;
            }

            .settings-table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #475569;
                min-width: 100px;
            }

            .settings-table tbody td:last-child:before {
                content: '';
                min-width: 0;
            }
        }
    </style>
</head>

<body class="bg-[#f5f9fc] text-gray-700">

    <div id="sidebarBackdrop" class="sidebar-backdrop"></div>

    @include('partials.sidebar')

    <div class="settings-overlay" id="settingsOverlay" onclick="closeSettingsMenu()"></div>

    <div class="settings-mobile-menu" id="settingsMenu">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-blue-50">
            <h2 class="font-bold text-lg text-[#1565c0]">Menu Opsi</h2>
            <button onclick="closeSettingsMenu()" class="text-gray-500 text-2xl hover:text-red-500">&times;</button>
        </div>
        <div class="flex flex-col text-[14px] settings-menu-box" style="margin:12px;">
            <div onclick="switchTab('general-settings', this); closeSettingsMenu();" class="settings-menu-item default" id="mobile-tab-general-settings">
                General Settings
            </div>
            <div onclick="switchTab('manajemen-staff', this); closeSettingsMenu();" class="settings-menu-item active" id="mobile-tab-manajemen-staff">
                Manajemen Staff
            </div>
            <div onclick="switchTab('hak-akses', this); closeSettingsMenu();" class="settings-menu-item default" id="mobile-tab-hak-akses">
                Hak Akses
            </div>
            <div onclick="switchTab('info-medis', this); closeSettingsMenu();" class="settings-menu-item default" id="mobile-tab-info-medis">
                Info Tenaga Medis
            </div>
            <div onclick="switchTab('katalog-harga-prosedur', this); closeSettingsMenu();" class="settings-menu-item default" id="mobile-tab-katalog-harga-prosedur">
                Katalog Harga Prosedur
            </div>
            <div onclick="switchTab('printing-template', this); closeSettingsMenu();" class="settings-menu-item default" id="mobile-tab-printing-template">
                Printing Template
            </div>
            <div onclick="switchTab('billing', this); closeSettingsMenu();" class="settings-menu-item default flex justify-between items-center" id="mobile-tab-billing">
                Billing
                <span class="bg-[#f50057] text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full">!</span>
            </div>
            <div onclick="switchTab('surat-menyurat', this); closeSettingsMenu();" class="settings-menu-item default" id="mobile-tab-surat-menyurat">
                Surat Menyurat
            </div>
            <div onclick="switchTab('data-entry', this); closeSettingsMenu();" class="settings-menu-item default" id="mobile-tab-data-entry">
                Data Entry
            </div>
        </div>
    </div>

    <div class="flex flex-col h-screen ml-0 md:ml-[60px] transition-all duration-300">

        <header class="bg-white px-4 md:px-8 pt-3 md:pt-4 pb-2 z-30 shrink-0 shadow-sm border-b border-gray-100">
            <div class="flex justify-between md:justify-end items-center gap-3 md:gap-6 mb-2">

                <button id="sidebarToggle" class="md:hidden text-gray-600 text-xl hover:bg-gray-100 p-1 rounded">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="flex items-center gap-2 md:gap-3 ml-auto md:ml-0">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gray-500 flex items-center justify-center text-white text-[9px] md:text-[10px] font-bold border-2 border-white shadow-sm">
                        HDS
                    </div>
                    <button class="bg-[#2196f3] hover:bg-[#1e88e5] text-white px-2 md:px-4 py-1 md:py-1.5 rounded text-[11px] md:text-[13px] font-medium flex items-center gap-1 md:gap-2 shadow-sm transition">
                        <span class="hidden sm:inline">hanglekiu dent...</span>
                        <span class="sm:hidden">HDS</span>
                        <i class="fas fa-chevron-down text-[9px] md:text-[10px]"></i>
                    </button>
                </div>
                <div class="flex items-center gap-3 md:gap-5 text-gray-400">
                    <i class="fas fa-question-circle cursor-pointer hover:text-blue-600 text-base md:text-lg transition"></i>
                    <i class="fas fa-bell-slash cursor-pointer hover:text-blue-600 text-base md:text-lg transition hidden sm:block"></i>
                    <i class="fas fa-user-circle text-xl md:text-2xl cursor-pointer hover:text-blue-600 transition"></i>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-end pb-2">
                <div class="flex items-center justify-between w-full md:w-auto">
                    <div>
                        <h1 class="text-[20px] md:text-[28px] font-bold text-[#1565c0] leading-tight">Settings</h1>
                        <p class="text-[#1976d2] text-[13px] md:text-[15px]">hanglekiu dental specialist</p>
                    </div>

                    <button onclick="toggleSettingsMenu()" class="md:hidden flex items-center gap-2 bg-blue-50 text-[#1565c0] px-3 py-1.5 rounded border border-blue-100 text-xs font-bold ml-2">
                        <i class="fas fa-list-ul"></i> Menu Opsi
                    </button>
                </div>

                <div class="hidden md:flex items-center gap-3 mt-3 md:mt-0">
                    <button class="w-8 h-8 md:w-9 md:h-9 rounded border border-blue-300 text-blue-500 flex items-center justify-center hover:bg-blue-50 transition bg-white">
                        <i class="fas fa-sync-alt text-sm"></i>
                    </button>
                </div>
            </div>
        </header>

        <main class="flex-1 flex overflow-hidden relative">

            <div class="shrink-0 overflow-y-auto hidden md:block bg-[#f5f9fc]" style="flex-grow: 0; max-width: 260px; flex-basis: 260px; padding: 24px 24px 0 24px;">
                <div class="flex flex-col text-[14px] settings-menu-box">
                    <div onclick="switchTab('general-settings', this)" class="settings-menu-item default" id="tab-general-settings">
                        General Settings
                    </div>
                    <div onclick="switchTab('manajemen-staff', this)" class="settings-menu-item active" id="tab-manajemen-staff">
                        Manajemen Staff
                    </div>
                    <div onclick="switchTab('hak-akses', this)" class="settings-menu-item default" id="tab-hak-akses">
                        Hak Akses
                    </div>
                    <div onclick="switchTab('info-medis', this)" class="settings-menu-item default" id="tab-info-medis">
                        Info Tenaga Medis
                    </div>
                    <div onclick="switchTab('katalog-harga-prosedur', this)" class="settings-menu-item default" id="tab-katalog-harga-prosedur">
                        Katalog Harga Prosedur
                    </div>
                    <div onclick="switchTab('printing-template', this)" class="settings-menu-item default" id="tab-printing-template">
                        Printing Template
                    </div>
                    <div onclick="switchTab('billing', this)" class="settings-menu-item default flex justify-between items-center" id="tab-billing">
                        Billing
                        <span class="bg-[#f50057] text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full">!</span>
                    </div>
                    <div onclick="switchTab('surat-menyurat', this)" class="settings-menu-item default" id="tab-surat-menyurat">
                        Surat Menyurat
                    </div>
                    <div onclick="switchTab('data-entry', this)" class="settings-menu-item default" id="tab-data-entry">
                        Data Entry
                    </div>
                </div>
            </div>

            <div class="flex-1 p-3 md:p-6 overflow-hidden flex flex-col bg-[#f5f9fc]">

                <div id="content-general-settings" class="tab-content bg-white border border-gray-200 rounded-md shadow-sm flex flex-col h-full overflow-hidden">
                    <div class="p-4 md:p-6">
                        <h2 class="text-[18px] md:text-[20px] font-bold text-[#1565c0] mb-1">General Settings</h2>
                        <p class="text-gray-500 text-[12px] md:text-[13px]">Halaman ini masih dalam pengembangan.</p>
                    </div>
                </div>

                <div id="content-hak-akses" class="tab-content bg-white border border-gray-200 rounded-md shadow-sm flex flex-col h-full overflow-hidden">
                    <div class="p-4 md:p-6">
                        <h2 class="text-[18px] md:text-[20px] font-bold text-[#1565c0] mb-1">Hak Akses</h2>
                        <p class="text-gray-500 text-[12px] md:text-[13px]">Halaman ini masih dalam pengembangan.</p>
                    </div>
                </div>

                <div id="content-katalog-harga-prosedur" class="tab-content bg-white border border-gray-200 rounded-md shadow-sm flex flex-col h-full overflow-hidden">
                    <div class="p-4 md:p-6">
                        <h2 class="text-[18px] md:text-[20px] font-bold text-[#1565c0] mb-1">Katalog Harga Prosedur</h2>
                        <p class="text-gray-500 text-[12px] md:text-[13px]">Halaman ini masih dalam pengembangan.</p>
                    </div>
                </div>

                <div id="content-printing-template" class="tab-content bg-white border border-gray-200 rounded-md shadow-sm flex flex-col h-full overflow-hidden">
                    <div class="p-4 md:p-6">
                        <h2 class="text-[18px] md:text-[20px] font-bold text-[#1565c0] mb-1">Printing Template</h2>
                        <p class="text-gray-500 text-[12px] md:text-[13px]">Halaman ini masih dalam pengembangan.</p>
                    </div>
                </div>

                <div id="content-billing" class="tab-content bg-white border border-gray-200 rounded-md shadow-sm flex flex-col h-full overflow-hidden">
                    <div class="p-4 md:p-6">
                        <h2 class="text-[18px] md:text-[20px] font-bold text-[#1565c0] mb-1">Billing</h2>
                        <p class="text-gray-500 text-[12px] md:text-[13px]">Halaman ini masih dalam pengembangan.</p>
                    </div>
                </div>

                <div id="content-surat-menyurat" class="tab-content bg-white border border-gray-200 rounded-md shadow-sm flex flex-col h-full overflow-hidden">
                    <div class="p-4 md:p-6">
                        <h2 class="text-[18px] md:text-[20px] font-bold text-[#1565c0] mb-1">Surat Menyurat</h2>
                        <p class="text-gray-500 text-[12px] md:text-[13px]">Halaman ini masih dalam pengembangan.</p>
                    </div>
                </div>

                <div id="content-data-entry" class="tab-content bg-white border border-gray-200 rounded-md shadow-sm flex flex-col h-full overflow-hidden">
                    <div class="p-4 md:p-6">
                        <h2 class="text-[18px] md:text-[20px] font-bold text-[#1565c0] mb-1">Data Entry</h2>
                        <p class="text-gray-500 text-[12px] md:text-[13px]">Halaman ini masih dalam pengembangan.</p>
                    </div>
                </div>

                <div id="content-manajemen-staff" class="tab-content active bg-white border border-gray-200 rounded-md shadow-sm flex flex-col h-full overflow-hidden">

                    <div class="p-4 md:p-6 pb-0">
                        <div class="flex flex-col md:flex-row justify-between items-start mb-4 md:mb-6 gap-3">
                            <div>
                                <h2 class="text-[18px] md:text-[20px] font-bold text-[#1565c0] mb-1">Manajemen Staff</h2>
                                <div class="flex items-center gap-2 text-gray-500 text-[11px] md:text-[13px]">
                                    <i class="far fa-clock text-gray-400"></i>
                                    <span>Last Update: 17 Des 2024 (13:50)</span>
                                </div>
                            </div>
                            <div class="flex gap-2 w-full md:w-auto">
                                <button class="flex-1 md:flex-none bg-[#1565c0] hover:bg-[#0d47a1] text-white px-3 md:px-4 py-2 rounded shadow-sm text-[12px] md:text-[13px] font-medium flex items-center justify-center gap-2 transition">
                                    <i class="fas fa-plus text-[10px]"></i> <span class="hidden sm:inline">Tambah Staff</span><span class="sm:hidden">Tambah</span>
                                </button>
                                <button class="w-9 h-9 border border-gray-300 bg-white rounded flex items-center justify-center text-gray-500 hover:bg-gray-50 transition">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4 md:mb-6">
                            <label class="block text-[12px] md:text-[13px] font-bold text-gray-700 mb-2">Urutkan berdasarkan</label>
                            <div class="flex flex-col sm:flex-row gap-2 md:gap-3">
                                <div class="w-full sm:w-[220px] relative">
                                    <select class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] md:text-[14px] text-gray-700 appearance-none focus:outline-none focus:border-blue-500 bg-white h-[38px] md:h-10">
                                        <option>Nama</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-3 top-3 md:top-3.5 text-gray-400 text-xs pointer-events-none"></i>
                                </div>

                                <button class="border border-gray-300 rounded px-4 py-2 text-[13px] md:text-[14px] text-gray-600 flex items-center justify-center gap-2 bg-white hover:bg-gray-50 h-[38px] md:h-10">
                                    <i class="fas fa-filter text-gray-400"></i> Filter
                                </button>

                                <div class="flex-1 relative">
                                    <i class="fas fa-search absolute left-3 top-3 md:top-3.5 text-gray-400"></i>
                                    <input type="text" placeholder="Cari staff" class="w-full border border-gray-300 rounded pl-10 pr-4 py-2 text-[13px] md:text-[14px] focus:outline-none focus:border-blue-500 h-[38px] md:h-10">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 overflow-auto px-4 md:px-0">
                        <table class="w-full text-left border-collapse settings-table">
                            <thead class="sticky top-0 z-10">
                                <tr>
                                    <th class="bg-[#e3f2fd]">Nama</th>
                                    <th class="bg-[#e3f2fd]">Status</th>
                                    <th class="bg-[#e3f2fd]">Tipe Akses</th>
                                    <th class="bg-[#e3f2fd]">Nomor HP</th>
                                    <th class="bg-[#e3f2fd]">Login Email</th>
                                    <th class="text-right w-24 bg-[#e3f2fd]"></th>
                                </tr>
                            </thead>
                            <tbody class="text-[13px] text-gray-700">
                                @forelse($staffMembers as $staff)
                                    <tr class="hover:bg-gray-50 border-b border-gray-100 last:border-0 transition">
                                        <td data-label="Nama" class="font-medium text-gray-800">{{ $staff['name'] }}</td>
                                        <td data-label="Status">
                                            @if ($staff['status'] === 'Aktif')
                                                <span
                                                    class="bg-[#b9f6ca] text-[#1b5e20] px-3 py-1 rounded-full text-[11px] font-bold inline-block text-center min-w-[60px]">
                                                    Aktif
                                                </span>
                                            @else
                                                <span
                                                    class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-[11px] font-bold inline-block text-center min-w-[60px]">
                                                    Non-Aktif
                                                </span>
                                            @endif
                                        </td>
                                        <td data-label="Tipe Akses" class="text-gray-600">{{ $staff['role'] }}</td>
                                        <td data-label="Nomor HP" class="text-gray-500 font-mono tracking-wide">{{ $staff['phone'] }}</td>
                                        <td data-label="Login Email" class="text-gray-500 font-mono">{{ $staff['email'] }}</td>
                                        <td class="text-right">
                                            <div class="flex justify-end items-center gap-4 text-gray-400">
                                                <button title="Edit" class="hover:text-blue-600 transition">
                                                    <i class="fas fa-pen-square text-[18px]"></i>
                                                </button>
                                                <button title="More" class="hover:text-blue-600 transition px-2">
                                                    <i class="fas fa-ellipsis-v text-[14px]"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-8 text-gray-400">
                                            Data staff tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div
                        class="px-5 py-3 border-t border-gray-200 flex items-center justify-end gap-6 text-[12px] text-gray-600 bg-white">
                        <div class="flex items-center gap-2">
                            <span>Jumlah baris per halaman:</span>
                            <div class="flex items-center gap-1 cursor-pointer">
                                <span class="font-medium">5</span>
                                <i class="fas fa-sort-down mb-1 text-gray-500"></i>
                            </div>
                        </div>
                        <div>1-4 dari 4 data</div>
                        <div class="flex items-center gap-4">
                            <i class="fas fa-chevron-left text-gray-300 cursor-not-allowed text-xs"></i>
                            <i class="fas fa-chevron-right text-gray-300 cursor-not-allowed text-xs"></i>
                        </div>
                    </div>
                </div>
                <div id="content-info-medis" class="tab-content overflow-y-auto pr-0 md:pr-2 relative">

                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 md:mb-6 gap-3 md:gap-4">
                        <div class="flex w-full md:w-auto gap-3 md:gap-4 flex-1 items-center">
                            <div class="relative flex-1 md:w-full md:max-w-[450px]">
                                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                                <input type="text" placeholder="Search Name, STR or SIP" class="w-full bg-white border border-gray-300 rounded-[3px] py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-blue-500 shadow-sm h-[38px]">
                            </div>
                            <button class="flex items-center gap-2 font-bold text-gray-700 text-[12px] md:text-[13px] hover:text-blue-600 uppercase">
                                <i class="fas fa-filter"></i> <span class="hidden sm:inline">Filter</span>
                            </button>
                        </div>
                        <button class="w-full md:w-auto bg-[#ff9800] hover:bg-[#f57c00] text-white font-bold text-[12px] md:text-[13px] px-4 md:px-6 py-2.5 rounded shadow-sm transition uppercase">
                            + <span class="hidden sm:inline">Tambah Data Tenaga Medis</span><span class="sm:inline md:hidden">Tambah</span>
                        </button>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-md shadow-sm p-4 md:p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                            <div class="bg-white p-3 md:p-4 rounded shadow-sm flex gap-3 md:gap-4 items-start">
                                <div class="flex flex-col gap-2 w-[90px] md:w-[110px] shrink-0">
                                    <div class="w-full h-[70px] md:h-[85px] bg-gray-50 rounded flex items-center justify-center border border-gray-200 text-gray-300">
                                        <i class="far fa-image text-2xl md:text-3xl"></i>
                                    </div>
                                    <button onclick="openModal()" class="w-full border border-[#2196f3] text-[#2196f3] text-[9px] md:text-[10px] font-bold py-1.5 rounded hover:bg-blue-50 transition uppercase">Edit Profil</button>
                                </div>
                                <div class="flex-1 pt-1">
                                    <h3 class="text-[13px] md:text-[14px] font-bold text-gray-700 leading-tight mb-1">drg. Dinda Tegar Jelita Sp.Ortho</h3>
                                    <p class="text-[11px] md:text-[12px] text-gray-600 mb-1">Dokter Gigi</p>
                                    <div id="schedule-1" class="hidden mt-3 mb-2 text-[10px] md:text-[11px] text-gray-600 grid-cols-[50px_1fr] gap-y-1">
                                        <div>Senin</div>
                                        <div>12:00 - 20:00</div>
                                        <div>Selasa</div>
                                        <div>12:00 - 20:11</div>
                                        <div>Rabu</div>
                                        <div>12:00 - 20:00</div>
                                        <div>Kamis</div>
                                        <div>10:00 - 20:00</div>
                                        <div>Jumat</div>
                                        <div>09:00 - 20:00</div>
                                        <div>Sabtu</div>
                                        <div>09:00 - 20:00</div>
                                        <div>Minggu</div>
                                        <div>09:00 - 20:00</div>
                                    </div>
                                    <a href="javascript:void(0)" onclick="toggleSchedule('schedule-1', this)" class="text-[11px] md:text-[12px] text-[#2196f3] hover:underline cursor-pointer">Show More</a>
                                </div>
                            </div>

                            <div class="bg-white p-3 md:p-4 rounded shadow-sm flex gap-3 md:gap-4 items-start">
                                <div class="flex flex-col gap-2 w-[90px] md:w-[110px] shrink-0">
                                    <div class="w-full h-[70px] md:h-[85px] bg-gray-50 rounded flex items-center justify-center border border-gray-200 text-gray-300">
                                        <i class="far fa-image text-2xl md:text-3xl"></i>
                                    </div>
                                    <button onclick="openModal()" class="w-full border border-[#2196f3] text-[#2196f3] text-[9px] md:text-[10px] font-bold py-1.5 rounded hover:bg-blue-50 transition uppercase">Edit Profil</button>
                                </div>
                                <div class="flex-1 pt-1">
                                    <h3 class="text-[13px] md:text-[14px] font-bold text-gray-700 leading-tight mb-1">drg. Ria Budiati Sp. Ortho</h3>
                                    <p class="text-[11px] md:text-[12px] text-gray-600 mb-1">Dokter Gigi Spesialis Ortodonsia</p>
                                    <div id="schedule-2" class="hidden mt-3 mb-2 text-[10px] md:text-[11px] text-gray-600 grid-cols-[50px_1fr] gap-y-1">
                                        <div>Senin</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Selasa</div>
                                        <div>12:12 - 20:01</div>
                                        <div>Rabu</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Kamis</div>
                                        <div>10:00 - 21:00</div>
                                        <div>Jumat</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Sabtu</div>
                                        <div>09:00 - 21:00</div>
                                    </div>
                                    <a href="javascript:void(0)" onclick="toggleSchedule('schedule-2', this)" class="text-[11px] md:text-[12px] text-[#2196f3] hover:underline cursor-pointer">Show More</a>
                                </div>
                            </div>

                            <div class="bg-white p-3 md:p-4 rounded shadow-sm flex gap-3 md:gap-4 items-start">
                                <div class="flex flex-col gap-2 w-[90px] md:w-[110px] shrink-0">
                                    <div class="w-full h-[70px] md:h-[85px] bg-gray-50 rounded flex items-center justify-center border border-gray-200 text-gray-300">
                                        <i class="far fa-image text-2xl md:text-3xl"></i>
                                    </div>
                                    <button onclick="openModal()" class="w-full border border-[#2196f3] text-[#2196f3] text-[9px] md:text-[10px] font-bold py-1.5 rounded hover:bg-blue-50 transition uppercase">Edit Profil</button>
                                </div>
                                <div class="flex-1 pt-1">
                                    <h3 class="text-[13px] md:text-[14px] font-bold text-gray-700 leading-tight mb-1">DR. drg. Wenny Yulvie Sp.BM</h3>
                                    <p class="text-[11px] md:text-[12px] text-gray-600 mb-1">Dokter Gigi Spesialis Bedah Mulut</p>
                                    <div id="schedule-3" class="hidden mt-3 mb-2 text-[10px] md:text-[11px] text-gray-600 grid-cols-[50px_1fr] gap-y-1">
                                        <div>Senin</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Selasa</div>
                                        <div>09:00 - 20:00</div>
                                        <div>Rabu</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Kamis</div>
                                        <div>09:00 - 20:00</div>
                                        <div>Jumat</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Sabtu</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Minggu</div>
                                        <div>09:00 - 20:00</div>
                                    </div>
                                    <a href="javascript:void(0)" onclick="toggleSchedule('schedule-3', this)" class="text-[11px] md:text-[12px] text-[#2196f3] hover:underline cursor-pointer">Show More</a>
                                </div>
                            </div>

                            <div class="bg-white p-3 md:p-4 rounded shadow-sm flex gap-3 md:gap-4 items-start">
                                <div class="flex flex-col gap-2 w-[90px] md:w-[110px] shrink-0">
                                    <div class="w-full h-[70px] md:h-[85px] bg-gray-50 rounded flex items-center justify-center border border-gray-200 text-gray-300">
                                        <i class="far fa-image text-2xl md:text-3xl"></i>
                                    </div>
                                    <button onclick="openModal()" class="w-full border border-[#2196f3] text-[#2196f3] text-[9px] md:text-[10px] font-bold py-1.5 rounded hover:bg-blue-50 transition uppercase">Edit Profil</button>
                                </div>
                                <div class="flex-1 pt-1">
                                    <h3 class="text-[13px] md:text-[14px] font-bold text-gray-700 leading-tight mb-1">drg. Aditya Putra</h3>
                                    <p class="text-[11px] md:text-[12px] text-gray-600 mb-1">Dokter Gigi Umum</p>
                                    <div id="schedule-4" class="hidden mt-3 mb-2 text-[10px] md:text-[11px] text-gray-600 grid-cols-[50px_1fr] gap-y-1">
                                        <div>Senin</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Selasa</div>
                                        <div>09:00 - 20:00</div>
                                        <div>Rabu</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Kamis</div>
                                        <div>09:00 - 20:00</div>
                                        <div>Jumat</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Sabtu</div>
                                        <div>09:00 - 21:00</div>
                                    </div>
                                    <a href="javascript:void(0)" onclick="toggleSchedule('schedule-4', this)" class="text-[11px] md:text-[12px] text-[#2196f3] hover:underline cursor-pointer">Show More</a>
                                </div>
                            </div>

                            <div class="bg-white p-3 md:p-4 rounded shadow-sm flex gap-3 md:gap-4 items-start">
                                <div class="flex flex-col gap-2 w-[90px] md:w-[110px] shrink-0">
                                    <div class="w-full h-[70px] md:h-[85px] bg-gray-50 rounded flex items-center justify-center border border-gray-200 text-gray-300">
                                        <i class="far fa-image text-2xl md:text-3xl"></i>
                                    </div>
                                    <button onclick="openModal()" class="w-full border border-[#2196f3] text-[#2196f3] text-[9px] md:text-[10px] font-bold py-1.5 rounded hover:bg-blue-50 transition uppercase">Edit Profil</button>
                                </div>
                                <div class="flex-1 pt-1">
                                    <h3 class="text-[13px] md:text-[14px] font-bold text-gray-700 leading-tight mb-1">drg. MAY Lewerissa Sp.Perio</h3>
                                    <p class="text-[11px] md:text-[12px] text-gray-600 mb-1">Dokter Gigi Spesialis Periodonsia</p>
                                    <div id="schedule-5" class="hidden mt-3 mb-2 text-[10px] md:text-[11px] text-gray-600 grid-cols-[50px_1fr] gap-y-1">
                                        <div>Senin</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Rabu</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Jumat</div>
                                        <div>09:00 - 21:00</div>
                                        <div>Sabtu</div>
                                        <div>09:00 - 21:00</div>
                                    </div>
                                    <a href="javascript:void(0)" onclick="toggleSchedule('schedule-5', this)" class="text-[11px] md:text-[12px] text-[#2196f3] hover:underline cursor-pointer">Show More</a>
                                </div>
                            </div>

                            <div class="bg-white p-3 md:p-4 rounded shadow-sm flex gap-3 md:gap-4 items-start">
                                <div class="flex flex-col gap-2 w-[90px] md:w-[110px] shrink-0">
                                    <div class="w-full h-[70px] md:h-[85px] bg-gray-50 rounded flex items-center justify-center border border-gray-200 text-gray-300">
                                        <i class="far fa-image text-2xl md:text-3xl"></i>
                                    </div>
                                    <button onclick="openModal()" class="w-full border border-[#2196f3] text-[#2196f3] text-[9px] md:text-[10px] font-bold py-1.5 rounded hover:bg-blue-50 transition uppercase">Edit Profil</button>
                                </div>
                                <div class="flex-1 pt-1">
                                    <h3 class="text-[13px] md:text-[14px] font-bold text-gray-700 leading-tight mb-1">drg. Fanny Arditya M. Sp.Prost</h3>
                                    <p class="text-[11px] md:text-[12px] text-gray-600 mb-1">Dokter Gigi Spesialis Prostodonsia</p>
                                    <div id="schedule-6" class="hidden mt-3 mb-2 text-[10px] md:text-[11px] text-gray-600 grid-cols-[50px_1fr] gap-y-1">
                                        <div>Senin</div>
                                        <div>12:00 - 21:00</div>
                                        <div>Rabu</div>
                                        <div>12:00 - 21:00</div>
                                        <div>Jumat</div>
                                        <div>12:00 - 21:00</div>
                                        <div>Sabtu</div>
                                        <div>12:00 - 21:00</div>
                                    </div>
                                    <a href="javascript:void(0)" onclick="toggleSchedule('schedule-6', this)" class="text-[11px] md:text-[12px] text-[#2196f3] hover:underline cursor-pointer">Show More</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-400 hidden justify-center items-center p-2 md:p-4">
                    <div class="bg-white w-full max-w-[1000px] h-[95vh] rounded-lg shadow-xl flex flex-col relative">
                        <div class="p-4 md:p-6 pb-0 flex justify-between items-center border-b border-gray-100">
                            <h2 class="text-[#2196f3] text-lg md:text-xl font-bold">Edit Tenaga Medis</h2>
                            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl md:text-3xl font-bold leading-none">&times;</button>
                        </div>

                        <div class="p-4 md:p-6 overflow-y-auto flex-1">
                            <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_1fr] gap-6 md:gap-10">

                                <div class="flex flex-col gap-3 md:gap-4">
                                    <div class="flex gap-3 md:gap-4">
                                        <div class="w-[110px] md:w-[140px] shrink-0 flex flex-col items-center gap-2">
                                            <div class="w-[110px] h-[110px] md:w-[140px] md:h-[140px] border-2 border-dashed border-gray-300 rounded flex items-center justify-center bg-gray-50 text-gray-300">
                                                <i class="far fa-image text-3xl md:text-4xl"></i>
                                            </div>
                                            <button class="text-[#2196f3] text-[10px] md:text-xs font-bold uppercase hover:underline">Upload Photo</button>
                                        </div>

                                        <div class="flex-1 flex flex-col gap-3 md:gap-4">
                                            <div class="group">
                                                <label class="text-[11px] md:text-xs text-gray-500 block mb-1">Nama Lengkap (Tanpa Gelar) <span class="text-red-500">*</span></label>
                                                <input type="text" value="drg. Dinda Tegar Jelita Sp.Ortho" class="w-full border-b border-gray-300 py-1 text-sm text-gray-700 focus:border-[#2196f3] focus:outline-none">
                                            </div>
                                            <div class="group">
                                                <label class="text-[11px] md:text-xs text-gray-500 block mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <select class="w-full border-b border-gray-300 py-1 text-sm text-gray-700 focus:border-[#2196f3] focus:outline-none appearance-none bg-transparent">
                                                        <option>Perempuan</option>
                                                        <option>Laki-laki</option>
                                                    </select>
                                                    <i class="fas fa-caret-down absolute right-0 top-1 text-gray-400 text-xs pointer-events-none"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="text-[11px] md:text-xs text-gray-500 block mb-1">Nomor HP</label>
                                        <input type="text" class="w-full border-b border-gray-300 py-1 text-sm focus:border-[#2196f3] focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="text-[11px] md:text-xs text-gray-500 block mb-1">Alamat Email</label>
                                        <input type="email" class="w-full border-b border-gray-300 py-1 text-sm focus:border-[#2196f3] focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="text-[11px] md:text-xs text-gray-500 block mb-1">Nomor KTP</label>
                                        <input type="text" class="w-full border-b border-gray-300 py-1 text-sm focus:border-[#2196f3] focus:outline-none">
                                    </div>

                                    <div class="border-t border-gray-200 mt-2 pt-4">
                                        <label class="text-[#2196f3] text-sm font-bold block mb-3">Lembaga Registrasi (STR)</label>
                                        <div class="w-full border border-gray-300 rounded px-2 py-1.5 flex justify-between items-center mb-3">
                                            <span class="text-sm text-gray-400">Pilih Lembaga Registrasi</span>
                                            <i class="fas fa-caret-down text-gray-400"></i>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="text-[11px] md:text-xs text-gray-500 block mb-1">Nomor Registrasi (Nomor STR)</label>
                                                <input type="text" class="w-full border-b border-dotted border-gray-400 py-1 text-sm focus:outline-none bg-transparent">
                                            </div>
                                            <div>
                                                <label class="text-[#2196f3] text-[11px] md:text-xs font-bold block mb-1">Masa Berlaku STR</label>
                                                <input type="text" class="w-full border-b border-dotted border-gray-400 py-1 text-sm focus:outline-none bg-transparent">
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <label class="flex items-center gap-2 text-sm text-gray-700">
                                                <input type="checkbox" class="w-4 h-4 border-gray-300 rounded text-[#2196f3] focus:ring-[#2196f3]">
                                                Aktif Selamanya
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="text-[#2196f3] text-sm font-bold block mb-3">Lembaga Registrasi (SIP)</label>
                                        <div class="w-full border border-gray-300 rounded px-2 py-1.5 flex justify-between items-center mb-3">
                                            <span class="text-sm text-gray-400">Pilih Lembaga Registrasi</span>
                                            <i class="fas fa-caret-down text-gray-400"></i>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="text-[#2196f3] text-[11px] md:text-xs font-bold block mb-1">Nomor Registrasi (Nomor SIP)</label>
                                                <input type="text" class="w-full border-b border-dotted border-gray-400 py-1 text-sm focus:outline-none bg-transparent">
                                            </div>
                                            <div>
                                                <label class="text-[#2196f3] text-[11px] md:text-xs font-bold block mb-1">Masa Berlaku SIP</label>
                                                <input type="text" class="w-full border-b border-dotted border-gray-400 py-1 text-sm focus:outline-none bg-transparent">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                                        <div>
                                            <label class="text-[#2196f3] text-[11px] md:text-xs font-bold block mb-1">Gelar Depan</label>
                                            <div class="w-full border border-blue-400 rounded px-2 py-1.5 flex justify-between items-center">
                                                <span class="text-sm text-gray-700"></span>
                                                <i class="fas fa-caret-down text-gray-400"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <i class="fas fa-search text-gray-400 text-xs"></i>
                                                <label class="text-gray-400 text-[11px] md:text-xs block">Gelar Belakang</label>
                                            </div>
                                            <input type="text" class="w-full border-b border-gray-300 py-1 text-sm focus:outline-none">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-2">
                                        <div>
                                            <label class="text-[#2196f3] text-[11px] md:text-xs block mb-1">Job Medis <span class="text-red-500">*</span></label>
                                            <div class="w-full border border-blue-400 rounded px-2 py-1.5 flex justify-between items-center">
                                                <span class="text-sm text-gray-700">Dokter Gigi</span>
                                                <i class="fas fa-caret-down text-blue-400"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="text-[#2196f3] text-[11px] md:text-xs block mb-1">Specialist</label>
                                            <div class="w-full border border-blue-400 rounded px-2 py-1.5 flex justify-between items-center">
                                                <span class="text-sm text-gray-700"></span>
                                                <i class="fas fa-caret-down text-blue-400"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="text-gray-400 text-[11px] md:text-xs block mb-1">Subspecialist</label>
                                            <div class="w-full border border-gray-300 rounded px-2 py-1.5 flex justify-between items-center">
                                                <span class="text-sm text-gray-700"></span>
                                                <i class="fas fa-caret-down text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="text-[#2196f3] text-[11px] md:text-xs font-bold block mb-1">Kode Antrian</label>
                                        <input type="text" class="w-full border-b border-gray-300 py-1 text-sm focus:outline-none">
                                        <div class="h-0.5 bg-gray-300 w-1/3 mt-2"></div>
                                    </div>

                                    <div class="mt-4 md:mt-6">
                                        <button class="text-red-500 text-[11px] md:text-xs font-bold uppercase hover:underline">HAPUS TENAGA MEDIS</button>
                                    </div>

                                </div>

                                <div class="flex flex-col gap-4 md:gap-6">

                                    <div>
                                        <h3 class="text-[#2196f3] text-base md:text-lg font-bold mb-2">Estimasi Waktu</h3>
                                        <label class="text-[11px] md:text-xs text-gray-500 block mb-1">Estimasi Lama Waktu Konsultasi *</label>
                                        <div class="flex justify-between items-end border-b border-gray-300 pb-1">
                                            <span class="text-sm text-gray-700">10</span>
                                            <span class="text-xs text-gray-500">Menit</span>
                                        </div>
                                    </div>

                                    <div>
                                        <h3 class="text-[#2196f3] text-base md:text-lg font-bold mb-4">Jadwal Praktek</h3>

                                        <div class="flex flex-col gap-4 md:gap-6">
                                            <div class="flex items-start gap-2 md:gap-4">
                                                <div class="w-14 md:w-16 pt-2 text-sm text-gray-700">Senin</div>
                                                <button class="text-[#2196f3] text-xl font-bold pt-1">+</button>
                                                <div class="flex-1 grid grid-cols-[1fr_auto_1fr] gap-2 items-center">
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Mulai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="12:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-gray-400">-</div>
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Selesai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="20:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-start gap-2 md:gap-4">
                                                <div class="w-14 md:w-16 pt-2 text-sm text-gray-700">Selasa</div>
                                                <button class="text-[#2196f3] text-xl font-bold pt-1">+</button>
                                                <div class="flex-1 grid grid-cols-[1fr_auto_1fr] gap-2 items-center">
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Mulai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="12:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-gray-400">-</div>
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Selesai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="20:11" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-start gap-2 md:gap-4">
                                                <div class="w-14 md:w-16 pt-2 text-sm text-gray-700">Rabu</div>
                                                <button class="text-[#2196f3] text-xl font-bold pt-1">+</button>
                                                <div class="flex-1 grid grid-cols-[1fr_auto_1fr] gap-2 items-center">
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Mulai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="12:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-gray-400">-</div>
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Selesai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="20:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-start gap-2 md:gap-4">
                                                <div class="w-14 md:w-16 pt-2 text-sm text-gray-700">Kamis</div>
                                                <button class="text-[#2196f3] text-xl font-bold pt-1">+</button>
                                                <div class="flex-1 grid grid-cols-[1fr_auto_1fr] gap-2 items-center">
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Mulai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="10:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-gray-400">-</div>
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Selesai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="20:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-start gap-2 md:gap-4">
                                                <div class="w-14 md:w-16 pt-2 text-sm text-gray-700">Jumat</div>
                                                <button class="text-[#2196f3] text-xl font-bold pt-1">+</button>
                                                <div class="flex-1 grid grid-cols-[1fr_auto_1fr] gap-2 items-center">
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Mulai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="09:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-gray-400">-</div>
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Selesai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="20:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-start gap-2 md:gap-4">
                                                <div class="w-14 md:w-16 pt-2 text-sm text-gray-700">Sabtu</div>
                                                <button class="text-[#2196f3] text-xl font-bold pt-1">+</button>
                                                <div class="flex-1 grid grid-cols-[1fr_auto_1fr] gap-2 items-center">
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Mulai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="09:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-gray-400">-</div>
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Selesai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="20:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-start gap-2 md:gap-4">
                                                <div class="w-14 md:w-16 pt-2 text-sm text-gray-700">Minggu</div>
                                                <button class="text-[#2196f3] text-xl font-bold pt-1">+</button>
                                                <div class="flex-1 grid grid-cols-[1fr_auto_1fr] gap-2 items-center">
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Mulai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="09:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-gray-400">-</div>
                                                    <div class="group">
                                                        <label class="text-[10px] text-gray-400 block">Jam Selesai</label>
                                                        <div class="flex items-center border-b border-gray-300 pb-1">
                                                            <input type="text" value="20:00" class="w-full text-sm outline-none bg-transparent">
                                                            <i class="far fa-calendar text-gray-500 text-xs"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mt-2 md:mt-4">
                                        <button class="flex items-center gap-2 text-[#2196f3] text-[11px] md:text-xs font-bold uppercase mb-2">
                                            <i class="fas fa-pen"></i> TAMBAH TANDA TANGAN
                                        </button>
                                        <div class="w-16 h-16 bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-300 rounded">
                                            <i class="far fa-image text-xl"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="p-4 md:p-6 pt-4 flex flex-col sm:flex-row justify-end gap-2 md:gap-3 border-t border-gray-100">
                            <button onclick="closeModal()" class="w-full sm:w-auto px-4 md:px-6 py-2 border border-orange-500 text-orange-500 font-bold text-sm rounded uppercase hover:bg-orange-50">Batal</button>
                            <button onclick="closeModal()" class="w-full sm:w-auto px-4 md:px-6 py-2 bg-[#ff9800] text-white font-bold text-sm rounded uppercase hover:bg-[#f57c00] shadow-md">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('appSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

            if (toggle && sidebar) {
                toggle.replaceWith(toggle.cloneNode(true));
                const newToggle = document.getElementById('sidebarToggle');

                newToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidebar.classList.toggle('open');
                    if (backdrop) backdrop.classList.toggle('show');
                });
            }

            if (backdrop && sidebar) {
                backdrop.addEventListener('click', function() {
                    sidebar.classList.remove('open');
                    backdrop.classList.remove('show');
                });
            }
        });

        function toggleSettingsMenu() {
            const settingsMenu = document.getElementById('settingsMenu');
            const overlay = document.getElementById('settingsOverlay');

            settingsMenu.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        function closeSettingsMenu() {
            const settingsMenu = document.getElementById('settingsMenu');
            const overlay = document.getElementById('settingsOverlay');

            settingsMenu.classList.remove('active');
            overlay.classList.remove('active');
        }

        function switchTab(tabId, element) {
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.querySelectorAll('.settings-menu-item').forEach(i => {
                i.classList.remove('active');
                i.classList.add('default');
            });

            var content = document.getElementById('content-' + tabId);
            if (content) content.classList.add('active');

            if(element) {
                element.classList.add('active');
                element.classList.remove('default');
            }

            const idsToCheck = ['mobile-tab-' + tabId, 'tab-' + tabId];
            idsToCheck.forEach(id => {
                const el = document.getElementById(id);
                if(el) {
                    el.classList.add('active');
                    el.classList.remove('default');
                }
            });
        }

        function toggleSchedule(id, btn) {
            var content = document.getElementById(id);
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                content.classList.add('grid');
                btn.innerText = 'Show Less';
            } else {
                content.classList.add('hidden');
                content.classList.remove('grid');
                btn.innerText = 'Show More';
            }
        }

        function openModal() {
            const modal = document.getElementById('modalEdit');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('modalEdit');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    </script>

</body>
</html>
