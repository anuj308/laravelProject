@extends('layouts.app')

@section('title', 'Book ' . $transport->type)

@section('content')
<div class="bg-slate-50 min-h-screen py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-xl overflow-hidden relative">
            <div class="absolute top-0 right-0 p-8 opacity-10">
                <i class="bi bi-bus-front text-9xl"></i>
            </div>

            <div class="relative">
                <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-teal-600 transition mb-8">
                    <i class="bi bi-arrow-left"></i> Back to destination
                </a>

                <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Book your {{ $transport->type }}</h1>
                <p class="text-slate-500 mb-8">Confirm your travel details below.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Provider</label>
                        <p class="font-bold text-slate-900">{{ $transport->provider }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Route</label>
                        <p class="font-bold text-slate-900">{{ $transport->route }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Departure</label>
                        <p class="font-bold text-slate-900">{{ $transport->departure_time }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Price per person</label>
                        <p class="font-bold text-teal-600">₹{{ number_format($transport->price) }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('transports.book', $transport) }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Travel Date</label>
                            <input type="date" name="travel_date" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 transition" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Number of People</label>
                            <div class="relative">
                                <select name="people" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 appearance-none transition" required>
                                    @for($i = 1; $i <= min(10, $transport->available_seats); $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ $i > 1 ? 'People' : 'Person' }}</option>
                                    @endfor
                                </select>
                                <i class="bi bi-person absolute right-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-slate-900 text-white font-extrabold rounded-2xl hover:bg-slate-800 transition shadow-lg shadow-slate-900/20">
                        Confirm & Book Now
                    </button>
                </form>

                <p class="mt-6 text-center text-xs text-slate-400">
                    <i class="bi bi-shield-check"></i> Secure booking powered by OmniTrek. 
                    <br>Cancellations are free up to 24 hours before departure.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
