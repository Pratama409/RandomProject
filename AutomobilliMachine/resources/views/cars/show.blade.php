@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('title', $vehicle->name . ' - AutomobilliMachine')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/car.css') }}?v=20260928-10">
@endpush

@section('content')
    <div class="car-detail-page">
        <main>
            @php
                $gallery = collect([$vehicle->image_path])
                    ->merge($vehicle->gallery_images ?? [])
                    ->filter()
                    ->unique()
                    ->values();

                $detailSections = collect($vehicle->detail_sections ?? []);
                $performanceSection = $detailSections->firstWhere('label', 'PERFORMANCE');
                $designSection = $detailSections->firstWhere('label', 'DESIGN');
                $powertrainSection = $detailSections->firstWhere('label', 'POWERTRAIN');

                $interiorSection = $detailSections->firstWhere('label', 'INTERIOR');
                $chassisSection = $detailSections->firstWhere('label', 'CHASSIS');
                $handlingSection = $detailSections->firstWhere('label', 'HANDLING');

                $performanceSpecs = collect($performanceSection['specs'] ?? []);
                $zeroTo200 = $performanceSpecs->firstWhere('label', '0–200 km/h');
                $fioranoLap = $performanceSpecs->firstWhere('label', 'Fiorano Lap');

                $comparisonCars = collect([$vehicle])
                    ->merge($relatedCars)
                    ->unique('id')
                    ->take(4)
                    ->values();
            @endphp

            <header class="car-detail-header">
                <div class="container car-detail-header-inner">
                    <a class="car-detail-header-brand" href="{{ route('home') }}">
                        <span class="car-detail-header-mark">
                            <i class="fa-solid fa-gauge-high"></i>
                        </span>
                        <span>AUTOMOBILLI</span>
                    </a>

                    <div class="car-detail-header-context">
                        <a href="{{ route('brands.show', $brand) }}">
                            <i class="fa-solid fa-arrow-left"></i>
                            {{ $brand->name }}
                        </a>
                        <span>{{ $vehicle->name }}</span>
                    </div>

                    <div class="car-detail-header-actions">
                        <button class="car-header-action js-car-favorite {{ $isFavorited ? 'is-active' : '' }}"
                            type="button"
                            data-car-id="{{ $vehicle->id }}"
                            data-car-name="{{ $vehicle->name }}"
                            aria-label="Favorite {{ $vehicle->name }}"
                            aria-pressed="{{ $isFavorited ? 'true' : 'false' }}">
                            <i class="{{ $isFavorited ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                        </button>
                        <button class="car-header-action js-car-wishlist {{ $isWishlisted ? 'is-active' : '' }}"
                            type="button"
                            data-car-id="{{ $vehicle->id }}"
                            data-car-name="{{ $vehicle->name }}"
                            aria-label="Wishlist {{ $vehicle->name }}"
                            aria-pressed="{{ $isWishlisted ? 'true' : 'false' }}">
                            <i class="{{ $isWishlisted ? 'fa-solid' : 'fa-regular' }} fa-bookmark"></i>
                        </button>
                    </div>
                </div>
            </header>

            <section class="car-showcase-hero">
                <div class="car-showcase-hero-media">
                    @if ($vehicle->image_path)
                        <img id="heroCarImage"
                            src="{{ str_starts_with($vehicle->image_path, 'http') ? $vehicle->image_path : asset($vehicle->image_path) }}"
                            alt="{{ $vehicle->name }}">
                    @endif
                </div>
                <div class="car-showcase-hero-overlay"></div>

                <div class="container car-showcase-hero-content">
                    <div class="car-showcase-copy">
                        <a class="car-detail-back" href="{{ route('brands.show', $brand) }}">
                            <i class="fa-solid fa-arrow-left"></i>
                            Back to {{ $brand->name }}
                        </a>

                        @if ($brand->logo_path)
                            <div class="car-showcase-brand-logo">
                                <img
                                    src="{{ str_starts_with($brand->logo_path, 'http') ? $brand->logo_path : asset($brand->logo_path) }}"
                                    alt="{{ $brand->name }} logo"
                                >
                            </div>
                        @endif

                        <span class="car-showcase-brandline">
                            {{ $brand->name }}
                            <b>·</b>
                            {{ $vehicle->category?->name ?: 'Model' }}
                        </span>

                        @php
                            $familyLabel = $vehicle->model_family ?: $vehicle->name;
                            $variantLabel = trim(Str::after($vehicle->name, $familyLabel));
                        @endphp

                        <h1>
                            <span>{{ $familyLabel }}</span>
                            @if ($variantLabel !== '')
                                <strong>{{ $variantLabel }}</strong>
                            @endif
                        </h1>

                        <p class="car-showcase-subtitle">
                            {{ strtoupper($vehicle->production_type ?: 'PRODUCTION') }}
                            ·
                            {{ strtoupper($vehicle->vehicle_type ?: 'ROAD CAR') }}
                        </p>

                        <div class="car-showcase-badges">
                            @if ($vehicle->production_type)
                                <span>{{ $vehicle->production_type }}</span>
                            @endif
                            @if ($vehicle->vehicle_type)
                                <span>{{ $vehicle->vehicle_type }}</span>
                            @endif
                            @if ($vehicle->fuel_type)
                                <span>{{ $vehicle->fuel_type }}</span>
                            @endif
                            @if ($vehicle->drivetrain)
                                <span>{{ $vehicle->drivetrain }}</span>
                            @endif
                        </div>

                        <p class="car-showcase-lead">
                            {{ $vehicle->description ?: ($vehicle->short_description ?: 'Detailed information for this model is being added to the catalog.') }}
                        </p>
                    </div>

                    @if ($gallery->isNotEmpty())
                        <div class="car-showcase-gallery" data-gallery>
                            @foreach ($gallery->take(5) as $index => $image)
                                <button type="button"
                                    class="car-gallery-thumb {{ $index === 0 ? 'is-active' : '' }}"
                                    data-image-url="{{ str_starts_with($image, 'http') ? $image : asset($image) }}"
                                    aria-label="Show image {{ $index + 1 }}">
                                    <img src="{{ str_starts_with($image, 'http') ? $image : asset($image) }}" alt="{{ $vehicle->name }} image {{ $index + 1 }}">
                                </button>
                            @endforeach
                            @if ($gallery->count() > 5)
                                <span class="car-gallery-more">+{{ $gallery->count() - 5 }}</span>
                            @endif
                        </div>
                    @endif
                </div>
            </section>

            <nav class="car-showcase-nav" aria-label="Vehicle sections">
                <div class="container">
                    <div class="car-showcase-nav-scroll">
                        <a href="#overview">Overview</a>
                        @if ($designSection)<a href="#design">Design</a>@endif
                        @if ($powertrainSection)<a href="#powertrain">Powertrain</a>@endif
                        <a href="#performance">Performance</a>
                        <a href="#technical">Specifications</a>
                        @if ($interiorSection)<a href="#interior">Interior</a>@endif
                        @if ($handlingSection || $chassisSection)<a href="#chassis">Chassis</a>@endif
                        <a href="#production">Production</a>
                        @if (!empty($vehicle->variants))<a href="#variants">Variants</a>@endif
                        <a href="#gallery">Gallery</a>
                    </div>
                </div>
            </nav>

            <section class="car-showcase-section car-showcase-overview" id="overview">
                <div class="container car-showcase-split">
                    <div class="car-showcase-text">
                        <span class="car-detail-section-label">OVERVIEW</span>
                        <h2>A new era for {{ $brand->name }}</h2>
                        <p>{{ $vehicle->description ?: ($vehicle->short_description ?: 'No extended description has been added yet.') }}</p>

                        <div class="car-showcase-overview-actions">
                            <a class="car-showcase-primary-button" href="#gallery">
                                <i class="fa-regular fa-images"></i>
                                Explore Gallery
                            </a>
                            <a class="car-showcase-secondary-button" href="#technical">
                                <i class="fa-solid fa-cube"></i>
                                Explore Specs
                            </a>
                        </div>
                    </div>

                    <div class="car-showcase-visual">
                        @if ($gallery->count() > 1)
                            <img src="{{ str_starts_with($gallery->get(1), 'http') ? $gallery->get(1) : asset($gallery->get(1)) }}"
                                alt="{{ $vehicle->name }} rear view">
                        @else
                            <img src="{{ str_starts_with($vehicle->image_path, 'http') ? $vehicle->image_path : asset($vehicle->image_path) }}"
                                alt="{{ $vehicle->name }}">
                        @endif
                        <div class="car-showcase-visual-overlay">
                            <span>OFFICIAL VIEW</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </section>

            @if ($designSection)
                <section class="car-showcase-section car-showcase-feature" id="design">
                    <div class="container car-showcase-feature-grid">
                        <div class="car-showcase-feature-copy">
                            <span class="car-detail-section-label">{{ $designSection['label'] }}</span>
                            <h2>Dynamics in motion</h2>
                            @foreach ($designSection['paragraphs'] ?? [] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                            <a class="car-showcase-secondary-button" href="#technical">
                                View design details
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="car-showcase-design-collage">
                            <div class="car-showcase-feature-media main">
                                <img src="{{ str_starts_with($gallery->get(0), 'http') ? $gallery->get(0) : asset($gallery->get(0)) }}"
                                    alt="{{ $vehicle->name }} front three-quarter">
                            </div>

                            @foreach ($gallery->slice(2, 2) as $image)
                                <div class="car-showcase-feature-media mini">
                                    <img src="{{ str_starts_with($image, 'http') ? $image : asset($image) }}"
                                        alt="{{ $vehicle->name }} detail">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @if ($powertrainSection)
                <section class="car-showcase-section car-showcase-dark-feature" id="powertrain">
                    <div class="container car-showcase-powertrain-grid">
                        <div class="car-showcase-feature-copy">
                            <span class="car-detail-section-label">{{ $powertrainSection['label'] }}</span>
                            <h2>V8 meets electrification</h2>
                            @foreach ($powertrainSection['paragraphs'] ?? [] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                            <a class="car-showcase-secondary-button" href="#technical">
                                View powertrain details
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="car-showcase-powertrain-visual">
                            <div class="car-powertrain-art">
                                <span>V8</span>
                                <strong>+ 3 ELECTRIC MOTORS</strong>
                            </div>

                            <div class="car-showcase-spec-panel">
                                @foreach ($powertrainSection['specs'] ?? [] as $spec)
                                    <div>
                                        <span>{{ $spec['label'] ?? 'Specification' }}</span>
                                        <strong>{{ $spec['value'] ?? '—' }}</strong>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            <section class="car-showcase-section car-showcase-performance-section" id="performance">
                <div class="container">
                    <div class="car-showcase-heading-row">
                        <div>
                            <span class="car-detail-section-label">PERFORMANCE</span>
                            <h2>Extraordinary numbers</h2>
                            <p>{{ $performanceSection['paragraphs'][0] ?? 'Key performance specifications recorded for this model.' }}</p>
                        </div>

                        <div class="car-showcase-performance-state {{ $vehicle->stats_tested ? 'is-tested' : '' }}">
                            <span class="car-status-dot"></span>
                            <strong>{{ $vehicle->stats_tested ? 'Tested' : 'Not Tested' }}</strong>
                        </div>
                    </div>

                    <div class="car-showcase-metrics">
                        <article><span>0–100 km/h</span><strong>{{ $vehicle->acceleration_0_100 !== null ? number_format((float) $vehicle->acceleration_0_100, 2) : '—' }}</strong><small>seconds</small></article>
                        <article><span>0–200 km/h</span><strong>{{ $zeroTo200['value'] ?? '—' }}</strong><small>factory figure</small></article>
                        <article><span>Top Speed</span><strong>{{ $vehicle->top_speed_kmh !== null ? number_format($vehicle->top_speed_kmh) : '—' }}</strong><small>km/h</small></article>
                        <article><span>Fiorano Lap</span><strong>{{ $fioranoLap['value'] ?? '—' }}</strong><small>recorded figure</small></article>
                    </div>

                    <div class="car-showcase-inline-specs">
                        <div><span>Drivetrain</span><strong>{{ $vehicle->drivetrain ?: '—' }}</strong></div>
                        <div><span>Transmission</span><strong>{{ $vehicle->transmission ?: '—' }}</strong></div>
                        <div><span>Weight (Dry)</span><strong>{{ collect($chassisSection['specs'] ?? [])->firstWhere('label', 'Dry Weight')['value'] ?? '—' }}</strong></div>
                        <div><span>Dimensions</span><strong>{{ collect($detailSections->firstWhere('label','DIMENSIONS')['specs'] ?? [])->map(fn($s) => $s['value'])->implode(' × ') ?: '—' }}</strong></div>
                        <div><span>Fuel Type</span><strong>{{ $vehicle->fuel_type ?: '—' }}</strong></div>
                        <div><span>Production</span><strong>{{ $vehicle->production_year_start ?: '—' }}–{{ $vehicle->production_year_end ?: 'Present' }}</strong></div>
                    </div>
                </div>
            </section>

            <section class="car-showcase-section car-showcase-quick-grid">
                <div class="container car-showcase-quick-cards">
                    @if ($interiorSection)
                        <article class="car-showcase-quick-card">
                            <span class="car-quick-icon"><i class="fa-solid fa-chair"></i></span>
                            <span class="car-detail-section-label">INTERIOR</span>
                            <h3>{{ $interiorSection['title'] }}</h3>
                            <p>{{ $interiorSection['paragraphs'][0] ?? 'Driver-focused interior and technology.' }}</p>
                            <a href="#interior">View Interior <i class="fa-solid fa-arrow-right"></i></a>
                        </article>
                    @endif

                    @if ($chassisSection || $handlingSection)
                        <article class="car-showcase-quick-card">
                            <span class="car-quick-icon"><i class="fa-solid fa-road"></i></span>
                            <span class="car-detail-section-label">CHASSIS & HANDLING</span>
                            <h3>{{ ($chassisSection['title'] ?? 'Chassis') }}</h3>
                            <p>{{ ($handlingSection['paragraphs'][0] ?? $chassisSection['paragraphs'][0] ?? 'Advanced chassis technology for performance and stability.') }}</p>
                            <a href="#chassis">View Chassis <i class="fa-solid fa-arrow-right"></i></a>
                        </article>
                    @endif

                    <article class="car-showcase-quick-card">
                        <span class="car-quick-icon"><i class="fa-solid fa-industry"></i></span>
                        <span class="car-detail-section-label">PRODUCTION</span>
                        <h3>{{ $vehicle->production_year_start ?: '—' }}–{{ $vehicle->production_year_end ?: 'Present' }}</h3>
                        <p>{{ $brand->name }} production and model identity information.</p>
                        <a href="#production">View Production <i class="fa-solid fa-arrow-right"></i></a>
                    </article>

                    <article class="car-showcase-quick-card">
                        <span class="car-quick-icon"><i class="fa-solid fa-layer-group"></i></span>
                        <span class="car-detail-section-label">VARIANTS</span>
                        <h3>{{ collect($vehicle->variants ?? [])->count() }} related variants</h3>
                        <p>Explore related versions, packages, and derivatives.</p>
                        @if (!empty($vehicle->variants))
                            <a href="#variants">View Variants <i class="fa-solid fa-arrow-right"></i></a>
                        @endif
                    </article>
                </div>
            </section>

            @if ($interiorSection)
                <section class="car-showcase-section car-showcase-mini-section" id="interior">
                    <div class="container car-showcase-mini-grid">
                        <div>
                            <span class="car-detail-section-label">INTERIOR</span>
                            <h2>{{ $interiorSection['title'] }}</h2>
                            @foreach ($interiorSection['paragraphs'] ?? [] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>

                        <div class="car-showcase-side-specs">
                            @foreach ($interiorSection['specs'] ?? [] as $spec)
                                <div><span>{{ $spec['label'] }}</span><strong>{{ $spec['value'] }}</strong></div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @if ($chassisSection || $handlingSection)
                <section class="car-showcase-section car-showcase-mini-section" id="chassis">
                    <div class="container car-showcase-mini-grid">
                        <div>
                            <span class="car-detail-section-label">CHASSIS & HANDLING</span>
                            <h2>{{ $chassisSection['title'] ?? $handlingSection['title'] ?? 'Chassis & Handling' }}</h2>
                            @foreach (($handlingSection['paragraphs'] ?? []) as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                            @foreach (($chassisSection['paragraphs'] ?? []) as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                            @if (!empty($handlingSection['items']))
                                <ul class="car-showcase-points">
                                    @foreach ($handlingSection['items'] as $item)
                                        <li><i class="fa-solid fa-arrow-right"></i><span>{{ $item }}</span></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="car-showcase-side-specs">
                            @foreach (collect($chassisSection['specs'] ?? [])->merge($handlingSection['specs'] ?? []) as $spec)
                                <div><span>{{ $spec['label'] }}</span><strong>{{ $spec['value'] }}</strong></div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            <section class="car-showcase-section car-showcase-technical" id="technical">
                <div class="container">
                    <div class="car-showcase-heading-row">
                        <div>
                            <span class="car-detail-section-label">KEY SPECIFICATIONS</span>
                            <h2>The numbers behind the {{ $vehicle->name }}</h2>
                        </div>
                    </div>

                    <div class="car-showcase-tech-grid">
                        <div><span>Engine</span><strong>{{ $vehicle->engine ?: '—' }}</strong></div>
                        <div><span>Total Output</span><strong>{{ $vehicle->horsepower !== null ? number_format($vehicle->horsepower) . ' HP' : '—' }}</strong></div>
                        <div><span>Total Torque</span><strong>{{ $vehicle->torque_nm !== null ? number_format($vehicle->torque_nm) . ' Nm' : '—' }}</strong></div>
                        <div><span>Drivetrain</span><strong>{{ $vehicle->drivetrain ?: '—' }}</strong></div>
                        <div><span>Transmission</span><strong>{{ $vehicle->transmission ?: '—' }}</strong></div>
                        <div><span>Weight (Dry)</span><strong>{{ collect($chassisSection['specs'] ?? [])->firstWhere('label', 'Dry Weight')['value'] ?? '—' }}</strong></div>
                        <div><span>Dimensions</span><strong>{{ collect($detailSections->firstWhere('label','DIMENSIONS')['specs'] ?? [])->map(fn($s) => $s['value'])->implode(' × ') ?: '—' }}</strong></div>
                        <div><span>Fuel Type</span><strong>{{ $vehicle->fuel_type ?: '—' }}</strong></div>
                    </div>
                </div>
            </section>

            <section class="car-showcase-section car-showcase-production" id="production">
                <div class="container car-showcase-production-grid">
                    <div>
                        <span class="car-detail-section-label">PRODUCTION</span>
                        <h2>Model identity</h2>
                        <p>Production information separates the model's history, road-car status, and catalog classification.</p>
                    </div>

                    <dl class="car-showcase-production-list">
                        <div><dt>Model Family</dt><dd>{{ $vehicle->model_family ?: '—' }}</dd></div>
                        <div><dt>Generation</dt><dd>{{ $vehicle->generation ?: '—' }}</dd></div>
                        <div><dt>Variant</dt><dd>{{ $vehicle->variant ?: '—' }}</dd></div>
                        <div><dt>Production Type</dt><dd>{{ $vehicle->production_type ?: '—' }}</dd></div>
                        <div><dt>Vehicle Type</dt><dd>{{ $vehicle->vehicle_type ?: '—' }}</dd></div>
                        <div><dt>Production Count</dt><dd>{{ $vehicle->production_count !== null ? number_format($vehicle->production_count) . ' units' : 'Not specified' }}</dd></div>
                        <div><dt>Road Legal</dt><dd>{{ $vehicle->road_legal ? 'Yes' : 'No' }}</dd></div>
                        <div><dt>Publicly Sold</dt><dd>{{ $vehicle->publicly_sold ? 'Yes' : 'No' }}</dd></div>
                    </dl>
                </div>
            </section>

            @if (!empty($vehicle->variants))
                <section class="car-showcase-section car-showcase-variants" id="variants">
                    <div class="container">
                        <div class="car-showcase-heading-row">
                            <div>
                                <span class="car-detail-section-label">VARIANTS</span>
                                <h2>Versions & related derivatives</h2>
                            </div>
                        </div>

                        <div class="car-showcase-variant-grid">
                            @foreach ($vehicle->variants as $variant)
                                <article class="car-showcase-variant-card">
                                    <span>{{ $variant['type'] ?? 'Variant' }}</span>
                                    <h3>{{ $variant['name'] ?? 'Unnamed variant' }}</h3>
                                    @if (!empty($variant['years']))<small>{{ $variant['years'] }}</small>@endif
                                    @if (!empty($variant['description']))<p>{{ $variant['description'] }}</p>@endif
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            <section class="car-showcase-section car-showcase-gallery-section" id="gallery">
                <div class="container">
                    <div class="car-showcase-heading-row">
                        <div>
                            <span class="car-detail-section-label">GALLERY</span>
                            <h2>Explore every angle</h2>
                            <p>Images currently recorded in the Automobilli catalog for this model.</p>
                        </div>
                    </div>

                    <div class="car-gallery-grid">
                        @foreach ($gallery->take(7) as $index => $image)
                            <button type="button" class="car-gallery-card {{ $index === 0 ? 'is-large' : '' }}"
                                data-gallery-jump="{{ str_starts_with($image, 'http') ? $image : asset($image) }}">
                                <img src="{{ str_starts_with($image, 'http') ? $image : asset($image) }}"
                                    alt="{{ $vehicle->name }} gallery image {{ $index + 1 }}" loading="lazy">
                            </button>
                        @endforeach

                        @if ($gallery->isEmpty())
                            <div class="car-gallery-empty">No gallery images recorded yet.</div>
                        @endif
                    </div>
                </div>
            </section>

            <section class="car-showcase-section car-showcase-compare">
                <div class="container">
                    <div class="car-showcase-heading-row">
                        <div>
                            <span class="car-detail-section-label">COMPARE</span>
                            <h2>Similar models</h2>
                            <p>Quick reference points from other Ferrari models in the current catalog.</p>
                        </div>
                    </div>

                    <div class="car-compare-grid">
                        @foreach ($comparisonCars as $compareCar)
                            <a href="{{ route('cars.show', ['brand' => $brand->slug, 'car' => $compareCar->slug]) }}"
                                class="car-compare-card {{ $compareCar->id === $vehicle->id ? 'is-current' : '' }}">
                                <div class="car-compare-card-top">
                                    <span>{{ $compareCar->name }}</span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>
                                <div class="car-compare-stats">
                                    <span>{{ $compareCar->horsepower !== null ? number_format($compareCar->horsepower) . ' HP' : '—' }}</span>
                                    <span>{{ $compareCar->acceleration_0_100 !== null ? number_format((float) $compareCar->acceleration_0_100, 2) . ' s' : '—' }}</span>
                                    <span>{{ $compareCar->top_speed_kmh !== null ? number_format($compareCar->top_speed_kmh) . ' km/h' : '—' }}</span>
                                </div>
                                <div class="car-compare-media">
                                    @if ($compareCar->image_path)
                                        <img src="{{ str_starts_with($compareCar->image_path, 'http') ? $compareCar->image_path : asset($compareCar->image_path) }}"
                                            alt="{{ $compareCar->name }}" loading="lazy">
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>

            @if (!empty($vehicle->source_links))
                <section class="car-showcase-section car-showcase-sources" id="sources">
                    <div class="container">
                        <span class="car-detail-section-label">SOURCES</span>
                        <h2>Reference material</h2>
                        <div class="car-sources-list">
                            @foreach ($vehicle->source_links as $source)
                                <a href="{{ $source['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="car-source-link">
                                    <span>{{ $source['label'] ?? 'Source' }}</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            <section class="car-showcase-cta">
                <div class="container">
                    <div class="car-showcase-cta-inner">
                        <div>
                            <span class="car-detail-section-label">EXPERIENCE {{ strtoupper($brand->name) }}</span>
                            <h2>Discover more models from {{ $brand->name }}</h2>
                        </div>
                        <a class="car-showcase-cta-button" href="{{ route('brands.show', $brand) }}">
                            View {{ $brand->name }} lineup
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </section>
        </main>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/car.js') }}?v=20260928-1"></script>
@endpush