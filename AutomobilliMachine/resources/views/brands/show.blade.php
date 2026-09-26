@extends('layouts.app')

@section('title', $brand->name . ' - AutomobilliMachine')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/brand.css') }}">
@endpush

@section('content')
@include('partials.navbar')

<div
    class="brand-page"
    data-brand-slug="{{ $brand->slug }}"
    data-cars-endpoint="{{ route('brands.cars', $brand) }}"
>
    <section class="brand-hero">
        <div class="brand-hero-overlay"></div>
        @if ($brand->hero_image_path)
            <img src="{{ $brand->hero_image_path }}" alt="{{ $brand->name }}" class="brand-hero-image">
        @endif

        <div class="container brand-hero-content">
            <a href="{{ route('home') }}" class="brand-back-link">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Automobilli
            </a>

            <div class="brand-hero-copy">
                <span class="brand-kicker">MARQUE PROFILE</span>
                <h1>{{ $brand->name }}</h1>

                @if ($brand->tagline)
                    <p>{{ $brand->tagline }}</p>
                @endif
            </div>
        </div>
    </section>

    <main class="container brand-content">
        <section class="brand-fact-grid">
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
        </section>

        @if ($brand->history || $brand->philosophy || $brand->known_for)
            <section class="brand-history-section">
                <div class="brand-history-media">
                    @if ($brand->history_image_path)
                        <img
                            src="{{ $brand->history_image_path }}"
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
