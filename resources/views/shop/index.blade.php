@extends('layouts.app')

@section('title', 'BloomWell Shop')
@section('page_kicker', 'Holistic apothecary')
@section('page_title', 'Shop BloomWell')
@section('page_subtitle', 'Sustainably sourced botanicals, rituals, and pantry goods designed to keep your nervous system calm and your glow luminous.')

@section('content')
    <div class="page-toolbar">
        <div>
            <h3 class="mb-1">Today’s ritual edit</h3>
            <p class="text-muted mb-0">Browse seasonal drops, adaptogen blends, and nature-first skincare. Add to cart or tap a tile to learn more.</p>
        </div>
        <div class="actions">
            <a href="{{ url('/cart') }}" class="btn btn-outline-forest d-flex align-items-center"><i class="bi bi-bag mr-1"></i> View cart ({{ $cartCount ?? 0 }})</a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-link text-forest">Dashboard</a>
            @endauth
        </div>
        <div class="chip-group">
            @foreach (($categories ?? ['all' => 'All']) as $key => $label)
                @php
                    $isActive = ($activeCategory ?? 'all') === $key;
                @endphp
                <a
                    href="{{ $key === 'all' ? route('shop.index') : route('shop.index', ['category' => $key]) }}"
                    class="chip {{ $isActive ? 'chip-active' : '' }}"
                >
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    @if (($featuredProducts ?? collect())->isNotEmpty())
        <section class="product-preview-rail">
            <div class="preview-heading">
                <div>
                    <span class="eyebrow text-uppercase">Just dropped</span>
                    <h4 class="mb-1">First look at this batch</h4>
                    <p class="text-muted mb-0">Skim the top picks without scrolling — the full collection sits just below.</p>
                </div>
                <a href="#product-grid" class="btn btn-outline-forest">Jump to grid</a>
            </div>
            <div class="product-preview-track">
                @foreach ($featuredProducts as $feature)
                    <article class="preview-card">
                        <div class="preview-thumb">
                            @if ($feature->image_src)
                                <img src="{{ $feature->image_src }}" alt="{{ $feature->name }}">
                            @endif
                        </div>
                        <div class="preview-info">
                            <span class="preview-eyebrow">{{ $categories[$feature->category] ?? ucfirst($feature->category) }}</span>
                            <h5 class="mb-1">{{ $feature->name }}</h5>
                            <p class="text-muted mb-3">{{ \Illuminate\Support\Str::limit($feature->summary, 80) }}</p>
                            <div class="preview-actions">
                                <span class="price-chip">${{ number_format($feature->price, 2) }}</span>
                                <a href="{{ route('shop.show', $feature) }}" class="preview-link">Details</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <div id="product-grid" class="product-grid">
        @forelse ($products as $product)
            @php
                $badge = $product->inventory < 5 ? 'Low stock' : ($product->created_at && $product->created_at->gt(now()->subMonth()) ? 'New' : null);
            @endphp
            <article class="product-card reveal">
                <figure>
                    @if ($product->image_src)
                        <img src="{{ $product->image_src }}" alt="{{ $product->name }}">
                    @endif
                    @if ($badge)
                        <span class="product-badge">{{ $badge }}</span>
                    @endif
                </figure>
                <div class="body">
                    <div class="d-flex justify-content-between align-items-start">
                        <a href="{{ route('shop.show', $product) }}" class="product-card-title">{{ $product->name }}</a>
                        <span class="badge-soft">${{ number_format($product->price, 2) }}</span>
                    </div>
                    <p class="text-muted mb-3 flex-fill">{{ $product->summary }}</p>
                    <div class="product-meta mb-3">
                        <span><i class="bi bi-leaf mr-1"></i>{{ $product->inventory > 0 ? $product->inventory . ' in stock' : 'Out of stock' }}</span>
                        <span><i class="bi bi-clock-history mr-1"></i>{{ $product->shipping_time ?? '48h cold ship' }}</span>
                    </div>
                    <footer>
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <button class="btn btn-wellness" {{ $product->inventory < 1 ? 'disabled' : '' }}>
                                {{ $product->inventory < 1 ? 'Notify me' : 'Add to cart' }}
                            </button>
                        </form>
                    </footer>
                </div>
            </article>
        @empty
            <div class="product-card d-flex justify-content-center align-items-center text-center">
                <p class="mb-0 text-muted">No products available yet.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $products->links('components.pagination') }}
    </div>
@endsection
