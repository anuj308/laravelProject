<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\HotelBooking;
use App\Models\PackageBooking;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // Public — hotels ki list with advanced search filters
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

    // Admin — create hotel
    public function create()
    {
        return view('hotels.create', ['destinations' => Destination::orderBy('name')->get()]);
    }

    // Admin — store hotel
    public function store(Request $request)
    {
        Hotel::create($this->validatedData($request));
        return redirect()->route('hotels.index')->with('success', 'Hotel add ho gaya.');
    }

    // Public — hotel detail page
    public function show(Hotel $hotel)
    {
        $hotel->load(['destination', 'reviews.user']);
        return view('hotels.show', compact('hotel'));
    }

    // Admin — edit hotel
    public function edit(Hotel $hotel)
    {
        return view('hotels.edit', [
            'hotel'        => $hotel,
            'destinations' => Destination::orderBy('name')->get(),
        ]);
    }

    // Admin — update hotel
    public function update(Request $request, Hotel $hotel)
    {
        $hotel->update($this->validatedData($request));
        return redirect()->route('hotels.show', $hotel)->with('success', 'Hotel details update ho gaye.');
    }

    // Admin — delete hotel
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'Hotel delete ho gaya.');
    }

    // Logged-in user — hotel book karna
    public function book(Request $request, Hotel $hotel)
    {
        // Security check handled by route middleware now, abort_unless is redundant if middleware is used, but we keep validation
        $data = $request->validate([
            'check_in'  => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'rooms'     => ['required', 'integer', 'min:1'],
        ]);

        // Room availability check karo booking se pehle
        if ($data['rooms'] > $hotel->available_rooms) {
            return back()->with('error', 'Sorry, sirf '.$hotel->available_rooms.' rooms available hain.');
        }

        $nights = now()->parse($data['check_in'])->diffInDays(now()->parse($data['check_out']));
        $total  = $nights * $data['rooms'] * $hotel->price_per_night;

        // DB mein booking save karo
        HotelBooking::create([
            'user_id'     => auth()->id(),
            'hotel_id'    => $hotel->id,
            'check_in'    => $data['check_in'],
            'check_out'   => $data['check_out'],
            'rooms'       => $data['rooms'],
            'total_price' => $total,
        ]);

        // Available rooms ko kam karo
        $hotel->decrement('available_rooms', $data['rooms']);

        return redirect()->route('bookings.history')->with('success', 'Hotel successfully book ho gaya.');
    }

    // User ki booking history
    public function history()
    {
        $hotelBookings   = HotelBooking::with('hotel')->where('user_id', auth()->id())->latest()->get();
        $packageBookings = PackageBooking::with('travelPackage')->where('user_id', auth()->id())->latest()->get();
        $transportBookings = \App\Models\TransportBooking::with('transport')->where('user_id', auth()->id())->latest()->get();

        return view('bookings.history', compact('hotelBookings', 'packageBookings', 'transportBookings'));
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'destination_id'  => ['nullable', 'exists:destinations,id'],
            'name'            => ['required', 'max:255'],
            'location'        => ['required', 'max:255'],
            'image'           => ['nullable', 'url'],
            'description'     => ['required'],
            'price_per_night' => ['required', 'numeric', 'min:1'],
            'available_rooms' => ['required', 'integer', 'min:0'],
            'rating'          => ['required', 'numeric', 'min:0', 'max:5'],
        ]);
    }
}
