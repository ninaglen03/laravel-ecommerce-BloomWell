@extends('layouts.app')

@section('title', 'Products - Admin')

@section('suppress-status', true)

@section('content')
    <div class="page-toolbar">
        <div>
            <h3 class="mb-0">Product catalog</h3>
            <p class="text-muted mb-0">Manage the assortment customers see in the shop.</p>
        </div>
        <div class="actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-forest">
                <i class="bi bi-speedometer2 mr-1"></i> Dashboard
            </a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-wellness">
                <i class="bi bi-plus-circle mr-1"></i> Add product
            </a>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success flash-alert" role="alert">{{ session('status') }}</div>
    @endif

    <div class="table-responsive table-shell">
        <table class="table table-styled">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Inventory</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->inventory }}</td>
                    <td>
                        @if ($product->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Hidden</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No products yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links('components.pagination') }}
    </div>
@endsection
