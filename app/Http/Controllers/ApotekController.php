<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApotekController extends Controller
{
    public function index()
    {
        // Di sini nanti Anda bisa mengambil data obat dari database
        // $obats = Obat::all();

        return view('apotek.index');
    }
}
