<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
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

// All listings
Route::get('/', [ListingController::class, 'index'])->name('home');

// Listing create form
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');

// Store listing
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');

// Show single listing
Route::get('/listings/{id}', [ListingController::class, 'show'])->name('listings.show');

// Show edit form
Route::get('/listings/{id}/edit', [ListingController::class, 'edit'])->name('listings.edit');

// Save edited listing changes
Route::put('/listings/{id}', [ListingController::class, 'update'])->name('listings.update');

// Delete a listing
Route::delete('/listings/{id}', [ListingController::class, 'destroy'])->name('listings.destroy');
