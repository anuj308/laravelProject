<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Admin login form dikhana
    public function showLogin()
    {
        // Agar pehle se logged in hai toh seedha dashboard pe bhejo
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin-login');
    }

    // Admin login process karna
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Normal Auth::attempt use karo — same as user login, sirf role check alag hai
        if (Auth::attempt($credentials)) {
            // Login toh ho gaya, ab check karo ki yeh actually admin hai
            if (!auth()->user()->isAdmin()) {
                Auth::logout();
                return back()->withErrors(['email' => 'Yeh account admin nahi hai.']);
            }

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Admin login successful.');
        }

        return back()->withErrors(['email' => 'Email ya password galat hai.'])->onlyInput('email');
    }
}
