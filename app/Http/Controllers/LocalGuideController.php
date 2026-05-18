<?php

namespace App\Http\Controllers;

use App\Models\LocalGuide;
use App\Models\Destination;
use Illuminate\Http\Request;

class LocalGuideController extends Controller
{
    // Public page — sabhi available guides ki list
    public function index()
    {
        return view('guides.index', [
            'guides' => LocalGuide::with('destination')->latest()->paginate(8),
        ]);
    }

    // Admin ke liye — naya guide add karne ka form
    public function create()
    {
        // Destination dropdown ke liye chahiye
        return view('guides.create', ['destinations' => Destination::orderBy('name')->get()]);
    }

    // Admin ke liye — naya guide DB mein save karna
    public function store(Request $request)
    {
        LocalGuide::create($this->validatedData($request));
        return redirect()->route('guides.index')->with('success', 'Naya local guide add ho gaya.');
    }

    // Admin ke liye — existing guide edit karna
    public function edit(LocalGuide $guide)
    {
        return view('guides.edit', [
            'guide' => $guide,
            'destinations' => Destination::orderBy('name')->get()
        ]);
    }

    // Admin ke liye — existing guide ke details update karna
    public function update(Request $request, LocalGuide $guide)
    {
        $guide->update($this->validatedData($request));
        return redirect()->route('guides.index')->with('success', 'Guide details update ho gaye.');
    }

    // Admin ke liye — guide delete karna
    public function destroy(LocalGuide $guide)
    {
        $guide->delete();
        return redirect()->route('guides.index')->with('success', 'Guide remove ho gaya.');
    }

    // Form data validation rules
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'destination_id' => ['nullable', 'exists:destinations,id'],
            'name'           => ['required', 'max:255'],
            'phone'          => ['required', 'max:20'],
            'email'          => ['required', 'email', 'max:255'],
            'languages'      => ['required', 'max:255'], // e.g. English, Hindi
            'fee_per_day'    => ['required', 'numeric', 'min:1'],
            'rating'         => ['required', 'numeric', 'min:0', 'max:5'],
        ]);
    }
}
