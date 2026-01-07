<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking - Hanglekiu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

        /* flatpickr (keep within existing theme tokens) */
        .flatpickr-calendar{font-family:'Poppins',sans-serif}
        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange,
        .flatpickr-day.selected.inRange,
        .flatpickr-day.startRange.inRange,
        .flatpickr-day.endRange.inRange{
            background: var(--action, #B08D70);
            border-color: var(--action, #B08D70);
        }
        .flatpickr-day.today{border-color: var(--accent, #B08D70)}
        .flatpickr-day.inRange{
            background: rgba(176,141,112,0.12);
            border-color: transparent;
            box-shadow: none;
        }
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

            if ($daysText === '') {
                $daysText = 'Setiap hari';
            }

            $start = $d->practice_start_time ? substr((string) $d->practice_start_time, 0, 5) : '09:00';
            $end = $d->practice_end_time ? substr((string) $d->practice_end_time, 0, 5) : '17:00';

            return [
                $d->id => [
                    'daysText' => $daysText,
                    'days' => array_values($days),
                    'start' => $start,
                    'end' => $end,
                    'specialty' => $d->specialty,
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
            <label for="patient_gender">Jenis Kelamin</label>
            <select id="patient_gender" name="patient_gender" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki - laki" {{ old('patient_gender') === 'Laki - laki' ? 'selected' : '' }}>Laki - laki</option>
                <option value="Perempuan" {{ old('patient_gender') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="field">
            <label for="patient_birth_date">Tanggal Lahir</label>
            <input id="patient_birth_date" name="patient_birth_date" type="date" value="{{ old('patient_birth_date') }}" required>
        </div>

        <div class="field">
            <label for="patient_phone">No. WhatsApp</label>
            <input id="patient_phone" name="patient_phone" placeholder="contoh: 62812xxxx" value="{{ old('patient_phone') }}" required>
            <div class="hint" style="margin-top:6px">Notifikasi WA dikirim 10 menit sebelum selesai tindakan.</div>
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
            <label for="procedure">Pilih Tindakan</label>
            <select id="procedure" name="procedure" required>
                <option value="">-- Pilih Tindakan --</option>
            </select>
            <div class="hint" style="margin-top:6px">Durasi tindakan: {{ (int) ($durationMinutes ?? 20) }} menit.</div>
        </div>

        <div class="field">
            <label for="date">Tanggal</label>
            <input id="date" name="date" type="text" inputmode="none" autocomplete="off" value="{{ old('date', $prefill['date'] ?? date('Y-m-d')) }}" required>
        </div>

        <div class="field">
            <label for="start_time">Jam Mulai (Available)</label>
            <select id="start_time" name="start_time" required>
                <option value="">-- Pilih Jam --</option>
            </select>
            <div class="hint" id="slotHint" style="margin-top:6px"></div>
        </div>

        <div class="field">
            <label for="end_time">Jam Selesai (Otomatis)</label>
            <input id="end_time" type="time" value="" disabled>
        </div>

        <div class="field">
            <label for="payment_method">Metode Pembayaran</label>
            @php
                $pay = old('payment_method', 'Langsung');
            @endphp
            <select id="payment_method" name="payment_method" required>
                <option value="Langsung" {{ $pay === 'Langsung' ? 'selected' : '' }}>Langsung</option>
                <option value="Tunai" {{ $pay === 'Tunai' ? 'selected' : '' }}>Tunai</option>
                <option value="BPJS" {{ $pay === 'BPJS' ? 'selected' : '' }}>BPJS</option>
                <option value="Asuransi" {{ $pay === 'Asuransi' ? 'selected' : '' }}>Asuransi</option>
            </select>
        </div>

        <div class="actions">
            <button type="submit">Booking Sekarang</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
    (function() {
        const doctorMeta = @json($doctorMeta);
        const proceduresBySpecialty = @json($proceduresBySpecialty ?? []);
        const durationMinutes = Number(@json((int) ($durationMinutes ?? 20)));

        const selectDoctor = document.getElementById('doctor_id');
        const selectProcedure = document.getElementById('procedure');
        const inputDate = document.getElementById('date');
        const selectStart = document.getElementById('start_time');
        const inputEnd = document.getElementById('end_time');
        const elDays = document.getElementById('doctorScheduleDays');
        const elHours = document.getElementById('doctorScheduleHours');
        const slotHint = document.getElementById('slotHint');

        let datePicker = null;

        function normalizeSpecialty(s) {
            return String(s || '')
                .trim()
                .toLowerCase()
                .replace(/\s+/g, ' ')
                .replace(/\s*\.\s*/g, '.');
        }

        function setOptions(select, items, selectedValue) {
            select.innerHTML = '';
            const opt0 = document.createElement('option');
            opt0.value = '';
            opt0.textContent = '-- Pilih --';
            select.appendChild(opt0);

            (items || []).forEach(function(v){
                const opt = document.createElement('option');
                opt.value = v;
                opt.textContent = v;
                if (selectedValue && selectedValue === v) opt.selected = true;
                select.appendChild(opt);
            });
        }

        function computeEndTime(startHHMM) {
            if (!startHHMM) return '';
            const parts = String(startHHMM).split(':');
            if (parts.length < 2) return '';
            const h = parseInt(parts[0], 10);
            const m = parseInt(parts[1], 10);
            if (Number.isNaN(h) || Number.isNaN(m)) return '';
            const total = h * 60 + m + durationMinutes;
            const eh = Math.floor(total / 60) % 24;
            const em = total % 60;
            return String(eh).padStart(2,'0') + ':' + String(em).padStart(2,'0');
        }

        function weekdayOf(dateIso) {
            const d = new Date(dateIso + 'T00:00:00');
            return d.getDay(); // 0-6
        }

        function toLocalIsoDate(d) {
            const y = d.getFullYear();
            const m = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${y}-${m}-${day}`;
        }

        function getPracticeDays(doctorId) {
            const meta = doctorMeta && doctorId ? doctorMeta[doctorId] : null;
            const days = meta && Array.isArray(meta.days) ? meta.days.map(Number) : [];
            return days;
        }

        function isPracticeDay(doctorId, dateIso) {
            const days = getPracticeDays(doctorId);
            if (!days.length) return true; // not configured: allow all days
            return days.includes(weekdayOf(dateIso));
        }

        function findNextPracticeDate(doctorId, dateIso) {
            // Search up to 14 days ahead.
            const base = new Date(dateIso + 'T00:00:00');
            for (let i = 0; i < 14; i++) {
                const d = new Date(base);
                d.setDate(base.getDate() + i);
                const iso = toLocalIsoDate(d);
                if (isPracticeDay(doctorId, iso)) return iso;
            }
            return dateIso;
        }

        function ensureValidDate() {
            const doctorId = selectDoctor.value;
            const dateIso = inputDate.value;
            if (!doctorId || !dateIso) return false;

            if (isPracticeDay(doctorId, dateIso)) return false;

            const next = findNextPracticeDate(doctorId, dateIso);
            if (next && next !== dateIso) {
                if (datePicker) {
                    datePicker.setDate(next, true);
                } else {
                    inputDate.value = next;
                }
                return true;
            }
            return false;
        }

        function applyDatePickerConstraints() {
            if (!datePicker) return;

            const doctorId = selectDoctor.value;
            const allowedDays = getPracticeDays(doctorId);

            datePicker.set('disable', [function(date){
                if (!doctorId) return false;
                if (!allowedDays.length) return false;
                return !allowedDays.includes(date.getDay());
            }]);

            // if currently selected date is invalid, jump to next valid
            ensureValidDate();
        }

        async function loadSlots() {
            const doctorId = selectDoctor.value;
            // auto-adjust date to a practice day
            ensureValidDate();
            const date = inputDate.value;

            selectStart.innerHTML = '<option value="">-- Pilih Jam --</option>';
            inputEnd.value = '';
            if (slotHint) slotHint.textContent = '';

            if (!doctorId || !date) return;

            try {
                const url = new URL('{{ route('booking.slots') }}', window.location.origin);
                url.searchParams.set('doctor_id', doctorId);
                url.searchParams.set('date', date);

                const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
                const data = await res.json();
                const slots = (data && data.slots) ? data.slots : [];
                const error = (data && data.error) ? String(data.error) : '';

                selectStart.innerHTML = '<option value="">-- Pilih Jam --</option>';
                slots.forEach(function(t){
                    const opt = document.createElement('option');
                    opt.value = t;
                    opt.textContent = t;
                    selectStart.appendChild(opt);
                });

                // hint/status
                if (slotHint) {
                    if (error) {
                        slotHint.textContent = error;
                    } else if (!slots.length) {
                        slotHint.textContent = 'Tidak ada jam tersedia pada tanggal ini.';
                    } else {
                        slotHint.textContent = 'Pilih salah satu jam yang tersedia.';
                    }
                }

                // disable start select when no slots
                selectStart.disabled = !slots.length;

                // prefill if any
                const prefillStart = @json(old('start_time', $prefill['start_time'] ?? ''));
                if (prefillStart) {
                    selectStart.value = prefillStart;
                    inputEnd.value = computeEndTime(prefillStart);
                }
            } catch (e) {
                // keep empty slots
                selectStart.disabled = true;
            }
        }

        function updateSchedule() {
            const id = selectDoctor.value;
            const meta = doctorMeta && id ? doctorMeta[id] : null;

            const daysText = meta && meta.daysText ? meta.daysText : '-';
            const hoursText = meta && meta.start && meta.end ? `${meta.start} - ${meta.end}` : '-';

            elDays.textContent = `Hari: ${daysText}`;
            elHours.textContent = `Jam: ${hoursText}`;

            // update tindakan options
            const specKey = normalizeSpecialty(meta && meta.specialty ? meta.specialty : '');
            const list = (proceduresBySpecialty && proceduresBySpecialty[specKey]) ? proceduresBySpecialty[specKey] : (proceduresBySpecialty['*'] || []);
            const prefillProcedure = @json(old('procedure', ''));
            setOptions(selectProcedure, list, prefillProcedure);

            applyDatePickerConstraints();
        }

        if (selectDoctor) {
            selectDoctor.addEventListener('change', updateSchedule);
            selectDoctor.addEventListener('change', loadSlots);
            updateSchedule();
        }

        if (inputDate) {
            // date picker: only show selectable days that match doctor schedule
            if (window.flatpickr) {
                datePicker = window.flatpickr(inputDate, {
                    dateFormat: 'Y-m-d',
                    altInput: true,
                    altFormat: 'd/m/Y',
                    allowInput: false,
                    locale: (window.flatpickr && window.flatpickr.l10ns && window.flatpickr.l10ns.id) ? window.flatpickr.l10ns.id : undefined,
                    defaultDate: inputDate.value || undefined,
                    onChange: function(){
                        ensureValidDate();
                        loadSlots();
                    },
                });
                applyDatePickerConstraints();
            } else {
                inputDate.addEventListener('change', function(){
                    ensureValidDate();
                    loadSlots();
                });
            }
        }

        if (selectStart) {
            selectStart.addEventListener('change', function(){
                inputEnd.value = computeEndTime(selectStart.value);
            });
        }

        // initial load
        loadSlots();
    })();
</script>
</body>
</html>
