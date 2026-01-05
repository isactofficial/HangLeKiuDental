<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PublicPageController;

Route::get('/', function () {
    return view('index');
});

// Public header pages
Route::get('/our-dentists', [PublicPageController::class, 'dentists'])->name('pages.dentists');
Route::get('/artikel', [PublicPageController::class, 'articles'])->name('pages.articles');

// Public layanan & perawatan pages
Route::get('/layanan/{slug}', [LayananController::class, 'show'])
    ->where('slug', 'bleaching|gigi-tiruan|implan-gigi|orthodontics|pencabutan-gigi|perawatan-gigi-anak|perawatan-saluran-akar|scaling|tambal-gigi|veneer')
    ->name('layanan.show');

// Public booking routes (allow patients to book themselves)
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/slots', [BookingController::class, 'slots'])->name('booking.slots');


// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// // Demo dashboard tanpa autentikasi (untuk testing tampilan)
// Route::get('/dashboard', function () {
//     return view('dashboard-demo');
// })->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Google OAuth
    Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');
    
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
    
    // Registration (guest)
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware(\App\Http\Middleware\IsAdmin::class);

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

    // Halaman Kasir
    Route::get('/cashier', function() {
        return view('cashier');
    })->name('cashier');

    // Rawat Jalan schedule page
    Route::get('/rawat-jalan', function () {
        $doctors = \App\Models\Doctor::orderBy('id')->get();
        return view('rawat-jalan', compact('doctors'));
    })->name('rawat.jalan')->middleware(\App\Http\Middleware\DoctorRestrictPages::class);

    // Doctor-specific dashboard (dokter dan admin boleh mengakses)
    Route::get('/doctor-dashboard', function () {
        $user = auth()->user();
        $date = request()->query('date', now()->toDateString());

        if(method_exists($user, 'isAdmin') && $user->isAdmin()){
            $appointments = \App\Models\Appointment::with('doctor')
                ->whereDate('start_at', $date)
                ->orderBy('start_at')
                ->get();
            $doctor = null;
            // Render the main admin dashboard but include doctor panel inside it
            return view('dashboard', ['appointments' => $appointments, 'doctor' => $doctor, 'date' => $date, 'show_doctor_panel' => true]);
        } else {
            $doctor = \App\Models\Doctor::where('name', $user->name)->first();
            $appointments = $doctor
                ? \App\Models\Appointment::where('doctor_id', $doctor->id)->whereDate('start_at', $date)->orderBy('start_at')->get()
                : collect();
        }

        return view('doctor.dashboard', compact('appointments', 'doctor', 'date'));
    })->name('doctor.dashboard')->middleware(\App\Http\Middleware\IsDoctor::class);

    // Appointments API for schedule (returns JSON)
    Route::get('/appointments', [BookingController::class, 'index'])->name('appointments.index');

    // Simple profile page for authenticated users
    Route::get('/profile', function () {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    })->name('profile.show');

    // Route to reset doctor's allowed page (clear selection)
    Route::post('/doctor/reset', function () {
        session()->forget('doctor_allowed');
        return back();
    })->name('doctor.reset');
    
    // Admin-only user management
    Route::middleware(\App\Http\Middleware\IsAdmin::class)->group(function () {
        Route::get('/admin/users', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [\App\Http\Controllers\AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [\App\Http\Controllers\AdminUserController::class, 'store'])->name('admin.users.store');
        Route::post('/admin/users/{user}/role', [\App\Http\Controllers\AdminUserController::class, 'updateRole'])->name('admin.users.updateRole');
    });

    // Layanan Tambahan - AntriCepat (now as layanan.tambahan)
    Route::get('/layanan-tambahan', function () {
        return view('layanan.tambahan');
    })->name('layanan.tambahan');

    // Layanan Telekonsultasi
    Route::get('/layanan/telekonsultasi', function () {
        return view('layanan.telekonsultasi');
    })->name('layanan.telekonsultasi');

    // Layanan Add Ons
    Route::get('/layanan/add-ons', function () {
        return view('layanan.addons');
    })->name('layanan.addons');
});

