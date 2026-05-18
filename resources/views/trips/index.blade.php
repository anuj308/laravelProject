@extends('layouts.app')

@section('title', 'My Trips')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">My Planned Trips</h1>
            <a href="{{ route('trips.create') }}" class="btn btn-success">Plan New Trip</a>
        </div>

        <div class="row g-4">
            @forelse($trips as $trip)
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 {{ $trip->status === 'cancelled' ? 'border-danger' : 'border-success' }}">
                        <div class="card-header d-flex justify-content-between align-items-center {{ $trip->status === 'cancelled' ? 'bg-danger text-white' : 'bg-success text-white' }}">
                            <h2 class="h5 mb-0">Trip to {{ $trip->destination->name }}</h2>
                            <span class="badge bg-light text-dark">{{ ucfirst($trip->status) }}</span>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><strong>Date:</strong> {{ \Carbon\Carbon::parse($trip->travel_date)->format('d M, Y') }} ({{ $trip->nights }} Nights)</p>
                            <p class="mb-3"><strong>People:</strong> {{ $trip->people }}</p>
                            
                            <hr>
                            <h3 class="h6 text-muted mb-2">Trip Inclusions:</h3>
                            <ul class="list-unstyled mb-3">
                                <li><i class="bi bi-building"></i> Hotel: {{ $trip->hotel ? $trip->hotel->name : 'N/A' }}</li>
                                <li><i class="bi bi-briefcase"></i> Package: {{ $trip->travelPackage ? $trip->travelPackage->title : 'N/A' }}</li>
                                <li><i class="bi bi-person-badge"></i> Guide: {{ $trip->localGuide ? $trip->localGuide->name : 'N/A' }}</li>
                            </ul>
                            
                            <div class="d-flex justify-content-between align-items-end mt-4">
                                <div>
                                    <span class="text-muted small d-block">Total Cost</span>
                                    <span class="fs-4 fw-bold">₹{{ number_format($trip->total_price) }}</span>
                                </div>
                                
                                @if($trip->status !== 'cancelled')
                                    <form method="POST" action="{{ route('trips.destroy', $trip) }}">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this trip?')">Cancel Trip</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted mb-3">Abhi tak koi trip plan nahi ki hai.</p>
                    <a href="{{ route('trips.create') }}" class="btn btn-outline-success">Start Planning Now</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
