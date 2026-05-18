<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    // Public — destinations ki list dikhana (search filters ke saath)
    public function index(Request $request)
    {
        $destinations = Destination::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->when($request->location, fn ($query, $location) => $query->where('location', 'like', "%{$location}%"))
            ->when($request->rating, fn ($query, $rating) => $query->where('rating', '>=', $rating))
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('destinations.index', compact('destinations'));
    }

    // Admin — naya destination create karna
    public function create()
    {
        return view('destinations.create');
    }

    // Admin — save destination to DB
    public function store(Request $request)
    {
        Destination::create($this->validatedData($request));
        return redirect()->route('destinations.index')->with('success', 'Destination add ho gayi.');
    }

    // Public — single destination detail page
    public function show(Destination $destination)
    {
        $destination->load(['hotels', 'guides', 'packages', 'reviews.user']);
        return view('destinations.show', compact('destination'));
    }

    // Admin — destination edit karna
    public function edit(Destination $destination)
    {
        return view('destinations.edit', compact('destination'));
    }

    // Admin — destination details update karna
    public function update(Request $request, Destination $destination)
    {
        $destination->update($this->validatedData($request));
        return redirect()->route('destinations.show', $destination)->with('success', 'Destination update ho gayi.');
    }

    // Admin — destination delete karna
    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('destinations.index')->with('success', 'Destination remove ho gayi.');
    }

    // Validation rules
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name'        => ['required', 'max:255'],
            'location'    => ['required', 'max:255'],
            'image'       => ['nullable', 'url'], // Future upgrade: image upload add karna chahiye
            'description' => ['required'],
            'rating'      => ['required', 'numeric', 'min:0', 'max:5'],
        ]);
    }
}
