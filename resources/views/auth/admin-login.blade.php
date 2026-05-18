@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-4 text-center">Admin Login</h1>

                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Admin Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="admin@tourease.test" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="••••••" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-success w-100">Login as Admin</button>
                        </form>
                    </div>
                </div>

                {{-- Demo ke liye credentials dikhana --}}
                <div class="alert alert-info mt-3 small">
                    <strong>Demo:</strong> Email: <code>admin@tourease.test</code> | Password: <code>password</code>
                </div>
            </div>
        </div>
    </div>
@endsection
