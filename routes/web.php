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
use App\Http\Controllers\EMRController;

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

    // Admin-only pages
    Route::middleware(\App\Http\Middleware\IsAdmin::class)->group(function () {
        Route::get('/registration', function () {
            $date = request()->query('date', now()->toDateString());
            $dateFrom = request()->query('date_from');
            $dateTo = request()->query('date_to');
            $selectedDoctorId = request()->query('doctor');
            $selectedPayment = request()->query('payment');
            $selectedPoli = request()->query('poli');
            $q = trim((string) request()->query('q', ''));

            $appointments = \App\Models\Appointment::with('doctor')
                ->when($dateFrom || $dateTo, function ($query) use ($dateFrom, $dateTo) {
                    $from = $dateFrom ?: $dateTo;
                    $to = $dateTo ?: $dateFrom;

                    if ($from && $to && $from > $to) {
                        [$from, $to] = [$to, $from];
                    }

                    return $query
                        ->when($from, fn($q) => $q->whereDate('start_at', '>=', $from))
                        ->when($to, fn($q) => $q->whereDate('start_at', '<=', $to));
                }, function ($query) use ($date) {
                    return $query->whereDate('start_at', $date);
                })
                ->when($selectedDoctorId, function ($query, $doctorId) {
                    return $query->where('doctor_id', $doctorId);
                })
                ->when($selectedPayment, function ($query, $payment) {
                    return $query->where('payment_method', $payment);
                })
                ->when($selectedPoli, function ($query, $poli) {
                    // For now, only 'Gigi' clinic exists; 'Umum' yields no results
                    if (strcasecmp((string) $poli, 'Umum') === 0) {
                        return $query->whereRaw('1=0');
                    }
                    return $query; // 'Gigi' or others: no additional filter
                })
                ->when($q !== '', function ($query) use ($q) {
                    $like = "%" . str_replace(["%","_"], ["\\%","\\_"], $q) . "%";
                    return $query->where(function ($sub) use ($like) {
                        $sub->where('patient_name', 'like', $like)
                            ->orWhere('code', 'like', $like)
                            ->orWhere('medical_record_number', 'like', $like);
                    });
                })
                ->orderBy('start_at')
                ->get();

            $doctors = \App\Models\Doctor::orderBy('name')->get();

            return view('registration', compact('appointments', 'doctors', 'date', 'dateFrom', 'dateTo', 'selectedDoctorId', 'selectedPayment', 'selectedPoli', 'q'));
        })->name('registration');

        // Export Registration list (CSV) with current filters
        Route::get('/registration/export', function (Request $request) {
            $date = $request->query('date', now()->toDateString());
            $dateFrom = $request->query('date_from');
            $dateTo = $request->query('date_to');
            $selectedDoctorId = $request->query('doctor');
            $selectedPayment = $request->query('payment');
            $selectedPoli = $request->query('poli');
            $q = trim((string) $request->query('q', ''));

            $appointments = \App\Models\Appointment::with('doctor')
                ->when($dateFrom || $dateTo, function ($query) use ($dateFrom, $dateTo) {
                    $from = $dateFrom ?: $dateTo;
                    $to = $dateTo ?: $dateFrom;

                    if ($from && $to && $from > $to) {
                        [$from, $to] = [$to, $from];
                    }

                    return $query
                        ->when($from, fn($q) => $q->whereDate('start_at', '>=', $from))
                        ->when($to, fn($q) => $q->whereDate('start_at', '<=', $to));
                }, function ($query) use ($date) {
                    return $query->whereDate('start_at', $date);
                })
                ->when($selectedDoctorId, function ($query, $doctorId) {
                    return $query->where('doctor_id', $doctorId);
                })
                ->when($selectedPayment, function ($query, $payment) {
                    return $query->where('payment_method', $payment);
                })
                ->when($selectedPoli, function ($query, $poli) {
                    if (strcasecmp((string) $poli, 'Umum') === 0) {
                        return $query->whereRaw('1=0');
                    }
                    return $query;
                })
                ->when($q !== '', function ($query) use ($q) {
                    $like = "%" . str_replace(["%","_"], ["\\%","\\_"], $q) . "%";
                    return $query->where(function ($sub) use ($like) {
                        $sub->where('patient_name', 'like', $like)
                            ->orWhere('code', 'like', $like)
                            ->orWhere('medical_record_number', 'like', $like);
                    });
                })
                ->orderBy('start_at')
                ->get();

            if ($dateFrom || $dateTo) {
                $from = $dateFrom ?: $dateTo;
                $to = $dateTo ?: $dateFrom;
                if ($from && $to && $from > $to) {
                    [$from, $to] = [$to, $from];
                }
                $filename = 'registration_' . str_replace('-', '', (string) $from) . '-' . str_replace('-', '', (string) $to) . '.csv';
            } else {
                $filename = 'registration_' . str_replace('-', '', $date) . '.csv';
            }

            return response()->streamDownload(function () use ($appointments) {
                $out = fopen('php://output', 'w');
                // CSV Header
                fputcsv($out, [
                    'Status',
                    'Tanggal Kunjungan',
                    'Tanggal Dibuat',
                    'Poli',
                    'Nama Pasien',
                    'Rencana Tindakan',
                    'Rencana Paket',
                    'Tenaga Medis',
                    'Tipe Bayar',
                    'Rujuk BPJS',
                ]);

                foreach ($appointments as $a) {
                    $statusRaw = strtolower((string) ($a->status ?? ''));
                    $statusText = $a->status ? ucfirst($statusRaw) : '-';
                    $visitAt = $a->start_at ? \Carbon\Carbon::parse($a->start_at)->format('d/m/Y, H:i') : '-';
                    $createdAt = $a->created_at ? \Carbon\Carbon::parse($a->created_at)->format('d/m/Y') : '-';
                    $poli = 'Gigi';

                    $patientName = \Illuminate\Support\Str::title(preg_replace('/\s+/', ' ', trim((string) ($a->patient_name ?? ''))));
                    $mr = $a->medical_record_number ?: '-';
                    $ageText = null;
                    if (!empty($a->patient_birth_date)) {
                        $ageYears = \Carbon\Carbon::parse($a->patient_birth_date)->age;
                        $ageText = $ageYears . ' Tahun';
                    }
                    $pieces = array_filter([$patientName, $mr !== '-' ? $mr : null, $ageText]);
                    $patientCell = !empty($pieces) ? implode(', ', $pieces) : '-';

                    $procedure = $a->procedure ?: '-';
                    $doctorName = $a->doctor?->name ?: '-';
                    $payment = $a->payment_method ?: 'Langsung';
                    $isBpjs = strcasecmp((string) $payment, 'BPJS') === 0 ? 'Ya' : '-';

                    fputcsv($out, [
                        $statusText,
                        $visitAt,
                        $createdAt,
                        $poli,
                        $patientCell,
                        $procedure,
                        '-', // Rencana Paket placeholder
                        $doctorName,
                        $payment,
                        $isBpjs,
                    ]);
                }
                fclose($out);
            }, $filename, [
                'Content-Type' => 'text/csv; charset=UTF-8',
            ]);
        })->name('registration.export');

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
        Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('/emr', [EMRController::class, 'index'])->name('emr');
        Route::get('/emr/patient/{patientId}', [EMRController::class, 'show'])->name('emr.show');
        Route::put('/emr/patient/{patientId}', [EMRController::class, 'update'])->name('emr.update');
    });


        // Halaman Kasir
        Route::get('/cashier', function (Request $request) {
            $dateFrom = $request->query('date_from');
            $dateTo = $request->query('date_to');
            $q = trim((string) $request->query('q', ''));

            $appointments = \App\Models\Appointment::with('doctor')
                ->when($dateFrom || $dateTo, function ($query) use ($dateFrom, $dateTo) {
                    $from = $dateFrom ?: $dateTo;
                    $to = $dateTo ?: $dateFrom;

                    if ($from && $to && $from > $to) {
                        [$from, $to] = [$to, $from];
                    }

                    return $query
                        ->when($from, fn($q) => $q->whereDate('start_at', '>=', $from))
                        ->when($to, fn($q) => $q->whereDate('start_at', '<=', $to));
                }, function ($query) {
                    return $query->whereDate('start_at', now()->toDateString());
                })
                ->when($q !== '', function ($query) use ($q) {
                    $like = "%" . str_replace(["%", "_"], ["\\%", "\\_"], $q) . "%";
                    return $query->where(function ($sub) use ($like) {
                        $sub->where('patient_name', 'like', $like)
                            ->orWhere('code', 'like', $like)
                            ->orWhere('medical_record_number', 'like', $like)
                            ->orWhere('procedure', 'like', $like)
                            ->orWhereHas('doctor', function ($dq) use ($like) {
                                $dq->where('name', 'like', $like);
                            });
                    });
                })
                ->orderByDesc('start_at')
                ->limit(200)
                ->get();

            return view('cashier', compact('appointments', 'dateFrom', 'dateTo', 'q'));
        })->name('cashier');

        // Rawat Jalan schedule page
        Route::get('/rawat-jalan', function () {
            $doctors = \App\Models\Doctor::orderBy('id')->get();
            return view('rawat-jalan', compact('doctors'));
        })->name('rawat.jalan');

        // Appointments API for schedule (returns JSON)
        Route::get('/appointments', [BookingController::class, 'index'])->name('appointments.index');

        
        // Update appointment status
        Route::post('/appointments/{id}/status', [BookingController::class, 'updateStatus'])->name('appointments.updateStatus');
    });

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

