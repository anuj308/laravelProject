@extends('layouts.app')

@section('title', 'Add Guide')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">Add Local Guide</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('guides.store') }}" method="POST">
                    @include('guides.form')
                    <button class="btn btn-success mt-3">Save Guide</button>
                </form>
            </div>
        </div>
    </div>
@endsection
