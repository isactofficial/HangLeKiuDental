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
use App\Http\Controllers\ProcedureController;

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
        $now = now();
        $monthStart = $now->copy()->startOfMonth();
        $monthEnd = $now->copy()->endOfMonth();
        $prevMonthStart = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $prevMonthEnd = $now->copy()->subMonthNoOverflow()->endOfMonth();

        $today = $now->toDateString();
        $yesterday = $now->copy()->subDay()->toDateString();

        $visitsThisMonth = \App\Models\Appointment::query()
            ->whereBetween('start_at', [$monthStart, $monthEnd])
            ->count();

        $visitsPrevMonth = \App\Models\Appointment::query()
            ->whereBetween('start_at', [$prevMonthStart, $prevMonthEnd])
            ->count();

        $visitsToday = \App\Models\Appointment::query()
            ->whereDate('start_at', $today)
            ->count();

        $visitsYesterday = \App\Models\Appointment::query()
            ->whereDate('start_at', $yesterday)
            ->count();

        $visitChangePct = null;
        $visitChangeDir = 'up';
        if ($visitsPrevMonth > 0) {
            $visitChangePct = (($visitsThisMonth - $visitsPrevMonth) / $visitsPrevMonth) * 100;
            $visitChangeDir = $visitChangePct >= 0 ? 'up' : 'down';
        } elseif ($visitsThisMonth > 0) {
            $visitChangePct = 100;
            $visitChangeDir = 'up';
        } else {
            $visitChangePct = 0;
            $visitChangeDir = 'up';
        }

        $todayChangePct = null;
        $todayChangeDir = 'up';
        if ($visitsYesterday > 0) {
            $todayChangePct = (($visitsToday - $visitsYesterday) / $visitsYesterday) * 100;
            $todayChangeDir = $todayChangePct >= 0 ? 'up' : 'down';
        } elseif ($visitsToday > 0) {
            $todayChangePct = 100;
            $todayChangeDir = 'up';
        } else {
            $todayChangePct = 0;
            $todayChangeDir = 'up';
        }

        // Daily visits chart (last 15 days)
        $chartFrom = $now->copy()->subDays(14)->startOfDay();
        $chartTo = $now->copy()->endOfDay();
        $dailyCounts = \App\Models\Appointment::query()
            ->whereBetween('start_at', [$chartFrom, $chartTo])
            ->selectRaw('DATE(start_at) as d, COUNT(*) as c')
            ->groupBy('d')
            ->pluck('c', 'd');

        $visitChartLabels = [];
        $visitChartData = [];
        for ($i = 14; $i >= 0; $i--) {
            $day = $now->copy()->subDays($i);
            $key = $day->toDateString();
            $visitChartLabels[] = $day->format('d/m');
            $visitChartData[] = (int) ($dailyCounts[$key] ?? 0);
        }

        // Patients (distinct by MRN, fallback to name)
        $patientsTotal = (int) (\App\Models\Appointment::query()
            ->selectRaw('COUNT(DISTINCT COALESCE(medical_record_number, patient_name)) as c')
            ->value('c') ?? 0);

        $patientsTotalPrev = (int) (\App\Models\Appointment::query()
            ->where('start_at', '<=', $prevMonthEnd)
            ->selectRaw('COUNT(DISTINCT COALESCE(medical_record_number, patient_name)) as c')
            ->value('c') ?? 0);

        $patientsTotalChangePct = null;
        $patientsTotalChangeDir = 'up';
        if ($patientsTotalPrev > 0) {
            $patientsTotalChangePct = (($patientsTotal - $patientsTotalPrev) / $patientsTotalPrev) * 100;
            $patientsTotalChangeDir = $patientsTotalChangePct >= 0 ? 'up' : 'down';
        } elseif ($patientsTotal > 0) {
            $patientsTotalChangePct = 100;
            $patientsTotalChangeDir = 'up';
        } else {
            $patientsTotalChangePct = 0;
            $patientsTotalChangeDir = 'up';
        }

        $newPatientsThisMonth = \App\Models\Appointment::query()
            ->selectRaw('COALESCE(medical_record_number, patient_name) as patient_key, MIN(created_at) as first_created_at')
            ->groupByRaw('COALESCE(medical_record_number, patient_name)')
            ->havingRaw('MIN(created_at) BETWEEN ? AND ?', [$monthStart, $monthEnd])
            ->get()
            ->count();

        $newPatientsPrevMonth = \App\Models\Appointment::query()
            ->selectRaw('COALESCE(medical_record_number, patient_name) as patient_key, MIN(created_at) as first_created_at')
            ->groupByRaw('COALESCE(medical_record_number, patient_name)')
            ->havingRaw('MIN(created_at) BETWEEN ? AND ?', [$prevMonthStart, $prevMonthEnd])
            ->get()
            ->count();

        $newPatientsChangePct = null;
        $newPatientsChangeDir = 'up';
        if ($newPatientsPrevMonth > 0) {
            $newPatientsChangePct = (($newPatientsThisMonth - $newPatientsPrevMonth) / $newPatientsPrevMonth) * 100;
            $newPatientsChangeDir = $newPatientsChangePct >= 0 ? 'up' : 'down';
        } elseif ($newPatientsThisMonth > 0) {
            $newPatientsChangePct = 100;
            $newPatientsChangeDir = 'up';
        } else {
            $newPatientsChangePct = 0;
            $newPatientsChangeDir = 'up';
        }

        // Average appointment duration (seconds)
        $durationThisMonth = \App\Models\Appointment::query()
            ->whereBetween('start_at', [$monthStart, $monthEnd])
            ->whereNotNull('end_at')
            ->select(['start_at', 'end_at'])
            ->limit(2000)
            ->get();

        $avgDurationSeconds = (int) round((float) $durationThisMonth->avg(function ($a) {
            try {
                return $a->end_at ? $a->end_at->diffInSeconds($a->start_at) : 0;
            } catch (\Throwable $e) {
                return 0;
            }
        }));

        $durationPrevMonth = \App\Models\Appointment::query()
            ->whereBetween('start_at', [$prevMonthStart, $prevMonthEnd])
            ->whereNotNull('end_at')
            ->select(['start_at', 'end_at'])
            ->limit(2000)
            ->get();

        $avgDurationPrevSeconds = (int) round((float) $durationPrevMonth->avg(function ($a) {
            try {
                return $a->end_at ? $a->end_at->diffInSeconds($a->start_at) : 0;
            } catch (\Throwable $e) {
                return 0;
            }
        }));

        $avgDurationChangePct = null;
        $avgDurationChangeDir = 'up';
        if ($avgDurationPrevSeconds > 0) {
            $avgDurationChangePct = (($avgDurationSeconds - $avgDurationPrevSeconds) / $avgDurationPrevSeconds) * 100;
            $avgDurationChangeDir = $avgDurationChangePct >= 0 ? 'up' : 'down';
        } elseif ($avgDurationSeconds > 0) {
            $avgDurationChangePct = 100;
            $avgDurationChangeDir = 'up';
        } else {
            $avgDurationChangePct = 0;
            $avgDurationChangeDir = 'up';
        }

        $formatDuration = function (int $seconds): string {
            $seconds = max(0, $seconds);
            $h = intdiv($seconds, 3600);
            $m = intdiv($seconds % 3600, 60);
            $s = $seconds % 60;
            if ($h > 0) {
                return $h . ' j ' . $m . ' m';
            }
            if ($m > 0) {
                return $m . ' m ' . $s . ' s';
            }
            return $s . ' s';
        };

        // Finance summary (use paid_amount when available)
        $revenueThisMonth = 0;
        $revenuePrevMonth = 0;
        $outstandingThisMonth = 0;
        try {
            $revenueThisMonth = (int) (\App\Models\Appointment::query()
                ->whereNotNull('paid_at')
                ->whereBetween('paid_at', [$monthStart, $monthEnd])
                ->sum('paid_amount') ?? 0);
            $revenuePrevMonth = (int) (\App\Models\Appointment::query()
                ->whereNotNull('paid_at')
                ->whereBetween('paid_at', [$prevMonthStart, $prevMonthEnd])
                ->sum('paid_amount') ?? 0);
            $outstandingThisMonth = (int) (\App\Models\Appointment::query()
                ->whereBetween('start_at', [$monthStart, $monthEnd])
                ->sum('outstanding_amount') ?? 0);
        } catch (\Throwable $e) {
            // ignore when payment columns are not present yet
        }

        $revenueChangePct = null;
        $revenueChangeDir = 'up';
        if ($revenuePrevMonth > 0) {
            $revenueChangePct = (($revenueThisMonth - $revenuePrevMonth) / $revenuePrevMonth) * 100;
            $revenueChangeDir = $revenueChangePct >= 0 ? 'up' : 'down';
        } elseif ($revenueThisMonth > 0) {
            $revenueChangePct = 100;
            $revenueChangeDir = 'up';
        } else {
            $revenueChangePct = 0;
            $revenueChangeDir = 'up';
        }

        // Donut breakdown (payment status) for current month
        $paidCount = 0;
        $partialCount = 0;
        $unpaidCount = 0;
        $cancelledCount = 0;
        try {
            $paidCount = \App\Models\Appointment::query()
                ->whereBetween('start_at', [$monthStart, $monthEnd])
                ->where('payment_status', 'paid')
                ->count();
            $partialCount = \App\Models\Appointment::query()
                ->whereBetween('start_at', [$monthStart, $monthEnd])
                ->where('payment_status', 'partial')
                ->count();
            $unpaidCount = \App\Models\Appointment::query()
                ->whereBetween('start_at', [$monthStart, $monthEnd])
                ->where('payment_status', 'unpaid')
                ->count();
        } catch (\Throwable $e) {
            // ignore
        }
        $cancelledCount = \App\Models\Appointment::query()
            ->whereBetween('start_at', [$monthStart, $monthEnd])
            ->where('status', 'cancelled')
            ->count();

        $donutLabels = ['Lunas', 'Cicilan', 'Belum Bayar', 'Batal'];
        $donutData = [$paidCount, $partialCount, $unpaidCount, $cancelledCount];

        // Queue: today's appointments
        $todayQueue = \App\Models\Appointment::with('doctor')
            ->whereDate('start_at', $today)
            ->orderBy('start_at')
            ->limit(10)
            ->get();

        $queueLastUpdate = optional($todayQueue->max('updated_at'))?->format('d/m/Y H:i');

        $doctorCount = \App\Models\Doctor::query()->count();
        $procedureCount = \App\Models\Procedure::query()->where('is_active', true)->count();

        return view('dashboard', [
            'visitsThisMonth' => $visitsThisMonth,
            'visitsPrevMonth' => $visitsPrevMonth,
            'visitChangePct' => $visitChangePct,
            'visitChangeDir' => $visitChangeDir,
            'visitsToday' => $visitsToday,
            'visitsYesterday' => $visitsYesterday,
            'todayChangePct' => $todayChangePct,
            'todayChangeDir' => $todayChangeDir,
            'visitChartLabels' => $visitChartLabels,
            'visitChartData' => $visitChartData,
            'patientsTotal' => $patientsTotal,
            'patientsTotalPrev' => $patientsTotalPrev,
            'patientsTotalChangePct' => $patientsTotalChangePct,
            'patientsTotalChangeDir' => $patientsTotalChangeDir,
            'newPatientsThisMonth' => $newPatientsThisMonth,
            'newPatientsPrevMonth' => $newPatientsPrevMonth,
            'newPatientsChangePct' => $newPatientsChangePct,
            'newPatientsChangeDir' => $newPatientsChangeDir,
            'avgDurationSeconds' => $avgDurationSeconds,
            'avgDurationPrevSeconds' => $avgDurationPrevSeconds,
            'avgDurationLabel' => $formatDuration($avgDurationSeconds),
            'avgDurationChangePct' => $avgDurationChangePct,
            'avgDurationChangeDir' => $avgDurationChangeDir,
            'revenueThisMonth' => $revenueThisMonth,
            'revenuePrevMonth' => $revenuePrevMonth,
            'revenueChangePct' => $revenueChangePct,
            'revenueChangeDir' => $revenueChangeDir,
            'outstandingThisMonth' => $outstandingThisMonth,
            'donutLabels' => $donutLabels,
            'donutData' => $donutData,
            'todayQueue' => $todayQueue,
            'queueLastUpdate' => $queueLastUpdate,
            'doctorCount' => $doctorCount,
            'procedureCount' => $procedureCount,
            'prevMonthLabel' => $prevMonthStart->translatedFormat('F'),
        ]);
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

        // Katalog Harga Prosedur
        Route::get('/procedures', [ProcedureController::class, 'index'])->name('procedures.index');
        Route::get('/procedures/create', [ProcedureController::class, 'create'])->name('procedures.create');
        Route::post('/procedures', [ProcedureController::class, 'store'])->name('procedures.store');
        Route::get('/procedures/export', [ProcedureController::class, 'export'])->name('procedures.export');
        Route::get('/procedures/import', [ProcedureController::class, 'importForm'])->name('procedures.import.form');
        Route::post('/procedures/import', [ProcedureController::class, 'import'])->name('procedures.import');

        // Electronic Medical Record page
        Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('/emr', [EMRController::class, 'index'])->name('emr');
        Route::get('/emr/patient/{patientId}', [EMRController::class, 'show'])->name('emr.show');
        Route::put('/emr/patient/{patientId}', [EMRController::class, 'update'])->name('emr.update');

        // Global patient search (for header autocomplete -> jump to EMR)
        Route::get('/patients/search', function (Request $request) {
            $q = trim((string) $request->query('q', ''));

            if (mb_strlen($q) < 2) {
                return response()->json([]);
            }

            $like = "%" . str_replace(["%", "_"], ["\\%", "\\_"], $q) . "%";

            $appointments = \App\Models\Appointment::query()
                ->select([
                    'id',
                    'patient_name',
                    'medical_record_number',
                    'patient_phone',
                    'code',
                    'start_at',
                ])
                ->where(function ($sub) use ($like) {
                    $sub->where('patient_name', 'like', $like)
                        ->orWhere('medical_record_number', 'like', $like)
                        ->orWhere('patient_phone', 'like', $like)
                        ->orWhere('code', 'like', $like);
                })
                ->orderByDesc('start_at')
                ->limit(200)
                ->get();

            $results = [];
            $seen = [];

            foreach ($appointments as $a) {
                $groupKey = (string) ($a->medical_record_number ?: $a->patient_name);
                if ($groupKey === '') {
                    continue;
                }
                if (isset($seen[$groupKey])) {
                    continue;
                }
                $seen[$groupKey] = true;

                $patientId = md5($groupKey);

                $results[] = [
                    'patient_id' => $patientId,
                    'name' => (string) ($a->patient_name ?? ''),
                    'mrn' => (string) ($a->medical_record_number ?? ''),
                    'phone' => (string) ($a->patient_phone ?? ''),
                    'last_visit' => optional($a->start_at)->format('Y-m-d H:i'),
                    'emr_url' => route('emr', ['patient' => $patientId]),
                ];

                if (count($results) >= 12) {
                    break;
                }
            }

            return response()->json($results);
        })->name('patients.search');

        // Record inputs (by appointment)
        Route::get('/emr/appointments/{appointment}/print', [EMRController::class, 'printAppointment'])->name('emr.appointments.print');
        Route::post('/emr/appointments/{appointment}/diagnoses', [EMRController::class, 'storeDiagnosis'])->name('emr.diagnoses.store');
        Route::post('/emr/appointments/{appointment}/doctor-notes', [EMRController::class, 'storeDoctorNote'])->name('emr.doctorNotes.store');
        Route::post('/emr/appointments/{appointment}/procedure-records', [EMRController::class, 'storeProcedureRecord'])->name('emr.procedureRecords.store');
        Route::post('/emr/appointments/{appointment}/odontograms', [EMRController::class, 'storeOdontogram'])->name('emr.odontograms.store');
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

            $procedures = \App\Models\Procedure::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get();

            return view('cashier', compact('appointments', 'procedures', 'dateFrom', 'dateTo', 'q'));
        })->name('cashier');

        // Export Cashier list (CSV) with current filters
        Route::get('/cashier/export', function (Request $request) {
            $dateFrom = $request->query('date_from');
            $dateTo = $request->query('date_to');
            $q = trim((string) $request->query('q', ''));

            $appointments = \App\Models\Appointment::query()
                ->with(['doctor', 'procedureRecords'])
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
                ->limit(5000)
                ->get();

            $from = $dateFrom ?: $dateTo ?: now()->toDateString();
            $to = $dateTo ?: $dateFrom ?: now()->toDateString();
            if ($from && $to && $from > $to) {
                [$from, $to] = [$to, $from];
            }

            $filename = 'cashier_' . str_replace('-', '', (string) $from) . '-' . str_replace('-', '', (string) $to) . '.csv';

            $statusLabel = function (?string $status) {
                $s = strtolower((string) ($status ?? 'unpaid'));
                if ($s === 'paid') return 'Lunas';
                if ($s === 'partial') return 'Belum Lunas';
                return 'Belum Bayar';
            };

            return response()->streamDownload(function () use ($appointments, $statusLabel) {
                $out = fopen('php://output', 'w');
                // UTF-8 BOM for Excel
                fwrite($out, "\xEF\xBB\xBF");

                fputcsv($out, [
                    'Tanggal',
                    'Invoice',
                    'Nama Lengkap Pasien',
                    'Tenaga Medis',
                    'Tindakan',
                    'Total',
                    'Status',
                ]);

                foreach ($appointments as $a) {
                    $date = $a->start_at ? \Carbon\Carbon::parse($a->start_at)->format('d/m/Y') : '';
                    $invoice = $a->code ?: ('INV' . str_pad((string) $a->id, 6, '0', STR_PAD_LEFT));
                    $doctor = $a->doctor?->name ?: '-';

                    $items = $a->procedureRecords ?: collect();
                    $total = (int) $items->sum(function (\App\Models\AppointmentProcedureRecord $r) {
                        $qty = (int) ($r->quantity ?? 1);
                        $price = (int) ($r->selling_price ?? 0);
                        $discount = (int) ($r->discount_amount ?? 0);
                        return max(0, ($qty * $price) - $discount);
                    });

                    $tindakan = '';
                    if ($items && $items->count() > 0) {
                        $tindakan = $items->pluck('name')->filter()->unique()->values()->implode(', ');
                    }
                    if ($tindakan === '') {
                        $tindakan = (string) ($a->procedure ?: '-');
                    }

                    fputcsv($out, [
                        $date,
                        $invoice,
                        (string) ($a->patient_name ?? ''),
                        $doctor,
                        $tindakan,
                        $total,
                        $statusLabel($a->payment_status),
                    ]);
                }

                fclose($out);
            }, $filename, [
                'Content-Type' => 'text/csv; charset=UTF-8',
            ]);
        })->name('cashier.export');

        // Search appointments (for cashier invoice creation)
        Route::get('/cashier/appointments/search', function (Request $request) {
            $q = trim((string) $request->query('q', ''));
            if ($q === '') {
                return response()->json(['data' => []]);
            }

            $like = "%" . str_replace(["%", "_"], ["\\%", "\\_"], $q) . "%";

            $rows = \App\Models\Appointment::query()
                ->with('doctor:id,name')
                ->where(function ($sub) use ($like) {
                    $sub->where('patient_name', 'like', $like)
                        ->orWhere('code', 'like', $like)
                        ->orWhere('medical_record_number', 'like', $like);
                })
                ->orderByDesc('start_at')
                ->limit(20)
                ->get(['id', 'code', 'patient_name', 'medical_record_number', 'start_at', 'doctor_id']);

            $data = $rows->map(function (\App\Models\Appointment $a) {
                $code = $a->code ?: ('INV' . str_pad((string) $a->id, 6, '0', STR_PAD_LEFT));
                $mr = $a->medical_record_number ? (" • " . $a->medical_record_number) : '';
                $doctor = $a->doctor?->name ? (" • " . $a->doctor->name) : '';
                $date = $a->start_at ? (" • " . \Carbon\Carbon::parse($a->start_at)->format('d/m/Y H:i')) : '';
                return [
                    'id' => $a->id,
                    'label' => $code . ' — ' . $a->patient_name . $mr . $doctor . $date,
                ];
            })->values();

            return response()->json(['data' => $data]);
        })->name('cashier.appointments.search');

        // Store invoice item (appointment_procedure_records)
        Route::post('/cashier/appointments/{appointment}/items', function (Request $request, \App\Models\Appointment $appointment) {
            $validated = $request->validate([
                'procedure_id' => ['nullable', 'integer', 'exists:procedures,id'],
                'name' => ['required', 'string', 'max:255'],
                'quantity' => ['nullable', 'integer', 'min:1', 'max:999'],
                'selling_price' => ['nullable', 'integer', 'min:0'],
                'discount_amount' => ['nullable', 'integer', 'min:0'],
                'assistant_name' => ['nullable', 'string', 'max:255'],
                'note' => ['nullable', 'string'],
            ]);

            $record = $appointment->procedureRecords()->create([
                'procedure_id' => $validated['procedure_id'] ?? null,
                'name' => $validated['name'],
                'quantity' => (int) ($validated['quantity'] ?? 1),
                'selling_price' => (int) ($validated['selling_price'] ?? 0),
                'discount_amount' => (int) ($validated['discount_amount'] ?? 0),
                'assistant_name' => $validated['assistant_name'] ?? null,
                'note' => $validated['note'] ?? null,
                'created_by_user_id' => optional(auth()->user())->id,
            ]);

            // Keep payment info consistent if invoice is edited after payment.
            // Example: invoice was "paid" then new items added -> should become "partial".
            $appointment->load(['procedureRecords']);

            $total = (int) $appointment->procedureRecords->sum(function (\App\Models\AppointmentProcedureRecord $r) {
                $qty = (int) ($r->quantity ?? 1);
                $price = (int) ($r->selling_price ?? 0);
                $discount = (int) ($r->discount_amount ?? 0);
                return max(0, ($qty * $price) - $discount);
            });

            $paidAmount = (int) ($appointment->paid_amount ?? 0);
            if ($paidAmount > 0 || !empty($appointment->paid_at)) {
                $change = (int) max(0, $paidAmount - $total);
                $outstanding = (int) max(0, $total - $paidAmount);

                $appointment->change_amount = $change;
                $appointment->outstanding_amount = $outstanding;
                if ($paidAmount <= 0) {
                    $appointment->payment_status = 'unpaid';
                } else {
                    $appointment->payment_status = $outstanding > 0 ? 'partial' : 'paid';
                }
                $appointment->save();
            }

            return response()->json([
                'ok' => true,
                'id' => $record->id,
            ]);
        })->name('cashier.items.store');

        // Update invoice item
        Route::patch('/cashier/items/{record}', function (Request $request, \App\Models\AppointmentProcedureRecord $record) {
            $validated = $request->validate([
                'name' => ['sometimes', 'string', 'max:255'],
                'quantity' => ['sometimes', 'integer', 'min:1', 'max:999'],
                'selling_price' => ['sometimes', 'integer', 'min:0'],
                'discount_amount' => ['sometimes', 'integer', 'min:0'],
            ]);

            $record->fill($validated);
            $record->save();

            // Recompute appointment payment consistency
            $appointment = $record->appointment()->first();
            if ($appointment) {
                $appointment->load(['procedureRecords']);
                $total = (int) $appointment->procedureRecords->sum(function (\App\Models\AppointmentProcedureRecord $r) {
                    $qty = (int) ($r->quantity ?? 1);
                    $price = (int) ($r->selling_price ?? 0);
                    $discount = (int) ($r->discount_amount ?? 0);
                    return max(0, ($qty * $price) - $discount);
                });

                $paidAmount = (int) ($appointment->paid_amount ?? 0);
                if ($paidAmount > 0 || !empty($appointment->paid_at)) {
                    $appointment->change_amount = (int) max(0, $paidAmount - $total);
                    $appointment->outstanding_amount = (int) max(0, $total - $paidAmount);
                    $appointment->payment_status = $paidAmount <= 0 ? 'unpaid' : ($appointment->outstanding_amount > 0 ? 'partial' : 'paid');
                    $appointment->save();
                }
            }

            return response()->json(['ok' => true]);
        })->name('cashier.items.update');

        // Delete invoice item
        Route::delete('/cashier/items/{record}', function (\App\Models\AppointmentProcedureRecord $record) {
            $appointment = $record->appointment()->first();
            $record->delete();

            if ($appointment) {
                $appointment->load(['procedureRecords']);
                $total = (int) $appointment->procedureRecords->sum(function (\App\Models\AppointmentProcedureRecord $r) {
                    $qty = (int) ($r->quantity ?? 1);
                    $price = (int) ($r->selling_price ?? 0);
                    $discount = (int) ($r->discount_amount ?? 0);
                    return max(0, ($qty * $price) - $discount);
                });

                $paidAmount = (int) ($appointment->paid_amount ?? 0);
                if ($paidAmount > 0 || !empty($appointment->paid_at)) {
                    $appointment->change_amount = (int) max(0, $paidAmount - $total);
                    $appointment->outstanding_amount = (int) max(0, $total - $paidAmount);
                    $appointment->payment_status = $paidAmount <= 0 ? 'unpaid' : ($appointment->outstanding_amount > 0 ? 'partial' : 'paid');
                    $appointment->save();
                }
            }

            return response()->json(['ok' => true]);
        })->name('cashier.items.destroy');

        // Update payment method (persist on change in modal)
        Route::patch('/cashier/appointments/{appointment}/payment-method', function (Request $request, \App\Models\Appointment $appointment) {
            $validated = $request->validate([
                'payment_method' => ['required', 'string', 'max:50'],
            ]);

            $appointment->payment_method = $validated['payment_method'];
            $appointment->save();

            return response()->json(['ok' => true, 'payment_method' => $appointment->payment_method]);
        })->name('cashier.paymentMethod.update');

        Route::get('/cashier/appointments/{appointment}/invoice', function (\App\Models\Appointment $appointment) {
            $appointment->load(['doctor', 'procedureRecords']);

            $age = null;
            if ($appointment->patient_birth_date) {
                $age = \Carbon\Carbon::parse($appointment->patient_birth_date)->age;
            }

            $items = $appointment->procedureRecords
                ->sortBy('created_at')
                ->values()
                ->map(function (\App\Models\AppointmentProcedureRecord $r) {
                    $qty = (int) ($r->quantity ?? 1);
                    $price = (int) ($r->selling_price ?? 0);
                    $discount = (int) ($r->discount_amount ?? 0);
                    $lineTotal = max(0, ($qty * $price) - $discount);

                    return [
                        'id' => $r->id,
                        'created_at' => optional($r->created_at)->toDateTimeString(),
                        'name' => (string) ($r->name ?? ''),
                        'quantity' => $qty,
                        'selling_price' => $price,
                        'discount_amount' => $discount,
                        'line_total' => $lineTotal,
                    ];
                });

            $total = (int) $items->sum('line_total');

            return response()->json([
                'appointment' => [
                    'id' => $appointment->id,
                    'code' => $appointment->code ?: ('INV' . str_pad((string) $appointment->id, 6, '0', STR_PAD_LEFT)),
                    'start_at' => optional($appointment->start_at)->toDateTimeString(),
                    'patient_name' => (string) ($appointment->patient_name ?? ''),
                    'medical_record_number' => (string) ($appointment->medical_record_number ?? ''),
                    'age' => $age,
                    'patient_phone' => (string) ($appointment->patient_phone ?? ''),
                    'doctor_name' => (string) (optional($appointment->doctor)->name ?? ''),
                    'payment_method' => (string) ($appointment->payment_method ?? ''),
                    'payment_status' => (string) ($appointment->payment_status ?? 'unpaid'),
                    'paid_amount' => (int) ($appointment->paid_amount ?? 0),
                    'paid_by' => (string) ($appointment->paid_by ?? ''),
                    'change_amount' => (int) ($appointment->change_amount ?? 0),
                    'outstanding_amount' => (int) ($appointment->outstanding_amount ?? 0),
                ],
                'items' => $items,
                'total' => $total,
            ]);
        })->name('cashier.invoice');

        // Submit payment for an appointment invoice
        Route::post('/cashier/appointments/{appointment}/pay', function (Request $request, \App\Models\Appointment $appointment) {
            $validated = $request->validate([
                'amount_paid' => ['required', 'integer', 'min:0'],
                'paid_by' => ['required', 'string', 'max:255'],
                'payment_method' => ['nullable', 'string', 'max:50'],
            ]);

            $appointment->load(['procedureRecords']);

            $items = $appointment->procedureRecords
                ->map(function (\App\Models\AppointmentProcedureRecord $r) {
                    $qty = (int) ($r->quantity ?? 1);
                    $price = (int) ($r->selling_price ?? 0);
                    $discount = (int) ($r->discount_amount ?? 0);
                    return max(0, ($qty * $price) - $discount);
                });

            $total = (int) $items->sum();
            $amountPaid = (int) $validated['amount_paid'];
            $change = (int) max(0, $amountPaid - $total);
            $outstanding = (int) max(0, $total - $amountPaid);
            $status = $outstanding > 0 ? 'partial' : 'paid';

            $appointment->payment_status = $status;
            $appointment->paid_at = now();
            $appointment->paid_amount = $amountPaid;
            $appointment->paid_by = $validated['paid_by'];
            if (!empty($validated['payment_method'])) {
                $appointment->payment_method = $validated['payment_method'];
            }
            $appointment->change_amount = $change;
            $appointment->outstanding_amount = $outstanding;
            $appointment->save();

            return response()->json([
                'ok' => true,
                'payment_status' => $appointment->payment_status,
                'total' => $total,
                'amount_paid' => $amountPaid,
                'change_amount' => $change,
                'outstanding_amount' => $outstanding,
            ]);
        })->name('cashier.pay');

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

        $doctor_mapping_warning = null;

        if(method_exists($user, 'isAdmin') && $user->isAdmin()){
            $appointments = \App\Models\Appointment::with('doctor')
                ->whereDate('start_at', $date)
                ->orderBy('start_at')
                ->get();
            $doctor = null;
            // Render the main admin dashboard but include doctor panel inside it
            return view('dashboard', ['appointments' => $appointments, 'doctor' => $doctor, 'date' => $date, 'show_doctor_panel' => true]);
        } else {
            // Preferred: explicit linkage from user -> doctor
            if (!empty($user->doctor_id)) {
                $doctor = \App\Models\Doctor::find($user->doctor_id);
                if ($doctor) {
                    $appointments = \App\Models\Appointment::with('doctor')
                        ->where('doctor_id', $doctor->id)
                        ->whereDate('start_at', $date)
                        ->orderBy('start_at')
                        ->get();

                    return view('doctor.dashboard', compact('appointments', 'doctor', 'date', 'doctor_mapping_warning'));
                }

                $doctor_mapping_warning = 'User memiliki doctor_id, tapi data dokter tidak ditemukan. Silakan set ulang dari Settings.';
            }

            $normalizeName = function ($value) {
                return \Illuminate\Support\Str::of((string) ($value ?? ''))
                    ->lower()
                    ->replaceMatches('/[^a-z0-9]+/u', '')
                    ->toString();
            };

            $userName = (string) ($user->name ?? '');
            $userKey = $normalizeName($userName);

            // Prefer a deterministic match against the doctors table, but avoid fragile exact-name checks.
            $doctors = \App\Models\Doctor::query()->get(['id', 'name']);
            $doctor = $doctors->first(function ($d) use ($normalizeName, $userKey) {
                return $normalizeName($d->name) === $userKey;
            });

            if (! $doctor && $userKey !== '') {
                // Fallback: substring match (handles prefixes like "dr" / extra spaces)
                $doctor = $doctors->first(function ($d) use ($normalizeName, $userKey) {
                    $dk = $normalizeName($d->name);
                    return $dk !== '' && (str_contains($dk, $userKey) || str_contains($userKey, $dk));
                });
            }

            if ($doctor) {
                $appointments = \App\Models\Appointment::with('doctor')
                    ->where('doctor_id', $doctor->id)
                    ->whereDate('start_at', $date)
                    ->orderBy('start_at')
                    ->get();
            } else {
                // Last-resort fallback: load daily appointments and filter by doctor name similarity.
                $daily = \App\Models\Appointment::with('doctor')
                    ->whereDate('start_at', $date)
                    ->orderBy('start_at')
                    ->get();

                $appointments = $daily->filter(function ($a) use ($normalizeName, $userKey) {
                    if ($userKey === '') {
                        return false;
                    }
                    $dk = $normalizeName(optional($a->doctor)->name);
                    return $dk !== '' && (str_contains($dk, $userKey) || str_contains($userKey, $dk));
                })->values();

                // Show the user's name in the header even if we couldn't map to a Doctor row.
                $doctor = new \App\Models\Doctor(['name' => $userName]);
                $doctor_mapping_warning = 'Akun dokter belum terhubung ke data dokter secara tepat. Sistem mencoba mencocokkan berdasarkan nama. Jika masih kosong, pastikan nama user sama dengan nama dokter di Settings.';
            }
        }

        return view('doctor.dashboard', compact('appointments', 'doctor', 'date', 'doctor_mapping_warning'));
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
        Route::post('/admin/users/{user}/doctor', [\App\Http\Controllers\AdminUserController::class, 'updateDoctor'])->name('admin.users.updateDoctor');

        // Admin-only doctor management (used on Settings page)
        Route::post('/admin/doctors', [\App\Http\Controllers\AdminDoctorController::class, 'store'])->name('admin.doctors.store');
        Route::patch('/admin/doctors/{doctor}', [\App\Http\Controllers\AdminDoctorController::class, 'update'])->name('admin.doctors.update');
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

