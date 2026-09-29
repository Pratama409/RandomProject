@extends('layouts.app')

@section('title', 'My Collection - AutomobilliMachine')

@section('content')
<section class="collection-page">
    <div class="container">
        <a href="{{ route('home') }}" class="collection-back">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Automobilli
        </a>

        <div class="collection-hero">
            <div>
                <span class="collection-kicker">YOUR AUTOMOBILLI</span>
                <h1>My Collection</h1>
                <p>Keep your favorite cars and wishlist in one place. Your saved vehicles will stay connected to the Automobilli catalog.</p>
            </div>

            <div class="collection-tabs" aria-label="Collection tabs">
                <a href="{{ route('collection.index', ['tab' => 'favorites']) }}" class="{{ $tab === 'favorites' ? 'is-active' : '' }}">
                    <i class="fa-regular fa-heart me-1"></i> Favorites
                </a>
                <a href="{{ route('collection.index', ['tab' => 'wishlist']) }}" class="{{ $tab === 'wishlist' ? 'is-active' : '' }}">
                    <i class="fa-regular fa-bookmark me-1"></i> Wishlist
                </a>
            </div>
        </div>

        @if (!auth()->check())
            <div class="collection-auth">
                <i class="fa-regular fa-user"></i>
                <h2>Sign in to build your collection</h2>
                <p>Favorites and wishlist items are tied to your Automobilli account, so they can be available across your saved vehicles and future sessions.</p>
                <div class="collection-auth-actions">
                    <a href="#" class="btn btn-outline-custom btn-sm px-3">Sign In</a>
                    <a href="#" class="btn btn-racing btn-sm px-3">Register</a>
                </div>
            </div>
        @else
            @php
                $items = $tab === 'favorites' ? $favorites : $wishlist;
            @endphp

            @if ($items->isEmpty())
                <div class="collection-empty">
                    <i class="{{ $tab === 'favorites' ? 'fa-regular fa-heart' : 'fa-regular fa-bookmark' }}"></i>
                    <h2>{{ $tab === 'favorites' ? 'No favorites yet' : 'Your wishlist is empty' }}</h2>
                    <p>{{ $tab === 'favorites' ? 'Use the heart button on any vehicle card to save a favorite.' : 'Use the bookmark button on any vehicle card to keep a model on your wishlist.' }}</p>
                    <a href="{{ route('home') }}#brand-directory" class="btn btn-racing btn-sm px-3">Explore Brands</a>
                </div>
            @else
                <div class="collection-grid">
                    @foreach ($items as $car)
                        @php
                            $imageUrl = $car->image_path
                                ? (str_starts_with($car->image_path, 'http') ? $car->image_path : asset($car->image_path))
                                : null;
                        @endphp
                        <article class="collection-card" data-collection-card="{{ $car->id }}">
                            <div class="collection-card-media">
                                @if ($imageUrl)
                                    <img src="{{ $imageUrl }}" alt="{{ $car->name }}" loading="lazy">
                                @endif
                            </div>
                            <div class="collection-card-body">
                                <small>{{ $car->brand?->name ?? 'Automotive' }}</small>
                                <h3>{{ $car->name }}</h3>
                                <p>{{ $car->production_year_start ?: '—' }}{{ $car->production_year_end ? ' – ' . $car->production_year_end : ' – Present' }}</p>
                                <div class="collection-card-footer">
                                    <a href="{{ route('cars.show', ['brand' => $car->brand->slug, 'car' => $car->slug]) }}">
                                        View model <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                    <button type="button" class="collection-card-remove js-collection-remove"
                                        data-car-id="{{ $car->id }}"
                                        data-type="{{ $tab }}">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</section>
@endsection
