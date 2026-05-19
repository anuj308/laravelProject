@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="bg-slate-50 min-h-screen pb-24">
    <!-- Header Section -->
    <div class="bg-slate-900 border-b border-slate-800 pt-16 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h1 class="text-3xl font-bold text-white tracking-tight flex items-center gap-3">
                        <i class="bi bi-speedometer2 text-teal-400"></i> Platform Overview
                    </h1>
                    <p class="text-slate-400 mt-2 text-sm">Monitor activity and manage resources.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('destinations.create') }}" class="px-4 py-2 bg-white/10 text-white text-sm font-semibold rounded-lg hover:bg-white/20 transition backdrop-blur-md border border-white/10 flex items-center gap-1.5"><i class="bi bi-plus-circle"></i> Destination</a>
                    <a href="{{ route('hotels.create') }}" class="px-4 py-2 bg-white/10 text-white text-sm font-semibold rounded-lg hover:bg-white/20 transition backdrop-blur-md border border-white/10 flex items-center gap-1.5"><i class="bi bi-plus-circle"></i> Hotel</a>
                    <a href="{{ route('packages.create') }}" class="px-4 py-2 bg-white/10 text-white text-sm font-semibold rounded-lg hover:bg-white/20 transition backdrop-blur-md border border-white/10 flex items-center gap-1.5"><i class="bi bi-plus-circle"></i> Package</a>
                    <a href="{{ route('guides.create') }}" class="px-4 py-2 bg-white/10 text-white text-sm font-semibold rounded-lg hover:bg-white/20 transition backdrop-blur-md border border-white/10 flex items-center gap-1.5"><i class="bi bi-plus-circle"></i> Guide</a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10">
        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Trips</div>
                <div class="text-2xl font-black text-slate-900">{{ $tripsCount }}</div>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Users</div>
                <div class="text-2xl font-black text-slate-900">{{ $usersCount }}</div>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Destinations</div>
                <div class="text-2xl font-black text-slate-900">{{ $destinationsCount }}</div>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Hotels</div>
                <div class="text-2xl font-black text-slate-900">{{ $hotelsCount }}</div>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Hotel Bookings</div>
                <div class="text-2xl font-black text-slate-900">{{ $hotelBookingsCount }}</div>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 border-b-4 border-b-teal-500">
                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Pkg Bookings</div>
                <div class="text-2xl font-black text-slate-900">{{ $packageBookingsCount }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Recent Trips -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-lg font-bold text-slate-900">Recent Trip Plans</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">User</th>
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Destination</th>
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Dates</th>
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Total Price</th>
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($recentTrips as $trip)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="py-4 px-6 text-sm font-semibold text-slate-900">{{ $trip->user->name }}</td>
                                        <td class="py-4 px-6 text-sm text-slate-600">{{ $trip->destination->name }}</td>
                                        <td class="py-4 px-6 text-sm text-slate-600">{{ \Carbon\Carbon::parse($trip->travel_date)->format('d M, Y') }} <span class="text-slate-400">({{ $trip->nights }}N)</span></td>
                                        <td class="py-4 px-6 text-sm font-bold text-slate-900">₹{{ number_format($trip->total_price) }}</td>
                                        <td class="py-4 px-6 text-sm">
                                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold uppercase tracking-wider {{ $trip->status === 'cancelled' ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }}">
                                                {{ $trip->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-8 text-center text-slate-500 text-sm">No recent trips found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Hotel Bookings -->
            <div>
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-lg font-bold text-slate-900">Recent Hotel Bookings</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">User</th>
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Hotel</th>
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($recentHotelBookings as $booking)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="py-4 px-6 text-sm font-semibold text-slate-900">{{ $booking->user->name }}</td>
                                        <td class="py-4 px-6 text-sm text-slate-600">{{ $booking->hotel->name }}</td>
                                        <td class="py-4 px-6 text-sm">
                                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold uppercase tracking-wider {{ $booking->status === 'cancelled' ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }}">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-sm">
                                            @if($booking->status !== 'cancelled')
                                                <form method="POST" action="{{ route('admin.hotel-bookings.cancel', $booking) }}">
                                                    @csrf @method('PATCH')
                                                    <button class="text-xs font-bold text-rose-600 hover:text-rose-800 bg-rose-50 px-3 py-1.5 rounded-lg transition">Cancel</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Recent Package Bookings -->
            <div>
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-lg font-bold text-slate-900">Recent Package Bookings</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">User</th>
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Package</th>
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                    <th class="py-3 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($recentPackageBookings as $booking)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="py-4 px-6 text-sm font-semibold text-slate-900">{{ $booking->user->name }}</td>
                                        <td class="py-4 px-6 text-sm text-slate-600 line-clamp-1">{{ $booking->travelPackage->title }}</td>
                                        <td class="py-4 px-6 text-sm">
                                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold uppercase tracking-wider {{ $booking->status === 'cancelled' ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }}">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-sm">
                                            @if($booking->status !== 'cancelled')
                                                <form method="POST" action="{{ route('admin.package-bookings.cancel', $booking) }}">
                                                    @csrf @method('PATCH')
                                                    <button class="text-xs font-bold text-rose-600 hover:text-rose-800 bg-rose-50 px-3 py-1.5 rounded-lg transition">Cancel</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Users -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-900">Manage Users</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Name</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Email</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Role</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-4 px-6 text-sm font-semibold text-slate-900">{{ $user->name }}</td>
                                <td class="py-4 px-6 text-sm text-slate-600">{{ $user->email }}</td>
                                <td class="py-4 px-6 text-sm">
                                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold uppercase tracking-wider {{ $user->isAdmin() ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-sm">
                                    @if($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                            @csrf @method('DELETE')
                                            <button class="text-xs font-bold text-rose-600 hover:text-rose-800 bg-rose-50 px-3 py-1.5 rounded-lg transition" onclick="return confirm('Delete this user permanently?')">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
