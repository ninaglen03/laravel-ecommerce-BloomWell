@extends('layouts.app')

@section('title', 'Orders - Admin')
@section('page_kicker', 'Admin ops')
@section('page_title', 'Order queue')
@section('page_subtitle', 'Filter, fulfill, and keep customer deliveries flowing smoothly.')

@section('content')
    <div class="page-toolbar">
        <div>
            <h3 class="mb-0">Orders</h3>
            <p class="text-muted mb-0">Track and manage every purchase.</p>
        </div>
        <div class="actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-forest">
                <i class="bi bi-speedometer2 mr-1"></i> Dashboard
            </a>
        </div>
    </div>

    <form method="GET" class="card card-body mb-4">
        <div class="form-row">
            <div class="col-md-4 mb-2">
                <label for="status" class="small text-uppercase text-muted">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">All statuses</option>
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}" @selected($filters['status'] === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-2">
                <label for="search" class="small text-uppercase text-muted">Search</label>
                <input type="text" id="search" name="search" value="{{ $filters['search'] }}" class="form-control" placeholder="Order #, customer name, or email">
            </div>
            <div class="col-md-2 d-flex align-items-end mb-2">
                <button class="btn btn-wellness btn-block" type="submit"><i class="bi bi-search mr-1"></i> Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive table-shell">
        <table class="table table-styled">
            <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Placed</th>
                <th class="text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>
                        <div class="font-weight-semibold">{{ optional($order->user)->name ?? 'Guest' }}</div>
                        <small class="text-muted">{{ optional($order->user)->email ?? 'n/a' }}</small>
                    </td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td><span class="badge badge-pill badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'secondary' : 'warning') }}">{{ $order->status_label }}</span></td>
                    <td>{{ optional($order->placed_at)->format('M d, Y h:i A') ?? '—' }}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">View</a>
                        @if (! in_array($order->status, ['completed', 'cancelled']))
                            <form action="{{ route('admin.orders.fulfill', $order) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm ml-1">Fulfill</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No orders found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links('components.pagination') }}
    </div>
@endsection
