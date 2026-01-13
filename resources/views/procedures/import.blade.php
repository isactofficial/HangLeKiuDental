<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Prosedur - Hanglekiu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Poppins',sans-serif;background:var(--main-bg);display:flex;min-height:100vh;color:var(--text)}
        .main{margin-left:var(--sidebar-width);flex:1;padding:20px;padding-top:140px}
        .card{background:var(--surface);border-radius:12px;padding:22px 24px;box-shadow:0 6px 18px rgba(0,0,0,0.06);margin:12px}
        .title{font-size:20px;font-weight:700;margin-bottom:10px}
        .hint{color:var(--muted);font-size:13px;margin-bottom:14px;line-height:1.5}
        .field label{display:block;font-size:12px;font-weight:700;color:var(--muted);margin-bottom:6px}
        .field input{width:100%;padding:10px 12px;border:1px solid rgba(0,0,0,0.08);border-radius:10px;background:var(--surface);color:var(--text)}
        .actions{display:flex;gap:10px;justify-content:flex-end;margin-top:12px}
        .btn{padding:10px 14px;border-radius:10px;background:var(--accent);color:#fff;border:none;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px}
        .btn.ghost{background:transparent;border:1px solid rgba(0,0,0,0.10);color:var(--text)}
        .alert{padding:10px 12px;border-radius:10px;margin-bottom:12px}
        .alert.error{background:#fee2e2;color:#991b1b}

        @media (max-width: 992px){
            .main{margin-left:0;padding:12px;padding-top:170px}
            .card{margin:6px}
        }
        code{background:rgba(0,0,0,0.05);padding:2px 6px;border-radius:8px}
    </style>
</head>
<body>
    @include('partials.sidebar')
    @include('partials.topbar')

    <main class="main">
        <div class="card">
            <div class="title">Import Harga Prosedur</div>
            <div class="hint">
                Upload file CSV. Format header yang didukung: <code>name,note,price,is_active</code>.
                Kalau tidak ada header, sistem akan anggap urutan kolom: <code>name,note,price,is_active</code>.
            </div>

            @if ($errors->any())
                <div class="alert error">
                    <ul style="margin-left:18px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('procedures.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <label>File CSV *</label>
                    <input type="file" name="file" accept=".csv,text/csv" required>
                </div>

                <div class="actions">
                    <a class="btn ghost" href="{{ route('procedures.index') }}">Batal</a>
                    <button class="btn" type="submit"><i class="fas fa-upload"></i> Import</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
