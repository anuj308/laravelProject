@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-900 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    
    <!-- Admin Decorative Background -->
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-rose-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

    <div class="max-w-md w-full space-y-8 bg-slate-800/80 backdrop-blur-xl p-10 rounded-3xl shadow-2xl border border-slate-700 relative z-10">
        <div>
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-rose-500/10 text-rose-500 rounded-2xl flex items-center justify-center text-3xl shadow-sm border border-rose-500/20">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
            </div>
            <h2 class="text-center text-3xl font-extrabold text-white tracking-tight">
                Admin Portal
            </h2>
            <p class="mt-2 text-center text-sm text-slate-400">
                Authorized personnel only
            </p>
        </div>
        
        <form class="mt-8 space-y-6" method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-300 mb-1">Admin Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-envelope text-slate-500"></i>
                        </div>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}" class="block w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition focus:bg-slate-900 placeholder:text-slate-600" placeholder="admin@omnitrek.com">
                    </div>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-bold text-slate-300 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-key-fill text-slate-500"></i>
                        </div>
                        <input id="password" name="password" type="password" required class="block w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition focus:bg-slate-900 placeholder:text-slate-600" placeholder="••••••••">
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full py-3.5 bg-rose-600 text-white font-bold rounded-xl hover:bg-rose-500 hover:shadow-[0_0_20px_rgba(225,29,72,0.3)] transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    Access Dashboard
                </button>
            </div>
            
            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-xs font-semibold text-slate-500 hover:text-slate-300 transition"><i class="bi bi-arrow-left"></i> Back to User Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
