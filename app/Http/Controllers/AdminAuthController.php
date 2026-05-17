<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        // Keep admin login separate from the normal user email login.
        if ($data['username'] === 'admin' && $data['password'] === 'admin') {
            $admin = User::where('email', 'admin')->first() ?? User::where('role', 'admin')->first();

            if ($admin) {
                $admin->update([
                    'name' => 'TourEase Admin',
                    'email' => 'admin',
                    'password' => Hash::make('admin'),
                    'role' => 'admin',
                ]);
            } else {
                $admin = User::create([
                    'name' => 'TourEase Admin',
                    'email' => 'admin',
                    'password' => Hash::make('admin'),
                    'role' => 'admin',
                ]);
            }

            Auth::login($admin);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('success', 'Admin logged in successfully.');
        }

        return back()->withErrors([
            'username' => 'Admin username or password is incorrect.',
        ])->onlyInput('username');
    }
}
