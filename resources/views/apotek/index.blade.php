<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotek - Hanglekiu Dental Specialist</title>
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

        thead th {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #ffffff;
            box-shadow: 0 1px 0px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body class="bg-[#f5f9fc] text-gray-700">

    {{-- Include Sidebar --}}
    @include('partials.sidebar')

    {{-- Wrapper Utama --}}
    <div class="flex flex-col h-screen ml-[60px] transition-all duration-300">

        <!-- HEADER HALAMAN -->
        <header class="bg-white px-8 pt-4 pb-2 z-30 flex-shrink-0 shadow-sm border-b border-gray-100">
            <div class="flex justify-end items-center gap-6 mb-2">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gray-500 flex items-center justify-center text-white text-[10px] font-bold border-2 border-white shadow-sm">
                        HDS
                    </div>
                    <button class="bg-[#2196f3] hover:bg-[#1e88e5] text-white px-4 py-1.5 rounded text-[13px] font-medium flex items-center gap-2 shadow-sm transition">
                        hanglekiu dent... <i class="fas fa-chevron-down text-[10px]"></i>
                    </button>
                </div>
                <div class="flex items-center gap-5 text-gray-400">
                    <i class="fas fa-question-circle cursor-pointer hover:text-blue-600 text-lg transition"></i>
                    <i class="fas fa-bell-slash cursor-pointer hover:text-blue-600 text-lg transition"></i>
                    <i class="fas fa-user-circle text-2xl cursor-pointer hover:text-blue-600 transition"></i>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-end pb-2">
                <div>
                    <h1 class="text-[28px] font-bold text-[#1565c0] leading-tight">Apotek</h1>
                    <p class="text-[#1976d2] text-[15px]">hanglekiu dental specialist</p>
                </div>
                <div class="flex items-center gap-3 mt-4 md:mt-0">
                    <i class="fas fa-chevron-left text-blue-400 cursor-pointer text-xs p-2 hover:bg-blue-50 rounded-full"></i>
                    <div class="text-center mx-2">
                        <div class="text-[#1565c0] font-bold text-[18px] leading-tight">Jumat</div>
                        <div class="text-[#1565c0] font-bold text-[16px] leading-tight">19 Desember 2025</div>
                    </div>
                    <i class="fas fa-chevron-right text-blue-400 cursor-pointer text-xs p-2 hover:bg-blue-50 rounded-full"></i>

                    <button class="ml-4 w-9 h-9 rounded border border-blue-300 text-blue-500 flex items-center justify-center hover:bg-blue-50 transition bg-white">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 flex overflow-hidden relative">

            <!-- SUB-SIDEBAR (Menu Apotek) -->
            <div class="shrink-0 overflow-y-auto hidden md:block bg-[#f5f9fc]" style="flex-grow: 0; max-width: 16.666667%; flex-basis: 16.666667%; padding: 12px;">
                <div class="bg-white border border-gray-300 flex flex-col text-[14px] overflow-hidden">
                    <button class="block px-5 py-3.5 text-gray-700 text-left border-b border-gray-300 hover:bg-gray-50 transition">
                        <span>Antrian Hari Ini</span>
                    </button>
                    <button id="menuObat" class="block px-5 py-3.5 bg-[#2196f3] text-white text-left border-b border-[#1976d2] font-normal transition">
                        <span>Obat</span>
                    </button>
                    <button class="block px-5 py-3.5 text-gray-700 text-left border-b border-gray-300 hover:bg-gray-50 transition">
                        <span>Penggunaan Obat</span>
                    </button>
                    <button class="block px-5 py-3.5 text-gray-700 text-left border-b border-gray-300 hover:bg-gray-50 transition">
                        <span>Kedaluwarsa Obat</span>
                    </button>
                    <button id="menuBHP" class="block px-5 py-3.5 text-gray-700 text-left border-b border-gray-300 hover:bg-gray-50 transition">
                        <span>Bahan Habis Pakai</span>
                    </button>
                    <button class="block px-5 py-3.5 text-gray-700 text-left border-b border-gray-300 hover:bg-gray-50 transition">
                        <span>Penggunaan BHP</span>
                    </button>
                    <button class="block px-5 py-3.5 text-gray-700 text-left border-b border-gray-300 hover:bg-gray-50 transition leading-snug">
                        <span>Kedaluwarsa Bahan Habis Pakai</span>
                    </button>
                    <button class="block px-5 py-3.5 text-gray-700 text-left border-b border-gray-300 hover:bg-gray-50 transition">
                        <span>Resep Obat</span>
                    </button>
                    <button class="block px-5 py-3.5 text-gray-700 text-left border-b border-gray-300 hover:bg-gray-50 transition">
                        <span>Restock / Return</span>
                    </button>
                    <button class="block px-5 py-3.5 text-gray-700 text-left border-b border-gray-300 hover:bg-gray-50 transition">
                        <span>Depot</span>
                    </button>
                    <button class="block px-5 py-3.5 text-gray-700 text-left hover:bg-gray-50 transition">
                        <span>Pesanan & Stok Masuk</span>
                    </button>
                </div>
            </div>

            <!-- AREA CARD DATA -->
            <div class="flex-1 p-6 overflow-hidden flex flex-col bg-[#f5f9fc]">

                <div class="bg-white rounded shadow-sm border border-gray-200 flex flex-col h-full">

                    <!-- HALAMAN OBAT -->
                    <div id="pageObat">
                        <!-- TOOLBAR -->
                        <div class="px-6 pt-5 pb-4">
                            <div class="flex items-center justify-between gap-4 mb-4">
                                <div class="flex-shrink-0">
                                    <h2 class="text-[20px] font-semibold text-[#2196f3]">Data Stok Obat</h2>
                                </div>

                                <div class="flex items-center gap-3 flex-1 justify-end">
                                    <div class="relative w-full max-w-[380px]">
                                        <input type="text" placeholder="Cari kode, nama obat atau kategori"
                                            class="w-full pl-4 pr-10 py-2.5 border border-gray-300 rounded text-[14px] text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400 transition h-[42px]">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-500">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                                        </div>
                                    </div>

                                    <button class="bg-[#009688] hover:bg-[#00796b] text-white px-5 py-2.5 rounded text-[14px] font-medium flex items-center justify-center gap-2 transition shadow-sm whitespace-nowrap h-[42px]">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path></svg>
                                        Tambah Data Obat
                                    </button>

                                    <div class="flex items-center h-[42px]" style="padding-left: 10px;">
                                        <button class="bg-[#009688] hover:bg-[#00796b] text-white pl-5 pr-3 py-2.5 rounded-l text-[14px] font-medium flex items-center justify-center transition shadow-sm whitespace-nowrap h-full">
                                            Export Excel
                                        </button>
                                        <button class="bg-[#009688] hover:bg-[#00796b] text-white px-2 py-2.5 rounded-r text-[14px] font-medium flex items-center justify-center transition shadow-sm border-l border-white/20 h-full">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-[13px] text-gray-600 font-normal">Last Update</h3>
                            </div>
                        </div>

                        <!-- TABLE CONTAINER -->
                        <div class="flex-1 custom-scroll relative overflow-auto">
                            <table class="w-full text-left border-collapse min-w-[1500px]">
                                <thead class="text-[#555] text-[14px] font-medium border-y border-gray-200">
                                    <tr>
                                        <th class="py-3.5 px-4 bg-white sticky left-0 z-20">
                                            <input type="checkbox" class="w-4 h-4 text-blue-600 rounded border-gray-300">
                                        </th>

                                        <th class="py-3.5 px-4 bg-white">Kode</th>
                                        <th class="py-3.5 px-4 bg-white">Nama Obat</th>
                                        <th class="py-3.5 px-4 bg-white">Farmasi</th>
                                        <th class="py-3.5 px-4 bg-white">Jenis</th>
                                        <th class="py-3.5 px-4 bg-white">Kategori</th>
                                        <th class="py-3.5 px-4 bg-white">Stok</th>

                                        <th class="py-3.5 px-4 whitespace-nowrap bg-white">
                                            <div class="flex items-center gap-1.5">
                                                Harga Umum
                                                <svg class="w-[18px] h-[18px] text-gray-400 cursor-pointer hover:text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z"/></svg>
                                            </div>
                                        </th>

                                        <th class="py-3.5 px-4 whitespace-nowrap bg-white">
                                            <div class="flex items-center gap-1.5">
                                                Harga Beli
                                                <svg class="w-[18px] h-[18px] text-gray-400 cursor-pointer hover:text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z"/></svg>
                                            </div>
                                        </th>

                                        <th class="py-3.5 px-4 bg-white">Avg HPP</th>
                                        <th class="py-3.5 px-4 bg-white">Harga OTC</th>
                                        <th class="py-3.5 px-4 bg-white">Margin Profit</th>
                                        <th class="py-3.5 px-4 bg-white"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="13" class="py-20 text-center text-gray-600 text-[14px] font-normal">
                                            Tidak ada data obat yang bisa ditampilkan.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION FOOTER -->
                        <div class="px-5 py-3 border-t border-gray-200 flex items-center justify-end gap-8 text-[13px] text-gray-600 bg-white z-20">
                            <div class="flex items-center gap-2">
                                <span>Jumlah baris per halaman:</span>
                                <div class="relative flex items-center cursor-pointer">
                                    <span class="mr-7 text-gray-700 font-normal">10</span>
                                    <svg class="w-5 h-5 text-gray-500 absolute right-0 pointer-events-none" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"></path></svg>
                                </div>
                            </div>
                            <div>0-0 dari 0 data</div>
                            <div class="flex items-center gap-5">
                                <button class="text-gray-300 cursor-not-allowed" disabled>
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M15.41 16.09l-4.58-4.59 4.58-4.59L14 5.5l-6 6 6 6z"></path></svg>
                                </button>
                                <button class="text-gray-300 cursor-not-allowed" disabled>
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- HALAMAN BAHAN HABIS PAKAI -->
                    <div id="pageBHP" class="hidden">
                        <!-- TOOLBAR BHP -->
                        <div class="px-6 pt-5 pb-4">
                            <div class="flex items-center justify-between gap-4 mb-4">
                                <div class="flex-shrink-0">
                                    <h2 class="text-[20px] font-semibold text-[#2196f3]">Data Stok Bahan Habis Pakai</h2>
                                </div>

                                <div class="flex items-center gap-3 flex-1 justify-end">
                                    <div class="relative w-full max-w-[380px]">
                                        <input type="text" placeholder="Cari bahan habis pakai"
                                            class="w-full pl-4 pr-10 py-2.5 border border-gray-300 rounded text-[14px] text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400 transition h-[42px]">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-500">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                                        </div>
                                    </div>

                                    <button class="bg-[#009688] hover:bg-[#00796b] text-white px-5 py-2.5 rounded text-[14px] font-medium flex items-center justify-center gap-2 transition shadow-sm whitespace-nowrap h-[42px]">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path></svg>
                                        Tambah Data Barang
                                    </button>

                                    <div class="flex items-center h-[42px]" style="padding-left: 10px;">
                                        <button class="bg-[#009688] hover:bg-[#00796b] text-white pl-5 pr-3 py-2.5 rounded-l text-[14px] font-medium flex items-center justify-center transition shadow-sm whitespace-nowrap h-full">
                                            Export Excel
                                        </button>
                                        <button class="bg-[#009688] hover:bg-[#00796b] text-white px-2 py-2.5 rounded-r text-[14px] font-medium flex items-center justify-center transition shadow-sm border-l border-white/20 h-full">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-[13px] text-gray-600 font-normal">Last Update</h3>
                            </div>
                        </div>

                        <!-- TABLE CONTAINER BHP -->
                        <div class="flex-1 custom-scroll relative overflow-auto">
                            <table class="w-full text-left border-collapse min-w-[1400px]">
                                <thead class="text-[#555] text-[14px] font-medium border-y border-gray-200">
                                    <tr>
                                        <th class="py-3.5 px-4 bg-white sticky left-0 z-20">
                                            <input type="checkbox" class="w-4 h-4 text-blue-600 rounded border-gray-300">
                                        </th>

                                        <th class="py-3.5 px-4 bg-white">Kode</th>
                                        <th class="py-3.5 px-4 bg-white">Nama Barang</th>
                                        <th class="py-3.5 px-4 bg-white">Brand</th>
                                        <th class="py-3.5 px-4 bg-white">Stok</th>

                                        <th class="py-3.5 px-4 whitespace-nowrap bg-white">
                                            <div class="flex items-center gap-1.5">
                                                Harga Umum
                                                <svg class="w-[18px] h-[18px] text-gray-400 cursor-pointer hover:text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z"/></svg>
                                            </div>
                                        </th>

                                        <th class="py-3.5 px-4 whitespace-nowrap bg-white">
                                            <div class="flex items-center gap-1.5">
                                                Harga Beli
                                                <svg class="w-[18px] h-[18px] text-gray-400 cursor-pointer hover:text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z"/></svg>
                                            </div>
                                        </th>

                                        <th class="py-3.5 px-4 bg-white">Avg HPP</th>
                                        <th class="py-3.5 px-4 bg-white">Harga OTC</th>
                                        <th class="py-3.5 px-4 bg-white">Margin Profit</th>
                                        <th class="py-3.5 px-4 bg-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="11" class="py-20 text-center text-gray-600 text-[14px] font-normal">
                                            Tidak ada data bahan habis pakai yang bisa ditampilkan.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="px-5 py-3 border-t border-gray-200 flex items-center justify-end gap-8 text-[13px] text-gray-600 bg-white z-20">
                            <div class="flex items-center gap-2">
                                <span>Jumlah baris per halaman:</span>
                                <div class="relative flex items-center cursor-pointer">
                                    <span class="mr-7 text-gray-700 font-normal">10</span>
                                    <svg class="w-5 h-5 text-gray-500 absolute right-0 pointer-events-none" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"></path></svg>
                                </div>
                            </div>
                            <div>0-0 dari 0 data</div>
                            <div class="flex items-center gap-5">
                                <button class="text-gray-300 cursor-not-allowed" disabled>
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M15.41 16.09l-4.58-4.59 4.58-4.59L14 5.5l-6 6 6 6z"></path></svg>
                                </button>
                                <button class="text-gray-300 cursor-not-allowed" disabled>
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <script>
        const menuObat = document.getElementById('menuObat');
        const menuBHP = document.getElementById('menuBHP');
        const pageObat = document.getElementById('pageObat');
        const pageBHP = document.getElementById('pageBHP');
        menuObat.addEventListener('click', function() {
            pageObat.classList.remove('hidden');
            pageBHP.classList.add('hidden');

            menuObat.classList.remove('text-gray-700', 'hover:bg-gray-50', 'border-gray-300');
            menuObat.classList.add('bg-[#2196f3]', 'text-white', 'border-[#1976d2]');

            menuBHP.classList.remove('bg-[#2196f3]', 'text-white', 'border-[#1976d2]');
            menuBHP.classList.add('text-gray-700', 'hover:bg-gray-50', 'border-gray-300');
        });

        menuBHP.addEventListener('click', function() {
            pageBHP.classList.remove('hidden');
            pageObat.classList.add('hidden');

            menuBHP.classList.remove('text-gray-700', 'hover:bg-gray-50', 'border-gray-300');
            menuBHP.classList.add('bg-[#2196f3]', 'text-white', 'border-[#1976d2]');

            menuObat.classList.remove('bg-[#2196f3]', 'text-white', 'border-[#1976d2]');
            menuObat.classList.add('text-gray-700', 'hover:bg-gray-50', 'border-gray-300');
        });
    </script>
