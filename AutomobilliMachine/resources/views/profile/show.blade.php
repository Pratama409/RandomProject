@extends('layouts.app')

@section('title', 'Profile - AutomobilliMachine')

@section('content')
<section class="profile-page">
    <div class="container">
        <a href="{{ route('home') }}" class="profile-back">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>

        <div class="profile-hero">
            <div>
                <span class="profile-kicker">YOUR AUTOMOBILLI</span>
                <h1>Profile</h1>
                <p>Manage your account and keep track of your saved automotive interests.</p>
            </div>

            <div class="profile-user">
                <div class="profile-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                <div>
                    <strong>{{ $user->name }}</strong>
                    <span>{{ $user->email }}</span>
                </div>
            </div>
        </div>

        <div class="profile-stats">
            <a href="{{ route('collection.index', ['tab' => 'favorites', 'return_to' => url()->full()]) }}">
                <span>Favorites</span>
                <strong>{{ $user->favorite_cars_count }}</strong>
            </a>
            <a href="{{ route('collection.index', ['tab' => 'wishlist', 'return_to' => url()->full()]) }}">
                <span>Wishlist</span>
                <strong>{{ $user->wishlist_cars_count }}</strong>
            </a>
            <div>
                <span>Member Since</span>
                <strong>{{ $user->created_at?->format('M Y') }}</strong>
            </div>
        </div>

        <div class="profile-panels">
            <section class="profile-panel">
                <span class="profile-panel-kicker">ACCOUNT</span>
                <h2>Account information</h2>

                <div class="profile-detail-row">
                    <span>Name</span>
                    <strong>{{ $user->name }}</strong>
                </div>
                <div class="profile-detail-row">
                    <span>Email</span>
                    <strong>{{ $user->email }}</strong>
                </div>
                <div class="profile-detail-row">
                    <span>Email verified</span>
                    <strong>{{ $user->email_verified_at ? 'Verified' : 'Not verified' }}</strong>
                </div>
            </section>

            <section class="profile-panel">
                <span class="profile-panel-kicker">QUICK LINKS</span>
                <h2>Your collection</h2>
                <p>Jump straight into your saved vehicles.</p>

                <div class="profile-actions">
                    <a href="{{ route('collection.index', ['tab' => 'favorites', 'return_to' => url()->full()]) }}">
                        <i class="fa-regular fa-heart"></i> Favorites
                    </a>
                    <a href="{{ route('collection.index', ['tab' => 'wishlist', 'return_to' => url()->full()]) }}">
                        <i class="fa-regular fa-bookmark"></i> Wishlist
                    </a>
                    <a href="{{ route('home') }}#brand-directory">
                        <i class="fa-solid fa-car-side"></i> Explore brands
                    </a>
                </div>
            </section>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="profile-logout">
            @csrf
            <button type="submit">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sign Out
            </button>
        </form>
    </div>
</section>
@endsection
