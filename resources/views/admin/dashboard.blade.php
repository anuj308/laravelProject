@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">Admin Dashboard</h1>

        <div class="row g-3 mb-4">
            <div class="col-md"><div class="card"><div class="card-body"><strong>{{ $usersCount }}</strong><br>Users</div></div></div>
            <div class="col-md"><div class="card"><div class="card-body"><strong>{{ $destinationsCount }}</strong><br>Destinations</div></div></div>
            <div class="col-md"><div class="card"><div class="card-body"><strong>{{ $hotelsCount }}</strong><br>Hotels</div></div></div>
            <div class="col-md"><div class="card"><div class="card-body"><strong>{{ $hotelBookingsCount }}</strong><br>Hotel Bookings</div></div></div>
            <div class="col-md"><div class="card"><div class="card-body"><strong>{{ $packageBookingsCount }}</strong><br>Package Bookings</div></div></div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <h2 class="h5">Recent Hotel Bookings</h2>
                <div class="table-responsive bg-white border rounded">
                    <table class="table mb-0">
                        <thead><tr><th>User</th><th>Hotel</th><th>Status</th><th></th></tr></thead>
                        <tbody>
                            @foreach($recentHotelBookings as $booking)
                                <tr>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->hotel->name }}</td>
                                    <td>{{ ucfirst($booking->status) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.hotel-bookings.cancel', $booking) }}">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-outline-danger btn-sm">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="h5">Recent Package Bookings</h2>
                <div class="table-responsive bg-white border rounded">
                    <table class="table mb-0">
                        <thead><tr><th>User</th><th>Package</th><th>Status</th><th></th></tr></thead>
                        <tbody>
                            @foreach($recentPackageBookings as $booking)
                                <tr>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->travelPackage->title }}</td>
                                    <td>{{ ucfirst($booking->status) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.package-bookings.cancel', $booking) }}">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-outline-danger btn-sm">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h2 class="h5 mt-4">Manage Users</h2>
        <div class="table-responsive bg-white border rounded">
            <table class="table mb-0">
                <thead><tr><th>Name</th><th>Email</th><th>Role</th><th></th></tr></thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                @if($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
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
