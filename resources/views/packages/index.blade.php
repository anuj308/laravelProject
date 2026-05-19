@extends('layouts.app')

@section('title', 'Travel Packages')

@section('content')
    <div class="bg-slate-50 min-h-screen pb-24">
        <!-- Header Section -->
        <div class="bg-white border-b border-slate-200 pt-16 pb-12 mb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                            <i class="bi bi-briefcase text-teal-600"></i> Curated Packages
                        </h1>
                        <p class="text-slate-500 mt-2 text-lg">Exclusive itineraries designed for unforgettable experiences.</p>
                    </div>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('packages.create') }}" class="px-5 py-2.5 bg-slate-900 text-white font-semibold rounded-xl hover:bg-slate-800 transition shadow-sm flex items-center gap-2">
                                <i class="bi bi-plus-lg"></i> Add Package
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <!-- Packages Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($packages as $package)
                    <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-slate-200 flex flex-col h-full">
                        <!-- Image Container -->
                        <div class="relative overflow-hidden aspect-video">
                            <img src="{{ $package->image }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $package->title }}">
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-2.5 py-1.5 rounded-lg shadow-sm flex items-center gap-1.5">
                                <i class="bi bi-clock-history text-teal-600"></i>
                                <span class="font-bold text-slate-800 text-sm">{{ $package->duration_days }} Days</span>
                            </div>
                            
                            <!-- Gradient Fade -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="absolute bottom-4 left-4 right-4">
                                <p class="text-teal-300 text-sm font-semibold flex items-center gap-1.5 mb-1">
                                    <i class="bi bi-geo-alt-fill"></i> {{ $package->destination?->name ?? 'Multiple Destinations' }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-teal-700 transition line-clamp-2">{{ $package->title }}</h2>
                            <p class="text-slate-500 text-sm mb-6 line-clamp-3">
                                {{ $package->description }}
                            </p>
                            
                            <div class="mt-auto pt-5 border-t border-slate-100 flex items-center justify-between">
                                <div>
                                    <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-0.5">Starting From</div>
                                    <div class="text-2xl font-black text-slate-900 tracking-tight">₹{{ number_format($package->price) }}</div>
                                </div>
                                <a href="{{ route('packages.show', $package) }}" class="px-5 py-2.5 bg-teal-50 text-teal-700 font-bold rounded-xl hover:bg-teal-600 hover:text-white transition-all">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-slate-200">
                        <div class="w-20 h-20 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">No packages found</h3>
                        <p class="text-slate-500">Check back later for exclusive travel itineraries.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $packages->links() }}
            </div>
        </div>
    </div>
@endsection
