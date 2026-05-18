@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Cinematic Minimal Hero Section -->
    <section class="relative pt-24 pb-32 lg:pt-36 lg:pb-32 flex flex-col items-center justify-center min-h-[90vh] overflow-hidden">
        <!-- Dynamic Background -->
        <div class="absolute inset-0 w-full h-full">
            <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=2000&q=80" alt="Travel Background" class="w-full h-full object-cover object-center scale-105 animate-[pulse_20s_ease-in-out_infinite_alternate]" />
            <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-[2px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex flex-col items-center mt-10">
            
            <!-- Hero Text -->
            <div class="text-center max-w-3xl mb-12">
                <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight leading-tight mb-6 drop-shadow-lg">
                    Travel Planning, <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 to-emerald-200">Reimagined.</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-200 font-medium max-w-2xl mx-auto drop-shadow">
                    Stop jumping between tabs. Bundle your destination, premium stays, curated packages, and expert guides in one seamless checkout.
                </p>
            </div>

            <!-- Floating Glassmorphic Quick-Planner Widget -->
            <div class="w-full max-w-4xl bg-white/10 backdrop-blur-xl border border-white/30 p-2 sm:p-3 rounded-3xl shadow-2xl">
                <form action="{{ route('trips.create') }}" method="GET" class="bg-white rounded-2xl p-2 sm:p-3 flex flex-col md:flex-row gap-3 shadow-inner">
                    
                    <div class="flex-1 relative bg-slate-50 rounded-xl hover:bg-slate-100 transition group cursor-pointer border border-transparent hover:border-slate-200">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-geo-alt text-teal-600 text-lg group-hover:scale-110 transition-transform"></i>
                        </div>
                        <select name="destination_id" class="block w-full h-14 pl-12 pr-10 bg-transparent text-slate-800 font-semibold focus:outline-none focus:ring-0 appearance-none cursor-pointer" required>
                            <option value="" disabled selected>Where do you want to go?</option>
                            @foreach($destinations as $dest)
                                <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <i class="bi bi-chevron-down text-slate-400"></i>
                        </div>
                    </div>

                    <button type="submit" class="h-14 px-8 bg-slate-900 text-white rounded-xl font-bold hover:bg-teal-600 transition-colors duration-300 shadow-md flex items-center justify-center gap-2 whitespace-nowrap">
                        <i class="bi bi-magic text-teal-300"></i> Start Planning
                    </button>
                </form>
            </div>
        </div>

        <!-- Subtle Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex flex-col items-center opacity-70 animate-bounce">
            <span class="text-white text-xs font-semibold uppercase tracking-widest mb-2">Discover</span>
            <i class="bi bi-chevron-down text-white text-xl"></i>
        </div>
    </section>

    <!-- How It Works (Problem Statement Focus) -->
    <section class="py-24 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-slate-900 tracking-tight">The Smart Trip Planner</h2>
                <p class="text-slate-500 mt-4">We solved the fragmentation problem. Experience the future of travel booking.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                <!-- Decorative Line -->
                <div class="hidden md:block absolute top-1/2 left-[10%] right-[10%] h-[2px] bg-gradient-to-r from-transparent via-slate-200 to-transparent -translate-y-1/2 z-0"></div>
                
                <!-- Step 1 -->
                <div class="relative z-10 bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-lg transition-shadow text-center group">
                    <div class="w-16 h-16 mx-auto bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:-translate-y-2 transition-transform duration-300">
                        <i class="bi bi-map text-2xl text-slate-700"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">1. Pick Destination</h3>
                    <p class="text-slate-500 text-sm">Select your dream location and travel dates. We'll instantly fetch the best available options.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 bg-white p-8 rounded-3xl border border-teal-100 shadow-md ring-1 ring-teal-50 text-center group">
                    <div class="w-16 h-16 mx-auto bg-teal-50 border border-teal-100 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:-translate-y-2 transition-transform duration-300">
                        <i class="bi bi-box-seam text-2xl text-teal-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">2. Bundle It All</h3>
                    <p class="text-slate-500 text-sm">Add a premium hotel, a curated travel package, and a local expert guide to your cart seamlessly.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-lg transition-shadow text-center group">
                    <div class="w-16 h-16 mx-auto bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:-translate-y-2 transition-transform duration-300">
                        <i class="bi bi-send-check text-2xl text-slate-700"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">3. Travel Easy</h3>
                    <p class="text-slate-500 text-sm">Checkout once. Access your complete itinerary from your dashboard and enjoy the journey.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bento Grid Destinations -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Curated Escapes</h2>
                    <p class="text-slate-500 mt-2">Explore our most sought-after locations.</p>
                </div>
                <a href="{{ route('destinations.index') }}" class="px-5 py-2.5 bg-white border border-slate-200 rounded-full text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:text-slate-900 transition shadow-sm">
                    View Directory
                </a>
            </div>

            <!-- Bento Box Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-4 h-auto md:h-[600px]">
                @foreach($destinations->take(5) as $index => $destination)
                    @php
                        // Logic to make the first item span 2 rows and 2 columns
                        $gridClass = '';
                        if($index == 0) $gridClass = 'md:col-span-2 md:row-span-2';
                        elseif($index == 1 || $index == 2) $gridClass = 'md:col-span-1 md:row-span-1';
                        elseif($index == 3) $gridClass = 'md:col-span-2 md:row-span-1';
                        else $gridClass = 'md:col-span-1 md:row-span-1';
                    @endphp

                    <a href="{{ route('destinations.show', $destination) }}" class="{{ $gridClass }} group relative rounded-3xl overflow-hidden block">
                        <img src="{{ $destination->image }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $destination->name }}">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                        
                        <!-- Content -->
                        <div class="absolute inset-0 p-6 flex flex-col justify-between">
                            <div class="self-end bg-white/20 backdrop-blur-md border border-white/20 px-3 py-1.5 rounded-full flex items-center gap-1">
                                <i class="bi bi-star-fill text-amber-400 text-xs"></i>
                                <span class="font-bold text-white text-sm tracking-wide">{{ $destination->rating }}</span>
                            </div>
                            <div>
                                <p class="text-teal-300 text-sm font-semibold mb-1 flex items-center gap-1">
                                    <i class="bi bi-geo-alt"></i> {{ $destination->location }}
                                </p>
                                <h3 class="text-2xl font-bold text-white tracking-tight">{{ $destination->name }}</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Premium Shadcn-style Hotels & Transport -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Stays -->
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight mb-6">Premium Stays</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($hotels->take(4) as $hotel)
                            <div class="p-5 border border-slate-200 rounded-2xl bg-white hover:border-slate-300 hover:shadow-md transition-all group cursor-pointer flex gap-4 items-center" onclick="window.location.href='{{ route('hotels.show', $hotel) }}'">
                                <div class="w-16 h-16 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-slate-800 group-hover:text-white transition-colors">
                                    <i class="bi bi-building text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-slate-900">{{ $hotel->name }}</h3>
                                    <p class="text-slate-500 text-xs">{{ $hotel->location }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-slate-900">₹{{ number_format($hotel->price_per_night) }}</div>
                                    <div class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Per Night</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Transport -->
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight mb-6">Transport Options</h2>
                    <div class="space-y-3">
                        @foreach($transports->take(4) as $transport)
                            <div class="p-4 border border-slate-200 rounded-2xl bg-white flex justify-between items-center hover:border-slate-300 hover:shadow-sm transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-600">
                                        @if($transport->type == 'Bus') <i class="bi bi-bus-front"></i>
                                        @elseif($transport->type == 'Flight') <i class="bi bi-airplane-engines"></i>
                                        @else <i class="bi bi-car-front"></i> @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">{{ $transport->type }}</h4>
                                        <p class="text-slate-500 text-xs">{{ $transport->route }}</p>
                                    </div>
                                </div>
                                <span class="font-bold text-slate-900 text-sm">₹{{ number_format($transport->price) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
