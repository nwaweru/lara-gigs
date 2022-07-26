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

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->user()->id;

        Listing::create($formFields);

        return redirect()->route('home')->with('message', 'Listing created successfully.');
    }

    // Show edit form
    public function edit($id) {
        return view('listings.edit', [
            'listing' => Listing::findOrFail($id)
        ]);
    }

    // Update a listing
    public function update(Request $request, $id) {
        $listing = Listing::findOrFail($id);

        if(auth()->user()->id !== $listing->user_id) {
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return redirect()->back()->with('message', 'Listing updated successfully.');
    }

    // Delete listing
    public function destroy($id) {
        $listing = Listing::findOrFail($id);

        if(auth()->user()->id !== $listing->user_id) {
            abort(403, 'Unauthorized action');
        }
        
        $listing->delete();

        return redirect()->route('home')->with('message', 'Listing deleted successfully.');
    }

    // Manage listing
    public function manage() {
        return view('listings.manage', [
            'listings' => auth()->user()->listings
        ]);
    }
}
