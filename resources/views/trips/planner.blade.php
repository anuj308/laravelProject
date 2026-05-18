@extends('layouts.app')

@section('title', 'Smart Trip Planner')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-success">Smart Trip Planner</h1>
            <p class="lead text-muted">Ek jagah pe destination, hotel, package, aur guide book karo.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                {{-- Step 1: Destination & Dates (Always visible) --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h2 class="h5 mb-0 py-2">Step 1: Kahan Jaana Hai?</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('trips.create') }}" method="GET" class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Destination</label>
                                <select name="destination_id" class="form-select" required>
                                    <option value="">-- Select Destination --</option>
                                    @foreach($destinations as $dest)
                                        <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>
                                            {{ $dest->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-outline-success">Show Options</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Step 2: Build Trip (Visible only if destination selected) --}}
                @if($selectedDestination)
                    <div class="card shadow-sm border-success">
                        <div class="card-header bg-success text-white">
                            <h2 class="h5 mb-0 py-2">Step 2: Trip Build Karo ({{ $selectedDestination->name }})</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('trips.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="destination_id" value="{{ $selectedDestination->id }}">

                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label">Travel Date</label>
                                        <input type="date" name="travel_date" class="form-control" required min="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Kitne Log (People)?</label>
                                        <input type="number" name="people" class="form-control" value="1" min="1" max="20" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Kitni Raatein (Nights)?</label>
                                        <input type="number" name="nights" class="form-control" value="1" min="1" max="30" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Hotel (Optional)</label>
                                    <select name="hotel_id" class="form-select">
                                        <option value="">-- Hotel nahi chahiye --</option>
                                        @foreach($availableHotels as $hotel)
                                            <option value="{{ $hotel->id }}">{{ $hotel->name }} (₹{{ $hotel->price_per_night }} / night)</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Travel Package (Optional)</label>
                                    <select name="travel_package_id" class="form-select">
                                        <option value="">-- Package nahi chahiye --</option>
                                        @foreach($availablePackages as $package)
                                            <option value="{{ $package->id }}">{{ $package->title }} (₹{{ $package->price }} / person)</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Local Guide (Optional)</label>
                                    <select name="local_guide_id" class="form-select">
                                        <option value="">-- Guide nahi chahiye --</option>
                                        @foreach($availableGuides as $guide)
                                            <option value="{{ $guide->id }}">{{ $guide->name }} (₹{{ $guide->fee_per_day }} / day)</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Special Notes (Optional)</label>
                                    <textarea name="notes" class="form-control" rows="2" placeholder="Koi specific demand?"></textarea>
                                </div>

                                <button type="submit" class="btn btn-success w-100 btn-lg">Book Complete Trip</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
