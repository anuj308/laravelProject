@extends('layouts.app')

@section('title', 'Local Guides')

@section('content')
    <div class="bg-slate-50 min-h-screen pb-24">
        <!-- Header Section -->
        <div class="bg-white border-b border-slate-200 pt-16 pb-12 mb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                            <i class="bi bi-person-badge text-teal-600"></i> Local Experts
                        </h1>
                        <p class="text-slate-500 mt-2 text-lg">Discover the hidden gems with our verified local guides.</p>
                    </div>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('guides.create') }}" class="px-5 py-2.5 bg-slate-900 text-white font-semibold rounded-xl hover:bg-slate-800 transition shadow-sm flex items-center gap-2">
                                <i class="bi bi-plus-lg"></i> Add Guide
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <!-- Guides Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($guides as $guide)
                    <div class="group bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                        
                        <!-- Top Accent -->
                        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-teal-400 to-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        
                        <!-- Header: Name & Location -->
                        <div class="mb-5 flex items-start gap-4">
                            <div class="w-14 h-14 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl group-hover:bg-teal-50 group-hover:text-teal-600 transition-colors shrink-0">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 leading-tight mb-1 group-hover:text-teal-700 transition">{{ $guide->name }}</h3>
                                <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider flex items-center gap-1">
                                    <i class="bi bi-geo-alt-fill text-teal-500"></i> {{ $guide->destination->name ?? 'Global' }}
                                </p>
                            </div>
                        </div>
                        
                        <!-- Details -->
                        <div class="space-y-4 mb-6">
                            <div>
                                <div class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-1.5">Languages</div>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach(explode(',', $guide->languages) as $lang)
                                        <span class="px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg text-xs font-semibold">{{ trim($lang) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl border border-slate-100">
                                <div>
                                    <div class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-0.5">Daily Fee</div>
                                    <div class="font-bold text-slate-900">₹{{ number_format($guide->fee_per_day) }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-0.5">Rating</div>
                                    <div class="font-bold text-amber-500 flex items-center gap-1 justify-end">
                                        {{ $guide->rating }} <i class="bi bi-star-fill text-xs"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Actions -->
                        @auth
                            @if(auth()->user()->isAdmin())
                                <div class="pt-4 border-t border-slate-100 flex gap-2">
                                    <a href="{{ route('guides.edit', $guide) }}" class="flex-1 py-2 text-center text-sm font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg hover:bg-slate-100 transition">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('guides.destroy', $guide) }}" class="flex-1" onsubmit="return confirm('Delete this guide?');">
                                        @csrf @method('DELETE')
                                        <button class="w-full py-2 text-center text-sm font-bold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg hover:bg-rose-100 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                        
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-slate-200">
                        <div class="w-20 h-20 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                            <i class="bi bi-person-x"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">No guides available</h3>
                        <p class="text-slate-500">We couldn't find any local experts at the moment.</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="mt-12">
                {{ $guides->links() }}
            </div>
        </div>
    </div>
@endsection
