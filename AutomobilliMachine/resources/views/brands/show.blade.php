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
            <section class="brand-story-grid">
                @if ($brand->history)
                    <article class="brand-story-card">
                        <span class="brand-section-label">HERITAGE</span>
                        <h2>Brand History</h2>
                        <p>{{ $brand->history }}</p>
                    </article>
                @endif

                @if ($brand->philosophy)
                    <article class="brand-story-card">
                        <span class="brand-section-label">IDENTITY</span>
                        <h2>Brand Philosophy</h2>
                        <p>{{ $brand->philosophy }}</p>
                    </article>
                @endif

                @if ($brand->known_for)
                    <article class="brand-story-card">
                        <span class="brand-section-label">SIGNATURE</span>
                        <h2>What It Is Known For</h2>
                        <p>{{ $brand->known_for }}</p>
                    </article>
                @endif
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
