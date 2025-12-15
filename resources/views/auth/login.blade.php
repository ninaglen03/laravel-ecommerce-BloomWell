@extends('layouts.app')

@section('title', 'Sign in - BloomWell')

@section('content')
    @section('page_kicker', 'Member access')
    @section('page_title', 'Welcome back')
    @section('page_subtitle', 'Sign in to track orders, manage rituals, and keep BloomWell rewards in sync with your routine.')

    <div class="auth-shell">
        <aside class="auth-visual">
            <span class="auth-badge">Bloom Club</span>
            <div>
                <h3>Rituals stay in rhythm</h3>
                <p>Sync autoship refills, get personalized herbal notes, and access concierge chat when you need a wellness tune-up.</p>
            </div>
            <ul class="auth-benefits">
                <li><i class="bi bi-check2-circle"></i> Pause or edit deliveries anytime</li>
                <li><i class="bi bi-check2-circle"></i> Save curated routines</li>
                <li><i class="bi bi-check2-circle"></i> Earn double points on rituals</li>
            </ul>
        </aside>
        <div class="auth-panel">
            <h4 class="card-title mb-3">Sign in</h4>
            <p class="text-muted mb-4">Use the email tied to your BloomWell account.</p>

            @if (session('status'))
                <div class="alert alert-info">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control" name="password" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" aria-label="Toggle password visibility" data-toggle-password="password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-wellness">Sign in</button>
            </form>

            <hr>
            <p class="text-center mb-0">New to BloomWell?</p>
            <p class="text-center"><a href="{{ url('/register') }}" class="btn btn-link">Create an account</a></p>
        </div>
    </div>
@endsection
