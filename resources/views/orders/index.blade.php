@extends('layouts.app')

@section('title', 'Your Orders')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Order history</h3>
            <p class="text-muted mb-0">Track your recent purchases.</p>
        </div>
        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">Back to cart</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @forelse ($orders as $order)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Order #{{ $order->id }}</h5>
                    <p class="mb-0 text-muted">
                        Placed {{ optional($order->placed_at)->format('M d, Y') ?? 'n/a' }} ·
                        Status: <strong>{{ ucfirst($order->status) }}</strong>
                    </p>
                </div>
                <div class="text-right">
                    <p class="mb-1 font-weight-bold">${{ number_format($order->total, 2) }}</p>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">View details</a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">You haven't placed any orders yet.</p>
    @endforelse

    {{ $orders->links() }}
@endsection
