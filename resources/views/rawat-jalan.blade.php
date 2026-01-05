<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rawat Jalan - Hanglekiu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Poppins',sans-serif;background:var(--main-bg);color:var(--text);min-height:100vh;display:flex}
        .main{margin-left:60px;flex:1}

        /* Top header with legend and date */
        .topbar{display:flex;align-items:flex-start;justify-content:space-between;padding:18px 22px;gap:12px}
        .title-block{display:flex;flex-direction:column;gap:6px}
        .title-block h1{color:var(--accent);font-size:22px}
        .title-block p{color:var(--muted);font-size:13px;margin:0}

        .legend{display:flex;gap:12px;align-items:center;color:var(--muted);font-size:13px}
        .legend .item{display:flex;gap:8px;align-items:center}
        .dot{width:10px;height:10px;border-radius:50%;display:inline-block}

        .date-block{display:flex;flex-direction:column;align-items:flex-end;gap:8px}
        .date-row{display:flex;align-items:center;gap:12px}
        .date-title{color:var(--accent);font-weight:700}
        .today-btn{background:var(--action);color:#fff;padding:6px 10px;border-radius:6px;font-weight:700}
        .arrow-btn{background:transparent;border:1px solid rgba(0,0,0,0.06);width:34px;height:34px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;color:var(--accent);font-size:18px}

        .container{padding:8px 22px}
        .layout{display:flex;gap:18px}

        /* Left doctor list */
        .left-panel{width:220px}
        .left-card{background:rgba(176,141,112,0.06);padding:10px;border-radius:8px}
        .left-card h3{background:var(--accent);color:#fff;padding:10px;border-radius:6px;font-size:14px;margin:0 0 10px}
        .doctor-list{display:flex;flex-direction:column;gap:8px}
        .doctor-item{background:#fff;padding:10px;border-radius:6px;border:1px solid rgba(0,0,0,0.04);color:var(--text);font-weight:600}

        /* Schedule area */
        .schedule-wrap{flex:1;position:relative}
        .schedule-card{background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 14px rgba(0,0,0,0.06)}

        /* sticky header row with doctor columns */
        .schedule-header{display:grid;background:var(--accent);color:#fff}
        .schedule-header .col{padding:16px;font-weight:700;text-transform:uppercase;font-size:13px;border-right:1px solid rgba(255,255,255,0.08)}
        .schedule-header .col:first-child{background:transparent;color:#fff;font-weight:700;display:flex;align-items:center;gap:6px;padding-left:18px}

        .schedule-body{max-height:640px;overflow:auto}
        .time-row{display:grid;gap:0;border-bottom:1px solid rgba(0,0,0,0.04)}
        .time-cell{padding:18px;font-weight:600;color:var(--muted);border-right:1px solid rgba(0,0,0,0.03);background:transparent}
        .slot-cell{padding:12px;border-right:1px solid rgba(0,0,0,0.03);background:transparent;color:var(--muted);font-size:13px}
        .slot-cell .empty{color:rgba(0,0,0,0.2)}
        .slot-cell .empty-slot{min-height:18px}
        .slot-cell .booked{background:var(--accent);color:#fff;padding:6px;border-radius:6px;font-weight:600}

        /* tiny scrollbar styling */
        .schedule-body::-webkit-scrollbar{width:10px}
        .schedule-body::-webkit-scrollbar-thumb{background:rgba(0,0,0,0.08);border-radius:8px}

        @media (max-width: 1000px){
            .left-panel{display:none}
            .main{margin-left:0}
        }
    </style>
</head>
<body>

@include('partials.sidebar')

<div class="main">
    <div class="topbar">
        <div>
            <div class="title-block">
                <h1>Rawat Jalan</h1>
                <p>hanglekiu dental specialist</p>
            </div>
            <div style="margin-top:8px">
                <div class="legend">
                    <div class="item"><span class="dot" style="background:#ef4444"></span> Pending</div>
                    <div class="item"><span class="dot" style="background:#f59e0b"></span> Confirmed</div>
                    <div class="item"><span class="dot" style="background:#8b5cf6"></span> Waiting</div>
                    <div class="item"><span class="dot" style="background:#0ea5e9"></span> Engaged</div>
                    <div class="item"><span class="dot" style="background:#10b981"></span> Succeed</div>
                </div>
            </div>
        </div>

        <div class="date-block">
            <div class="date-row">
                <div style="display:flex;align-items:center;gap:8px">
                    <button id="prevDay" class="arrow-btn" aria-label="Previous day">‹</button>
                    <div style="text-align:left">
                        <div class="date-title">Kamis</div>
                        <div class="date-text" style="font-weight:600;color:var(--muted)">25 Desember 2025</div>
                    </div>
                    <button id="nextDay" class="arrow-btn" aria-label="Next day">›</button>
                </div>
                <div>
                    <button id="todayBtn" class="today-btn">HARI INI</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="layout">
            <aside class="left-panel">
                <div class="left-card">
                    <h3>Seluruh Dokter</h3>
                    <div class="doctor-list">
                        @foreach($doctors as $d)
                            <div class="doctor-item">{{ $d->name }}{{ $d->specialty ? ' — '.$d->specialty : '' }}</div>
                        @endforeach
                    </div>
                </div>
            </aside>

            <section class="schedule-wrap">
                <div class="schedule-card">
                    <div class="schedule-header" style="grid-template-columns:150px repeat({{ count($doctors) }},1fr);">
                        <div class="col">NOW</div>
                        @foreach($doctors as $d)
                            <div class="col" data-doctor-id="{{ $d->id }}">{{ $d->name }} <i class="fa fa-caret-down" style="margin-left:8px;font-size:12px"></i></div>
                        @endforeach
                    </div>

                    <div class="schedule-body">
                        @php
                            $times = [];
                            // generate 20-minute slots for a full day: 00:00 -> 23:40 (matches booking duration)
                            for($h=0; $h<24; $h++){
                                for($m=0; $m<60; $m+=20){
                                    $times[] = sprintf('%02d:%02d WIB', $h, $m);
                                }
                            }

                            // doctor practice meta (dummy defaults if not configured)
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
                                if (empty($days)) {
                                    $days = [1,2,3,4,5,6]; // dummy: Senin-Sabtu
                                }
                                $start = $d->practice_start_time ? substr((string) $d->practice_start_time, 0, 5) : '09:00';
                                $end = $d->practice_end_time ? substr((string) $d->practice_end_time, 0, 5) : '17:00';

                                return [
                                    $d->id => [
                                        'days' => array_values($days),
                                        'start' => $start,
                                        'end' => $end,
                                    ],
                                ];
                            });
                        @endphp

                        @foreach($times as $t)
                            <div class="time-row" style="grid-template-columns:150px repeat({{ count($doctors) }},1fr);">
                                <div class="time-cell">{{ $t }}</div>
                                @foreach($doctors as $d)
                                    <div class="slot-cell"><div class="empty">Tidak Praktek</div></div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    (function(){
        const doctorMeta = @json($doctorMeta);
        const SLOT_MINUTES = 20;

        const dateTitle = document.querySelector('.date-title');
        const dateText = document.querySelector('.date-text');
        const prev = document.getElementById('prevDay');
        const next = document.getElementById('nextDay');
        const todayBtn = document.getElementById('todayBtn');

        // build doctor order from header
        function getDoctorOrder(){
            const cols = Array.from(document.querySelectorAll('.schedule-header .col[data-doctor-id]'));
            return cols.map(c => c.dataset.doctorId);
        }

        function capitalize(s){ if(!s) return s; return s.charAt(0).toUpperCase()+s.slice(1); }

        let current = new Date();
        current = new Date(current.getFullYear(), current.getMonth(), current.getDate());

        async function fetchAppointmentsFor(dateIso){
            try{
                const res = await fetch('/appointments?date='+encodeURIComponent(dateIso), {headers:{'Accept':'application/json'}});
                if(!res.ok) return [];
                return await res.json();
            }catch(e){ console.error(e); return []; }
        }

        function timeToMinutes(hhmm){
            const parts = String(hhmm || '').split(':');
            if(parts.length < 2) return null;
            const h = parseInt(parts[0], 10);
            const m = parseInt(parts[1], 10);
            if(Number.isNaN(h) || Number.isNaN(m)) return null;
            return h * 60 + m;
        }

        function isPracticeTime(doctorId, weekdayNum, minutes){
            const meta = doctorMeta ? doctorMeta[doctorId] : null;
            if(!meta) return false;

            const days = Array.isArray(meta.days) ? meta.days.map(Number) : [];
            if(days.length && !days.includes(Number(weekdayNum))) return false;

            const startMin = timeToMinutes(meta.start);
            const endMin = timeToMinutes(meta.end);
            if(startMin === null || endMin === null) return false;

            // practice window inclusive start, exclusive end
            return minutes >= startMin && (minutes + SLOT_MINUTES) <= endMin;
        }

        function clearSlots(dateIso){
            const weekdayNum = new Date(dateIso + 'T00:00:00').getDay();
            const doctorOrder = getDoctorOrder();
            const timeRows = Array.from(document.querySelectorAll('.time-row'));

            timeRows.forEach(function(row){
                const timeLabel = row.querySelector('.time-cell').textContent.trim();
                const hhmm = timeLabel.split(' ')[0];
                const minutes = timeToMinutes(hhmm);

                doctorOrder.forEach(function(docId, idx){
                    const cell = row.children[idx + 1];
                    if(!cell) return;

                    const ok = minutes !== null && isPracticeTime(String(docId), weekdayNum, minutes);
                    cell.innerHTML = ok
                        ? '<div class="empty-slot"></div>'
                        : '<div class="empty">Tidak Praktek</div>';
                });
            });
        }

        function formatTimeToLabel(dt){
            const hh = String(dt.getHours()).padStart(2,'0');
            const mm = String(dt.getMinutes()).padStart(2,'0');
            return `${hh}:${mm} WIB`;
        }

        async function render(){
            const weekday = new Intl.DateTimeFormat('id-ID',{weekday:'long'}).format(current);
            const dateStr = new Intl.DateTimeFormat('id-ID',{day:'2-digit', month:'long', year:'numeric'}).format(current);
            if(dateTitle) dateTitle.textContent = capitalize(weekday);
            if(dateText) dateText.textContent = dateStr;

            const dateIso = current.toISOString().slice(0,10);
            clearSlots(dateIso);

            const appointments = await fetchAppointmentsFor(dateIso);
            if(!appointments || !appointments.length) return;

            const doctorOrder = getDoctorOrder();
            const timeRows = Array.from(document.querySelectorAll('.time-row'));

            // map time label -> timeRow element for fast lookup
            const timeMap = new Map();
            timeRows.forEach(function(row){
                const t = row.querySelector('.time-cell').textContent.trim();
                timeMap.set(t, row);
            });

            appointments.forEach(function(a){
                const start = new Date(a.start_at);
                const end = new Date(a.end_at);
                const docIndex = doctorOrder.indexOf(String(a.doctor_id));
                if(docIndex === -1) return; // doctor not visible

                let cur = new Date(start);
                while(cur < end){
                    const label = formatTimeToLabel(cur);
                    const row = timeMap.get(label);
                    if(row){
                        // slot cells start at child index 1
                        const cell = row.children[docIndex + 1];
                        if(cell) cell.innerHTML = `<div class="booked">${a.patient_name}</div>`;
                    }
                    cur.setMinutes(cur.getMinutes() + SLOT_MINUTES);
                }
            });
        }

        if(prev) prev.addEventListener('click', function(){ current.setDate(current.getDate() - 1); render(); });
        if(next) next.addEventListener('click', function(){ current.setDate(current.getDate() + 1); render(); });
        if(todayBtn) todayBtn.addEventListener('click', function(){ current = new Date(); current = new Date(current.getFullYear(), current.getMonth(), current.getDate()); render(); });

        // initialize
        render();

        // allow clicking an empty slot to prefill the public booking form
        document.addEventListener('click', function(e){
            const cell = e.target.closest('.slot-cell');
            if(!cell) return;
            // only allow when slot is an available (practice) empty slot
            if(!cell.querySelector('.empty-slot')) return;

            const row = cell.parentElement;
            const timeLabel = row.querySelector('.time-cell').textContent.trim(); // e.g. 08:00 WIB
            const hhmm = timeLabel.split(' ')[0];

            // determine doctor id by column index
            const cells = Array.from(row.children);
            const idx = cells.indexOf(cell); // 0 is time column, doctors start at 1
            if(idx <= 0) return;
            const doctorCols = Array.from(document.querySelectorAll('.schedule-header .col[data-doctor-id]'));
            const doctor = doctorCols[idx - 1];
            if(!doctor) return;
            const doctorId = doctor.dataset.doctorId;

            // build booking url with prefill
            const dateIso = current.toISOString().slice(0,10);
            const params = new URLSearchParams({
                doctor_id: doctorId,
                date: dateIso,
                start_time: hhmm
            });

            window.location.href = '/booking?'+params.toString();
        });
    })();
</script>

</body>
</html>
