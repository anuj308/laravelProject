@extends('layouts.app')

@section('title', $destination->name)

@section('content')
    <!-- Cinematic Header -->
    <div class="relative h-[60vh] min-h-[500px] w-full bg-slate-900">
        <img src="{{ $destination->image }}" class="absolute inset-0 w-full h-full object-cover opacity-60" alt="{{ $destination->name }}">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/40 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-white text-sm font-bold border border-white/30 shadow-sm flex items-center gap-1.5">
                        <i class="bi bi-star-fill text-amber-400"></i> {{ $destination->rating }} Rating
                    </span>
                    <span class="px-3 py-1 bg-teal-500/80 backdrop-blur-md rounded-full text-white text-sm font-bold border border-teal-400/50 flex items-center gap-1.5">
                        <i class="bi bi-geo-alt-fill"></i> {{ $destination->location }}
                    </span>
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-4">{{ $destination->name }}</h1>
                
                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="flex gap-3 mt-6">
                            <a href="{{ route('destinations.edit', $destination) }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur border border-white/20 text-white rounded-lg text-sm font-semibold transition">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('destinations.destroy', $destination) }}" onsubmit="return confirm('Are you sure?');">
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
                    <!-- About Section -->
                    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm mb-12">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="bi bi-info-circle text-teal-600"></i> About this destination
                        </h2>
                        <p class="text-slate-600 leading-relaxed text-lg">{{ $destination->description }}</p>
                    </div>

                    <!-- Places to Visit (Attractions) -->
                    @if($destination->attractions->count() > 0)
                    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm mb-12">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="bi bi-camera text-teal-600"></i> Places to Visit
                        </h2>
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                            @foreach($destination->attractions as $attraction)
                            <div class="group relative aspect-square overflow-hidden rounded-2xl bg-slate-100 border border-slate-200 shadow-lg">
                                <img src="{{ $attraction->image }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110" alt="{{ $attraction->name }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent opacity-80 decoration-none"></div>
                                <div class="absolute bottom-0 left-0 w-full p-4">
                                    <h4 class="font-bold text-white text-xs sm:text-sm tracking-wide mb-1">{{ $attraction->name }}</h4>
                                    <p class="text-[10px] text-slate-300 line-clamp-1 opacity-0 group-hover:opacity-100 transition duration-300">{{ $attraction->description }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Restaurants to Explore -->
                    @if($destination->restaurants->count() > 0)
                    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm mb-12">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="bi bi-egg-fried text-amber-600"></i> Local Dining & Ratings
                        </h2>
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                            @foreach($destination->restaurants as $restaurant)
                            <div class="group relative aspect-square overflow-hidden rounded-2xl bg-slate-100 border border-slate-200 shadow-lg">
                                <img src="{{ $restaurant->image }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110" alt="{{ $restaurant->name }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent opacity-90"></div>
                                
                                <!-- Favorite Icon -->
                                <button class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-red-500 transition group-hover:scale-110 duration-300">
                                    <i class="bi bi-heart"></i>
                                </button>

                                <div class="absolute bottom-0 left-0 w-full p-4">
                                    <div class="flex items-center gap-1.5 text-amber-400 text-[10px] font-bold mb-1">
                                        <i class="bi bi-star-fill"></i> {{ $restaurant->rating }} ({{ $restaurant->reviews->count() }} Reviews)
                                    </div>
                                    <h4 class="font-bold text-white text-xs sm:text-sm tracking-wide mb-1 line-clamp-1">{{ $restaurant->name }}</h4>
                                    
                                    <!-- Show Review Snippet if exists -->
                                    @if($restaurant->reviews->count() > 0)
                                        <p class="text-[10px] text-slate-300 italic line-clamp-1 opacity-0 group-hover:opacity-100 transition duration-300">
                                            "{{ $restaurant->reviews->first()->comment }}"
                                        </p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Transportation -->
                    @if($destination->transports->count() > 0)
                    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm mb-12">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="bi bi-bus-front text-blue-600"></i> Transportation & Cab Booking
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($destination->transports as $transport)
                            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-teal-200 transition group">
                                <div class="flex justify-between items-start mb-3">
                                    <span class="px-2 py-0.5 bg-white border border-slate-200 rounded-md text-[10px] font-bold text-slate-500 uppercase">{{ $transport->type }}</span>
                                    <span class="text-teal-600 font-bold text-sm">₹{{ number_format($transport->price) }}</span>
                                </div>
                                <h4 class="font-bold text-slate-800 text-sm mb-1">{{ $transport->provider }}</h4>
                                <p class="text-xs text-slate-500 mb-4">{{ $transport->route }}</p>
                                
                                <div class="flex items-center justify-between mt-auto pt-4 border-t border-slate-200">
                                    <div class="flex flex-col gap-1 text-[10px] text-slate-400 font-medium">
                                        <span><i class="bi bi-clock"></i> {{ $transport->departure_time }}</span>
                                        <span><i class="bi bi-person-check"></i> {{ $transport->available_seats }} Seats left</span>
                                    </div>
                                    <a href="{{ route('transports.book', $transport) }}" class="px-4 py-2 bg-slate-900 text-white text-[10px] font-bold rounded-lg hover:bg-teal-600 transition shadow-sm">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Stay Options (Hotels) -->
                    @if($destination->hotels->count() > 0)
                    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm mb-12">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                                <i class="bi bi-buildings text-indigo-600"></i> Stay Options (Hotels)
                            </h2>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                            @foreach($destination->hotels as $hotel)
                            <a href="{{ route('hotels.show', $hotel) }}" class="group relative aspect-square overflow-hidden rounded-2xl bg-slate-100 border border-slate-200 shadow-lg block">
                                <img src="{{ $hotel->image }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110" alt="{{ $hotel->name }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent opacity-90"></div>
                                
                                <div class="absolute top-3 right-3 px-2 py-1 bg-white/20 backdrop-blur-md rounded-lg text-white text-[10px] font-bold border border-white/30">
                                    ₹{{ number_format($hotel->price_per_night) }}
                                </div>

                                <div class="absolute bottom-0 left-0 w-full p-4">
                                    <div class="flex items-center gap-1.5 text-amber-400 text-[10px] font-bold mb-1">
                                        <i class="bi bi-star-fill"></i> {{ $hotel->rating }}
                                    </div>
                                    <h4 class="font-bold text-white text-xs sm:text-sm tracking-wide mb-1 line-clamp-1">{{ $hotel->name }}</h4>
                                    <p class="text-[10px] text-slate-300 line-clamp-1 opacity-0 group-hover:opacity-100 transition duration-300">View details & book stay</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Rate Your Experience CTA -->
                    <div class="relative overflow-hidden rounded-3xl bg-teal-600 p-8 sm:p-12 text-white shadow-xl mb-12 group">
                        <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-3xl group-hover:scale-125 transition duration-700"></div>
                        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                            <div class="text-center md:text-left">
                                <h2 class="text-3xl font-extrabold mb-2 text-white">Explore complete?</h2>
                                <p class="text-teal-50/80">Help other travelers by sharing your experience at {{ $destination->name }}.</p>
                            </div>
                            <button onclick="document.getElementById('review-form').scrollIntoView({ behavior: 'smooth' })" class="px-8 py-4 bg-white text-teal-600 font-extrabold rounded-2xl hover:bg-teal-50 transition shadow-lg whitespace-nowrap">
                                <i class="bi bi-star-fill"></i> Rate your Trip
                            </button>
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-2">
                            <i class="bi bi-chat-quote text-teal-600"></i> Traveler Reviews
                        </h2>

                        <!-- Write Review Box -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm mb-8">
                            @auth
                                <form method="POST" action="{{ route('destinations.reviews.store', $destination) }}">
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
                                        <textarea name="comment" rows="3" class="block w-full p-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition placeholder:text-slate-400" placeholder="What did you love about this place?" required></textarea>
                                    </div>

                                    <button type="submit" class="px-6 py-2.5 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition shadow-sm">
                                        Post Review
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
                            @forelse($destination->reviews as $review)
                                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-teal-100 text-teal-700 rounded-full flex items-center justify-center font-bold text-lg">
                                                {{ substr($review->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-slate-900">{{ $review->user->name }}</h4>
                                                <div class="flex text-amber-400 text-xs mt-0.5">
                                                    @for($i = 0; $i < $review->rating; $i++)
                                                        <i class="bi bi-star-fill"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-slate-600 text-sm">{{ $review->comment }}</p>
                                </div>
                            @empty
                                <div class="text-center py-10 bg-slate-100 rounded-2xl border border-slate-200 border-dashed">
                                    <p class="text-slate-500">No reviews yet. Be the first to share your experience!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sticky Sidebar -->
                <div class="lg:w-1/3">
                    <div class="sticky top-28 space-y-8">
                        

                        <!-- Guides Widget -->
                        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                            <div class="bg-teal-600 p-5">
                                <h3 class="font-bold text-white flex items-center gap-2">
                                    <i class="bi bi-person-badge"></i> Local Guides
                                </h3>
                            </div>
                            <div class="p-4 space-y-3">
                                @forelse($destination->guides as $guide)
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-bold text-slate-900 text-sm">{{ $guide->name }}</h4>
                                            <span class="bg-teal-100 text-teal-800 text-[10px] font-bold px-2 py-0.5 rounded-full">₹{{ $guide->fee_per_day }}/day</span>
                                        </div>
                                        <p class="text-xs text-slate-500 mb-3"><i class="bi bi-translate"></i> {{ $guide->languages }}</p>
                                        <a href="tel:{{ $guide->phone }}" class="block w-full py-2 text-center text-xs font-bold text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition shadow-sm">
                                            <i class="bi bi-telephone-fill"></i> Contact Guide
                                        </a>
                                    </div>
                                @empty
                                    <div class="text-center text-sm text-slate-500">No guides available.</div>
                                @endforelse
                            </div>
                        </div>

                        <!-- CTA to Smart Planner -->
                        <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-6 text-center text-white shadow-xl relative overflow-hidden">
                            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
                            <i class="bi bi-magic text-3xl text-teal-400 mb-3 block"></i>
                            <h3 class="font-bold text-lg mb-2">Want to bundle everything?</h3>
                            <p class="text-slate-300 text-sm mb-6">Use the Smart Trip Planner to book your destination, hotel, and guide in one click.</p>
                            <a href="{{ route('trips.create', ['destination_id' => $destination->id]) }}" class="inline-block w-full py-3 bg-teal-500 text-white font-bold rounded-xl hover:bg-teal-400 transition shadow-lg shadow-teal-900/50">
                                Start Planning
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
