@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-3">Add Travel Package</h1>
        <div class="card"><div class="card-body">
            <form method="POST" action="{{ route('packages.store') }}">
                @include('packages.form')
            </form>
        </div></div>
    </div>
@endsection
