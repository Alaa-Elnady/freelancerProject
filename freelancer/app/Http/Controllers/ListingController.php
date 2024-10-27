<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // // The Route of the index or home page for whole listings
    // public function index(Request $request) {   // Dependency Injection --> first way of recieving data from requests when clicking on the tag button
    //     dd($request);
    //     return view('listings.index' , [
    //         "heading" => "Latest Listings",
    //         "listings" => Listing::all()
    //     ]);
    // }

    //MARK: Index Page
    // The Route of the index or home page for whole listings (Show all listings)
    public function index() {   // Request Helper --> second way of recieving data from requests when clicking on the tag button

        // dd(request()->tag);    // way 1 to access querey parameters(strings)
        // dd(request('tag'));    // way 2 to access querey parameters(strings)

        // dd(Listing::latest()->Filter(request(['tag' , 'search']))->paginate(5));
        return view('listings.index' , [
            "heading" => "Latest Listings",
            "listings" => Listing::latest()->Filter(request(['tag' , 'search']))->paginate(5)
        ]);
    }

    //MARK: Show Page
    // The Route of show page for single listing (Show single listing)
    public function show(Listing $listing) {
        return view('listings.show' , [
            'listing' => $listing
        ]);
    }

    //MARK: Create Form
    // The Route of show the creating Jop form (Show create form)
    public function create() {
        return view('listings.create');
    }

    //MARK: Storing
    // The Route of storinglisting data
    public function store(Request $request) {
        // dd($request->all());
        // dd($request->file('logo'));
        // dd($request->file('logo')->store());

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required' , Rule::unique('listings', 'company')],
            'location' => 'required',
            'email' => ['required' , 'email'],
            'website' => ['required' , 'url'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos' , 'public');
        }

        Listing::create($formFields);
        // Session::flash('message' , 'listing created successfully!');                 // first way to make flash messages
        return redirect('/')->with('message' , 'Listing created successfully');         // second way to make flash messages
    }

    //MARK: Edit Form
    // The route of showing the edit listing page
    public function edit(Listing $listing) {
        return view('listings.edit' , ['listing' => $listing]);
    }

    //MARK: Update
    // The Route of updating the data of the listing or job
    public function update(Listing $listing , Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'email' => ['required' , 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos' , 'public');
        }

        $listing->update($formFields);
        return back()->with('message' , 'Listing updated successfully!');
    }

    //MARK: Destroy 
    // The Route of deleting the listing or the job
    public function destroy(Listing $listing) {
        if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }
        $listing->delete();
        return redirect('/')->with('message' , 'Listing Deleted Successfully!');
    }


}
