<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FerrariController;

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

// Route to Ferrari Brand page
Route::get('/ferrari', [FerrariController::class, 'index'])->name('brand.ferrari');

// Comparison placeholder route
Route::get('/compare', function () {
    return "Car Comparison Tool (Under Construction)";
})->name('compare.index');