@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-3">Add Destination</h1>
        <div class="card"><div class="card-body">
            <form method="POST" action="{{ route('destinations.store') }}">
                @include('destinations.form')
            </form>
        </div></div>
    </div>
@endsection
