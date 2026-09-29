<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandCarCatalogTest extends TestCase
{
    use RefreshDatabase;

    private function createBrand(): Brand
    {
        return Brand::create([
            'name' => 'Catalog Motors',
            'slug' => 'catalog-motors',
            'country' => 'Germany',
            'is_active' => true,
        ]);
    }

    private function createCar(
        Brand $brand,
        string $name,
        string $slug,
        int $yearStart,
        ?int $yearEnd = null,
        bool $active = true,
        bool $featured = false,
        bool $iconic = false,
    ): Car {
        return Car::create([
            'brand_id' => $brand->id,
            'name' => $name,
            'slug' => $slug,
            'production_year_start' => $yearStart,
            'production_year_end' => $yearEnd,
            'is_active' => $active,
            'is_featured' => $featured,
            'is_iconic' => $iconic,
        ]);
    }

    public function test_brand_catalog_returns_only_active_cars(): void
    {
        $brand = $this->createBrand();
        $this->createCar($brand, 'Active Roadster', 'active-roadster', 2020);
        $this->createCar($brand, 'Hidden Roadster', 'hidden-roadster', 2021, null, false);

        $this->getJson(route('brands.cars', $brand))
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Active Roadster');
    }

    public function test_brand_catalog_search_filters_car_names(): void
    {
        $brand = $this->createBrand();
        $this->createCar($brand, 'Apex Coupe', 'apex-coupe', 2020);
        $this->createCar($brand, 'Touring Sedan', 'touring-sedan', 2021);

        $this->getJson(route('brands.cars', ['brand' => $brand, 'search' => 'Apex']))
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Apex Coupe');
    }

    public function test_brand_catalog_year_filter_includes_models_produced_during_selected_year(): void
    {
        $brand = $this->createBrand();
        $this->createCar($brand, 'Earlier Model', 'earlier-model', 2010, 2015);
        $this->createCar($brand, 'Current Model', 'current-model', 2014, 2020);
        $this->createCar($brand, 'Later Model', 'later-model', 2021, 2024);

        $this->getJson(route('brands.cars', ['brand' => $brand, 'year' => 2015]))
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonFragment(['name' => 'Earlier Model'])
            ->assertJsonFragment(['name' => 'Current Model']);
    }

    public function test_brand_catalog_orders_featured_then_iconic_then_regular_cars(): void
    {
        $brand = $this->createBrand();
        $this->createCar($brand, 'Regular Model', 'regular-model', 2024);
        $this->createCar($brand, 'Iconic Model', 'iconic-model', 2022, null, true, false, true);
        $this->createCar($brand, 'Featured Model', 'featured-model', 2020, null, true, true, false);

        $this->getJson(route('brands.cars', $brand))
            ->assertOk()
            ->assertJsonPath('data.0.name', 'Featured Model')
            ->assertJsonPath('data.1.name', 'Iconic Model')
            ->assertJsonPath('data.2.name', 'Regular Model');
    }

    public function test_brand_catalog_caps_page_size_at_twenty_four(): void
    {
        $brand = $this->createBrand();

        for ($i = 1; $i <= 26; $i++) {
            $this->createCar($brand, 'Model ' . $i, 'model-' . $i, 2020);
        }

        $this->getJson(route('brands.cars', ['brand' => $brand, 'per_page' => 100]))
            ->assertOk()
            ->assertJsonCount(24, 'data')
            ->assertJsonPath('per_page', 24);
    }
}
