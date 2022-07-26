<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create')->middleware('auth');

// Store listing
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store')->middleware('auth');

// Show single listing
Route::get('/listings/{id}', [ListingController::class, 'show'])->name('listings.show');

// Show edit form
Route::get('/listings/{id}/edit', [ListingController::class, 'edit'])->name('listings.edit')->middleware('auth');

// Save edited listing changes
Route::put('/listings/{id}', [ListingController::class, 'update'])->name('listings.update')->middleware('auth');

// Delete a listing
Route::delete('/listings/{id}', [ListingController::class, 'destroy'])->name('listings.destroy')->middleware('auth');

// Show register form
Route::get('/register', [UserController::class, 'create'])->name('users.create')->middleware('guest');

// Save user registration data
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Show login form
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login')->middleware('guest');

// Log in a user
Route::post('/users/authenticate', [UserController::class, 'login'])->name('users.login');

// Logout a user
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
