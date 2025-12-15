@extends('layouts.app')

@section('title', 'Your Dashboard')
@section('page_kicker', 'Member home')
@section('page_title', 'Hey ' . $user->first_name ?? $user->name)
@section('page_subtitle', 'Track orders, continue rituals, and keep essentials replenished from one calm hub.')

@section('content')
    <div class="page-toolbar">
        <div>
            <p class="text-muted mb-1">Welcome back</p>
            <h3 class="mb-0">{{ $user->name }}</h3>
            <p class="text-muted mb-0">Keep tabs on your wellness orders and discover new finds.</p>
        </div>
        <div class="actions">
            <a href="{{ route('cart.index') }}" class="btn btn-outline-forest"><i class="bi bi-cart4 mr-1"></i> Cart ({{ $stats['cart_quantity'] }})</a>
            <a href="{{ route('shop.index') }}" class="btn btn-wellness"><i class="bi bi-bag-check mr-1"></i> Browse catalog</a>
        </div>
    </div>

    <div class="stat-grid mb-4">
        <div class="stat-card">
            <p class="text-muted mb-1">Open orders</p>
            <h3 class="mb-0">{{ $stats['open_orders'] }}</h3>
        </div>
        <div class="stat-card">
            <p class="text-muted mb-1">Completed orders</p>
            <h3 class="mb-0">{{ $stats['completed_orders'] }}</h3>
        </div>
        <div class="stat-card">
            <p class="text-muted mb-1">Lifetime spend</p>
            <h3 class="mb-0">${{ number_format($stats['lifetime_spend'], 2) }}</h3>
        </div>
        <div class="stat-card">
            <p class="text-muted mb-1">Cart items</p>
            <h3 class="mb-0">{{ $stats['cart_quantity'] }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm h-100 recent-list">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-1">Recent orders</h5>
                            <p class="text-muted mb-0">Latest five purchases</p>
                        </div>
                        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-secondary">View all</a>
                    </div>
                    @if ($recentOrders->isEmpty())
                        <p class="text-muted mb-0">You haven't placed any orders yet.</p>
                    @else
                        <div class="table-responsive table-shell">
                            <table class="table table-sm table-styled mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Placed</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($recentOrders as $order)
                                    <tr>
                                        <td><a href="{{ route('orders.show', $order) }}">#{{ $order->id }}</a></td>
                                        <td><span class="badge badge-pill badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'secondary' : 'warning') }}">{{ $order->status_label }}</span></td>
                                        <td>${{ number_format($order->total, 2) }}</td>
                                        <td>{{ optional($order->placed_at)->format('M d, h:i A') ?? '—' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="mb-3">Wellness checklist</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span>Profile status</span>
                            <a href="{{ route('profile.edit') }}" class="btn btn-link p-0">Update</a>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span>Order history</span>
                            <a href="{{ route('orders.index') }}" class="btn btn-link p-0">Review</a>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span>Explore catalog</span>
                            <a href="{{ route('shop.index') }}" class="btn btn-link p-0">Shop now</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Fresh picks for you</h5>
            <a href="{{ route('shop.index') }}" class="btn btn-sm btn-outline-forest">See all</a>
        </div>
        <div class="product-grid">
            @forelse ($recommendedProducts as $product)
                <article class="product-card reveal">
                    @if ($product->image_src)
                        <figure><img src="{{ $product->image_src }}" alt="{{ $product->name }}"></figure>
                    @endif
                    <div class="body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h6 class="product-card-title mb-0">{{ $product->name }}</h6>
                            <span class="badge-soft">${{ number_format($product->price, 2) }}</span>
                        </div>
                        <p class="text-muted flex-fill mb-3">{{ $product->summary }}</p>
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <button class="btn btn-wellness" {{ $product->inventory < 1 ? 'disabled' : '' }}>
                                {{ $product->inventory < 1 ? 'Notify me' : 'Add to cart' }}
                            </button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="product-card d-flex justify-content-center align-items-center text-muted">No recommendations yet.</div>
            @endforelse
        </div>
    </div>
@endsection
