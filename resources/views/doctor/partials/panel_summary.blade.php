<div class="card" style="padding:14px">
    <h4 style="margin:0 0 8px 0">Dashboard Dokter</h4>
    <p style="color:var(--muted);font-size:13px;margin-bottom:8px">Ringkasan hari ini ({{ $date ?? now()->toDateString() }})</p>

    @if($appointments->isEmpty())
        <div style="color:var(--muted);font-size:13px">Tidak ada janji temu untuk tanggal ini.</div>
    @else
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:8px">
            @foreach($appointments->take(4) as $a)
                <li style="display:flex;justify-content:space-between;align-items:center">
                    <div style="font-size:13px">{{ \Carbon\Carbon::parse($a->start_at)->format('H:i') }} — {{ $a->patient_name }}</div>
                    <div style="color:var(--muted);font-size:13px">{{ ucfirst($a->status) }}</div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
