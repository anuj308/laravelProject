@extends('layouts.app')

@section('title', 'Transport Directory')

@section('content')
    <div class="bg-slate-50 min-h-screen pb-24">
        
        <!-- Header Section -->
        <div class="bg-white border-b border-slate-200 pt-16 pb-12 mb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                            <i class="bi bi-signpost-split text-teal-600"></i> Transport Routes
                        </h1>
                        <p class="text-slate-500 mt-2 text-lg">Find the best flights, trains, cabs, and buses for your journey.</p>
                    </div>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('transports.create') }}" class="px-5 py-2.5 bg-slate-900 text-white font-semibold rounded-xl hover:bg-slate-800 transition shadow-sm flex items-center gap-2">
                                <i class="bi bi-plus-lg"></i> Add Route
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <!-- Transports Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($transports as $transport)
                    @php
                        // Determine styling and icon based on transport type
                        $type = strtolower($transport->type);
                        $icon = 'bi-geo-alt';
                        $colorClass = 'text-slate-600 bg-slate-100';
                        $borderClass = 'group-hover:border-slate-300';
                        
                        if (str_contains($type, 'flight') || str_contains($type, 'air')) {
                            $icon = 'bi-airplane-engines';
                            $colorClass = 'text-sky-600 bg-sky-50';
                            $borderClass = 'group-hover:border-sky-300';
                        } elseif (str_contains($type, 'train') || str_contains($type, 'rail')) {
                            $icon = 'bi-train-front';
                            $colorClass = 'text-rose-600 bg-rose-50';
                            $borderClass = 'group-hover:border-rose-300';
                        } elseif (str_contains($type, 'bus')) {
                            $icon = 'bi-bus-front';
                            $colorClass = 'text-emerald-600 bg-emerald-50';
                            $borderClass = 'group-hover:border-emerald-300';
                        } elseif (str_contains($type, 'cab') || str_contains($type, 'taxi') || str_contains($type, 'car')) {
                            $icon = 'bi-car-front';
                            $colorClass = 'text-amber-600 bg-amber-50';
                            $borderClass = 'group-hover:border-amber-300';
                        }
                    @endphp

                    <div class="group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 {{ $borderClass }} flex flex-col overflow-hidden relative">
                        
                        <!-- Top Banner -->
                        <div class="p-6 border-b border-slate-100 flex justify-between items-start bg-gradient-to-b from-slate-50/50 to-white">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-inner {{ $colorClass }}">
                                    <i class="bi {{ $icon }}"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-0.5">{{ $transport->type }}</span>
                                    <h3 class="font-bold text-slate-900 text-lg">{{ $transport->provider }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Main Content -->
                        <div class="p-6 flex-grow flex flex-col justify-center">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                                <div class="flex-1 border-t-2 border-dashed border-slate-200 relative">
                                    <i class="bi bi-chevron-right absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-slate-300 text-xs bg-white px-1"></i>
                                </div>
                                <div class="w-2 h-2 rounded-full bg-teal-500"></div>
                            </div>
                            <h2 class="text-xl font-extrabold text-slate-800 text-center leading-tight mb-2">
                                {{ $transport->route }}
                            </h2>
                            <div class="text-center text-slate-500 text-sm font-medium flex items-center justify-center gap-2">
                                <i class="bi bi-clock"></i> Departs: <span class="text-slate-700">{{ $transport->departure_time }}</span>
                            </div>
                        </div>

                        <!-- Bottom Section -->
                        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-between items-center mt-auto">
                            <div>
                                <div class="text-xs font-bold text-slate-400 uppercase tracking-wide">Availability</div>
                                <div class="font-bold text-slate-800 flex items-center gap-1.5">
                                    <i class="bi bi-person-fill text-teal-600"></i> {{ $transport->available_seats }} Seats
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs font-bold text-slate-400 uppercase tracking-wide">Fare</div>
                                <div class="text-2xl font-black text-teal-700 tracking-tight">₹{{ number_format($transport->price) }}</div>
                            </div>
                        </div>

                        <!-- Admin Actions overlay on hover -->
                        @auth
                            @if(auth()->user()->isAdmin())
                                <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3">
                                    <a href="{{ route('transports.edit', $transport) }}" class="px-4 py-2 bg-white text-slate-900 font-bold rounded-lg shadow hover:bg-slate-100 transition">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('transports.destroy', $transport) }}" method="POST" onsubmit="return confirm('Delete this route?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white font-bold rounded-lg shadow hover:bg-red-600 transition">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-slate-200">
                        <div class="w-20 h-20 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                            <i class="bi bi-signpost"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">No routes available</h3>
                        <p class="text-slate-500">We currently don't have any transport options listed.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $transports->links() }}
            </div>
        </div>
    </div>
@endsection
