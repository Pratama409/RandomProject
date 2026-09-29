<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user()->loadCount([
            'favoriteCars',
            'wishlistCars',
        ]);

        return view('profile.show', compact('user'));
    }
}
