@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    
    <!-- Decorative Background -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-teal-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-emerald-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-xl border border-slate-100 relative z-10">
        <div>
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center text-3xl shadow-sm border border-teal-100">
                    <i class="bi bi-person-plus"></i>
                </div>
            </div>
            <h2 class="text-center text-3xl font-extrabold text-slate-900 tracking-tight">
                Create an account
            </h2>
            <p class="mt-2 text-center text-sm text-slate-500">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-medium text-teal-600 hover:text-teal-500 hover:underline transition">
                    Sign in instead
                </a>
            </p>
        </div>
        
        <form class="mt-8 space-y-6" method="POST" action="{{ url('/register') }}">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-person text-slate-400"></i>
                        </div>
                        <input id="name" name="name" type="text" required value="{{ old('name') }}" class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" placeholder="John Doe">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-1">Email address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-envelope text-slate-400"></i>
                        </div>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}" class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" placeholder="you@example.com">
                    </div>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-shield-lock text-slate-400"></i>
                        </div>
                        <input id="password" name="password" type="password" required class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" placeholder="••••••••">
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-1">Confirm Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-shield-check text-slate-400"></i>
                        </div>
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" placeholder="••••••••">
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full py-3.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    Create Account
                </button>
            </div>
            
            <p class="text-xs text-center text-slate-400 mt-6">
                By signing up, you agree to our Terms of Service and Privacy Policy.
            </p>
        </form>
    </div>
</div>
@endsection
