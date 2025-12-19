<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Menampilkan halaman Settings - Manajemen Staff
     */
    public function index()
    {
        // Simulasi data dari Database (Sesuai gambar)
        // Nanti bisa diganti dengan: $staffMembers = User::all();
        $staffMembers = [
            [
                'id' => 1,
                'name' => 'dinda tegar jelita',
                'status' => 'Aktif',
                'role' => 'Owner',
                'phone' => '**********355',
                'email' => '************************g...'
            ],
            [
                'id' => 2,
                'name' => 'drg. Maya Sp.Perio',
                'status' => 'Aktif',
                'role' => 'Doctor',
                'phone' => '**********43',
                'email' => '**********gmail.com'
            ],
            [
                'id' => 3,
                'name' => 'drg. Ria Budiati Sp.Ortho',
                'status' => 'Aktif',
                'role' => 'Owner',
                'phone' => '**********244',
                'email' => '**********yahoo.com'
            ],
            [
                'id' => 4,
                'name' => 'Sonia Novitasari',
                'status' => 'Aktif',
                'role' => 'Owner',
                'phone' => '**********3039',
                'email' => '**********gmail.com'
            ],
        ];

        return view('settings.index', compact('staffMembers'));
    }
}
