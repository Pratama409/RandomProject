@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('title', $vehicle->name . ' - AutomobilliMachine')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/car.css') }}?v=20260929-1">
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
                $overviewSection = $detailSections->firstWhere('label', 'OVERVIEW');
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

                $productionImage = $gallery->get(5) ?? $gallery->first();
                $variantImage = asset('image/Ferrari SF90 Spider.jpg');

                $quickInsights = collect([
                    $interiorSection ? [
                        'id' => 'interior',
                        'label' => 'INTERIOR',
                        'title' => $interiorSection['title'] ?? 'Driver-Focused Cockpit',
                        'description' => collect($interiorSection['paragraphs'] ?? [])->implode("

"),
                        'image' => $interiorSection['detail_image'] ?? $gallery->get(2) ?? $gallery->first(),
                        'items' => $interiorSection['specs'] ?? [],
                        'icon' => 'fa-chair',
                    ] : null,
                    ($chassisSection || $handlingSection) ? [
                        'id' => 'chassis',
                        'label' => 'CHASSIS & HANDLING',
                        'title' => $chassisSection['title'] ?? $handlingSection['title'] ?? 'Chassis & Handling',
                        'description' => collect(array_merge($handlingSection['paragraphs'] ?? [], $chassisSection['paragraphs'] ?? []))->implode("

"),
                        'image' => $chassisSection['detail_image'] ?? $gallery->get(3) ?? $gallery->first(),
                        'items' => collect($chassisSection['specs'] ?? [])->merge($handlingSection['specs'] ?? [])->values()->all(),
                        'icon' => 'fa-road',
                    ] : null,
                    [
                        'id' => 'production',
                        'label' => 'PRODUCTION',
                        'title' => ($vehicle->production_year_start ?: '—') . '–' . ($vehicle->production_year_end ?: 'Present'),
                        'description' => $brand->name . ' production and model identity information.',
                        'image' => $productionImage,
                        'items' => [
                            ['label' => 'Production Type', 'value' => $vehicle->production_type ?: '—'],
                            ['label' => 'Publicly Sold', 'value' => $vehicle->publicly_sold ? 'Yes' : 'No'],
                            ['label' => 'Road Legal', 'value' => $vehicle->road_legal ? 'Yes' : 'No'],
                        ],
                        'icon' => 'fa-industry',
                    ],
                    [
                        'id' => 'variants',
                        'label' => 'VARIANTS',
                        'title' => collect($vehicle->variants ?? [])->count() . ' related variants',
                        'description' => 'Explore related versions, packages, and derivatives associated with this model.',
                        'image' => $variantImage,
                        'items' => collect($vehicle->variants ?? [])->map(function ($variant) {
                            return [
                                'label' => $variant['type'] ?? 'Variant',
                                'value' => $variant['name'] ?? 'Unnamed variant',
                            ];
                        })->values()->all(),
                        'icon' => 'fa-layer-group',
                    ],
                ])->filter()->values();
            @endphp

            <script>window.AUTOMOBILLI_INSIGHTS = @json($quickInsights);</script>

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
                            class="js-lightbox-trigger"
                            src="{{ str_starts_with($vehicle->image_path, 'http') ? $vehicle->image_path : asset($vehicle->image_path) }}"
                            alt="{{ $vehicle->name }}"
                            data-lightbox-caption="{{ $vehicle->name }}">
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
                        @if ($chassisSection || $handlingSection)<a href="#chassis">Chassis</a>@endif
                        <a href="#insights">Insights</a>
                        <a href="#production">Production</a>
                        @if (!empty($vehicle->variants))<a href="#variants">Variants</a>@endif
                        <a href="#gallery">Gallery</a>
                    </div>
                </div>
            </nav>

            @if ($quickInsights->isNotEmpty())
                <section class="car-showcase-section car-showcase-quick-grid" id="insights">
                    <div class="container">
                        <div class="car-showcase-heading-row">
                            <div>
                                <span class="car-detail-section-label">QUICK INSIGHTS</span>
                                <h2>Explore the details</h2>
                                <p>Open a section to explore its visual story, key information, and specifications.</p>
                            </div>
                        </div>

                        <div class="car-showcase-quick-cards">
                            @foreach ($quickInsights as $insightIndex => $insight)
                                <button
                                    type="button"
                                    class="car-showcase-quick-card js-detail-insight-trigger"
                                    data-insight-index="{{ $insightIndex }}"
                                    aria-label="Open {{ strtolower($insight['label']) }} details"
                                >
                                    <div class="car-showcase-quick-media">
                                        @if (!empty($insight['image']))
                                            <img src="{{ str_starts_with($insight['image'], 'http') ? $insight['image'] : asset($insight['image']) }}"
                                                alt="{{ $vehicle->name }} {{ strtolower($insight['label']) }}"
                                                loading="lazy">
                                        @endif
                                        <span class="car-quick-icon">
                                            <i class="fa-solid {{ $insight['icon'] }}"></i>
                                        </span>
                                    </div>
                                    <div class="car-showcase-quick-body">
                                        <span class="car-detail-section-label">{{ $insight['label'] }}</span>
                                        <h3>{{ $insight['title'] }}</h3>
                                        <p>{{ Str::limit(str_replace("\n", ' ', $insight['description']), 120) }}</p>
                                        <span class="car-showcase-quick-open">
                                            Explore <i class="fa-solid fa-arrow-up-right"></i>
                                        </span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @if ($interiorSection)
                <section class="car-showcase-section car-showcase-mini-section car-showcase-insight-detail" id="interior">
                    <div class="container">
                        <div class="car-showcase-insight-header">
                            <span class="car-detail-section-label">INTERIOR</span>
                            <h2>{{ $interiorSection['title'] }}</h2>
                        </div>

                        <div class="car-showcase-insight-layout">
                            <div class="car-showcase-insight-copy">
                                @foreach ($interiorSection['paragraphs'] ?? [] as $paragraph)
                                    <p>{{ $paragraph }}</p>
                                @endforeach
                            </div>

                            <button type="button"
                                class="car-showcase-insight-image js-lightbox-trigger"
                                data-lightbox-src="{{ $interiorSection['detail_image'] ?? ($gallery->get(2) ?? $gallery->first()) }}"
                                data-lightbox-caption="{{ $vehicle->name }} — interior">
                                <img src="{{ $interiorSection['detail_image'] ?? ($gallery->get(2) ?? $gallery->first()) }}"
                                    alt="{{ $vehicle->name }} interior" loading="lazy">
                                <span><i class="fa-solid fa-expand"></i> View full image</span>
                            </button>
                        </div>

                        @if (!empty($interiorSection['specs']))
                            <div class="car-showcase-bottom-specs">
                                @foreach ($interiorSection['specs'] as $spec)
                                    <div><span>{{ $spec['label'] }}</span><strong>{{ $spec['value'] }}</strong></div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>
            @endif

            @if ($chassisSection || $handlingSection)
                <section class="car-showcase-section car-showcase-mini-section car-showcase-insight-detail" id="chassis">
                    <div class="container">
                        <div class="car-showcase-insight-header">
                            <span class="car-detail-section-label">CHASSIS & HANDLING</span>
                            <h2>{{ $chassisSection['title'] ?? $handlingSection['title'] ?? 'Chassis & Handling' }}</h2>
                        </div>

                        <div class="car-showcase-insight-layout">
                            <div class="car-showcase-insight-copy">
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

                            <button type="button"
                                class="car-showcase-insight-image js-lightbox-trigger"
                                data-lightbox-src="{{ $chassisSection['detail_image'] ?? ($gallery->get(3) ?? $gallery->first()) }}"
                                data-lightbox-caption="{{ $vehicle->name }} — chassis">
                                <img src="{{ $chassisSection['detail_image'] ?? ($gallery->get(3) ?? $gallery->first()) }}"
                                    alt="{{ $vehicle->name }} chassis and handling" loading="lazy">
                                <span><i class="fa-solid fa-expand"></i> View full image</span>
                            </button>
                        </div>

                        @if (!empty($chassisSection['specs']) || !empty($handlingSection['specs']))
                            <div class="car-showcase-bottom-specs">
                                @foreach (collect($chassisSection['specs'] ?? [])->merge($handlingSection['specs'] ?? []) as $spec)
                                    <div><span>{{ $spec['label'] }}</span><strong>{{ $spec['value'] }}</strong></div>
                                @endforeach
                            </div>
                        @endif
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
                            <button type="button" class="car-gallery-card js-lightbox-trigger {{ $index === 0 ? 'is-large' : '' }}"
                                data-lightbox-src="{{ str_starts_with($image, 'http') ? $image : asset($image) }}"
                                data-lightbox-caption="{{ $vehicle->name }} — gallery {{ $index + 1 }}">
                                <img src="{{ str_starts_with($image, 'http') ? $image : asset($image) }}"
                                    alt="{{ $vehicle->name }} gallery image {{ $index + 1 }}"
                                    loading="lazy">
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
            <div class="car-lightbox" id="carLightbox" aria-hidden="true">
                <div class="car-lightbox-backdrop" data-lightbox-close></div>
                <div class="car-lightbox-dialog" role="dialog" aria-modal="true" aria-label="Vehicle image viewer">
                    <button type="button" class="car-lightbox-close" data-lightbox-close aria-label="Close image viewer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <button type="button" class="car-lightbox-prev" data-lightbox-prev aria-label="Previous image">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <figure class="car-lightbox-figure">
                        <img id="carLightboxImage" src="" alt="">
                        <figcaption id="carLightboxCaption"></figcaption>
                    </figure>
                    <button type="button" class="car-lightbox-next" data-lightbox-next aria-label="Next image">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                    <div class="car-lightbox-counter" id="carLightboxCounter">1 / 1</div>
                    <div class="car-lightbox-thumbs" id="carLightboxThumbs"></div>
                </div>
            </div>
            <div class="car-detail-insight-modal" id="carInsightModal" aria-hidden="true">
                <div class="car-detail-insight-modal-backdrop" data-insight-close></div>
                <div class="car-detail-insight-dialog" role="dialog" aria-modal="true" aria-label="Vehicle detail insight">
                    <button type="button" class="car-detail-insight-close" data-insight-close aria-label="Close detail"><i class="fa-solid fa-xmark"></i></button>
                    <button type="button" class="car-detail-insight-prev" data-insight-prev aria-label="Previous detail"><i class="fa-solid fa-chevron-left"></i></button>
                    <button type="button" class="car-detail-insight-next" data-insight-next aria-label="Next detail"><i class="fa-solid fa-chevron-right"></i></button>
                    <div class="car-detail-insight-layout-modal">
                        <div class="car-detail-insight-visual"><img id="carInsightImage" src="" alt=""></div>
                        <div class="car-detail-insight-content">
                            <span class="car-detail-section-label" id="carInsightLabel">DETAIL</span>
                            <h2 id="carInsightTitle"></h2>
                            <p id="carInsightDescription"></p>
                            <div class="car-detail-insight-specs" id="carInsightSpecs"></div>
                            <div class="car-detail-insight-nav">
                                <span>Insight <strong id="carInsightCounter">1 / 4</strong></span>
                                <span>Use arrows to explore</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/car.js') }}?v=20260929-1"></script>
@endpush