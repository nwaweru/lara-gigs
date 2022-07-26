<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Get single listing
    public function show($id) {
        return view('listings.show', [
            'listing' => Listing::findOrFail($id)
        ]);
    }

    // Show listing create form
    public function create() {
        return view('listings.create');
    }

    // Store listing
    public function store(Request $request) {
        $formFields = $request->validate([
            'company' => ['required', Rule::unique('listings', 'company')],
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        Listing::create($formFields);

        return redirect()->route('home')->with('message', 'Listing created successfully.');
    }
}
