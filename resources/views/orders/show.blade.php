@extends('layouts.app')

@section('title', 'Order #' . $order->id)
@section('page_kicker', 'Order detail')
@section('page_title', 'Order #' . $order->id)
@section('page_subtitle', optional($order->placed_at)->format('M d, Y \a\t h:i A') ?? 'Awaiting placement')

@section('content')
    <div class="page-toolbar">
        <div>
            <h3 class="mb-0">Order status</h3>
            <p class="text-muted mb-0">Track progress and review line items.</p>
        </div>
        <div class="actions">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-forest">Back to orders</a>
        </div>
    </div>

    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p class="text-muted mb-1">Status</p>
                    <h5 class="mb-0">{{ ucfirst($order->status) }}</h5>
                </div>
                <div class="col-md-4">
                    <p class="text-muted mb-1">Total</p>
                    <h5 class="mb-0">${{ number_format($order->total, 2) }}</h5>
                </div>
                <div class="col-md-4">
                    <p class="text-muted mb-1">Destination</p>
                    <h5 class="mb-0">{{ optional($order->shipping_address)['city'] ?? 'On file' }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive table-shell">
        <table class="table table-styled mb-0">
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
