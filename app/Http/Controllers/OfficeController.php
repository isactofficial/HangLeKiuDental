<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        // Data Dummy untuk simulasi tampilan Dashboard Office
        $stats = [
            'staff_total' => 25,
            'staff_hadir' => 22,
            'izin'        => 3
        ];

        // PERBAIKAN DI SINI: Tambahkan (object) agar menjadi stdClass
        $pegawai = [
            (object)[
                'nama' => 'Drg. Andi Saputra',
                'posisi' => 'Dokter Gigi',
                'status' => 'Aktif',
                'badge' => 'bg-green-100 text-green-700'
            ],
            (object)[
                'nama' => 'Siti Aminah',
                'posisi' => 'Resepsionis',
                'status' => 'Aktif',
                'badge' => 'bg-green-100 text-green-700'
            ],
            (object)[
                'nama' => 'Budi Santoso',
                'posisi' => 'Keamanan',
                'status' => 'Cuti',
                'badge' => 'bg-yellow-100 text-yellow-700'
            ],
        ];

        return view('office.index', compact('stats', 'pegawai'));
    }
}
