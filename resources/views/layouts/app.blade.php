<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TourEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f7f9fb; }
        .brand-badge { background: #0f766e; color: white; border-radius: 6px; padding: 4px 8px; }
        .hero { background: linear-gradient(rgba(7, 31, 45, .72), rgba(7, 31, 45, .72)), url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80') center/cover; color: white; }
        .card-img-top { height: 190px; object-fit: cover; }
        .rating { color: #b45309; font-weight: 700; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}"><span class="brand-badge">TourEase</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('destinations.index') }}">Destinations</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('hotels.index') }}">Hotels</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('packages.index') }}">Packages</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('guides.index') }}">Guides</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('bookings.history') }}">Bookings</a></li>
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
                        @endif
                    @endauth
                </ul>
                <div class="d-flex gap-2 align-items-center">
                    @auth
                        <span class="small text-muted">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-dark btn-sm">Logout</button>
                        </form>
                    @else
                        <a class="btn btn-outline-dark btn-sm" href="{{ route('login') }}">Login</a>
                        <a class="btn btn-success btn-sm" href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="container mt-3">
            @include('partials.flash')
        </div>
        @yield('content')
    </main>

    <footer class="border-top bg-white mt-5 py-4">
        <div class="container small text-muted d-flex justify-content-between flex-wrap gap-2">
            <span>TourEase tourism management platform</span>
            <span>Built with Laravel MVC and Bootstrap</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
