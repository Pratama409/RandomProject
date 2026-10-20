<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
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
        // Mobile gets fewer tiles to reduce initial DOM/image work.
        $isMobile = preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $request->userAgent()) === 1;
        $heroLimit = $isMobile ? 4 : 12;

        $heroCars = Car::query()
            ->with('brand:id,name,slug')
            ->where('is_active', true)
            ->whereNotNull('image_path')
            ->inRandomOrder()
            ->limit($heroLimit)
            ->get([
                'id',
                'brand_id',
                'name',
                'slug',
                'image_path',
            ]);

        // Select a small set of brands first, then fetch only one random
        // iconic car per brand. Avoid loading every iconic car into PHP just
        // to keep six showcase cards.
        // Build the four diagonal hero panels from real catalog cars.
        // This keeps the reference layout while avoiding hard-coded image files.
        $panelCategories = [
            'Maranello',
            'Performance',
            'Track Engineering',
            'Hypercar',
        ];

        $panels = $heroCars->take(4)->values()->map(function ($car, $index) use ($panelCategories) {
            return [
                'id' => $car->id,
                'title' => $car->name,
                'category' => str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)
                    . ' • ' . ($car->brand?->name ?? $panelCategories[$index]),
                'image' => $car->image_path,
                'clip_class' => 'clip-panel-' . ($index + 1),
            ];
        })->all();

        $iconicBrandIds = Car::query()
            ->where('is_active', true)
            ->where('is_iconic', true)
            ->whereNotNull('image_path')
            ->distinct()
            ->pluck('brand_id')
            ->shuffle()
            ->take(6);

        $iconicCars = $iconicBrandIds
            ->map(fn ($brandId) => Car::query()
                ->with('brand:id,name,slug')
                ->where('brand_id', $brandId)
                ->where('is_active', true)
                ->where('is_iconic', true)
                ->whereNotNull('image_path')
                ->inRandomOrder()
                ->first([
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
                ]))
            ->filter()
            ->values();


        return view('home.home', compact(
            'brands',
            'heroCars',
            'panels',
            'iconicCars'
        ));
    }
}
