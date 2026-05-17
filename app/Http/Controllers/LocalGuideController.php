<?php

namespace App\Http\Controllers;

use App\Models\LocalGuide;

class LocalGuideController extends Controller
{
    public function index()
    {
        return view('guides.index', [
            'guides' => LocalGuide::with('destination')->latest()->paginate(8),
        ]);
    }
}
