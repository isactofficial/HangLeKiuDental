@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <div>
            <div class="page-title">Settings</div>
            <div class="text-muted">Kelola Users & Dokter</div>
        </div>
    </div>

    @if(session('status'))
        <div style="padding:12px;background:#ecfdf5;border-radius:8px;margin:12px 0;color:#065f46">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div style="padding:12px;background:#fef2f2;border-radius:8px;margin:12px 0;color:#991b1b">
            <div style="font-weight:700;margin-bottom:6px">Ada kesalahan input:</div>
            <ul style="margin:0;padding-left:18px">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $dayLabels = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        $dayFull = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $formatDays = function ($days) use ($dayLabels) {
            if (empty($days) || !is_array($days)) return '-';
            $days = array_values(array_unique(array_filter($days, fn($d) => is_numeric($d))));
            sort($days);
            $names = [];
            foreach ($days as $d) {
                $idx = (int) $d;
                if ($idx >= 0 && $idx <= 6) $names[] = $dayLabels[$idx];
            }
            return !empty($names) ? implode(', ', $names) : '-';
        };
    @endphp

    <div class="settings-layout" style="margin-top:18px">
        <div class="settings-sidebar">
            <button type="button" class="tab active" data-tab="users">Manajemen Users</button>
            <button type="button" class="tab" data-tab="doctors">Manajemen Dokter</button>
        </div>
        <div class="settings-main">
            <div id="panel-users" class="panel active">
                <div class="card users-card">
                    <div class="card-head">
                        <div>
                            <div class="card-title">Manajemen Users</div>
                            <div class="card-subtitle">Kelola role dan akun pengguna sistem</div>
                        </div>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
                    </div>
                    <div style="overflow:auto">
                        <table class="table users-table" style="min-width:720px">
                            <thead>
                                <tr>
                                    <th style="padding:12px 16px;text-align:left">ID</th>
                                    <th style="padding:12px 16px;text-align:left">Nama</th>
                                    <th style="padding:12px 16px;text-align:left">Email</th>
                                    <th style="padding:12px 16px;text-align:left">Role</th>
                                    <th style="padding:12px 16px;text-align:left">Dokter</th>
                                    <th style="padding:12px 16px;text-align:left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $u)
                                <tr class="users-row">
                                    <td class="col-id">{{ $u->id }}</td>
                                    <td class="col-name">{{ $u->name }}</td>
                                    <td class="col-email">{{ $u->email }}</td>
                                    <td class="col-role">{{ ucfirst($u->role) }}</td>
                                    <td class="col-role">{{ $u->doctor->name ?? '-' }}</td>
                                    <td class="col-actions">
                                        <details class="settings-details">
                                            <summary class="settings-summary" title="Ubah role"><i class="fas fa-cog"></i></summary>
                                            <form method="POST" action="{{ route('admin.users.updateRole', $u) }}" class="role-form">
                                                @csrf
                                                <select name="role" class="role-select">
                                                    <option value="doctor" {{ $u->role === 'doctor' ? 'selected' : '' }}>Doctor</option>
                                                    <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>User</option>
                                                </select>
                                                <button type="submit" class="btn save-role">Simpan</button>
                                            </form>

                                            @if($u->role === 'doctor')
                                                <div style="height:10px"></div>
                                                <form method="POST" action="{{ route('admin.users.updateDoctor', $u) }}" class="role-form">
                                                    @csrf
                                                    <select name="doctor_id" class="role-select">
                                                        <option value="">— Tidak ditautkan —</option>
                                                        @foreach(($doctors ?? collect()) as $d)
                                                            <option value="{{ $d->id }}" {{ ((int) ($u->doctor_id ?? 0) === (int) $d->id) ? 'selected' : '' }}>{{ $d->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="btn save-role">Simpan</button>
                                                </form>
                                            @endif
                                        </details>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="panel-doctors" class="panel">
                <div class="card users-card">
                    <div class="card-head">
                        <div>
                            <div class="card-title">Manajemen Dokter</div>
                            <div class="card-subtitle">Tambah dokter dan atur jadwal praktek</div>
                        </div>
                        <details class="add-doctor">
                            <summary class="btn btn-primary">Tambah Dokter</summary>
                            <form method="POST" action="{{ route('admin.doctors.store') }}" class="doctor-form">
                                @csrf
                                <div class="form-grid">
                                    <label class="form-field">
                                        <span>Nama Dokter</span>
                                        <input name="name" type="text" required maxlength="255" placeholder="drg. ..." value="{{ old('name') }}">
                                    </label>
                                    <label class="form-field">
                                        <span>Spesialis</span>
                                        <input name="specialty" type="text" maxlength="255" placeholder="Sp.Ortho" value="{{ old('specialty') }}">
                                    </label>
                                    <div class="form-field">
                                        <span>Hari Praktek</span>
                                        <div class="days-grid">
                                            @foreach($dayFull as $idx => $label)
                                                <label class="day-item">
                                                    <input type="checkbox" name="practice_days[]" value="{{ $idx }}" {{ in_array($idx, (array) old('practice_days', []), true) ? 'checked' : '' }}>
                                                    <span>{{ $label }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <label class="form-field">
                                        <span>Jam Mulai</span>
                                        <input name="practice_start_time" type="time" value="{{ old('practice_start_time') }}">
                                    </label>
                                    <label class="form-field">
                                        <span>Jam Selesai</span>
                                        <input name="practice_end_time" type="time" value="{{ old('practice_end_time') }}">
                                    </label>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </details>
                    </div>

                    <div style="overflow:auto">
                        <table class="table users-table" style="min-width:720px">
                            <thead>
                                <tr>
                                    <th style="padding:12px 16px;text-align:left">Nama</th>
                                    <th style="padding:12px 16px;text-align:left">Spesialis</th>
                                    <th style="padding:12px 16px;text-align:left">Hari</th>
                                    <th style="padding:12px 16px;text-align:left">Jam</th>
                                    <th style="padding:12px 16px;text-align:left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($doctors ?? collect()) as $d)
                                    @php
                                        $start = $d->practice_start_time ? substr((string) $d->practice_start_time, 0, 5) : null;
                                        $end = $d->practice_end_time ? substr((string) $d->practice_end_time, 0, 5) : null;
                                    @endphp
                                    <tr class="users-row">
                                        <td class="col-name">{{ $d->name }}</td>
                                        <td class="col-role">{{ $d->specialty ?: '-' }}</td>
                                        <td class="col-role">{{ $formatDays($d->practice_days) }}</td>
                                        <td class="col-role">{{ $start && $end ? ($start . ' - ' . $end) : '-' }}</td>
                                        <td class="col-actions">
                                            <details class="settings-details">
                                                <summary class="settings-summary" title="Edit jadwal"><i class="fas fa-cog"></i></summary>
                                                <form method="POST" action="{{ route('admin.doctors.update', $d) }}" class="doctor-form">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="form-grid">
                                                        <label class="form-field">
                                                            <span>Nama</span>
                                                            <input name="name" type="text" required maxlength="255" value="{{ $d->name }}">
                                                        </label>
                                                        <label class="form-field">
                                                            <span>Spesialis</span>
                                                            <input name="specialty" type="text" maxlength="255" value="{{ $d->specialty }}">
                                                        </label>
                                                        <div class="form-field">
                                                            <span>Hari Praktek</span>
                                                            <div class="days-grid">
                                                                @foreach($dayFull as $idx => $label)
                                                                    <label class="day-item">
                                                                        <input type="checkbox" name="practice_days[]" value="{{ $idx }}" {{ in_array($idx, (array) ($d->practice_days ?? []), true) ? 'checked' : '' }}>
                                                                        <span>{{ $label }}</span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <label class="form-field">
                                                            <span>Jam Mulai</span>
                                                            <input name="practice_start_time" type="time" value="{{ $start }}">
                                                        </label>
                                                        <label class="form-field">
                                                            <span>Jam Selesai</span>
                                                            <input name="practice_end_time" type="time" value="{{ $end }}">
                                                        </label>
                                                    </div>
                                                    <div class="form-actions">
                                                        <button type="submit" class="btn save-role">Simpan</button>
                                                    </div>
                                                </form>
                                            </details>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="users-row">
                                        <td colspan="5" style="padding:18px 16px;color:#6b7280">Belum ada dokter.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .page-title{font-weight:800;font-size:22px}
    .text-muted{color:#9aa3a0;font-size:13px;margin-top:6px}
    .btn{padding:8px 12px;border-radius:10px;border:none;cursor:pointer}
    .btn-primary{background:#5f6f65;color:#fff;border:1px solid rgba(95,111,101,0.2);padding:8px 14px}
    .page-header{display:flex;justify-content:space-between;align-items:center}

    .settings-layout{display:flex;gap:16px;align-items:flex-start}
    .settings-sidebar{width:200px;background:#fff;border-radius:8px;padding:0;box-shadow:0 1px 4px rgba(0,0,0,0.03);height:fit-content;overflow:hidden;border:1px solid rgba(0,0,0,0.06)}
    .settings-sidebar .tab{padding:16px 18px;font-weight:500;cursor:pointer;border:none;outline:none;text-align:left;width:100%;background:#fff;color:#222;border-bottom:1px solid #e5e7eb;transition:background 0.2s;border-radius:0}
    .settings-sidebar .tab.active{background:#B08D70;color:#fff}
    .settings-sidebar .tab:last-child{border-bottom:none}
    .settings-main{flex:1;min-width:0}
    .panel{display:none}
    .panel.active{display:block}

    @media (max-width: 900px){
        .settings-layout{flex-direction:column}
        .settings-sidebar{width:100%}
    }

    .card-head{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:14px}
    .card-title{font-weight:800;font-size:18px;color:#111827}
    .card-subtitle{color:#9aa3a0;font-size:13px;margin-top:4px}

    .users-card{background: #fbf9f6;padding:22px;border-radius:10px;border:1px solid rgba(0,0,0,0.03)}
    .users-table{width:100%}
    .users-table thead th{background:transparent;color:#111827;font-weight:700;padding:18px 16px;text-align:left}
    .users-row{border-bottom:1px solid #f3f4f6}
    .users-row td{padding:18px 16px;vertical-align:middle}
    .col-id{width:60px;color:#4b5563}
    .col-actions{width:72px;display:flex;gap:8px;align-items:center;justify-content:flex-start}

    /* gear button appearance: small white circular inset like screenshot */
    .settings-summary{cursor:pointer;border-radius:50%;display:inline-flex;width:28px;height:28px;align-items:center;justify-content:center;border:1px solid rgba(0,0,0,0.06);background:#fff;color:#111827;font-size:12px}
    .settings-details[open] .settings-summary{background:#fff}
    .settings-summary{cursor:pointer;padding:6px 8px;border-radius:8px;color:#111827}
    .settings-details[open] .settings-summary{background:#fff}
    .role-form{margin-top:8px;display:flex;gap:8px;align-items:center;padding:8px}
    .role-select{padding:8px;border-radius:8px;border:1px solid #e5e7eb}
    .save-role{background:#f3f4f6;color:#111827;border-radius:8px;padding:8px 10px;border:none}

    /* Doctor forms */
    details.add-doctor summary{list-style:none}
    details.add-doctor summary::-webkit-details-marker{display:none}
    details.add-doctor[open] summary{opacity:0.92}

    .doctor-form{margin-top:10px;background:#fff;border:1px solid rgba(0,0,0,0.06);border-radius:10px;padding:12px}
    .form-grid{display:grid;grid-template-columns:1fr;gap:10px}
    @media (min-width: 640px){
        .form-grid{grid-template-columns: 1fr 1fr}
        .form-grid .form-field:nth-child(3){grid-column: 1 / -1}
    }
    .form-field span{display:block;font-size:12px;color:#6b7280;margin-bottom:6px;font-weight:700}
    .form-field input{width:100%;padding:10px 10px;border-radius:8px;border:1px solid #e5e7eb;background:#fff}
    .days-grid{display:grid;grid-template-columns:1fr 1fr;gap:6px}
    @media (min-width: 640px){
        .days-grid{grid-template-columns: 1fr 1fr 1fr}
    }
    .day-item{display:flex;align-items:center;gap:8px;border:1px solid #eef2f7;background:#fbfbfb;border-radius:8px;padding:8px}
    .day-item span{font-size:12px;color:#374151;font-weight:600}
    .form-actions{margin-top:10px;display:flex;justify-content:flex-end;gap:8px}

    @media (max-width:768px){
        .container{padding:8px}
        .card{padding:12px}
    }
</style>

<script>
    (function(){
        document.addEventListener('DOMContentLoaded', function(){
            var tabs = Array.from(document.querySelectorAll('.settings-sidebar .tab'));
            if(!tabs.length) return;

            function activate(which){
                tabs.forEach(function(b){ b.classList.toggle('active', b.dataset.tab === which); });
                var usersPanel = document.getElementById('panel-users');
                var doctorsPanel = document.getElementById('panel-doctors');
                if(usersPanel) usersPanel.classList.toggle('active', which === 'users');
                if(doctorsPanel) doctorsPanel.classList.toggle('active', which === 'doctors');
            }

            tabs.forEach(function(btn){
                btn.addEventListener('click', function(){
                    activate(this.dataset.tab);
                });
            });

            // default
            activate('users');
        });
    })();
</script>

@endsection
