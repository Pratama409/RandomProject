<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CollectionController extends Controller
{
    public function index(Request $request): View
    {
        $tab = $request->string('tab')->toString() === 'wishlist'
            ? 'wishlist'
            : 'favorites';

        $favorites = collect();
        $wishlist = collect();

        if (auth()->check()) {
            $favorites = auth()->user()
                ->favoriteCars()
                ->with('brand:id,name,slug')
                ->where('cars.is_active', true)
                ->orderBy('favorites.created_at', 'desc')
                ->get();

            $wishlist = auth()->user()
                ->wishlistCars()
                ->with('brand:id,name,slug')
                ->where('cars.is_active', true)
                ->orderBy('wishlists.created_at', 'desc')
                ->get();
        }

        return view('collection.index', compact(
            'tab',
            'favorites',
            'wishlist'
        ));
    }
}
