<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Models\Listing;
use Illuminate\Auth\Events\Login;

// Route To Show All Listings
Route::get('/' , [ListingController::class , 'index' ]);

// Route to show the page of creating new listing(when clicking Post Job button) at the end of the home page
Route::get('/listings/create' , [ListingController::class , 'create'])->middleware('auth');

// Route to store the data that entered in the form of creating Jpb
Route::post('/listings' , [ListingController::class , 'store'])->middleware('auth');

// Route to Show edit form
// NOTE : Always put the wildcard routes at the end of all routes
Route::get('/listings/{listing}/edit' , [ListingController::class , 'edit'])->middleware('auth');   // localhost/listings/1/edit

// Route to update listing data
// NOTE : Always put the wildcard routes at the end of all routes
Route::put('/listings/{listing}' , [ListingController::class , 'update'])->middleware('auth');

// Route To Access Single Listing (Route model binding (Feature in Elequent model) way)
// NOTE : Always put the wildcard routes at the end of all routes
Route::get('/listings/{listing}' , [ListingController::class , 'show']);

// Route To Delete Listing 
// NOTE : Always put the wildcard routes at the end of all routes
Route::delete('/listings/{listing}' , [ListingController::class , 'destroy'])->middleware('auth');

// Route to Show register/create form
Route::get('/register' , [UserController::class , 'create'])->middleware('guest');

// Route to create new user
Route::post('/users' , [UserController::class , 'store']);

// Route to Log user out
Route::post('/logout' , [UserController::class , 'logout'])->middleware('auth');

//Route to Show the Login form
Route::get('/login' , [UserController::class , 'login'])->name('login')->middleware('guest');

// Route to login user
Route::post('/users/authenticate' , [UserController::class , 'authenticate']);



// Route To Access Single Listing (Traditional way)
// Route::get('/listings/{id}' , function($id) {
//     $listing = Listing::find($id);
//     if($listing) {
//         return view('listing' , [
//             'listing' => $listing
//         ]);
//     } else {
//         abort('404');
//     }   
// });



// Common Resources Routes that we create it in the listing controller:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing                        // operation or event when clicking on the button (NOT a Page)
// edit - Show form to edite listing
// update - Update listing                          // operation or event when clicking on the button (NOT a Page)
// destroy - Delete listing                         // operation or event when clicking on the button (NOT a Page)



























































// Intoduction to Laravel
// -------------------------------------------------
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/listings', function () {
//     return view('listings');
// });

// // Response
// Route::get('/test' , function() {
//     return response('Hello Wolrd!' , 200)
//            ->header("Content-Type" , "text/plian")
//            ->header("name" , "Alaa");
// });

// // Wildcard
// Route::get('/listings/{id}' , function($id) {
//     return $id;
// }) ->where('id' , '[0-9]+');

// // Debugging
// Route::get('/listings/{id}' , function($id) {
//     // dd($id);            // die and dumb
//     // ddd($id);              // die , dumb and debug
//     return $id;
// }) ->where('id' , '[0-9]+');

// // Request & Query prameters
// Route::get('/listings/search' , function(Request $request) {
//     dd($request);
//     // dd($request->name . " " . $request->city);     
// });

// // How to return JSON file (API)
// Route::get('/posts' , function() {
//     return response()->json([
//         "posts" => [
//             [
//                 "title" => "Post Title One",
//                 "description" => "Post Description One"
//             ],
//             [
//                 "title" => "Post Title Two",
//                 "description" => "Post Description Two"
//             ],
//             [
//                 "title" => "Post Title Three",
//                 "description" => "Post Description Three"
//             ] 
//         ]
//     ]);
// });


