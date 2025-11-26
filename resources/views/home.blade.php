@extends('layouts.app')

@section('title', 'Welcome to BloomWell')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body py-4 px-4 px-md-5">
                    <h3 class="mb-3">Welcome to <span class="wellness-accent">BloomWell</span></h3>
                    <p class="text-muted mb-4">
                        Your modern wellness storefront for supplements, self-care rituals, and everyday balance.
                        Sign in to manage orders and rewards, or create an account to start your BloomWell journey.
                    </p>

                    <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center mb-4">
                        <a href="{{ url('/login') }}" class="btn btn-wellness mr-md-3 mb-2 mb-md-0">
                            <i class="bi bi-box-arrow-in-right mr-1"></i> Sign in
                        </a>
                        <a href="{{ url('/register') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-person-plus mr-1"></i> Create account
                        </a>
                    </div>

                    <hr>

                    <div class="row mt-3">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <h6 class="text-uppercase text-muted small">Curated wellness</h6>
                            <p class="mb-0">Thoughtfully selected supplements, adaptogens, and self-care tools.</p>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <h6 class="text-uppercase text-muted small">Simple subscriptions</h6>
                            <p class="mb-0">Keep essentials stocked with flexible, pause-anytime deliveries.</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-uppercase text-muted small">BloomWell rewards</h6>
                            <p class="mb-0">Earn points every time you shop and unlock wellness perks.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
