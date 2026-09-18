<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

Route::get('/about', [AboutController::class, 'index']);
Route::get('/ferrari', function () {
    return view('ferrari');
});

Route::get('/master', function () {
    return view('layouts.master');
});

Route::get('/home', function () {
    return view('home.home');
});
