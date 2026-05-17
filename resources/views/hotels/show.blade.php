@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-lg-7">
                <img src="{{ $hotel->image }}" class="img-fluid rounded mb-3" alt="{{ $hotel->name }}">
                <h1>{{ $hotel->name }}</h1>
                <p class="text-muted">{{ $hotel->location }} | <span class="rating">{{ $hotel->rating }}/5</span></p>
                <p>{{ $hotel->description }}</p>
                <p><strong>₹{{ number_format($hotel->price_per_night) }}</strong> per night | {{ $hotel->available_rooms }} rooms available</p>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('hotels.edit', $hotel) }}" class="btn btn-outline-dark btn-sm">Edit</a>
                        <form class="d-inline" method="POST" action="{{ route('hotels.destroy', $hotel) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
            <div class="col-lg-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="h4">Book Room</h2>
                        @auth
                            <form method="POST" action="{{ route('hotels.book', $hotel) }}">
                                @csrf
                                <label class="form-label">Check In</label>
                                <input name="check_in" type="date" class="form-control mb-2" required>
                                <label class="form-label">Check Out</label>
                                <input name="check_out" type="date" class="form-control mb-2" required>
                                <label class="form-label">Rooms</label>
                                <input name="rooms" type="number" min="1" class="form-control mb-3" required>
                                <button class="btn btn-success w-100">Book Hotel</button>
                            </form>
                        @else
                            <p><a href="{{ route('login') }}">Login</a> to book this hotel.</p>
                        @endauth
                    </div>
                </div>

                <h2 class="h4">Reviews</h2>
                @auth
                    <form method="POST" action="{{ route('hotels.reviews.store', $hotel) }}" class="mb-3">
                        @csrf
                        <select name="rating" class="form-select mb-2" required>
                            <option value="">Select rating</option>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <textarea name="comment" rows="3" class="form-control mb-2" placeholder="Share your stay experience" required></textarea>
                        <button class="btn btn-outline-success btn-sm">Add Review</button>
                    </form>
                @endauth
                @foreach($hotel->reviews as $review)
                    <div class="border-bottom py-2">
                        <strong>{{ $review->user->name }}</strong> rated {{ $review->rating }}/5
                        <p class="mb-0">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
