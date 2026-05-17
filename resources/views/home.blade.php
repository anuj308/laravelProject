@extends('layouts.app')

@section('content')
    <section class="hero py-5">
        <div class="container py-5">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold">TourEase</h1>
                <p class="lead">Discover destinations, book hotels, explore travel packages, contact local guides, and plan a smoother trip from one simple tourism platform.</p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('destinations.index') }}" class="btn btn-success">Explore Destinations</a>
                    <a href="{{ route('hotels.index') }}" class="btn btn-light">Book Hotels</a>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 mb-0">Popular Destinations</h2>
            <a href="{{ route('destinations.index') }}" class="btn btn-sm btn-outline-success">View all</a>
        </div>
        <div class="row g-4">
            @foreach($destinations as $destination)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $destination->image }}" class="card-img-top" alt="{{ $destination->name }}">
                        <div class="card-body">
                            <h3 class="h5">{{ $destination->name }}</h3>
                            <p class="text-muted mb-1">{{ $destination->location }}</p>
                            <p class="rating">Rating {{ $destination->rating }}/5</p>
                            <a href="{{ route('destinations.show', $destination) }}" class="btn btn-success btn-sm">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="container pb-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <h2 class="h4 mb-3">Recommended Hotels</h2>
                <div class="row g-3">
                    @foreach($hotels as $hotel)
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h3 class="h5">{{ $hotel->name }}</h3>
                                    <p class="text-muted">{{ $hotel->location }}</p>
                                    <p class="mb-2">₹{{ number_format($hotel->price_per_night) }} per night</p>
                                    <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-outline-success btn-sm">Book now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <h2 class="h4 mb-3">Transport Availability</h2>
                <div class="list-group">
                    @foreach($transports as $transport)
                        <div class="list-group-item">
                            <strong>{{ $transport->type }}</strong> - {{ $transport->route }}<br>
                            <span class="small text-muted">{{ $transport->provider }} at {{ $transport->departure_time }} | {{ $transport->available_seats }} seats</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
