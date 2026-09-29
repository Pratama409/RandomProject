<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - AutomobilliMachine
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/collection', [CollectionController::class, 'index'])->name('collection.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
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
