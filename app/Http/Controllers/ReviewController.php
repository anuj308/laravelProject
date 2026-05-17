<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function storeDestination(Request $request, Destination $destination)
    {
        abort_unless(auth()->check(), 403);

        $data = $this->validatedData($request);

        // Store the review with the logged in user id.
        Review::create([
            'user_id' => auth()->id(),
            'destination_id' => $destination->id,
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);

        $destination->update(['rating' => round($destination->reviews()->avg('rating'), 1)]);

        return back()->with('success', 'Review added successfully.');
    }

    public function storeHotel(Request $request, Hotel $hotel)
    {
        abort_unless(auth()->check(), 403);

        $data = $this->validatedData($request);

        Review::create([
            'user_id' => auth()->id(),
            'hotel_id' => $hotel->id,
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);

        $hotel->update(['rating' => round($hotel->reviews()->avg('rating'), 1)]);

        return back()->with('success', 'Review added successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'min:5'],
        ]);
    }
}
