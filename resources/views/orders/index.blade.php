@extends('layouts.app')

@section('title', 'Your Orders')
@section('page_kicker', 'Orders & tracking')
@section('page_title', 'Your order story')
@section('page_subtitle', 'Follow every BloomWell delivery from prep to doorstep. Tap an order for ingredient and shipping details.')

@section('content')
    <div class="page-toolbar">
        <div>
            <h3 class="mb-0">Order history</h3>
            <p class="text-muted mb-0">Track your recent purchases.</p>
        </div>
        <div class="actions">
            <a href="{{ route('cart.index') }}" class="btn btn-outline-forest">Back to cart</a>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @forelse ($orders as $order)
        <div class="order-card reveal">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="badge-soft">#{{ $order->id }}</span>
                    <h5 class="mb-1">{{ optional($order->placed_at)->format('M d, Y') ?? 'Pending' }}</h5>
                    <p class="mb-0 text-muted">Status: <strong>{{ ucfirst($order->status) }}</strong></p>
                </div>
                <div class="text-right">
                    <p class="mb-1 font-weight-bold">${{ number_format($order->total, 2) }}</p>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-forest">View details</a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">You haven't placed any orders yet.</p>
    @endforelse

    <div class="mt-4">
        {{ $orders->links('components.pagination') }}
    </div>
@endsection
