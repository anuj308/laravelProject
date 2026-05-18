@extends('layouts.app')

@section('title', 'Edit Guide')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">Edit Local Guide: {{ $guide->name }}</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('guides.update', $guide) }}" method="POST">
                    @method('PATCH')
                    @include('guides.form', ['guide' => $guide])
                    <button class="btn btn-success mt-3">Update Guide</button>
                </form>
            </div>
        </div>
    </div>
@endsection
