@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Travel Packages</h1>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('packages.create') }}" class="btn btn-success">Add Package</a>
                @endif
            @endauth
        </div>
        <div class="row g-4">
            @foreach($packages as $package)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $package->image }}" class="card-img-top" alt="{{ $package->title }}">
                        <div class="card-body">
                            <h2 class="h5">{{ $package->title }}</h2>
                            <p class="text-muted">{{ $package->destination?->name }}</p>
                            <p>{{ str($package->description)->limit(90) }}</p>
                            <p><strong>₹{{ number_format($package->price) }}</strong> | {{ $package->duration_days }} days</p>
                            <a href="{{ route('packages.show', $package) }}" class="btn btn-success btn-sm">View Package</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $packages->links() }}</div>
    </div>
@endsection
