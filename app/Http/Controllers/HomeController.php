<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\LocalGuide;
use App\Models\Transport;
use App\Models\TravelPackage;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'destinations' => Destination::latest()->take(3)->get(),
            'hotels' => Hotel::latest()->take(3)->get(),
            'packages' => TravelPackage::latest()->take(3)->get(),
            'guides' => LocalGuide::latest()->take(3)->get(),
            'transports' => Transport::latest()->take(5)->get(),
        ]);
    }
}
