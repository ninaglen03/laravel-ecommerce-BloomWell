<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BloomWell Wellness')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body { background: #ffffff; color: #123; }
    .brand { font-family: 'Helvetica Neue', Arial, sans-serif; font-weight:700; letter-spacing:1px; }
    .hero { background:#f3fbf7; border-bottom:1px solid #e5f3ea; padding:2rem 0; }
        .card-auth { max-width:420px; margin:2rem auto; }
    .wellness-accent { color:#2e7d32; }
    .btn-wellness { background:#2e7d32; color:#fff; border-color:#2e7d32; }
    .btn-wellness:hover { background:#256628; border-color:#256628; color:#fff; }
    .form-control:focus { box-shadow: none; border-color: #2e7d32; }
        .footer { padding:2rem 0; font-size:.9rem; color:#666; }
    :root { --accent-primary:#2e7d32; --accent-secondary:#3f9e8d; }
    a:hover { color: var(--accent-secondary) !important; }
    .nav-link { color:#333 !important; }
    .nav-link:hover { color: var(--accent-secondary) !important; }
    .hero-banner { background: linear-gradient(180deg, rgba(243,251,247,1) 0%, rgba(255,255,255,1) 100%), url('https://images.unsplash.com/photo-1556229010-aa3f7ff66a43?q=80&w=1920&auto=format&fit=crop') center/cover no-repeat; border-bottom:1px solid #e5f3ea; }
    .hero-inner { padding:4rem 0; }
    </style>
    @stack('styles')
</head>
<body>
    <header class="hero">
        <div class="container d-flex align-items-center justify-content-between">
            <a class="brand h3 mb-0 text-dark d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-flower1 wellness-accent mr-2"></i>
                BloomWell<span class="wellness-accent">+</span>
            </a>
            <nav class="d-flex align-items-center">
                <a class="nav-link" href="#"><i class="bi bi-bag mr-1"></i> Shop</a>
                <a class="nav-link" href="#"><i class="bi bi-capsule-pill mr-1"></i> Supplements</a>
                <a class="nav-link" href="#"><i class="bi bi-droplet-half mr-1"></i> Self-Care</a>
                <a class="nav-link" href="#"><i class="bi bi-cart3 mr-1"></i> Cart</a>
                <a class="ml-3 text-dark" href="{{ url('/register') }}"><i class="bi bi-person-plus mr-1"></i> Create account</a>
                <a class="btn btn-outline-dark ml-2" href="{{ url('/login') }}"><i class="bi bi-box-arrow-in-right mr-1"></i> Sign in</a>
            </nav>
        </div>
    </header>
    <section class="hero-banner">
        <div class="container hero-inner text-center">
            <h2 class="mb-3">Nurture your daily wellness</h2>
            <p class="text-muted mb-4">Clean supplements, self-care essentials, and mindful routines — delivered.</p>
            <a href="#" class="btn btn-wellness">Explore Products</a>
        </div>
    </section>

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
            <small>&copy; {{ date('Y') }} BloomWell Wellness — Clean health & self-care shop.</small>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
        <script>
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('[data-toggle-password]');
                if (!btn) return;
                const targetId = btn.getAttribute('data-toggle-password');
                const input = document.getElementById(targetId);
                if (!input) return;
                const icon = btn.querySelector('i');
                const isPassword = input.getAttribute('type') === 'password';
                input.setAttribute('type', isPassword ? 'text' : 'password');
                if (icon) {
                    icon.classList.toggle('bi-eye');
                    icon.classList.toggle('bi-eye-slash');
                }
            });
        </script>
</body>
</html>
