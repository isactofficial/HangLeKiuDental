<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function () {
    return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
})->name('password.email');

// // Demo dashboard tanpa autentikasi (untuk testing tampilan)
// Route::get('/dashboard', function () {
//     return view('dashboard-demo');
// })->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    
    // Registration (guest)
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/registration', function () {
        return view('registration');
    })->name('registration');

    // Katalog Harga Prosedur (sederhana, sementara)
    Route::get('/procedures', function (Request $request) {
        $q = trim($request->query('q', ''));

        $procedures = [
            ['name' => 'Alveolectomy', 'note' => 'Operasi kecil', 'price' => 2500000],
            ['name' => 'Cleaning (Scaling)', 'note' => 'Pembersihan karang', 'price' => 150000],
            ['name' => 'Composite Filling', 'note' => 'Tambal komposit', 'price' => 200000],
            ['name' => 'Crown', 'note' => 'Mahkota gigi', 'price' => 1200000],
            ['name' => 'Extraction', 'note' => 'Pencabutan gigi', 'price' => 300000],
            ['name' => 'Root Canal Treatment', 'note' => 'Perawatan saluran akar', 'price' => 900000],
            ['name' => 'Teeth Whitening', 'note' => 'Pemutihan', 'price' => 800000],
            ['name' => 'Veneer', 'note' => 'Lapisan tipis', 'price' => 1500000],
        ];

        // Filter by query
        if ($q !== '') {
            $procedures = array_values(array_filter($procedures, function ($p) use ($q) {
                return stripos($p['name'], $q) !== false || stripos($p['note'], $q) !== false;
            }));
        }

        // Sort alphabetically by name
        usort($procedures, function ($a, $b) {
            return strcasecmp($a['name'], $b['name']);
        });

        return view('procedures.index', compact('procedures', 'q'));
    })->name('procedures.index');

    // Electronic Medical Record page
    Route::get('/emr', function () {
        return view('emr');
    })->name('emr');
});

