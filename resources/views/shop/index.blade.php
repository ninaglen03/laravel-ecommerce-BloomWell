@extends('layouts.app')

@section('title', 'BloomWell Shop')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0">Shop products</h3>
            <p class="text-muted mb-0">Curated wellness goods ready to ship.</p>
        </div>
        <a href="{{ url('/cart') }}" class="btn btn-outline-secondary">
            <i class="bi bi-bag mr-1"></i> View cart
        </a>
    </div>

    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($product->image_src)
                        <img src="{{ $product->image_src }}" class="card-img-top" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('shop.show', $product) }}" class="text-dark">{{ $product->name }}</a>
                        </h5>
                        <p class="text-muted mb-2">${{ number_format($product->price, 2) }}</p>
                        <p class="card-text flex-fill">{{ $product->summary }}</p>
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <button class="btn btn-wellness btn-block" {{ $product->inventory < 1 ? 'disabled' : '' }}>
                                {{ $product->inventory < 1 ? 'Out of stock' : 'Add to cart' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No products available yet.</div>
        @endforelse
    </div>

    {{ $products->links() }}
@endsection
