<nav class="navbar navbar-expand-lg navbar-dark sticky-top navbar-custom py-3">
    <div class="container">
        <a class="navbar-brand brand-font fw-bold" href="{{ route('home') }}">
            <i class="fa-solid fa-gauge-high text-danger me-2"></i>AUTOMOBILLI
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
            aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('brands.*', 'brand.ferrari') ? 'active' : '' }}" href="{{ route('home') }}#brands">Brands</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#iconic">Iconic Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('compare.index') ? 'active' : '' }}" href="{{ route('compare.index') }}">Compare</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#membership">Membership</a>
                </li>
            </ul>

            <div class="automobilli-nav-tools">
                <button type="button" class="automobilli-nav-icon automobilli-search-trigger" aria-label="Search Automobilli" title="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

                <a href="{{ route('collection.index', ['tab' => 'favorites', 'return_to' => url()->full()]) }}"
                    class="automobilli-nav-icon {{ request()->routeIs('collection.index') && request('tab', 'favorites') === 'favorites' ? 'is-active' : '' }}"
                    data-collection-link
                    aria-label="Favorites" title="Favorites">
                    <i class="fa-regular fa-heart"></i>
                </a>

                <a href="{{ route('collection.index', ['tab' => 'wishlist', 'return_to' => url()->full()]) }}"
                    class="automobilli-nav-icon {{ request()->routeIs('collection.index') && request('tab') === 'wishlist' ? 'is-active' : '' }}"
                    data-collection-link
                    aria-label="Wishlist" title="Wishlist">
                    <i class="fa-regular fa-bookmark"></i>
                </a>

                @auth
                    <a href="{{ route('profile.show') }}"
                        class="automobilli-profile-link {{ request()->routeIs('profile.show') ? 'is-active' : '' }}"
                        aria-label="Profile" title="Profile">
                        <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-custom btn-sm px-3">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-racing btn-sm px-3">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="automobilli-search-overlay" id="automobilliSearch" aria-hidden="true">
    <div class="automobilli-search-backdrop" data-search-close></div>
    <div class="automobilli-search-dialog" role="dialog" aria-modal="true" aria-label="Search Automobilli">
        <div class="automobilli-search-header">
            <div class="automobilli-search-input-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input id="automobilliSearchInput" type="search"
                    placeholder="Search cars, brands, models..."
                    autocomplete="off"
                    spellcheck="false">
                <kbd>ESC</kbd>
            </div>
            <button type="button" class="automobilli-search-close" data-search-close aria-label="Close search">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="automobilli-search-results" id="automobilliSearchResults">
            <div class="automobilli-search-empty is-visible">
                <i class="fa-solid fa-magnifying-glass"></i>
                <p>Search for a brand or vehicle model.</p>
            </div>
        </div>
    </div>
</div>
