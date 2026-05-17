@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-3">Edit Destination</h1>
        <div class="card"><div class="card-body">
            <form method="POST" action="{{ route('destinations.update', $destination) }}">
                @method('PUT')
                @include('destinations.form')
            </form>
        </div></div>
    </div>
@endsection
