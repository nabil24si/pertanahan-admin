<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav flex-column">

        <li class="nav-item">
            <div class="nav-profile-wrapper">
                <a href="#" class="d-flex align-items-center text-decoration-none w-100">
                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" class="nav-profile-img">
                    <div class="nav-profile-text">
                        <span class="font-weight-bold d-block text-dark"
                            style="font-size: 0.95rem;">{{ Auth::user()->name ?? 'Pengguna' }}</span>
                        <span class="text-secondary small text-uppercase fw-bold"
                            style="font-size: 0.65rem; letter-spacing: 0.5px;">{{ Auth::user()->role ?? 'Admin' }}</span>
                    </div>
                </a>
            </div>
        </li>

        <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item nav-category">Data Wilayah</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('persil.index') ? 'active' : '' }}"
                href="{{ route('persil.index') }}">
                <i class="mdi mdi-table-large menu-icon"></i>
                <span class="menu-title">Data Persil</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('jenispenggunaan.index') ? 'active' : '' }}"
                href="{{ route('jenispenggunaan.index') }}">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                <span class="menu-title">Jenis Penggunaan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dokumen_persil.index') ? 'active' : '' }}"
                href="{{ route('dokumen_persil.index') }}">
                <i class="mdi mdi-file-document menu-icon"></i>
                <span class="menu-title">Dokumen Persil</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('sengketa_persil.index') ? 'active' : '' }}"
                href="{{ route('sengketa_persil.index') }}">
                <i class="mdi mdi-cards-variant menu-icon"></i>
                <span class="menu-title">Sengketa Persil</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('peta_persil.index') ? 'active' : '' }}"
                href="{{ route('peta_persil.index') }}">
                <i class="mdi mdi-map-marker-radius menu-icon"></i>
                <span class="menu-title">Peta Persil</span>
            </a>
        </li>




        <li class="nav-item nav-category">Master Data</li>

        <li class="nav-item {{ request()->routeIs('warga.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('warga.index') }}">
                <i class="mdi mdi-account-group menu-icon"></i>
                <span class="menu-title">Data Warga</span>
            </a>
        </li>

        @if (Auth::check() && Auth::user()->role === 'Admin')
            <li class="nav-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="mdi mdi-shield-account menu-icon"></i>
                    <span class="menu-title">Manajemen User</span>
                </a>
            </li>
        @endif

        <li class="nav-item nav-category">Other Options</li>

        <li class="nav-item {{ request()->routeIs('profilepengembang.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('profilepengembang.index') }}">
                <i class="mdi mdi-account-group menu-icon"></i>
                <span class="menu-title">Profile Pengembang</span>
            </a>
        </li>
    </ul>
</nav>
<style>
    /* ===============================
   SIDEBAR ACTIVE FIX (FINAL)
   =============================== */

    /* menu normal */
    .sidebar .nav .nav-link {
        background: transparent;
    }

    /* teks menu normal */
    .sidebar .nav .nav-link .menu-title {
        color: #6c7293;
    }

    /* icon normal */
    .sidebar .nav .nav-link i {
        color: #6c7293;
    }

    /* ===== MENU AKTIF SAJA ===== */
    .sidebar .nav .nav-link.active {
        background: linear-gradient(to right, #7b61ff, #6246ea);
        border-radius: 8px;
    }

    /* teks menu aktif */
    .sidebar .nav .nav-link.active .menu-title {
        color: #ffffff !important;
    }

    /* icon menu aktif */
    .sidebar .nav .nav-link.active i {
        color: #ffffff !important;
    }

    /* pastikan menu lain TIDAK ikut aktif */
    .sidebar .nav .nav-item .nav-link:not(.active) {
        background: transparent !important;
    }
</style>
