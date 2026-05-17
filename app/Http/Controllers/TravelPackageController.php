<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\PackageBooking;
use App\Models\TravelPackage;
use Illuminate\Http\Request;

class TravelPackageController extends Controller
{
    public function index()
    {
        return view('packages.index', [
            'packages' => TravelPackage::with('destination')->latest()->paginate(6),
        ]);
    }

    public function create()
    {
        $this->checkAdmin();

        return view('packages.create', ['destinations' => Destination::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        TravelPackage::create($this->validatedData($request));

        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    public function show(TravelPackage $package)
    {
        $package->load('destination');

        return view('packages.show', compact('package'));
    }

    public function edit(TravelPackage $package)
    {
        $this->checkAdmin();

        return view('packages.edit', [
            'package' => $package,
            'destinations' => Destination::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, TravelPackage $package)
    {
        $this->checkAdmin();
        $package->update($this->validatedData($request));

        return redirect()->route('packages.show', $package)->with('success', 'Package updated successfully.');
    }

    public function destroy(TravelPackage $package)
    {
        $this->checkAdmin();
        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }

    public function book(Request $request, TravelPackage $package)
    {
        abort_unless(auth()->check(), 403);

        $data = $request->validate([
            'travel_date' => ['required', 'date', 'after_or_equal:today'],
            'people' => ['required', 'integer', 'min:1'],
        ]);

        // Calculate package cost based on number of tourists.
        PackageBooking::create([
            'user_id' => auth()->id(),
            'travel_package_id' => $package->id,
            'travel_date' => $data['travel_date'],
            'people' => $data['people'],
            'total_price' => $package->price * $data['people'],
        ]);

        return redirect()->route('packages.index')->with('success', 'Package booked successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'destination_id' => ['nullable', 'exists:destinations,id'],
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'price' => ['required', 'numeric', 'min:1'],
            'duration_days' => ['required', 'integer', 'min:1'],
            'image' => ['nullable', 'url'],
        ]);
    }

    private function checkAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->isAdmin(), 403);
    }
}
