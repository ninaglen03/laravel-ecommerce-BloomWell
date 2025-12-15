@extends('layouts.app')

@section('title', 'Create account - BloomWell')

@section('content')
    @section('page_kicker', 'Membership invite')
    @section('page_title', 'Join BloomWell')
    @section('page_subtitle', 'Unlock curated rituals, flexible refills, and concierge guidance tailored to your wellness path.')

    <div class="auth-shell">
        <aside class="auth-visual">
            <span class="auth-badge">New members</span>
            <div>
                <h3>Nurture every chapter</h3>
                <p>Answer a few quick questions and our herbalists will prep routines that match your circadian rhythm, stress cycles, and skin goals.</p>
            </div>
            <ul class="auth-benefits">
                <li><i class="bi bi-check2-circle"></i> Personalized ritual roadmaps</li>
                <li><i class="bi bi-check2-circle"></i> Text-with-an-herbalist access</li>
                <li><i class="bi bi-check2-circle"></i> Compostable refill program</li>
            </ul>
        </aside>
        <div class="auth-panel">
            <h4 class="card-title mb-3">Create account</h4>
            <p class="text-muted mb-4">We’ll send onboarding notes right after you join.</p>

            @if (session('status'))
                <div class="alert alert-info">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}
                <input type="hidden" name="store_admin" value="{{ old('store_admin', request()->boolean('admin') ? 1 : 0) }}">

                <div class="form-group">
                    <label for="name">Full name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
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
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Confirm</label>
                        <div class="input-group">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" aria-label="Toggle confirm password visibility" data-toggle-password="password_confirmation">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-wellness">Create account</button>
            </form>

            <hr>
            <p class="text-center mb-1">Already have an account?</p>
            <p class="text-center"><a href="{{ url('/login') }}" class="btn btn-link">Sign in</a></p>
            <p class="text-center mb-0">Want to manage the storefront?</p>
            <p class="text-center">
                <a href="{{ route('register', ['admin' => 1]) }}" class="btn btn-link">Register as Store Admin</a>
            </p>
        </div>
    </div>
@endsection
