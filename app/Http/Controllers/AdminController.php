<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\HotelBooking;
use App\Models\PackageBooking;
use App\Models\Trip;
use App\Models\User;

class AdminController extends Controller
{
    // Admin dashboard pe main stats dikhana
    public function dashboard()
    {
        return view('admin.dashboard', [
            'usersCount' => User::count(),
            'destinationsCount' => Destination::count(),
            'hotelsCount' => Hotel::count(),
            'hotelBookingsCount' => HotelBooking::count(),
            'packageBookingsCount' => PackageBooking::count(),
            'tripsCount' => Trip::count(), // Trip planner stats bhi add kiye
            'recentHotelBookings' => HotelBooking::with(['user', 'hotel'])->latest()->take(5)->get(),
            'recentPackageBookings' => PackageBooking::with(['user', 'travelPackage'])->latest()->take(5)->get(),
            'recentTrips' => Trip::with(['user', 'destination'])->latest()->take(5)->get(),
            'users' => User::latest()->get(),
        ]);
    }

    // Admin kisi bhi normal user ko delete kar sakta hai
    public function deleteUser(User $user)
    {
        // Khud ka account delete karne se roko
        abort_if($user->id === auth()->id(), 403, 'Admin apna account khud delete nahi kar sakta.');

        $user->delete();

        return back()->with('success', 'User delete ho gaya.');
    }

    // Hotel booking cancel karna
    public function cancelHotelBooking(HotelBooking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Hotel booking cancel ho gayi.');
    }

    // Package booking cancel karna
    public function cancelPackageBooking(PackageBooking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Package booking cancel ho gayi.');
    }
}
