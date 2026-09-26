<nav class="navbar navbar-expand-lg navbar-dark sticky-top navbar-custom py-3">
    <div class="container">
        <a class="navbar-brand brand-font fw-bold" href="{{ route('home') }}">
            <i class="fa-solid fa-gauge-high text-danger me-2"></i>AUTOMOBILLI
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-3">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#brands') }}">Brands</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#iconic') }}">Iconic Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('compare.index') }}">Compare</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#membership') }}">Membership</a>
                </li>
            </ul>

            <div class="d-flex gap-2">
                <a href="#" class="btn btn-outline-custom btn-sm px-3">Sign In</a>
                <a href="#" class="btn btn-racing btn-sm px-3">Register</a>
            </div>
        </div>
    </div>
</nav>
