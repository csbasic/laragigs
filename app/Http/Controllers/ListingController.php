<?php

namespace App\Http\Controllers;

// use Illuminate\Validation\Rule;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index()
    {

        return view('listings.index', [
            // listing is passed as key to view model
            // while key is pointing to Listing::all() as value
            'listings' => Listing::latest()->filter(request(['search', 'tag']))->where(['status' =>  1])->paginate(6)
        ]);
    }

    // Show single listing
    public function show(Listing $listing)
    {

        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //  create listing
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            // 'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        // that for file and store
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    public function create()
    {
        return view('listings.create');
    }

    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            // 'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        // that for file and store
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    public function destroy(Request $request, Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        // updating table rather than destroy data
        $formFields['status'] = 0;
        $listing->update($formFields);

        // $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    // Manage Listings
    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
