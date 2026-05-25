@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-3">My Booking History</h1>
        <h2 class="h5">Hotel Bookings</h2>
        <div class="table-responsive bg-white border rounded">
            <table class="table mb-0">
                <thead><tr><th>Hotel</th><th>Dates</th><th>Rooms</th><th>Total</th><th>Status</th></tr></thead>
                <tbody>
                    @forelse($hotelBookings as $booking)
                        <tr>
                            <td>{{ $booking->hotel->name }}</td>
                            <td>{{ $booking->check_in }} to {{ $booking->check_out }}</td>
                            <td>{{ $booking->rooms }}</td>
                            <td>₹{{ number_format($booking->total_price) }}</td>
                            <td>{{ ucfirst($booking->status) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No hotel bookings yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h2 class="h5 mt-4">Package Bookings</h2>
        <div class="table-responsive bg-white border rounded">
            <table class="table mb-0">
                <thead><tr><th>Package</th><th>Travel Date</th><th>People</th><th>Total</th><th>Status</th></tr></thead>
                <tbody>
                    @forelse($packageBookings as $booking)
                        <tr>
                            <td>{{ $booking->travelPackage->title }}</td>
                            <td>{{ $booking->travel_date }}</td>
                            <td>{{ $booking->people }}</td>
                            <td>₹{{ number_format($booking->total_price) }}</td>
                            <td>{{ ucfirst($booking->status) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No package bookings yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h2 class="h5 mt-4">Transport & Cab Bookings</h2>
        <div class="table-responsive bg-white border rounded">
            <table class="table mb-0">
                <thead><tr><th>Transport</th><th>Travel Date</th><th>People</th><th>Total</th><th>Status</th></tr></thead>
                <tbody>
                    @forelse($transportBookings as $booking)
                        <tr>
                            <td>{{ $booking->transport->provider }} ({{ $booking->transport->type }})</td>
                            <td>{{ $booking->travel_date }}</td>
                            <td>{{ $booking->people }}</td>
                            <td>₹{{ number_format($booking->total_price) }}</td>
                            <td>{{ ucfirst($booking->status) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No transport bookings yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
