<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Welcome') | TourEase</title>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons (still useful for icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Vite/Tailwind Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="text-slate-800 antialiased flex flex-col min-h-screen">
    <!-- Navbar with Glassmorphism -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight text-teal-700 flex items-center gap-2">
                        <i class="bi bi-compass-fill"></i>
                        TourEase
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('destinations.index') }}" class="text-slate-600 hover:text-teal-600 font-medium transition">Destinations</a>
                    <a href="{{ route('hotels.index') }}" class="text-slate-600 hover:text-teal-600 font-medium transition">Hotels</a>
                    <a href="{{ route('packages.index') }}" class="text-slate-600 hover:text-teal-600 font-medium transition">Packages</a>
                    <a href="{{ route('guides.index') }}" class="text-slate-600 hover:text-teal-600 font-medium transition">Guides</a>
                    <a href="{{ route('transports.index') }}" class="text-slate-600 hover:text-teal-600 font-medium transition">Transports</a>
                    
                    @auth
                        <a href="{{ route('trips.create') }}" class="bg-teal-600 text-white px-4 py-2 rounded-full font-medium hover:bg-teal-700 hover:shadow-lg hover:-translate-y-0.5 transition flex items-center gap-2">
                            <i class="bi bi-map"></i> Plan Trip
                        </a>
                        <div class="relative group">
                            <button class="flex items-center gap-1 text-slate-600 hover:text-teal-600 font-medium transition">
                                My Account <i class="bi bi-chevron-down text-xs"></i>
                            </button>
                            <div class="absolute right-0 w-48 mt-2 origin-top-right bg-white border border-slate-100 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="py-2">
                                    <div class="px-4 py-2 text-xs text-slate-400 font-semibold uppercase tracking-wider">Hello, {{ auth()->user()->name }}</div>
                                    <a href="{{ route('trips.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-teal-600">My Trips</a>
                                    <a href="{{ route('bookings.history') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-teal-600">Bookings</a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm font-semibold text-rose-600 hover:bg-rose-50">Admin Panel</a>
                                    @endif
                                    <hr class="my-1 border-slate-100">
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button class="w-full text-left block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-teal-600 font-medium transition">Log in</a>
                        <a href="{{ route('register') }}" class="bg-slate-900 text-white px-5 py-2 rounded-lg font-medium hover:bg-slate-800 hover:shadow-md transition">Sign up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @if(session('success') || session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                @if(session('success'))
                    <div class="bg-teal-50 border-l-4 border-teal-500 p-4 rounded-r-lg shadow-sm">
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-teal-500 mr-3 text-xl"></i>
                            <p class="text-teal-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg shadow-sm">
                        <div class="flex items-center">
                            <i class="bi bi-exclamation-triangle-fill text-rose-500 mr-3 text-xl"></i>
                            <p class="text-rose-800 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2 text-xl font-bold text-slate-800">
                    <i class="bi bi-compass-fill text-teal-600"></i> TourEase
                </div>
                <p class="text-slate-500 text-sm font-medium">© {{ date('Y') }} TourEase. Premium Tourism Platform.</p>
                <div class="flex gap-4">
                    <a href="#" class="text-slate-400 hover:text-teal-600 transition text-xl"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-slate-400 hover:text-teal-600 transition text-xl"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-slate-400 hover:text-teal-600 transition text-xl"><i class="bi bi-github"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Image Fallback
        document.querySelectorAll('img').forEach(img => {
            img.onerror = function() {
                this.onerror = null;
                this.src = 'https://placehold.co/800x600/e2e8f0/64748b?text=Image+Not+Found';
            };
        });
    </script>
</body>
</html>
