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

        $returnTo = (string) $request->query('return_to', '');
        $returnTo = $this->safeReturnUrl($request, $returnTo);

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
            'wishlist',
            'returnTo'
        ));
    }

    private function safeReturnUrl(Request $request, string $returnTo): string
    {
        if ($returnTo === '') {
            return route('home');
        }

        if (str_starts_with($returnTo, '/')) {
            return url($returnTo);
        }

        $parsed = parse_url($returnTo);
        $host = $parsed['host'] ?? null;
        $scheme = $parsed['scheme'] ?? null;

        if ($host === $request->getHost() && ($scheme === null || $scheme === $request->getScheme())) {
            return $returnTo;
        }

        return route('home');

    }
}

}
