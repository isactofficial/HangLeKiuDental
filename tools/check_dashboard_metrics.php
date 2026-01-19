<?php

// Usage: php tools/check_dashboard_metrics.php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$now = now();
$monthStart = $now->copy()->startOfMonth();
$monthEnd = $now->copy()->endOfMonth();
$prevMonthStart = $now->copy()->subMonthNoOverflow()->startOfMonth();
$prevMonthEnd = $now->copy()->subMonthNoOverflow()->endOfMonth();

$today = $now->toDateString();
$yesterday = $now->copy()->subDay()->toDateString();

$computeChange = function (int|float $current, int|float $previous): array {
    $pct = 0.0;
    $dir = 'up';
    if ($previous > 0) {
        $pct = (($current - $previous) / $previous) * 100;
        $dir = $pct >= 0 ? 'up' : 'down';
    } elseif ($current > 0) {
        $pct = 100.0;
        $dir = 'up';
    }

    return [$pct, $dir];
};

$total = \App\Models\Appointment::query()->count();

// Visits
$visitsThisMonth = \App\Models\Appointment::query()->whereBetween('start_at', [$monthStart, $monthEnd])->count();
$visitsPrevMonth = \App\Models\Appointment::query()->whereBetween('start_at', [$prevMonthStart, $prevMonthEnd])->count();
[$visitChangePct, $visitChangeDir] = $computeChange($visitsThisMonth, $visitsPrevMonth);

$visitsToday = \App\Models\Appointment::query()->whereDate('start_at', $today)->count();
$visitsYesterday = \App\Models\Appointment::query()->whereDate('start_at', $yesterday)->count();
[$todayChangePct, $todayChangeDir] = $computeChange($visitsToday, $visitsYesterday);

// Patients
$patientsTotal = (int) (\App\Models\Appointment::query()
    ->selectRaw('COUNT(DISTINCT COALESCE(medical_record_number, patient_name)) as c')
    ->value('c') ?? 0);

$patientsTotalPrev = (int) (\App\Models\Appointment::query()
    ->where('start_at', '<=', $prevMonthEnd)
    ->selectRaw('COUNT(DISTINCT COALESCE(medical_record_number, patient_name)) as c')
    ->value('c') ?? 0);

[$patientsTotalChangePct, $patientsTotalChangeDir] = $computeChange($patientsTotal, $patientsTotalPrev);

// New patients (same definition as dashboard: first_created_at in month)
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

[$newPatientsChangePct, $newPatientsChangeDir] = $computeChange($newPatientsThisMonth, $newPatientsPrevMonth);

$rowsThisMonth = \App\Models\Appointment::query()
    ->whereBetween('start_at', [$monthStart, $monthEnd])
    ->get(['id', 'start_at', 'end_at', 'duration_minutes', 'status']);

$rowsThisMonthWithEnd = $rowsThisMonth->filter(fn ($a) => !empty($a->end_at));

$avgSeconds = (int) round((float) $rowsThisMonth->avg(function ($a) {
    try {
        if ($a->end_at) {
            return $a->start_at ? $a->start_at->diffInSeconds($a->end_at) : 0;
        }
        if (!empty($a->duration_minutes)) {
            return (int) $a->duration_minutes * 60;
        }
    } catch (Throwable $e) {
        // ignore
    }

    return 0;
}));

$rowsPrevMonth = \App\Models\Appointment::query()
    ->whereBetween('start_at', [$prevMonthStart, $prevMonthEnd])
    ->get(['id', 'start_at', 'end_at', 'duration_minutes', 'status']);

$avgPrevSeconds = (int) round((float) $rowsPrevMonth->avg(function ($a) {
    try {
        if ($a->end_at) {
            return $a->start_at ? $a->start_at->diffInSeconds($a->end_at) : 0;
        }
        if (!empty($a->duration_minutes)) {
            return (int) $a->duration_minutes * 60;
        }
    } catch (Throwable $e) {
        // ignore
    }

    return 0;
}));

[$avgDurationChangePct, $avgDurationChangeDir] = $computeChange($avgSeconds, $avgPrevSeconds);

echo "now={$now->toDateTimeString()}\n";
echo "monthStart={$monthStart->toDateTimeString()}\n";
echo "monthEnd={$monthEnd->toDateTimeString()}\n\n";

echo "prevMonthStart={$prevMonthStart->toDateTimeString()}\n";
echo "prevMonthEnd={$prevMonthEnd->toDateTimeString()}\n\n";

echo "appointments_total={$total}\n";
echo "appointments_this_month={$rowsThisMonth->count()}\n";
echo "appointments_this_month_with_end_at={$rowsThisMonthWithEnd->count()}\n";
echo "avg_duration_seconds={$avgSeconds}\n";
echo "avg_duration_prev_seconds={$avgPrevSeconds}\n";
echo "avg_duration_change_pct=" . number_format(abs((float) $avgDurationChangePct), 2) . "% dir={$avgDurationChangeDir}\n\n";

echo "visits_this_month={$visitsThisMonth}\n";
echo "visits_prev_month={$visitsPrevMonth}\n";
echo "visits_change_pct=" . number_format(abs((float) $visitChangePct), 2) . "% dir={$visitChangeDir}\n\n";

echo "visits_today={$visitsToday}\n";
echo "visits_yesterday={$visitsYesterday}\n";
echo "today_change_pct=" . number_format(abs((float) $todayChangePct), 2) . "% dir={$todayChangeDir}\n\n";

echo "patients_total={$patientsTotal}\n";
echo "patients_total_prev={$patientsTotalPrev}\n";
echo "patients_total_change_pct=" . number_format(abs((float) $patientsTotalChangePct), 2) . "% dir={$patientsTotalChangeDir}\n\n";

echo "new_patients_this_month={$newPatientsThisMonth}\n";
echo "new_patients_prev_month={$newPatientsPrevMonth}\n";
echo "new_patients_change_pct=" . number_format(abs((float) $newPatientsChangePct), 2) . "% dir={$newPatientsChangeDir}\n\n";

echo "Sample (up to 5):\n";
foreach ($rowsThisMonth->take(5) as $a) {
    $start = $a->start_at ? $a->start_at->toDateTimeString() : 'null';
    $end = $a->end_at ? $a->end_at->toDateTimeString() : 'null';
    echo "- id={$a->id} status={$a->status} start_at={$start} end_at={$end} duration_minutes={$a->duration_minutes}\n";
}
