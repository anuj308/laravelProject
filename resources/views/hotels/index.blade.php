@extends('layouts.app')

@section('title', 'Premium Stays')

@section('content')
    <div class="bg-slate-50 min-h-screen pb-24">
        
        <!-- Header & Search Section -->
        <div class="bg-white border-b border-slate-200 pt-16 pb-12 mb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-8">
                    <div>
                        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                            <i class="bi bi-building text-teal-600"></i> Premium Stays
                        </h1>
                        <p class="text-slate-500 mt-2 text-lg">Discover luxury heritage properties, resorts, and elegant retreats.</p>
                    </div>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('hotels.create') }}" class="px-5 py-2.5 bg-slate-900 text-white font-semibold rounded-xl hover:bg-slate-800 transition shadow-sm flex items-center gap-2">
                                <i class="bi bi-plus-lg"></i> Add Hotel
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- Glassmorphic Search Bar -->
                <form class="bg-slate-50 p-3 rounded-2xl border border-slate-200 flex flex-col md:flex-row gap-3 shadow-sm">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-search text-slate-400"></i>
                        </div>
                        <input name="search" value="{{ request('search') }}" class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition placeholder:text-slate-400" placeholder="Search hotel name...">
                    </div>
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-geo-alt text-slate-400"></i>
                        </div>
                        <input name="location" value="{{ request('location') }}" class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition placeholder:text-slate-400" placeholder="Filter by location...">
                    </div>
                    <div class="md:w-48 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-currency-rupee text-slate-400"></i>
                        </div>
                        <input name="max_price" value="{{ request('max_price') }}" type="number" class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition placeholder:text-slate-400" placeholder="Max Price">
                    </div>
                    <div class="md:w-36 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-star text-slate-400"></i>
                        </div>
                        <input name="rating" value="{{ request('rating') }}" type="number" step="0.1" min="0" max="5" class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition placeholder:text-slate-400" placeholder="Rating">
                    </div>
                    <button type="submit" class="px-8 py-3 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition shadow-sm">
                        Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Hotels Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($hotels as $hotel)
                    <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-slate-200 flex flex-col h-full">
                        <!-- Image Container -->
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="{{ $hotel->image }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $hotel->name }}">
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4 bg-teal-600/90 backdrop-blur text-white px-3 py-1.5 rounded-lg shadow-sm font-bold tracking-wide">
                                ₹{{ number_format($hotel->price_per_night) }} <span class="text-xs font-normal text-teal-100">/night</span>
                            </div>
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-2.5 py-1.5 rounded-lg shadow-sm flex items-center gap-1.5">
                                <i class="bi bi-star-fill text-amber-500 text-sm"></i>
                                <span class="font-bold text-slate-800">{{ $hotel->rating }}</span>
                            </div>
                            
                            <!-- Gradient Fade for text legibility -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-xl font-bold text-slate-900 mb-1 group-hover:text-teal-700 transition line-clamp-1">{{ $hotel->name }}</h2>
                            <p class="text-slate-500 text-sm font-medium flex items-center gap-1.5 mb-4 line-clamp-1">
                                <i class="bi bi-geo-alt-fill text-slate-300"></i> {{ $hotel->location }}
                            </p>
                            
                            <div class="flex items-center justify-between mb-6 text-sm text-slate-600 bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-door-open text-teal-600"></i>
                                    <span class="font-semibold">{{ $hotel->available_rooms }} Rooms</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-check-circle text-teal-600"></i>
                                    <span class="font-semibold text-teal-700">Available</span>
                                </div>
                            </div>
                            
                            <div class="mt-auto pt-4 border-t border-slate-100">
                                <a href="{{ route('hotels.show', $hotel) }}" class="block w-full py-3 text-center bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 hover:shadow-lg transition-all">
                                    View Details & Book
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-slate-200">
                        <div class="w-20 h-20 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                            <i class="bi bi-buildings"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">No hotels found</h3>
                        <p class="text-slate-500">We couldn't find any hotels matching your criteria. Try adjusting your filters.</p>
                        <a href="{{ route('hotels.index') }}" class="inline-block mt-4 text-teal-600 font-semibold hover:underline">Clear Filters</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $hotels->links() }}
            </div>
        </div>
    </div>
@endsection
