<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\LocalGuide;
use App\Models\Trip;
use App\Models\TravelPackage;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Trip Planner page dikhao.
     *
     * Agar user ne destination + dates already select ki hain (GET params se),
     * toh us destination ke available options bhi dikhao.
     */
    public function create(Request $request)
    {
        // Saari destinations dropdown ke liye
        $destinations = Destination::orderBy('name')->get();

        // Yeh variables tabhi fill honge jab user ne Step 1 submit kiya ho
        $selectedDestination = null;
        $availableHotels     = collect();
        $availablePackages   = collect();
        $availableGuides     = collect();

        // Agar destination_id URL mein hai, matlab user ne Step 1 complete kiya hai
        if ($request->filled('destination_id')) {
            $selectedDestination = Destination::find($request->destination_id);

            if ($selectedDestination) {
                // Us destination ke liye available options fetch karo
                $availableHotels   = Hotel::where('destination_id', $selectedDestination->id)
                                          ->where('available_rooms', '>', 0)
                                          ->get();
                $availablePackages = TravelPackage::where('destination_id', $selectedDestination->id)->get();
                $availableGuides   = LocalGuide::where('destination_id', $selectedDestination->id)->get();
            }
        }

        return view('trips.planner', compact(
            'destinations',
            'selectedDestination',
            'availableHotels',
            'availablePackages',
            'availableGuides'
        ));
    }

    /**
     * Trip save karo aur total price calculate karo.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'destination_id'     => ['required', 'exists:destinations,id'],
            'travel_date'        => ['required', 'date', 'after_or_equal:today'],
            'people'             => ['required', 'integer', 'min:1', 'max:20'],
            'nights'             => ['required', 'integer', 'min:1', 'max:30'],
            'hotel_id'           => ['nullable', 'exists:hotels,id'],
            'travel_package_id'  => ['nullable', 'exists:travel_packages,id'],
            'local_guide_id'     => ['nullable', 'exists:local_guides,id'],
            'notes'              => ['nullable', 'string', 'max:500'],
        ]);

        // Ab total price calculate karte hain — har component ka cost jodenge
        $total = 0;

        if ($data['hotel_id']) {
            $hotel  = Hotel::find($data['hotel_id']);
            // Hotel cost = price per night × nights × log count
            $total += $hotel->price_per_night * $data['nights'] * $data['people'];
        }

        if ($data['travel_package_id']) {
            $package = TravelPackage::find($data['travel_package_id']);
            // Package cost = price per person
            $total  += $package->price * $data['people'];
        }

        if ($data['local_guide_id']) {
            $guide  = LocalGuide::find($data['local_guide_id']);
            // Guide cost = fee per day × number of nights (guide poore trip mein rehta hai)
            $total += $guide->fee_per_day * $data['nights'];
        }

        // Sab data ek saath save karo
        Trip::create([
            'user_id'           => auth()->id(),
            'destination_id'    => $data['destination_id'],
            'hotel_id'          => $data['hotel_id'] ?? null,
            'travel_package_id' => $data['travel_package_id'] ?? null,
            'local_guide_id'    => $data['local_guide_id'] ?? null,
            'travel_date'       => $data['travel_date'],
            'people'            => $data['people'],
            'nights'            => $data['nights'],
            'total_price'       => $total,
            'notes'             => $data['notes'] ?? null,
        ]);

        return redirect()->route('trips.index')->with('success', 'Trip plan ho gayi! Enjoy your journey 🎒');
    }

    /**
     * User ki saari trips dikhao.
     */
    public function index()
    {
        // Sirf logged in user ki trips — dusron ki nahi
        $trips = Trip::with(['destination', 'hotel', 'travelPackage', 'localGuide'])
                     ->where('user_id', auth()->id())
                     ->latest()
                     ->get();

        return view('trips.index', compact('trips'));
    }

    /**
     * User apni trip cancel kar sakta hai.
     */
    public function destroy(Trip $trip)
    {
        // Security check — koi doosra user kisi ki trip cancel na kar sake
        if ($trip->user_id !== auth()->id()) {
            abort(403, 'Yeh tumhari trip nahi hai.');
        }

        $trip->update(['status' => 'cancelled']);

        return back()->with('success', 'Trip cancel ho gayi.');
    }
}
