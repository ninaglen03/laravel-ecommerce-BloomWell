@extends('layouts.app')

@section('title', 'Order #' . $order->id . ' - Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Order #{{ $order->id }}</h3>
            <p class="text-muted mb-0">Placed {{ optional($order->placed_at)->format('M d, Y h:i A') ?? 'n/a' }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Back to orders</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p class="text-muted mb-1">Customer</p>
                    <p class="mb-0">{{ optional($order->user)->name ?? 'Guest checkout' }}</p>
                    <small class="text-muted">{{ optional($order->user)->email ?? 'No email on file' }}</small>
                </div>
                <div class="col-md-4">
                    <p class="text-muted mb-1">Total</p>
                    <h4 class="mb-0">${{ number_format($order->total, 2) }}</h4>
                </div>
                <div class="col-md-4">
                    <p class="text-muted mb-1">Status</p>
                    <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="form-inline">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-control mr-2">
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" @selected($order->status === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-wellness" type="submit">Update</button>
                    </form>
                    @if (! in_array($order->status, ['completed', 'cancelled']))
                        <form method="POST" action="{{ route('admin.orders.fulfill', $order) }}" class="d-inline-block mt-2">
                            @csrf
                            <button class="btn btn-primary btn-sm" type="submit">Mark as fulfilled</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="table-shell">
        <div class="table-responsive">
            <table class="table table-styled mb-0">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
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
        </div>
    </div>
@endsection
