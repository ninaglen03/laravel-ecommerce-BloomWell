@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <h3 class="mb-3">Edit product</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.products._form', ['buttonText' => 'Save changes', 'product' => $product])
    </form>
@endsection
