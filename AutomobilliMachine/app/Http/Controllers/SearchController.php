<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $term = trim((string) $request->string('q'));

        if (mb_strlen($term) < 2) {
            return response()->json([
                'brands' => [],
                'cars' => [],
            ]);
        }

        $like = '%' . $term . '%';

        $brands = Brand::query()
            ->where('is_active', true)
            ->where(function ($query) use ($like) {
                $query
                    ->where('name', 'like', $like)
                    ->orWhere('country', 'like', $like)
                    ->orWhere('vehicle_lineup', 'like', $like);
            })
            ->orderBy('name')
            ->limit(5)
            ->get(['id', 'name', 'slug', 'country', 'logo_path']);

        $cars = Car::query()
            ->with('brand:id,name,slug')
            ->where('is_active', true)
            ->whereHas('brand', fn ($query) => $query->where('is_active', true))
            ->where(function ($query) use ($like) {
                $query
                    ->where('name', 'like', $like)
                    ->orWhere('model_family', 'like', $like)
                    ->orWhere('generation', 'like', $like)
                    ->orWhere('variant', 'like', $like);
            })
            ->orderByDesc('is_featured')
            ->orderByDesc('is_iconic')
            ->orderBy('name')
            ->limit(8)
            ->get([
                'id',
                'brand_id',
                'name',
                'slug',
                'production_year_start',
                'production_year_end',
                'image_path',
                'is_iconic',
            ]);

        return response()->json([
            'brands' => $brands->map(fn (Brand $brand) => [
                'name' => $brand->name,
                'meta' => $brand->country,
                'image' => $brand->logo_path,
                'url' => route('brands.show', $brand),
            ]),
            'cars' => $cars->map(fn (Car $car) => [
                'name' => $car->name,
                'meta' => trim(($car->brand?->name ?? '') . ($car->production_year_start ? ' · ' . $car->production_year_start : '')),
                'image' => $car->image_path,
                'iconic' => (bool) $car->is_iconic,
                'url' => route('cars.show', ['brand' => $car->brand->slug, 'car' => $car->slug]),
            ]),
        ]);
    }
}
