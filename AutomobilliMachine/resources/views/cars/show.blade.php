@extends('layouts.app')

@section('title', $vehicle->name . ' - AutomobilliMachine')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/car.css') }}?v=20260928-4">
@endpush

@section('content')
<div class="car-detail-page">
    @include('partials.navbar')

    <main>
        <section class="car-editorial-hero">
            <div class="car-editorial-hero-bg">
                @if ($vehicle->image_path)
                    <img
                        src="{{ str_starts_with($vehicle->image_path, 'http') ? $vehicle->image_path : asset($vehicle->image_path) }}"
                        alt="{{ $vehicle->name }}"
                    >
                @endif
            </div>

            <div class="car-editorial-hero-overlay"></div>

            <div class="container car-editorial-hero-inner">
                <div class="car-editorial-hero-copy">
                    <a class="car-detail-back" href="{{ route('brands.show', $brand) }}">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to {{ $brand->name }}
                    </a>

                    <span class="car-detail-section-label">
                        {{ $brand->name }} · {{ $vehicle->category?->name ?: 'Model' }}
                    </span>

                    <h1>{{ $vehicle->name }}</h1>

                    <div class="car-editorial-badges">
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

                    <p class="car-editorial-lead">
                        {{ $vehicle->description ?: ($vehicle->short_description ?: 'Detailed information for this model is being added to the catalog.') }}
                    </p>

                    <div class="car-editorial-actions">
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

                <div class="car-editorial-hero-stats">
                    <article>
                        <strong>{{ $vehicle->horsepower !== null ? number_format($vehicle->horsepower) : '—' }}</strong>
                        <span>HP</span>
                        <small>Maximum power</small>
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

                <div class="car-editorial-status {{ $vehicle->stats_tested ? 'is-tested' : 'is-not-tested' }}">
                    <span class="car-status-dot"></span>
                    <strong>{{ $vehicle->stats_tested ? 'Tested' : 'Not Tested' }}</strong>
                    <small>{{ $vehicle->stats_tested ? 'Verified performance data' : 'Manufacturer specification / calculation data' }}</small>
                </div>
            </div>
        </section>

        @php
            $detailLabels = collect($vehicle->detail_sections ?? [])
                ->pluck('label')
                ->filter()
                ->values();
        @endphp

        <nav class="car-editorial-nav" aria-label="Vehicle sections">
            <div class="container">
                <div class="car-editorial-nav-scroll">
                    <a href="#overview">Overview</a>
                    @foreach ($detailLabels as $label)
                        <a href="#section-{{ \\Illuminate\\Support\\Str::slug($label) }}">{{ \\Illuminate\\Support\\Str::title(strtolower($label)) }}</a>
                    @endforeach
                    <a href="#technical">Specifications</a>
                    @if (!empty($vehicle->variants))
                        <a href="#variants">Variants</a>
                    @endif
                    @if (!empty($vehicle->source_links))
                        <a href="#sources">Sources</a>
                    @endif
                </div>
            </div>
        </nav>

        <section class="car-editorial-section car-editorial-overview" id="overview">
            <div class="container car-editorial-overview-grid">
                <div>
                    <span class="car-detail-section-label">OVERVIEW</span>
                    <h2>{{ $vehicle->name }} in focus</h2>
                    <p>
                        {{ $vehicle->description ?: ($vehicle->short_description ?: 'No extended description has been added yet.') }}
                    </p>
                </div>

                <div class="car-editorial-overview-facts">
                    <div>
                        <span>Production</span>
                        <strong>{{ $vehicle->production_year_start ?: '—' }}{{ $vehicle->production_year_end ? ' – ' . $vehicle->production_year_end : ($vehicle->production_year_start ? ' – Present' : '') }}</strong>
                    </div>
                    <div>
                        <span>Drivetrain</span>
                        <strong>{{ $vehicle->drivetrain ?: '—' }}</strong>
                    </div>
                    <div>
                        <span>Transmission</span>
                        <strong>{{ $vehicle->transmission ?: '—' }}</strong>
                    </div>
                    <div>
                        <span>Fuel Type</span>
                        <strong>{{ $vehicle->fuel_type ?: '—' }}</strong>
                    </div>
                </div>
            </div>
        </section>

        @if (!empty($vehicle->detail_sections))
            @foreach ($vehicle->detail_sections as $index => $section)
                @php
                    $sectionId = \\Illuminate\\Support\\Str::slug($section['label'] ?? $section['title'] ?? ('section-' . $index));
                    $isFeature = in_array(($section['label'] ?? ''), ['DESIGN', 'POWERTRAIN', 'PERFORMANCE']);
                @endphp

                <section
                    id="section-{{ $sectionId }}"
                    class="car-editorial-section car-editorial-detail {{ $isFeature ? 'is-feature' : '' }} {{ $index % 2 ? 'is-reverse' : '' }}"
                >
                    <div class="container">
                        <div class="car-editorial-detail-grid">
                            <div class="car-editorial-detail-copy">
                                <span class="car-detail-section-label">{{ $section['label'] ?? 'DETAIL' }}</span>
                                <h2>{{ $section['title'] ?? 'Vehicle details' }}</h2>

                                @if (!empty($section['paragraphs']))
                                    @foreach ($section['paragraphs'] as $paragraph)
                                        <p>{{ $paragraph }}</p>
                                    @endforeach
                                @endif

                                @if (!empty($section['items']))
                                    <ul class="car-editorial-points">
                                        @foreach ($section['items'] as $item)
                                            <li>
                                                <i class="fa-solid fa-arrow-right"></i>
                                                <span>{{ $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div class="car-editorial-detail-panel">
                                @if (!empty($section['specs']))
                                    <dl class="car-editorial-specs">
                                        @foreach ($section['specs'] as $spec)
                                            <div>
                                                <dt>{{ $spec['label'] ?? 'Specification' }}</dt>
                                                <dd>{{ $spec['value'] ?? '—' }}</dd>
                                            </div>
                                        @endforeach
                                    </dl>
                                @else
                                    <div class="car-editorial-placeholder">
                                        <span>{{ $vehicle->name }}</span>
                                        <strong>{{ $section['label'] ?? 'DETAIL' }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        @endif

        <section class="car-editorial-section car-editorial-technical" id="technical">
            <div class="container">
                <div class="car-editorial-section-heading">
                    <span class="car-detail-section-label">KEY SPECIFICATIONS</span>
                    <h2>The numbers behind the {{ $vehicle->name }}</h2>
                </div>

                <div class="car-editorial-spec-grid">
                    <div><span>Engine</span><strong>{{ $vehicle->engine ?: '—' }}</strong></div>
                    <div><span>Horsepower</span><strong>{{ $vehicle->horsepower !== null ? number_format($vehicle->horsepower) . ' HP' : '—' }}</strong></div>
                    <div><span>Torque</span><strong>{{ $vehicle->torque_nm !== null ? number_format($vehicle->torque_nm) . ' Nm' : '—' }}</strong></div>
                    <div><span>0–100 km/h</span><strong>{{ $vehicle->acceleration_0_100 !== null ? number_format((float) $vehicle->acceleration_0_100, 2) . ' s' : '—' }}</strong></div>
                    <div><span>Top Speed</span><strong>{{ $vehicle->top_speed_kmh !== null ? number_format($vehicle->top_speed_kmh) . ' km/h' : '—' }}</strong></div>
                    <div><span>Drivetrain</span><strong>{{ $vehicle->drivetrain ?: '—' }}</strong></div>
                    <div><span>Transmission</span><strong>{{ $vehicle->transmission ?: '—' }}</strong></div>
                    <div><span>Body Style</span><strong>{{ $vehicle->body_type ?: '—' }}</strong></div>
                </div>

                <div class="car-editorial-production">
                    <div class="car-editorial-production-copy">
                        <span class="car-detail-section-label">PRODUCTION</span>
                        <h3>Model identity</h3>
                    </div>

                    <dl class="car-editorial-production-list">
                        <div><dt>Model Family</dt><dd>{{ $vehicle->model_family ?: '—' }}</dd></div>
                        <div><dt>Generation</dt><dd>{{ $vehicle->generation ?: '—' }}</dd></div>
                        <div><dt>Variant</dt><dd>{{ $vehicle->variant ?: '—' }}</dd></div>
                        <div><dt>Production Type</dt><dd>{{ $vehicle->production_type ?: '—' }}</dd></div>
                        <div><dt>Vehicle Type</dt><dd>{{ $vehicle->vehicle_type ?: '—' }}</dd></div>
                        <div><dt>Production Count</dt><dd>{{ $vehicle->production_count !== null ? number_format($vehicle->production_count) . ' units' : 'Not specified' }}</dd></div>
                    </dl>
                </div>
            </div>
        </section>

        @if (!empty($vehicle->variants))
            <section class="car-editorial-section car-editorial-variants" id="variants">
                <div class="container">
                    <div class="car-editorial-section-heading">
                        <span class="car-detail-section-label">VARIANTS</span>
                        <h2>Versions & related derivatives</h2>
                    </div>

                    <div class="car-variants-grid">
                        @foreach ($vehicle->variants as $variant)
                            <article class="car-variant-card">
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
            <section class="car-editorial-section car-editorial-sources" id="sources">
                <div class="container">
                    <div class="car-editorial-section-heading">
                        <span class="car-detail-section-label">SOURCES</span>
                        <h2>Reference material</h2>
                    </div>

                    <div class="car-sources-list">
                        @foreach ($vehicle->source_links as $source)
                            <a
                                href="{{ $source['url'] ?? '#' }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="car-source-link"
                            >
                                <span>{{ $source['label'] ?? 'Source' }}</span>
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($relatedCars->isNotEmpty())
            <section class="car-editorial-section car-related-section">
                <div class="container">
                    <div class="car-editorial-section-heading">
                        <span class="car-detail-section-label">EXPLORE MORE</span>
                        <h2>More {{ $brand->name }} models</h2>
                    </div>

                    <div class="car-related-grid">
                        @foreach ($relatedCars as $related)
                            <a href="{{ route('cars.show', ['brand' => $brand->slug, 'car' => $related->slug]) }}" class="car-related-card">
                                <div class="car-related-media">
                                    @if ($related->image_path)
                                        <img
                                            src="{{ str_starts_with($related->image_path, 'http') ? $related->image_path : asset($related->image_path) }}"
                                            alt="{{ $related->name }}"
                                            loading="lazy"
                                        >
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
