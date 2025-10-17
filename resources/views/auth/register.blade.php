@extends('layouts.app')

@section('title', 'Create account - BloomWell')

@section('content')
    <div class="card card-auth">
        <div class="card-body">
            <h4 class="card-title text-center">Join BloomWell</h4>
            <p class="text-center text-muted">Create your account to save favorites, track wellness orders, and earn rewards.</p>

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
                        <div class="input-group">
                            <input id="password" type="password" class="form-control" name="password" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" aria-label="Toggle password visibility" data-toggle-password="password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Confirm</label>
                        <div class="input-group">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" aria-label="Toggle confirm password visibility" data-toggle-password="password_confirmation">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-block btn-wellness">Create account</button>
            </form>

            <hr>
            <p class="text-center">Already have an account? <a href="{{ url('/login') }}">Sign in</a></p>
        </div>
    </div>
@endsection
