@extends('layouts.app')

@section('title', 'Register - AutomobilliMachine')

@section('content')
<section class="auth-page">
    <div class="container">
        <div class="auth-shell">
            <a href="{{ route('home') }}" class="auth-back">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>

            <div class="auth-card">
                <span class="auth-kicker">JOIN AUTOMOBILLI</span>
                <h1>Create your account</h1>
                <p class="auth-lead">Build your personal collection and keep your saved vehicles connected to your account.</p>

                @if ($errors->any())
                    <div class="auth-alert">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div>{{ $errors->first() }}</div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}" class="auth-form">
                    @csrf

                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required>

                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>

                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required>

                    <label for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>

                    <button type="submit" class="auth-submit">Create Account</button>
                </form>

                <p class="auth-switch">Already have an account?
                    <a href="{{ route('login') }}">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
