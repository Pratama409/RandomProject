<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCarRequest;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * List the catalog using Eloquent relationships and pagination.
     */
    public function index(): View
    {
        $search = trim((string) request('search', ''));

        $cars = Car::query()
            ->with(['brand:id,name', 'category:id,name'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('model_family', 'like', '%' . $search . '%')
                        ->orWhere('slug', 'like', '%' . $search . '%')
                        ->orWhereHas('brand', fn ($brandQuery) => $brandQuery
                            ->where('name', 'like', '%' . $search . '%'));
                });
            })
            ->orderByDesc('updated_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.cars.index', compact('cars', 'search'));
    }

    public function create(): View
    {
        return view('admin.cars.create', [
            'brands' => Brand::query()->orderBy('name')->get(['id', 'name']),
            'categories' => Category::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(SaveCarRequest $request): RedirectResponse
    {
        $car = Car::create($request->validated());

        return redirect()
            ->route('admin.cars.index')
            ->with('success', $car->name . ' was created successfully.');
    }

    public function edit(Car $car): View
    {
        return view('admin.cars.edit', [
            'car' => $car,
            'brands' => Brand::query()->orderBy('name')->get(['id', 'name']),
            'categories' => Category::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(SaveCarRequest $request, Car $car): RedirectResponse
    {
        $car->update($request->validated());

        return redirect()
            ->route('admin.cars.index')
            ->with('success', $car->name . ' was updated successfully.');
    }

    public function destroy(Car $car): RedirectResponse
    {
        $name = $car->name;
        $car->delete();

        return redirect()
            ->route('admin.cars.index')
            ->with('success', $name . ' was deleted from the catalog.');
    }
}
