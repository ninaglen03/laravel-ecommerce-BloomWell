@extends('layouts.app')

@section('page_kicker', 'Admin access request')
@section('page_title', 'Hang tight—review in progress')
@section('page_subtitle', 'Once approved, the Admin Console unlocks automatically.')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-5 text-center">
                <div class="mb-4">
                    <i class="bi bi-hourglass-split display-4 text-warning"></i>
                </div>
                <h2 class="h4 mb-3">Your BloomWell HQ access is pending</h2>
                <p class="text-muted mb-4">
                    We received your request on
                    <strong>{{ optional(auth()->user()->admin_requested_at)->format('F j, Y \a\t g:i A') }}</strong>.
                    Our team will review it soon. You will see the Admin Console badge reappear in the navbar as soon as
                    access is granted.
                </p>
                <p class="mb-4">
                    In the meantime, you can continue exploring the storefront or manage your customer profile as usual.
                </p>
                <div class="d-flex flex-column flex-md-row justify-content-center">
                    <a href="{{ route('shop.index') }}" class="btn btn-wellness mb-3 mb-md-0 mr-md-3">
                        <i class="bi bi-bag mr-1"></i> Back to shop
                    </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('pending-logout').submit();" class="btn btn-outline-forest">
                        <i class="bi bi-box-arrow-right mr-1"></i> Sign out
                    </a>
                    <form id="pending-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
