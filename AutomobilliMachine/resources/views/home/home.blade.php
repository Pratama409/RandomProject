<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutomobilliMachine</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png/jpg" href="{{ asset('image/Favicon/Favicon.jpg') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

    <!-- =========================================
         HERO SECTION: FULL SCREEN VISUAL
         ========================================= -->
    <main class="hero-wrapper" id="top">
        <!-- Background Penuh Foto Mobil (Fixed 100vw x 100vh) -->
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

                <!-- Kolom 4 (Melengkapi Ujung Kanan) -->
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

        <!-- Konten Teks Mengambang di Atas Gambar Penuh -->
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
                <a href="{{ url('/compare') }}" class="btn-outline">Bandingkan Mobil</a>
            </div>

            <div class="scroll-indicator" title="Scroll ke bawah"></div>
        </section>
    </main>


    <!-- =========================================
         SECTION BRAND 1: PORSCHE
         ========================================= -->
    <section class="brand-section" id="brands">
        <div class="section-container">
            <div class="brand-header">
                <h2 class="brand-title">Porsche / Stuttgart Heritage</h2>
                <p class="brand-desc">
                    Keunggulan presisi teknik Jerman dengan konfigurasi mesin boxer ikonik dan filosofi performa murni.
                </p>
                <div class="color-swatches">
                    <div class="swatch-circle" style="background-color: #d11920;"></div>
                    <div class="swatch-circle" style="background-color: #c0c0c0;"></div>
                </div>
            </div>

            <div class="brand-grid">
                <a href="{{ url('/brands/porsche/911-gt3-rs') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag badge-green">ICONIC</span>
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&auto=format&fit=crop&q=80" alt="Porsche 911 GT3 RS">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>911 GT3 RS</h3>
                            <p>Atmospheric Boxer • 9,000 RPM Redline</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>

                <a href="{{ url('/brands/porsche/taycan-turbo-s') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag badge-purple">EV SPORT</span>
                        <img src="https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800&auto=format&fit=crop&q=80" alt="Porsche Taycan Turbo S">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>Taycan Turbo S</h3>
                            <p>Dual Electric Motor • 750 HP Overboost</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>

                <a href="{{ url('/brands/porsche/718-cayman-gt4') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag">TRACK READY</span>
                        <img src="https://images.unsplash.com/photo-1611821064430-0d40291d0f0b?w=800&auto=format&fit=crop&q=80" alt="718 Cayman GT4 RS">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>718 Cayman GT4 RS</h3>
                            <p>Mid-Engine Balance • 493 HP</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>

                <a href="{{ url('/brands/porsche/panamera-turbo') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag badge-green">LUXURY</span>
                        <img src="https://images.unsplash.com/photo-1541348263662-e0c8de4259ba?w=800&auto=format&fit=crop&q=80" alt="Panamera Turbo E-Hybrid">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>Panamera Turbo E-Hybrid</h3>
                            <p>4.0L V8 + Motor Listrik • 670 HP</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>
            </div>
        </div>
    </section>


    <!-- =========================================
         SECTION BRAND 2: FERRARI
         ========================================= -->
    <section class="brand-section">
        <div class="section-container">
            <div class="brand-header">
                <h2 class="brand-title">Ferrari / Maranello Passion</h2>
                <p class="brand-desc">
                    DNA Scuderia dari Italia. Suara raungan mesin V8 dan V12 yang memadukan gairah balap serta desain eksotis.
                </p>
                <div class="color-swatches">
                    <div class="swatch-circle" style="background-color: #d40000;"></div>
                    <div class="swatch-circle" style="background-color: #ffde00;"></div>
                </div>
            </div>

            <div class="brand-grid">
                <a href="{{ url('/brands/ferrari/f8-tributo') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag">V8 POWER</span>
                        <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800&auto=format&fit=crop&q=80" alt="Ferrari F8 Tributo">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>F8 Tributo</h3>
                            <p>3.9L Twin-Turbo V8 • 710 HP</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>

                <a href="{{ url('/brands/ferrari/sf90-stradale') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag badge-purple">HYBRID 1000HP</span>
                        <img src="https://images.unsplash.com/photo-1592198084033-aade902d1aae?w=800&auto=format&fit=crop&q=80" alt="Ferrari SF90 Stradale">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>SF90 Stradale</h3>
                            <p>V8 PHEV AWD • 986 HP</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>

                <a href="{{ url('/brands/ferrari/roma') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag badge-green">GRAND TOURER</span>
                        <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?w=800&auto=format&fit=crop&q=80" alt="Ferrari Roma">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>Ferrari Roma</h3>
                            <p>Nuova Dolce Vita • 612 HP</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>

                <a href="{{ url('/brands/ferrari/812-competizione') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag">V12 NA</span>
                        <img src="https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?w=800&auto=format&fit=crop&q=80" alt="Ferrari 812 Superfast">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>812 Competizione</h3>
                            <p>6.5L Naturally Aspirated V12 • 819 HP</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>
            </div>
        </div>
    </section>


    <!-- =========================================
         SECTION BRAND 3: BMW
         ========================================= -->
    <section class="brand-section">
        <div class="section-container">
            <div class="brand-header">
                <h2 class="brand-title">BMW / The Ultimate Driving Machine</h2>
                <p class="brand-desc">
                    Divisi BMW M menyajikan distribusi bobot seimbang 50:50 dan mesin inline-6 legendaris yang responsif.
                </p>
                <div class="color-swatches">
                    <div class="swatch-circle" style="background-color: #0066b1;"></div>
                    <div class="swatch-circle" style="background-color: #e21b23;"></div>
                </div>
            </div>

            <div class="brand-grid">
                <a href="{{ url('/brands/bmw/m4-competition') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag badge-green">M POWER</span>
                        <img src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800&auto=format&fit=crop&q=80" alt="BMW M4">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>M4 Competition</h3>
                            <p>3.0L S58 Twin-Turbo Inline-6 • 503 HP</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>

                <a href="{{ url('/brands/bmw/m5-cs') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag">SUPER SEDAN</span>
                        <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&auto=format&fit=crop&q=80" alt="BMW M5 CS">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>M5 CS</h3>
                            <p>4.4L Twin-Turbo V8 • 627 HP</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>

                <a href="{{ url('/brands/bmw/m2-coupe') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag badge-purple">AGILE</span>
                        <img src="https://images.unsplash.com/photo-1607853202273-797f1c22a38e?w=800&auto=format&fit=crop&q=80" alt="BMW M2 Coupe">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>M2 Coupe</h3>
                            <p>Compact Track Monster • 453 HP</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>

                <a href="{{ url('/brands/bmw/i8-roadster') }}" class="car-card">
                    <div class="car-thumbnail-wrapper">
                        <span class="badge-tag">FUTURISTIC</span>
                        <img src="https://images.unsplash.com/photo-1556189250-72ba954cfc2b?w=800&auto=format&fit=crop&q=80" alt="BMW i8 Roadster">
                    </div>
                    <div class="car-card-body">
                        <div>
                            <h3>i8 Roadster</h3>
                            <p>Hybrid Aero Innovation • Butterfly Doors</p>
                        </div>
                        <span class="btn-card-action">Detail &rarr;</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Tombol Mengapung Scroll To Top -->
    <a href="#top" class="btn-scroll-top" title="Kembali ke atas">&#8593;</a>

    <!-- JavaScript Terpisah -->
    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>