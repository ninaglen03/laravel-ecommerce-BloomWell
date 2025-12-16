@extends('layouts.app')

@php
    $isAdminRegistration = (int) old('store_admin', request()->boolean('admin') ? 1 : 0) === 1;
@endphp

@section('title', $isAdminRegistration ? 'Admin onboarding - BloomWell' : 'Create account - BloomWell')

@section('content')
    @section('page_kicker', $isAdminRegistration ? 'Store HQ Access' : 'Membership invite')
    @section('page_title', $isAdminRegistration ? 'Join the BloomWell Console' : 'Join BloomWell')
    @section('page_subtitle', $isAdminRegistration
        ? 'Secure access for merchandising, order orchestration, and performance telemetry.'
        : 'Unlock curated rituals, flexible refills, and concierge guidance tailored to your wellness path.')

    <div class="auth-shell {{ $isAdminRegistration ? 'admin-mode' : '' }}">
        <aside class="auth-visual {{ $isAdminRegistration ? 'admin-visual' : '' }}">
            @if ($isAdminRegistration)
                <span class="auth-badge admin">Ops team invite</span>
                <div>
                    <h3>Command BloomWell HQ</h3>
                    <p>Stand up assortments, triage orders, and balance inventory flows with the same tools our flagship team uses.</p>
                </div>
                <div class="admin-metric-grid">
                    <div>
                        <span class="metric-value">4</span>
                        <small>core modules</small>
                    </div>
                    <div>
                        <span class="metric-value">24/7</span>
                        <small>support lane</small>
                    </div>
                    <div>
                        <span class="metric-value">360°</span>
                        <small>store insight</small>
                    </div>
                </div>
                <ul class="auth-benefits">
                    <li><i class="bi bi-shield-lock"></i> Elevated permissions review</li>
                    <li><i class="bi bi-graph-up"></i> Live revenue telemetry</li>
                    <li><i class="bi bi-box-seam"></i> Inventory + fulfillment console</li>
                </ul>
            @else
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
            @endif
        </aside>
        <div class="auth-panel {{ $isAdminRegistration ? 'admin-panel' : '' }}">
            <h4 class="card-title mb-3">{{ $isAdminRegistration ? 'Store admin onboarding' : 'Create account' }}</h4>
            <p class="text-muted mb-4">
                {{ $isAdminRegistration ? 'BloomWell HQ access requires approval. You can sign in immediately; admin controls unlock once we finish reviewing your request.' : 'We’ll send onboarding notes right after you join.' }}
            </p>

            @if (session('status'))
                <div class="alert alert-info">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}
                <input type="hidden" name="store_admin" value="{{ $isAdminRegistration ? 1 : 0 }}">

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

                @if ($isAdminRegistration)
                    <div class="alert alert-info" role="status">
                        Ops will review your request soon. HQ access unlocks once approved.
                    </div>
                @endif

                <button type="submit" class="btn {{ $isAdminRegistration ? 'btn-outline-forest' : 'btn-wellness' }}">{{ $isAdminRegistration ? 'Request admin access' : 'Create account' }}</button>
            </form>

            <hr>
            <p class="text-center mb-1">Already have an account?</p>
            <p class="text-center"><a href="{{ url('/login') }}" class="btn btn-link">Sign in</a></p>
            @if (! $isAdminRegistration)
                <p class="text-center mb-0">Want to manage the storefront?</p>
                <p class="text-center">
                    <a href="{{ route('register', ['admin' => 1]) }}" class="btn btn-link">Register as Store Admin</a>
                </p>
            @else
                <p class="text-center mb-0 text-muted">Approved admins can switch back to member flow anytime.</p>
            @endif
        </div>
    </div>
@endsection
