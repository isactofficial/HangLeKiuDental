<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Klinik & User</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

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

        /* Form Styling */
        .form-label {
            display: block;
            color: #2196f3;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .form-label span {
            color: #f44336;
        }

        .input-underline {
            width: 100%;
            border: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.42);
            padding: 6px 0 7px;
            font-size: 14px;
            color: rgba(0, 0, 0, 0.87);
            background-color: transparent;
            outline: none;
            transition: border-bottom-color 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        }

        .input-underline:focus {
            border-bottom-color: #2196f3;
            border-bottom-width: 2px;
        }

        .input-select {
            width: 100%;
            border: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.42);
            padding: 6px 24px 7px 0;
            font-size: 14px;
            color: #333;
            background-color: transparent;
            outline: none;
            cursor: pointer;
            appearance: none;
        }

        .input-select:focus {
            border-bottom: 2px solid #2196f3;
        }

        /* Sidebar Menu Styling (Edit Profile) - Desktop Default */
        .edit-menu-container {
            background-color: #fff;
            border-radius: 4px;
            box-shadow: none;
            width: 100%;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 768px) {
            .edit-menu-container {
                width: 280px;
                display: flex !important;
                position: static !important;
                transform: none !important;
                box-shadow: none !important;
            }
        }

        /* Mobile Settings Menu Styles (Bottom Sheet) */
        @media (max-width: 767px) {
            #settingsMenu {
                display: block;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 60;
                background-color: white;
                border-top-left-radius: 16px;
                border-top-right-radius: 16px;
                box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
                transform: translateY(100%);
                transition: transform 0.3s ease-in-out;
                max-height: 80vh;
                overflow-y: auto;
            }

            #settingsMenu.active {
                transform: translateY(0);
            }

            #settingsOverlay {
                display: none;
                position: fixed;
                inset: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 50;
            }

            #settingsOverlay.active {
                display: block;
            }
        }

        .edit-menu-item {
            padding: 16px 24px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.12);
            color: rgba(0, 0, 0, 0.87);
            background-color: #fff;
            cursor: pointer;
            transition: background-color 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
            font-size: 15px;
            font-weight: 400;
            line-height: 1.5;
            text-align: left;
            position: relative;
            display: block;
        }

        .edit-menu-item:hover {
            background-color: rgba(0, 0, 0, 0.04);
        }

        .edit-menu-item.active {
            background-color: #2196f3;
            color: #fff;
            border-bottom-color: #2196f3;
            font-weight: 400;
        }

        .edit-menu-item.active:hover {
            background-color: #1976d2;
        }

        .edit-menu-item:last-child {
            border-bottom: none;
        }

        /* Payment Tag Styling */
        .payment-tag {
            border: 1px solid #2196f3;
            color: #2196f3;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            margin-right: 4px;
        }

        /* Map Container Styling */
        #map {
            height: 300px;
            width: 100%;
            z-index: 1;
        }

        /* Pastikan CSS Backdrop Sidebar ada jika tidak ter-load dari partial */
        .sidebar-backdrop {
            display: block;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.35);
            z-index: 40;
            opacity: 0;
            transition: opacity .18s ease;
            pointer-events: none;
        }
        .sidebar-backdrop.show {
            opacity: 1;
            pointer-events: auto;
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden bg-[#f5f7fa]">

    @include('partials.sidebar')

    <div id="sidebarBackdrop" class="sidebar-backdrop"></div>

    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-[#f5f7fa]">

        <header class="bg-white h-16 flex items-center justify-between px-8 z-10 flex-shrink-0 shadow-sm">
            <div class="flex items-center gap-4">
                <button id="sidebarToggle" class="md:hidden text-gray-500 hover:text-[#2196f3] focus:outline-none transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            <div class="flex items-center gap-5 text-gray-500">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-full bg-gray-500 flex items-center justify-center text-white text-[10px] font-bold border border-gray-200 shadow-sm cursor-pointer">
                        HDS</div>
                    <button
                        class="hidden md:flex bg-[#2196f3] hover:bg-[#1e88e5] text-white px-4 py-2 rounded text-[13px] font-medium items-center gap-2 shadow-sm transition">
                        hanglekiu dent... <i class="fas fa-chevron-down text-[10px]"></i>
                    </button>
                </div>
                <div class="flex items-center gap-4 ml-1">
                    <i
                        class="fas fa-question-circle cursor-pointer hover:text-blue-600 text-xl transition text-gray-400"></i>
                    <i
                        class="fas fa-bell-slash cursor-pointer hover:text-blue-600 text-xl transition text-gray-400"></i>
                    <i
                        class="fas fa-user-circle text-2xl cursor-pointer hover:text-blue-600 transition text-gray-400"></i>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto px-4 md:px-10 pb-10 relative">

            <div id="view-dashboard" class="max-w-[1400px] mx-auto transition-all duration-300">

                <div class="mb-4 mt-6 border-b border-gray-200 pb-2">
                    <h1 class="text-[24px] md:text-[28px] font-bold text-[#1976d2] tracking-tight">Profile Klinik</h1>
                    <p class="text-[#1976d2] font-normal text-[14px] md:text-[15px] mt-1">hanglekiu dental specialist</p>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12 min-h-[450px]">
                    <div class="w-full lg:w-[55%] flex justify-center lg:justify-start items-center pl-0 lg:pl-4">
                        <img src="assets/Profil.png" alt="Faskes Illustration" class="w-full max-w-2xl object-contain">
                    </div>
                    <div class="w-full lg:w-[45%] flex flex-col justify-center h-full pt-6 pr-0 lg:pr-10">
                        <h2 class="text-[22px] md:text-[26px] lg:text-[28px] font-bold text-[#2c5ea8] leading-[1.3] mb-6">Pastikan
                            Faskes Anda Ditemukan Masyarakat Indonesia</h2>
                        <div class="mb-8">
                            <h3 class="text-[#9ca3af] text-[13px] font-medium mb-1">Informasi Fasilitas Kesehatan</h3>
                            <p class="text-gray-500 text-[14px] leading-relaxed max-w-lg">Kelengkapan informasi faskes
                                Anda mempengaruhi kepercayaan dan kemudahan pasien untuk menemukan Anda.</p>
                        </div>
                        <div class="w-full max-w-2xl mb-8">
                            <div class="w-full bg-[#dae0f5] rounded-full h-8 overflow-hidden">
                                <div id="progress-bar-fill"
                                    class="bg-[#74b816] h-full rounded-full transition-all duration-1000 ease-out relative"
                                    style="width: 0%"></div>
                            </div>
                            <p class="text-[12px] text-gray-600 mt-2 font-medium">Kelengkapan profil klinik 71%</p>
                        </div>
                        <div class="flex justify-end max-w-2xl">
                            <button onclick="switchView('edit')"
                                class="bg-[#f97316] hover:bg-[#ea580c] text-white font-medium py-1.5 px-6 rounded shadow-sm text-[13px] transition transform active:scale-95">Edit</button>
                        </div>
                    </div>
                </div>

                <div class="h-10"></div>

                <div class="mb-4 mt-6 border-b border-gray-200 pb-2">
                    <h1 class="text-[24px] md:text-[28px] font-bold text-[#1976d2] tracking-tight">Profile Admin</h1>
                    <p class="text-[#1976d2] font-normal text-[15px] mt-1">Nama Admin</p>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12 min-h-[350px]">
                    <div
                        class="w-full lg:w-[55%] flex justify-center lg:justify-start items-center pl-0 lg:pl-4 order-2 lg:order-1">
                        <div
                            class="w-full max-w-lg h-64 bg-blue-50 rounded-lg flex items-center justify-center border-2 border-dashed border-blue-200">
                            <i class="fas fa-user-md text-[#2c5ea8] text-[6rem] md:text-[8rem] opacity-50"></i>
                        </div>
                    </div>

                    <div
                        class="w-full lg:w-[45%] flex flex-col justify-center h-full pt-6 pr-0 lg:pr-10 order-1 lg:order-2">
                        <h2 class="text-[22px] md:text-[26px] lg:text-[28px] font-bold text-[#2c5ea8] leading-[1.3] mb-6">Lengkapi Data
                            Diri Anda</h2>
                        <div class="mb-8">
                            <h3 class="text-[#9ca3af] text-[13px] font-medium mb-1">Informasi Admin</h3>
                            <p class="text-gray-500 text-[14px] leading-relaxed max-w-lg">Pastikan data diri anda
                                terupdate untuk keperluan administrasi dan rekam medis.</p>
                        </div>
                        <div class="w-full max-w-2xl mb-8">
                            <div class="w-full bg-[#dae0f5] rounded-full h-8 overflow-hidden">
                                <div id="progress-bar-user"
                                    class="bg-[#2196f3] h-full rounded-full transition-all duration-1000 ease-out relative"
                                    style="width: 0%"></div>
                            </div>
                            <p class="text-[12px] text-gray-600 mt-2 font-medium">Kelengkapan profil pengguna 45%</p>
                        </div>
                        <div class="flex justify-end max-w-2xl">
                            <button onclick="switchView('edit-user')"
                                class="bg-[#f97316] hover:bg-[#ea580c] text-white font-medium py-1.5 px-6 rounded shadow-sm text-[13px] transition transform active:scale-95">Edit
                                </button>
                        </div>
                    </div>
                </div>

            </div>

            <div id="view-edit" class="max-w-7xl mx-auto hidden opacity-0 transition-all duration-300">

                <div class="mb-6 mt-6">
                    <h1 class="text-[24px] md:text-[28px] font-bold text-[#1976d2]">Profile Klinik</h1>
                    <p class="text-[#1976d2] font-normal text-[15px] mt-1">hanglekiu dental specialist</p>
                    <div class="flex items-center text-[12px] gap-2 mt-3 font-normal">
                        <span class="text-gray-600 hover:text-[#2196f3] cursor-pointer"
                            onclick="switchView('dashboard')">Profile</span>
                        <i class="fas fa-chevron-right text-[9px] text-gray-400"></i>
                        <span class="text-gray-800">Edit Profile</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-6 items-start relative">

                    <button onclick="toggleSettingsMenu()" class="md:hidden w-full bg-white p-3 rounded shadow mb-2 flex justify-between items-center text-[#1976d2] font-medium">
                        <span>Menu Opsi</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>

                    <div id="settingsOverlay" onclick="closeSettingsMenu()"></div>

                    <div id="settingsMenu" class="edit-menu-container">
                        <div class="md:hidden flex justify-between items-center p-4 border-b sticky top-0 bg-white z-10">
                            <span class="font-bold text-gray-700">Pilih Opsi</span>
                            <button onclick="closeSettingsMenu()" class="text-gray-500"><i class="fas fa-times"></i></button>
                        </div>

                        <div id="menu-informasi-dasar" class="edit-menu-item active"
                            onclick="switchEditTab('informasi-dasar'); closeSettingsMenu()"><span>Informasi Dasar</span></div>
                        <div id="menu-visi-misi" class="edit-menu-item" onclick="switchEditTab('visi-misi'); closeSettingsMenu()"><span>Visi
                                Misi</span></div>
                        <div id="menu-alamat" class="edit-menu-item" onclick="switchEditTab('alamat'); closeSettingsMenu()">
                            <span>Alamat</span>
                        </div>
                        <div id="menu-metode-pembayaran" class="edit-menu-item"
                            onclick="switchEditTab('metode-pembayaran'); closeSettingsMenu()"><span>Metode Pembayaran</span></div>
                        <div id="menu-photo" class="edit-menu-item" onclick="switchEditTab('photo'); closeSettingsMenu()"><span>Photo</span>
                        </div>
                        <div id="menu-fasilitas" class="edit-menu-item" onclick="switchEditTab('fasilitas'); closeSettingsMenu()">
                            <span>Fasilitas</span>
                        </div>
                        <div id="menu-jam-operasional" class="edit-menu-item"
                            onclick="switchEditTab('jam-operasional'); closeSettingsMenu()"><span>Jam Operasional</span></div>
                        <div id="menu-organisasi" class="edit-menu-item" onclick="switchEditTab('organisasi'); closeSettingsMenu()">
                            <span>Organisasi</span>
                        </div>
                        <div id="menu-sertifikat" class="edit-menu-item" onclick="switchEditTab('sertifikat'); closeSettingsMenu()">
                            <span>Sertifikat Training</span>
                        </div>
                    </div>

                    <div class="flex-1 bg-white shadow-md rounded mb-6 w-full"
                        style="box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.2), 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 3px 1px -2px rgba(0, 0, 0, 0.12); min-height: 500px;">

                        <div id="tab-informasi-dasar" class="edit-tab-content">
                            <div style="padding: 16px 16px 16px 24px;">
                                <h2 class="text-xl font-bold text-[#1976d2]">Informasi Dasar Klinik</h2>
                            </div>
                            <div
                                style="padding-left: 24px; padding-right: 24px; padding-bottom: 24px; width: calc(100% + 24px); margin: -12px; display: flex; flex-wrap: wrap; box-sizing: border-box;">
                                <div
                                    style="flex-basis: 100%; max-width: 100%; display: flex; flex-wrap: wrap; box-sizing: border-box; margin: 12px;">
                                    <div
                                        style="flex-basis: 100%; md:flex-basis: 33.333333%; max-width: 100%; md:max-width: 33.333333%; padding: 12px; box-sizing: border-box;" class="w-full md:w-1/3">
                                        <p class="text-[#2196f3] text-[12px] font-medium mb-2">Logo Faskes</p>
                                        <div
                                            style="position: relative; max-width: 365px; max-height: 365px; margin-top: 8px;" class="mx-auto md:mx-0">
                                            <img src="assets/logo2.jpeg" alt="Logo"
                                                style="width: 100%; height: 100%; object-fit: contain; max-height: 200px; border-radius: 50%;">
                                        </div>
                                        <p style="text-align: center;" class="text-[11px] text-[#747070] mt-4">Ukuran
                                            gambar min. 365x365px</p>
                                        <p style="text-align: center;"
                                            class="text-[#2196f3] text-[13px] font-medium cursor-pointer hover:underline mt-2">
                                            Ganti Logo</p>
                                    </div>
                                    <div
                                        style="flex-basis: 100%; md:flex-basis: 66.666667%; max-width: 100%; md:max-width: 66.666667%; padding: 12px; box-sizing: border-box;" class="w-full md:w-2/3">
                                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin: 12px 0;">
                                            <div style="flex-basis: 100%; max-width: 100%;">
                                                <div style="margin-top: 18px;">
                                                    <label class="form-label">Nama Fasilitas Kesehatan
                                                        <span>*</span></label>
                                                    <input type="text" class="input-underline"
                                                        value="hanglekiu dental specialist">
                                                </div>
                                                <label
                                                    style="display: flex; align-items: center; margin-top: 16px; cursor: pointer;">
                                                    <input type="checkbox" checked
                                                        class="text-[#2196f3] rounded border-gray-300 focus:ring-[#2196f3] h-5 w-5 cursor-pointer mr-2">
                                                    <span class="text-[14px] text-gray-800">Saya merupakan Owner /
                                                        Management</span>
                                                </label>
                                            </div>
                                            <div
                                                style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px;">
                                                <div style="flex-basis: 50%; max-width: 50%; padding-right: 12px;">
                                                    <label class="form-label">Nomor Telepon</label>
                                                    <input type="number" class="input-underline" placeholder="">
                                                </div>
                                                <div
                                                    style="flex-basis: 50%; max-width: 50%; padding-left: 12px; display: flex; align-items: flex-end;">
                                                    <button disabled
                                                        class="text-[#2196f3] text-[13px] font-medium opacity-50 cursor-not-allowed">+
                                                        Nomor Telepon</button>
                                                </div>
                                            </div>
                                            <div style="width: 100%; margin-top: 18px;">
                                                <div class="flex items-center border-b border-gray-300 py-2">
                                                    <i class="fas fa-phone-alt text-gray-400 text-[12px] mr-3"></i>
                                                    <span class="text-gray-800 text-[16px] flex-1">-</span>
                                                    <button class="text-red-500 hover:text-red-600 cursor-pointer">
                                                        <i class="fas fa-times-circle text-lg"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div style="width: 100%; margin-top: 18px;">
                                                <p class="text-[11px] text-gray-600 font-medium mb-1">Link Teleconsult:
                                                </p>
                                                <p class="text-[#2196f3] text-[13px] font-medium break-all"
                                                    style="display: flex; align-items: center;">
                                                    https://assist.id/hanglekiu-dental-specialist-kota-jakarta-selatan-dki-jakarta/teleconsult
                                                    <i
                                                        class="far fa-copy ml-2 cursor-pointer hover:text-[#1976d2] flex-shrink-0"></i>
                                                </p>
                                            </div>
                                            <div
                                                style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                                <div style="flex: 1; min-width: 200px;">
                                                    <label class="form-label">Tipe Fasilitas Kesehatan
                                                        <span>*</span></label>
                                                    <div class="relative">
                                                        <select class="input-select pr-10">
                                                            <option>Praktek Pribadi</option>
                                                            <option>Klinik Pratama</option>
                                                        </select>
                                                        <i
                                                            class="fas fa-chevron-down text-[11px] text-[#2196f3] absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                                <div style="flex: 1; min-width: 200px;">
                                                    <label class="form-label">Spesialisasi <span>*</span></label>
                                                    <div class="relative">
                                                        <select class="input-select pr-10">
                                                            <option>Gigi</option>
                                                            <option>Umum</option>
                                                        </select>
                                                        <i
                                                            class="fas fa-chevron-down text-[11px] text-[#2196f3] absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                                <div style="flex: 1; min-width: 200px;">
                                                    <label class="form-label">Kepemilikan <span>*</span></label>
                                                    <div class="relative">
                                                        <select class="input-select pr-10">
                                                            <option>Swasta</option>
                                                            <option>Negeri</option>
                                                        </select>
                                                        <i
                                                            class="fas fa-chevron-down text-[11px] text-[#2196f3] absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                                <div style="flex: 1; min-width: 200px;">
                                                    <label class="form-label">Nama NPWP/KTP <span>*</span></label>
                                                    <input type="text" class="input-underline"
                                                        value="Dinda tegar Jelita">
                                                </div>
                                            </div>
                                            <div
                                                style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                                <div style="flex: 1; min-width: 200px;">
                                                    <label class="form-label">Nomor NPWP/KTP <span>*</span></label>
                                                    <input type="text" class="input-underline"
                                                        value="63.709.590.2-016.000">
                                                </div>
                                            </div>
                                            <div
                                                style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                                <div style="flex: 1; min-width: 200px;">
                                                    <label class="form-label">NITKU <span>*</span></label>
                                                    <input type="text" class="input-underline"
                                                        value="63.709.590.2-016.000">
                                                </div>
                                            </div>
                                            <div
                                                style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                                <div style="flex: 1; min-width: 200px;">
                                                    <label class="form-label">Alamat NPWP/KTP <span>*</span></label>
                                                    <input type="text" class="input-underline"
                                                        value="jl. Adhyaksa 9 no 1-2 rt 03 rw 05 Lebak Bulus Cilandak Kota Amd Jaksel DKI jakarta">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    style="width: 100%; display: flex; justify-content: flex-end; margin-top: 18px; padding: 12px;">
                                    <button
                                        class="bg-[#f97316] hover:bg-[#ea580c] text-white font-medium py-2.5 px-8 rounded shadow text-[13px] transition transform active:scale-95 uppercase tracking-wide">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="tab-visi-misi" class="edit-tab-content" style="display: none;">
                            <div
                                style="padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f0f0f0;">
                                <h2 class="text-xl font-bold text-[#1976d2]">Visi Misi</h2>
                                <button
                                    class="bg-[#1976d2] hover:bg-[#1565c0] text-white font-medium py-2 px-4 rounded shadow text-[13px] uppercase">
                                    PRINT VISI MISI
                                </button>
                            </div>
                            <div style="padding: 24px;">
                                <div style="margin-bottom: 24px;">
                                    <label class="form-label text-gray-700">Visi <span>*</span></label>
                                    <input type="text" class="input-underline" placeholder="">
                                </div>
                                <div style="margin-bottom: 24px;">
                                    <label class="form-label text-gray-700">Misi <span>*</span></label>
                                    <input type="text" class="input-underline" placeholder="">
                                </div>
                                <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: 40px;">
                                    <button
                                        class="bg-[#f97316] hover:bg-[#ea580c] text-white font-medium py-2.5 px-8 rounded shadow text-[13px] transition transform active:scale-95 uppercase tracking-wide">
                                        SIMPAN
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="tab-alamat" class="edit-tab-content" style="display: none;">
                            <div style="padding: 16px 24px;">
                                <h2 class="text-xl font-bold text-[#1976d2]">Alamat</h2>
                            </div>
                            <div style="padding: 0 24px 24px 24px;">

                                <div style="margin-top: 12px; margin-bottom: 24px;">
                                    <label class="form-label">Nama Jalan <span>*</span></label>
                                    <input type="text" class="input-underline" value="">
                                </div>

                                <div class="flex flex-col md:flex-row gap-8 mb-6">
                                    <div class="flex-1 relative">
                                        <label class="form-label">Provinsi <span>*</span></label>
                                        <div class="relative">
                                            <select class="input-select pr-10"></select>
                                            <i
                                                class="fas fa-caret-down text-[#757575] absolute right-0 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 relative">
                                        <label class="form-label">Kota / Kabupaten <span>*</span></label>
                                        <div class="relative">
                                            <select class="input-select pr-10"></select>
                                            <i
                                                class="fas fa-caret-down text-[#757575] absolute right-0 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row gap-8 mb-6">
                                    <div class="flex-1 relative">
                                        <label class="form-label">Kecamatan <span>*</span></label>
                                        <div class="relative">
                                            <select class="input-select pr-10"></select>
                                            <i
                                                class="fas fa-caret-down text-[#757575] absolute right-0 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <label class="form-label">Kode Pos <span>*</span></label>
                                        <input type="text" class="input-underline">
                                    </div>
                                </div>

                                <div style="margin-bottom: 30px;">
                                    <label
                                        class="text-[#2196f3] text-[12px] font-medium mb-1 cursor-pointer hover:underline">Zona
                                        Waktu</label>
                                    <div class="relative mt-1 w-full md:w-1/2">
                                        <select class="input-select pr-10"></select>
                                        <i
                                            class="fas fa-caret-down text-[#757575] absolute right-0 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                    </div>
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <p class="text-[12px] text-gray-800 font-medium mb-2">Tips: Pindahkan marker untuk
                                        mengupdate lokasi Anda.</p>

                                    <div style="margin-bottom: 8px;">
                                        <p class="text-[11px] font-bold text-gray-800 mb-1">Alamat</p>
                                        <div
                                            class="relative border border-gray-300 rounded bg-white overflow-hidden flex items-center">
                                            <div class="pl-3 text-gray-500">
                                                <i class="fas fa-search"></i>
                                            </div>
                                            <input type="text" class="w-full py-2 px-3 text-sm outline-none"
                                                placeholder="Cari alamat">
                                        </div>
                                    </div>

                                    <div class="border border-gray-300 rounded overflow-hidden">
                                        <div id="map"></div>
                                    </div>
                                </div>

                                <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: 20px;">
                                    <button
                                        class="bg-gray-200 text-gray-400 font-medium py-2 px-6 rounded shadow-sm text-[13px] uppercase cursor-not-allowed">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="tab-metode-pembayaran" class="edit-tab-content" style="display: none;">
                            <div
                                style="padding: 16px 24px; position: relative; display: flex; align-items: center; justify-content: space-between;">
                                <div class="flex items-center gap-2">
                                    <h2 class="text-xl font-bold text-[#1976d2]">Metode Pembayaran</h2>
                                    <i class="fas fa-info-circle text-gray-400 text-xs"></i>
                                </div>
                                <i class="fas fa-info-circle text-gray-400 text-xs"></i>
                            </div>
                            <div style="padding: 0 24px 24px 24px;">

                                <div class="flex flex-wrap mb-6">
                                    <span class="payment-tag">Debit <i class="fas fa-times cursor-pointer"></i></span>
                                    <span class="payment-tag">Kartu Kredit <i
                                            class="fas fa-times cursor-pointer"></i></span>
                                    <span class="payment-tag">QRIS <i class="fas fa-times cursor-pointer"></i></span>
                                    <span class="payment-tag">Transfer <i
                                            class="fas fa-times cursor-pointer"></i></span>
                                    <span class="payment-tag">Tunai <i class="fas fa-times cursor-pointer"></i></span>
                                </div>

                                <div class="flex flex-col gap-6">
                                    <div class="relative">
                                        <i class="fas fa-search absolute left-0 bottom-3 text-gray-800 text-sm"></i>
                                        <input type="text" class="input-underline pl-6 placeholder-gray-400"
                                            placeholder="Pribadi, Contoh: Tunai">
                                    </div>
                                    <div class="relative">
                                        <i class="fas fa-search absolute left-0 bottom-3 text-gray-800 text-sm"></i>
                                        <input type="text" class="input-underline pl-6 placeholder-gray-400"
                                            placeholder="Perusahaan">
                                    </div>
                                    <div class="relative">
                                        <i class="fas fa-search absolute left-0 bottom-3 text-gray-800 text-sm"></i>
                                        <input type="text" class="input-underline pl-6 placeholder-gray-400"
                                            placeholder="Asuransi">
                                    </div>
                                    <div class="relative">
                                        <i class="fas fa-search absolute left-0 bottom-3 text-gray-800 text-sm"></i>
                                        <input type="text" class="input-underline pl-6 placeholder-gray-400"
                                            placeholder="Debit">
                                    </div>
                                    <div class="relative">
                                        <i class="fas fa-search absolute left-0 bottom-3 text-gray-800 text-sm"></i>
                                        <input type="text" class="input-underline pl-6 placeholder-gray-400"
                                            placeholder="Kredit">
                                    </div>
                                </div>

                                <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: 40px;">
                                    <button
                                        class="bg-[#f97316] hover:bg-[#ea580c] text-white font-medium py-2.5 px-8 rounded shadow text-[13px] transition transform active:scale-95 uppercase tracking-wide">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="tab-photo" class="edit-tab-content" style="display: none;">
                            <div style="padding: 16px 24px;">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-xl font-bold text-[#1976d2]">Photo</h2>
                                    <i
                                        class="fas fa-info-circle text-gray-500 text-sm cursor-pointer hover:text-[#1976d2]"></i>
                                </div>
                            </div>
                            <div style="padding: 0 24px 24px 24px;">
                                <div class="mb-8 text-center px-4">
                                    <p class="text-gray-500 text-[13px] leading-relaxed">
                                        <span class="font-bold text-gray-600">Tips :</span> Menambah banyak photo
                                        fasilitas kesehatan dapat menambah daya tarik terhadap keputusan pasien. Tambahkan
                                        beberapa photo dasar seperti photo depan bangunan, fasilitas kesehatan, ruang
                                        tunggu dan admisi.
                                    </p>
                                </div>
                                <div
                                    class="border-2 border-dashed border-gray-500 rounded-lg min-h-[300px] flex flex-col justify-center items-center cursor-pointer hover:bg-gray-50 transition group mb-10 relative">
                                    <div class="flex flex-col items-center justify-center p-10">
                                        <i
                                            class="fas fa-cloud-upload-alt text-6xl text-gray-500 mb-6 group-hover:text-[#1976d2] transition"></i>
                                        <h3 class="text-gray-600 font-bold text-[15px] mb-2">Drag here or click to
                                            upload</h3>
                                        <p class="text-gray-600 text-[13px] font-bold mb-2">Resolusi minimum lebar 800px
                                            dan tinggi 800px</p>
                                        <p class="text-gray-400 text-[12px]">Max Photo Size 5MB</p>
                                    </div>
                                    <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                </div>
                                <div style="width: 100%; display: flex; justify-content: flex-end;">
                                    <button
                                        class="bg-[#e0e0e0] text-[#a0a0a0] font-medium py-2 px-6 rounded shadow-sm text-[13px] cursor-not-allowed">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="tab-fasilitas" class="edit-tab-content" style="display: none;">
                            <div style="padding: 16px 24px;">
                                <div class="flex justify-between items-center mb-8">
                                    <h2 class="text-xl font-bold text-[#1976d2]">Fasilitas</h2>
                                    <i
                                        class="fas fa-info-circle text-gray-500 text-sm cursor-pointer hover:text-[#1976d2]"></i>
                                </div>
                            </div>
                            <div style="padding: 0 24px 24px 24px;">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-y-10 gap-x-4 mb-16">
                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Ambulans</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Mushala</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Laboratorium</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Rawat
                                            Inap</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">IGD
                                            24 Jam</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">ATM
                                            Galeri</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Ruang
                                            Menyusui</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Ruang
                                            Bayi</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Ruang
                                            bersalin</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Ruang
                                            Operasi</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span
                                            class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Instalasi
                                            Gawat Darurat</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span
                                            class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Perpustakaan</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Ruang
                                            Tunggu</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Ruang
                                            Kemoterapi</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Ruang
                                            Auditorium</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Ruang
                                            Laboratorium</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Nurse
                                            Call</span>
                                    </label>

                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">TV
                                            LCD</span>
                                    </label>

                                </div>

                                <div style="width: 100%; display: flex; justify-content: flex-end;">
                                    <button
                                        class="bg-[#f97316] hover:bg-[#ea580c] text-white font-medium py-2.5 px-8 rounded shadow text-[13px] transition transform active:scale-95 uppercase tracking-wide">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="tab-jam-operasional" class="edit-tab-content" style="display: none;">

                            <div class="flex items-center px-4 pt-4 mb-2">
                                <button
                                    class="bg-[#2196f3] text-white px-4 py-1 text-[12px] font-medium shadow-sm mr-1">Fasilitas
                                    Kesehatan</button>
                                <button
                                    class="bg-[#e0e0e0] text-[#757575] hover:bg-[#d5d5d5] px-4 py-1 text-[12px] font-medium shadow-sm">Poli</button>
                            </div>

                            <div style="padding: 16px 24px;">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-xl font-bold text-[#1976d2]">Jam Operational</h2>
                                    <i
                                        class="fas fa-info-circle text-gray-500 text-sm cursor-pointer hover:text-[#1976d2]"></i>
                                </div>
                            </div>

                            <div style="padding: 0 24px 24px 24px;">

                                <div class="mt-4 mb-8 space-y-8">
                                    <div class="flex flex-col md:flex-row items-center">
                                        <div class="w-full md:w-32 mb-2 md:mb-0">
                                            <span class="text-[13px] font-bold text-gray-800">Senin</span>
                                        </div>
                                        <div class="flex-1 flex items-center w-full">
                                            <button
                                                class="text-[#2196f3] text-xl font-bold mr-6 hover:text-blue-700">+</button>

                                            <div class="flex items-center gap-2 flex-1">
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Mulai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700 placeholder-gray-300"
                                                            placeholder="">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>

                                                <span class="text-gray-400 mx-2">-</span>

                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Selesai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700 placeholder-gray-300"
                                                            placeholder="">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row items-center">
                                        <div class="w-full md:w-32 mb-2 md:mb-0">
                                            <span class="text-[13px] font-bold text-gray-800">Selasa</span>
                                        </div>
                                        <div class="flex-1 flex items-center w-full">
                                            <button
                                                class="text-[#2196f3] text-xl font-bold mr-6 hover:text-blue-700">+</button>
                                            <div class="flex items-center gap-2 flex-1">
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Mulai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                                <span class="text-gray-400 mx-2">-</span>
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Selesai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row items-center">
                                        <div class="w-full md:w-32 mb-2 md:mb-0">
                                            <span class="text-[13px] font-bold text-gray-800">Rabu</span>
                                        </div>
                                        <div class="flex-1 flex items-center w-full">
                                            <button
                                                class="text-[#2196f3] text-xl font-bold mr-6 hover:text-blue-700">+</button>
                                            <div class="flex items-center gap-2 flex-1">
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Mulai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                                <span class="text-gray-400 mx-2">-</span>
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Selesai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row items-center">
                                        <div class="w-full md:w-32 mb-2 md:mb-0">
                                            <span class="text-[13px] font-bold text-gray-800">Kamis</span>
                                        </div>
                                        <div class="flex-1 flex items-center w-full">
                                            <button
                                                class="text-[#2196f3] text-xl font-bold mr-6 hover:text-blue-700">+</button>
                                            <div class="flex items-center gap-2 flex-1">
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Mulai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                                <span class="text-gray-400 mx-2">-</span>
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Selesai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row items-center">
                                        <div class="w-full md:w-32 mb-2 md:mb-0">
                                            <span class="text-[13px] font-bold text-gray-800">Jumat</span>
                                        </div>
                                        <div class="flex-1 flex items-center w-full">
                                            <button
                                                class="text-[#2196f3] text-xl font-bold mr-6 hover:text-blue-700">+</button>
                                            <div class="flex items-center gap-2 flex-1">
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Mulai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                                <span class="text-gray-400 mx-2">-</span>
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Selesai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row items-center">
                                        <div class="w-full md:w-32 mb-2 md:mb-0">
                                            <span class="text-[13px] font-bold text-gray-800">Sabtu</span>
                                        </div>
                                        <div class="flex-1 flex items-center w-full">
                                            <button
                                                class="text-[#2196f3] text-xl font-bold mr-6 hover:text-blue-700">+</button>
                                            <div class="flex items-center gap-2 flex-1">
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Mulai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                                <span class="text-gray-400 mx-2">-</span>
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Selesai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row items-center">
                                        <div class="w-full md:w-32 mb-2 md:mb-0">
                                            <span class="text-[13px] font-bold text-gray-800">Minggu</span>
                                        </div>
                                        <div class="flex-1 flex items-center w-full">
                                            <button
                                                class="text-[#2196f3] text-xl font-bold mr-6 hover:text-blue-700">+</button>
                                            <div class="flex items-center gap-2 flex-1">
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Mulai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                                <span class="text-gray-400 mx-2">-</span>
                                                <div class="flex-1 relative">
                                                    <label class="absolute -top-4 text-[10px] text-gray-400">Jam
                                                        Selesai</label>
                                                    <div
                                                        class="relative flex items-center border-b border-gray-400 pb-1">
                                                        <input type="text"
                                                            class="w-full outline-none bg-transparent text-[13px] text-gray-700">
                                                        <span class="text-[11px] text-gray-500 mr-2">WIB</span>
                                                        <i class="far fa-clock text-gray-600 text-[14px]"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-16">
                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                class="peer h-5 w-5 cursor-pointer appearance-none border-2 border-[#2196f3] rounded-sm bg-white checked:bg-[#2196f3] checked:border-[#2196f3] transition-all">
                                            <i
                                                class="fas fa-check text-white text-[10px] absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                                        </div>
                                        <span
                                            class="ml-3 text-gray-700 text-[13px] group-hover:text-[#2196f3]">Tersedia
                                            24 jam</span>
                                    </label>
                                </div>

                                <div style="width: 100%; display: flex; justify-content: flex-end;">
                                    <button
                                        class="bg-[#ff8a65] hover:bg-[#ff7043] text-white font-medium py-2 px-6 rounded shadow-sm text-[13px] transition transform active:scale-95">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="tab-organisasi" class="edit-tab-content" style="display: none;">
                            <div style="padding: 16px 24px;">
                                <div class="flex justify-between items-center mb-6">
                                    <h2 class="text-xl font-bold text-[#1976d2]">Organisasi</h2>
                                    <div class="flex items-center gap-4">
                                        <i
                                            class="fas fa-redo-alt text-gray-500 cursor-pointer hover:text-[#1976d2]"></i>
                                        <button
                                            class="bg-[#009688] hover:bg-[#00796b] text-white font-medium py-1.5 px-4 rounded shadow-sm text-[13px] uppercase flex items-center gap-2">
                                            <span class="text-lg leading-none">+</span> TAMBAH DATA
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div style="padding: 0 24px 24px 24px;">
                                <div class="w-full border-t border-gray-200">
                                    <div class="bg-[#e3f2fd] flex py-3 px-4">
                                        <div class="flex-1 font-bold text-[13px] text-black">Nama Organisasi</div>
                                        <div class="flex-1 font-bold text-[13px] text-black">Organisasi Induk</div>
                                        <div class="w-24 font-bold text-[13px] text-black text-right">Action</div>
                                    </div>

                                    <div class="py-6 text-center border-b border-gray-200">
                                        <p class="text-[13px] text-gray-600">Tidak ada data</p>
                                    </div>
                                </div>

                                <div class="flex justify-end items-center mt-4 text-[12px] text-gray-600 gap-4">
                                    <div class="flex items-center gap-2">
                                        <span>Rows per page:</span>
                                        <div class="flex items-center cursor-pointer">
                                            <span>8</span>
                                            <i class="fas fa-caret-down ml-1 text-gray-500"></i>
                                        </div>
                                    </div>
                                    <span>0-0 of 0</span>
                                    <div class="flex items-center gap-4">
                                        <i class="fas fa-chevron-left text-gray-300 cursor-not-allowed"></i>
                                        <i class="fas fa-chevron-right text-gray-300 cursor-not-allowed"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-sertifikat" class="edit-tab-content" style="display: none;">
                            <div style="padding: 16px 24px;">
                                <div class="flex justify-between items-center mb-6">
                                    <h2 class="text-xl font-bold text-[#1976d2]">Sertifikat Training</h2>
                                </div>
                            </div>

                            <div style="padding: 0 24px 24px 24px;">
                                <div class="w-full border-t border-gray-200">
                                    <div class="bg-[#e3f2fd] flex py-3 px-4">
                                        <div class="flex-1 font-bold text-[13px] text-black">Tanggal Training</div>
                                        <div class="flex-1 font-bold text-[13px] text-black">Nomor Surat</div>
                                        <div class="flex-1 font-bold text-[13px] text-black">Nama Staff</div>
                                        <div class="w-24 font-bold text-[13px] text-black text-right">Action</div>
                                    </div>

                                    <div class="py-6 text-center border-b border-gray-200">
                                        <p class="text-[13px] text-gray-600">Tidak ada data</p>
                                    </div>
                                </div>

                                <div class="flex justify-end items-center mt-4 text-[12px] text-gray-600 gap-4">
                                    <div class="flex items-center gap-2">
                                        <span>Rows per page:</span>
                                        <div class="flex items-center cursor-pointer">
                                            <span>8</span>
                                            <i class="fas fa-caret-down ml-1 text-gray-500"></i>
                                        </div>
                                    </div>
                                    <span>0-0 of 0</span>
                                    <div class="flex items-center gap-4">
                                        <i class="fas fa-chevron-left text-gray-300 cursor-not-allowed"></i>
                                        <i class="fas fa-chevron-right text-gray-300 cursor-not-allowed"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div id="view-edit-user" class="max-w-7xl mx-auto hidden opacity-0 transition-all duration-300">

                <div class="mb-6 mt-6">
                    <h1 class="text-[28px] font-bold text-[#1976d2]">Profile Pengguna</h1>
                    <p class="text-[#1976d2] font-normal text-[15px] mt-1">Nama Pengguna</p>
                    <div class="flex items-center text-[12px] gap-2 mt-3 font-normal">
                        <span class="text-gray-600 hover:text-[#2196f3] cursor-pointer"
                            onclick="switchView('dashboard')">Profile</span>
                        <i class="fas fa-chevron-right text-[9px] text-gray-400"></i>
                        <span class="text-gray-800">Informasi Dasar</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-6 items-start">

                    <div class="flex-1 bg-white shadow-md rounded mb-6"
                        style="box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.2), 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 3px 1px -2px rgba(0, 0, 0, 0.12);">
                        <div style="padding: 16px 16px 16px 24px;">
                            <h2 class="text-xl font-bold text-[#1976d2]">Informasi Dasar</h2>
                        </div>

                        <div
                            style="padding-left: 24px; padding-right: 24px; padding-bottom: 24px; width: calc(100% + 24px); margin: -12px; display: flex; flex-wrap: wrap; box-sizing: border-box;">

                            <div
                                style="flex-basis: 100%; max-width: 100%; display: flex; flex-wrap: wrap; box-sizing: border-box; margin: 12px;">
                                <div
                                    style="flex-basis: 33.333333%; max-width: 33.333333%; padding: 12px; box-sizing: border-box;">
                                    <p class="text-[#2196f3] text-[12px] font-medium mb-2">Foto Profil</p>
                                    <div
                                        style="position: relative; max-width: 365px; max-height: 365px; margin-top: 8px; display: flex; justify-content: center;">
                                        <div
                                            class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden border border-gray-300">
                                            <i class="fas fa-user text-6xl text-gray-400"></i>
                                        </div>
                                    </div>
                                    <p style="text-align: center;" class="text-[11px] text-[#747070] mt-4">Ukuran
                                        gambar min. 200x200px</p>
                                    <p style="text-align: center;"
                                        class="text-[#2196f3] text-[13px] font-medium cursor-pointer hover:underline mt-2">
                                        Ganti Foto</p>
                                </div>

                                <div
                                    style="flex-basis: 66.666667%; max-width: 66.666667%; padding: 12px; box-sizing: border-box;">

                                    <div style="width: 100%; display: flex; flex-wrap: wrap; margin: 12px 0;">
                                        <div style="flex-basis: 100%; max-width: 100%;">
                                            <div style="margin-top: 18px;">
                                                <label class="form-label">Nama Lengkap<span>*</span></label>
                                                <input type="text" class="input-underline" value="....">
                                            </div>
                                        </div>

                                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px;">
                                            <div style="flex-basis: 50%; max-width: 50%; padding-right: 12px;">
                                                <label class="form-label">NIK (Nomor Induk Kependudukan)
                                                    <span>*</span></label>
                                                <input type="number" class="input-underline"
                                                    value="3174092209900001">
                                            </div>
                                            <div style="flex-basis: 50%; max-width: 50%; padding-left: 12px;">
                                                <label class="form-label">Jenis Kelamin</label>
                                                <div class="relative">
                                                    <select class="input-select pr-10">
                                                        <option selected>Laki-laki</option>
                                                        <option>Perempuan</option>
                                                    </select>
                                                    <i
                                                        class="fas fa-chevron-down text-[11px] text-[#2196f3] absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px;">
                                            <div style="flex-basis: 50%; max-width: 50%; padding-right: 12px;">
                                                <label class="form-label">Nomor HP / WhatsApp <span>*</span></label>
                                                <input type="number" class="input-underline" value="081234567890">
                                            </div>
                                            <div style="flex-basis: 50%; max-width: 50%; padding-left: 12px;">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="input-underline"
                                                    value="admin@hanglekiu.com">
                                            </div>
                                        </div>


                                        <div
                                            style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                            <div style="flex: 1; min-width: 200px;">
                                                <label class="form-label">Alamat Rumah</label>
                                                <input type="text" class="input-underline"
                                                    value="Jl. Contoh Alamat No. 12, Jakarta Selatan">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div
                                style="width: 100%; display: flex; justify-content: flex-end; margin-top: 18px; padding: 12px;">
                                <button
                                    class="bg-[#f97316] hover:bg-[#ea580c] text-white font-medium py-2.5 px-8 rounded shadow text-[13px] transition transform active:scale-95 uppercase tracking-wide">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        var map;

        function initMap() {
            if (map) return;
            const mapContainer = document.getElementById('map');
            if (!mapContainer) return;

            map = L.map('map').setView([-6.2088, 106.8456], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([-6.2088, 106.8456]).addTo(map)
                .bindPopup('Lokasi Klinik')
                .openPopup();
        }

        function switchView(viewName) {
            const views = ['dashboard', 'edit', 'edit-user'];

            views.forEach(v => {
                const el = document.getElementById('view-' + v);
                if (el) {
                    el.classList.add('hidden');
                    el.classList.remove('opacity-100');
                    el.classList.add('opacity-0');
                }
            });

            const selected = document.getElementById('view-' + viewName);
            if (selected) {
                selected.classList.remove('hidden');
                setTimeout(() => {
                    selected.classList.remove('opacity-0');
                    selected.classList.add('opacity-100');
                }, 50);

                if (viewName === 'edit') {
                    switchEditTab('informasi-dasar');
                }
            }
        }

        function switchEditTab(tabName) {
            const menuItems = document.querySelectorAll('.edit-menu-item');
            menuItems.forEach(item => item.classList.remove('active'));

            const activeMenu = document.getElementById('menu-' + tabName);
            if (activeMenu) activeMenu.classList.add('active');

            const tabContents = document.querySelectorAll('.edit-tab-content');
            tabContents.forEach(content => {
                content.style.display = 'none';
            });

            const activeContent = document.getElementById('tab-' + tabName);
            if (activeContent) {
                activeContent.style.display = 'block';

                if (tabName === 'alamat') {
                    setTimeout(() => {
                        initMap();
                        if (map) map.invalidateSize();
                    }, 100);
                }
            }
        }

        window.addEventListener('load', () => {
            const barClinic = document.getElementById('progress-bar-fill');
            if (barClinic) {
                setTimeout(() => {
                    barClinic.style.width = '71%';
                }, 300);
            }

            const barUser = document.getElementById('progress-bar-user');
            if (barUser) {
                setTimeout(() => {
                    barUser.style.width = '45%';
                }, 500);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mainSidebar = document.getElementById('appSidebar');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');

            if (sidebarToggle && mainSidebar) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mainSidebar.classList.toggle('open');

                    if (sidebarBackdrop) {
                        sidebarBackdrop.classList.toggle('show');
                    }
                });

                if (sidebarBackdrop) {
                    sidebarBackdrop.addEventListener('click', function() {
                        mainSidebar.classList.remove('open');
                        sidebarBackdrop.classList.remove('show');
                    });
                }

                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && mainSidebar.classList.contains('open')) {
                        mainSidebar.classList.remove('open');
                        if (sidebarBackdrop) sidebarBackdrop.classList.remove('show');
                    }
                });
            }
        });

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
            const menu = document.getElementById('settingsMenu');
            const overlay = document.getElementById('settingsOverlay');
            if (menu) menu.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
        }
    </script>
</body>

</html>
