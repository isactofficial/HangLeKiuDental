<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* Right detail panel */
        .detail-panel{width:360px;flex:0 0 360px}
        .detail-card{background:#fff;border-radius:8px;box-shadow:0 2px 14px rgba(0,0,0,0.06);overflow:hidden}
        .detail-head{padding:14px 16px;border-bottom:1px solid rgba(0,0,0,0.06);display:flex;align-items:center;justify-content:space-between;gap:10px}
        .detail-code{font-weight:700;color:#2563eb;font-size:13px;display:flex;align-items:center;gap:10px}
        .icon-btn{border:1px solid rgba(0,0,0,0.08);background:var(--surface);width:34px;height:34px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer}
        .detail-body{padding:14px 16px}
        .detail-title{display:flex;align-items:center;gap:10px;margin-bottom:10px}
        .status-dot{width:10px;height:10px;border-radius:999px;display:inline-block;flex:0 0 10px}
        .detail-name{font-weight:800;color:var(--text);font-size:18px;flex:1}
        .detail-sub{color:var(--muted);font-weight:600;font-size:13px;margin:4px 0 0}
        .detail-row{display:flex;align-items:center;gap:10px;margin:10px 0;color:var(--text)}
        .detail-row .label{color:var(--muted);font-weight:600;min-width:150px}
        .detail-row .value{font-weight:600}
        .detail-actions{display:flex;gap:10px;margin-top:14px}
        .btn-outline{flex:1;border:1px solid #93c5fd;color:#2563eb;background:transparent;padding:10px 12px;border-radius:8px;font-weight:700;cursor:pointer;text-align:center;text-decoration:none}
        .detail-actions{position:relative}
        .btn-status{flex:1;border:none;background:var(--action);color:#fff;padding:10px 18px;border-radius:14px;font-weight:800;cursor:pointer;line-height:1;display:inline-flex;align-items:center;justify-content:center}
        .btn-status:hover{opacity:0.9}
        .status-dropdown{position:absolute;bottom:calc(100% + 8px);right:0;background:#fff;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.15);min-width:160px;display:none;z-index:100}
        .status-dropdown.show{display:block}
        .status-option{padding:10px 14px;cursor:pointer;font-weight:600;font-size:13px;border-bottom:1px solid rgba(0,0,0,0.05);display:flex;align-items:center;gap:8px}
        .status-option:last-child{border-bottom:none}
        .status-option:hover{background:rgba(0,0,0,0.04)}
        .dot{width:8px;height:8px;border-radius:50%;display:inline-block}
        .detail-muted{color:var(--muted);font-size:13px;line-height:1.5}

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
        .slot-cell .booked{background:var(--accent);color:#fff;padding:8px 10px;border-radius:8px;font-weight:700;display:block;width:100%;min-height:34px;line-height:1.1;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;cursor:pointer}
        .slot-cell .booked.status-pending{background:#ef4444}
        .slot-cell .booked.status-confirmed{background:#f59e0b}
        .slot-cell .booked.status-waiting{background:#8b5cf6}
        .slot-cell .booked.status-engaged{background:#0ea5e9}
        .slot-cell .booked.status-succeed{background:#10b981}

        /* tiny scrollbar styling */
        .schedule-body::-webkit-scrollbar{width:10px}
        .schedule-body::-webkit-scrollbar-thumb{background:rgba(0,0,0,0.08);border-radius:8px}

        @media (max-width: 1000px){
            .left-panel{display:none}
            .main{margin-left:0}
            /* Mobile: stack schedule + detail so the detail card is visible */
            .topbar{flex-direction:column;align-items:stretch}
            .date-block{align-items:flex-start}

            .container{padding:8px 12px}
            .layout{flex-direction:column}
            .schedule-wrap{width:100%}

            .detail-panel{display:block;width:100%;flex:1 1 auto}
            .detail-card{max-width:520px;margin:14px auto 0}

            .schedule-body{max-height:420px}
        }

        /* Small screens: prevent hamburger from overlapping the title area */
        @media (max-width: 900px){
            .topbar{padding:14px 12px 12px 56px}
            .title-block h1{font-size:18px;line-height:1.2}
            .title-block p{font-size:12px}

            .legend{flex-wrap:wrap;gap:8px 12px;font-size:12px}
            .date-row{flex-wrap:wrap;align-items:center;gap:8px 12px}
            .arrow-btn{width:32px;height:32px;font-size:16px}
            .today-btn{font-size:12px;padding:6px 10px}
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

            <aside class="detail-panel" aria-label="Detail booking">
                <div class="detail-card" id="apptDetail">
                    <div class="detail-head">
                        <div class="detail-code">
                            <span id="detailCode">Code: -</span>
                        </div>
                        <div style="display:flex;gap:8px">
                            <button class="icon-btn" id="copyCodeBtn" title="Copy"><i class="fa-regular fa-copy" style="color:var(--muted)"></i></button>
                            <a class="icon-btn" id="openEmrIcon" href="/emr" title="Open EMR"><i class="fa-solid fa-link" style="color:var(--muted)"></i></a>
                        </div>
                    </div>
                    <div class="detail-body">
                        <div class="detail-muted" id="detailEmpty">Klik booking di jadwal untuk melihat detail.</div>

                        <div id="detailContent" style="display:none">
                            <div class="detail-title">
                                <span class="status-dot" id="detailDot" style="background:#10b981"></span>
                                <div class="detail-name" id="detailName">-</div>
                                <button class="icon-btn" title="Edit" style="width:34px;height:34px"><i class="fa-solid fa-pen" style="color:var(--muted)"></i></button>
                            </div>

                            <div class="detail-row">
                                <div class="label">Booking Code</div>
                                <div class="value" id="detailMr">-</div>
                            </div>
                            <div class="detail-row">
                                <div class="label">Jenis kelamin / umur</div>
                                <div class="value" id="detailBio">-</div>
                            </div>
                            <div class="detail-row">
                                <div class="label">Jadwal</div>
                                <div class="value" id="detailSchedule">-</div>
                            </div>
                            <div class="detail-row">
                                <div class="label">Estimasi</div>
                                <div class="value" id="detailDuration">-</div>
                            </div>
                            <div class="detail-row">
                                <div class="label">Tindakan</div>
                                <div class="value" id="detailProcedure">-</div>
                            </div>
                            <div class="detail-row">
                                <div class="label">Metode pembayaran</div>
                                <div class="value" id="detailPayment">Langsung</div>
                            </div>
                            <div class="detail-row">
                                <div class="label">Dibuat oleh</div>
                                <div class="value" id="detailCreatedBy">-</div>
                            </div>
                            <div class="detail-row">
                                <div class="label">Dibuat jam</div>
                                <div class="value" id="detailCreatedAt">-</div>
                            </div>

                            <div class="detail-actions">
                                <button class="btn-outline" id="openEmrBtn" style="opacity:0.5;cursor:not-allowed" disabled>Lihat Rekam Medis</button>
                                <button class="btn-status" id="detailStatus">
                                    <span class="status-text">Succeed</span>
                                </button>
                                <div class="status-dropdown" id="statusDropdown">
                                    <div class="status-option" data-status="pending"><span class="dot" style="background:#ef4444"></span> Pending</div>
                                    <div class="status-option" data-status="confirmed"><span class="dot" style="background:#f59e0b"></span> Confirmed</div>
                                    <div class="status-option" data-status="waiting"><span class="dot" style="background:#8b5cf6"></span> Waiting</div>
                                    <div class="status-option" data-status="engaged"><span class="dot" style="background:#0ea5e9"></span> Engaged</div>
                                    <div class="status-option" data-status="succeed"><span class="dot" style="background:#10b981"></span> Succeed</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<script>
    (function(){
        const doctorMeta = @json($doctorMeta);
        const SLOT_MINUTES = 20;

        let lastAppointments = [];
        let appointmentsById = new Map();

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

        function pad(num, size){
            const s = String(num ?? '');
            return s.padStart(size, '0');
        }

        function formatWib(dt){
            const hh = String(dt.getHours()).padStart(2,'0');
            const mm = String(dt.getMinutes()).padStart(2,'0');
            return `${hh}:${mm} WIB`;
        }

        function parseDateTime(value){
            if(!value) return null;
            const s = String(value).trim();
            if(!s) return null;

            // supports "YYYY-MM-DD HH:MM:SS" and ISO strings
            const normalized = (s.includes(' ') && !s.includes('T')) ? s.replace(' ', 'T') : s;
            const d = new Date(normalized);
            if (Number.isNaN(d.getTime())) return null;
            return d;
        }

        function formatDoctorName(name){
            const n = String(name || '').trim();
            if(!n) return 'drg.';
            const lower = n.toLowerCase();
            if (lower.startsWith('drg.') || lower.startsWith('dr.')) return n;
            return `drg. ${n}`;
        }

        function formatPatientName(name){
            const raw = String(name || '').trim().replace(/\s+/g, ' ');
            if(!raw) return '-';

            // Title Case each word, keep common separators
            return raw
                .split(' ')
                .map(function(w){
                    const s = String(w);
                    if(!s) return s;
                    return s.charAt(0).toUpperCase() + s.slice(1).toLowerCase();
                })
                .join(' ');
        }

        function dummyCode(appt){
            const seed = (Number(appt.id || 0) * 97 + Number(appt.doctor_id || 0) * 13 + 12345);
            return seed.toString(36).toUpperCase().padStart(6,'0').slice(0,6);
        }

        function dummyMr(appt){
            return `BK${pad(appt.id || 0, 6)}`;
        }

        function dummyBio(appt){
            const id = Number(appt.id || 0);
            const gender = (id % 2 === 0) ? 'Laki - laki' : 'Perempuan';
            const years = 20 + (id % 35);
            const months = (id * 3) % 12;
            const days = (id * 7) % 28;
            return `${gender} ${years} Tahun ${months} Bulan ${days} Hari`;
        }

        function parseDateOnly(value){
            if(!value) return null;
            const s = String(value).trim();
            if(!s) return null;

            const m = s.match(/^(\d{4})-(\d{2})-(\d{2})/);
            if(m){
                const y = Number(m[1]);
                const mo = Number(m[2]) - 1;
                const d = Number(m[3]);
                const dt = new Date(y, mo, d);
                if(!Number.isNaN(dt.getTime())) return dt;
            }

            return parseDateTime(s);
        }

        function normalizeGender(g){
            const raw = String(g || '').trim();
            if(!raw) return null;
            const lower = raw.toLowerCase();
            if (lower === 'p' || lower === 'f' || lower === 'female' || lower === 'perempuan') return 'Perempuan';
            if (lower === 'l' || lower === 'm' || lower === 'male' || lower === 'laki-laki' || lower === 'laki laki' || lower === 'laki') return 'Laki - laki';
            return raw;
        }

        function diffYmd(from, to){
            // from/to are Date at local midnight; returns calendar diff
            let cursor = new Date(from.getFullYear(), from.getMonth(), from.getDate());
            const target = new Date(to.getFullYear(), to.getMonth(), to.getDate());

            if (Number.isNaN(cursor.getTime()) || Number.isNaN(target.getTime())) return null;
            if (cursor > target) return { years: 0, months: 0, days: 0 };

            let years = 0;
            while (true) {
                const next = new Date(cursor.getFullYear() + 1, cursor.getMonth(), cursor.getDate());
                if (next <= target) { cursor = next; years++; } else break;
            }

            let months = 0;
            while (true) {
                const next = new Date(cursor.getFullYear(), cursor.getMonth() + 1, cursor.getDate());
                if (next <= target) { cursor = next; months++; } else break;
            }

            const msPerDay = 24 * 60 * 60 * 1000;
            const days = Math.floor((target.getTime() - cursor.getTime()) / msPerDay);
            return { years, months, days };
        }

        function formatBioFromDb(appt){
            const gender = normalizeGender(appt.patient_gender);
            const birth = parseDateOnly(appt.patient_birth_date);
            if(!gender || !birth) return null;

            const start = parseDateTime(appt.start_at);
            const asOf = start
                ? new Date(start.getFullYear(), start.getMonth(), start.getDate())
                : new Date();

            const diff = diffYmd(birth, asOf);
            if(!diff) return null;
            return `${gender} ${diff.years} Tahun ${diff.months} Bulan ${diff.days} Hari`;
        }

        function statusLabel(status){
            const s = String(status || '').toLowerCase();
            if (s === 'pending') return 'Pending';
            if (s === 'confirmed') return 'Confirmed';
            if (s === 'waiting') return 'Waiting';
            if (s === 'engaged') return 'Engaged';
            if (s === 'succeed' || s === 'success' || s === 'succeeded') return 'Succeed';
            return status ? String(status) : 'Confirmed';
        }

        function statusColor(status){
            const s = String(status || '').toLowerCase();
            if (s === 'pending') return '#ef4444';
            if (s === 'confirmed') return '#f59e0b';
            if (s === 'waiting') return '#8b5cf6';
            if (s === 'engaged') return '#0ea5e9';
            if (s === 'succeed' || s === 'success' || s === 'succeeded') return '#10b981';
            return '#f59e0b';
        }

        function statusClass(status){
            const s = String(status || '').toLowerCase();
            if (s === 'pending') return 'status-pending';
            if (s === 'confirmed') return 'status-confirmed';
            if (s === 'waiting') return 'status-waiting';
            if (s === 'engaged') return 'status-engaged';
            if (s === 'succeed' || s === 'success' || s === 'succeeded') return 'status-succeed';
            return 'status-confirmed';
        }

        // Detail panel elements
        const detailEmpty = document.getElementById('detailEmpty');
        const detailContent = document.getElementById('detailContent');
        const detailCode = document.getElementById('detailCode');
        const detailName = document.getElementById('detailName');
        const detailMr = document.getElementById('detailMr');
        const detailBio = document.getElementById('detailBio');
        const detailSchedule = document.getElementById('detailSchedule');
        const detailDuration = document.getElementById('detailDuration');
        const detailProcedure = document.getElementById('detailProcedure');
        const detailPayment = document.getElementById('detailPayment');
        const detailCreatedBy = document.getElementById('detailCreatedBy');
        const detailCreatedAt = document.getElementById('detailCreatedAt');
        const detailDot = document.getElementById('detailDot');
        const detailStatus = document.getElementById('detailStatus');
        const openEmrBtn = document.getElementById('openEmrBtn');
        const openEmrIcon = document.getElementById('openEmrIcon');
        const copyCodeBtn = document.getElementById('copyCodeBtn');

        function setDetail(appt){
            if (!appt) {
                if (detailEmpty) detailEmpty.style.display = 'block';
                if (detailContent) detailContent.style.display = 'none';
                if (detailCode) detailCode.textContent = 'Code: -';
                return;
            }

                const code = appt.code ? String(appt.code) : dummyCode(appt);
                const mr = appt.medical_record_number ? String(appt.medical_record_number) : dummyMr(appt);
                const bio = formatBioFromDb(appt) || dummyBio(appt);

            const patientName = formatPatientName(appt.patient_name);

            const start = parseDateTime(appt.start_at);
            const wib = start ? formatWib(start) : '-';
            const doc = formatDoctorName(appt.doctor_name || '');
            const scheduleText = `${wib} dengan ${doc}`;

            const dur = Number(appt.duration_minutes || 20);
            const procedure = appt.procedure ? String(appt.procedure) : '-';
            const payment = appt.payment_method ? String(appt.payment_method) : 'Langsung';
            const createdBy = appt.created_by ? String(appt.created_by) : 'Pasien';
            const createdText = appt.created_time_wib
                ? `${String(appt.created_time_wib)} WIB`
                : (function(){
                    const createdAt = parseDateTime(appt.created_at);
                    return createdAt ? formatWib(createdAt) : '-';
                })();

            const status = statusLabel(appt.status);

            if (detailEmpty) detailEmpty.style.display = 'none';
            if (detailContent) detailContent.style.display = 'block';
            if (detailCode) detailCode.textContent = `Code: ${code}`;
            if (detailName) detailName.textContent = patientName;
            if (detailMr) detailMr.textContent = mr;
            if (detailBio) detailBio.textContent = bio;
            if (detailSchedule) detailSchedule.textContent = scheduleText;
            if (detailDuration) detailDuration.textContent = `Perkiraan lama konsultasi selama ${dur} menit`;
            if (detailProcedure) detailProcedure.textContent = procedure;
            if (detailPayment) detailPayment.textContent = payment;
            if (detailCreatedBy) detailCreatedBy.textContent = createdBy;
            if (detailCreatedAt) detailCreatedAt.textContent = createdText;
            if (detailDot) detailDot.style.background = statusColor(appt.status);
            // status text handled below via .status-text span

            const params = new URLSearchParams({
                appointment_id: String(appt.id || ''),
                code,
                mr,
                name: String(patientName || ''),
                bio,
                doctor: String(doc || ''),
                time: wib,
                status,
            });
            const emrUrl = '/emr?' + params.toString();
            // EMR button disabled for now
            // if (openEmrBtn) openEmrBtn.href = emrUrl;
            if (openEmrIcon) openEmrIcon.href = emrUrl;

            if (copyCodeBtn) {
                copyCodeBtn.onclick = async function(){
                    try{ await navigator.clipboard.writeText(code); }catch(e){}
                };
            }

            // Store current appointment ID for status updates
            if (detailStatus) detailStatus.dataset.appointmentId = String(appt.id || '');
            if (detailStatus) {
                detailStatus.style.background = statusColor(appt.status);
                const statusTextSpan = detailStatus.querySelector('.status-text');
                if (statusTextSpan) {
                    statusTextSpan.textContent = status;
                }
            }
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

        function toLocalIsoDate(d){
            const y = d.getFullYear();
            const m = String(d.getMonth() + 1).padStart(2,'0');
            const day = String(d.getDate()).padStart(2,'0');
            return `${y}-${m}-${day}`;
        }

        async function render(){
            const weekday = new Intl.DateTimeFormat('id-ID',{weekday:'long'}).format(current);
            const dateStr = new Intl.DateTimeFormat('id-ID',{day:'2-digit', month:'long', year:'numeric'}).format(current);
            if(dateTitle) dateTitle.textContent = capitalize(weekday);
            if(dateText) dateText.textContent = dateStr;

            const dateIso = toLocalIsoDate(current);
            clearSlots(dateIso);

            const appointments = await fetchAppointmentsFor(dateIso);
            lastAppointments = Array.isArray(appointments) ? appointments : [];
            appointmentsById = new Map(lastAppointments.map(a => [String(a.id), a]));
            if(!appointments || !appointments.length) {
                setDetail(null);
                return;
            }

            const doctorOrder = getDoctorOrder();
            const timeRows = Array.from(document.querySelectorAll('.time-row'));

            // map time label -> timeRow element for fast lookup
            const timeMap = new Map();
            timeRows.forEach(function(row){
                const t = row.querySelector('.time-cell').textContent.trim();
                timeMap.set(t, row);
            });

            appointments.forEach(function(a){
                const start = parseDateTime(a.start_at);
                const end = parseDateTime(a.end_at);
                if(!start || !end) return;
                const docIndex = doctorOrder.indexOf(String(a.doctor_id));
                if(docIndex === -1) return; // doctor not visible

                const weekdayNum = new Date(dateIso + 'T00:00:00').getDay();

                let cur = new Date(start);
                while(cur < end){
                    const label = formatTimeToLabel(cur);
                    const row = timeMap.get(label);
                    if(row){
                        // slot cells start at child index 1
                        const cell = row.children[docIndex + 1];
                        const displayName = formatPatientName(a.patient_name);

                        const minutes = cur.getHours() * 60 + cur.getMinutes();
                        const ok = isPracticeTime(String(a.doctor_id), weekdayNum, minutes);
                        if(cell && ok) {
                            cell.innerHTML = `<div class="booked ${statusClass(a.status)}" data-appointment-id="${a.id}">${displayName}</div>`;
                        }
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
            const booked = e.target.closest('.booked');
            if (booked && booked.dataset && booked.dataset.appointmentId) {
                const appt = appointmentsById.get(String(booked.dataset.appointmentId));
                setDetail(appt || null);
                return;
            }

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
            const dateIso = toLocalIsoDate(current);
            const params = new URLSearchParams({
                doctor_id: doctorId,
                date: dateIso,
                start_time: hhmm
            });

            window.location.href = '/booking?'+params.toString();
        });

        // Status dropdown functionality
        const statusDropdown = document.getElementById('statusDropdown');
        if (detailStatus && statusDropdown) {
            // Toggle dropdown when clicking status button
            detailStatus.addEventListener('click', function(e){
                e.stopPropagation();
                statusDropdown.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(){
                if (statusDropdown) statusDropdown.classList.remove('show');
            });

            // Handle status option clicks
            const statusOptions = statusDropdown.querySelectorAll('.status-option');
            statusOptions.forEach(function(option){
                option.addEventListener('click', async function(e){
                    e.stopPropagation();
                    const newStatus = option.dataset.status;
                    const appointmentId = detailStatus.dataset.appointmentId;

                    if (!appointmentId) return;

                    try {
                        const response = await fetch('/appointments/' + appointmentId + '/status', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ status: newStatus })
                        });

                        if (response.ok) {
                            const data = await response.json();
                            
                            // Update button text and color
                            const statusTextSpan = detailStatus.querySelector('.status-text');
                            if (statusTextSpan) {
                                statusTextSpan.textContent = statusLabel(newStatus);
                            }
                            detailStatus.style.background = statusColor(newStatus);
                            
                            // Update dot color
                            if (detailDot) detailDot.style.background = statusColor(newStatus);
                            
                            // Close dropdown
                            statusDropdown.classList.remove('show');
                            
                            // Reload appointments to reflect changes
                            await render();
                        }
                    } catch (error) {
                        console.error('Failed to update status:', error);
                    }
                });
            });
        }
    })();
</script>

</body>
</html>
