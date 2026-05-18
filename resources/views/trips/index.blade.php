@extends('layouts.app')

@section('title', 'My Trips')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">My Planned Trips</h1>
                <p class="text-slate-500 mt-1">Manage and view all your upcoming and past journeys.</p>
            </div>
            <a href="{{ route('trips.create') }}" class="px-6 py-2.5 rounded-xl bg-teal-600 text-white font-medium hover:bg-teal-700 hover:shadow-md hover:-translate-y-0.5 transition-all flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Plan New Trip
            </a>
        </div>

        @if($trips->isEmpty())
            <div class="bg-white rounded-3xl border border-slate-200 p-16 text-center shadow-sm">
                <div class="w-20 h-20 bg-teal-50 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="bi bi-map"></i>
                </div>
                <h2 class="text-xl font-bold text-slate-800 mb-2">No trips planned yet</h2>
                <p class="text-slate-500 max-w-md mx-auto mb-8">You haven't planned any trips with TourEase. Start planning today and explore the world effortlessly.</p>
                <a href="{{ route('trips.create') }}" class="inline-block px-8 py-3 rounded-xl bg-slate-900 text-white font-semibold hover:bg-slate-800 transition shadow-sm">
                    Start Planning Now
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($trips as $trip)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition group {{ $trip->status === 'cancelled' ? 'opacity-75' : '' }}">
                        <div class="p-6 {{ $trip->status === 'cancelled' ? 'bg-rose-50' : 'bg-slate-50' }} border-b border-slate-100 flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900 group-hover:text-teal-700 transition">Trip to {{ $trip->destination->name }}</h2>
                                <p class="text-slate-500 text-sm mt-1 flex items-center gap-1.5">
                                    <i class="bi bi-calendar-event text-slate-400"></i> {{ \Carbon\Carbon::parse($trip->travel_date)->format('M d, Y') }} &middot; {{ $trip->nights }} Nights
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold tracking-wide uppercase 
                                {{ $trip->status === 'cancelled' ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ $trip->status }}
                            </span>
                        </div>
                        
                        <div class="p-6">
                            <div class="mb-6">
                                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-3">Inclusions</h3>
                                <ul class="space-y-3">
                                    <li class="flex items-center gap-3 text-slate-700">
                                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center"><i class="bi bi-building"></i></div>
                                        <span class="flex-1">{{ $trip->hotel ? $trip->hotel->name : 'No Hotel Selected' }}</span>
                                    </li>
                                    <li class="flex items-center gap-3 text-slate-700">
                                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center"><i class="bi bi-briefcase"></i></div>
                                        <span class="flex-1">{{ $trip->travelPackage ? $trip->travelPackage->title : 'No Package Selected' }}</span>
                                    </li>
                                    <li class="flex items-center gap-3 text-slate-700">
                                        <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center"><i class="bi bi-person-badge"></i></div>
                                        <span class="flex-1">{{ $trip->localGuide ? $trip->localGuide->name : 'No Local Guide' }}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="pt-6 border-t border-slate-100 flex justify-between items-end">
                                <div>
                                    <div class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Total Cost ({{ $trip->people }} Travelers)</div>
                                    <div class="text-2xl font-bold text-slate-900">₹{{ number_format($trip->total_price) }}</div>
                                </div>
                                
                                @if($trip->status !== 'cancelled')
                                    <form method="POST" action="{{ route('trips.destroy', $trip) }}">
                                        @csrf @method('DELETE')
                                        <button class="px-4 py-2 text-sm font-semibold text-rose-600 bg-rose-50 rounded-lg hover:bg-rose-100 transition" onclick="return confirm('Are you sure you want to cancel this trip?')">Cancel Trip</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
