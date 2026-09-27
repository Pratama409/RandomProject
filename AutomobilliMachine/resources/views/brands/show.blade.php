@extends('layouts.app')

@section('title', $brand->name . ' - AutomobilliMachine')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/brand.css') }}?v=20260927-1">
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
                                    <span class="brand-card-arrow">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </span>
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
                    <span class="brand-section-label">DATABASE-DRIVEN MODELS</span>
                    <h2>Cars & Models</h2>
                    <p>Models are requested from the server as needed instead of loading the entire collection at once.</p>
                </div>

                <div class="brand-model-tools">
                    <label for="carSearch" class="visually-hidden">Search models</label>
                    <input id="carSearch" type="search" placeholder="Search models..." autocomplete="off">
                </div>
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
<script src="{{ asset('js/brand.js') }}"></script>
@endpush
