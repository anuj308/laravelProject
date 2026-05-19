<nav class="fixed top-0 w-full z-50 bg-slate-950/70 backdrop-blur-xl border-b border-white/5 shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-white flex items-center gap-2 group hover:opacity-80 transition-opacity">
                    <i class="bi bi-compass-fill text-teal-400 group-hover:rotate-90 transition-transform duration-500"></i>
                    <span class="font-serif tracking-wide">OmniTrek</span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-6 items-center">
                <a href="{{ route('destinations.index') }}" class="text-slate-300 hover:text-white text-xs uppercase tracking-widest font-medium transition-colors">Destinations</a>
                <a href="{{ route('hotels.index') }}" class="text-slate-300 hover:text-white text-xs uppercase tracking-widest font-medium transition-colors">Stays</a>
                <a href="{{ route('packages.index') }}" class="text-slate-300 hover:text-white text-xs uppercase tracking-widest font-medium transition-colors">Packages</a>
                <a href="{{ route('guides.index') }}" class="text-slate-300 hover:text-white text-xs uppercase tracking-widest font-medium transition-colors">Guides</a>
                
                <div class="w-px h-4 bg-slate-800 mx-1"></div>

                @auth
                    <a href="{{ route('trips.create') }}" class="text-teal-400 hover:text-teal-300 text-xs uppercase tracking-widest font-bold transition-colors flex items-center gap-1.5">
                        <i class="bi bi-magic"></i> Plan Trip
                    </a>
                    <div class="relative group ml-4">
                        <button class="flex items-center gap-2 text-slate-300 hover:text-white text-sm font-medium transition-colors">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0f172a&color=2dd4bf" class="w-7 h-7 rounded-full border border-slate-700" alt="Avatar">
                            <i class="bi bi-chevron-down text-[9px] opacity-50"></i>
                        </button>
                        <div class="absolute right-0 mt-3 w-48 origin-top-right bg-slate-900/95 backdrop-blur-xl border border-slate-800 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden translate-y-1 group-hover:translate-y-0">
                            <div class="py-1 text-xs">
                                <div class="px-4 py-2 border-b border-slate-800">
                                    <p class="font-bold text-white truncate">{{ auth()->user()->name }}</p>
                                </div>
                                <a href="{{ route('trips.index') }}" class="flex items-center gap-2 px-4 py-2 text-slate-300 hover:bg-slate-800 hover:text-teal-400 transition-colors"><i class="bi bi-map"></i> My Trips</a>
                                <a href="{{ route('bookings.history') }}" class="flex items-center gap-2 px-4 py-2 text-slate-300 hover:bg-slate-800 hover:text-teal-400 transition-colors"><i class="bi bi-clock-history"></i> Bookings</a>
                                @if(auth()->user()->isAdmin())
                                    <div class="my-1 border-t border-slate-800"></div>
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 font-semibold text-rose-400 hover:bg-rose-500/10 transition-colors"><i class="bi bi-shield-lock"></i> Admin</a>
                                @endif
                                <div class="my-1 border-t border-slate-800"></div>
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button class="w-full flex items-center gap-2 px-4 py-2 text-slate-400 hover:bg-slate-800 hover:text-white transition-colors text-left"><i class="bi bi-box-arrow-right"></i> Sign Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-slate-300 hover:text-white text-xs uppercase tracking-widest font-medium transition-colors">Log In</a>
                    <a href="{{ route('register') }}" class="bg-white/10 text-white px-4 py-1.5 rounded-full text-xs uppercase tracking-widest font-bold hover:bg-white/20 transition-colors">Sign Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
