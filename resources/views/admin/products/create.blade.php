@extends('layouts.app')

@section('title', 'New Product')

@section('content')
    <h3 class="mb-3">Add product</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.products._form', ['buttonText' => 'Create product'])
    </form>
@endsection
