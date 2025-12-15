@extends('layouts.app')

@section('title', $product->name)
@section('page_kicker', 'Product spotlight')
@section('page_title', $product->name)
@section('page_subtitle', $product->summary)

@section('content')
    <div class="product-detail-shell">
        <div class="detail-gallery reveal">
            @if ($product->image_src)
                <img src="{{ $product->image_src }}" alt="{{ $product->name }}" class="img-fluid">
            @else
                <div class="d-flex align-items-center justify-content-center" style="height:320px;">
                    <span class="text-muted">No imagery yet</span>
                </div>
            @endif
            <div class="mt-3">
                <span class="info-pill"><i class="bi bi-drop"></i> Cold ship 48h</span>
                <span class="info-pill"><i class="bi bi-globe"></i> Sustainably sourced</span>
                <span class="info-pill"><i class="bi bi-recycle"></i> Refillable</span>
            </div>
        </div>
        <div class="detail-specs reveal reveal-delay-1">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h2 class="mb-0">${{ number_format($product->price, 2) }}</h2>
                <span class="badge-soft">{{ $product->inventory > 0 ? $product->inventory . ' in stock' : 'Waitlist open' }}</span>
            </div>
            <p class="text-muted">{{ $product->description }}</p>
            <ul class="list-unstyled text-muted">
                <li class="mb-2"><i class="bi bi-check2-circle text-success mr-2"></i>Lab-tested for potency</li>
                <li class="mb-2"><i class="bi bi-check2-circle text-success mr-2"></i>Ships in compostable refill</li>
                <li><i class="bi bi-check2-circle text-success mr-2"></i>Earn 120 Bloom points</li>
            </ul>
            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-4">
                @csrf
                <button class="btn btn-wellness mr-2" {{ $product->inventory < 1 ? 'disabled' : '' }}>
                    {{ $product->inventory < 1 ? 'Notify me' : 'Add to cart' }}
                </button>
                <a href="{{ route('shop.index') }}" class="btn btn-outline-forest">Back to shop</a>
            </form>
        </div>
    </div>
@endsection
