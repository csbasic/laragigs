<?php

use App\Models\Users;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// All Listings
Route::get('/', [ListingController::class, 'index']);

// Create Listing
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// store Listing
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show register create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create user
Route::post('/user', [UserController::class, 'store']);

// log user out 
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// show login form | name route "login" to function with middleware
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//login user
Route::post('/user/authenticate', [UserController::class, 'authenticate']);


/*
|----------------------------------------------
|   Common naming conventions
|----------------------------------------------
|   index - show all listings
|   show - show single listing
|   create - show form to create new listing
|   store - save new listing in a database
|   edit - show form to edit listing
|   update - update listing
|   destroy - delete listing
|
*/



/**
    For Reference
 */

//Custome values can be injected using header funtion calls

// Route::get('/hello', function () {
//     return response('<h1>Hello World!</h1>')
//         ->header('Content', 'text/plain')
//         ->header('foo', 'bar');
// });


// Pass ID and also add constrains so that only int is used as aguements
// dd() => die and dump, ddd() => die dump and deburg

// Route::get('/posts/{id}', function ($id) {
//     dd($id);
//     ddd($id);
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');


// Route::get('/search', function (Request $request) {
//     return ($request->name . ' ' . $request->city);
// });
