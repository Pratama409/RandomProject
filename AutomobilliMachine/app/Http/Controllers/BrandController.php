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

        $years = $activeCars
            ->clone()
            ->whereNotNull('production_year_start')
            ->pluck('production_year_start')
            ->unique()
            ->sortDesc()
            ->values();

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

        return view('brands.show', compact(
            'brand',
            'iconicCars',
            'categories',
            'years',
            'drivetrains',
            'fuelTypes'
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
            ->orderByDesc('is_iconic')
            ->orderByDesc('production_year_start')
            ->paginate($perPage);

        return response()->json($cars);
    }
}
