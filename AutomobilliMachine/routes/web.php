<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - AutomobilliMachine
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home.home');
})->name('home');

Route::get('/home', function () {
    return view('home.home');
});

Route::get('/brands/{brand:slug}', [BrandController::class, 'show'])->name('brands.show');
Route::get('/brands/{brand:slug}/cars', [BrandController::class, 'cars'])->name('brands.cars');
Route::get('/brands/{brand:slug}/cars/{car}', [BrandController::class, 'car'])->name('cars.show');
Route::post('/cars/{car}/favorite', [BrandController::class, 'toggleFavorite'])->name('cars.favorite');
Route::post('/cars/{car}/wishlist', [BrandController::class, 'toggleWishlist'])->name('cars.wishlist');

// Legacy-friendly entry point while the brand pages move to slug-based routing.
Route::get('/ferrari', function () {
    return redirect()->route('brands.show', ['brand' => 'ferrari']);
})->name('brand.ferrari');

Route::get('/compare', function () {
    return view('compare.index');
})->name('compare.index');
