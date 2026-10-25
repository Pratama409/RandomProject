<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCarRequest;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
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
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->storeCarImage($request->file('image'));
        }

        unset($data['image']);

        $car = Car::create($data);

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
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->storeCarImage($request->file('image'));
        }

        unset($data['image']);

        $car->update($data);

        return redirect()
            ->route('admin.cars.index')
            ->with('success', $car->name . ' was updated successfully.');
    }

    /**
     * Store a catalog image in public/image/cars and return its relative public path.
     */
    private function storeCarImage(UploadedFile $image): string
    {
        $directory = public_path('image/cars');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = Str::uuid()->toString() . '.' . $image->extension();
        $image->move($directory, $filename);

        return 'image/cars/' . $filename;
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
