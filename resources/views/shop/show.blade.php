@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="row">
        <div class="col-md-6 mb-3">
            @if ($product->image_src)
                <img src="{{ $product->image_src }}" alt="{{ $product->name }}" class="img-fluid rounded">
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">${{ number_format($product->price, 2) }}</p>
            <p>{{ $product->description }}</p>

            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <button class="btn btn-wellness" {{ $product->inventory < 1 ? 'disabled' : '' }}>
                    {{ $product->inventory < 1 ? 'Out of stock' : 'Add to cart' }}
                </button>
            </form>
        </div>
    </div>
@endsection
