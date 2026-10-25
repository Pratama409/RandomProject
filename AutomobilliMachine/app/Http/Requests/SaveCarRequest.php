<?php

namespace App\Http\Requests;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    /**
     * Unchecked HTML checkboxes are omitted from the request.
     * Normalize them to false so edits can turn a flag off.
     */
    protected function prepareForValidation(): void
    {
        $flags = [
            'road_legal',
            'publicly_sold',
            'is_limited',
            'is_one_off',
            'is_concept',
            'is_track_only',
            'is_racing',
            'stats_tested',
            'is_iconic',
            'is_featured',
            'is_active',
        ];

        $this->merge(collect($flags)
            ->mapWithKeys(fn (string $flag) => [$flag => $this->boolean($flag)])
            ->all());
    }

    public function rules(): array
    {
        $car = $this->route('car');
        $slugRule = Rule::unique('cars', 'slug')
            ->where(fn ($query) => $query->where('brand_id', $this->input('brand_id')));

        if ($car instanceof Car) {
            $slugRule->ignore($car->getKey());
        }

        return [
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'category_id' => ['nullable', 'integer', 'exists:car_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', $slugRule],
            'model_family' => ['nullable', 'string', 'max:255'],
            'generation' => ['nullable', 'string', 'max:255'],
            'variant' => ['nullable', 'string', 'max:255'],
            'base_model' => ['nullable', 'string', 'max:255'],
            'production_year_start' => ['nullable', 'integer', 'min:1885', 'max:' . (now()->year + 3)],
            'production_year_end' => ['nullable', 'integer', 'gte:production_year_start', 'max:' . (now()->year + 3)],
            'production_count' => ['nullable', 'integer', 'min:1'],
            'production_type' => ['required', 'string', 'max:40'],
            'vehicle_type' => ['required', 'string', 'max:40'],
            'road_legal' => ['required', 'boolean'],
            'publicly_sold' => ['required', 'boolean'],
            'is_limited' => ['required', 'boolean'],
            'is_one_off' => ['required', 'boolean'],
            'is_concept' => ['required', 'boolean'],
            'is_track_only' => ['required', 'boolean'],
            'is_racing' => ['required', 'boolean'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string', 'max:20000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'gallery_files' => ['sometimes', 'array', 'max:16'],
            'gallery_files.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'gallery_remove' => ['sometimes', 'array', 'max:80'],
            'gallery_remove.*' => ['string', 'max:2048'],
            'detail_editor' => ['sometimes', 'array', 'max:14'],
            'detail_editor.*' => ['array'],
            'detail_editor.*.title' => ['nullable', 'string', 'max:255'],
            'detail_editor.*.paragraphs_text' => ['nullable', 'string', 'max:15000'],
            'detail_editor.*.items_text' => ['nullable', 'string', 'max:8000'],
            'detail_editor.*.specs_text' => ['nullable', 'string', 'max:12000'],
            'detail_editor.*.remove' => ['nullable', 'boolean'],
            'section_images' => ['sometimes', 'array', 'max:14'],
            'section_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'section_image_remove' => ['sometimes', 'array', 'max:14'],
            'section_image_remove.*' => ['boolean'],
            'variants_editor' => ['sometimes', 'array', 'max:30'],
            'variants_editor.*.type' => ['nullable', 'string', 'max:100'],
            'variants_editor.*.name' => ['nullable', 'string', 'max:255'],
            'variants_editor.*.years' => ['nullable', 'string', 'max:100'],
            'variants_editor.*.description' => ['nullable', 'string', 'max:2000'],
            'sources_editor' => ['sometimes', 'array', 'max:30'],
            'sources_editor.*.label' => ['nullable', 'string', 'max:255'],
            'sources_editor.*.url' => ['nullable', 'url', 'starts_with:https://,http://', 'max:2048'],
            'engine' => ['nullable', 'string', 'max:255'],
            'horsepower' => ['nullable', 'integer', 'min:0', 'max:10000'],
            'torque_nm' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'acceleration_0_100' => ['nullable', 'numeric', 'min:0', 'max:99.99'],
            'stats_tested' => ['nullable', 'boolean'],
            'top_speed_kmh' => ['nullable', 'integer', 'min:0', 'max:1000'],
            'drivetrain' => ['nullable', 'string', 'max:100'],
            'transmission' => ['nullable', 'string', 'max:100'],
            'fuel_type' => ['nullable', 'string', 'max:100'],
            'body_type' => ['nullable', 'string', 'max:100'],
            'iconic_order' => ['nullable', 'integer', 'min:0', 'max:255'],
            'is_iconic' => ['required', 'boolean'],
            'is_featured' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
