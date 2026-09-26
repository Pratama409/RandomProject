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
            ->orderByDesc('production_year_start')
            ->limit(4)
            ->get();

        return view('brands.show', compact('brand', 'iconicCars'));
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
            ->orderByDesc('is_iconic')
            ->orderByDesc('production_year_start')
            ->paginate($perPage);

        return response()->json($cars);
    }
}
