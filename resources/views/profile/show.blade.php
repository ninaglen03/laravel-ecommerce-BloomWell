@extends('layouts.app')

@section('title', 'Your Profile')
@section('page_kicker', 'Account hub')
@section('page_title', 'Profile overview')
@section('page_subtitle', 'Keep your details current so your BloomWell deliveries never miss a beat.')

@section('content')
    <div class="profile-shell">
        <div class="profile-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Account summary</h5>
                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-forest">Edit profile</a>
            </div>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->is_admin ? 'Administrator' : 'Customer' }}</p>
            <a href="{{ route('orders.index') }}" class="btn btn-link p-0">View your orders</a>
        </div>
        <div class="profile-card">
            <h5 class="mb-3">Wellness preferences</h5>
            <ul class="list-unstyled text-muted mb-0">
                <li class="mb-2"><i class="bi bi-check2-circle text-success mr-2"></i>Preferred shipping: Chilled</li>
                <li class="mb-2"><i class="bi bi-check2-circle text-success mr-2"></i>Packaging: Low-waste refills</li>
                <li><i class="bi bi-check2-circle text-success mr-2"></i>Favorite rituals: Adaptogens, Bath</li>
            </ul>
        </div>
    </div>
@endsection
