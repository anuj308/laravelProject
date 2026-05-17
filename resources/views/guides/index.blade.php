@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-3">Local Guides</h1>
        <div class="row g-4">
            @foreach($guides as $guide)
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h2 class="h5">{{ $guide->name }}</h2>
                            <p class="text-muted">{{ $guide->destination?->name }}</p>
                            <p>Languages: {{ $guide->languages }}</p>
                            <p>Fee: ₹{{ number_format($guide->fee_per_day) }}/day</p>
                            <p class="rating">{{ $guide->rating }}/5</p>
                            <a class="btn btn-success btn-sm" href="mailto:{{ $guide->email }}">Contact Guide</a>
                            <a class="btn btn-outline-dark btn-sm" href="tel:{{ $guide->phone }}">Call</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $guides->links() }}</div>
    </div>
@endsection
