<div>
    <h4 style="margin:0 0 12px 0;font-size:16px;font-weight:600;color:var(--text)">Janji Temu</h4>

    @if($appointments->isEmpty())
        <div style="color:var(--muted)">Tidak ada janji temu untuk tanggal ini.</div>
    @else
        <table style="width:100%;border-collapse:collapse">
            <thead style="text-align:left;color:var(--muted);font-size:13px;font-weight:600">
                <tr>
                    <th style="padding:10px 6px">Waktu</th>
                    <th style="padding:10px 6px">Pasien</th>
                    <th style="padding:10px 6px">Dokter</th>
                    <th style="padding:10px 6px">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $a)
                    <tr style="border-top:1px solid #eef2f7">
                        <td style="padding:14px 6px;vertical-align:top;width:160px">{{ \Carbon\Carbon::parse($a->start_at)->format('H:i') }} - {{ \Carbon\Carbon::parse($a->end_at)->format('H:i') }}</td>
                        <td style="padding:14px 6px;vertical-align:top">{{ $a->patient_name }}</td>
                        <td style="padding:14px 6px;vertical-align:top">{{ $a->doctor->name ?? ($doctor->name ?? '-') }}</td>
                        <td style="padding:14px 6px;vertical-align:top;color:var(--muted)">{{ ucfirst($a->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
