@extends('layouts.app')

@section('title', 'Your Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-1">Welcome back</p>
            <h2 class="mb-0">{{ $user->name }}</h2>
            <p class="text-muted mb-0">Keep tabs on your wellness orders and discover new finds.</p>
        </div>
        <div>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary mr-2">
                <i class="bi bi-cart4 mr-1"></i> Cart ({{ $stats['cart_quantity'] }})
            </a>
            <a href="{{ route('shop.index') }}" class="btn btn-wellness">
                <i class="bi bi-bag-check mr-1"></i> Browse catalog
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Open orders</p>
                    <h3 class="mb-0">{{ $stats['open_orders'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Completed orders</p>
                    <h3 class="mb-0">{{ $stats['completed_orders'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Lifetime spend</p>
                    <h3 class="mb-0">${{ number_format($stats['lifetime_spend'], 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Cart items</p>
                    <h3 class="mb-0">{{ $stats['cart_quantity'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm h-100">
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
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
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
            <a href="{{ route('shop.index') }}" class="btn btn-sm btn-outline-secondary">See all</a>
        </div>
        <div class="row">
            @forelse ($recommendedProducts as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($product->image_src)
                            <img src="{{ $product->image_src }}" class="card-img-top" alt="{{ $product->name }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-1">{{ $product->name }}</h6>
                            <p class="text-muted mb-2">${{ number_format($product->price, 2) }}</p>
                            <p class="text-muted flex-fill">{{ $product->summary }}</p>
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
                <div class="col-12 text-muted">No recommendations yet. Visit the <a href="{{ route('shop.index') }}">shop</a> to get started.</div>
            @endforelse
        </div>
    </div>
@endsection
