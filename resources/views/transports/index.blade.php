@extends('layouts.app')

@section('title', 'Transports')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Transport Options</h1>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('transports.create') }}" class="btn btn-success">Add New Transport</a>
                @endif
            @endauth
        </div>

        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Type</th>
                                <th>Route</th>
                                <th>Provider</th>
                                <th>Departure Time</th>
                                <th>Available Seats</th>
                                <th>Price (₹)</th>
                                @auth
                                    @if(auth()->user()->isAdmin())
                                        <th class="text-end">Actions</th>
                                    @endif
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transports as $transport)
                                <tr>
                                    <td><strong>{{ $transport->type }}</strong></td>
                                    <td>{{ $transport->route }}</td>
                                    <td>{{ $transport->provider }}</td>
                                    <td>{{ $transport->departure_time }}</td>
                                    <td>{{ $transport->available_seats }}</td>
                                    <td>₹{{ number_format($transport->price, 2) }}</td>
                                    @auth
                                        @if(auth()->user()->isAdmin())
                                            <td class="text-end">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('transports.edit', $transport) }}" class="btn btn-outline-dark">Edit</a>
                                                    <form action="{{ route('transports.destroy', $transport) }}" method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    @endauth
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Koi transport options nahi mile.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $transports->links() }}
        </div>
    </div>
@endsection
