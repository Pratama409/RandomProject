@extends('layouts.app')

@section('title', 'Home - AutomobilliMachine')

@section('content')

    <!-- ==================================================================== -->
    <!-- 1. HERO SECTION: FULLSCREEN ANGLED GALLERY                           -->
    <!-- ==================================================================== -->
    <section class="hero-wrapper" id="top">
        <aside class="hero-visual-fullscreen">
            <div class="hero-backdrop-overlay"></div>

            <div class="angled-gallery">
                @for ($column = 0; $column < 4; $column++)
                    <div class="gallery-col col-offset-{{ $column + 1 }}">
                        @foreach ($heroCars as $index => $car)
                            @if ($index % 4 === $column)
                                @php
                                    $imageUrl = str_starts_with($car->image_path, 'http')
                                        ? $car->image_path
                                        : asset($car->image_path);
                                @endphp
                                <div class="showcase-card">
                                    <img src="{{ $imageUrl }}" alt="{{ $car->brand?->name }} {{ $car->name }}"
                                     loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                     fetchpriority="{{ $index === 0 ? 'high' : 'low' }}"
                                     decoding="async">
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endfor
            </div>
        </aside>

        <section class="hero-content">
            <h1 class="hero-title">
                Automotive Excellence
                <span>to kick-start your passion</span>
            </h1>

            <p class="hero-desc">
                Explore the heritage, philosophy, and engineering of legendary automotive brands. Compare technical specifications and uncover your ultimate driving machine.
            </p>

            <div class="hero-actions">
                <a href="#brands" class="btn-primary">Explore Brands</a>
                <a href="#compare" class="btn-outline">Compare Cars</a>
            </div>

            <div class="scroll-indicator" title="Scroll down"></div>
        </section>
    </section>

    <!-- NAVBAR STICKY DI BAWAH HERO -->
    @include('partials.navbar')

    <!-- ==================================================================== -->
    <!-- 2. TRANSITION BANNER: ENGINEERED FOR PASSION                         -->
    <!-- ==================================================================== -->
    <section class="transition-banner">
        <div class="container py-4">
            @include('partials.home-section-heading', [
                'kicker' => 'THE ULTIMATE PERFORMANCE HUB',
                'title' => 'Engineered for Passion',
                'description' => 'Uncompromising engineering, racing heritage, and world-class automotive masterpieces united in one platform.'
            ])


            <div class="row g-3 justify-content-center mt-2">
                <div class="col-md-3 col-sm-6">
                    <div class="transition-feature"><i class="fa-solid fa-flag-checkered text-danger me-2"></i><span>Heritage & Racing DNA</span></div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="transition-feature"><i class="fa-solid fa-microchip text-danger me-2"></i><span>Pure Technical Specs</span></div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="transition-feature"><i class="fa-solid fa-scale-balanced text-danger me-2"></i><span>Head-to-Head Compare</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================================================================== -->
    <!-- 3. BRAND SPOTLIGHT: SLIDER PERSIS SEJAJAR DENGAN TOMBOL NAVIGASI     -->
    <!-- ==================================================================== -->
    <section id="brands" class="py-5 brand-slider-section position-relative">
        <div class="container py-4">
            
            @include('partials.home-section-heading', [
                'kicker' => 'BRAND SPOTLIGHT',
                'title' => 'Featured Brands',
                'description' => 'Use the arrow buttons or click and drag with your mouse to explore each brand.',
                'class' => 'home-section-heading--brand'
            ])

            <!-- Wrapper Slider dengan Tombol Melayang di Samping -->
            <div class="brand-slider-wrapper position-relative">
                
                <!-- Tombol Navigasi Kiri (<) -->
                <button type="button" class="brand-nav-btn nav-prev" id="brandPrevBtn" aria-label="Previous Brand" title="Previous Brand">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <!-- Swiper Carousel -->
                <div class="swiper brand-swiper">
                    <div class="swiper-wrapper">

                        <!-- SLIDE 1: FERRARI -->
                        <div class="swiper-slide">
                            <div class="brand-spotlight-box glass-panel">
                                <div class="row g-4 align-items-stretch flex-grow-1">
                                    <!-- Kolom Kiri -->
                                    <div class="col-lg-3 col-md-4 d-flex flex-column justify-content-between h-100">
                                        <div class="brand-logo-card mb-3">
                                            <div class="logo-emblem-slot">
                                                <img src="{{ asset('image/CarLogo/FerrariLogo.png') }}" referrerpolicy="no-referrer" alt="Ferrari Emblem" class="img-fluid">
                                            </div>
                                            <div class="logo-wordmark-slot">
                                                <img src="{{ asset('image/FontLogo/FerrariFontLogo.png') }}" referrerpolicy="no-referrer" alt="Ferrari" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="brand-fact-stack d-flex flex-column gap-2">
                                            <div class="fact-box"><small class="text-muted d-block">Founded</small><span class="fw-bold text-white">1939 &bull; Maranello</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Founder</small><span class="fw-bold text-white">Enzo Ferrari</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Country</small><span class="fw-bold text-white">Italy</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Vehicle Lineup</small><span class="fw-bold text-white">Sports Cars &amp; Grand Tourers</span></div>
                                        </div>
                                    </div>
                                    <!-- Kolom Tengah -->
                                    <div class="col-lg-5 col-md-8 d-flex flex-column justify-content-between h-100">
                                        <div class="brand-history-card p-4 h-100 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <h3 class="fw-bold brand-font text-white mb-0">Ferrari</h3>
                                                        <small class="text-danger fw-semibold">Il Cavallino Rampante</small>
                                                    </div>
                                                    <span class="badge bg-black border border-secondary px-3 py-2 brand-font">EST. 1939</span>
                                                </div>
                                                <blockquote class="brand-quote text-secondary small fst-italic mb-3 ps-3 border-start border-danger border-2">
                                                    "I build dreams that are capable of evoking emotion."
                                                    <footer class="blockquote-footer text-muted mt-1">Enzo Ferrari</footer>
                                                </blockquote>
                                                <div class="d-flex gap-3 align-items-start mb-3 archive-story-box p-2 rounded">
                                                    <div class="archive-story-media overflow-hidden rounded flex-shrink-0">
                                                        <img src="{{ asset('image/Ferrari F40.jpg') }}" alt="Ferrari Heritage" class="img-fluid w-100 h-100 object-fit-cover">
                                                    </div>
                                                    <p class="text-light small mb-0 archive-story-copy">
                                                        Rooted in the Scuderia Ferrari racing team founded in 1929, the marque produced its first road car in 1947 with the 125 S. Every model is shaped by a philosophy of pure aerodynamics and circuit-focused performance.
                                                    </p>
                                                </div>
                                                <p class="text-muted small mb-4">
                                                    Its lineup continues to set the benchmark for supercar power, from twin-turbo V8 masterpieces to the 1,000 HP hybrid system of the SF90 Stradale.
                                                </p>
                                            </div>
                                            <a href="{{ url('/ferrari') }}" class="btn btn-racing w-100 py-2 d-flex justify-content-center align-items-center gap-2">
                                                <span>Explore Complete Ferrari Lineup</span>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Kolom Kanan -->
                                    <div class="col-lg-4 col-md-12 d-flex flex-column justify-content-between h-100">
                                        <div class="brand-hq-card h-100 d-flex flex-column justify-content-between p-3">
                                            <div>
                                                <div class="hq-image-wrapper rounded overflow-hidden mb-3">
                                                    <img src="{{ asset('image/Ferrari SF90 Spider.jpg') }}" alt="Ferrari Maranello Headquarters" class="img-fluid w-100 hq-image" loading="lazy" decoding="async">
                                                    <span class="hq-badge"><i class="fa-solid fa-building me-1"></i> Global Headquarters</span>
                                                </div>
                                                <h5 class="fw-bold brand-font text-white mb-2">Maranello Factory & Museum</h5>
                                                <p class="text-muted small mb-2"><i class="fa-solid fa-location-dot text-danger me-2"></i>Via Abetone Inferiore n. 4, 41053 Maranello (MO), Italy.</p>
                                                <p class="text-secondary small">A center for Formula 1 technology research, aerodynamic wind-tunnel development, and the assembly of legendary pure V6, V8, and V12 engines.</p>
                                            </div>
                                            <div class="hq-footer-note p-2 rounded text-center small text-secondary border border-secondary border-opacity-25 bg-black bg-opacity-50">
                                                <i class="fa-solid fa-circle-check text-success me-1"></i> Official Heritage Certified
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SLIDE 2: LAMBORGHINI -->
                        <div class="swiper-slide">
                            <div class="brand-spotlight-box glass-panel">
                                <div class="row g-4 align-items-stretch flex-grow-1">
                                    <!-- Kolom Kiri -->
                                    <div class="col-lg-3 col-md-4 d-flex flex-column justify-content-between h-100">
                                        <div class="brand-logo-card mb-3">
                                            <div class="logo-emblem-slot">
                                                <img src="{{ asset('image/CarLogo/LamborghiniLogo.png') }}" referrerpolicy="no-referrer" alt="Lamborghini Emblem" class="img-fluid">
                                            </div>
                                            <div class="logo-wordmark-slot">
                                                <img src="{{ asset('image/FontLogo/LamborghiniFontLogo.png') }}" referrerpolicy="no-referrer" alt="Lamborghini" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="brand-fact-stack d-flex flex-column gap-2">
                                            <div class="fact-box"><small class="text-muted d-block">Founded</small><span class="fw-bold text-white">1963 &bull; Sant'Agata</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Founder</small><span class="fw-bold text-white">Ferruccio Lamborghini</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Country</small><span class="fw-bold text-white">Italy</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Vehicle Lineup</small><span class="fw-bold text-white">Super Sports Cars &amp; SUVs</span></div>
                                        </div>
                                    </div>
                                    <!-- Kolom Tengah -->
                                    <div class="col-lg-5 col-md-8 d-flex flex-column justify-content-between h-100">
                                        <div class="brand-history-card p-4 h-100 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <h3 class="fw-bold brand-font text-white mb-0">Automobili Lamborghini</h3>
                                                        <small class="text-warning fw-semibold">Toro Scatenato</small>
                                                    </div>
                                                    <span class="badge bg-black border border-secondary px-3 py-2 brand-font">EST. 1963</span>
                                                </div>
                                                <blockquote class="brand-quote text-secondary small fst-italic mb-3 ps-3 border-start border-warning border-2">
                                                    "When you enter a Lamborghini, you are entering an unapologetic piece of moving art."
                                                    <footer class="blockquote-footer text-muted mt-1">Ferruccio Lamborghini</footer>
                                                </blockquote>
                                                <div class="d-flex gap-3 align-items-start mb-3 archive-story-box p-2 rounded">
                                                    <div class="archive-story-media overflow-hidden rounded flex-shrink-0">
                                                        <img src="https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?w=300&auto=format&fit=crop&q=80" alt="Lamborghini Heritage" class="img-fluid w-100 h-100 object-fit-cover">
                                                    </div>
                                                    <p class="text-light small mb-0 archive-story-copy">
                                                        Born from a determination to challenge the limits of Italian sports cars, Lamborghini created the Miura in 1966—an early mid-engine supercar that transformed automotive design forever.
                                                    </p>
                                                </div>
                                                <p class="text-muted small mb-4">
                                                    Known for sharp geometry, iconic scissor doors, and the legendary naturally aspirated V12 roar carried from the Countach and Diablo to the Aventador and Revuelto.
                                                </p>
                                            </div>
                                            <a href="#" class="btn btn-outline-custom w-100 py-2 d-flex justify-content-center align-items-center gap-2">
                                                <span>Explore Lamborghini Lineup</span>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Kolom Kanan -->
                                    <div class="col-lg-4 col-md-12 d-flex flex-column justify-content-between h-100">
                                        <div class="brand-hq-card h-100 d-flex flex-column justify-content-between p-3">
                                            <div>
                                                <div class="hq-image-wrapper rounded overflow-hidden mb-3">
                                                    <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=600&auto=format&fit=crop&q=80" alt="Lamborghini HQ" class="img-fluid w-100 hq-image" loading="lazy" decoding="async">
                                                    <span class="hq-badge"><i class="fa-solid fa-building me-1"></i> Global Headquarters</span>
                                                </div>
                                                <h5 class="fw-bold brand-font text-white mb-2">Sant'Agata Bolognese</h5>
                                                <p class="text-muted small mb-2"><i class="fa-solid fa-location-dot text-danger me-2"></i>Via Modena 12, 40019 Sant'Agata Bolognese (BO), Italy.</p>
                                                <p class="text-secondary small">The main facility for hand-assembled carbon-fiber components and the official Museo Automobili Lamborghini museum.</p>
                                            </div>
                                            <div class="hq-footer-note p-2 rounded text-center small text-secondary border border-secondary border-opacity-25 bg-black bg-opacity-50">
                                                <i class="fa-solid fa-circle-check text-success me-1"></i> Official Heritage Certified
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SLIDE 3: MERCEDES-BENZ -->
                        <div class="swiper-slide">
                            <div class="brand-spotlight-box glass-panel">
                                <div class="row g-4 align-items-stretch flex-grow-1">
                                    <!-- Kolom Kiri -->
                                    <div class="col-lg-3 col-md-4 d-flex flex-column justify-content-between h-100">
                                        <div class="brand-logo-card mb-3">
                                            <div class="logo-emblem-slot">
                                                <img src="{{ asset('image/CarLogo/MercedesLogo.png') }}" referrerpolicy="no-referrer" alt="Mercedes Emblem" class="img-fluid">
                                            </div>
                                            <div class="logo-wordmark-slot">
                                                <img src="{{ asset('image/FontLogo/MercedesFontLogo.png') }}" referrerpolicy="no-referrer" alt="Mercedes-Benz" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="brand-fact-stack d-flex flex-column gap-2">
                                            <div class="fact-box"><small class="text-muted d-block">Founded</small><span class="fw-bold text-white">1926 &bull; Stuttgart</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Founder</small><span class="fw-bold text-white">Karl Benz &amp; Gottlieb Daimler</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Country</small><span class="fw-bold text-white">Germany</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Vehicle Lineup</small><span class="fw-bold text-white">Luxury Cars, SUVs &amp; Performance</span></div>
                                        </div>
                                    </div>
                                    <!-- Kolom Tengah -->
                                    <div class="col-lg-5 col-md-8 d-flex flex-column justify-content-between h-100">
                                        <div class="brand-history-card p-4 h-100 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <h3 class="fw-bold brand-font text-white mb-0">Mercedes-AMG</h3>
                                                        <small class="text-secondary fw-semibold">Silver Arrows</small>
                                                    </div>
                                                    <span class="badge bg-black border border-secondary px-3 py-2 brand-font">EST. 1926</span>
                                                </div>
                                                <blockquote class="brand-quote text-secondary small fst-italic mb-3 ps-3 border-start border-light border-2">
                                                    "The love of inventing never dies."
                                                    <footer class="blockquote-footer text-muted mt-1">Karl Benz</footer>
                                                </blockquote>
                                                <div class="d-flex gap-3 align-items-start mb-3 archive-story-box p-2 rounded">
                                                    <div class="archive-story-media overflow-hidden rounded flex-shrink-0">
                                                        <img src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=300&auto=format&fit=crop&q=80" alt="Mercedes Heritage" class="img-fluid w-100 h-100 object-fit-cover">
                                                    </div>
                                                    <p class="text-light small mb-0 archive-story-copy">
                                                        As a pioneer of the world's first gasoline-powered automobile in 1886, AMG's high-performance division brings its 'One Man, One Engine' philosophy to the world of Formula 1 racing.
                                                    </p>
                                                </div>
                                                <p class="text-muted small mb-4">
                                                    From the legendary 300 SL Gullwing to the Formula 1-powered Mercedes-AMG ONE, the brand represents the pinnacle of German technology and luxury.
                                                </p>
                                            </div>
                                            <a href="#" class="btn btn-outline-custom w-100 py-2 d-flex justify-content-center align-items-center gap-2">
                                                <span>Explore Mercedes-AMG Lineup</span>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Kolom Kanan -->
                                    <div class="col-lg-4 col-md-12 d-flex flex-column justify-content-between h-100">
                                        <div class="brand-hq-card h-100 d-flex flex-column justify-content-between p-3">
                                            <div>
                                                <div class="hq-image-wrapper rounded overflow-hidden mb-3">
                                                    <img src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=600&auto=format&fit=crop&q=80" alt="Mercedes HQ" class="img-fluid w-100 hq-image" loading="lazy" decoding="async">
                                                    <span class="hq-badge"><i class="fa-solid fa-building me-1"></i> Global Headquarters</span>
                                                </div>
                                                <h5 class="fw-bold brand-font text-white mb-2">Affalterbach & Stuttgart</h5>
                                                <p class="text-muted small mb-2"><i class="fa-solid fa-location-dot text-danger me-2"></i>Daimlerstraße 1, 71563 Affalterbach, Germany.</p>
                                                <p class="text-secondary small">Home to hand-assembled AMG engines and the Mercedes-Benz Museum, which chronicles more than 130 years of automotive history.</p>
                                            </div>
                                            <div class="hq-footer-note p-2 rounded text-center small text-secondary border border-secondary border-opacity-25 bg-black bg-opacity-50">
                                                <i class="fa-solid fa-circle-check text-success me-1"></i> Official Heritage Certified
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Tombol Navigasi Kanan (>) -->
                <button type="button" class="brand-nav-btn nav-next" id="brandNextBtn" aria-label="Next Brand" title="Next Brand">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

            </div>

        </div>
    </section>

    <!-- ==================================================================== -->
    <!-- 4. ALL BRANDS: COMPACT DIRECTORY                                    -->
    <!-- ==================================================================== -->
    <section id="brand-directory" class="all-brands-section">
        <div class="container">
            <div class="home-section-heading-row all-brands-heading">
                @include('partials.home-section-heading', [
                    'kicker' => 'BRAND DIRECTORY',
                    'title' => 'All Brands',
                    'description' => 'Explore every active automotive brand currently available in the Automobilli catalog.'
                ])
                <span class="all-brands-count">{{ $brands->count() }} {{ $brands->count() === 1 ? 'BRAND' : 'BRANDS' }}</span>
            </div>



            <div class="all-brands-grid" id="allBrandsGrid">
                @foreach ($brands as $brand)
                    <a class="all-brand-card" href="{{ route('brands.show', $brand) }}" data-brand-name="{{ strtolower($brand->name) }}" data-brand-country="{{ strtolower($brand->country) }}">
                        <div class="all-brand-card-main">
                            <div class="all-brand-logo">
                                @if ($brand->logo_path)
                                    <img src="{{ str_starts_with($brand->logo_path, 'http') ? $brand->logo_path : asset($brand->logo_path) }}"
                                        alt="{{ $brand->name }} logo"
                                        loading="lazy">
                                @else
                                    <span>{{ strtoupper(substr($brand->name, 0, 1)) }}</span>
                                @endif
                            </div>

                            <div class="all-brand-copy">
                                <h3>{{ $brand->name }}</h3>
                                <span>{{ $brand->country }}{{ $brand->founded_year ? ' · Est. ' . $brand->founded_year : '' }}</span>
                            </div>
                        </div>

                        <div class="all-brand-arrow" aria-hidden="true">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ==================================================================== -->
    <!-- 4. ICONIC CARS SHOWCASE SECTION                                      -->
    <!-- ==================================================================== -->
    <section id="iconic" class="py-5 solid-content-section">
        <div class="container py-4">
            @include('partials.home-section-heading', [
                'kicker' => 'HALL OF FAME',
                'title' => 'Iconic Picks',
                'description' => 'A rotating selection of standout models from different automotive brands.'
            ])



            <div class="row g-4">
                @forelse ($iconicCars as $car)
                    @php
                        $imageUrl = str_starts_with($car->image_path, 'http')
                            ? $car->image_path
                            : asset($car->image_path);
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('cars.show', ['brand' => $car->brand->slug, 'car' => $car->slug]) }}"
                           class="custom-card h-100 iconic-card-link">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ $imageUrl }}" class="card-img-top iconic-image" alt="{{ $car->brand->name }} {{ $car->name }}" loading="lazy" decoding="async">
                                <span class="iconic-brand-pill">{{ $car->brand->name }}</span>
                            </div>
                            <div class="p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-secondary small text-uppercase">{{ $car->production_year_start ?? '—' }}</span>
                                    <span class="iconic-open-indicator"><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                                </div>
                                <h4 class="fw-bold brand-font text-white mb-3">{{ $car->name }}</h4>
                                @if ($car->horsepower || $car->acceleration_0_100 || $car->top_speed_kmh)
                                    <div class="row g-2">
                                        <div class="col-4"><div class="spec-box"><div class="spec-label">Power</div><div class="spec-val">{{ $car->horsepower ? number_format($car->horsepower) . ' HP' : '—' }}</div></div></div>
                                        <div class="col-4"><div class="spec-box"><div class="spec-label">0–100</div><div class="spec-val">{{ $car->acceleration_0_100 !== null ? number_format((float) $car->acceleration_0_100, 1) . ' s' : '—' }}</div></div></div>
                                        <div class="col-4"><div class="spec-box"><div class="spec-label">Top Speed</div><div class="spec-val">{{ $car->top_speed_kmh ? number_format($car->top_speed_kmh) . ' km/h' : '—' }}</div></div></div>
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="all-brands-empty">No iconic models with images are currently available.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ==================================================================== -->
    <!-- 5. QUICK COMPARE TEASER SECTION                                      -->
    <!-- ==================================================================== -->
    <section id="compare" class="py-5 solid-content-section">
        <div class="container py-4">
            @include('partials.home-section-heading', [
                'kicker' => 'HEAD-TO-HEAD',
                'title' => 'Benchmark Your Dream Cars',
                'description' => 'Compare technical specifications side-by-side: from powertrain output, torque, and acceleration to curb weight and top speed.'
            ])

            <div class="compare-teaser">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="d-flex flex-wrap gap-3">
                            <span class="text-secondary small"><i class="fa-solid fa-check text-danger me-1"></i> Powertrain & Engine Output</span>
                            <span class="text-secondary small"><i class="fa-solid fa-check text-danger me-1"></i> 0-100 km/h Acceleration</span>
                            <span class="text-secondary small"><i class="fa-solid fa-check text-danger me-1"></i> Power-to-Weight Ratio</span>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center mt-4 mt-lg-0">
                        <div class="p-4 bg-dark rounded border border-secondary">
                            <div class="display-6 brand-font fw-bold text-danger mb-3">VS</div>
                            <p class="small text-secondary mb-3">Select 2 to 3 vehicles across multiple brands</p>
                            <a href="#" class="btn btn-racing w-100">Launch Comparison Tool</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================================================================== -->
    <!-- 6. MEMBERSHIP TEASER SECTION                                         -->
    <!-- ==================================================================== -->
    <section id="membership" class="py-5 solid-content-section membership-section">
        <div class="container py-4">
            @include('partials.home-section-heading', [
                'kicker' => 'EXCLUSIVE PRIVILEGE',
                'title' => 'Automobilli Club Membership',
                'description' => 'Unlock exclusive privileges curated for true automotive purists.'
            ])



            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="custom-card p-4 text-center h-100">
                        <i class="fa-solid fa-warehouse fa-3x text-danger mb-3"></i>
                        <h5 class="fw-bold brand-font text-white">Virtual Garage</h5>
                        <p class="text-muted small">Showcase your personal collection or custom builds with detailed tuning specifications.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card p-4 text-center h-100">
                        <i class="fa-solid fa-file-pdf fa-3x text-danger mb-3"></i>
                        <h5 class="fw-bold brand-font text-white">Download PDF Brochures</h5>
                        <p class="text-muted small">Download high-resolution official spec sheets and manufacturer brochures directly in PDF format.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card p-4 text-center h-100">
                        <i class="fa-solid fa-chart-line fa-3x text-danger mb-3"></i>
                        <h5 class="fw-bold brand-font text-white">Advanced Analytics</h5>
                        <p class="text-muted small">Analyze power delivery curves, dyno charts, and unlock unlimited multi-car comparisons.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tombol Back to Top -->
    <a href="#top" class="btn-scroll-top" title="Back to top">
        <i class="fa-solid fa-arrow-up"></i>
    </a>

@endsection