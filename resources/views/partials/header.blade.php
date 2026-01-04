<header class="site-header">
    <div class="brand">
        <img src="{{ asset('assets/logo2.jpeg') }}" alt="logo">
        <div>
            <div class="brand-title">Hanglekiu</div>
            <div class="brand-subtitle">Dental Specialist</div>
        </div>
    </div>
    <nav class="nav">
        <a href="{{ url('/') }}" class="nav-link">Beranda</a>

        <div class="nav-dropdown">
            <a href="#" class="nav-link nav-dropdown-toggle" aria-haspopup="true">
                Layanan & Perawatan
                <span class="nav-caret">▾</span>
            </a>
            <div class="nav-dropdown-menu" role="menu" aria-label="Layanan & Perawatan">
                <a role="menuitem" href="{{ route('layanan.show', ['slug' => 'bleaching']) }}">Bleaching</a>
                <a role="menuitem" href="{{ route('layanan.show', ['slug' => 'gigi-tiruan']) }}">Gigi Tiruan</a>
                <a role="menuitem" href="{{ route('layanan.show', ['slug' => 'implan-gigi']) }}">Implan Gigi</a>
                <a role="menuitem" href="{{ route('layanan.show', ['slug' => 'orthodontics']) }}">Orthodontics</a>
                <a role="menuitem" href="{{ route('layanan.show', ['slug' => 'pencabutan-gigi']) }}">Pencabutan Gigi</a>
                <a role="menuitem" href="{{ route('layanan.show', ['slug' => 'perawatan-gigi-anak']) }}">Perawatan Gigi Anak</a>
                <a role="menuitem" href="{{ route('layanan.show', ['slug' => 'perawatan-saluran-akar']) }}">Perawatan Saluran Akar</a>
                <a role="menuitem" href="{{ route('layanan.show', ['slug' => 'scaling']) }}">Scaling</a>
                <a role="menuitem" href="{{ route('layanan.show', ['slug' => 'tambal-gigi']) }}">Tambal Gigi</a>
                <a role="menuitem" href="{{ route('layanan.show', ['slug' => 'veneer']) }}">Veneer</a>
            </div>
        </div>
        <a href="{{ route('pages.dentists') }}" class="nav-link">Our Dentists</a>
        <a href="{{ route('pages.articles') }}" class="nav-link">Artikel</a>
        @guest
            <a href="{{ url('login') }}" class="btn-login">Login</a>
        @endguest
        @auth
            <a href="{{ route('profile.show') }}" class="btn-profile">
                <span class="avatar">{{ strtoupper(mb_substr(auth()->user()->name ?? 'U', 0, 1)) }}</span>
                <span class="profile-name">{{ auth()->user()->name }}</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;margin-left:6px">@csrf
                <button type="submit" class="btn-login">Keluar</button>
            </form>
            <a href="{{ route('booking.create', ['patient_name' => auth()->user()->name ?? '']) }}" class="btn-cta">Buat Janji Temu</a>
        @endauth
    </nav>
</header>
