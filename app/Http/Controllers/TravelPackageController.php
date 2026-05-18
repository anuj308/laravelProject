<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\PackageBooking;
use App\Models\TravelPackage;
use Illuminate\Http\Request;

class TravelPackageController extends Controller
{
    // Public — packages ki list dikhana
    public function index()
    {
        return view('packages.index', [
            'packages' => TravelPackage::with('destination')->latest()->paginate(6),
        ]);
    }

    // Admin — naya package create karna
    public function create()
    {
        return view('packages.create', ['destinations' => Destination::orderBy('name')->get()]);
    }

    // Admin — save package
    public function store(Request $request)
    {
        TravelPackage::create($this->validatedData($request));
        return redirect()->route('packages.index')->with('success', 'Package create ho gaya.');
    }

    // Public — package detail page
    public function show(TravelPackage $package)
    {
        $package->load('destination');
        return view('packages.show', compact('package'));
    }

    // Admin — edit package
    public function edit(TravelPackage $package)
    {
        return view('packages.edit', [
            'package'      => $package,
            'destinations' => Destination::orderBy('name')->get(),
        ]);
    }

    // Admin — update package details
    public function update(Request $request, TravelPackage $package)
    {
        $package->update($this->validatedData($request));
        return redirect()->route('packages.show', $package)->with('success', 'Package update ho gaya.');
    }

    // Admin — delete package
    public function destroy(TravelPackage $package)
    {
        $package->delete();
        return redirect()->route('packages.index')->with('success', 'Package delete ho gaya.');
    }

    // Logged-in user — package book karna
    public function book(Request $request, TravelPackage $package)
    {
        $data = $request->validate([
            'travel_date' => ['required', 'date', 'after_or_equal:today'],
            'people'      => ['required', 'integer', 'min:1'],
        ]);

        // Total cost calculate karna base on logo ki sankhya
        PackageBooking::create([
            'user_id'           => auth()->id(),
            'travel_package_id' => $package->id,
            'travel_date'       => $data['travel_date'],
            'people'            => $data['people'],
            'total_price'       => $package->price * $data['people'],
        ]);

        return redirect()->route('packages.index')->with('success', 'Package successfully book ho gaya.');
    }

    // Validation rules
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'destination_id' => ['nullable', 'exists:destinations,id'],
            'title'          => ['required', 'max:255'],
            'description'    => ['required'],
            'price'          => ['required', 'numeric', 'min:1'],
            'duration_days'  => ['required', 'integer', 'min:1'],
            'image'          => ['nullable', 'url'],
        ]);
    }
}
