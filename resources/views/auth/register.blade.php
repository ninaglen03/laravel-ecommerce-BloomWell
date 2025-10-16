@extends('layouts.app')

@section('title', 'Create account - Sephora')

@section('content')
    <div class="card card-auth">
        <div class="card-body">
            <h4 class="card-title text-center">Create your Sephora account</h4>
            <p class="text-center text-muted">Join now to save favorites and track orders.</p>

            @if (session('status'))
                <div class="alert alert-info">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Full name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Confirm</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-block btn-dark">Create account</button>
            </form>

            <hr>
            <p class="text-center">Already have an account? <a href="{{ url('/login') }}">Sign in</a></p>
        </div>
    </div>
@endsection
