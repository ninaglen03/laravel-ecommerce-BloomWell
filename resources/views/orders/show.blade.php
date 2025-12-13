@extends('layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Order #{{ $order->id }}</h3>
            <p class="text-muted mb-0">Placed {{ optional($order->placed_at)->format('M d, Y \a\t h:i A') ?? 'n/a' }}</p>
        </div>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Back to orders</a>
    </div>

    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-1"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p class="mb-0"><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
