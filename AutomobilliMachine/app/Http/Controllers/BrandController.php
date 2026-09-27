<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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

        return view('brands.show', compact(
            'brand',
            'iconicCars',
            'categories',
            'years',
            'drivetrains',
            'fuelTypes',
            'productionTypes',
            'vehicleTypes'
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
            ->orderByDesc('is_iconic')
            ->orderByDesc('production_year_start')
            ->orderBy('name')
            ->paginate($perPage);

        return response()->json($cars);
    }
}
