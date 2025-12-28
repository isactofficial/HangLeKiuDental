<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking - Hanglekiu</title>
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        body{font-family:Poppins, sans-serif;background:var(--main-bg);color:var(--text);padding:24px}
        .card{background:var(--surface);padding:18px;border-radius:8px;max-width:720px;margin:0 auto}
        label{display:block;margin-bottom:6px;font-weight:600}
        input,select{width:100%;padding:10px;border-radius:6px;border:1px solid rgba(0,0,0,0.08);margin-bottom:12px}
        button{background:var(--action);color:#fff;padding:10px 12px;border-radius:6px;border:none}
    </style>
</head>
<body>
<div class="card">
    <h2>Booking Pasien</h2>
    @if($errors->any())
        <div style="color:#b91c1c;margin-bottom:12px">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('booking.store') }}">
        @csrf
        <label for="patient_name">Nama Pasien</label>
        <input id="patient_name" name="patient_name" value="{{ old('patient_name') }}" required>

        <label for="doctor_id">Pilih Dokter</label>
        <select id="doctor_id" name="doctor_id" required>
            <option value="">-- Pilih Dokter --</option>
            @foreach($doctors as $d)
                <option value="{{ $d->id }}" {{ (old('doctor_id') == $d->id || (isset($prefill['doctor_id']) && $prefill['doctor_id'] == $d->id)) ? 'selected' : '' }}>{{ $d->name }} {{ $d->specialty ? ' - '.$d->specialty : '' }}</option>
            @endforeach
        </select>

        <label for="date">Tanggal</label>
        <input id="date" name="date" type="date" value="{{ old('date', $prefill['date'] ?? date('Y-m-d')) }}" required>

        <label for="start_time">Jam Mulai (HH:MM)</label>
        <input id="start_time" name="start_time" type="time" value="{{ old('start_time', $prefill['start_time'] ?? '09:00') }}" required>

        <label for="end_time">Jam Selesai (HH:MM)</label>
        <input id="end_time" name="end_time" type="time" value="{{ old('end_time', $prefill['end_time'] ?? '10:00') }}" required>

        <button type="submit">Booking Sekarang</button>
    </form>
</div>
</body>
</html>
