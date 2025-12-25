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
        body{font-family:'Poppins',sans-serif;background:var(--main-bg);display:flex;min-height:100vh;color:var(--text)}

        /* Layout containers */
        .main{margin-left:var(--sidebar-width);flex:1;padding:20px;padding-top:72px}
        .card{background:var(--surface);border-radius:12px;padding:22px 24px;box-shadow:0 6px 18px rgba(0,0,0,0.06);margin:12px 12px}

        /* Header and controls */
        .page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
        .page-title{font-size:20px;font-weight:700;color:var(--text)}
        .actions{display:flex;gap:10px;align-items:center}
        .btn{padding:10px 14px;border-radius:8px;background:var(--accent);color:#fff;border:none;cursor:pointer}
        .btn.ghost{background:var(--surface);border:1px solid rgba(0,0,0,0.06);color:var(--text)}
        .search-form{display:flex;gap:10px;align-items:center}
        .search-input{padding:10px;border:1px solid rgba(0,0,0,0.06);border-radius:8px;width:260px;min-width:0;background:var(--surface);color:var(--text)}

        /* Table */
        .table{width:100%;border-collapse:collapse;margin-top:12px}
        .table th{text-align:left;padding:12px;border-bottom:1px solid rgba(0,0,0,0.04);color:var(--muted);font-size:13px}
        .table td{padding:14px;border-bottom:1px solid rgba(0,0,0,0.04);color:var(--text);vertical-align:middle}
        .price{color:var(--text);font-weight:600}

        /* Small/stacked card style for narrow viewports */
        @media (max-width: 768px){
            .main{margin-left:0;padding:12px;padding-top:84px}
            .card{margin:6px;padding:12px}
            .page-header{flex-direction:column;align-items:flex-start;gap:12px}
            .search-input{width:100%}

            /* convert table into stacked list for readability */
            .table thead{display:none}
            .table tr{display:block;margin-bottom:12px;border-radius:10px;background:#fff;padding:12px;box-shadow:0 2px 10px rgba(0,0,0,0.04)}

            /* hide the checkbox column visually but keep accessible markup */
            .table td:first-child{display:none}

            /* each cell becomes a horizontal row: label + value */
            .table td{display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid #f3f4f6}
            .table td:last-child{border-bottom:none}
            .table td:before{content:attr(data-label);font-weight:600;color:var(--muted);margin-right:8px;display:inline-block;width:45%;font-size:12px}
            .table td > *:not(:before){width:55%}

            .table td.price{font-size:15px;font-weight:700;color:var(--text);text-align:right}
        }

        /* Medium screens tweak */
        @media (min-width:769px) and (max-width:992px){
            .search-input{width:160px}
            .page-header{gap:8px}
            .table th, .table td{padding:10px}
        }
    </style>
</head>
<body>
    @include('partials.sidebar')
    @include('partials.topbar')

    <main class="main">
        <div class="card">
            <!-- page-top (hidden on mobile because sidebar hamburger is provided by partials/sidebar) -->
            <div class="page-top" aria-hidden="true" style="display:none">
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
                            <td data-label="Pilih"><input type="checkbox"></td>
                            <td data-label="Nama Prosedur">{{ $p['name'] }}</td>
                            <td data-label="Catatan">{{ $p['note'] }}</td>
                            <td data-label="Total Harga" class="price">Rp{{ number_format($p['price'],0,',','.') }}</td>
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
            .main { margin-left: 0; padding: 12px; padding-top: 84px; }
            /* hide page-level hamburger to avoid duplicate with the sidebar hamburger */
            .page-hamburger { display:none }
            .page-header .page-title{margin-top:0}
            .table th, .table td { padding: 10px; }
            .page-top{display:none}
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
