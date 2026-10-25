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

        if (! empty($data['remove_hero_image'])) {
            $data['image_path'] = null;
        }
        if ($request->hasFile('image')) {
            $data['image_path'] = $this->storeCarImage($request->file('image'));
        }

        unset($data['image'], $data['remove_hero_image']);
        $this->prepareRichDetails($request, $data);

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

        if (! empty($data['remove_hero_image'])) {
            $data['image_path'] = null;
        }
        if ($request->hasFile('image')) {
            $data['image_path'] = $this->storeCarImage($request->file('image'));
        }

        unset($data['image'], $data['remove_hero_image']);
        $this->prepareRichDetails($request, $data, $car);

        $car->update($data);

        return redirect()
            ->route('admin.cars.index')
            ->with('success', $car->name . ' was updated successfully.');
    }

    /**
     * Normalize the rich editor into existing JSON columns used by the public car-detail page.
     * Unrelated JSON sections and existing image paths are kept on edit.
     */
    private function prepareRichDetails(SaveCarRequest $request, array &$data, ?Car $car = null): void
    {
        $editor = $data['detail_editor'] ?? [];
        $sectionImages = $request->file('section_images', []);
        $sectionRemovals = $data['section_image_remove'] ?? [];
        $galleryRemovals = $data['gallery_remove'] ?? [];
        $galleryFiles = $request->file('gallery_files', []);
        $variantsEditor = $data['variants_editor'] ?? [];
        $sourcesEditor = $data['sources_editor'] ?? [];

        unset(
            $data['detail_editor'],
            $data['section_images'],
            $data['section_image_remove'],
            $data['gallery_remove'],
            $data['gallery_files'],
            $data['variants_editor'],
            $data['sources_editor']
        );

        $existingSections = collect($car?->detail_sections ?? [])
            ->filter(fn ($section) => is_array($section) && ! empty($section['label']))
            ->keyBy('label');

        foreach ($editor as $label => $fields) {
            if (! in_array($label, self::EDITABLE_DETAIL_SECTIONS, true)) {
                continue;
            }

            if (! empty($fields['remove'])) {
                $existingSections->forget($label);
                continue;
            }

            $section = $existingSections->get($label, ['label' => $label]);
            $section['label'] = $label;
            $section['title'] = trim((string) ($fields['title'] ?? ''));
            $section['paragraphs'] = $this->splitLines($fields['paragraphs_text'] ?? '');
            $section['items'] = $this->splitLines($fields['items_text'] ?? '');

            $specLines = $this->splitLines($fields['specs_text'] ?? '');
            $section['specs'] = collect($specLines)->map(function (string $line) {
                [$label, $value] = array_pad(explode('|', $line, 2), 2, '');
                return ['label' => trim($label), 'value' => trim($value)];
            })->filter(fn (array $item) => $item['label'] !== '' && $item['value'] !== '')
                ->values()->all();

            $imageKey = $label === 'POWERTRAIN' ? 'image' : 'detail_image';
            if (! empty($sectionRemovals[$label])) {
                unset($section[$imageKey]);
            }
            if (isset($sectionImages[$label]) && $sectionImages[$label] instanceof UploadedFile) {
                $section[$imageKey] = $this->storeCarImage($sectionImages[$label]);
            }

            if ($section['title'] !== '' || $section['paragraphs'] !== [] || $section['items'] !== [] ||
                $section['specs'] !== [] || ! empty($section[$imageKey])) {
                $existingSections->put($label, $section);
            } else {
                $existingSections->forget($label);
            }
        }

        if ($request->has('detail_editor')) {
            $data['detail_sections'] = $existingSections->values()->all();
        }

        if ($request->has('gallery_editor_present')) {
            $gallery = collect($car?->gallery_images ?? [])
                ->filter(fn ($path) => is_string($path) && $path !== '')
                ->reject(fn (string $path) => in_array($path, $galleryRemovals, true))
                ->values()->all();

            foreach ($galleryFiles as $image) {
                if ($image instanceof UploadedFile) {
                    $gallery[] = $this->storeCarImage($image);
                }
            }

            $data['gallery_images'] = array_values(array_unique($gallery));
        }

        if ($request->has('variants_editor_present')) {
            $data['variants'] = collect($variantsEditor)
                ->filter(fn ($item) => ! empty(trim((string) ($item['name'] ?? ''))))
                ->map(fn ($item) => [
                    'type' => trim((string) ($item['type'] ?? '')),
                    'name' => trim((string) ($item['name'] ?? '')),
                    'years' => trim((string) ($item['years'] ?? '')),
                    'description' => trim((string) ($item['description'] ?? '')),
                ])->values()->all();
        }

        if ($request->has('sources_editor_present')) {
            $data['source_links'] = collect($sourcesEditor)
                ->filter(fn ($item) => ! empty(trim((string) ($item['url'] ?? ''))))
                ->map(fn ($item) => [
                    'label' => trim((string) ($item['label'] ?? '')) ?: 'Source',
                    'url' => trim((string) ($item['url'] ?? '')),
                ])->values()->all();
        }
    }

    private const EDITABLE_DETAIL_SECTIONS = [
        'OVERVIEW', 'DESIGN', 'POWERTRAIN', 'PERFORMANCE', 'INTERIOR',
        'HANDLING', 'CHASSIS', 'DIMENSIONS', 'DRIVING', 'TRANSMISSION',
    ];

    private function splitLines(string $text): array
    {
        return collect(preg_split('/\\r\\n|\\r|\\n/', $text) ?: [])
            ->map(fn (string $line) => trim($line))
            ->filter(fn (string $line) => $line !== '')
            ->values()->all();
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
