@extends('layouts.app')

@section('title', 'Your Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Account summary</h4>
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary">Edit profile</a>
                    </div>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role:</strong> {{ $user->is_admin ? 'Administrator' : 'Customer' }}</p>
                    <a href="{{ route('orders.index') }}" class="btn btn-link p-0">View your orders</a>
                </div>
            </div>
        </div>
    </div>
@endsection
