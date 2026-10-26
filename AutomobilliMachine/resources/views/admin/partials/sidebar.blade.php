<aside class="admin-sidebar" id="adminSidebar" aria-label="Admin navigation">
    <div class="admin-sidebar-top">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand" aria-label="Automobilli Admin Dashboard">
            <span class="admin-brand-mark"><i class="fa-solid fa-gauge-high"></i></span>
            <span class="admin-brand-copy">
                <strong>AUTOMOBILLI</strong>
                <small>ADMIN CONSOLE</small>
            </span>
        </a>
        <button class="admin-sidebar-close" type="button" data-admin-sidebar-close aria-label="Close navigation">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="admin-sidebar-profile">
        <span class="admin-avatar admin-avatar-sidebar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
        <span class="admin-sidebar-profile-copy">
            <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>
            <small><span class="admin-online-dot"></span> Signed in</small>
        </span>
        <i class="fa-solid fa-ellipsis-vertical admin-profile-menu-icon" aria-hidden="true"></i>
    </div>

    <nav class="admin-nav">
        <span class="admin-nav-label">WORKSPACE</span>
        <a href="{{ route('admin.dashboard') }}"
            class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}"
            @if (request()->routeIs('admin.dashboard')) aria-current="page" @endif>
            <i class="fa-solid fa-chart-pie"></i>
            <span>Dashboard</span>
        </a>

        <span class="admin-nav-label admin-nav-label-spaced">CATALOG MANAGEMENT</span>
        <a href="{{ route('admin.cars.index') }}"
            class="admin-nav-link {{ request()->routeIs('admin.cars.*') ? 'is-active' : '' }}"
            @if (request()->routeIs('admin.cars.*')) aria-current="page" @endif>
            <i class="fa-solid fa-car-side"></i>
            <span>Car Catalog</span>
            <i class="fa-solid fa-chevron-right admin-nav-trail" aria-hidden="true"></i>
        </a>

        <span class="admin-nav-label admin-nav-label-spaced">QUICK ACCESS</span>
        <a href="{{ route('home') }}" class="admin-nav-link" target="_blank" rel="noopener noreferrer">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>Public Website</span>
        </a>
        <a href="{{ route('profile.show') }}" class="admin-nav-link">
            <i class="fa-regular fa-user"></i>
            <span>My Profile</span>
        </a>
    </nav>

    <div class="admin-sidebar-bottom">
        <div class="admin-sidebar-note">
            <span class="admin-sidebar-note-icon"><i class="fa-solid fa-shield-halved"></i></span>
            <div>
                <strong>Admin workspace</strong>
                <small>Catalog tools and controls</small>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="admin-logout-form">
            @csrf
            <button type="submit" class="admin-nav-link admin-logout-link">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Sign out</span>
            </button>
        </form>
        <div class="admin-sidebar-version">AUTOMOTIVE DATA MANAGEMENT</div>
    </div>
</aside>