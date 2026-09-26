@extends('layouts.app')

@section('title', $brand->name . ' - AutomobilliMachine')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/brand.css') }}">
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
            <div class="brand-hero-copy">
                <span class="brand-kicker">MARQUE PROFILE</span>
                <h1>{{ $brand->name }}</h1>

                @if ($brand->tagline)
                    <p>{{ $brand->tagline }}</p>
                @endif
            </div>
        </div>
    </section>

    @include('partials.navbar')

    <main class="container brand-content">
        @if ($brand->history || $brand->philosophy || $brand->known_for)
            <section class="brand-history-section">
                <div class="brand-history-media">
                    @if ($brand->history_image_path)
                        <img
                            src="{{ str_starts_with($brand->history_image_path, 'http') ? $brand->history_image_path : asset($brand->history_image_path) }}"
                            alt="{{ $brand->name }} heritage"
                            loading="lazy"
                            decoding="async"
                        >
                    @endif
                    <div class="brand-history-media-overlay"></div>
                    <span class="brand-history-media-label">
                        {{ $brand->name }} Heritage
                    </span>
                </div>

                <div class="brand-history-content">
                    <span class="brand-section-label">HERITAGE</span>

                    @if ($brand->history)
                        <h2>A Legacy of Passion &amp; Performance</h2>
                        <p class="brand-history-lead">{{ $brand->history }}</p>
                    @endif

                    @if ($brand->philosophy)
                        <div class="brand-history-subsection">
                            <span class="brand-history-subtitle">Brand Philosophy</span>
                            <p>{{ $brand->philosophy }}</p>
                        </div>
                    @endif

                    @if ($brand->known_for)
                        <div class="brand-history-subsection brand-history-known-for">
                            <span class="brand-history-subtitle">Known For</span>
                            <p>{{ $brand->known_for }}</p>
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

                    <a href="#models" class="brand-inline-link">
                        View All Cars
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
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
