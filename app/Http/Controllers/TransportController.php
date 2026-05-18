<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    // Public listing — sab log dekh sakte hain kaunse transports available hain
    public function index()
    {
        $transports = Transport::latest()->paginate(10);
        return view('transports.index', compact('transports'));
    }

    // Admin ke liye — naya transport add karne ka form
    public function create()
    {
        return view('transports.create');
    }

    // Admin ke liye — transport save karo
    public function store(Request $request)
    {
        Transport::create($this->validatedData($request));
        return redirect()->route('transports.index')->with('success', 'Transport option add ho gaya.');
    }

    // Admin ke liye — transport edit karne ka form
    public function edit(Transport $transport)
    {
        return view('transports.edit', compact('transport'));
    }

    // Admin ke liye — transport update karo
    public function update(Request $request, Transport $transport)
    {
        $transport->update($this->validatedData($request));
        return redirect()->route('transports.index')->with('success', 'Transport update ho gaya.');
    }

    // Admin ke liye — transport delete karo
    public function destroy(Transport $transport)
    {
        $transport->delete();
        return redirect()->route('transports.index')->with('success', 'Transport remove ho gaya.');
    }

    // Validation rules ek jagah pe — DRY principle
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'type'            => ['required', 'max:50'],   // Bus, Flight, Cab etc.
            'route'           => ['required', 'max:255'],  // e.g. Delhi to Jaipur
            'provider'        => ['required', 'max:255'],  // Company name
            'departure_time'  => ['required'],
            'available_seats' => ['required', 'integer', 'min:1'],
            'price'           => ['required', 'numeric', 'min:1'],
        ]);
    }
}
