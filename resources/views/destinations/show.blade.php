@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-lg-7">
                <img src="{{ $destination->image }}" class="img-fluid rounded mb-3" alt="{{ $destination->name }}">
                <h1>{{ $destination->name }}</h1>
                <p class="text-muted">{{ $destination->location }} | <span class="rating">{{ $destination->rating }}/5</span></p>
                <p>{{ $destination->description }}</p>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('destinations.edit', $destination) }}" class="btn btn-outline-dark btn-sm">Edit</a>
                        <form class="d-inline" method="POST" action="{{ route('destinations.destroy', $destination) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
            <div class="col-lg-5">
                <h2 class="h4">Local Options</h2>
                <div class="list-group mb-4">
                    @foreach($destination->hotels as $hotel)
                        <a class="list-group-item list-group-item-action" href="{{ route('hotels.show', $hotel) }}">{{ $hotel->name }} - ₹{{ number_format($hotel->price_per_night) }}</a>
                    @endforeach
                    @foreach($destination->guides as $guide)
                        <div class="list-group-item">Guide: {{ $guide->name }} | {{ $guide->phone }}</div>
                    @endforeach
                </div>

                <h2 class="h4">Add Review</h2>
                @auth
                    <form method="POST" action="{{ route('destinations.reviews.store', $destination) }}" class="mb-4">
                        @csrf
                        <select name="rating" class="form-select mb-2" required>
                            <option value="">Select rating</option>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <textarea name="comment" class="form-control mb-2" rows="3" placeholder="Write your experience" required></textarea>
                        <button class="btn btn-success btn-sm">Submit Review</button>
                    </form>
                @else
                    <p><a href="{{ route('login') }}">Login</a> to review this destination.</p>
                @endauth

                @foreach($destination->reviews as $review)
                    <div class="border-bottom py-2">
                        <strong>{{ $review->user->name }}</strong> rated {{ $review->rating }}/5
                        <p class="mb-0">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
