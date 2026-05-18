@extends('layouts.app')

@section('title', 'Add Transport')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">Add Transport</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('transports.store') }}" method="POST">
                    @include('transports.form')
                    <button class="btn btn-success mt-3">Save Transport</button>
                </form>
            </div>
        </div>
    </div>
@endsection
