<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sephora Shop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff; color: #111; }
        .brand { font-family: 'Helvetica Neue', Arial, sans-serif; font-weight:700; letter-spacing:1px; }
        .hero { background:#f7f7f7; border-bottom:1px solid #eee; padding:2rem 0; }
        .card-auth { max-width:420px; margin:2rem auto; }
        .sephora-accent { color:#d21313; }
        .form-control:focus { box-shadow: none; border-color: #d21313; }
        .footer { padding:2rem 0; font-size:.9rem; color:#666; }
    </style>
    @stack('styles')
</head>
<body>
    <header class="hero">
        <div class="container d-flex align-items-center justify-content-between">
            <a class="brand h3 mb-0 text-dark" href="{{ url('/') }}">Sephora<span class="sephora-accent">.</span></a>
            <nav>
                <a class="mr-3 text-dark" href="{{ url('/register') }}">Create account</a>
                <a class="btn btn-outline-dark" href="{{ url('/login') }}">Sign in</a>
            </nav>
        </div>
    </header>

    <main class="py-4">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-info">{{ session('status') }}</div>
            @endif
            @yield('content')
        </div>
    </main>

    <footer class="footer bg-light">
        <div class="container text-center">
            <small>&copy; {{ date('Y') }} Sephora Shop — For demo purposes only.</small>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
