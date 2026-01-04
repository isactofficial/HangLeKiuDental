<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

class PublicPageController extends Controller
{
    public function dentists()
    {
        $doctors = Doctor::query()->orderBy('name')->get();

        return view('pages.dentists', compact('doctors'));
    }

    public function articles()
    {
        return view('pages.articles');
    }
}
