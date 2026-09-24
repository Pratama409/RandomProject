@extends('layouts.app')

@section('title', 'Home - AutomobilliMachine')

@section('content')

    <!-- ==================================================================== -->
    <!-- 1. HERO SECTION: FULLSCREEN ANGLED GALLERY                           -->
    <!-- ==================================================================== -->
    <main class="hero-wrapper" id="top">
        <aside class="hero-visual-fullscreen">
            <div class="hero-backdrop-overlay"></div>

            <div class="angled-gallery">
                <div class="gallery-col col-offset-1">
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=700&auto=format&fit=crop&q=80" alt="Porsche 911 GT3"></div>
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?w=700&auto=format&fit=crop&q=80" alt="Ferrari 812"></div>
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=700&auto=format&fit=crop&q=80" alt="BMW M4"></div>
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=700&auto=format&fit=crop&q=80" alt="Porsche Taycan"></div>
                </div>

                <div class="gallery-col col-offset-2">
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=700&auto=format&fit=crop&q=80" alt="Lamborghini Aventador"></div>
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=700&auto=format&fit=crop&q=80" alt="BMW M5 CS"></div>
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?w=700&auto=format&fit=crop&q=80" alt="Ferrari Roma"></div>
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1611821064430-0d40291d0f0b?w=700&auto=format&fit=crop&q=80" alt="Porsche Cayman"></div>
                </div>

                <div class="gallery-col col-offset-3">
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1607853202273-797f1c22a38e?w=700&auto=format&fit=crop&q=80" alt="BMW M2"></div>
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1592198084033-aade902d1aae?w=700&auto=format&fit=crop&q=80" alt="Ferrari SF90"></div>
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1541348263662-e0c8de4259ba?w=700&auto=format&fit=crop&q=80" alt="Porsche Panamera"></div>
                    <div class="showcase-card"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=700&auto=format&fit=crop&q=80" alt="Porsche 911"></div>
                </div>
            </div>
        </aside>

        <section class="hero-content">
            <h1 class="hero-title">
                Automotive Excellence
                <span>to kick-start your passion</span>
            </h1>

            <p class="hero-desc">
                Explore the heritage, philosophy, and engineering of legendary automotive marques. Compare technical specifications and uncover your ultimate driving machine.
            </p>

            <div class="hero-actions">
                <a href="#brands" class="btn-primary">Explore Brands</a>
                <a href="#compare" class="btn-outline">Compare Cars</a>
            </div>

            <div class="scroll-indicator" title="Scroll down"></div>
        </section>
    </main>

    <!-- NAVBAR STICKY DI BAWAH HERO -->
    @include('partials.navbar')

    <!-- ==================================================================== -->
    <!-- 2. TRANSITION BANNER: ENGINEERED FOR PASSION                         -->
    <!-- ==================================================================== -->
    <section class="transition-banner text-center">
        <div class="container py-4">
            <span class="badge bg-danger px-3 py-2 text-uppercase mb-3 tracking-wide">
                The Ultimate Performance Hub
            </span>

            <h2 class="display-4 fw-bold brand-font text-white mb-3">
                ENGINEERED FOR PASSION
            </h2>

            <p class="text-secondary mx-auto fs-5 mb-4 transition-desc">
                Uncompromising engineering, racing heritage, and world-class automotive masterpieces united in one platform.
            </p>

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
            
            <div class="text-center mb-5">
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 text-uppercase mb-2 tracking-wide fw-bold">
                    Marque Spotlight
                </span>
                <h2 class="display-5 fw-bold brand-font text-white mb-2">FEATURED MARQUES</h2>
                <p class="text-secondary mx-auto mb-0" style="max-width: 600px;">
                    Gunakan tombol panah atau klik tahan dan geser dengan mouse untuk menjelajahi brand.
                </p>
            </div>

            <!-- Wrapper Slider dengan Tombol Melayang di Samping -->
            <div class="brand-slider-wrapper position-relative">
                
                <!-- Tombol Navigasi Kiri (<) -->
                <button type="button" class="brand-nav-btn nav-prev" id="brandPrevBtn" aria-label="Previous Brand" title="Brand Sebelumnya">
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
                                            <div class="fact-box"><small class="text-muted d-block">Racing DNA</small><span class="fw-bold text-danger">Scuderia Ferrari F1</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Signature Color</small><span class="fw-bold text-white"><i class="fa-solid fa-circle text-danger me-1"></i> Rosso Corsa</span></div>
                                        </div>
                                    </div>
                                    <!-- Kolom Tengah -->
                                    <div class="col-lg-5 col-md-8 d-flex flex-column justify-content-between h-100">
                                        <div class="brand-history-card p-4 h-100 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <h3 class="fw-bold brand-font text-white mb-0">Ferrari N.V.</h3>
                                                        <small class="text-danger fw-semibold">Il Cavallino Rampante</small>
                                                    </div>
                                                    <span class="badge bg-black border border-secondary px-3 py-2 brand-font">EST. 1939</span>
                                                </div>
                                                <blockquote class="brand-quote text-secondary small fst-italic mb-3 ps-3 border-start border-danger border-2">
                                                    "I build dreams that are capable of evoking emotion."
                                                    <footer class="blockquote-footer text-muted mt-1">Enzo Ferrari</footer>
                                                </blockquote>
                                                <div class="d-flex gap-3 align-items-start mb-3 archive-story-box p-2 rounded">
                                                    <div class="overflow-hidden rounded flex-shrink-0" style="width: 110px; height: 95px;">
                                                        <img src="{{ asset('image/Ferrari F40.jpg') }}" alt="Ferrari Heritage" class="img-fluid w-100 h-100 object-fit-cover">
                                                    </div>
                                                    <p class="text-light small mb-0" style="line-height: 1.6;">
                                                        Berakar dari tim balap Scuderia Ferrari pada tahun 1929, pabrikan berlambang kuda jingkrak ini memproduksi mobil jalan raya pertamanya pada tahun 1947 dengan model 125 S. Setiap model dirancang dengan filosofi aerodinamika murni dan performa sirkuit.
                                                    </p>
                                                </div>
                                                <p class="text-muted small mb-4">
                                                    Lini produksinya terus menetapkan tolok ukur mesin supercar dunia, dari mahakarya V8 twin-turbo hingga sistem hibrida bertenaga 1.000 HP pada SF90 Stradale.
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
                                                    <img src="{{ asset('image/Ferrari SF90 Spider.jpg') }}" alt="Ferrari Maranello Headquarters" class="img-fluid w-100" style="height: 200px; object-fit: cover;">
                                                    <span class="hq-badge"><i class="fa-solid fa-building me-1"></i> Global Headquarters</span>
                                                </div>
                                                <h5 class="fw-bold brand-font text-white mb-2">Maranello Factory & Museum</h5>
                                                <p class="text-muted small mb-2"><i class="fa-solid fa-location-dot text-danger me-2"></i>Via Abetone Inferiore n. 4, 41053 Maranello (MO), Italy.</p>
                                                <p class="text-secondary small">Pusat riset teknologi F1, terowongan angin perancangan aerodinamika, dan jalur perakitan mesin legendaris V6, V8, serta V12 murni.</p>
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
                                            <div class="fact-box"><small class="text-muted d-block">Hallmark</small><span class="fw-bold text-warning">Naturally Aspirated V12</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Signature Color</small><span class="fw-bold text-white"><i class="fa-solid fa-circle text-warning me-1"></i> Giallo Auge</span></div>
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
                                                    <div class="overflow-hidden rounded flex-shrink-0" style="width: 110px; height: 95px;">
                                                        <img src="https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?w=300&auto=format&fit=crop&q=80" alt="Lamborghini Heritage" class="img-fluid w-100 h-100 object-fit-cover">
                                                    </div>
                                                    <p class="text-light small mb-0" style="line-height: 1.6;">
                                                        Lahir dari tekad menantang batasan sportscar Italia, Lamborghini menciptakan Miura pada tahun 1966—pelopor supercar bermesin tengah pertama di dunia yang mengubah lanskap desain otomotif selamanya.
                                                    </p>
                                                </div>
                                                <p class="text-muted small mb-4">
                                                    Dikenal dengan geometri tajam, pintu gunting ikonik, dan raungan mesin naturally-aspirated V12 legendaris dari Countach, Diablo, Aventador hingga Revuelto.
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
                                                    <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=600&auto=format&fit=crop&q=80" alt="Lamborghini HQ" class="img-fluid w-100" style="height: 200px; object-fit: cover;">
                                                    <span class="hq-badge"><i class="fa-solid fa-building me-1"></i> Global Headquarters</span>
                                                </div>
                                                <h5 class="fw-bold brand-font text-white mb-2">Sant'Agata Bolognese</h5>
                                                <p class="text-muted small mb-2"><i class="fa-solid fa-location-dot text-danger me-2"></i>Via Modena 12, 40019 Sant'Agata Bolognese (BO), Italy.</p>
                                                <p class="text-secondary small">Pabrik utama perakitan tangan serat karbon dan museum resmi Museo Automobili Lamborghini.</p>
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
                                            <div class="fact-box"><small class="text-muted d-block">Pioneers</small><span class="fw-bold text-white">Karl Benz & Daimler</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Performance Division</small><span class="fw-bold text-info">Mercedes-AMG</span></div>
                                            <div class="fact-box"><small class="text-muted d-block">Motto</small><span class="fw-bold text-white">The Best or Nothing</span></div>
                                        </div>
                                    </div>
                                    <!-- Kolom Tengah -->
                                    <div class="col-lg-5 col-md-8 d-flex flex-column justify-content-between h-100">
                                        <div class="brand-history-card p-4 h-100 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <h3 class="fw-bold brand-font text-white mb-0">Mercedes-AMG GmbH</h3>
                                                        <small class="text-secondary fw-semibold">Silver Arrows</small>
                                                    </div>
                                                    <span class="badge bg-black border border-secondary px-3 py-2 brand-font">EST. 1926</span>
                                                </div>
                                                <blockquote class="brand-quote text-secondary small fst-italic mb-3 ps-3 border-start border-light border-2">
                                                    "The love of inventing never dies."
                                                    <footer class="blockquote-footer text-muted mt-1">Karl Benz</footer>
                                                </blockquote>
                                                <div class="d-flex gap-3 align-items-start mb-3 archive-story-box p-2 rounded">
                                                    <div class="overflow-hidden rounded flex-shrink-0" style="width: 110px; height: 95px;">
                                                        <img src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=300&auto=format&fit=crop&q=80" alt="Mercedes Heritage" class="img-fluid w-100 h-100 object-fit-cover">
                                                    </div>
                                                    <p class="text-light small mb-0" style="line-height: 1.6;">
                                                        Sebagai pionir mobil pertama berbahan bakar bensin di dunia sejak 1886, divisi performa tinggi AMG menghadirkan filosofi 'One Man, One Engine' dengan dominasi kejuaraan balap dunia Formula 1.
                                                    </p>
                                                </div>
                                                <p class="text-muted small mb-4">
                                                    Dari 300 SL Gullwing legendaris hingga hypercar Mercedes-AMG ONE bertenaga F1, merajai puncak teknologi dan kemewahan Jerman.
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
                                                    <img src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=600&auto=format&fit=crop&q=80" alt="Mercedes HQ" class="img-fluid w-100" style="height: 200px; object-fit: cover;">
                                                    <span class="hq-badge"><i class="fa-solid fa-building me-1"></i> Global Headquarters</span>
                                                </div>
                                                <h5 class="fw-bold brand-font text-white mb-2">Affalterbach & Stuttgart</h5>
                                                <p class="text-muted small mb-2"><i class="fa-solid fa-location-dot text-danger me-2"></i>Daimlerstraße 1, 71563 Affalterbach, Germany.</p>
                                                <p class="text-secondary small">Fasilitas perakitan tangan mesin AMG dan Mercedes-Benz Museum yang memuat lebih dari 130 tahun sejarah otomotif dunia.</p>
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
                <button type="button" class="brand-nav-btn nav-next" id="brandNextBtn" aria-label="Next Brand" title="Brand Selanjutnya">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

            </div>

        </div>
    </section>

    <!-- ==================================================================== -->
    <!-- 4. ICONIC CARS SHOWCASE SECTION                                      -->
    <!-- ==================================================================== -->
    <section id="iconic" class="py-5 solid-content-section">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h6 class="text-danger fw-bold text-uppercase" style="letter-spacing: 2px;">Hall of Fame</h6>
                    <h2 class="fw-bold brand-font mb-0 text-white">ICONIC PICKS</h2>
                </div>
                <span class="text-muted small d-none d-md-block">Pure Performance & Timeless Engineering</span>
            </div>

            <div class="row g-4">
                <!-- Ferrari F40 -->
                <div class="col-lg-4 col-md-6">
                    <div class="custom-card h-100">
                        <img src="{{ asset('image/Ferrari F40.jpg') }}" class="card-img-top" alt="Ferrari F40" style="height: 220px; object-fit: cover;">
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-danger">FERRARI</span>
                                <span class="text-muted small"><i class="fa-regular fa-calendar me-1"></i> 1987</span>
                            </div>
                            <h4 class="fw-bold brand-font text-white mb-3">Ferrari F40</h4>
                            <div class="row g-2">
                                <div class="col-4"><div class="spec-box"><div class="spec-label">Power</div><div class="spec-val">471 HP</div></div></div>
                                <div class="col-4"><div class="spec-box"><div class="spec-label">0-100 km/h</div><div class="spec-val">4.1 s</div></div></div>
                                <div class="col-4"><div class="spec-box"><div class="spec-label">Top Speed</div><div class="spec-val">324 km/h</div></div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ferrari LaFerrari -->
                <div class="col-lg-4 col-md-6">
                    <div class="custom-card h-100">
                        <img src="{{ asset('image/Ferrari LaFerrari.avif') }}" class="card-img-top" alt="Ferrari LaFerrari" style="height: 220px; object-fit: cover;">
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-danger">FERRARI</span>
                                <span class="text-muted small"><i class="fa-regular fa-calendar me-1"></i> 2013</span>
                            </div>
                            <h4 class="fw-bold brand-font text-white mb-3">LaFerrari</h4>
                            <div class="row g-2">
                                <div class="col-4"><div class="spec-box"><div class="spec-label">Power</div><div class="spec-val">950 HP</div></div></div>
                                <div class="col-4"><div class="spec-box"><div class="spec-label">0-100 km/h</div><div class="spec-val">2.4 s</div></div></div>
                                <div class="col-4"><div class="spec-box"><div class="spec-label">Top Speed</div><div class="spec-val">350 km/h</div></div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ferrari SF90 Spider -->
                <div class="col-lg-4 col-md-6">
                    <div class="custom-card h-100">
                        <img src="{{ asset('image/Ferrari SF90 Spider.jpg') }}" class="card-img-top" alt="Ferrari SF90 Spider" style="height: 220px; object-fit: cover;">
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-danger">FERRARI</span>
                                <span class="text-muted small"><i class="fa-regular fa-calendar me-1"></i> 2020</span>
                            </div>
                            <h4 class="fw-bold brand-font text-white mb-3">SF90 Spider</h4>
                            <div class="row g-2">
                                <div class="col-4"><div class="spec-box"><div class="spec-label">Power</div><div class="spec-val">986 HP</div></div></div>
                                <div class="col-4"><div class="spec-box"><div class="spec-label">0-100 km/h</div><div class="spec-val">2.5 s</div></div></div>
                                <div class="col-4"><div class="spec-box"><div class="spec-label">Top Speed</div><div class="spec-val">340 km/h</div></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================================================================== -->
    <!-- 5. QUICK COMPARE TEASER SECTION                                      -->
    <!-- ==================================================================== -->
    <section id="compare" class="py-5 solid-content-section">
        <div class="container py-4">
            <div class="compare-teaser">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <span class="badge bg-danger mb-2">HEAD-TO-HEAD</span>
                        <h2 class="fw-bold brand-font mb-3 text-white">BENCHMARK YOUR DREAM CARS</h2>
                        <p class="text-muted mb-4">
                            Compare technical specifications side-by-side: from powertrain output, torque, and acceleration to curb weight and top speed.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <span class="text-secondary small"><i class="fa-solid fa-check text-danger me-1"></i> Powertrain & Engine Output</span>
                            <span class="text-secondary small"><i class="fa-solid fa-check text-danger me-1"></i> 0-100 km/h Acceleration</span>
                            <span class="text-secondary small"><i class="fa-solid fa-check text-danger me-1"></i> Power-to-Weight Ratio</span>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center mt-4 mt-lg-0">
                        <div class="p-4 bg-dark rounded border border-secondary">
                            <div class="display-6 brand-font fw-bold text-danger mb-3">VS</div>
                            <p class="small text-secondary mb-3">Select 2 to 3 vehicles across multiple marques</p>
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
    <section id="membership" class="py-5 solid-content-section" style="background-color: #08090d;">
        <div class="container py-4">
            <div class="row justify-content-center text-center mb-4">
                <div class="col-md-8">
                    <h6 class="text-danger fw-bold text-uppercase" style="letter-spacing: 2px;">Exclusive Privilege</h6>
                    <h2 class="fw-bold brand-font text-white">AUTOMOBILLI CLUB MEMBERSHIP</h2>
                    <p class="text-muted">Unlock exclusive privileges curated for true automotive purists.</p>
                </div>
            </div>

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