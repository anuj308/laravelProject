@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Admin Dashboard</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('destinations.create') }}" class="btn btn-outline-success btn-sm"><i class="bi bi-plus-circle"></i> Destination</a>
                <a href="{{ route('hotels.create') }}" class="btn btn-outline-success btn-sm"><i class="bi bi-plus-circle"></i> Hotel</a>
                <a href="{{ route('packages.create') }}" class="btn btn-outline-success btn-sm"><i class="bi bi-plus-circle"></i> Package</a>
                <a href="{{ route('guides.create') }}" class="btn btn-outline-success btn-sm"><i class="bi bi-plus-circle"></i> Guide</a>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md"><div class="card bg-success text-white shadow-sm border-0"><div class="card-body"><strong>{{ $tripsCount }}</strong><br>Total Trips</div></div></div>
            <div class="col-md"><div class="card shadow-sm border-0"><div class="card-body"><strong>{{ $usersCount }}</strong><br>Users</div></div></div>
            <div class="col-md"><div class="card shadow-sm border-0"><div class="card-body"><strong>{{ $destinationsCount }}</strong><br>Destinations</div></div></div>
            <div class="col-md"><div class="card shadow-sm border-0"><div class="card-body"><strong>{{ $hotelsCount }}</strong><br>Hotels</div></div></div>
            <div class="col-md"><div class="card shadow-sm border-0"><div class="card-body"><strong>{{ $hotelBookingsCount }}</strong><br>Hotel Bookings</div></div></div>
            <div class="col-md"><div class="card shadow-sm border-0"><div class="card-body"><strong>{{ $packageBookingsCount }}</strong><br>Package Bookings</div></div></div>
        </div>

        <div class="row g-4">
            <div class="col-lg-12">
                <h2 class="h5">Recent Trip Plans</h2>
                <div class="table-responsive bg-white shadow-sm border-0 rounded">
                    <table class="table table-hover mb-0">
                        <thead class="table-light"><tr><th>User</th><th>Destination</th><th>Dates</th><th>Total Price</th><th>Status</th></tr></thead>
                        <tbody>
                            @forelse($recentTrips as $trip)
                                <tr>
                                    <td>{{ $trip->user->name }}</td>
                                    <td>{{ $trip->destination->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($trip->travel_date)->format('d M, Y') }} ({{ $trip->nights }} Nights)</td>
                                    <td>₹{{ number_format($trip->total_price) }}</td>
                                    <td><span class="badge {{ $trip->status === 'cancelled' ? 'bg-danger' : 'bg-success' }}">{{ ucfirst($trip->status) }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted">Koi recent trip nahi hai.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-6 mt-4">
                <h2 class="h5">Recent Hotel Bookings</h2>
                <div class="table-responsive bg-white shadow-sm border-0 rounded">
                    <table class="table table-hover mb-0">
                        <thead class="table-light"><tr><th>User</th><th>Hotel</th><th>Status</th><th>Actions</th></tr></thead>
                        <tbody>
                            @foreach($recentHotelBookings as $booking)
                                <tr>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->hotel->name }}</td>
                                    <td>{{ ucfirst($booking->status) }}</td>
                                    <td>
                                        @if($booking->status !== 'cancelled')
                                            <form method="POST" action="{{ route('admin.hotel-bookings.cancel', $booking) }}">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-outline-danger btn-sm">Cancel</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-lg-6 mt-4">
                <h2 class="h5">Recent Package Bookings</h2>
                <div class="table-responsive bg-white shadow-sm border-0 rounded">
                    <table class="table table-hover mb-0">
                        <thead class="table-light"><tr><th>User</th><th>Package</th><th>Status</th><th>Actions</th></tr></thead>
                        <tbody>
                            @foreach($recentPackageBookings as $booking)
                                <tr>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->travelPackage->title }}</td>
                                    <td>{{ ucfirst($booking->status) }}</td>
                                    <td>
                                        @if($booking->status !== 'cancelled')
                                            <form method="POST" action="{{ route('admin.package-bookings.cancel', $booking) }}">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-outline-danger btn-sm">Cancel</button>
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

        <h2 class="h5 mt-5">Manage Users</h2>
        <div class="table-responsive bg-white shadow-sm border-0 rounded">
            <table class="table table-hover mb-0">
                <thead class="table-light"><tr><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr></thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge {{ $user->isAdmin() ? 'bg-dark' : 'bg-secondary' }}">{{ ucfirst($user->role) }}</span></td>
                            <td>
                                @if($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Pakka delete karna hai?')">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
