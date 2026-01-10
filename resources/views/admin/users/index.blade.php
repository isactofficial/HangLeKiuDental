@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <div>
            <div class="page-title">Manajemen Users</div>
            <div class="text-muted">Kelola role dan akun pengguna sistem</div>
        </div>
        <div class="actions">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
        </div>
    </div>

    @if(session('status'))
        <div style="padding:12px;background:#ecfdf5;border-radius:8px;margin:12px 0;color:#065f46">{{ session('status') }}</div>
    @endif

    <div class="card users-card" style="margin-top:18px">
        <div style="overflow:auto">
            <table class="table users-table" style="min-width:720px">
                <thead>
                    <tr>
                        <th style="padding:12px 16px;text-align:left">ID</th>
                        <th style="padding:12px 16px;text-align:left">Nama</th>
                        <th style="padding:12px 16px;text-align:left">Email</th>
                        <th style="padding:12px 16px;text-align:left">Role</th>
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
                            </details>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .page-title{font-weight:800;font-size:22px}
    .text-muted{color:#9aa3a0;font-size:13px;margin-top:6px}
    .btn{padding:8px 12px;border-radius:10px;border:none;cursor:pointer}
    .btn-primary{background:#5f6f65;color:#fff;border:1px solid rgba(95,111,101,0.2);padding:8px 14px}
    .page-header{display:flex;justify-content:space-between;align-items:center}

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

    @media (max-width:768px){
        .container{padding:8px}
        .card{padding:12px}
    }
</style>

@endsection
