<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking - Hanglekiu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        *{box-sizing:border-box}
        body{font-family:'Poppins',sans-serif;background:var(--main-bg, #f8fafc);color:var(--text, #111827);margin:0;min-height:100vh;display:flex;justify-content:center;align-items:flex-start;padding:48px 16px}
        .card{background:var(--surface, #ffffff);padding:28px;border-radius:10px;max-width:820px;width:100%;margin:0 auto;border:1px solid rgba(0,0,0,0.06);box-shadow:0 1px 4px rgba(0,0,0,0.03)}
        h2{margin:0 0 18px;font-size:26px;font-weight:700;text-align:center}
        form{display:flex;flex-direction:column;gap:14px}
        .field label{display:block;margin-bottom:8px;font-weight:600}
        input,select{width:100%;height:44px;padding:10px 12px;border-radius:8px;border:1px solid rgba(0,0,0,0.10);outline:none}
        input:focus,select:focus{border-color:rgba(0,0,0,0.25)}
        .hint{font-size:13px;color:rgba(17,24,39,0.65)}
        .schedule-box{background:rgba(0,0,0,0.03);border:1px solid rgba(0,0,0,0.06);border-radius:8px;padding:12px 14px}
        .schedule-title{font-weight:700;margin-bottom:6px}
        .schedule-row{display:flex;gap:10px;flex-wrap:wrap}
        .schedule-pill{display:inline-flex;align-items:center;padding:6px 10px;border-radius:999px;background:rgba(0,0,0,0.05);font-size:13px}
        .actions{margin-top:4px}
        button{background:var(--action, #B08D70);color:#fff;height:44px;padding:0 14px;border-radius:8px;border:none;font-weight:600;cursor:pointer;width:100%}
        .error-box{color:#b91c1c;background:rgba(185,28,28,0.08);border:1px solid rgba(185,28,28,0.18);padding:12px 14px;border-radius:8px;margin-bottom:14px}
        .error-box ul{margin:0;padding-left:18px}
    </style>
</head>
<body>
<div class="card">
    <h2>Booking Pasien</h2>
    @php
        $dayNames = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        $doctorMeta = $doctors->mapWithKeys(function ($d) use ($dayNames) {
            $days = is_array($d->practice_days) ? $d->practice_days : [];
            $daysText = collect($days)
                ->map(fn ($n) => $dayNames[(int) $n] ?? null)
                ->filter()
                ->values()
                ->implode(', ');

            $start = $d->practice_start_time ? substr((string) $d->practice_start_time, 0, 5) : null;
            $end = $d->practice_end_time ? substr((string) $d->practice_end_time, 0, 5) : null;

            return [
                $d->id => [
                    'daysText' => $daysText,
                    'start' => $start,
                    'end' => $end,
                ],
            ];
        });
    @endphp
    @if($errors->any())
        <div class="error-box">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('booking.store') }}">
        @csrf
        <div class="field">
            <label for="patient_name">Nama Pasien</label>
            <input id="patient_name" name="patient_name" value="{{ old('patient_name') }}" required>
        </div>

        <div class="field">
            <label for="doctor_id">Pilih Dokter</label>
            <select id="doctor_id" name="doctor_id" required>
                <option value="">-- Pilih Dokter --</option>
                @foreach($doctors as $d)
                    <option value="{{ $d->id }}" {{ (old('doctor_id') == $d->id || (isset($prefill['doctor_id']) && $prefill['doctor_id'] == $d->id)) ? 'selected' : '' }}>{{ $d->name }} {{ $d->specialty ? ' - '.$d->specialty : '' }}</option>
                @endforeach
            </select>
            <div class="hint" style="margin-top:8px">
                <div class="schedule-box" id="doctorScheduleBox" aria-live="polite">
                    <div class="schedule-title">Jadwal Praktek Dokter</div>
                    <div class="schedule-row">
                        <span class="schedule-pill" id="doctorScheduleDays">Hari: -</span>
                        <span class="schedule-pill" id="doctorScheduleHours">Jam: -</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="field">
            <label for="date">Tanggal</label>
            <input id="date" name="date" type="date" value="{{ old('date', $prefill['date'] ?? date('Y-m-d')) }}" required>
        </div>

        <div class="field">
            <label for="start_time">Jam Mulai (HH:MM)</label>
            <input id="start_time" name="start_time" type="time" value="{{ old('start_time', $prefill['start_time'] ?? '09:00') }}" required>
        </div>

        <div class="field">
            <label for="end_time">Jam Selesai (HH:MM)</label>
            <input id="end_time" name="end_time" type="time" value="{{ old('end_time', $prefill['end_time'] ?? '10:00') }}" required>
        </div>

        <div class="actions">
            <button type="submit">Booking Sekarang</button>
        </div>
    </form>
</div>

<script>
    (function() {
        const doctorMeta = @json($doctorMeta);

        const selectDoctor = document.getElementById('doctor_id');
        const elDays = document.getElementById('doctorScheduleDays');
        const elHours = document.getElementById('doctorScheduleHours');

        function updateSchedule() {
            const id = selectDoctor.value;
            const meta = doctorMeta && id ? doctorMeta[id] : null;

            const daysText = meta && meta.daysText ? meta.daysText : '-';
            const hoursText = meta && meta.start && meta.end ? `${meta.start} - ${meta.end}` : '-';

            elDays.textContent = `Hari: ${daysText}`;
            elHours.textContent = `Jam: ${hoursText}`;
        }

        if (selectDoctor) {
            selectDoctor.addEventListener('change', updateSchedule);
            updateSchedule();
        }
    })();
</script>
</body>
</html>
