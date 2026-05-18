@extends('layouts.app')

@section('title', 'Guides')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Local Guides</h1>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('guides.create') }}" class="btn btn-success">Add New Guide</a>
                @endif
            @endauth
        </div>

        <div class="row g-4">
            @forelse($guides as $guide)
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0 bg-white">
                        <div class="card-body">
                            <h3 class="h5 mb-1">{{ $guide->name }}</h3>
                            <p class="text-muted small mb-2"><i class="bi bi-geo-alt"></i> {{ $guide->destination->name ?? 'Anywhere' }}</p>
                            
                            <div class="mb-3">
                                <span class="badge bg-light text-dark border">{{ $guide->languages }}</span>
                            </div>
                            
                            <p class="mb-1"><small class="text-muted">Fee:</small> ₹{{ number_format($guide->fee_per_day) }} / day</p>
                            <p class="mb-3"><small class="text-muted">Rating:</small> <span class="rating">{{ $guide->rating }}/5</span></p>

                            @auth
                                @if(auth()->user()->isAdmin())
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('guides.edit', $guide) }}" class="btn btn-outline-dark btn-sm flex-fill">Edit</a>
                                        <form method="POST" action="{{ route('guides.destroy', $guide) }}" class="flex-fill">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm w-100">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <p>Koi local guide nahi mila.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-4">
            {{ $guides->links() }}
        </div>
    </div>
@endsection
