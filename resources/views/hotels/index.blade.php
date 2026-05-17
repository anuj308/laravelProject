@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Hotels</h1>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('hotels.create') }}" class="btn btn-success">Add Hotel</a>
                @endif
            @endauth
        </div>

        <form class="row g-2 mb-4">
            <div class="col-md-3"><input name="search" value="{{ request('search') }}" class="form-control" placeholder="Search hotel"></div>
            <div class="col-md-3"><input name="location" value="{{ request('location') }}" class="form-control" placeholder="Location"></div>
            <div class="col-md-2"><input name="max_price" value="{{ request('max_price') }}" type="number" class="form-control" placeholder="Max price"></div>
            <div class="col-md-2"><input name="rating" value="{{ request('rating') }}" type="number" step="0.1" class="form-control" placeholder="Rating"></div>
            <div class="col-md-2"><button class="btn btn-dark w-100">Filter</button></div>
        </form>

        <div class="row g-4">
            @foreach($hotels as $hotel)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $hotel->image }}" class="card-img-top" alt="{{ $hotel->name }}">
                        <div class="card-body">
                            <h2 class="h5">{{ $hotel->name }}</h2>
                            <p class="text-muted">{{ $hotel->location }}</p>
                            <p>₹{{ number_format($hotel->price_per_night) }} per night</p>
                            <p>{{ $hotel->available_rooms }} rooms available | <span class="rating">{{ $hotel->rating }}/5</span></p>
                            <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-success btn-sm">View & Book</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $hotels->links() }}</div>
    </div>
@endsection
