@extends('layouts.app')

@section('title', 'Smart Trip Planner')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-sm font-semibold mb-4 border border-teal-100">
                <i class="bi bi-stars"></i> Smart Feature
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 tracking-tight mb-4">Plan Your Perfect Trip</h1>
            <p class="text-lg text-slate-500 max-w-2xl mx-auto">Book your destination, stay, activities, and local guide all in one seamless experience.</p>
        </div>

        <div class="space-y-8">
            {{-- Step 1: Destination & Dates (Always visible) --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="bg-slate-50/50 px-8 py-5 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-teal-100 text-teal-700 text-sm">1</span>
                        Where are you heading?
                    </h2>
                </div>
                <div class="p-8">
                    <form action="{{ route('trips.create') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
                        <div class="w-full">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Select Destination</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="bi bi-geo-alt text-slate-400"></i>
                                </div>
                                <select name="destination_id" class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors appearance-none" required onchange="this.form.submit()">
                                    <option value="">-- Choose a location --</option>
                                    @foreach($destinations as $dest)
                                        <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>
                                            {{ $dest->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <i class="bi bi-chevron-down text-slate-400 text-sm"></i>
                                </div>
                            </div>
                        </div>
                        <noscript>
                            <button type="submit" class="px-6 py-3 bg-slate-800 text-white rounded-xl font-medium hover:bg-slate-700 transition w-full sm:w-auto">Select</button>
                        </noscript>
                    </form>
                </div>
            </div>

            {{-- Step 2: Build Trip (Visible only if destination selected) --}}
            @if($selectedDestination)
                <div class="bg-white rounded-3xl shadow-xl border border-teal-100 overflow-hidden ring-1 ring-teal-500/5 transition-all duration-500 animate-in fade-in slide-in-from-bottom-4">
                    <div class="bg-gradient-to-r from-teal-600 to-emerald-500 px-8 py-6">
                        <h2 class="text-xl font-bold text-white flex items-center gap-3">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-white/20 text-white text-sm backdrop-blur-sm">2</span>
                            Customize your {{ $selectedDestination->name }} trip
                        </h2>
                    </div>
                    <div class="p-8">
                        <form action="{{ route('trips.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="destination_id" value="{{ $selectedDestination->id }}">

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Travel Date</label>
                                    <input type="date" name="travel_date" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition" required min="{{ date('Y-m-d') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Travelers</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="bi bi-people text-slate-400"></i></div>
                                        <input type="number" name="people" class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition" value="1" min="1" max="20" required>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Nights</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="bi bi-moon text-slate-400"></i></div>
                                        <input type="number" name="nights" class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition" value="1" min="1" max="30" required>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6 mb-8">
                                <div class="p-5 border border-slate-100 rounded-2xl bg-slate-50/50 hover:bg-slate-50 transition">
                                    <label class="block text-sm font-bold text-slate-800 mb-3 flex items-center gap-2"><i class="bi bi-building text-teal-600"></i> Select Hotel (Optional)</label>
                                    <select name="hotel_id" class="block w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                        <option value="">-- I don't need a hotel --</option>
                                        @foreach($availableHotels as $hotel)
                                            <option value="{{ $hotel->id }}">{{ $hotel->name }} (₹{{ number_format($hotel->price_per_night) }} / night)</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="p-5 border border-slate-100 rounded-2xl bg-slate-50/50 hover:bg-slate-50 transition">
                                    <label class="block text-sm font-bold text-slate-800 mb-3 flex items-center gap-2"><i class="bi bi-briefcase text-teal-600"></i> Select Travel Package (Optional)</label>
                                    <select name="travel_package_id" class="block w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                        <option value="">-- I don't need a package --</option>
                                        @foreach($availablePackages as $package)
                                            <option value="{{ $package->id }}">{{ $package->title }} (₹{{ number_format($package->price) }} / person)</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="p-5 border border-slate-100 rounded-2xl bg-slate-50/50 hover:bg-slate-50 transition">
                                    <label class="block text-sm font-bold text-slate-800 mb-3 flex items-center gap-2"><i class="bi bi-person-badge text-teal-600"></i> Select Local Guide (Optional)</label>
                                    <select name="local_guide_id" class="block w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                        <option value="">-- I don't need a guide --</option>
                                        @foreach($availableGuides as $guide)
                                            <option value="{{ $guide->id }}">{{ $guide->name }} (₹{{ number_format($guide->fee_per_day) }} / day)</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-800 mb-2">Special Requests</label>
                                    <textarea name="notes" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition" rows="2" placeholder="Any specific dietary requirements or preferences?"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="w-full py-4 bg-slate-900 text-white text-lg font-bold rounded-xl hover:bg-slate-800 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 flex justify-center items-center gap-2">
                                Confirm & Book Complete Trip <i class="bi bi-check2-circle"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
