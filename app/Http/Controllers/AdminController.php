<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\HotelBooking;
use App\Models\PackageBooking;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $this->checkAdmin();

        return view('admin.dashboard', [
            'usersCount' => User::count(),
            'destinationsCount' => Destination::count(),
            'hotelsCount' => Hotel::count(),
            'hotelBookingsCount' => HotelBooking::count(),
            'packageBookingsCount' => PackageBooking::count(),
            'recentHotelBookings' => HotelBooking::with(['user', 'hotel'])->latest()->take(5)->get(),
            'recentPackageBookings' => PackageBooking::with(['user', 'travelPackage'])->latest()->take(5)->get(),
            'users' => User::latest()->get(),
        ]);
    }

    public function deleteUser(User $user)
    {
        $this->checkAdmin();
        abort_if($user->id === auth()->id(), 403, 'Admin cannot delete own account.');

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    public function cancelHotelBooking(HotelBooking $booking)
    {
        $this->checkAdmin();
        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Hotel booking cancelled.');
    }

    public function cancelPackageBooking(PackageBooking $booking)
    {
        $this->checkAdmin();
        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Package booking cancelled.');
    }

    private function checkAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->isAdmin(), 403);
    }
}
