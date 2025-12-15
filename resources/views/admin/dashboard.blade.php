@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page_kicker', 'Store HQ')
@section('page_title', 'Admin console')
@section('page_subtitle', 'Monitor performance, resolve orders, and keep inventory lush and stocked.')

@section('content')
    <div class="page-toolbar">
        <div>
            <h3 class="mb-1">Store health</h3>
            <p class="text-muted mb-0">Snapshot of BloomWell performance.</p>
        </div>
        <div class="actions">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-forest">
                <i class="bi bi-box-seam mr-1"></i> Manage products
            </a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-wellness">
                <i class="bi bi-receipt mr-1"></i> Manage orders
            </a>
        </div>
    </div>

    <div class="admin-grid">
        <div class="admin-card">
            <p class="text-uppercase small mb-1" style="letter-spacing:.2em;">Revenue</p>
            <h3 class="mb-0">${{ number_format($metrics['revenue'], 2) }}</h3>
        </div>
        <div class="admin-card">
            <p class="text-uppercase small mb-1" style="letter-spacing:.2em;">Orders</p>
            <h3 class="mb-0">{{ $metrics['orders'] }}</h3>
        </div>
        <div class="admin-card">
            <p class="text-uppercase small mb-1" style="letter-spacing:.2em;">Processing</p>
            <h3 class="mb-0">{{ $metrics['processing'] }}</h3>
        </div>
        <div class="admin-card">
            <p class="text-uppercase small mb-1" style="letter-spacing:.2em;">Fulfilled</p>
            <h3 class="mb-0">{{ $metrics['fulfilled'] }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-1">Recent orders</h5>
                            <p class="text-muted mb-0">Latest five purchases.</p>
                        </div>
                        <span class="badge badge-light">Today: ${{ number_format($metrics['today'], 2) }}</span>
                    </div>
                    <div class="table-responsive table-shell">
                        <table class="table table-sm table-styled mb-0">
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
                            @forelse ($recentOrders as $order)
                                <tr>
                                    <td><a href="{{ route('admin.orders.show', $order) }}">#{{ $order->id }}</a></td>
                                    <td>{{ optional($order->user)->name ?? 'Guest' }}</td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $order->status === 'cancelled' ? 'secondary' : ($order->status === 'completed' ? 'success' : 'warning') }}">{{ $order->status_label }}</span>
                                    </td>
                                    <td>{{ optional($order->placed_at)->format('M d, h:i A') ?? '—' }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary mr-1">View</a>
                                        @if (! in_array($order->status, ['completed', 'cancelled']))
                                            <form action="{{ route('admin.orders.fulfill', $order) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">Fulfill</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted text-center">No orders yet.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Low inventory</h5>
                    <ul class="list-group list-group-flush">
                        @forelse ($lowInventory as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>{{ $product->name }}</span>
                                <span class="badge badge-danger">{{ $product->inventory }} left</span>
                            </li>
                        @empty
                            <li class="list-group-item px-0 text-muted">Inventory looks healthy.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Top products</h5>
                    <ul class="list-group list-group-flush">
                        @forelse ($topProducts as $item)
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span>{{ $item->product_name }}</span>
                                <span class="text-muted">{{ $item->total_quantity }} sold</span>
                            </li>
                        @empty
                            <li class="list-group-item px-0 text-muted">No sales data yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
