@extends('layouts.app')

@section('title', 'Admin access requests')

@section('page_kicker', 'Security review')
@section('page_title', 'Pending admin applications')
@section('page_subtitle', 'Approve trusted teammates to unlock BloomWell HQ or deny requests that miss the bar.')

@push('styles')
<style>
    .admin-queue-actions {
        display:flex;
        justify-content:flex-end;
        flex-wrap:wrap;
        gap:.65rem;
    }
    .btn-approve-pill,
    .btn-deny-pill {
        border-radius:999px;
        font-weight:600;
        padding:.45rem 1.35rem;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:.35rem;
        transition:transform .2s ease, box-shadow .2s ease, background .2s ease, color .2s ease;
    }
    .btn-approve-pill {
        background:linear-gradient(120deg, var(--forest), var(--fern));
        border:none;
        color:#fff;
        box-shadow:0 8px 20px rgba(31,77,58,.25);
    }
    .btn-approve-pill:hover,
    .btn-approve-pill:focus {
        color:#fff;
        transform:translateY(-1px);
        box-shadow:0 12px 26px rgba(31,77,58,.32);
    }
    .btn-deny-pill {
        border:1px solid rgba(185,49,49,.4);
        background:rgba(185,49,49,.08);
        color:#b93131;
    }
    .btn-deny-pill:hover,
    .btn-deny-pill:focus {
        background:rgba(185,49,49,.16);
        border-color:rgba(185,49,49,.6);
        color:#a22626;
    }
</style>
@endpush

@section('content')
    <div class="page-toolbar mb-4">
        <div>
            <h3 class="mb-1">Admin access queue</h3>
            <p class="text-muted mb-0">Review applicant context, then approve or deny with a click.</p>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($pendingRequests->isEmpty())
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <p class="text-muted mb-2">No pending admin requests.</p>
                <p class="text-muted mb-0">New submissions will appear here for approval.</p>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Requested</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingRequests as $requestUser)
                                <tr>
                                    <td>{{ $requestUser->name }}</td>
                                    <td>{{ $requestUser->email }}</td>
                                    <td>{{ optional($requestUser->admin_requested_at)->format('M d, Y h:i A') }}</td>
                                    <td class="text-right">
                                        <div class="admin-queue-actions" aria-label="Admin request actions">
                                            <form method="POST" action="{{ route('admin.requests.approve', $requestUser) }}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-approve-pill" onclick="return confirm('Grant admin access to {{ $requestUser->name }}?');">
                                                    <i class="bi bi-shield-check"></i>
                                                    <span>Approve</span>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.requests.deny', $requestUser) }}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-deny-pill" onclick="return confirm('Deny admin access request for {{ $requestUser->name }}?');">
                                                    <i class="bi bi-x-circle"></i>
                                                    <span>Deny</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
