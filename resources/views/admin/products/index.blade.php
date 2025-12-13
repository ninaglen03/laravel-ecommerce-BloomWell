@extends('layouts.app')

@section('title', 'Products - Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Products</h3>
            <p class="text-muted">Manage the catalog visible to shoppers.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-wellness">
            <i class="bi bi-plus-circle mr-1"></i> Add product
        </a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
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

    {{ $products->links() }}
@endsection
