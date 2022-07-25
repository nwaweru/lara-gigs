<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::all()
        ]);
    }

    // Get single listing
    public function show($id) {
        return view('listings.show', [
            'listing' => Listing::findOrFail($id)
        ]);
    }
}
