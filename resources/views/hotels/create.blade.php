@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-3">Add Hotel</h1>
        <div class="card"><div class="card-body">
            <form method="POST" action="{{ route('hotels.store') }}">
                @include('hotels.form')
            </form>
        </div></div>
    </div>
@endsection
