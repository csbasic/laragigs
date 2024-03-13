<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Models\Users;

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

Route::get('/', [ListingController::class, 'index']);

Route::get('/listings/{listing}', [ListingController::class, 'show']);


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
Route::get('/hello', function () {
    return response('<h1>Hello World!</h1>')
        ->header('Content', 'text/plain')
        ->header('foo', 'bar');
});


// Pass ID and also add constrains so that only int is used as aguements
// dd() => die and dump, ddd() => die dump and deburg
Route::get('/posts/{id}', function ($id) {
    dd($id);
    ddd($id);
    return response('Post ' . $id);
})->where('id', '[0-9]+');


// Route::get('/search', function (Request $request) {
//     return ($request->name . ' ' . $request->city);
// });
