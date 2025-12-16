@extends('layouts.app')

@section('title', 'Welcome to BloomWell')

@section('hero')
    <section class="hero-banner fade-seq" style="--fade-delay:0.05s;">
        <div class="container hero-inner text-center text-md-left">
            <p class="hero-kicker mb-3 fade-seq" style="--fade-delay:0.1s;">Modern apothecary</p>
            <h1 class="hero-title mb-3 fade-seq" style="--fade-delay:0.2s;">Nature-forward formulas crafted for everyday balance</h1>
            <p class="hero-subtext mb-4 fade-seq" style="--fade-delay:0.3s;">From adaptogenic tonics to mineral-rich skincare, every BloomWell product is sourced sustainably and blended to help you feel grounded, glowing, and well-rested.</p>
            <div class="hero-actions d-flex flex-column flex-md-row justify-content-center justify-content-md-start align-items-center fade-seq" style="--fade-delay:0.4s;">
                <a href="{{ route('shop.index') }}" class="btn btn-wellness mb-3 mb-md-0 btn-kinetic">Shop the apothecary</a>
                <a href="{{ route('register') }}" class="btn btn-ghost btn-kinetic">Join Bloom Club</a>
            </div>
            <div class="hero-metrics justify-content-center justify-content-md-start">
                <div class="metric-card card-ambient fade-seq" style="--fade-delay:0.5s;">
                    <span class="metric-value">120+</span>
                    <span class="metric-label">Botanical SKUs</span>
                </div>
                <div class="metric-card card-ambient fade-seq" style="--fade-delay:0.6s;">
                    <span class="metric-value">48h</span>
                    <span class="metric-label">Cold ship window</span>
                </div>
                <div class="metric-card card-ambient fade-seq" style="--fade-delay:0.7s;">
                    <span class="metric-value">Green</span>
                    <span class="metric-label">Packaging pledge</span>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="home-grid mt-4">
        <section class="feature-strip">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="feature-pill h-100 card-ambient fade-seq" style="--fade-delay:0.1s;">
                        <div class="pill-icon"><i class="bi bi-droplet-half"></i></div>
                        <div>
                            <p class="eyebrow mb-1">Seasonal staples</p>
                            <h5 class="mb-1">Earth-to-bottle sourcing</h5>
                            <p class="mb-0 text-muted">Cold-pressed oils, mineral tonics, and single-origin botanicals harvested with regenerative partners.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="feature-pill h-100 card-ambient fade-seq" style="--fade-delay:0.2s;">
                        <div class="pill-icon"><i class="bi bi-sun"></i></div>
                        <div>
                            <p class="eyebrow mb-1">Daily rituals</p>
                            <h5 class="mb-1">Rhythm-based routines</h5>
                            <p class="mb-0 text-muted">Curated AM and PM practices so you can balance energy, focus, and rest without decision fatigue.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-pill h-100 card-ambient fade-seq" style="--fade-delay:0.3s;">
                        <div class="pill-icon"><i class="bi bi-recycle"></i></div>
                        <div>
                            <p class="eyebrow mb-1">Planet promise</p>
                            <h5 class="mb-1">Closed-loop packaging</h5>
                            <p class="mb-0 text-muted">Compostable refills and glass vessels help you replenish mindfully while keeping waste near zero.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="collection-grid">
            <article class="collection-card card-ambient fade-seq" style="--fade-delay:0.1s; background-image:linear-gradient(135deg, rgba(12,41,32,.2), rgba(12,41,32,.7)), url('https://www.divasenergy.shop/cdn/shop/products/Divascalmingkit30_3806x.jpg?v=1631055470'); background-size:cover; background-position:center;">
                <span class="eyebrow text-white">Adaptogen lab</span>
                <h4 class="mt-2">Calm Energy Kits</h4>
                <p class="mb-3">Stacked mushroom tinctures plus ceremonial cacao to keep your nervous system soothed without the crash.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-light btn-sm font-weight-bold px-3 btn-kinetic">Browse blends</a>
            </article>
            <article class="collection-card card-ambient fade-seq" style="--fade-delay:0.2s; background-image:linear-gradient(135deg, rgba(31,77,58,.15), rgba(10,10,10,.65)), url('https://www.sacredbodyrituals.com/cdn/shop/products/IMG_8199_540x.heic?v=1682851746'); background-size:cover; background-position:center;">
                <span class="eyebrow text-white">Glow atelier</span>
                <h4 class="mt-2">Skin-food rituals</h4>
                <p class="mb-3">Enzymatic masks, forest bath soaks, and barrier-building serums inspired by apothecary recipes.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-light btn-sm font-weight-bold px-3 btn-kinetic">See skincare</a>
            </article>
            <article class="collection-card card-ambient fade-seq" style="--fade-delay:0.3s; background-image:linear-gradient(135deg, rgba(31,77,58,.25), rgba(31,77,58,.8)), url('https://maxwellclinic.com/wp-content/uploads/2021/01/Updated-Pantry-Image.png'); background-size:cover; background-position:center;">
                <span class="eyebrow text-white">Mindful pantry</span>
                <h4 class="mt-2">Functional pantry goods</h4>
                <p class="mb-3">Herbal sparkling tonics, golden milks, and restorative broths crafted for digestion and immunity.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-light btn-sm font-weight-bold px-3 btn-kinetic">Stock the shelf</a>
            </article>
        </section>

        <section id="rituals" class="row">
            <div class="col-md-6 mb-4">
                <div class="ritual-card card-ambient fade-seq" style="--fade-delay:0.1s;">
                    <p class="eyebrow text-muted mb-2">Sunrise ritual</p>
                    <h5 class="mb-3">Ground + Glow Protocol</h5>
                    <p class="mb-3">Pair our mineral mist with matcha nootropics, then finish with dry brushing for lymphatic drainage.</p>
                    <ul class="list-unstyled mb-3">
                        <li class="d-flex align-items-center mb-2"><i class="bi bi-check2-circle text-success mr-2"></i> Magnesium bloom mist</li>
                        <li class="d-flex align-items-center mb-2"><i class="bi bi-check2-circle text-success mr-2"></i> Jade body brush practice</li>
                        <li class="d-flex align-items-center"><i class="bi bi-check2-circle text-success mr-2"></i> Adaptogenic matcha tonic</li>
                    </ul>
                    <a href="{{ route('shop.index') }}" class="btn btn-link p-0 text-forest font-weight-bold btn-kinetic">Add sunrise set</a>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="ritual-card card-ambient fade-seq" style="--fade-delay:0.2s;">
                    <p class="eyebrow text-muted mb-2">Evening ritual</p>
                    <h5 class="mb-3">Restore + Rest Kit</h5>
                    <p class="mb-3">Wind down with nervous-system-soothing drops, guided breathwork, and a cup of spiced moon milk.</p>
                    <ul class="list-unstyled mb-3">
                        <li class="d-flex align-items-center mb-2"><i class="bi bi-check2-circle text-success mr-2"></i> Ashwagandha night drops</li>
                        <li class="d-flex align-items-center mb-2"><i class="bi bi-check2-circle text-success mr-2"></i> Cedarwood bath concentrate</li>
                        <li class="d-flex align-items-center"><i class="bi bi-check2-circle text-success mr-2"></i> Vanilla cardamom moon milk</li>
                    </ul>
                    <a href="{{ route('shop.index') }}" class="btn btn-link p-0 text-forest font-weight-bold btn-kinetic">Shop evening kit</a>
                </div>
            </div>
        </section>

        <section class="testimonial-cta position-relative text-center text-md-left card-ambient fade-seq" style="--fade-delay:0.1s;">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <p class="eyebrow mb-2">Community voices</p>
                    <p class="testimonial-quote mb-3">“BloomWell helped me rebuild rituals that honor both my nervous system and the planet. Every delivery feels like a gift from nature.”</p>
                    <p class="text-muted mb-0">— Lila M., holistic nutritionist</p>
                </div>
                <div class="col-md-5 text-md-right mt-4 mt-md-0">
                    <a href="{{ route('register') }}" class="btn btn-wellness mb-3 btn-kinetic">Book a 1:1 consultation</a>
                    <p class="mb-0 text-muted small">Chat with a BloomWell herbalist to map your personalized ritual.</p>
                </div>
            </div>
        </section>
    </div>
@endsection
