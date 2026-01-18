<div class="doctor-panel">
    <div class="panel-card">
        <div class="panel-header">
            <div>
                <h3 class="panel-title">Dashboard Dokter</h3>
                <p class="panel-subtitle">Ringkasan hari ini untuk {{ $doctor->name ?? 'Semua Dokter' }} ({{ $date ?? now()->toDateString() }})</p>
            </div>

            <div class="panel-date-controls" data-date="{{ $date ?? now()->toDateString() }}">
                <button type="button" class="date-arrow" id="prevDate">‹</button>
                <div class="date-display">
                    @php
                        $d = \Carbon\Carbon::parse($date ?? now());
                        $d = $d->locale(app()->getLocale() ?: 'id');
                    @endphp
                    <div class="day-name">{{ $d->isoFormat('dddd') }}</div>
                    <div class="date-text">{{ $d->isoFormat('D MMMM YYYY') }}</div>
                </div>
                <button type="button" class="date-arrow" id="nextDate">›</button>
                <button type="button" class="today-btn" id="todayBtn">HARI INI</button>
            </div>
        </div>

        <div class="panel-body">
            @if(!empty($doctor_mapping_warning))
                <div style="margin:0 0 12px 0;padding:10px 12px;border:1px solid #fde68a;background:#fffbeb;color:#92400e;border-radius:10px;font-size:13px;line-height:1.4">
                    {{ $doctor_mapping_warning }}
                </div>
            @endif
            @include('doctor.partials.appointments', ['appointments' => $appointments])
        </div>
    </div>

    <!-- quick actions removed per request -->

<script>
    (function(){
        const container = document.querySelector('.panel-date-controls');
        if(!container) return;
        const prev = document.getElementById('prevDate');
        const next = document.getElementById('nextDate');
        const today = document.getElementById('todayBtn');

        // parse YYYY-MM-DD into a local Date (avoid timezone shifts)
        function parseDate(s){
            const parts = (s || '').split('-').map(Number);
            if(parts.length !== 3 || parts.some(isNaN)){
                const n = new Date();
                return new Date(n.getFullYear(), n.getMonth(), n.getDate());
            }
            return new Date(parts[0], parts[1]-1, parts[2]);
        }

        // format Date to YYYY-MM-DD using local components (no toISOString)
        function toISOLocal(d){
            const y = d.getFullYear();
            const m = String(d.getMonth()+1).padStart(2,'0');
            const dd = String(d.getDate()).padStart(2,'0');
            return y + '-' + m + '-' + dd;
        }

        const base = container.dataset.date || (new Date()).toLocaleDateString('en-CA');
        prev && prev.addEventListener('click', function(){
            const d = parseDate(base);
            d.setDate(d.getDate() - 1);
            window.location.search = '?date=' + toISOLocal(d);
        });
        next && next.addEventListener('click', function(){
            const d = parseDate(base);
            d.setDate(d.getDate() + 1);
            window.location.search = '?date=' + toISOLocal(d);
        });
        today && today.addEventListener('click', function(){
            const n = new Date();
            const d = new Date(n.getFullYear(), n.getMonth(), n.getDate());
            window.location.search = '?date=' + toISOLocal(d);
        });
    })();
</script>
</div>
