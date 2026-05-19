@extends('layouts.app')

@section('title', 'Luxury Travel Experiences')

@section('content')
    <!-- Cinematic Hero Section -->
    <section class="relative min-h-[90vh] flex flex-col items-center justify-center overflow-hidden -mt-20">
        <!-- Dynamic Deep Background -->
        <div class="absolute inset-0 w-full h-full bg-slate-950">
            <!-- Stable Hero Image -->
            <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=2500&q=80" alt="Cinematic Landscape" class="w-full h-full object-cover object-center scale-105 opacity-60 animate-[pulse_25s_ease-in-out_infinite_alternate]" />
            <!-- Deep Vignette & Glow Overlays -->
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/20 to-slate-950/90 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-teal-500/20 rounded-full blur-[120px] mix-blend-screen pointer-events-none"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex flex-col items-center mt-20">
            
            <!-- Hero Text -->
            <div class="text-center max-w-4xl mb-12">
                <span class="inline-block py-1 px-3 rounded-full bg-white/5 border border-white/10 text-teal-300 text-xs font-bold tracking-[0.2em] uppercase mb-6 backdrop-blur-md">
                    Redefining Exploration
                </span>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-serif text-white leading-[1.1] mb-6 drop-shadow-2xl">
                    Travel Planning, <br><span class="italic text-transparent bg-clip-text bg-gradient-to-r from-teal-200 via-emerald-100 to-teal-200">Reimagined.</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-300 font-light max-w-2xl mx-auto drop-shadow leading-relaxed">
                    Bundle your destination, premium stays, curated packages, and expert guides in one seamless, elegantly crafted journey.
                </p>
            </div>

            <!-- Dark Glassmorphic Quick-Planner Widget -->
            <div class="w-full max-w-4xl relative group">
                <!-- Outer Glow effect -->
                <div class="absolute -inset-1 bg-gradient-to-r from-teal-500/30 to-emerald-500/30 rounded-[2rem] blur-xl opacity-0 group-hover:opacity-100 transition duration-1000"></div>
                
                <div class="relative bg-white/5 backdrop-blur-2xl border border-white/15 p-3 rounded-[2rem] shadow-2xl">
                    <form action="{{ route('trips.create') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                        
                        <div class="flex-1 relative bg-slate-900/50 rounded-2xl hover:bg-slate-900/80 transition-all border border-white/5 focus-within:border-teal-500/50 focus-within:shadow-[0_0_15px_rgba(20,184,166,0.3)] group/input cursor-pointer">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <i class="bi bi-geo-alt text-teal-400 text-xl group-focus-within/input:scale-110 transition-transform"></i>
                            </div>
                            <select name="destination_id" class="block w-full h-16 pl-14 pr-12 bg-transparent text-white font-semibold text-lg focus:outline-none focus:ring-0 appearance-none cursor-pointer" required>
                                <option value="" disabled selected class="text-slate-900">Where is your next escape?</option>
                                @foreach($destinations as $dest)
                                    <option value="{{ $dest->id }}" class="text-slate-900">{{ $dest->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                                <i class="bi bi-chevron-down text-slate-500 group-focus-within/input:text-teal-400 transition-colors"></i>
                            </div>
                        </div>

                        <button type="submit" class="h-16 px-10 bg-white text-slate-900 rounded-2xl font-bold text-lg hover:bg-teal-400 hover:text-slate-950 transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.1)] hover:shadow-[0_0_30px_rgba(45,212,191,0.5)] flex items-center justify-center gap-2 whitespace-nowrap">
                            Start Planning <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex flex-col items-center opacity-50 hover:opacity-100 transition-opacity animate-bounce cursor-pointer">
            <span class="text-white text-[10px] font-bold uppercase tracking-[0.3em] mb-2">Scroll to Discover</span>
            <div class="w-px h-12 bg-gradient-to-b from-white/50 to-transparent"></div>
        </div>
    </section>

    <!-- How It Works (Problem Statement Focus) -->
    <section class="py-32 bg-slate-950 border-b border-white/5 relative overflow-hidden">
        <!-- Abstract ambient background -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-rose-500/5 rounded-full blur-[100px] pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-20">
                <h2 class="text-4xl md:text-5xl font-serif text-white tracking-tight mb-4">The Smart Journey</h2>
                <p class="text-slate-400 text-lg font-light">We solved the fragmentation problem. Experience the future of bespoke travel booking.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                <!-- Step 1 -->
                <div class="relative bg-white/5 backdrop-blur-lg p-10 rounded-3xl border border-white/10 hover:border-teal-500/30 hover:bg-white/10 transition-all duration-500 text-center group">
                    <div class="w-20 h-20 mx-auto bg-slate-900 border border-white/10 rounded-2xl flex items-center justify-center mb-8 group-hover:-translate-y-2 group-hover:shadow-[0_10px_30px_rgba(20,184,166,0.2)] transition-all duration-500">
                        <i class="bi bi-compass text-3xl text-teal-400"></i>
                    </div>
                    <h3 class="text-2xl font-serif text-white mb-3">1. Select Destination</h3>
                    <p class="text-slate-400 font-light leading-relaxed">Choose your dream location. We'll instantly fetch the finest curated options available.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative bg-gradient-to-b from-teal-900/40 to-slate-900/40 backdrop-blur-lg p-10 rounded-3xl border border-teal-500/30 shadow-[0_0_30px_rgba(20,184,166,0.1)] hover:shadow-[0_0_50px_rgba(20,184,166,0.2)] transition-all duration-500 text-center group transform md:-translate-y-4">
                    <div class="w-20 h-20 mx-auto bg-teal-950 border border-teal-500/30 rounded-2xl flex items-center justify-center mb-8 group-hover:-translate-y-2 transition-transform duration-500">
                        <i class="bi bi-layers text-3xl text-teal-400"></i>
                    </div>
                    <h3 class="text-2xl font-serif text-white mb-3">2. Bundle Experiences</h3>
                    <p class="text-teal-100/70 font-light leading-relaxed">Seamlessly add a premium suite, a curated itinerary, and a local expert to your journey.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative bg-white/5 backdrop-blur-lg p-10 rounded-3xl border border-white/10 hover:border-teal-500/30 hover:bg-white/10 transition-all duration-500 text-center group">
                    <div class="w-20 h-20 mx-auto bg-slate-900 border border-white/10 rounded-2xl flex items-center justify-center mb-8 group-hover:-translate-y-2 group-hover:shadow-[0_10px_30px_rgba(20,184,166,0.2)] transition-all duration-500">
                        <i class="bi bi-airplane text-3xl text-teal-400"></i>
                    </div>
                    <h3 class="text-2xl font-serif text-white mb-3">3. Travel Effortless</h3>
                    <p class="text-slate-400 font-light leading-relaxed">Checkout once. Access your complete, unified itinerary from your executive dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bento Grid Destinations -->
    <section class="py-32 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div>
                    <span class="text-teal-600 font-bold tracking-widest uppercase text-xs mb-2 block">Inspirations</span>
                    <h2 class="text-4xl md:text-5xl font-serif text-slate-900 tracking-tight">Curated Escapes</h2>
                </div>
                <a href="{{ route('destinations.index') }}" class="inline-flex items-center gap-2 pb-1 border-b-2 border-slate-900 text-slate-900 font-bold hover:text-teal-600 hover:border-teal-600 transition-colors">
                    Explore Directory <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- Bento Box Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-4 h-auto md:h-[650px]">
                @foreach($destinations->take(5) as $index => $destination)
                    @php
                        $gridClass = '';
                        if($index == 0) $gridClass = 'md:col-span-2 md:row-span-2';
                        elseif($index == 1 || $index == 2) $gridClass = 'md:col-span-1 md:row-span-1';
                        elseif($index == 3) $gridClass = 'md:col-span-2 md:row-span-1';
                        else $gridClass = 'md:col-span-1 md:row-span-1';
                    @endphp

                    <a href="{{ route('destinations.show', $destination) }}" class="{{ $gridClass }} group relative rounded-[2rem] overflow-hidden block">
                        <img src="{{ $destination->image }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 group-hover:rotate-1 transition-transform duration-1000 ease-out" alt="{{ $destination->name }}">
                        <!-- Premium Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500"></div>
                        
                        <!-- Outer Inner Glow -->
                        <div class="absolute inset-0 border-2 border-white/0 group-hover:border-white/10 rounded-[2rem] transition-colors duration-500 z-10 pointer-events-none"></div>
                        
                        <!-- Content -->
                        <div class="absolute inset-0 p-8 flex flex-col justify-between z-20">
                            <div class="self-end bg-slate-900/60 backdrop-blur-md border border-white/20 px-3 py-1.5 rounded-full flex items-center gap-1 shadow-lg">
                                <i class="bi bi-star-fill text-amber-400 text-[10px]"></i>
                                <span class="font-bold text-white text-xs tracking-wide">{{ $destination->rating }}</span>
                            </div>
                            <div class="transform group-hover:-translate-y-2 transition-transform duration-500">
                                <p class="text-teal-300 text-xs font-bold uppercase tracking-widest mb-2 flex items-center gap-2">
                                    <span class="w-4 h-px bg-teal-300"></span> {{ $destination->location }}
                                </p>
                                <h3 class="text-3xl md:text-4xl font-serif text-white">{{ $destination->name }}</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Premium Stays & Transport -->
    <section class="py-32 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                <!-- Stays (Takes up more space) -->
                <div class="lg:col-span-8">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="text-3xl md:text-4xl font-serif text-slate-900 tracking-tight">The Residence Collection</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($hotels->take(4) as $hotel)
                            <div class="group relative rounded-3xl overflow-hidden cursor-pointer" onclick="window.location.href='{{ route('hotels.show', $hotel) }}'">
                                <div class="aspect-[4/3] relative overflow-hidden">
                                    <img src="{{ $hotel->image }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out" alt="{{ $hotel->name }}">
                                </div>
                                <div class="absolute bottom-0 left-0 w-full bg-white/90 backdrop-blur-xl p-5 border-t border-white/50 group-hover:bg-slate-900 transition-colors duration-500">
                                    <div class="flex justify-between items-end">
                                        <div>
                                            <h3 class="font-bold text-slate-900 group-hover:text-white text-lg transition-colors">{{ $hotel->name }}</h3>
                                            <p class="text-slate-500 group-hover:text-slate-400 text-xs mt-1 transition-colors">{{ $hotel->location }}</p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-xl font-serif italic text-teal-700 group-hover:text-teal-400 transition-colors">₹{{ number_format($hotel->price_per_night) }}</div>
                                            <div class="text-[9px] uppercase font-bold text-slate-400 tracking-widest">Per Night</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Transport -->
                <div class="lg:col-span-4">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="text-3xl md:text-4xl font-serif text-slate-900 tracking-tight">Transfers</h2>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach($transports->take(5) as $transport)
                            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between hover:bg-slate-900 hover:border-slate-800 transition-all group cursor-pointer shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-hover:bg-slate-800 group-hover:border-slate-700 group-hover:text-teal-400 transition-colors">
                                        @if($transport->type == 'Bus') <i class="bi bi-bus-front text-lg"></i>
                                        @elseif($transport->type == 'Flight') <i class="bi bi-airplane-engines text-lg"></i>
                                        @elseif($transport->type == 'Train') <i class="bi bi-train-front text-lg"></i>
                                        @else <i class="bi bi-car-front text-lg"></i> @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 group-hover:text-white transition-colors">{{ $transport->type }}</h4>
                                        <p class="text-slate-500 group-hover:text-slate-400 text-xs transition-colors">{{ $transport->route }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="font-serif italic text-teal-700 group-hover:text-teal-400 text-lg transition-colors">₹{{ number_format($transport->price) }}</span>
                                </div>
                            </div>
                        @endforeach
                        
                        <a href="{{ route('transports.index') }}" class="block w-full py-4 text-center mt-6 text-sm font-bold text-slate-600 uppercase tracking-widest hover:text-teal-600 transition-colors">
                            View All Transfers
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
