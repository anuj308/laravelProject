@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Destinations</h1>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('destinations.create') }}" class="btn btn-success">Add Destination</a>
                @endif
            @endauth
        </div>

        <form class="row g-2 mb-4">
            <div class="col-md-4"><input name="search" value="{{ request('search') }}" class="form-control" placeholder="Search destination or location"></div>
            <div class="col-md-3"><input name="location" value="{{ request('location') }}" class="form-control" placeholder="Filter location"></div>
            <div class="col-md-3"><input name="rating" value="{{ request('rating') }}" type="number" step="0.1" min="0" max="5" class="form-control" placeholder="Minimum rating"></div>
            <div class="col-md-2"><button class="btn btn-dark w-100">Search</button></div>
        </form>

        <div class="row g-4">
            @forelse($destinations as $destination)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $destination->image }}" class="card-img-top" alt="{{ $destination->name }}">
                        <div class="card-body">
                            <h2 class="h5">{{ $destination->name }}</h2>
                            <p class="text-muted">{{ $destination->location }}</p>
                            <p>{{ str($destination->description)->limit(95) }}</p>
                            <p class="rating">{{ $destination->rating }}/5</p>
                            <a href="{{ route('destinations.show', $destination) }}" class="btn btn-success btn-sm">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No destinations found.</p>
            @endforelse
        </div>

        <div class="mt-4">{{ $destinations->links() }}</div>
    </div>
@endsection
