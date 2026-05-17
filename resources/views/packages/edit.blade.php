@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-3">Edit Travel Package</h1>
        <div class="card"><div class="card-body">
            <form method="POST" action="{{ route('packages.update', $package) }}">
                @method('PUT')
                @include('packages.form')
            </form>
        </div></div>
    </div>
@endsection
