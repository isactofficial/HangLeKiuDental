<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Prosedur - Hanglekiu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Poppins',sans-serif;background:var(--main-bg);display:flex;min-height:100vh;color:var(--text)}
        .main{margin-left:var(--sidebar-width);flex:1;padding:20px;padding-top:140px}
        .card{background:var(--surface);border-radius:12px;padding:22px 24px;box-shadow:0 6px 18px rgba(0,0,0,0.06);margin:12px}
        .title{font-size:20px;font-weight:700;margin-bottom:14px}
        .form{display:grid;grid-template-columns:1fr;gap:14px;max-width:720px}
        .field label{display:block;font-size:12px;font-weight:700;color:var(--muted);margin-bottom:6px}
        .field input,.field textarea{width:100%;padding:10px 12px;border:1px solid rgba(0,0,0,0.08);border-radius:10px;background:var(--surface);color:var(--text)}
        .field textarea{min-height:90px;resize:vertical}
        .row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
        .actions{display:flex;gap:10px;justify-content:flex-end;margin-top:8px}
        .btn{padding:10px 14px;border-radius:10px;background:var(--accent);color:#fff;border:none;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px}
        .btn.ghost{background:transparent;border:1px solid rgba(0,0,0,0.10);color:var(--text)}
        .alert{padding:10px 12px;border-radius:10px;margin-bottom:12px}
        .alert.error{background:#fee2e2;color:#991b1b}

        @media (max-width: 992px){
            .main{margin-left:0;padding:12px;padding-top:170px}
            .card{margin:6px}
            .row{grid-template-columns:1fr}
        }
    </style>
</head>
<body>
    @include('partials.sidebar')
    @include('partials.topbar')

    <main class="main">
        <div class="card">
            <div class="title">Tambah Prosedur</div>

            @if ($errors->any())
                <div class="alert error">
                    <ul style="margin-left:18px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form" method="POST" action="{{ route('procedures.store') }}">
                @csrf

                <div class="field">
                    <label>Nama Prosedur *</label>
                    <input name="name" type="text" value="{{ old('name') }}" placeholder="Contoh: Scaling" required>
                </div>

                <div class="field">
                    <label>Catatan</label>
                    <textarea name="note" placeholder="Catatan (opsional)">{{ old('note') }}</textarea>
                </div>

                <div class="row">
                    <div class="field">
                        <label>Harga (Rp) *</label>
                        <input name="price" type="number" min="0" step="1" value="{{ old('price', 0) }}" required>
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select name="is_active" style="width:100%;padding:10px 12px;border:1px solid rgba(0,0,0,0.08);border-radius:10px;background:var(--surface);color:var(--text)">
                            <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="actions">
                    <a class="btn ghost" href="{{ route('procedures.index') }}">Batal</a>
                    <button class="btn" type="submit"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
