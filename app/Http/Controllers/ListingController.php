<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {

        return view('listings.index', [
            // listing is passed as key to view model
            // while key is pointing to Listing::all() as value
            'listings' => Listing::latest()->filter(request(['tag']))->get()
        ]);
    }

    public function show(Listing $listing)
    {

        return view('listings.show', [
            'listing' => $listing
        ]);
    }
}
