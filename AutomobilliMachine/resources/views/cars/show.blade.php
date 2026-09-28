@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('title', $vehicle->name . ' - AutomobilliMachine')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/car.css') }}?v=20260928-6">
@endpush

@section('content')
    <div class="car-detail-page">
        @include('partials.navbar')

        <main>
            @php
                $galleryImages = collect($vehicle->gallery_images ?? [])
                    ->filter()
                    ->values();

                $detailSections = collect($vehicle->detail_sections ?? []);
                $performanceSection = $detailSections->firstWhere('label', 'PERFORMANCE');
                $designSection = $detailSections->firstWhere('label', 'DESIGN');
                $powertrainSection = $detailSections->firstWhere('label', 'POWERTRAIN');
                $otherSections = $detailSections->reject(function ($section) {
                    return in_array($section['label'] ?? '', ['DESIGN', 'POWERTRAIN', 'PERFORMANCE']);
                })->values();

                $performanceSpecs = collect($performanceSection['specs'] ?? []);
                $zeroTo200 = $performanceSpecs->firstWhere('label', '0–200 km/h');
                $fioranoLap = $performanceSpecs->firstWhere('label', 'Fiorano Lap');
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
                        <a href="{{ route('brands.show', $brand) }}" aria-label="Back to brand">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </header>

            <section class="car-showcase-hero">
                <div class="car-showcase-hero-media">
                    @if ($vehicle->image_path)
                        <img src="{{ str_starts_with($vehicle->image_path, 'http') ? $vehicle->image_path : asset($vehicle->image_path) }}"
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

                        <span class="car-detail-section-label">
                            {{ $brand->name }} · {{ $vehicle->category?->name ?: 'Model' }}
                        </span>

                        <h1>{{ $vehicle->name }}</h1>

                        <div class="car-showcase-badges">
                            @foreach ([$vehicle->production_type, $vehicle->vehicle_type] as $badge)
                                @if ($badge)
                                    <span>{{ $badge }}</span>
                                @endif
                            @endforeach

                            @if ($vehicle->is_limited)
                                <span>Limited</span>
                            @endif

                            @if ($vehicle->is_one_off)
                                <span>One-Off</span>
                            @endif

                            @if ($vehicle->is_track_only)
                                <span>Track Only</span>
                            @endif

                            @if ($vehicle->is_racing)
                                <span>Racing</span>
                            @endif
                        </div>

                        <p>{{ $vehicle->description ?: ($vehicle->short_description ?: 'Detailed information for this model is being added to the catalog.') }}</p>

                        <div class="car-showcase-actions">
                            <button
                                type="button"
                                class="car-detail-save js-car-favorite {{ $isFavorited ? 'is-active' : '' }}"
                                data-car-id="{{ $vehicle->id }}"
                                data-car-name="{{ $vehicle->name }}"
                                aria-pressed="{{ $isFavorited ? 'true' : 'false' }}"
                            >
                                <i class="{{ $isFavorited ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                <span>Favorite</span>
                            </button>

                            <button
                                type="button"
                                class="car-detail-save js-car-wishlist {{ $isWishlisted ? 'is-active' : '' }}"
                                data-car-id="{{ $vehicle->id }}"
                                data-car-name="{{ $vehicle->name }}"
                                aria-pressed="{{ $isWishlisted ? 'true' : 'false' }}"
                            >
                                <i class="{{ $isWishlisted ? 'fa-solid' : 'fa-regular' }} fa-bookmark"></i>
                                <span>Wishlist</span>
                            </button>
                        </div>
                    </div>

                    <div class="car-showcase-performance">
                        <article>
                            <strong>{{ $vehicle->horsepower !== null ? number_format($vehicle->horsepower) : '—' }}</strong>
                            <span>HP</span>
                            <small>Max power</small>
                        </article>
                        <article>
                            <strong>{{ $vehicle->top_speed_kmh !== null ? number_format($vehicle->top_speed_kmh) : '—' }}</strong>
                            <span>km/h</span>
                            <small>Top speed</small>
                        </article>
                        <article>
                            <strong>{{ $vehicle->acceleration_0_100 !== null ? number_format((float) $vehicle->acceleration_0_100, 2) : '—' }}</strong>
                            <span>s</span>
                            <small>0–100 km/h</small>
                        </article>
                    </div>

                    <div class="car-showcase-test-status {{ $vehicle->stats_tested ? 'is-tested' : '' }}">
                        <span class="car-status-dot"></span>
                        <strong>{{ $vehicle->stats_tested ? 'Tested' : 'Not Tested' }}</strong>
                        <small>{{ $vehicle->stats_tested ? 'Verified performance data' : 'Manufacturer specification / calculation data' }}</small>
                    </div>

                    @if ($galleryImages->isNotEmpty())
                        <div class="car-showcase-gallery">
                            <img src="{{ str_starts_with($vehicle->image_path, 'http') ? $vehicle->image_path : asset($vehicle->image_path) }}"
                                alt="{{ $vehicle->name }}">
                            @foreach ($galleryImages as $image)
                                <img src="{{ str_starts_with($image, 'http') ? $image : asset($image) }}"
                                    alt="{{ $vehicle->name }} gallery image">
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>

            <nav class="car-showcase-nav" aria-label="Vehicle sections">
                <div class="container">
                    <div class="car-showcase-nav-scroll">
                        <a href="#overview">Overview</a>
                        @if ($designSection)
                            <a href="#design">Design</a>
                        @endif
                        @if ($powertrainSection)
                            <a href="#powertrain">Powertrain</a>
                        @endif
                        <a href="#performance">Performance</a>
                        <a href="#technical">Specifications</a>
                        @if ($otherSections->contains(fn ($section) => ($section['label'] ?? '') === 'INTERIOR'))
                            <a href="#interior">Interior</a>
                        @endif
                        @if ($otherSections->contains(fn ($section) => in_array(($section['label'] ?? ''), ['HANDLING', 'CHASSIS'])))
                            <a href="#chassis">Chassis</a>
                        @endif
                        <a href="#production">Production</a>
                        @if (!empty($vehicle->variants))
                            <a href="#variants">Variants</a>
                        @endif
                    </div>
                </div>
            </nav>

            <section class="car-showcase-section car-showcase-overview" id="overview">
                <div class="container car-showcase-split">
                    <div class="car-showcase-text">
                        <span class="car-detail-section-label">OVERVIEW</span>
                        <h2>A closer look at the {{ $vehicle->name }}</h2>
                        <p>{{ $vehicle->description ?: ($vehicle->short_description ?: 'No extended description has been added yet.') }}</p>
                    </div>

                    <div class="car-showcase-visual">
                        @if ($vehicle->image_path)
                            <img src="{{ str_starts_with($vehicle->image_path, 'http') ? $vehicle->image_path : asset($vehicle->image_path) }}"
                                alt="{{ $vehicle->name }}">
                        @endif
                        <div class="car-showcase-visual-caption">
                            <span>{{ $brand->name }}</span>
                            <strong>{{ $vehicle->production_year_start ?: '—' }}{{ $vehicle->production_year_end ? ' – ' . $vehicle->production_year_end : ($vehicle->production_year_start ? ' – Present' : '') }}</strong>
                        </div>
                    </div>
                </div>
            </section>

            @if ($designSection)
                <section class="car-showcase-section car-showcase-feature" id="design">
                    <div class="container car-showcase-feature-grid">
                        <div class="car-showcase-feature-copy">
                            <span class="car-detail-section-label">{{ $designSection['label'] }}</span>
                            <h2>{{ $designSection['title'] ?? 'Design' }}</h2>

                            @foreach ($designSection['paragraphs'] ?? [] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach

                            @if (!empty($designSection['items']))
                                <ul class="car-showcase-points">
                                    @foreach ($designSection['items'] as $item)
                                        <li><i class="fa-solid fa-arrow-right"></i><span>{{ $item }}</span></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="car-showcase-feature-media">
                            @if ($vehicle->image_path)
                                <img src="{{ str_starts_with($vehicle->image_path, 'http') ? $vehicle->image_path : asset($vehicle->image_path) }}"
                                    alt="{{ $vehicle->name }} design">
                            @endif
                            <div class="car-showcase-media-chip">DESIGN</div>
                        </div>
                    </div>
                </section>
            @endif

            @if ($powertrainSection)
                <section class="car-showcase-section car-showcase-dark-feature" id="powertrain">
                    <div class="container car-showcase-powertrain-grid">
                        <div class="car-showcase-feature-copy">
                            <span class="car-detail-section-label">{{ $powertrainSection['label'] }}</span>
                            <h2>{{ $powertrainSection['title'] ?? 'Powertrain' }}</h2>

                            @foreach ($powertrainSection['paragraphs'] ?? [] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach

                            @if (!empty($powertrainSection['items']))
                                <ul class="car-showcase-points">
                                    @foreach ($powertrainSection['items'] as $item)
                                        <li><i class="fa-solid fa-arrow-right"></i><span>{{ $item }}</span></li>
                                    @endforeach
                                </ul>
                            @endif
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
                </section>
            @endif

            <section class="car-showcase-section car-showcase-performance-section" id="performance">
                <div class="container">
                    <div class="car-showcase-heading-row">
                        <div>
                            <span class="car-detail-section-label">PERFORMANCE</span>
                            <h2>Extraordinary numbers</h2>
                            <p>
                                {{ $performanceSection['paragraphs'][0] ?? 'Key performance specifications recorded for this model.' }}
                            </p>
                        </div>

                        <div class="car-showcase-performance-state {{ $vehicle->stats_tested ? 'is-tested' : '' }}">
                            <span class="car-status-dot"></span>
                            <strong>{{ $vehicle->stats_tested ? 'Tested' : 'Not Tested' }}</strong>
                        </div>
                    </div>

                    <div class="car-showcase-metrics">
                        <article>
                            <span>0–100 km/h</span>
                            <strong>{{ $vehicle->acceleration_0_100 !== null ? number_format((float) $vehicle->acceleration_0_100, 2) : '—' }}</strong>
                            <small>seconds</small>
                        </article>

                        <article>
                            <span>0–200 km/h</span>
                            <strong>{{ $zeroTo200['value'] ?? '—' }}</strong>
                            <small>factory figure</small>
                        </article>

                        <article>
                            <span>Top Speed</span>
                            <strong>{{ $vehicle->top_speed_kmh !== null ? number_format($vehicle->top_speed_kmh) : '—' }}</strong>
                            <small>km/h</small>
                        </article>

                        <article>
                            <span>Fiorano Lap</span>
                            <strong>{{ $fioranoLap['value'] ?? '—' }}</strong>
                            <small>recorded figure</small>
                        </article>
                    </div>

                    @if ($performanceSpecs->isNotEmpty())
                        <div class="car-showcase-inline-specs">
                            @foreach ($performanceSpecs->take(6) as $spec)
                                <div>
                                    <span>{{ $spec['label'] ?? 'Specification' }}</span>
                                    <strong>{{ $spec['value'] ?? '—' }}</strong>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>

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
                        <div><span>Body Style</span><strong>{{ $vehicle->body_type ?: '—' }}</strong></div>
                        <div><span>Fuel Type</span><strong>{{ $vehicle->fuel_type ?: '—' }}</strong></div>
                        <div><span>Production</span><strong>{{ $vehicle->production_year_start ?: '—' }}{{ $vehicle->production_year_end ? ' – ' . $vehicle->production_year_end : ($vehicle->production_year_start ? ' – Present' : '') }}</strong></div>
                    </div>
                </div>
            </section>

            @foreach ($otherSections as $section)
                @php
                    $label = strtoupper($section['label'] ?? '');
                    $sectionId = match ($label) {
                        'INTERIOR' => 'interior',
                        'HANDLING', 'CHASSIS', 'DIMENSIONS', 'TRANSMISSION', 'DRIVING' => 'chassis',
                        default => 'detail-' . $loop->index,
                    };
                    $sectionIcon = match ($label) {
                        'INTERIOR' => 'fa-gauge-high',
                        'HANDLING', 'CHASSIS' => 'fa-road',
                        'DIMENSIONS' => 'fa-ruler-combined',
                        'TRANSMISSION' => 'fa-gears',
                        'DRIVING' => 'fa-bolt',
                        default => 'fa-circle-info',
                    };
                @endphp

                <section class="car-showcase-section car-showcase-mini-section" id="{{ $sectionId }}">
                    <div class="container car-showcase-mini-grid">
                        <div>
                            <span class="car-showcase-mini-icon"><i class="fa-solid {{ $sectionIcon }}"></i></span>
                            <span class="car-detail-section-label">{{ $section['label'] ?? 'DETAIL' }}</span>
                            <h2>{{ $section['title'] ?? 'Vehicle details' }}</h2>

                            @foreach ($section['paragraphs'] ?? [] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach

                            @if (!empty($section['items']))
                                <ul class="car-showcase-points">
                                    @foreach ($section['items'] as $item)
                                        <li><i class="fa-solid fa-arrow-right"></i><span>{{ $item }}</span></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        @if (!empty($section['specs']))
                            <div class="car-showcase-side-specs">
                                @foreach ($section['specs'] as $spec)
                                    <div>
                                        <span>{{ $spec['label'] ?? 'Specification' }}</span>
                                        <strong>{{ $spec['value'] ?? '—' }}</strong>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>
            @endforeach

            <section class="car-showcase-section car-showcase-production" id="production">
                <div class="container car-showcase-production-grid">
                    <div>
                        <span class="car-detail-section-label">PRODUCTION</span>
                        <h2>Model identity</h2>
                        <p>
                            Production information separates the model's history, road-car status, and catalog classification.
                        </p>
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
                                    @if (!empty($variant['years']))
                                        <small>{{ $variant['years'] }}</small>
                                    @endif
                                    @if (!empty($variant['description']))
                                        <p>{{ $variant['description'] }}</p>
                                    @endif
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

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

            @if ($relatedCars->isNotEmpty())
                <section class="car-showcase-section car-related-section">
                    <div class="container">
                        <span class="car-detail-section-label">EXPLORE MORE</span>
                        <h2>More {{ $brand->name }} models</h2>

                        <div class="car-related-grid">
                            @foreach ($relatedCars as $related)
                                <a href="{{ route('cars.show', ['brand' => $brand->slug, 'car' => $related->slug]) }}" class="car-related-card">
                                    <div class="car-related-media">
                                        @if ($related->image_path)
                                            <img src="{{ str_starts_with($related->image_path, 'http') ? $related->image_path : asset($related->image_path) }}"
                                                alt="{{ $related->name }}" loading="lazy">
                                        @else
                                            <div class="car-detail-placeholder"><i class="fa-solid fa-car-side"></i></div>
                                        @endif
                                    </div>
                                    <div class="car-related-body">
                                        <span>{{ $related->category?->name ?: 'Model' }}</span>
                                        <h3>{{ $related->name }}</h3>
                                        <small>{{ $related->production_year_start ?: '—' }}{{ $related->production_year_end ? ' – ' . $related->production_year_end : ($related->production_year_start ? ' – Present' : '') }}</small>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        </main>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/car.js') }}?v=20260928-1"></script>
@endpush