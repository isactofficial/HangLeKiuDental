<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Klinik - Assist.id Clone</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f9fc;
            color: #334155;
            font-size: 13px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background-color: #f0f0f0; border-radius: 3px; }
        ::-webkit-scrollbar-thumb { background-color: #b0b0b0; border-radius: 3px; }

        /* Form Styling */
        .form-label {
            display: block;
            color: #2196f3;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 8px;
            text-transform: capitalize;
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
            border: 1px solid #2196f3;
            border-radius: 4px;
            padding: 10px 12px;
            font-size: 14px;
            color: #2196f3;
            background-color: #fff;
            outline: none;
            cursor: pointer;
            appearance: none;
        }

        /* Sidebar Menu Styling */
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
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-[#f5f7fa]">

    <aside class="w-16 bg-[#2c5ea8] flex flex-col items-center py-4 text-white z-20 shadow-xl shrink-0">
        <div class="mb-6 bg-white rounded p-1 cursor-pointer hover:scale-105 transition shadow-sm">
            <i class="fas fa-plus-square text-[#2c5ea8] text-xl block"></i>
        </div>
        <div class="flex flex-col w-full gap-1">
            <div class="w-full text-center py-3 cursor-pointer text-blue-200 hover:text-white border-l-[3px] border-transparent hover:border-white transition-all" title="Dashboard"><i class="fas fa-th-large text-lg"></i></div>
            <div class="w-full text-center py-3 cursor-pointer text-blue-200 hover:text-white border-l-[3px] border-transparent hover:border-white transition-all" title="Jadwal"><i class="far fa-calendar-check text-lg"></i></div>
            <div class="w-full text-center py-3 cursor-pointer text-blue-200 hover:text-white border-l-[3px] border-transparent hover:border-white transition-all" title="Pasien"><i class="fas fa-users text-lg"></i></div>
            <div class="w-full text-center py-3 cursor-pointer text-white bg-[#1e4276] border-l-[3px] border-white transition-all" title="Klinis"><i class="fas fa-user-md text-lg"></i></div>
            <div class="w-full text-center py-3 cursor-pointer text-blue-200 hover:text-white border-l-[3px] border-transparent hover:border-white transition-all" title="Farmasi"><i class="fas fa-pills text-lg"></i></div>
            <div class="w-full text-center py-3 cursor-pointer text-blue-200 hover:text-white border-l-[3px] border-transparent hover:border-white transition-all" title="Kasir"><i class="fas fa-cash-register text-lg"></i></div>
        </div>
        <div class="mt-auto mb-4 w-full text-center space-y-4 pt-4 border-t border-blue-400/30">
            <i class="fas fa-headset text-blue-200 hover:text-white cursor-pointer block text-lg transition-colors"></i>
            <i class="fas fa-file-alt text-blue-200 hover:text-white cursor-pointer block text-lg transition-colors"></i>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-[#f5f7fa]">

        <header class="bg-white h-16 flex items-center justify-between px-8 z-10 flex-shrink-0 shadow-sm">
            <div></div>
            <div class="flex items-center gap-5 text-gray-500">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gray-500 flex items-center justify-center text-white text-[10px] font-bold border border-gray-200 shadow-sm cursor-pointer">HDS</div>
                    <button class="hidden md:flex bg-[#2196f3] hover:bg-[#1e88e5] text-white px-4 py-2 rounded text-[13px] font-medium items-center gap-2 shadow-sm transition">
                        hanglekiu dent... <i class="fas fa-chevron-down text-[10px]"></i>
                    </button>
                </div>
                <div class="flex items-center gap-4 ml-1">
                    <i class="fas fa-question-circle cursor-pointer hover:text-blue-600 text-xl transition text-gray-400"></i>
                    <i class="fas fa-bell-slash cursor-pointer hover:text-blue-600 text-xl transition text-gray-400"></i>
                    <i class="fas fa-user-circle text-2xl cursor-pointer hover:text-blue-600 transition text-gray-400"></i>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto px-10 pb-10 relative">

            <div id="view-dashboard" class="max-w-[1400px] mx-auto transition-all duration-300">
                <div class="mb-4 mt-6">
                    <h1 class="text-[28px] font-bold text-[#1976d2] tracking-tight">Profile</h1>
                    <p class="text-[#1976d2] font-normal text-[15px] mt-1">hanglekiu dental specialist</p>
                </div>
                <div class="flex flex-col lg:flex-row items-center gap-12 min-h-[450px]">
                    <div class="w-full lg:w-[55%] flex justify-center lg:justify-start items-center pl-0 lg:pl-4">
                        <img src="assets/Profil.png" alt="Faskes Illustration" class="w-full max-w-2xl object-contain">
                    </div>
                    <div class="w-full lg:w-[45%] flex flex-col justify-center h-full pt-6 pr-0 lg:pr-10">
                        <h2 class="text-[26px] lg:text-[28px] font-bold text-[#2c5ea8] leading-[1.3] mb-6">Pastikan Faskes Anda Ditemukan Masyarakat Indonesia</h2>
                        <div class="mb-8">
                            <h3 class="text-[#9ca3af] text-[13px] font-medium mb-1">Informasi Fasilitas Kesehatan</h3>
                            <p class="text-gray-500 text-[14px] leading-relaxed max-w-lg">Kelengkapan informasi faskes Anda mempengaruhi kepercayaan dan kemudahan pasien untuk menemukan Anda.</p>
                        </div>
                        <div class="w-full max-w-2xl mb-8">
                            <div class="w-full bg-[#dae0f5] rounded-full h-8 overflow-hidden">
                                <div id="progress-bar-fill" class="bg-[#74b816] h-full rounded-full transition-all duration-1000 ease-out relative" style="width: 0%"></div>
                            </div>
                            <p class="text-[12px] text-gray-600 mt-2 font-medium">Kelengkapan profil Anda 71%</p>
                        </div>
                        <div class="flex justify-end max-w-2xl">
                            <button onclick="switchView('edit')" class="bg-[#f97316] hover:bg-[#ea580c] text-white font-medium py-1.5 px-6 rounded shadow-sm text-[13px] transition transform active:scale-95">Edit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="view-edit" class="max-w-7xl mx-auto hidden opacity-0 transition-all duration-300">

                <div class="mb-6 mt-6">
                    <h1 class="text-[28px] font-bold text-[#1976d2]">Profile</h1>
                    <p class="text-[#1976d2] font-normal text-[15px] mt-1">hanglekiu dental specialist</p>
                    <div class="flex items-center text-[12px] gap-2 mt-3 font-normal">
                        <span class="text-gray-600 hover:text-[#2196f3] cursor-pointer" onclick="switchView('dashboard')">Profile</span>
                        <i class="fas fa-chevron-right text-[9px] text-gray-400"></i>
                        <span class="text-gray-800">Informasi Dasar</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-6 items-start">

                    <div class="edit-menu-container">
                        <div class="edit-menu-item active">
                            <span>Informasi Dasar</span>
                        </div>
                        <div class="edit-menu-item">
                            <span>Visi Misi</span>
                        </div>
                        <div class="edit-menu-item">
                            <span>Alamat</span>
                        </div>
                        <div class="edit-menu-item">
                            <span>Metode Pembayaran</span>
                        </div>
                        <div class="edit-menu-item">
                            <span>Photo</span>
                        </div>
                        <div class="edit-menu-item">
                            <span>Fasilitas</span>
                        </div>
                        <div class="edit-menu-item">
                            <span>Jam Operasional</span>
                        </div>
                        <div class="edit-menu-item">
                            <span>Organisasi</span>
                        </div>
                        <div class="edit-menu-item">
                            <span>Sertifikat Training</span>
                        </div>
                    </div>

                    <div class="flex-1 bg-white shadow-md rounded mb-6" style="box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.2), 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 3px 1px -2px rgba(0, 0, 0, 0.12);">
                        <div style="padding: 16px 16px 16px 24px;">
                            <h2 class="text-xl font-bold text-[#1976d2]">Informasi Dasar</h2>
                        </div>

                        <div style="padding-left: 24px; padding-right: 24px; padding-bottom: 24px; width: calc(100% + 24px); margin: -12px; display: flex; flex-wrap: wrap; box-sizing: border-box;">

                            <div style="flex-basis: 100%; max-width: 100%; display: flex; flex-wrap: wrap; box-sizing: border-box; margin: 12px;">
                                <div style="flex-basis: 33.333333%; max-width: 33.333333%; padding: 12px; box-sizing: border-box;">
                                    <p class="text-[#2196f3] text-[12px] font-medium mb-2">Logo Faskes</p>
                                    <div style="position: relative; max-width: 365px; max-height: 365px; margin-top: 8px;">
                                        <img src="assets/logo2.jpeg" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; max-height: 200px; border-radius: 50%;">
                                    </div>
                                    <p style="text-align: center;" class="text-[11px] text-[#747070] mt-4">Ukuran gambar min. 365x365px</p>
                                    <p style="text-align: center;" class="text-[#2196f3] text-[13px] font-medium cursor-pointer hover:underline mt-2">Ganti Logo</p>
                                </div>

                                <div style="flex-basis: 66.666667%; max-width: 66.666667%; padding: 12px; box-sizing: border-box;">

                                    <div style="width: 100%; display: flex; flex-wrap: wrap; margin: 12px 0;">
                                        <div style="flex-basis: 100%; max-width: 100%;">
                                            <div style="margin-top: 18px;">
                                                <label class="form-label">Nama Fasilitas Kesehatan <span>*</span></label>
                                                <input type="text" class="input-underline" value="hanglekiu dental specialist">
                                            </div>

                                            <label style="display: flex; align-items: center; margin-top: 16px; cursor: pointer;">
                                                <input type="checkbox" checked class="text-[#2196f3] rounded border-gray-300 focus:ring-[#2196f3] h-5 w-5 cursor-pointer mr-2">
                                                <span class="text-[14px] text-gray-800">Saya merupakan Owner / Management</span>
                                            </label>
                                        </div>

                                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px;">
                                            <div style="flex-basis: 50%; max-width: 50%; padding-right: 12px;">
                                                <label class="form-label">Nomor Telepon</label>
                                                <input type="number" class="input-underline" placeholder="">
                                            </div>
                                            <div style="flex-basis: 50%; max-width: 50%; padding-left: 12px; display: flex; align-items: flex-end;">
                                                <button disabled class="text-[#2196f3] text-[13px] font-medium opacity-50 cursor-not-allowed">+ Nomor Telepon</button>
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
                                            <p class="text-[11px] text-gray-600 font-medium mb-1">Link Teleconsult:</p>
                                            <p class="text-[#2196f3] text-[13px] font-medium" style="display: flex; align-items: center;">
                                                https://assist.id/hanglekiu-dental-specialist-kota-jakarta-selatan-dki-jakarta/teleconsult
                                                <i class="far fa-copy ml-2 cursor-pointer hover:text-[#1976d2]"></i>
                                            </p>
                                        </div>

                                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                            <div style="flex: 1; min-width: 200px;">
                                                <label class="form-label">Tipe Fasilitas Kesehatan <span>*</span></label>
                                                <div class="relative">
                                                    <select class="input-select pr-10">
                                                        <option>Praktek Pribadi</option>
                                                        <option>Klinik Pratama</option>
                                                    </select>
                                                    <i class="fas fa-chevron-down text-[11px] text-[#2196f3] absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                            <div style="flex: 1; min-width: 200px;">
                                                <label class="form-label">Spesialisasi <span>*</span></label>
                                                <div class="relative">
                                                    <select class="input-select pr-10">
                                                        <option>Gigi</option>
                                                        <option>Umum</option>
                                                    </select>
                                                    <i class="fas fa-chevron-down text-[11px] text-[#2196f3] absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                            <div style="flex: 1; min-width: 200px;">
                                                <label class="form-label">Kepemilikan <span>*</span></label>
                                                <div class="relative">
                                                    <select class="input-select pr-10">
                                                        <option>Swasta</option>
                                                        <option>Pemerintah</option>
                                                    </select>
                                                    <i class="fas fa-chevron-down text-[11px] text-[#2196f3] absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                            <div style="flex: 1; min-width: 200px;">
                                                <label class="form-label">Nama NPWP/KTP <span>*</span></label>
                                                <input type="text" class="input-underline" value="Dinda tegar Jelita">
                                            </div>
                                        </div>

                                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                            <div style="flex: 1; min-width: 200px;">
                                                <label class="form-label">Nomor NPWP/KTP <span>*</span></label>
                                                <input type="text" class="input-underline" value="63.709.590.2-016.000">
                                            </div>
                                        </div>

                                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                            <div style="flex: 1; min-width: 200px;">
                                                <label class="form-label">NITKU <span>*</span></label>
                                                <input type="text" class="input-underline" value="63.709.590.2-016.000">
                                            </div>
                                        </div>

                                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-top: 18px; gap: 12px;">
                                            <div style="flex: 1; min-width: 200px;">
                                                <label class="form-label">Alamat NPWP/KTP <span>*</span></label>
                                                <input type="text" class="input-underline" value="jl. Adhyaksa 9 no 1-2 rt 03 rw 05 Lebak Bulus Cilandak Kota Amd Jaksel DKI jakarta">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: 18px; padding: 12px;">
                                <button class="bg-[#f97316] hover:bg-[#ea580c] text-white font-medium py-2.5 px-8 rounded shadow text-[13px] transition transform active:scale-95 uppercase tracking-wide">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        function switchView(target) {
            const dashboard = document.getElementById('view-dashboard');
            const edit = document.getElementById('view-edit');

            if (target === 'edit') {
                dashboard.style.opacity = '0';
                setTimeout(() => {
                    dashboard.classList.add('hidden');
                    edit.classList.remove('hidden');
                    requestAnimationFrame(() => edit.style.opacity = '1');
                }, 200);
            } else {
                edit.style.opacity = '0';
                setTimeout(() => {
                    edit.classList.add('hidden');
                    dashboard.classList.remove('hidden');
                    requestAnimationFrame(() => dashboard.style.opacity = '1');
                }, 200);
            }
        }

        window.addEventListener('load', () => {
            const bar = document.getElementById('progress-bar-fill');
            if(bar) {
                setTimeout(() => {
                    bar.style.width = '71%';
                }, 300);
            }
        });
    </script>
</body>
</html>
