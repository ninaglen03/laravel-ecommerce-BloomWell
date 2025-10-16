@extends('layouts.app')

@section('title', 'Sign in - Sephora')

@section('content')
    <div class="card card-auth">
        <div class="card-body">
            <h4 class="card-title text-center">Welcome back</h4>
            <p class="text-center text-muted">Sign in to access your Sephora account and orders.</p>

            @if (session('status'))
                <div class="alert alert-info">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-block btn-dark">Sign in</button>
            </form>

            <hr>
            <p class="text-center">New to Sephora? <a href="{{ url('/register') }}">Create an account</a></p>
        </div>
    </div>
@endsection
