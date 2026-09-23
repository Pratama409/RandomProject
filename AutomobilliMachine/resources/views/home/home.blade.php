@extends('layouts.app')

@section('title', 'Beranda - AutomobilliMachine')

@section('content')

    <!-- ==================================================================== -->
    <!-- 1. HERO SECTION: FULLSCREEN ANGLED GALLERY                           -->
    <!-- ==================================================================== -->
    <main class="hero-wrapper" id="top">
        <!-- Visual Gambar Miring Latar Belakang Penuh -->
        <aside class="hero-visual-fullscreen">
            <div class="hero-backdrop-overlay"></div>

            <div class="angled-gallery">
                <!-- Kolom 1 -->
                <div class="gallery-col col-offset-1">
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=700&auto=format&fit=crop&q=80" alt="Porsche 911 GT3">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?w=700&auto=format&fit=crop&q=80" alt="Ferrari 812">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=700&auto=format&fit=crop&q=80" alt="BMW M4">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=700&auto=format&fit=crop&q=80" alt="Porsche Taycan">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=700&auto=format&fit=crop&q=80" alt="Ferrari F8">
                    </div>
                </div>

                <!-- Kolom 2 -->
                <div class="gallery-col col-offset-2">
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=700&auto=format&fit=crop&q=80" alt="Lamborghini Aventador">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=700&auto=format&fit=crop&q=80" alt="BMW M5 CS">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?w=700&auto=format&fit=crop&q=80" alt="Ferrari Roma">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1611821064430-0d40291d0f0b?w=700&auto=format&fit=crop&q=80" alt="Porsche Cayman">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1556189250-72ba954cfc2b?w=700&auto=format&fit=crop&q=80" alt="BMW i8">
                    </div>
                </div>

                <!-- Kolom 3 -->
                <div class="gallery-col col-offset-3">
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1607853202273-797f1c22a38e?w=700&auto=format&fit=crop&q=80" alt="BMW M2">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1592198084033-aade902d1aae?w=700&auto=format&fit=crop&q=80" alt="Ferrari SF90">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1541348263662-e0c8de4259ba?w=700&auto=format&fit=crop&q=80" alt="Porsche Panamera">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=700&auto=format&fit=crop&q=80" alt="Porsche 911">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=700&auto=format&fit=crop&q=80" alt="BMW M4">
                    </div>
                </div>

                <!-- Kolom 4 -->
                <div class="gallery-col col-offset-4">
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?w=700&auto=format&fit=crop&q=80" alt="Ferrari 812">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=700&auto=format&fit=crop&q=80" alt="Ferrari F8">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=700&auto=format&fit=crop&q=80" alt="Lamborghini">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=700&auto=format&fit=crop&q=80" alt="BMW M5">
                    </div>
                    <div class="showcase-card">
                        <img src="https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=700&auto=format&fit=crop&q=80" alt="Porsche Taycan">
                    </div>
                </div>
            </div>
        </aside>

        <!-- Teks Mengambang di Atas Gambar -->
        <section class="hero-content">
            <h1 class="hero-title">
                Automotive Excellence
                <span>to kick-start your passion</span>
            </h1>

            <p class="hero-desc">
                Jelajahi filosofi, sejarah, dan performa brand mobil legendaris dunia. Bandingkan spesifikasi mesin dan temukan mahakarya otomotif pilihan Anda.
            </p>

            <div class="hero-actions">
                <a href="#brands" class="btn-primary">Eksplor Brand</a>
                <a href="#compare" class="btn-outline">Bandingkan Mobil</a>
            </div>

            <div class="scroll-indicator" title="Scroll ke bawah"></div>
        </section>
    </main>

    <!-- ==================================================================== -->
    <!--                              NAVBAR                                  -->
    <!-- ==================================================================== -->

    @include('partials.navbar')
    
    <!-- ==================================================================== -->
    <!-- 2. SEKSI TRANSISI: ENGINEERED FOR PASSION                            -->
    <!-- ==================================================================== -->
    <section id="beranda" class="transition-banner text-center">
        <div class="container py-4">
            <span class="badge bg-danger px-3 py-2 text-uppercase mb-3 tracking-wide">
                The Ultimate Performance Hub
            </span>

            <h2 class="display-4 fw-bold brand-font text-white mb-3">
                ENGINEERED FOR PASSION
            </h2>

            <p class="text-secondary mx-auto fs-5 mb-4 transition-desc">
                Eksplorasi filosofi, warisan sejarah, dan inovasi mahakarya otomotif dunia dalam satu platform.
            </p>

            <div class="row g-3 justify-content-center mt-2">
                <div class="col-md-3 col-sm-6">
                    <div class="transition-feature">
                        <i class="fa-solid fa-flag-checkered text-danger me-2"></i>
                        <span>Heritage & Racing DNA</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="transition-feature">
                        <i class="fa-solid fa-microchip text-danger me-2"></i>
                        <span>Technical Specs Murni</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="transition-feature">
                        <i class="fa-solid fa-scale-balanced text-danger me-2"></i>
                        <span>Head-to-Head Compare</span>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="#brands" class="text-danger text-decoration-none fw-semibold small tracking-wide">
                    PILIH BRAND MOBIL <i class="fa-solid fa-chevron-down ms-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ==================================================================== -->
    <!-- 3. BRAND SELECTOR SECTION (PILIH BRAND MOBIL)                         -->
    <!-- ==================================================================== -->
    <section id="brands" class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h6 class="text-danger fw-bold text-uppercase" style="letter-spacing: 2px;">Brand Showcase</h6>
                <h2 class="fw-bold brand-font">PILIH BRAND MOBIL</h2>
                <p class="text-muted">Masuk ke setiap brand untuk menelusuri sejarah, filosofi, dan katalog mobil.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Ferrari -->
                <div class="col-md-4">
                    <div class="custom-card h-100 p-4 d-flex flex-column justify-content-between text-center">
                        <div>
                            <div class="mb-3 overflow-hidden rounded">
                                <img src="{{ asset('image/Ferrari SF90 Spider.jpg') }}" alt="Ferrari" class="img-fluid" style="height: 180px; width: 100%; object-fit: cover;">
                            </div>
                            <span class="badge bg-danger mb-2">ITALIA</span>
                            <h3 class="fw-bold brand-font mb-2">FERRARI</h3>
                            <p class="text-muted small">
                                "Essence of Italian Passion & Racing Heritage" — Dedikasi performa sirkuit F1 yang dibawa ke jalan raya.
                            </p>
                        </div>
                        <a href="{{ url('/ferrari') }}" class="btn btn-racing w-100 mt-3">
                            Masuk Brand Ferrari <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Lamborghini -->
                <div class="col-md-4">
                    <div class="custom-card h-100 p-4 d-flex flex-column justify-content-between text-center">
                        <div>
                            <div class="mb-3 overflow-hidden rounded">
                                <img src="https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?w=600&auto=format&fit=crop&q=80" alt="Lamborghini" class="img-fluid" style="height: 180px; width: 100%; object-fit: cover;">
                            </div>
                            <span class="badge bg-warning text-dark mb-2">ITALIA</span>
                            <h3 class="fw-bold brand-font mb-2">LAMBORGHINI</h3>
                            <p class="text-muted small">
                                "Expect the Unexpected" — Desain tajam, aerodinamika radikal, dan raungan mesin V12 sang banteng tempur.
                            </p>
                        </div>
                        <a href="#" class="btn btn-outline-custom w-100 mt-3">
                            Masuk Brand Lamborghini <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Mercedes-Benz -->
                <div class="col-md-4">
                    <div class="custom-card h-100 p-4 d-flex flex-column justify-content-between text-center">
                        <div>
                            <div class="mb-3 overflow-hidden rounded">
                                <img src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=600&auto=format&fit=crop&q=80" alt="Mercedes-Benz" class="img-fluid" style="height: 180px; width: 100%; object-fit: cover;">
                            </div>
                            <span class="badge bg-secondary mb-2">JERMAN</span>
                            <h3 class="fw-bold brand-font mb-2">MERCEDES-BENZ</h3>
                            <p class="text-muted small">
                                "The Best or Nothing" — Harmonisasi kemewahan kelas atas dan tenaga monster dari divisi AMG.
                            </p>
                        </div>
                        <a href="#" class="btn btn-outline-custom w-100 mt-3">
                            Masuk Brand Mercedes <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================================================================== -->
    <!-- 4. ICONIC CARS SHOWCASE SECTION                                      -->
    <!-- ==================================================================== -->
    <section id="iconic" class="py-5" style="background-color: #0e0e12;">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h6 class="text-danger fw-bold text-uppercase" style="letter-spacing: 2px;">Hall of Fame</h6>
                    <h2 class="fw-bold brand-font mb-0">MOBIL ICONIC PILIHAN</h2>
                </div>
                <span class="text-muted small d-none d-md-block">Spesifikasi Murni & Masterpiece</span>
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
                                <div class="col-4"><div class="spec-box"><div class="spec-label">Tenaga</div><div class="spec-val">471 HP</div></div></div>
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
                                <div class="col-4"><div class="spec-box"><div class="spec-label">Tenaga</div><div class="spec-val">950 HP</div></div></div>
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
                                <div class="col-4"><div class="spec-box"><div class="spec-label">Tenaga</div><div class="spec-val">986 HP</div></div></div>
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
    <!-- 5. QUICK COMPARE TEASER WIDGET                                       -->
    <!-- ==================================================================== -->
    <section id="compare" class="py-5">
        <div class="container py-4">
            <div class="compare-teaser">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <span class="badge bg-danger mb-2">HEAD-TO-HEAD</span>
                        <h2 class="fw-bold brand-font mb-3">BANDINGKAN MOBIL IMPIAN</h2>
                        <p class="text-muted mb-4">
                            Bandingkan spesifikasi mobil secara berdampingan mulai dari tenaga mesin, akselerasi, bobot, hingga kecepatan maksimal.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <span class="text-secondary small"><i class="fa-solid fa-check text-danger me-1"></i> Perbandingan Mesin</span>
                            <span class="text-secondary small"><i class="fa-solid fa-check text-danger me-1"></i> Akselerasi 0-100 km/h</span>
                            <span class="text-secondary small"><i class="fa-solid fa-check text-danger me-1"></i> Power-to-Weight Ratio</span>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center mt-4 mt-lg-0">
                        <div class="p-4 bg-dark rounded border border-secondary">
                            <div class="display-6 brand-font fw-bold text-danger mb-3">VS</div>
                            <p class="small text-secondary mb-3">Pilih 2 hingga 3 mobil dari berbagai brand</p>
                            <a href="#" class="btn btn-racing w-100">Buka Tool Komparasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================================================================== -->
    <!-- 6. MEMBERSHIP TEASER                                                 -->
    <!-- ==================================================================== -->
    <section id="membership" class="py-5" style="background-color: #0e0e12;">
        <div class="container py-4">
            <div class="row justify-content-center text-center mb-4">
                <div class="col-md-8">
                    <h6 class="text-danger fw-bold text-uppercase" style="letter-spacing: 2px;">Exclusive Privilege</h6>
                    <h2 class="fw-bold brand-font">AUTOMOBILLI CLUB MEMBERSHIP</h2>
                    <p class="text-muted">Akses fitur eksklusif untuk para antusias mobil sejati.</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="custom-card p-4 text-center h-100">
                        <i class="fa-solid fa-warehouse fa-3x text-danger mb-3"></i>
                        <h5 class="fw-bold brand-font">Virtual Garage</h5>
                        <p class="text-muted small">Pajang mobil koleksi atau hasil modifikasi Anda lengkap dengan detail spesifikasi custom.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card p-4 text-center h-100">
                        <i class="fa-solid fa-file-pdf fa-3x text-danger mb-3"></i>
                        <h5 class="fw-bold brand-font">Download Katalog PDF</h5>
                        <p class="text-muted small">Unduh brosur dan lembar spesifikasi resmi mobil beresolusi tinggi langsung dalam format PDF.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card p-4 text-center h-100">
                        <i class="fa-solid fa-chart-line fa-3x text-danger mb-3"></i>
                        <h5 class="fw-bold brand-font">Advanced Analytics</h5>
                        <p class="text-muted small">Analisis kurva tenaga, dyno graph, dan komparasi tanpa batas antar varian mobil.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tombol Floating Back to Top -->
    <a href="#top" class="btn-scroll-top" title="Kembali ke atas">
        <i class="fa-solid fa-arrow-up"></i>
    </a>

@endsection