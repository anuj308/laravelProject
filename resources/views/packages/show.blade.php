@extends('layouts.app')

@section('title', $package->title)

@section('content')
    <!-- Cinematic Hero -->
    <div class="relative h-[60vh] min-h-[500px] w-full bg-slate-900">
        <img src="{{ $package->image }}" class="absolute inset-0 w-full h-full object-cover opacity-60" alt="{{ $package->title }}">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/40 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="max-w-3xl">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 bg-teal-500/20 text-teal-300 border border-teal-500/30 rounded-full text-xs font-bold tracking-wider uppercase backdrop-blur-sm">
                                Premium Package
                            </span>
                            <span class="text-slate-300 font-medium flex items-center gap-1.5">
                                <i class="bi bi-clock-history"></i> {{ $package->duration_days }} Days
                            </span>
                        </div>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-tight mb-2">
                            {{ $package->title }}
                        </h1>
                        <p class="text-lg text-slate-300 flex items-center gap-2">
                            <i class="bi bi-geo-alt-fill text-teal-400"></i> {{ $package->destination?->name ?? 'Multiple Locations' }}
                        </p>
                    </div>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="flex gap-3">
                                <a href="{{ route('packages.edit', $package) }}" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl backdrop-blur-md border border-white/20 transition">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('packages.destroy', $package) }}" onsubmit="return confirm('Are you sure you want to delete this package?');">
                                    @csrf @method('DELETE')
                                    <button class="px-5 py-2.5 bg-rose-500/80 hover:bg-rose-500 text-white font-semibold rounded-xl backdrop-blur-md border border-rose-500/50 transition">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Left Content: Description -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-slate-200">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">About This Package</h2>
                        <div class="prose prose-slate prose-lg max-w-none">
                            <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $package->description }}</p>
                        </div>
                        
                        <hr class="my-10 border-slate-100">
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="text-center p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <i class="bi bi-calendar2-check text-2xl text-teal-600 mb-2 block"></i>
                                <div class="text-sm font-semibold text-slate-900">Flexible Dates</div>
                            </div>
                            <div class="text-center p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <i class="bi bi-shield-check text-2xl text-teal-600 mb-2 block"></i>
                                <div class="text-sm font-semibold text-slate-900">Secure Booking</div>
                            </div>
                            <div class="text-center p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <i class="bi bi-headset text-2xl text-teal-600 mb-2 block"></i>
                                <div class="text-sm font-semibold text-slate-900">24/7 Support</div>
                            </div>
                            <div class="text-center p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <i class="bi bi-stars text-2xl text-teal-600 mb-2 block"></i>
                                <div class="text-sm font-semibold text-slate-900">Premium Curated</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar: Booking Widget -->
                <div class="lg:w-1/3">
                    <div class="sticky top-24 bg-white rounded-3xl p-8 shadow-xl border border-slate-200">
                        <div class="mb-8">
                            <div class="text-sm font-bold text-slate-400 uppercase tracking-wide mb-1">Package Price</div>
                            <div class="flex items-end gap-2">
                                <div class="text-4xl font-black text-slate-900 tracking-tight">₹{{ number_format($package->price) }}</div>
                                <div class="text-slate-500 font-medium mb-1">/ person</div>
                            </div>
                        </div>

                        @auth
                            <form method="POST" action="{{ route('packages.book', $package) }}" class="space-y-5">
                                @csrf
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Travel Date</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="bi bi-calendar-event text-slate-400"></i>
                                        </div>
                                        <input name="travel_date" type="date" class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Number of Travelers</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="bi bi-people text-slate-400"></i>
                                        </div>
                                        <input name="people" type="number" min="1" value="1" class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required>
                                    </div>
                                </div>
                                
                                <button type="submit" class="w-full py-4 mt-4 bg-teal-600 text-white font-bold text-lg rounded-xl hover:bg-teal-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                    <i class="bi bi-check2-circle text-xl"></i> Book This Package
                                </button>
                                
                                <p class="text-center text-xs text-slate-400 mt-4">You won't be charged yet</p>
                            </form>
                        @else
                            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 text-center">
                                <i class="bi bi-lock text-3xl text-slate-400 mb-3 block"></i>
                                <h3 class="font-bold text-slate-900 mb-2">Sign in to Book</h3>
                                <p class="text-sm text-slate-500 mb-4">You must be logged in to book this travel package.</p>
                                <a href="{{ route('login') }}" class="block w-full py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition">
                                    Log In
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
