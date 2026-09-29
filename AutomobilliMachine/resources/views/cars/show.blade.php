@extends('layouts.app')

@section('title', $vehicle->name . ' - AutomobilliMachine')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/car-detail.css') }}?v=20260929-1">
@endpush

@section('content')
    <div class="car-detail-page">
        <script>
            window.AUTOMOBILLI_INSIGHTS = @json($quickInsights);
        </script>

        <header class="car-detail-header">
            <div class="container car-detail-header-inner">
                <a class="car-detail-header-brand" href="{{ route('home') }}">
                    <span class="car-detail-header-mark"><i class="fa-solid fa-gauge-high"></i></span>
                    <span>AUTOMOBILLI</span>
                </a>

                <div class="car-detail-header-context">
                    <a href="{{ route('brands.show', $brand) }}"><i class="fa-solid fa-arrow-left"></i>{{ $brand->name }}</a>
                    <span>{{ $vehicle->name }}</span>
                </div>

                <div class="car-detail-header-actions">
                    <button type="button"
                        class="car-detail-header-action js-car-favorite {{ $isFavorited ? 'is-active' : '' }}"
                        data-car-id="{{ $vehicle->id }}"
                        data-car-name="{{ $vehicle->name }}"
                        aria-label="Favorite {{ $vehicle->name }}"
                        aria-pressed="{{ $isFavorited ? 'true' : 'false' }}">
                        <i class="{{ $isFavorited ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                    </button>
                    <button type="button"
                        class="car-detail-header-action js-car-wishlist {{ $isWishlisted ? 'is-active' : '' }}"
                        data-car-id="{{ $vehicle->id }}"
                        data-car-name="{{ $vehicle->name }}"
                        aria-label="Wishlist {{ $vehicle->name }}"
                        aria-pressed="{{ $isWishlisted ? 'true' : 'false' }}">
                        <i class="{{ $isWishlisted ? 'fa-solid' : 'fa-regular' }} fa-bookmark"></i>
                    </button>
                </div>
            </div>
        </header>

        @include('cars.partials.show.hero')
        @include('cars.partials.show.section-nav')
        @include('cars.partials.show.overview')
        @include('cars.partials.show.design')
        @include('cars.partials.show.powertrain')
        @include('cars.partials.show.performance')
        @include('cars.partials.show.specifications')
        @include('cars.partials.show.insights')
        @include('cars.partials.show.interior')
        @include('cars.partials.show.chassis')
        @include('cars.partials.show.production')
        @include('cars.partials.show.variants')
        @include('cars.partials.show.gallery')
        @include('cars.partials.show.compare')
        @include('cars.partials.show.sources')
        @include('cars.partials.show.cta')
        @include('cars.partials.show.modals')
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/car-detail.js') }}?v=20260929-1"></script>
@endpush
