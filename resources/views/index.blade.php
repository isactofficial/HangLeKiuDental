<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Hanglekiu Dental Specialist</title>
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body class="bg-[#FDFDFC] text-[#1b1b18]">
    @include('partials.header')

    <section class="hero" style="min-height:420px;display:flex;align-items:center">
        <div style="max-width:1200px;margin:0 auto;padding:0 24px;display:flex;gap:32px;align-items:center;position:relative;width:100%">
            <div class="carousel" style="width:100%;min-height:420px">
                <div class="slide active" style="background-image:url('{{ asset('assets/hanglekiu.webp') }}')"></div>
                <div class="slide" style="background-image:url('{{ asset('assets/hanglekiu2.webp')}}')"></div>
                <div class="slide" style="background-image:url('{{ asset('assets/hanglekiu3.webp') }}')"></div>
                <!-- <div class="slide" style="background-image:url('{{ asset('assets/hanglekiu4.jpg') }}')"></div> -->

                <div class="carousel-dots" aria-hidden="false">
                    <div class="dot active" data-index="0"></div>
                    <div class="dot" data-index="1"></div>
                    <div class="dot" data-index="2"></div>
                </div>
            </div>
            <!-- Text block moved below carousel -->
            <div class="carousel-overlay" style="max-width:700px;margin:18px 24px 0 24px;color:#1b1b18">
                <h1 style="font-size:34px;margin-bottom:12px;color:var(--text,#1b1b18);">Perawatan Gigi yang Lebih Nyaman & Eksklusif</h1>
                <p style="color:#706f6c;margin-bottom:18px">Layanan personal, suasana homey dan perawatan dari dokter ahli di Jakarta</p>
                <!-- Blok tombol klinik dihapus sesuai permintaan -->
            </div>
        </div>
    </section>

    <main style="max-width:1200px;margin:28px auto;padding:0 24px">
        <section id="layanan" class="layanan-section" style="margin:28px 0">
            <h2 style="color:#B08D70;margin-bottom:6px">Layanan & Perawatan</h2>
            <p style="color:#706f6c;margin-bottom:18px">Mulai dari pembersihan hingga perawatan estetika, dilakukan oleh tenaga ahli sesuai kebutuhan Anda.</p>

            <div class="services-wrapper">
                <button class="service-nav service-prev" aria-label="Previous">‹</button>
                <div class="services services-cards services-track">
                <div class="service-card">
                    <div class="card-image">
                        <img src="{{ asset('assets/antricepat1.png') }}" alt="scaling">
                    </div>
                    <div class="card-content">
                        <h3 class="service-title">Scaling & Pembersihan</h3>
                        <p class="service-desc">Pembersihan karang gigi dan plak untuk membantu mencegah radang gusi, bau mulut, dan menjaga kesehatan mulut.</p>
                        <a href="{{ route('layanan.show', ['slug' => 'scaling']) }}" class="service-link">Info Selengkapnya →</a>
                    </div>
                </div>

                <div class="service-card">
                    <div class="card-image">
                        <img src="{{ asset('assets/antricepat2.png') }}" alt="orthodontics">
                    </div>
                    <div class="card-content">
                        <h3 class="service-title">Orthodontics</h3>
                        <p class="service-desc">Perawatan perapihan gigi untuk memperbaiki susunan gigi dan gigitan agar lebih sehat, nyaman, dan rapi.</p>
                        <a href="{{ route('layanan.show', ['slug' => 'orthodontics']) }}" class="service-link">Info Selengkapnya →</a>
                    </div>
                </div>

                <div class="service-card">
                    <div class="card-image">
                        <img src="{{ asset('assets/antricepat3.png') }}" alt="veneer">
                    </div>
                    <div class="card-content">
                        <h3 class="service-title">Veneer & Estetika</h3>
                        <p class="service-desc">Lapisan tipis pada permukaan gigi untuk membantu memperbaiki bentuk, warna, dan tampilan senyum.</p>
                        <a href="{{ route('layanan.show', ['slug' => 'veneer']) }}" class="service-link">Info Selengkapnya →</a>
                    </div>
                </div>

                <div class="service-card">
                    <div class="card-image">
                        <img src="{{ asset('assets/antricepat4.png') }}" alt="tambah1">
                    </div>
                    <div class="card-content">
                        <h3 class="service-title">Tambalan Gigi</h3>
                        <p class="service-desc">Perawatan penambalan untuk memperbaiki gigi berlubang atau retak sehingga fungsi dan bentuk gigi kembali baik.</p>
                        <a href="{{ route('layanan.show', ['slug' => 'tambal-gigi']) }}" class="service-link">Info Selengkapnya →</a>
                    </div>
                </div>

                <div class="service-card">
                    <div class="card-image">
                        <img src="{{ asset('assets/antricepat5.png') }}" alt="tambah2">
                    </div>
                    <div class="card-content">
                        <h3 class="service-title">Bleaching</h3>
                        <p class="service-desc">Perawatan pemutihan gigi untuk membantu mengurangi noda dan membuat warna gigi tampak lebih cerah.</p>
                        <a href="{{ route('layanan.show', ['slug' => 'bleaching']) }}" class="service-link">Info Selengkapnya →</a>
                    </div>
                </div>

                <div class="service-card">
                    <div class="card-image">
                        <img src="{{ asset('assets/antricepat6.png') }}" alt="tambah3">
                    </div>
                    <div class="card-content">
                        <h3 class="service-title">Cabut Gigi</h3>
                        <p class="service-desc">Tindakan pencabutan gigi yang sudah tidak dapat dipertahankan, dilakukan dengan prosedur yang aman dan nyaman.</p>
                        <a href="{{ route('layanan.show', ['slug' => 'pencabutan-gigi']) }}" class="service-link">Info Selengkapnya →</a>
                    </div>
                </div>
                </div>
                <button class="service-nav service-next" aria-label="Next">›</button>
            </div>

            <div class="services-dots" aria-hidden="false">
                <span class="dot small active"></span>
                <span class="dot small"></span>
                <span class="dot small"></span>
                <span class="dot small"></span>
            </div>
        </section>

        <section id="dokter" style="margin:36px 0;display:flex;align-items:center;gap:28px">
            <div style="flex:1">
                <h2 style="color:#B08D70">Meet Our Dentist</h2>
                <p style="color:#706f6c">Kami percaya bahwa senyum terbaik dimulai dari tangan yang tepat.</p>
                <a href="#" class="btn-cta" style="display:inline-block;margin-top:12px">Konsultasi Gratis Sekarang</a>
            </div>
            <div style="width:420px;display:flex;gap:8px;align-items:center">
                <img src="{{ asset('assets/dokter.png') }}" alt="team" style="width:100%;border-radius:14px;object-fit:cover">
            </div>
        </section>

        <section style="margin:36px 0">
            <h2 style="color:#B08D70">Partner Asuransi</h2>
            <div class="partners" style="margin-top:12px">
                <img src="{{ asset('assets/antricepat4.png') }}" alt="partner" style="height:36px;object-fit:contain">
                <img src="{{ asset('assets/telekonsultasi1.png') }}" alt="partner" style="height:36px;object-fit:contain">
                <img src="{{ asset('assets/telekonsultasi2.png') }}" alt="partner" style="height:36px;object-fit:contain">
                <img src="{{ asset('assets/telekonsultasi3.png') }}" alt="partner" style="height:36px;object-fit:contain">
            </div>
        </section>

        @include('partials.review')
    </main>

    <footer style="background:#fff;padding:28px 24px;border-top:1px solid #eee">
        <div style="max-width:1200px;margin:0 auto;display:flex;justify-content:space-between;align-items:flex-start;gap:24px">
            <div>
                <strong>Hanglekiu Dental Specialist</strong>
                <div style="color:#706f6c;margin-top:6px">Jl. Dharmawangsa Raya No.8a, Jakarta Selatan</div>
            </div>
            <div style="color:#706f6c">© {{ date('Y') }} Hanglekiu Dental Specialist. All rights reserved.</div>
        </div>
    </footer>
    <script>
        // Carousel auto-rotate every 4 seconds
        (function(){
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.dot');
            if(!slides.length) return;
            let idx = 0;
            const setActive = (n) => {
                slides.forEach((s,i)=> s.classList.toggle('active', i===n));
                dots.forEach((d,i)=> d.classList.toggle('active', i===n));
                idx = n;
            };
            let timer = setInterval(()=> setActive((idx+1) % slides.length), 3000);
            // dots click
            dots.forEach(d=> d.addEventListener('click', (e)=>{
                const i = parseInt(d.getAttribute('data-index')) || 0;
                setActive(i);
                clearInterval(timer);
                timer = setInterval(()=> setActive((idx+1) % slides.length), 3000);
            }));
        })();
        // Services carousel (prev/next)
        (function(){
            const track = document.querySelector('.services-track');
            const prev = document.querySelector('.service-prev');
            const next = document.querySelector('.service-next');
            const dotsContainer = document.querySelector('.services-dots');
            if(!track) return;
            const cards = Array.from(track.querySelectorAll('.service-card'));
            let page = 0;

            function getVisibleCount(){
                const w = window.innerWidth;
                if(w >= 992) return 3;
                if(w >= 768) return 2;
                return 1;
            }

            function buildDots(){
                const visible = getVisibleCount();
                const pages = Math.max(1, Math.ceil(cards.length / visible));
                dotsContainer.innerHTML = '';
                const dots = [];
                for(let i=0;i<pages;i++){
                    const el = document.createElement('span');
                    el.className = 'dot small' + (i===0? ' active':'');
                    el.dataset.page = i;
                    el.addEventListener('click', ()=> scrollToPage(i));
                    dotsContainer.appendChild(el);
                    dots.push(el);
                }
                return dots;
            }

            let dots = buildDots();

            function updateDots(){
                dots.forEach((d,i)=> d.classList.toggle('active', i===page));
            }

            function scrollToPage(p){
                const visible = getVisibleCount();
                const startIndex = p * visible;
                const card = cards[startIndex] || cards[cards.length-1];
                const left = card.offsetLeft - track.offsetLeft;
                track.scrollTo({left:left,behavior:'smooth'});
                page = p;
                updateDots();
            }

            prev && prev.addEventListener('click', ()=>{
                const visible = getVisibleCount();
                const pages = Math.ceil(cards.length / visible);
                page = Math.max(0, page - 1);
                scrollToPage(page);
            });
            next && next.addEventListener('click', ()=>{
                const visible = getVisibleCount();
                const pages = Math.ceil(cards.length / visible);
                page = Math.min(pages-1, page + 1);
                scrollToPage(page);
            });

            // update on resize
            let resizeTimer;
            window.addEventListener('resize', ()=>{
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(()=>{
                    const oldDots = dots;
                    dots = buildDots();
                    // ensure current page in range
                    const visible = getVisibleCount();
                    const pages = Math.ceil(cards.length / visible);
                    if(page >= pages) page = pages-1;
                    updateDots();
                    scrollToPage(page);
                },160);
            });

            // ensure first page visible
            scrollToPage(0);

            // sync page on manual scroll (snap to closest page)
            let scrollTimer;
            track.addEventListener('scroll', ()=>{
                clearTimeout(scrollTimer);
                scrollTimer = setTimeout(()=>{
                    const visible = getVisibleCount();
                    const center = track.scrollLeft + track.clientWidth/2;
                    let closestPage = 0; let bestDiff = Infinity;
                    const pages = Math.ceil(cards.length / visible);
                    for(let p=0;p<pages;p++){
                        const startIdx = p * visible;
                        const c = cards[startIdx];
                        if(!c) continue;
                        const cCenter = c.offsetLeft + c.offsetWidth/2 - track.offsetLeft;
                        const diff = Math.abs(cCenter - center);
                        if(diff < bestDiff){ bestDiff = diff; closestPage = p }
                    }
                    page = closestPage; updateDots();
                },120);
            });
        })();
    </script>
</body>
</html>
