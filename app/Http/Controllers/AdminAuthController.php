<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Admin login is kept separate from normal user email login.
        $credentials = [
            'email' => $data['username'],
            'password' => $data['password'],
            'role' => 'admin',
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('success', 'Admin logged in successfully.');
        }

        return back()->withErrors([
            'username' => 'Admin username or password is incorrect.',
        ])->onlyInput('username');
    }
}
