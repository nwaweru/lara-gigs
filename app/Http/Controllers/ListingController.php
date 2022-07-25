<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings', [
            'listings' => Listing::all()
        ]);
    }

    // Get single listing
    public function show($id) {
        return view('listing', [
            'listing' => Listing::findOrFail($id)
        ]);
    }
}
