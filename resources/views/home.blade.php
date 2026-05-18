@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="hero py-5 text-center text-lg-start">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-warning text-dark mb-2 px-3 py-2">NEW FEATURE</span>
                    <h1 class="display-4 fw-bold">Smart Trip Planner</h1>
                    <p class="lead mb-4">Ab alag-alag websites pe time waste mat karo. Destination, Hotel, Travel Package, aur Local Guide sab kuch ek hi jagah pe book karo.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('trips.create') }}" class="btn btn-success btn-lg">Plan Your Trip Now <i class="bi bi-arrow-right"></i></a>
                        <a href="{{ route('destinations.index') }}" class="btn btn-light btn-lg">Explore Destinations</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0">Popular Destinations</h2>
            <a href="{{ route('destinations.index') }}" class="btn btn-sm btn-outline-success">View all</a>
        </div>
        <div class="row g-4">
            @foreach($destinations as $destination)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $destination->image }}" class="card-img-top" alt="{{ $destination->name }}">
                        <div class="card-body">
                            <h3 class="h5">{{ $destination->name }}</h3>
                            <p class="text-muted small mb-2"><i class="bi bi-geo-alt"></i> {{ $destination->location }}</p>
                            <p class="rating mb-3"><i class="bi bi-star-fill"></i> {{ $destination->rating }}/5</p>
                            <a href="{{ route('destinations.show', $destination) }}" class="btn btn-success btn-sm w-100">View Details</a>
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
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <h3 class="h5 mb-1">{{ $hotel->name }}</h3>
                                    <p class="text-muted small mb-2"><i class="bi bi-geo-alt"></i> {{ $hotel->location }}</p>
                                    <p class="mb-3 fw-bold text-success">₹{{ number_format($hotel->price_per_night) }} <small class="text-muted fw-normal">/ night</small></p>
                                    <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-outline-dark btn-sm w-100">Book Room</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h4 mb-0">Transports</h2>
                    <a href="{{ route('transports.index') }}" class="btn btn-sm btn-outline-secondary">All</a>
                </div>
                <div class="list-group shadow-sm">
                    @foreach($transports as $transport)
                        <div class="list-group-item list-group-item-action py-3 border-0 border-bottom">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><i class="bi bi-bus-front"></i> {{ $transport->type }}</h6>
                                <small class="fw-bold text-success">₹{{ $transport->price }}</small>
                            </div>
                            <p class="mb-1 small">{{ $transport->route }}</p>
                            <small class="text-muted">{{ $transport->provider }} | {{ \Carbon\Carbon::parse($transport->departure_time)->format('h:i A') }}</small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
