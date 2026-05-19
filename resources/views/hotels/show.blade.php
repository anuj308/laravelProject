@extends('layouts.app')

@section('title', $hotel->name)

@section('content')
    <!-- Cinematic Header -->
    <div class="relative h-[60vh] min-h-[500px] w-full bg-slate-900">
        <img src="{{ $hotel->image }}" class="absolute inset-0 w-full h-full object-cover opacity-60" alt="{{ $hotel->name }}">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/40 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-white text-sm font-bold border border-white/30 shadow-sm flex items-center gap-1.5">
                        <i class="bi bi-star-fill text-amber-400"></i> {{ $hotel->rating }} Rating
                    </span>
                    <span class="px-3 py-1 bg-teal-500/80 backdrop-blur-md rounded-full text-white text-sm font-bold border border-teal-400/50 flex items-center gap-1.5">
                        <i class="bi bi-geo-alt-fill"></i> {{ $hotel->location }}
                    </span>
                    @if($hotel->destination)
                        <a href="{{ route('destinations.show', $hotel->destination) }}" class="px-3 py-1 bg-slate-800/80 hover:bg-slate-700/80 backdrop-blur-md rounded-full text-white text-sm font-bold border border-slate-600/50 flex items-center gap-1.5 transition">
                            <i class="bi bi-map"></i> View Destination
                        </a>
                    @endif
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-4">{{ $hotel->name }}</h1>
                
                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="flex gap-3 mt-6">
                            <a href="{{ route('hotels.edit', $hotel) }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur border border-white/20 text-white rounded-lg text-sm font-semibold transition">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('hotels.destroy', $hotel) }}" onsubmit="return confirm('Delete this hotel?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500/80 hover:bg-red-600 backdrop-blur text-white rounded-lg text-sm font-semibold transition">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-slate-50 min-h-screen py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Left Column: Description & Reviews -->
                <div class="lg:w-2/3">
                    
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                        <div class="bg-white p-4 rounded-2xl border border-slate-200 text-center shadow-sm">
                            <i class="bi bi-wifi text-2xl text-teal-600 mb-2 block"></i>
                            <span class="text-xs font-bold text-slate-500 uppercase">Free WiFi</span>
                        </div>
                        <div class="bg-white p-4 rounded-2xl border border-slate-200 text-center shadow-sm">
                            <i class="bi bi-cup-hot text-2xl text-teal-600 mb-2 block"></i>
                            <span class="text-xs font-bold text-slate-500 uppercase">Breakfast</span>
                        </div>
                        <div class="bg-white p-4 rounded-2xl border border-slate-200 text-center shadow-sm">
                            <i class="bi bi-person-workspace text-2xl text-teal-600 mb-2 block"></i>
                            <span class="text-xs font-bold text-slate-500 uppercase">Concierge</span>
                        </div>
                        <div class="bg-white p-4 rounded-2xl border border-slate-200 text-center shadow-sm">
                            <i class="bi bi-shield-check text-2xl text-teal-600 mb-2 block"></i>
                            <span class="text-xs font-bold text-slate-500 uppercase">Secure</span>
                        </div>
                    </div>

                    <!-- About Section -->
                    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm mb-12">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="bi bi-info-circle text-teal-600"></i> About this hotel
                        </h2>
                        <p class="text-slate-600 leading-relaxed text-lg">{{ $hotel->description }}</p>
                    </div>

                    <!-- Reviews Section -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-2">
                            <i class="bi bi-chat-quote text-teal-600"></i> Guest Reviews
                        </h2>

                        <!-- Write Review Box -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm mb-8">
                            @auth
                                <form method="POST" action="{{ route('hotels.reviews.store', $hotel) }}">
                                    @csrf
                                    <h3 class="font-bold text-slate-800 mb-4">Share your experience</h3>
                                    
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Rating</label>
                                        <div class="relative">
                                            <select name="rating" class="block w-full sm:w-48 pl-3 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 appearance-none" required>
                                                <option value="" disabled selected>Select rating</option>
                                                <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
                                                <option value="4">⭐⭐⭐⭐ (4/5)</option>
                                                <option value="3">⭐⭐⭐ (3/5)</option>
                                                <option value="2">⭐⭐ (2/5)</option>
                                                <option value="1">⭐ (1/5)</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="bi bi-chevron-down text-slate-400"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Review</label>
                                        <textarea name="comment" rows="3" class="block w-full p-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition placeholder:text-slate-400" placeholder="How was your stay?" required></textarea>
                                    </div>

                                    <button type="submit" class="px-6 py-2.5 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition shadow-sm">
                                        Submit Review
                                    </button>
                                </form>
                            @else
                                <div class="text-center py-6">
                                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400 text-2xl">
                                        <i class="bi bi-lock-fill"></i>
                                    </div>
                                    <h3 class="font-bold text-slate-800 mb-2">Join the community</h3>
                                    <p class="text-slate-500 text-sm mb-4">You need an account to write a review.</p>
                                    <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-slate-900 text-white font-semibold rounded-lg hover:bg-slate-800 transition">Log In</a>
                                </div>
                            @endauth
                        </div>

                        <!-- Review List -->
                        <div class="space-y-4">
                            @forelse($hotel->reviews as $review)
                                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex gap-4">
                                    <div class="w-12 h-12 bg-teal-100 text-teal-700 rounded-full flex-shrink-0 flex items-center justify-center font-bold text-xl">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h4 class="font-bold text-slate-900">{{ $review->user->name }}</h4>
                                                <div class="flex text-amber-400 text-xs mt-0.5">
                                                    @for($i = 0; $i < $review->rating; $i++)
                                                        <i class="bi bi-star-fill"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <span class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-slate-600 text-sm leading-relaxed">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 bg-slate-100 rounded-2xl border border-slate-200 border-dashed">
                                    <p class="text-slate-500">No reviews yet. Be the first to share your experience!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sticky Booking Sidebar -->
                <div class="lg:w-1/3">
                    <div class="sticky top-28">
                        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden p-6 relative">
                            <!-- Price Header -->
                            <div class="flex justify-between items-end mb-6 pb-6 border-b border-slate-100">
                                <div>
                                    <div class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Starting at</div>
                                    <div class="text-4xl font-black text-slate-900 tracking-tight">₹{{ number_format($hotel->price_per_night) }}</div>
                                </div>
                                <div class="text-sm font-bold text-slate-500 uppercase tracking-widest pb-1">/ Night</div>
                            </div>

                            <div class="flex items-center justify-between mb-6 text-sm">
                                <span class="font-semibold text-slate-600"><i class="bi bi-door-open text-teal-600"></i> {{ $hotel->available_rooms }} Rooms Left</span>
                            </div>

                            @auth
                                <form method="POST" action="{{ route('hotels.book', $hotel) }}" class="space-y-4">
                                    @csrf
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Check In</label>
                                            <input name="check_in" type="date" class="block w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Check Out</label>
                                            <input name="check_out" type="date" class="block w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm" required>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Rooms to Book</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="bi bi-door-closed text-slate-400"></i>
                                            </div>
                                            <input name="rooms" type="number" min="1" max="{{ $hotel->available_rooms }}" value="1" class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 font-semibold" required>
                                        </div>
                                    </div>

                                    <button class="w-full py-4 mt-2 bg-gradient-to-r from-teal-600 to-emerald-500 text-white font-bold text-lg rounded-xl hover:from-teal-500 hover:to-emerald-400 transition shadow-lg shadow-teal-500/30 flex items-center justify-center gap-2">
                                        <i class="bi bi-bag-check-fill"></i> Secure Booking
                                    </button>
                                </form>
                            @else
                                <div class="bg-slate-50 border border-slate-100 rounded-xl p-5 text-center">
                                    <p class="text-slate-600 text-sm mb-4">Please log in to reserve your stay at this property.</p>
                                    <a href="{{ route('login') }}" class="inline-block w-full py-3 bg-slate-900 text-white font-bold rounded-lg hover:bg-slate-800 transition">
                                        Log In to Book
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
