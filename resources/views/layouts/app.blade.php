<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BloomWell Wellness')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    :root {
        --forest:#1f4d3a;
        --fern:#3a7f5c;
        --sage:#9ec7ad;
        --sunbeam:#f2d39b;
        --mist:#f6f9f4;
        --ink:#0f2a1f;
        --clay:#c7a26a;
    }
    body {
        font-family:'Work Sans', 'Segoe UI', Tahoma, sans-serif;
        color:var(--ink);
        background:
            radial-gradient(circle at 10% 20%, rgba(242,211,155,0.18), transparent 45%),
            radial-gradient(circle at 80% 0%, rgba(158,199,173,0.25), transparent 40%),
            #f8fbf6;
        min-height:100vh;
        line-height:1.65;
    }
    .brand {
        font-family:'Fraunces', 'Work Sans', serif;
        font-weight:600;
        letter-spacing:1px;
        color:var(--forest);
    }
    .brand-tagline {
        font-size:.9rem;
        color:rgba(15,42,31,.7);
        text-transform:uppercase;
        letter-spacing:.18em;
    }
    header.hero {
        background:rgba(255,255,255,.82);
        backdrop-filter:blur(12px);
        border-bottom:1px solid rgba(58,127,92,.15);
        padding:1.75rem 0;
    }
    .nav-link {
        color:var(--forest) !important;
        font-weight:500;
        padding:.35rem 1rem;
        border-radius:999px;
        transition:background .25s ease, color .25s ease;
    }
    .nav-link.nav-pill:hover,
    .nav-link.nav-pill:focus {
        background:rgba(58,127,92,.12);
        color:var(--fern) !important;
    }
    .nav-account-toggle {
        color:var(--forest);
        font-weight:600;
        text-decoration:none;
    }
    .nav-account-toggle:hover { color:var(--fern); }
    .btn-wellness {
        background:linear-gradient(120deg, var(--forest), var(--fern));
        border:none;
        border-radius:14px;
        color:#fff;
        font-weight:600;
        padding:.85rem 1.75rem;
        box-shadow:0 14px 30px rgba(31,77,58,.25);
        transition:transform .2s ease, box-shadow .2s ease;
    }
    .btn-wellness:hover {
        transform:translateY(-1px);
        box-shadow:0 18px 35px rgba(31,77,58,.3);
        color:#fff;
    }
    .btn-ghost {
        border:1px solid rgba(255,255,255,.6);
        color:#fff;
        border-radius:14px;
        padding:.85rem 1.5rem;
        font-weight:600;
        transition:background .25s ease, color .25s ease;
    }
    .btn-ghost:hover {
        background:rgba(255,255,255,.15);
        color:#fff;
    }
    .btn-outline-forest {
        border:1px solid rgba(31,77,58,.35);
        color:var(--forest);
        border-radius:14px;
        padding:.65rem 1.4rem;
        font-weight:600;
    }
    .btn-outline-forest:hover {
        background:rgba(58,127,92,.08);
        color:var(--forest);
        text-decoration:none;
    }
    .btn-soft-forest {
        background:rgba(31,77,58,.08);
        border:1px solid rgba(31,77,58,.18);
        color:var(--forest);
        border-radius:16px;
        padding:.5rem 1.35rem;
        font-weight:600;
        transition:background .2s ease, color .2s ease, border-color .2s ease;
    }
    .btn-soft-forest:hover {
        background:rgba(31,77,58,.16);
        border-color:rgba(31,77,58,.3);
        color:var(--forest);
        text-decoration:none;
    }
    .btn-ghost-danger {
        border:1px solid rgba(209,68,68,.35);
        border-radius:999px;
        padding:.55rem 1.4rem;
        color:#b93131;
        font-weight:600;
        background:rgba(255,255,255,.9);
        transition:background .2s ease, color .2s ease, border-color .2s ease;
    }
    .btn-ghost-danger:hover {
        background:rgba(221,83,83,.08);
        border-color:rgba(209,68,68,.55);
        color:#a22626;
        text-decoration:none;
    }
    .form-control:focus {
        box-shadow:0 0 0 3px rgba(58,127,92,.18);
        border-color:var(--fern);
    }
    .hero-banner {
        background:linear-gradient(135deg, rgba(31,77,58,.9), rgba(31,77,58,.55)), url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=1920&auto=format&fit=crop') center/cover no-repeat;
        color:#fff;
        position:relative;
        overflow:hidden;
    }
    .hero-banner::before,
    .hero-banner::after {
        content:'';
        position:absolute;
        border-radius:50%;
        background:rgba(242,211,155,.35);
        filter:blur(0px);
    }
    .hero-banner::before {
        width:320px;
        height:320px;
        top:-120px;
        right:-60px;
        background:rgba(158,199,173,.45);
        animation:leafDrift 26s ease-in-out infinite;
    }
    .hero-banner::after {
        width:220px;
        height:220px;
        bottom:-60px;
        left:-40px;
        animation:leafDriftReverse 22s ease-in-out infinite;
    }
    .hero-inner { padding:4.5rem 0 5rem; }
    .hero-kicker {
        text-transform:uppercase;
        letter-spacing:.3em;
        font-size:.82rem;
        color:rgba(255,255,255,.75);
    }
    .hero-title {
        font-family:'Fraunces', 'Work Sans', serif;
        font-size:2.75rem;
        font-weight:600;
        line-height:1.2;
    }
    .hero-subtext {
        color:rgba(255,255,255,.82);
        max-width:620px;
        margin:0 auto;
    }
    .hero-actions a + a { margin-left:0; }
    @media (min-width:768px) {
        .hero-actions a + a { margin-left:1rem; }
        .hero-subtext { margin:0; }
    }
    .page-topper {
        background:linear-gradient(120deg, rgba(253,250,243,0.95), rgba(238,246,239,0.95));
        border-bottom:1px solid rgba(31,77,58,.08);
        padding:2.75rem 0;
    }
    .page-topper-kicker {
        text-transform:uppercase;
        letter-spacing:.28em;
        font-size:.75rem;
        color:rgba(15,42,31,.55);
        margin-bottom:.75rem;
    }
    .page-topper-title {
        font-family:'Fraunces', 'Work Sans', serif;
        font-size:2.15rem;
        color:var(--forest);
        margin-bottom:.5rem;
    }
    .page-topper-subtitle {
        max-width:580px;
        color:#4f665c;
        margin-bottom:0;
    }
    .hero-metrics {
        margin-top:2.5rem;
        display:flex;
        flex-wrap:wrap;
        gap:1rem;
    }
    .metric-card {
        background:rgba(255,255,255,.08);
        border-radius:18px;
        padding:1rem 1.25rem;
        flex:1 1 140px;
        backdrop-filter:blur(6px);
        animation:metricGlow 12s ease-in-out infinite;
    }
    .metric-value {
        font-size:1.35rem;
        font-weight:600;
        display:block;
    }
    .metric-label { font-size:.9rem; letter-spacing:.08em; text-transform:uppercase; color:rgba(255,255,255,.7); }
    .wellness-accent { color:var(--forest); }
    main { background:linear-gradient(180deg, rgba(246,249,244,0) 0%, #f6f9f4 30%); }
    .card-auth { max-width:420px; margin:2rem auto; border-radius:18px; }
    .flash-alert { border-radius:12px; }
    .footer {
        padding:2.5rem 0;
        font-size:.9rem;
        color:#4b5c55;
        background:rgba(255,255,255,.9);
        border-top:1px solid rgba(58,127,92,.1);
    }
    .home-grid { display:flex; flex-direction:column; gap:2.5rem; }
    .feature-strip {
        background:#fff;
        border-radius:20px;
        padding:1.75rem;
        box-shadow:0 20px 45px rgba(12,41,32,.08);
    }
    .pill-icon {
        width:48px;
        height:48px;
        border-radius:50%;
        background:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        box-shadow:0 15px 25px rgba(12,41,32,.08);
    }
    .feature-pill {
        display:flex;
        align-items:center;
        gap:1rem;
        padding:1rem 1.25rem;
        border-radius:16px;
        background:linear-gradient(135deg, rgba(58,127,92,.08), rgba(31,77,58,.05));
        color:var(--ink);
    }
    .feature-pill .bi { font-size:1.2rem; color:var(--fern); }
    .eyebrow {
        text-transform:uppercase;
        letter-spacing:.2em;
        font-size:.75rem;
        color:rgba(15,42,31,.65);
        font-weight:600;
    }
    .text-forest { color:var(--forest) !important; }
    .text-forest:hover { color:var(--fern) !important; }
    .collection-grid {
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
        gap:1.5rem;
    }
    .collection-card {
        min-height:260px;
        border-radius:26px;
        padding:2rem;
        color:#fff;
        display:flex;
        flex-direction:column;
        justify-content:flex-end;
        position:relative;
        overflow:hidden;
        box-shadow:0 25px 50px rgba(12,41,32,.18);
    }
    .collection-card::after {
        content:'';
        position:absolute;
        inset:0;
        background:linear-gradient(180deg, rgba(12,41,32,.05), rgba(12,41,32,.65));
    }
    .collection-card > * { position:relative; z-index:1; }
    .collection-card h4 { font-family:'Fraunces', 'Work Sans', serif; font-size:1.5rem; }
    .collection-card span { font-size:.85rem; letter-spacing:.18em; text-transform:uppercase; }
    .ritual-card {
        background:#fff;
        border-radius:24px;
        padding:2rem;
        box-shadow:0 18px 40px rgba(12,41,32,.08);
        height:100%;
    }
    .ritual-card h5 { font-family:'Fraunces', 'Work Sans', serif; }
    .testimonial-cta {
        background:linear-gradient(135deg, #fdf4e3, #f5fcef);
        border-radius:28px;
        padding:2.5rem;
        position:relative;
        overflow:hidden;
    }
    .testimonial-cta::after {
        content:'';
        position:absolute;
        width:220px;
        height:220px;
        border-radius:50%;
        background:rgba(31,77,58,.08);
        top:-40px;
        right:-20px;
    }
    .testimonial-quote {
        font-family:'Fraunces', 'Work Sans', serif;
        font-size:1.4rem;
        color:var(--forest);
    }
    .page-toolbar {
        display:flex;
        flex-direction:column;
        gap:1rem;
        margin-bottom:2rem;
    }
    .page-toolbar h3 { font-family:'Fraunces', 'Work Sans', serif; color:var(--forest); }
    .page-toolbar .actions {
        display:flex;
        flex-wrap:wrap;
        gap:.75rem;
    }
    .chip-group { display:flex; flex-wrap:wrap; gap:.5rem; }
    .chip {
        padding:.4rem 1rem;
        border-radius:999px;
        border:1px solid rgba(31,77,58,.15);
        color:var(--forest);
        font-size:.85rem;
        background:#fff;
        transition:background .2s ease, color .2s ease, border-color .2s ease;
        cursor:pointer;
    }
    .chip-active,
    .chip:hover { background:rgba(58,127,92,.12); border-color:rgba(58,127,92,.35); }
    .product-grid {
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
        gap:1.5rem;
    }
    .product-card {
        background:#fff;
        border-radius:26px;
        overflow:hidden;
        box-shadow:0 25px 55px rgba(12,41,32,.08);
        display:flex;
        flex-direction:column;
        transition:transform .25s ease, box-shadow .25s ease;
    }
    .product-card:hover { transform:translateY(-4px); box-shadow:0 30px 60px rgba(12,41,32,.12); }
    .product-card figure { margin:0; position:relative; }
    .product-card img { width:100%; height:220px; object-fit:cover; }
    .product-badge {
        position:absolute;
        top:1rem;
        left:1rem;
        background:rgba(31,77,58,.85);
        color:#fff;
        padding:.2rem .75rem;
        border-radius:999px;
        font-size:.75rem;
        letter-spacing:.08em;
        text-transform:uppercase;
    }
    .product-card .body {
        padding:1.75rem;
        display:flex;
        flex-direction:column;
        height:100%;
    }
    .product-card-title {
        font-family:'Fraunces', 'Work Sans', serif;
        font-size:1.2rem;
        color:var(--forest);
        margin-bottom:.4rem;
    }
    .product-meta {
        display:flex;
        align-items:center;
        gap:.5rem;
        font-size:.9rem;
        color:#6c7d73;
    }
    .product-card footer { margin-top:1.25rem; }
    .product-card footer form button { width:100%; border-radius:16px; }
    .table-shell {
        background:#fff;
        border-radius:28px;
        box-shadow:0 25px 55px rgba(12,41,32,.08);
        padding:0;
        overflow:hidden;
        border:1px solid rgba(31,77,58,.05);
    }
    .table-shell + .table-shell { margin-top:1.5rem; }
    .table-styled {
        margin-bottom:0;
        color:var(--ink);
    }
    .table-styled thead th {
        text-transform:uppercase;
        letter-spacing:.2em;
        font-size:.72rem;
        color:#5a6d64;
        border-top:none;
        border-bottom:1px solid rgba(31,77,58,.1);
        background:rgba(31,77,58,.03);
    }
    .table-styled tbody td {
        vertical-align:middle;
        border-color:rgba(31,77,58,.06);
        padding:1rem;
    }
    .table-styled tbody tr:hover td {
        background:rgba(31,77,58,.03);
    }
    .table-styled.table-sm tbody td { padding:.65rem .9rem; }
    .product-preview-rail {
        background:linear-gradient(135deg, rgba(255,255,255,.95), rgba(233,244,236,.95));
        border-radius:30px;
        padding:2rem;
        box-shadow:0 30px 60px rgba(12,41,32,.08);
        margin-bottom:2.5rem;
        display:flex;
        flex-direction:column;
        gap:1.5rem;
    }
    .preview-heading {
        display:flex;
        flex-wrap:wrap;
        align-items:flex-start;
        justify-content:space-between;
        gap:1rem;
    }
    .product-preview-track {
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
        gap:1.25rem;
    }
    .preview-card {
        background:#fff;
        border-radius:24px;
        padding:1.25rem;
        display:flex;
        gap:1rem;
        box-shadow:0 20px 40px rgba(12,41,32,.08);
        border:1px solid rgba(31,77,58,.06);
    }
    .preview-thumb img {
        width:96px;
        height:96px;
        object-fit:cover;
        border-radius:18px;
        box-shadow:0 15px 25px rgba(12,41,32,.12);
    }
    .preview-info h5 {
        font-family:'Fraunces', 'Work Sans', serif;
        color:var(--forest);
    }
    .preview-eyebrow {
        font-size:.75rem;
        letter-spacing:.2em;
        text-transform:uppercase;
        color:rgba(31,77,58,.7);
        font-weight:600;
    }
    .preview-actions {
        display:flex;
        align-items:center;
        gap:.75rem;
        flex-wrap:wrap;
    }
    .price-chip {
        background:rgba(31,77,58,.08);
        color:var(--forest);
        border-radius:999px;
        padding:.3rem .85rem;
        font-weight:600;
        font-size:.9rem;
    }
    .preview-link {
        font-weight:600;
        color:var(--fern);
    }
    .preview-link:hover { color:var(--forest); text-decoration:none; }
    .pagination-shell {
        margin-top:2.5rem;
        padding:1.5rem 2rem;
        background:#fff;
        border-radius:28px;
        display:flex;
        flex-wrap:wrap;
        align-items:center;
        justify-content:space-between;
        gap:1rem;
        box-shadow:0 22px 45px rgba(12,41,32,.08);
    }
    .pagination-nav {
        display:flex;
        align-items:center;
        gap:.85rem;
    }
    .pagination-btn {
        width:44px;
        height:44px;
        border-radius:50%;
        border:1px solid rgba(31,77,58,.15);
        display:flex;
        align-items:center;
        justify-content:center;
        color:var(--forest);
        font-size:1rem;
        transition:all .2s ease;
        background:#fff;
        box-shadow:0 10px 20px rgba(12,41,32,.06);
    }
    .pagination-btn:hover { border-color:rgba(31,77,58,.4); color:var(--fern); text-decoration:none; }
    .pagination-btn.is-disabled {
        opacity:.45;
        pointer-events:none;
        box-shadow:none;
    }
    .pagination-pages {
        list-style:none;
        display:flex;
        align-items:center;
        gap:.35rem;
        margin:0;
        padding:0;
    }
    .pagination-page {
        min-width:38px;
        height:38px;
        border-radius:12px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        font-weight:600;
        color:var(--forest);
        background:rgba(31,77,58,.08);
        transition:all .2s ease;
    }
    .pagination-page:hover { background:rgba(31,77,58,.15); color:var(--forest); text-decoration:none; }
    .pagination-page.is-active {
        background:linear-gradient(120deg, var(--forest), var(--fern));
        color:#fff;
        box-shadow:0 14px 25px rgba(31,77,58,.25);
    }
    .pagination-ellipsis { color:#839287; font-weight:600; }
    .product-detail-shell {
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
        gap:2.5rem;
        align-items:flex-start;
    }
    .detail-gallery {
        background:#fff;
        border-radius:28px;
        padding:1.5rem;
        box-shadow:0 25px 45px rgba(12,41,32,.08);
    }
    .detail-gallery img { width:100%; border-radius:20px; }
    .detail-specs h2 { font-family:'Fraunces', 'Work Sans', serif; color:var(--forest); }
    .info-pill {
        display:inline-flex;
        align-items:center;
        gap:.35rem;
        padding:.3rem .9rem;
        border-radius:999px;
        background:rgba(31,77,58,.08);
        font-size:.8rem;
        margin-right:.35rem;
    }
    .cart-shell {
        display:grid;
        grid-template-columns:minmax(0,1fr) minmax(260px,320px);
        gap:2rem;
    }
    .cart-table {
        background:#fff;
        border-radius:22px;
        box-shadow:0 25px 45px rgba(12,41,32,.08);
        overflow:hidden;
    }
    .cart-table table { margin:0; }
    .cart-table th { text-transform:uppercase; font-size:.78rem; letter-spacing:.12em; border-top:0; background:rgba(31,77,58,.04); }
    .cart-summary {
        background:linear-gradient(180deg, rgba(31,77,58,.9), rgba(58,127,92,.8));
        color:#fff;
        border-radius:24px;
        padding:2rem;
        box-shadow:0 30px 60px rgba(12,41,32,.22);
        display:flex;
        flex-direction:column;
        gap:1rem;
    }
    .cart-summary h5 { font-family:'Fraunces', 'Work Sans', serif; }
    .cart-summary .btn { border-radius:16px; }
    .stat-grid {
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
        gap:1rem;
    }
    .stat-card {
        background:#fff;
        border-radius:22px;
        padding:1.5rem;
        box-shadow:0 25px 45px rgba(12,41,32,.07);
        position:relative;
        overflow:hidden;
    }
    .stat-card::after {
        content:'';
        position:absolute;
        width:120px;
        height:120px;
        border-radius:50%;
        background:rgba(31,77,58,.08);
        top:-40px;
        right:-40px;
    }
    .stat-card > * { position:relative; z-index:1; }
    .recent-list table { border:0; }
    .recent-list table td,
    .recent-list table th { border:0; }
    .timeline {
        position:relative;
        padding-left:1.5rem;
        margin:0;
        list-style:none;
    }
    .timeline::before {
        content:'';
        position:absolute;
        top:0;
        left:.35rem;
        width:2px;
        height:100%;
        background:rgba(31,77,58,.2);
    }
    .timeline-item {
        position:relative;
        margin-bottom:1.5rem;
    }
    .timeline-item::before {
        content:'';
        position:absolute;
        width:10px;
        height:10px;
        border-radius:50%;
        background:var(--forest);
        left:-.7rem;
        top:.35rem;
    }
    .order-card {
        border-radius:22px;
        background:#fff;
        box-shadow:0 20px 45px rgba(12,41,32,.08);
        padding:1.5rem;
        margin-bottom:1.25rem;
    }
    .profile-shell {
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
        gap:2rem;
    }
    .profile-card {
        background:#fff;
        border-radius:24px;
        padding:2rem;
        box-shadow:0 25px 45px rgba(12,41,32,.08);
        height:100%;
    }
    .profile-card h5 { font-family:'Fraunces', 'Work Sans', serif; }
    .admin-grid {
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
        gap:1rem;
        margin-bottom:2rem;
    }
    .admin-card {
        background:linear-gradient(135deg, rgba(31,77,58,.95), rgba(58,127,92,.8));
        color:#fff;
        border-radius:24px;
        padding:1.5rem;
        box-shadow:0 30px 55px rgba(12,41,32,.18);
    }
    .badge-soft {
        background:rgba(31,77,58,.1);
        color:var(--forest);
        border-radius:999px;
        padding:.15rem .65rem;
        font-size:.75rem;
        text-transform:uppercase;
        letter-spacing:.1em;
    }
    .auth-shell {
        display:grid;
        grid-template-columns:minmax(280px, 1.1fr) minmax(320px, 1fr);
        max-width:980px;
        margin:2.5rem auto 1rem;
        border-radius:32px;
        box-shadow:0 35px 65px rgba(12,41,32,.18);
        overflow:hidden;
        background:#fff;
    }
    .auth-visual {
        background:linear-gradient(135deg, #173628, #2f6a4b 60%, #6da08a);
        color:#fff;
        padding:2.75rem;
        position:relative;
        display:flex;
        flex-direction:column;
        justify-content:space-between;
        min-height:100%;
        overflow:hidden;
    }
    .auth-visual::before,
    .auth-visual::after {
        content:'';
        position:absolute;
        border-radius:50%;
        background:rgba(255,255,255,.12);
        filter:blur(0px);
        animation:leafDrift 24s ease-in-out infinite;
    }
    .auth-visual::before {
        width:220px;
        height:220px;
        top:-60px;
        right:-40px;
    }
    .auth-visual::after {
        width:160px;
        height:160px;
        bottom:-40px;
        left:-30px;
        animation:leafDriftReverse 20s ease-in-out infinite;
    }
    .auth-visual > * { position:relative; z-index:1; }
    .auth-visual h3 {
        font-family:'Fraunces', 'Work Sans', serif;
        font-size:2rem;
        margin-bottom:1rem;
    }
    .auth-visual p { color:rgba(255,255,255,.85); }
    .auth-benefits {
        list-style:none;
        padding:0;
        margin:1.5rem 0 0;
    }
    .auth-benefits li {
        display:flex;
        align-items:center;
        gap:.65rem;
        font-weight:600;
        text-transform:none;
        color:#f4faf3;
        margin-bottom:.65rem;
    }
    .auth-benefits i { color:var(--sunbeam); }
    .auth-badge {
        align-self:flex-start;
        padding:.65rem 1.4rem;
        border-radius:999px;
        background:rgba(255,255,255,.18);
        font-weight:600;
        letter-spacing:.08em;
        text-transform:uppercase;
        color:#fff;
        font-size:.78rem;
        box-shadow:0 8px 25px rgba(0,0,0,.15);
    }
    .auth-panel {
        padding:2.75rem;
        background:#fff;
    }
    .auth-panel h4 {
        font-family:'Fraunces', 'Work Sans', serif;
        color:var(--forest);
    }
    .auth-panel .form-group label {
        font-weight:600;
        color:var(--forest);
    }
    .auth-panel .form-control {
        border-radius:16px;
        border:1px solid rgba(31,77,58,.18);
        padding:.75rem 1rem;
    }
    .auth-panel .form-control:focus {
        border-color:var(--fern);
        box-shadow:0 0 0 3px rgba(58,127,92,.12);
    }
    .auth-panel .input-group-append .btn {
        border-radius:0 16px 16px 0;
        border-color:transparent;
        background:rgba(31,77,58,.08);
        color:var(--forest);
    }
    .auth-panel .form-check-label { color:#506158; }
    .auth-panel hr { border-color:rgba(31,77,58,.1); }
    .auth-panel .btn-wellness { width:100%; border-radius:18px; }
    .auth-panel .btn-link { color:var(--forest); }
    .auth-panel .btn-link:hover { color:var(--fern); }
    @media (max-width: 991px) {
        .auth-shell {
            grid-template-columns:1fr;
        }
        .auth-visual { min-height:260px; }
    }
    @media (max-width: 991px) {
        .cart-shell { grid-template-columns:1fr; }
    }
    .reveal {
        opacity:0;
        transform:translateY(40px);
        transition:opacity .7s ease, transform .7s ease;
    }
    .reveal.is-visible {
        opacity:1;
        transform:translateY(0);
    }
    .reveal-delay-1 { transition-delay:.1s; }
    .reveal-delay-2 { transition-delay:.2s; }
    .reveal-delay-3 { transition-delay:.3s; }
    .reveal-delay-4 { transition-delay:.4s; }
    @media (prefers-reduced-motion: reduce) {
        .hero-banner::before,
        .hero-banner::after,
        .metric-card,
        .reveal {
            animation:none !important;
            transition:none !important;
            opacity:1 !important;
            transform:none !important;
        }
    }
    @keyframes leafDrift {
        0% { transform:translate3d(0,0,0) scale(1); }
        50% { transform:translate3d(-25px,20px,0) scale(1.05); }
        100% { transform:translate3d(0,0,0) scale(1); }
    }
    @keyframes leafDriftReverse {
        0% { transform:translate3d(0,0,0) scale(1); }
        50% { transform:translate3d(20px,-25px,0) scale(0.95); }
        100% { transform:translate3d(0,0,0) scale(1); }
    }
    @keyframes metricGlow {
        0% { box-shadow:0 10px 30px rgba(0,0,0,0.05); background:rgba(255,255,255,.08); }
        50% { box-shadow:0 18px 40px rgba(0,0,0,0.1); background:rgba(255,255,255,.16); }
        100% { box-shadow:0 10px 30px rgba(0,0,0,0.05); background:rgba(255,255,255,.08); }
    }
    </style>
    @stack('styles')
</head>
<body>
    <header class="hero">
        <div class="container d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <div class="d-flex flex-column align-items-start mb-3 mb-md-0">
                <a class="brand h3 mb-0 d-flex align-items-center" href="{{ url('/') }}">
                    <i class="bi bi-flower1 wellness-accent mr-2"></i>
                    BloomWell<span class="wellness-accent">+</span>
                </a>
                <span class="brand-tagline d-none d-md-inline mt-1">Nature-born rituals for luminous health</span>
            </div>
            <nav class="d-flex align-items-center flex-wrap justify-content-center justify-content-md-end">
                @php($user = auth()->user())
                @if (! $user || ! $user->is_admin)
                    <a class="nav-link nav-pill" href="{{ route('shop.index') }}"><i class="bi bi-bag mr-1"></i> Shop</a>
                    <a class="nav-link nav-pill" href="{{ route('cart.index') }}"><i class="bi bi-cart3 mr-1"></i> Cart</a>
                @else
                    <a class="nav-link nav-pill" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 mr-1"></i> Admin Console</a>
                @endif
                @auth
                    <div class="dropdown ml-3">
                        <button class="btn btn-link nav-account-toggle d-flex align-items-center p-0" type="button" id="accountMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person-circle mr-1"></i>
                            <span>{{ \Illuminate\Support\Str::limit($user->name, 12) }}</span>
                            <i class="bi bi-chevron-down ml-1 small"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="accountMenu">
                            @if ($user && ! $user->is_admin)
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard') }}"><i class="bi bi-grid-1x2 mr-2"></i>Dashboard</a>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('orders.index') }}"><i class="bi bi-receipt mr-2"></i>Orders</a>
                            @endif
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}"><i class="bi bi-person mr-2"></i>Profile</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button class="dropdown-item d-flex align-items-center" type="submit"><i class="bi bi-box-arrow-right mr-2"></i>Sign out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a class="ml-3 btn btn-outline-forest" href="{{ url('/register') }}"><i class="bi bi-person-plus mr-1"></i> Create account</a>
                    <a class="btn btn-wellness ml-md-2 mt-2 mt-md-0" href="{{ url('/login') }}"><i class="bi bi-box-arrow-in-right mr-1"></i> Sign in</a>
                @endauth
            </nav>
        </div>
    </header>
    @hasSection('hero')
        @yield('hero')
    @else
        <section class="page-topper">
            <div class="container">
                <p class="page-topper-kicker">@yield('page_kicker', 'Wellness concierge')</p>
                <h1 class="page-topper-title">@yield('page_title', 'BloomWell')</h1>
                <p class="page-topper-subtitle">@yield('page_subtitle', 'Explore nature-led rituals, refills, and mindful goods tailored to you.')</p>
            </div>
        </section>
    @endif

    <main class="py-4">
        <div class="container">
            @if (! View::hasSection('suppress-status'))
                @if (session('status'))
                    <div class="alert alert-success flash-alert" role="alert">{{ session('status') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger flash-alert" role="alert">{{ session('error') }}</div>
                @endif
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

            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.flash-alert').forEach(function (alert) {
                    setTimeout(function () {
                        alert.style.transition = 'opacity 0.3s ease';
                        alert.style.opacity = '0';
                        setTimeout(function () {
                            alert.remove();
                        }, 300);
                    }, 3000);
                });

                const revealElements = document.querySelectorAll('.reveal');
                if (window.IntersectionObserver) {
                    const revealObserver = new IntersectionObserver(function (entries, observer) {
                        entries.forEach(function (entry) {
                            if (!entry.isIntersecting) {
                                return;
                            }
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        });
                    }, {
                        threshold:0.15,
                        rootMargin:'0px 0px -10% 0px'
                    });

                    revealElements.forEach(function (el) {
                        revealObserver.observe(el);
                    });
                } else {
                    revealElements.forEach(function (el) {
                        el.classList.add('is-visible');
                    });
                }
            });
        </script>
</body>
</html>
