<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
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

    public function create()
    {
        $this->checkAdmin();

        return view('destinations.create');
    }

    public function store(Request $request)
    {
        $this->checkAdmin();

        Destination::create($this->validatedData($request));

        return redirect()->route('destinations.index')->with('success', 'Destination added successfully.');
    }

    public function show(Destination $destination)
    {
        $destination->load(['hotels', 'guides', 'packages', 'reviews.user']);

        return view('destinations.show', compact('destination'));
    }

    public function edit(Destination $destination)
    {
        $this->checkAdmin();

        return view('destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $this->checkAdmin();

        $destination->update($this->validatedData($request));

        return redirect()->route('destinations.show', $destination)->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        $this->checkAdmin();
        $destination->delete();

        return redirect()->route('destinations.index')->with('success', 'Destination deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'max:255'],
            'location' => ['required', 'max:255'],
            'image' => ['nullable', 'url'],
            'description' => ['required'],
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
        ]);
    }

    private function checkAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->isAdmin(), 403);
    }
}
