<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function show(Brand $brand): View
    {
        abort_unless($brand->is_active, 404);

        $iconicCars = $brand->cars()
            ->with('category:id,name,slug')
            ->where('is_active', true)
            ->where('is_iconic', true)
            ->orderByRaw('COALESCE(iconic_order, 255)')
            ->orderByDesc('production_year_start')
            ->limit(8)
            ->get();

        $activeCars = $brand->cars()
            ->where('is_active', true);

        $categories = $activeCars
            ->clone()
            ->with('category:id,name,slug')
            ->get(['category_id'])
            ->pluck('category')
            ->filter()
            ->unique('id')
            ->sortBy('name')
            ->values();

        // A year represents a period in which a model was produced/available,
        // not only the year in which a model was first introduced.
        $years = collect();

        $activeCars
            ->clone()
            ->whereNotNull('production_year_start')
            ->get(['production_year_start', 'production_year_end'])
            ->each(function ($car) use ($years) {
                $start = (int) $car->production_year_start;
                $end = $car->production_year_end
                    ? (int) $car->production_year_end
                    : now()->year;

                if ($end < $start) {
                    $end = $start;
                }

                for ($year = $start; $year <= $end; $year++) {
                    $years->push($year);
                }
            });

        $years = $years->unique()->sortDesc()->values();

        $drivetrains = $activeCars
            ->clone()
            ->whereNotNull('drivetrain')
            ->where('drivetrain', '!=', '')
            ->distinct()
            ->orderBy('drivetrain')
            ->pluck('drivetrain')
            ->values();

        $fuelTypes = $activeCars
            ->clone()
            ->whereNotNull('fuel_type')
            ->where('fuel_type', '!=', '')
            ->distinct()
            ->orderBy('fuel_type')
            ->pluck('fuel_type')
            ->values();

        $productionTypes = $activeCars
            ->clone()
            ->whereNotNull('production_type')
            ->where('production_type', '!=', '')
            ->distinct()
            ->orderBy('production_type')
            ->pluck('production_type')
            ->values();

        $vehicleTypes = $activeCars
            ->clone()
            ->whereNotNull('vehicle_type')
            ->where('vehicle_type', '!=', '')
            ->distinct()
            ->orderBy('vehicle_type')
            ->pluck('vehicle_type')
            ->values();

        $favoriteCarIds = auth()->check()
            ? auth()->user()->favoriteCars()->pluck('cars.id')->all()
            : [];

        $wishlistCarIds = auth()->check()
            ? auth()->user()->wishlistCars()->pluck('cars.id')->all()
            : [];

        return view('brands.show', compact(
            'brand',
            'iconicCars',
            'categories',
            'years',
            'drivetrains',
            'fuelTypes',
            'productionTypes',
            'vehicleTypes',
            'favoriteCarIds',
            'wishlistCarIds'
        ));
    }

    public function cars(Request $request, Brand $brand): JsonResponse
    {
        abort_unless($brand->is_active, 404);

        $perPage = min(max((int) $request->integer('per_page', 8), 1), 24);

        $cars = $brand->cars()
            ->with('category:id,name,slug')
            ->where('is_active', true)
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim((string) $request->string('search'));

                $query->where(function ($builder) use ($search) {
                    $builder
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('model_family', 'like', '%' . $search . '%')
                        ->orWhere('generation', 'like', '%' . $search . '%')
                        ->orWhere('variant', 'like', '%' . $search . '%')
                        ->orWhere('short_description', 'like', '%' . $search . '%');
                });
            })
            ->when($request->filled('year'), function ($query) use ($request) {
                $year = (int) $request->integer('year');

                $query->where('production_year_start', '<=', $year)
                    ->where(function ($builder) use ($year) {
                        $builder
                            ->whereNull('production_year_end')
                            ->orWhere('production_year_end', '>=', $year);
                    });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category_id', $request->integer('category'));
            })
            ->when($request->filled('drivetrain'), function ($query) use ($request) {
                $query->where('drivetrain', $request->string('drivetrain'));
            })
            ->when($request->filled('fuel_type'), function ($query) use ($request) {
                $query->where('fuel_type', $request->string('fuel_type'));
            })
            ->when($request->filled('production_type'), function ($query) use ($request) {
                $productionType = (string) $request->string('production_type');

                $query->where('production_type', $productionType);

                // "Production" is reserved for regular road-going models
                // commercially offered for public sale.
                if ($productionType === 'Production') {
                    $query->where('publicly_sold', true)
                        ->where('road_legal', true)
                        ->where('is_limited', false)
                        ->where('is_one_off', false)
                        ->where('is_concept', false)
                        ->where('is_track_only', false)
                        ->where('is_racing', false);
                }
            })
            ->when($request->filled('vehicle_type'), function ($query) use ($request) {
                $query->where('vehicle_type', $request->string('vehicle_type'));
            })
            ->orderByDesc('is_featured')
            ->orderByDesc('is_iconic')
            ->orderByDesc('production_year_start')
            ->orderBy('name')
            ->paginate($perPage);

        if (auth()->check()) {
            $favoriteIds = auth()->user()->favoriteCars()
                ->whereIn('cars.id', collect($cars->items())->pluck('id'))
                ->pluck('cars.id')
                ->flip();

            $wishlistIds = auth()->user()->wishlistCars()
                ->whereIn('cars.id', collect($cars->items())->pluck('id'))
                ->pluck('cars.id')
                ->flip();

            $cars->getCollection()->each(function ($car) use ($favoriteIds, $wishlistIds) {
                $car->setAttribute('is_favorited', $favoriteIds->has($car->id));
                $car->setAttribute('is_wishlisted', $wishlistIds->has($car->id));
            });
        } else {
            $cars->getCollection()->each(function ($car) {
                $car->setAttribute('is_favorited', false);
                $car->setAttribute('is_wishlisted', false);
            });
        }

        return response()->json($cars);
    }

    public function car(Brand $brand, string $car): View
    {
        abort_unless($brand->is_active, 404);

        $vehicle = $brand->cars()
            ->with('category:id,name,slug')
            ->where('cars.slug', $car)
            ->where('cars.is_active', true)
            ->firstOrFail();

        $relatedCars = $brand->cars()
            ->with('category:id,name,slug')
            ->where('cars.is_active', true)
            ->where('cars.id', '!=', $vehicle->id)
            ->orderByDesc('is_featured')
            ->orderByDesc('is_iconic')
            ->orderByDesc('production_year_start')
            ->limit(4)
            ->get();

        $isFavorited = auth()->check()
            ? auth()->user()->favoriteCars()->whereKey($vehicle->id)->exists()
            : false;

        $isWishlisted = auth()->check()
            ? auth()->user()->wishlistCars()->whereKey($vehicle->id)->exists()
            : false;

        $detailSections = collect($vehicle->detail_sections ?? []);
        $overviewSection = $detailSections->firstWhere('label', 'OVERVIEW') ?? [];
        $designSection = $detailSections->firstWhere('label', 'DESIGN') ?? [];
        $powertrainSection = $detailSections->firstWhere('label', 'POWERTRAIN') ?? [];
        $performanceSection = $detailSections->firstWhere('label', 'PERFORMANCE') ?? [];
        $interiorSection = $detailSections->firstWhere('label', 'INTERIOR');
        $handlingSection = $detailSections->firstWhere('label', 'HANDLING');
        $chassisSection = $detailSections->firstWhere('label', 'CHASSIS');
        $dimensionsSection = $detailSections->firstWhere('label', 'DIMENSIONS') ?? [];

        $performanceSpecs = collect($performanceSection['specs'] ?? []);
        $zeroTo200 = $performanceSpecs->firstWhere('label', '0–200 km/h') ?? [];
        $fioranoLap = $performanceSpecs->firstWhere('label', 'Fiorano Lap') ?? [];

        $gallery = collect([$vehicle->image_path])
            ->merge($vehicle->gallery_images ?? [])
            ->filter()
            ->unique()
            ->values();

        $familyLabel = $vehicle->model_family ?: $vehicle->name;
        $variantLabel = str_starts_with($vehicle->name, $familyLabel)
            ? trim(substr($vehicle->name, strlen($familyLabel)))
            : '';

        $comparisonCars = collect([$vehicle])
            ->merge($relatedCars)
            ->unique('id')
            ->take(4)
            ->values();

        return view('cars.show', compact(
            'brand',
            'vehicle',
            'relatedCars',
            'comparisonCars',
            'isFavorited',
            'isWishlisted',
            'detailSections',
            'overviewSection',
            'designSection',
            'powertrainSection',
            'performanceSection',
            'interiorSection',
            'handlingSection',
            'chassisSection',
            'dimensionsSection',
            'performanceSpecs',
            'zeroTo200',
            'fioranoLap',
            'gallery',
            'familyLabel',
            'variantLabel'
        ));
    }

    public function toggleFavorite(Car $car): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Please sign in to save favorites.',
                'requires_auth' => true,
            ], 401);
        }

        abort_unless($car->is_active, 404);

        $user = auth()->user();
        $exists = $user->favoriteCars()->whereKey($car->id)->exists();

        if ($exists) {
            $user->favoriteCars()->detach($car->id);
        } else {
            $user->favoriteCars()->attach($car->id);
        }

        return response()->json([
            'active' => !$exists,
            'type' => 'favorite',
            'message' => !$exists ? 'Added to favorites.' : 'Removed from favorites.',
        ]);
    }

    public function toggleWishlist(Car $car): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Please sign in to save your wishlist.',
                'requires_auth' => true,
            ], 401);
        }

        abort_unless($car->is_active, 404);

        $user = auth()->user();
        $exists = $user->wishlistCars()->whereKey($car->id)->exists();

        if ($exists) {
            $user->wishlistCars()->detach($car->id);
        } else {
            $user->wishlistCars()->attach($car->id);
        }

        return response()->json([
            'active' => !$exists,
            'type' => 'wishlist',
            'message' => !$exists ? 'Added to wishlist.' : 'Removed from wishlist.',
        ]);
    }
}
