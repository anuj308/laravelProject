@extends('layouts.app')

@section('title', 'Edit Transport')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">Edit Transport</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('transports.update', $transport) }}" method="POST">
                    @method('PATCH')
                    @include('transports.form', ['transport' => $transport])
                    <button class="btn btn-success mt-3">Update Transport</button>
                </form>
            </div>
        </div>
    </div>
@endsection
