<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchCatalogTest extends TestCase
{
    use RefreshDatabase;

    private function createBrand(string $name, string $slug, bool $active = true): Brand
    {
        return Brand::create([
            'name' => $name,
            'slug' => $slug,
            'country' => 'Germany',
            'is_active' => $active,
        ]);
    }

    private function createCar(Brand $brand, string $name, string $slug, bool $active = true, bool $featured = false, bool $iconic = false): Car
    {
        return Car::create([
            'brand_id' => $brand->id,
            'name' => $name,
            'slug' => $slug,
            'is_active' => $active,
            'is_featured' => $featured,
            'is_iconic' => $iconic,
        ]);
    }

    public function test_short_search_term_returns_empty_results(): void
    {
        $this->getJson(route('search.index', ['q' => 'G']))
            ->assertOk()
            ->assertExactJson([
                'brands' => [],
                'cars' => [],
            ]);
    }

    public function test_search_excludes_inactive_brands_and_cars(): void
    {
        $activeBrand = $this->createBrand('GT Motors', 'gt-motors');
        $inactiveBrand = $this->createBrand('GT Hidden Motors', 'gt-hidden-motors', false);

        $this->createCar($activeBrand, 'GT Roadster', 'gt-roadster');
        $this->createCar($inactiveBrand, 'GT Hidden Car', 'gt-hidden-car');

        $response = $this->getJson(route('search.index', ['q' => 'GT']))
            ->assertOk()
            ->assertJsonCount(1, 'brands')
            ->assertJsonCount(1, 'cars');

        $response->assertJsonPath('brands.0.name', 'GT Motors');
        $response->assertJsonPath('cars.0.name', 'GT Roadster');
    }

    public function test_search_orders_featured_cars_before_iconic_and_regular_cars(): void
    {
        $brand = $this->createBrand('GT Motors', 'gt-motors');

        $this->createCar($brand, 'GT Regular', 'gt-regular');
        $this->createCar($brand, 'GT Iconic', 'gt-iconic', true, false, true);
        $this->createCar($brand, 'GT Featured', 'gt-featured', true, true, false);

        $this->getJson(route('search.index', ['q' => 'GT']))
            ->assertOk()
            ->assertJsonPath('cars.0.name', 'GT Featured')
            ->assertJsonPath('cars.1.name', 'GT Iconic')
            ->assertJsonPath('cars.2.name', 'GT Regular');
    }
}
