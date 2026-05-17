@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-lg-7">
                <img src="{{ $package->image }}" class="img-fluid rounded mb-3" alt="{{ $package->title }}">
                <h1>{{ $package->title }}</h1>
                <p class="text-muted">{{ $package->destination?->name }} | {{ $package->duration_days }} days</p>
                <p>{{ $package->description }}</p>
                <p><strong>₹{{ number_format($package->price) }}</strong> per person</p>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('packages.edit', $package) }}" class="btn btn-outline-dark btn-sm">Edit</a>
                        <form class="d-inline" method="POST" action="{{ route('packages.destroy', $package) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h4">Book Package</h2>
                        @auth
                            <form method="POST" action="{{ route('packages.book', $package) }}">
                                @csrf
                                <label class="form-label">Travel Date</label>
                                <input name="travel_date" type="date" class="form-control mb-2" required>
                                <label class="form-label">People</label>
                                <input name="people" type="number" min="1" class="form-control mb-3" required>
                                <button class="btn btn-success w-100">Book Package</button>
                            </form>
                        @else
                            <p><a href="{{ route('login') }}">Login</a> to book this package.</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
