<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Medis</title>
    <style>
        :root { --text:#111827; --muted:#4b5563; --line:#111; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; color: var(--text); background:#fff; }
        .page { max-width: 800px; margin: 0 auto; padding: 28px 30px 34px; }

        .top { display:flex; gap: 18px; align-items:flex-start; }
        .logo { width:72px; height:72px; border-radius:50%; border: 3px solid #777; overflow:hidden; display:flex; align-items:center; justify-content:center; background:#fff; }
        .logo img { width:100%; height:100%; object-fit: cover; display:block; }
        .clinic { flex:1; }
        .clinic .name { font-weight: 800; font-size: 14px; margin-top: 4px; }
        .clinic .addr { font-size: 11px; color: var(--muted); line-height: 1.35; margin-top: 6px; }
        .hr { border-top: 1px solid var(--line); margin: 14px 0 18px; }

        h1 { margin: 0 0 14px; text-align:center; font-size: 18px; }

        .info { display:grid; grid-template-columns: 1fr 1fr; gap: 26px; font-size: 11px; }
        .info .row { display:grid; grid-template-columns: 92px 10px 1fr; margin: 4px 0; }
        .info .k { color:#111; }
        .info .v { color: var(--muted); }

        .section-table { width:100%; border-collapse: collapse; margin-top: 12px; font-size: 11px; }
        .section-table td { border: 1px solid #666; padding: 8px 10px; vertical-align: top; }
        .section-table .label { width: 140px; color:#111; }
        .note-title { font-weight: 700; margin-bottom: 4px; }
        .note { white-space: pre-wrap; color: var(--muted); line-height: 1.35; }

        .actions { display:flex; justify-content:flex-end; gap: 10px; margin-bottom: 10px; }
        .btn { border: 1px solid #111; background:#fff; padding: 8px 12px; cursor:pointer; font-size: 12px; }

        @media print {
            .actions { display:none !important; }
            .page { max-width: none; padding: 0; margin: 0; }
        }
    </style>
</head>
<body>
@php
    $doctorName = $appointment->doctor?->name ?: '-';
    $doctorSpec = $appointment->doctor?->specialty ?: '';
    $doctorText = trim($doctorName . ' ' . $doctorSpec);

    $dateText = $appointment->start_at ? $appointment->start_at->format('d M Y H:i') : '-';

    $gender = $appointment->patient_gender ?: '-';
    $birth = $appointment->patient_birth_date ? $appointment->patient_birth_date->format('d-m-Y') : '-';

    $latestNote = $appointment->doctorNotes?->sortByDesc('created_at')->first();
    $noteText = $latestNote?->note ?: '-';

    $procedureNames = collect([
        $appointment->procedure,
    ])->filter()->merge($appointment->procedureRecords?->pluck('name') ?? collect())
      ->filter()->unique()->values();
@endphp

<div class="page">
    <div class="actions">
        <button class="btn" onclick="history.back()">Kembali</button>
        <button class="btn" onclick="window.print()">Print</button>
    </div>

    <div class="top">
        <div class="logo">
            <img id="printLogo" src="{{ asset('assets/logo2.jpeg') }}" alt="Logo">
        </div>
        <div class="clinic">
            <div class="name">Hanglekiu Dental Specialist</div>
            <div class="addr">
                8. Jl. Hang Lekiu V No.8<br>
                Kebayoran Baru, Kota Jakarta Selatan<br>
                Daerah Khusus Ibukota Jakarta
            </div>
        </div>
    </div>

    <div class="hr"></div>

    <h1>Resume Medis</h1>

    <div class="info">
        <div>
            <div class="row"><div class="k">Nomor MR</div><div>:</div><div class="v">{{ $appointment->medical_record_number ?: '-' }}</div></div>
            <div class="row"><div class="k">Nama</div><div>:</div><div class="v">{{ $appointment->patient_name ?: '-' }}</div></div>
            <div class="row"><div class="k">Tempat Tanggal</div><div>:</div><div class="v">- , {{ $birth }}</div></div>
            <div class="row"><div class="k">Jenis Kelamin</div><div>:</div><div class="v">{{ $gender }}</div></div>
            <div class="row"><div class="k">Alamat</div><div>:</div><div class="v">-</div></div>
        </div>
        <div>
            <div class="row"><div class="k">Tanggal</div><div>:</div><div class="v">{{ $dateText }}</div></div>
            <div class="row"><div class="k">Pemeriksaan</div><div>:</div><div class="v">{{ $appointment->procedure ?: '-' }}</div></div>
            <div class="row"><div class="k">Dokter</div><div>:</div><div class="v">{{ $doctorText ?: '-' }}</div></div>
            <div class="row"><div class="k">Perawat</div><div>:</div><div class="v">-</div></div>
            <div class="row"><div class="k">Analisa Lab</div><div>:</div><div class="v">-</div></div>
            <div class="row"><div class="k">Poli</div><div>:</div><div class="v">Gigi</div></div>
        </div>
    </div>

    <table class="section-table">
        <tr>
            <td class="label">Catatan Dokter</td>
            <td>
                <div class="note"><span class="note-title">Catatan:</span>
{{ $noteText }}</div>
            </td>
        </tr>
        <tr>
            <td class="label">Prosedur</td>
            <td class="note">
                @if($procedureNames->isEmpty())
                    -
                @else
                    {{ $procedureNames->join(', ') }}
                @endif
            </td>
        </tr>
    </table>
</div>

<script>
    window.addEventListener('load', function(){
        // Auto open print dialog (wait logo load so it appears in print)
        var logo = document.getElementById('printLogo');
        var printed = false;
        function doPrint(){
            if(printed) return;
            printed = true;
            window.print();
        }

        if (logo && !logo.complete) {
            logo.addEventListener('load', function(){ setTimeout(doPrint, 50); });
            logo.addEventListener('error', function(){ setTimeout(doPrint, 50); });
            setTimeout(doPrint, 900);
        } else {
            setTimeout(doPrint, 50);
        }
    });
</script>
</body>
</html>
