@extends('layouts.app')

@section('title', 'Your Cart')
@section('suppress-status', true)
@section('page_kicker', 'Order prep')
@section('page_title', 'Cart & checkout')
@section('page_subtitle', 'Review your ritual picks, adjust quantities, and checkout when you’re ready. Shipping stays chilled within 48 hours.')

@section('content')
    <div class="cart-shell">
        <div>
            <div class="page-toolbar">
                <div>
                    <h3 class="mb-0">Your ritual basket</h3>
                    <p class="text-muted mb-0">Edit items before checkout or keep browsing.</p>
                </div>
                <div class="actions">
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-forest">Continue shopping</a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-ghost-danger">Clear cart</button>
                    </form>
                </div>
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
                <div class="cart-table table-responsive table-shell">
                    <table class="table table-styled align-middle">
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
                                <td>
                                    <div class="font-weight-bold">{{ $item['product']->name }}</div>
                                    <small class="text-muted">{{ $item['product']->summary }}</small>
                                </td>
                                <td>
                                    <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="d-flex align-items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="form-control form-control-sm" min="0">
                                        <button class="btn btn-soft-forest btn-sm ml-2">Update</button>
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
            @endif
        </div>

        <div>
            <div class="cart-summary">
                <div>
                    <p class="mb-1 text-uppercase small" style="letter-spacing:.2em;">Order Total</p>
                    <h5 class="mb-0">${{ number_format($total, 2) }}</h5>
                    <p class="mb-0" style="opacity:.85;">Includes eco packaging + chilled ship.</p>
                </div>
                @auth
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button class="btn btn-light text-forest font-weight-bold">Place order</button>
                    </form>
                    <p class="small mb-0" style="opacity:.8;">Need help? Ping your Bloom concierge in app.</p>
                @else
                    <p class="text-white-50 mb-2">Sign in to place your order.</p>
                    <a href="{{ route('login') }}" class="btn btn-light text-forest font-weight-bold">Sign in</a>
                @endauth
            </div>
        </div>
    </div>
@endsection
