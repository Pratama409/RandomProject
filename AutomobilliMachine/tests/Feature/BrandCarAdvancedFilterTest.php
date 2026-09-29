<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandCarAdvancedFilterTest extends TestCase
{
    use RefreshDatabase;

    private function createBrand(): Brand
    {
        return Brand::create([
            'name' => 'Filter Motors',
            'slug' => 'filter-motors',
            'country' => 'Germany',
            'is_active' => true,
        ]);
    }

    private function createCar(Brand $brand, string $name, string $slug, array $attributes = []): Car
    {
        return Car::create(array_merge([
            'brand_id' => $brand->id,
            'name' => $name,
            'slug' => $slug,
            'production_year_start' => 2020,
            'is_active' => true,
        ], $attributes));
    }

    public function test_brand_catalog_filters_by_drivetrain(): void
    {
        $brand = $this->createBrand();
        $this->createCar($brand, 'All Wheel Drive', 'awd', ['drivetrain' => 'AWD']);
        $this->createCar($brand, 'Rear Wheel Drive', 'rwd', ['drivetrain' => 'RWD']);

        $this->getJson(route('brands.cars', ['brand' => $brand, 'drivetrain' => 'AWD']))
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'All Wheel Drive');
    }

    public function test_brand_catalog_filters_by_fuel_type(): void
    {
        $brand = $this->createBrand();
        $this->createCar($brand, 'Electric Model', 'electric', ['fuel_type' => 'Electric']);
        $this->createCar($brand, 'Petrol Model', 'petrol', ['fuel_type' => 'Petrol']);

        $this->getJson(route('brands.cars', ['brand' => $brand, 'fuel_type' => 'Electric']))
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Electric Model');
    }

    public function test_brand_catalog_filters_by_vehicle_type(): void
    {
        $brand = $this->createBrand();
        $this->createCar($brand, 'Road Car', 'road-car', ['vehicle_type' => 'Road Car']);
        $this->createCar($brand, 'Race Car', 'race-car', ['vehicle_type' => 'Race Car']);

        $this->getJson(route('brands.cars', ['brand' => $brand, 'vehicle_type' => 'Race Car']))
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Race Car');
    }

    public function test_production_filter_excludes_limited_and_track_only_models(): void
    {
        $brand = $this->createBrand();

        $this->createCar($brand, 'Public Production Model', 'public-production', [
            'production_type' => 'Production',
            'publicly_sold' => true,
            'road_legal' => true,
            'is_limited' => false,
            'is_one_off' => false,
            'is_concept' => false,
            'is_track_only' => false,
            'is_racing' => false,
        ]);

        $this->createCar($brand, 'Limited Production Model', 'limited-production', [
            'production_type' => 'Production',
            'publicly_sold' => true,
            'road_legal' => true,
            'is_limited' => true,
            'is_one_off' => false,
            'is_concept' => false,
            'is_track_only' => false,
            'is_racing' => false,
        ]);

        $this->createCar($brand, 'Track Only Model', 'track-only', [
            'production_type' => 'Production',
            'publicly_sold' => true,
            'road_legal' => false,
            'is_limited' => false,
            'is_one_off' => false,
            'is_concept' => false,
            'is_track_only' => true,
            'is_racing' => false,
        ]);

        $this->getJson(route('brands.cars', ['brand' => $brand, 'production_type' => 'Production']))
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Public Production Model');
    }

    public function test_inactive_brand_catalog_returns_not_found(): void
    {
        $brand = $this->createBrand();
        $brand->update(['is_active' => false]);

        $this->getJson(route('brands.cars', $brand))
            ->assertNotFound();
    }
}
