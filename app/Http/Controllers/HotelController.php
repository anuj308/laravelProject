<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\HotelBooking;
use App\Models\PackageBooking;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $hotels = Hotel::with('destination')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->when($request->location, fn ($query, $location) => $query->where('location', 'like', "%{$location}%"))
            ->when($request->max_price, fn ($query, $price) => $query->where('price_per_night', '<=', $price))
            ->when($request->rating, fn ($query, $rating) => $query->where('rating', '>=', $rating))
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('hotels.index', compact('hotels'));
    }

    public function create()
    {
        $this->checkAdmin();

        return view('hotels.create', ['destinations' => Destination::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        Hotel::create($this->validatedData($request));

        return redirect()->route('hotels.index')->with('success', 'Hotel added successfully.');
    }

    public function show(Hotel $hotel)
    {
        $hotel->load(['destination', 'reviews.user']);

        return view('hotels.show', compact('hotel'));
    }

    public function edit(Hotel $hotel)
    {
        $this->checkAdmin();

        return view('hotels.edit', [
            'hotel' => $hotel,
            'destinations' => Destination::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Hotel $hotel)
    {
        $this->checkAdmin();
        $hotel->update($this->validatedData($request));

        return redirect()->route('hotels.show', $hotel)->with('success', 'Hotel updated successfully.');
    }

    public function destroy(Hotel $hotel)
    {
        $this->checkAdmin();
        $hotel->delete();

        return redirect()->route('hotels.index')->with('success', 'Hotel deleted successfully.');
    }

    public function book(Request $request, Hotel $hotel)
    {
        abort_unless(auth()->check(), 403);

        $data = $request->validate([
            'check_in' => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'rooms' => ['required', 'integer', 'min:1'],
        ]);

        // Check if rooms are available before booking.
        if ($data['rooms'] > $hotel->available_rooms) {
            return back()->with('error', 'Sorry, only '.$hotel->available_rooms.' rooms are available.');
        }

        $nights = now()->parse($data['check_in'])->diffInDays(now()->parse($data['check_out']));
        $total = $nights * $data['rooms'] * $hotel->price_per_night;

        // Save hotel booking details in database.
        HotelBooking::create([
            'user_id' => auth()->id(),
            'hotel_id' => $hotel->id,
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
            'rooms' => $data['rooms'],
            'total_price' => $total,
        ]);

        $hotel->decrement('available_rooms', $data['rooms']);

        return redirect()->route('bookings.history')->with('success', 'Hotel booked successfully.');
    }

    public function history()
    {
        abort_unless(auth()->check(), 403);

        $hotelBookings = HotelBooking::with('hotel')->where('user_id', auth()->id())->latest()->get();
        $packageBookings = PackageBooking::with('travelPackage')->where('user_id', auth()->id())->latest()->get();

        return view('bookings.history', compact('hotelBookings', 'packageBookings'));
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'destination_id' => ['nullable', 'exists:destinations,id'],
            'name' => ['required', 'max:255'],
            'location' => ['required', 'max:255'],
            'image' => ['nullable', 'url'],
            'description' => ['required'],
            'price_per_night' => ['required', 'numeric', 'min:1'],
            'available_rooms' => ['required', 'integer', 'min:0'],
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
        ]);
    }

    private function checkAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->isAdmin(), 403);
    }
}
