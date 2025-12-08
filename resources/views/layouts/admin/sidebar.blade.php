<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <!-- Profile Section -->
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="../../assets/images/faces/face1.jpg" alt="profile" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="fw-bold">{{ Auth::user()->name ?? 'User' }}</span>
                    <span class="text-secondary text-small">{{ Auth::user()->role ?? 'User' }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <!-- Dashboard -->
        <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <!-- Section Label -->
        <li class="nav-label text-muted mt-3">FITRU</li>

        <!-- Penggunaan -->
        <li class="nav-item {{ request()->routeIs('jenispenggunaan.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('jenispenggunaan.index') }}">
                <span class="menu-title">Penggunaan</span>
                <i class="fa fa-imdb menu-icon"></i>
            </a>
        </li>

        <!-- Persil -->
        <li class="nav-item {{ request()->routeIs('persil.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('persil.index') }}">
                <span class="menu-title">Persil</span>
                <i class="fa fa-imdb menu-icon"></i>
            </a>
        </li>

        <!-- Section Label -->
        <li class="nav-label text-muted mt-3">MASTER DATA</li>

        <!-- Data User -->
        <li class="nav-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <span class="menu-title">Data User</span>
                <i class="fa fa-user-circle menu-icon"></i>
            </a>
        </li>

        <!-- Data Warga -->
        <li class="nav-item {{ request()->routeIs('warga.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('warga.index') }}">
                <span class="menu-title">Data Warga</span>
                <i class="fa fa-id-card menu-icon"></i>
            </a>
        </li>

    </ul>
</nav>
