@extends('layouts.app')

@section('title', 'Your Cart')

@section('suppress-status', true)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Shopping cart</h3>
        <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">Continue shopping</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success flash-alert" role="alert">{{ session('status') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($items->isEmpty())
        <p class="text-muted">Your cart is empty.</p>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item['product']->name }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="form-inline">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="form-control form-control-sm mr-2" min="0">
                                <button class="btn btn-sm btn-outline-secondary">Update</button>
                            </form>
                        </td>
                        <td>${{ number_format($item['product']->price, 2) }}</td>
                        <td>${{ number_format($item['subtotal'], 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button class="btn btn-link text-danger p-0">Clear cart</button>
            </form>
            <div class="text-right">
                <h5>Total: ${{ number_format($total, 2) }}</h5>
                @auth
                    <form action="{{ route('checkout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-wellness">Place order</button>
                    </form>
                @else
                    <p class="text-muted mb-2">Sign in to place your order.</p>
                    <a href="{{ route('login') }}" class="btn btn-wellness">Sign in</a>
                @endauth
            </div>
        </div>
    @endif
@endsection
