@extends('layouts.app')

@section('title', $vehicle->name . ' - AutomobilliMachine')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/car.css') }}?v=20260928-1">
@endpush

@section('content')
<div class="car-detail-page">
    @include('partials.navbar')

    <main>
        <section class="car-detail-hero">
            <div class="container car-detail-hero-grid">
                <div class="car-detail-visual">
                    <div class="car-detail-image-frame">
                        @if ($vehicle->image_path)
                            <img
                                src="{{ str_starts_with($vehicle->image_path, 'http') ? $vehicle->image_path : asset($vehicle->image_path) }}"
                                alt="{{ $vehicle->name }}"
                            >
                        @else
                            <div class="car-detail-placeholder">
                                <i class="fa-solid fa-car-side"></i>
                                <span>Image not available</span>
                            </div>
                        @endif

                        @if ($vehicle->is_iconic)
                            <span class="car-detail-image-badge">Iconic</span>
                        @endif
                    </div>
                </div>

                <div class="car-detail-intro">
                    <a class="car-detail-back" href="{{ route('brands.show', $brand) }}">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to {{ $brand->name }}
                    </a>

                    <div class="car-detail-kicker">
                        {{ $vehicle->category?->name ?: 'Model' }}
                    </div>

                    <h1>{{ $vehicle->name }}</h1>

                    <div class="car-detail-badges">
                        @if ($vehicle->production_type)
                            <span>{{ $vehicle->production_type }}</span>
                        @endif
                        @if ($vehicle->vehicle_type)
                            <span>{{ $vehicle->vehicle_type }}</span>
                        @endif
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

                    <p class="car-detail-lead">
                        {{ $vehicle->description ?: ($vehicle->short_description ?: 'Detailed information for this model is being added to the catalog.') }}
                    </p>

                    <div class="car-detail-actions">
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
            </div>
        </section>

        <section class="car-detail-stats-section">
            <div class="container">
                <div class="car-detail-stats">
                    <article>
                        <span>Horsepower</span>
                        <strong>{{ $vehicle->horsepower !== null ? number_format($vehicle->horsepower) : '—' }}</strong>
                        <small>HP</small>
                    </article>
                    <article>
                        <span>Top Speed</span>
                        <strong>{{ $vehicle->top_speed_kmh !== null ? number_format($vehicle->top_speed_kmh) : '—' }}</strong>
                        <small>km/h</small>
                    </article>
                    <article>
                        <span>0–100 km/h</span>
                        <strong>{{ $vehicle->acceleration_0_100 !== null ? number_format((float) $vehicle->acceleration_0_100, 2) : '—' }}</strong>
                        <small>seconds</small>
                    </article>
                    <article class="car-detail-test-status {{ $vehicle->stats_tested ? 'is-tested' : 'is-not-tested' }}">
                        <span>Performance Status</span>
                        <strong>{{ $vehicle->stats_tested ? 'Tested' : 'Not Tested' }}</strong>
                        <small>{{ $vehicle->stats_tested ? 'Verified test data' : 'Specification / calculation data' }}</small>
                    </article>
                </div>
            </div>
        </section>

        <section class="car-detail-content">
            <div class="container car-detail-content-grid">
                <div>
                    <span class="car-detail-section-label">MODEL OVERVIEW</span>
                    <h2>About {{ $vehicle->name }}</h2>
                    <p class="car-detail-body-copy">
                        {{ $vehicle->description ?: ($vehicle->short_description ?: 'No extended description has been added yet.') }}
                    </p>

                    <div class="car-detail-panel">
                        <div class="car-detail-panel-heading">
                            <span class="car-detail-section-label">TECHNICAL DATA</span>
                            <h3>Specifications</h3>
                        </div>

                        <dl class="car-spec-list">
                            <div><dt>Engine</dt><dd>{{ $vehicle->engine ?: 'Not specified' }}</dd></div>
                            <div><dt>Horsepower</dt><dd>{{ $vehicle->horsepower !== null ? number_format($vehicle->horsepower) . ' HP' : 'Not specified' }}</dd></div>
                            <div><dt>Torque</dt><dd>{{ $vehicle->torque_nm !== null ? number_format($vehicle->torque_nm) . ' Nm' : 'Not specified' }}</dd></div>
                            <div><dt>0–100 km/h</dt><dd>{{ $vehicle->acceleration_0_100 !== null ? number_format((float) $vehicle->acceleration_0_100, 2) . ' s' : 'Not specified' }}</dd></div>
                            <div><dt>Top Speed</dt><dd>{{ $vehicle->top_speed_kmh !== null ? number_format($vehicle->top_speed_kmh) . ' km/h' : 'Not specified' }}</dd></div>
                            <div><dt>Drivetrain</dt><dd>{{ $vehicle->drivetrain ?: 'Not specified' }}</dd></div>
                            <div><dt>Transmission</dt><dd>{{ $vehicle->transmission ?: 'Not specified' }}</dd></div>
                            <div><dt>Fuel Type</dt><dd>{{ $vehicle->fuel_type ?: 'Not specified' }}</dd></div>
                            <div><dt>Body Style</dt><dd>{{ $vehicle->body_type ?: 'Not specified' }}</dd></div>
                        </dl>
                    </div>
                </div>

                <aside class="car-detail-side">
                    <div class="car-detail-panel">
                        <div class="car-detail-panel-heading">
                            <span class="car-detail-section-label">PRODUCTION</span>
                            <h3>Model Identity</h3>
                        </div>

                        <dl class="car-spec-list compact">
                            <div><dt>Model Family</dt><dd>{{ $vehicle->model_family ?: '—' }}</dd></div>
                            <div><dt>Generation</dt><dd>{{ $vehicle->generation ?: '—' }}</dd></div>
                            <div><dt>Variant</dt><dd>{{ $vehicle->variant ?: '—' }}</dd></div>
                            <div><dt>Production Years</dt><dd>{{ $vehicle->production_year_start ?: '—' }}{{ $vehicle->production_year_end ? ' – ' . $vehicle->production_year_end : ($vehicle->production_year_start ? ' – Present' : '') }}</dd></div>
                            <div><dt>Production Type</dt><dd>{{ $vehicle->production_type ?: '—' }}</dd></div>
                            <div><dt>Vehicle Type</dt><dd>{{ $vehicle->vehicle_type ?: '—' }}</dd></div>
                            <div><dt>Production Count</dt><dd>{{ $vehicle->production_count !== null ? number_format($vehicle->production_count) . ' units' : 'Not specified' }}</dd></div>
                            <div><dt>Base Model</dt><dd>{{ $vehicle->base_model ?: '—' }}</dd></div>
                            <div><dt>Road Legal</dt><dd>{{ $vehicle->road_legal ? 'Yes' : 'No' }}</dd></div>
                            <div><dt>Publicly Sold</dt><dd>{{ $vehicle->publicly_sold ? 'Yes' : 'No' }}</dd></div>
                        </dl>
                    </div>

                    <div class="car-detail-note">
                        <i class="fa-solid fa-circle-info"></i>
                        <p>Performance numbers are marked <strong>Tested</strong> only when verified test data has been recorded in the catalog.</p>
                    </div>
                </aside>
            </div>
        </section>

        @if ($relatedCars->isNotEmpty())
            <section class="car-related-section">
                <div class="container">
                    <div class="car-detail-section-heading">
                        <span class="car-detail-section-label">EXPLORE MORE</span>
                        <h2>More {{ $brand->name }} Models</h2>
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
