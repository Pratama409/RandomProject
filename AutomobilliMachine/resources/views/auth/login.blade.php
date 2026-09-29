@extends('layouts.app')

@section('title', 'Sign In - AutomobilliMachine')

@section('content')
<section class="auth-page">
    <div class="container">
        <div class="auth-shell">
            <a href="{{ route('home') }}" class="auth-back">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>

            <div class="auth-card">
                <span class="auth-kicker">WELCOME BACK</span>
                <h1>Sign in to Automobilli</h1>
                <p class="auth-lead">Save vehicles, manage your collection, and keep your automotive interests in one place.</p>

                @if ($errors->any())
                    <div class="auth-alert">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div>{{ $errors->first() }}</div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}" class="auth-form">
                    @csrf

                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>

                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required>

                    <label class="auth-check">
                        <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>

                    <button type="submit" class="auth-submit">Sign In</button>
                </form>

                <p class="auth-switch">Don't have an account?
                    <a href="{{ route('register') }}">Create one</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
