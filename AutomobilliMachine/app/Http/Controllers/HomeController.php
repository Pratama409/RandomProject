<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $brands = Brand::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'slug',
                'country',
                'founded_year',
                'logo_path',
                'vehicle_lineup',
                'hero_image_path',
            ]);

        // The homepage hero is intentionally randomized on each request so a
        // refresh presents a different selection from the catalog database.
        $heroCars = Car::query()
            ->with('brand:id,name,slug')
            ->where('is_active', true)
            ->whereNotNull('image_path')
            ->orderByRaw('RAND()')
            ->limit(12)
            ->get([
                'id',
                'brand_id',
                'name',
                'slug',
                'image_path',
            ]);

        // One Hall of Fame pick per brand keeps the showcase diverse.
        $iconicCandidates = Car::query()
            ->with('brand:id,name,slug')
            ->where('is_active', true)
            ->where('is_iconic', true)
            ->whereNotNull('image_path')
            ->orderByRaw('RAND()')
            ->get([
                'id',
                'brand_id',
                'name',
                'slug',
                'production_year_start',
                'production_year_end',
                'image_path',
                'horsepower',
                'acceleration_0_100',
                'top_speed_kmh',
            ]);

        $iconicCars = $iconicCandidates
            ->groupBy('brand_id')
            ->map(fn ($cars) => $cars->first())
            ->shuffle()
            ->take(6)
            ->values();

        return view('home.home', compact(
            'brands',
            'heroCars',
            'iconicCars'
        ));
    }
}
