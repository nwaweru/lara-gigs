<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('listings', [
        'header' => 'Latest Listings',
        'listings' => Listing::all()
    ]);
})->name('home');

Route::get('/listing/{id}', function($id) {
    return view('listing', [
        'listing' => Listing::findOrFail($id)
    ]);
})->name('listings.show');