<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Harga Prosedur - Hanglekiu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Poppins',sans-serif;background:#f6f7fb;display:flex;min-height:100vh}
        .main{margin-left:60px;flex:1;padding:20px}
        .card{background:#fff;border-radius:12px;padding:18px;box-shadow:0 6px 18px rgba(0,0,0,0.06)}
        .page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
        .page-title{font-size:20px;font-weight:700;color:#0f172a}
        .actions{display:flex;gap:10px;align-items:center}
        .btn{padding:10px 14px;border-radius:8px;background:linear-gradient(135deg,#5BA3E0 0%,#3B82C4 100%);color:#fff;border:none;cursor:pointer}
        .btn.ghost{background:#fff;border:1px solid #e5e7eb;color:#374151}
        .search-form{display:flex;gap:10px;align-items:center}
        .search-input{padding:10px;border:1px solid #e5e7eb;border-radius:8px;width:260px}
        .table{width:100%;border-collapse:collapse;margin-top:12px}
        .table th{text-align:left;padding:12px;border-bottom:1px solid #f1f5f9;color:#6b7280;font-size:13px}
        .table td{padding:14px;border-bottom:1px solid #f8fafc;color:#374151}
        .price{color:#6b7280;font-weight:600}
        /* page-specific layout adjustments */
        .main{margin-left:60px;flex:1;padding:20px;padding-top:96px}
        .card{background:#fff;border-radius:12px;padding:22px 24px;box-shadow:0 6px 18px rgba(0,0,0,0.06);margin:6px 18px}
        @media (max-width: 992px){.search-input{width:160px}.page-header{flex-direction:column;align-items:flex-start;gap:12px}}
        @media (max-width: 480px){.search-input{width:120px}.page-title{font-size:18px;padding-right:6px}}
    </style>
</head>
<body>
    @include('partials.sidebar')
    @include('partials.topbar')

    <main class="main">
        <div class="card">
            <div class="page-top" aria-hidden="true">
                <button id="pageHamburger" class="page-hamburger" aria-label="Toggle sidebar" type="button" title="Menu" aria-expanded="false">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
                <hr class="page-sep">
            </div>

            <!-- page header and search moved to topbar -->

            <div style="overflow:auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:40px"><input type="checkbox"></th>
                            <th>Nama Prosedur</th>
                            <th>Catatan</th>
                            <th style="width:160px">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($procedures as $p)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $p['name'] }}</td>
                            <td>{{ $p['note'] }}</td>
                            <td class="price">Rp{{ number_format($p['price'],0,',','.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center;padding:20px;color:#9ca3af">Tidak ada prosedur</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <style>
        /* Procedures page responsive tweaks */
        .page-top{display:none}
        .page-sep{border:none;height:1px;background:#eef2f6;border-radius:2px;margin:0}
        @media (max-width: 992px) {
            .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .actions { width: 100%; display:flex; gap:8px; justify-content:flex-end }
            .search-form { width: 100%; }
            .search-input { width: 100%; }
        }

        @media (max-width: 992px) {
            .main { margin-left: 0; padding: 12px; }
            .page-hamburger { display:inline-flex; background:#1a365d;color:#fff;border-radius:999px;width:44px;height:44px;align-items:center;justify-content:center;border:none;box-shadow:0 8px 20px rgba(10,25,50,0.28);flex-shrink:0;margin-right:8px }
            .page-hamburger i{font-size:16px}
            .page-header .page-title{margin-top:0}
            .table th, .table td { padding: 10px; }
            .page-top{display:flex;flex-direction:column;gap:8px;margin-bottom:8px}
            .page-top .page-hamburger{align-self:flex-start}
        }

        /* hidden by default on larger screens */
        .page-hamburger{display:none}

        /* when sidebar is open reflect state */
        .page-hamburger[aria-expanded="true"]{background:#0f172a}
    </style>

    <script>
        // Close off-canvas sidebar when navigating on mobile
        document.addEventListener('DOMContentLoaded', function(){
            const pageH = document.getElementById('pageHamburger');
            const sidebar = document.getElementById('appSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

            document.querySelectorAll('.sidebar-item').forEach(el=>{
                el.addEventListener('click', function(){
                    if(sidebar && sidebar.classList.contains('open')){
                        sidebar.classList.remove('open');
                        if(pageH) pageH.setAttribute('aria-expanded','false');
                    }
                    if(backdrop && backdrop.classList.contains('show')) backdrop.classList.remove('show');
                });
            });

            // Page-level hamburger toggles same sidebar for convenience
            if(pageH && sidebar){
                pageH.addEventListener('click', function(){
                    const isOpen = sidebar.classList.toggle('open');
                    if(backdrop) backdrop.classList.toggle('show');
                    pageH.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            }
        });
    </script>

</body>
</html>
