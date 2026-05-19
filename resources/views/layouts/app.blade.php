<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Welcome') | OmniTrek Premium</title>
    
    <!-- Google Fonts: Outfit (Sans) & Playfair Display (Serif) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Vite/Tailwind Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --font-sans: 'Outfit', sans-serif;
            --font-serif: 'Playfair Display', serif;
        }
        body { 
            font-family: var(--font-sans); 
            background-color: #f8fafc; 
        }
        .font-serif {
            font-family: var(--font-serif);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #0d9488; }
    </style>
</head>
<body class="text-slate-800 antialiased flex flex-col min-h-screen">
    <!-- Premium Dark Glass Navbar (Extracted to partials/header.blade.php) -->
    @include('partials.header')

    <!-- Adjust main padding for fixed navbar -->
    <main class="flex-grow pt-20">
        @if(session('success') || session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                @if(session('success'))
                    <div class="bg-teal-500/10 border border-teal-500/30 p-4 rounded-2xl shadow-sm backdrop-blur-sm">
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-teal-500 mr-3 text-xl"></i>
                            <p class="text-teal-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-rose-500/10 border border-rose-500/30 p-4 rounded-2xl shadow-sm backdrop-blur-sm">
                        <div class="flex items-center">
                            <i class="bi bi-exclamation-triangle-fill text-rose-500 mr-3 text-xl"></i>
                            <p class="text-rose-700 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Premium Footer -->
    <footer class="bg-slate-950 border-t border-slate-900 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="md:col-span-2">
                    <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight text-white flex items-center gap-2 mb-4">
                        <i class="bi bi-compass-fill text-teal-400"></i>
                        <span class="font-serif">OmniTrek</span>
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-sm">
                        Elevating travel planning to an art form. Bundle luxury stays, curated experiences, and private transport into one seamless journey.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase tracking-wider text-xs">Explore</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('destinations.index') }}" class="text-slate-400 hover:text-teal-400 text-sm transition-colors">Destinations</a></li>
                        <li><a href="{{ route('hotels.index') }}" class="text-slate-400 hover:text-teal-400 text-sm transition-colors">Premium Stays</a></li>
                        <li><a href="{{ route('packages.index') }}" class="text-slate-400 hover:text-teal-400 text-sm transition-colors">Curated Packages</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase tracking-wider text-xs">Connect</h4>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-teal-500 transition-all"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-teal-500 transition-all"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-teal-500 transition-all"><i class="bi bi-github"></i></a>
                    </div>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-900 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-xs font-medium">© {{ date('Y') }} OmniTrek. A Concept Portfolio Project.</p>
                <div class="flex gap-6 text-xs text-slate-500">
                    <a href="#" class="hover:text-slate-300">Privacy</a>
                    <a href="#" class="hover:text-slate-300">Terms</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // High-end Image Fallback
        document.querySelectorAll('img').forEach(img => {
            img.onerror = function() {
                this.onerror = null;
                // Using a premium placeholder service with an abstract aesthetic
                this.src = 'https://placehold.co/800x600/0f172a/0d9488?text=OmniTrek+Experience';
            };
        });
    </script>
</body>
</html>
