@extends('layouts.app')

@section('title', $brand->name . ' - AutomobilliMachine')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/brand.css') }}?v=20260927-9">
@endpush

@section('content')
<div
    class="brand-page"
    data-brand-slug="{{ $brand->slug }}"
    data-cars-endpoint="{{ route('brands.cars', $brand) }}"
>
    <section class="brand-hero">
        <div class="brand-hero-overlay"></div>
        @if ($brand->hero_image_path)
            <img
                src="{{ str_starts_with($brand->hero_image_path, 'http') ? $brand->hero_image_path : asset($brand->hero_image_path) }}"
                alt="{{ $brand->name }}"
                class="brand-hero-image"
            >
        @endif

        <div class="container brand-hero-content">
            <div class="brand-hero-identity">
                @if ($brand->logo_path)
                    <div class="brand-hero-logo">
                        <img
                            src="{{ str_starts_with($brand->logo_path, 'http') ? $brand->logo_path : asset($brand->logo_path) }}"
                            alt="{{ $brand->name }} logo"
                            loading="eager"
                            decoding="async"
                        >
                    </div>
                @endif

                <div class="brand-hero-copy">
                    <span class="brand-kicker">BRAND PROFILE</span>
                    <h1>{{ $brand->name }}</h1>

                    @if ($brand->tagline)
                        <p>{{ $brand->tagline }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @include('partials.navbar')

    <main class="container brand-content">
        @if ($brand->history || !empty($brand->history_sections))
            <section class="brand-history-section">
                <div class="brand-history-content">
                    <span class="brand-section-label">HERITAGE</span>

                    @if ($brand->history)
                        <h2>The Story of {{ $brand->name }}</h2>
                        <p class="brand-history-lead">{{ $brand->history }}</p>
                    @endif

                    @if (!empty($brand->history_sections))
                        <div class="brand-history-narrative">
                            @foreach ($brand->history_sections as $index => $section)
                                <article class="brand-history-chapter {{ $index % 2 ? 'is-reversed' : '' }}">
                                    <div class="brand-history-media">
                                        @if (!empty($section['image']))
                                            <img
                                                src="{{ str_starts_with($section['image'], 'http') ? $section['image'] : asset($section['image']) }}"
                                                alt="{{ $section['image_alt'] ?? ($section['title'] ?? $brand->name) }}"
                                                loading="{{ $index > 1 ? 'lazy' : 'eager' }}"
                                                decoding="async"
                                            >
                                        @endif
                                    </div>

                                    <div class="brand-history-copy">
                                        <span class="brand-history-chapter-label">{{ $section['title'] ?? '' }}</span>
                                        <p>{{ $section['text'] ?? '' }}</p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif

                </div>

                <div class="brand-history-facts">
                    <article class="brand-fact-card">
                        <span>Founded</span>
                        <strong>
                            {{ $brand->founded_year ?: '—' }}
                            @if ($brand->founded_location)
                                • {{ $brand->founded_location }}
                            @endif
                        </strong>
                    </article>

                    <article class="brand-fact-card">
                        <span>Founder</span>
                        <strong>{{ $brand->founder ?: '—' }}</strong>
                    </article>

                    <article class="brand-fact-card">
                        <span>Country</span>
                        <strong>{{ $brand->country }}</strong>
                    </article>

                    <article class="brand-fact-card">
                        <span>Vehicle Lineup</span>
                        <strong>{{ $brand->vehicle_lineup ?: '—' }}</strong>
                    </article>
                </div>
            </section>
        @endif

        @if ($iconicCars->isNotEmpty())
            <section class="brand-iconic-section">
                <div class="brand-section-heading">
                    <div>
                        <span class="brand-section-label">ICONIC CARS</span>
                        <h2>Legendary Models</h2>
                        <p>Models that represent the character and heritage of {{ $brand->name }}.</p>
                    </div>

                </div>

                <div class="brand-iconic-grid">
                    @foreach ($iconicCars as $car)
                        <article class="brand-iconic-card">
                            @if ($car->image_path)
                                <img
                                    src="{{ asset($car->image_path) }}"
                                    alt="{{ $car->name }}"
                                    loading="lazy"
                                    decoding="async"
                                >
                            @else
                                <div class="brand-car-placeholder">
                                    <i class="fa-solid fa-car-side"></i>
                                </div>
                            @endif

                            <div class="brand-iconic-body">
                                <div class="brand-car-meta">
                                    <span>{{ $car->category?->name ?: 'Model' }}</span>
                                    <div class="brand-card-actions">
                                        <button
                                            type="button"
                                            class="brand-save-button js-favorite-button {{ in_array($car->id, $favoriteCarIds, true) ? 'is-active' : '' }}"
                                            data-car-id="{{ $car->id }}"
                                            aria-label="{{ in_array($car->id, $favoriteCarIds, true) ? 'Remove ' . $car->name . ' from favorites' : 'Add ' . $car->name . ' to favorites' }}"
                                            aria-pressed="{{ in_array($car->id, $favoriteCarIds, true) ? 'true' : 'false' }}"
                                            title="Favorite"
                                        >
                                            <i class="{{ in_array($car->id, $favoriteCarIds, true) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                        </button>
                                        <button
                                            type="button"
                                            class="brand-save-button js-wishlist-button {{ in_array($car->id, $wishlistCarIds, true) ? 'is-active' : '' }}"
                                            data-car-id="{{ $car->id }}"
                                            aria-label="{{ in_array($car->id, $wishlistCarIds, true) ? 'Remove ' . $car->name . ' from wishlist' : 'Add ' . $car->name . ' to wishlist' }}"
                                            aria-pressed="{{ in_array($car->id, $wishlistCarIds, true) ? 'true' : 'false' }}"
                                            title="Wishlist"
                                        >
                                            <i class="{{ in_array($car->id, $wishlistCarIds, true) ? 'fa-solid' : 'fa-regular' }} fa-bookmark"></i>
                                        </button>
                                        <span class="brand-card-arrow" aria-hidden="true">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>

                                <h3>{{ $car->name }}</h3>

                                @if ($car->production_year_start)
                                    <span class="brand-iconic-year">
                                        {{ $car->production_year_start }}{{ $car->production_year_end ? ' – ' . $car->production_year_end : ' – Present' }}
                                    </span>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="brand-models-section" id="models">
            <div class="brand-section-heading">
                <div>
                    <span class="brand-section-label">ALL {{ strtoupper($brand->name) }} MODELS</span>
                    <h2>{{ $brand->name }} Model Lineup</h2>
                    <p>Browse the {{ $brand->name }} catalog by year, category, production type, and specifications.</p>
                </div>
            </div>

            <div class="brand-model-toolbar">
                <div class="brand-model-search">
                    <label for="carSearch" class="visually-hidden">Search models</label>
                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                    <input id="carSearch" type="search" placeholder="Search models..." autocomplete="off">
                </div>

                <button
                    id="toggleAdvancedFilters"
                    class="brand-more-filters"
                    type="button"
                    aria-expanded="false"
                    aria-controls="advancedCarFilters"
                >
                    <i class="fa-solid fa-sliders" aria-hidden="true"></i>
                    <span>Filters</span>
                </button>
            </div>

            <div id="advancedCarFilters" class="brand-advanced-filters" hidden>
                <label class="brand-model-select">
                    <span class="visually-hidden">Year</span>
                    <select id="carYear">
                        <option value="">Year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="brand-model-select">
                    <span class="visually-hidden">Category</span>
                    <select id="carCategory">
                        <option value="">Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="brand-model-select">
                    <span class="visually-hidden">Drivetrain</span>
                    <select id="carDrivetrain">
                        <option value="">Drivetrain</option>
                        @foreach ($drivetrains as $drivetrain)
                            <option value="{{ $drivetrain }}">{{ $drivetrain }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="brand-model-select">
                    <span class="visually-hidden">Fuel Type</span>
                    <select id="carFuelType">
                        <option value="">Fuel Type</option>
                        @foreach ($fuelTypes as $fuelType)
                            <option value="{{ $fuelType }}">{{ $fuelType }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="brand-model-select">
                    <span class="visually-hidden">Production Type</span>
                    <select id="carProductionType">
                        <option value="">All Types</option>
                        @foreach ($productionTypes as $productionType)
                            <option value="{{ $productionType }}">{{ $productionType }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="brand-model-select">
                    <span class="visually-hidden">Vehicle Type</span>
                    <select id="carVehicleType">
                        <option value="">Vehicle Type</option>
                        @foreach ($vehicleTypes as $vehicleType)
                            <option value="{{ $vehicleType }}">{{ $vehicleType }}</option>
                        @endforeach
                    </select>
                </label>

                <div class="brand-filter-actions">
                    <button id="clearCarFilters" class="brand-clear-filters" type="button">
                        Clear
                    </button>
                </div>
            </div>

            <div class="brand-model-results">
                <span id="carResultCount">Loading models...</span>
            </div>

            <div id="carGrid" class="brand-car-grid" aria-live="polite">
                <div class="brand-loading-state">Loading models...</div>
            </div>

            <div class="brand-load-more-wrap">
                <button id="loadMoreCars" class="brand-load-more" type="button" hidden>
                    Load more models
                </button>
            </div>
        </section>
    </main>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/brand.js') }}?v=20260927-3"></script>
@endpush
