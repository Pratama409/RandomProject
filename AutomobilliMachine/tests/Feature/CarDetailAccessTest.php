<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarDetailAccessTest extends TestCase
{
    use RefreshDatabase;

    private function createBrand(bool $active = true): Brand
    {
        return Brand::create([
            'name' => 'Detail Motors',
            'slug' => 'detail-motors',
            'country' => 'Germany',
            'is_active' => $active,
        ]);
    }

    private function createCar(Brand $brand, string $name, string $slug, bool $active = true): Car
    {
        return Car::create([
            'brand_id' => $brand->id,
            'name' => $name,
            'slug' => $slug,
            'production_year_start' => 2022,
            'is_active' => $active,
        ]);
    }

    public function test_active_car_detail_page_is_accessible(): void
    {
        $brand = $this->createBrand();
        $car = $this->createCar($brand, 'Detail Coupe', 'detail-coupe');

        $this->get(route('cars.show', ['brand' => $brand, 'car' => $car->slug]))
            ->assertOk()
            ->assertViewIs('cars.show')
            ->assertViewHas('vehicle', fn (Car $vehicle) => $vehicle->is($car));
    }

    public function test_detail_menu_matches_available_sections_and_rich_content(): void
    {
        $brand = $this->createBrand();
        $car = $this->createCar($brand, 'Complete Coupe', 'complete-coupe');

        $car->update([
            'image_path' => 'image/cars/front.jpg',
            'gallery_images' => ['image/cars/rear.jpg'],
            'detail_sections' => [
                ['label' => 'OVERVIEW', 'title' => 'An iconic story', 'paragraphs' => ['The model story.']],
                ['label' => 'DESIGN', 'title' => 'Sculpted design', 'paragraphs' => ['The shape of the car.']],
                ['label' => 'POWERTRAIN', 'title' => 'Technical powertrain', 'paragraphs' => ['Engine details.']],
                ['label' => 'INTERIOR', 'title' => 'The cockpit', 'paragraphs' => ['Interior details.']],
                ['label' => 'DIMENSIONS', 'title' => 'Size', 'specs' => [['label' => 'Length', 'value' => '4,500 mm']]],
            ],
            'variants' => [['type' => 'Special', 'name' => 'Track Pack', 'years' => '2024', 'description' => 'Lightweight.']],
            'source_links' => [['label' => 'Official source', 'url' => 'https://example.com/official']],
        ]);

        $this->get(route('cars.show', ['brand' => $brand, 'car' => $car->slug]))
            ->assertOk()
            ->assertSee('An iconic story')
            ->assertSee('Sculpted design')
            ->assertSee('Technical powertrain')
            ->assertSee('The cockpit')
            ->assertSee('Track Pack')
            ->assertSee('Official source')
            ->assertSee('href="#gallery"', false)
            ->assertDontSee('href="#insights"', false);
    }

    public function test_empty_gallery_and_unavailable_detail_tabs_are_not_listed(): void
    {
        $brand = $this->createBrand();
        $car = $this->createCar($brand, 'Minimal Coupe', 'minimal-coupe');

        $this->get(route('cars.show', ['brand' => $brand, 'car' => $car->slug]))
            ->assertOk()
            ->assertDontSee('href="#gallery"', false)
            ->assertDontSee('href="#design"', false)
            ->assertDontSee('href="#powertrain"', false)
            ->assertDontSee('href="#insights"', false);
    }

    public function test_inactive_car_detail_page_returns_not_found(): void
    {
        $brand = $this->createBrand();
        $car = $this->createCar($brand, 'Hidden Coupe', 'hidden-coupe', false);

        $this->get(route('cars.show', ['brand' => $brand, 'car' => $car->slug]))
            ->assertNotFound();
    }

    public function test_car_cannot_be_opened_under_another_brand_url(): void
    {
        $brand = $this->createBrand();
        $otherBrand = Brand::create([
            'name' => 'Other Motors',
            'slug' => 'other-motors',
            'country' => 'Italy',
            'is_active' => true,
        ]);
        $car = $this->createCar($brand, 'Detail Coupe', 'detail-coupe');

        $this->get(route('cars.show', ['brand' => $otherBrand, 'car' => $car->slug]))
            ->assertNotFound();
    }

    public function test_car_detail_under_inactive_brand_returns_not_found(): void
    {
        $brand = $this->createBrand(false);
        $car = $this->createCar($brand, 'Hidden Brand Coupe', 'hidden-brand-coupe');

        $this->get(route('cars.show', ['brand' => $brand, 'car' => $car->slug]))
            ->assertNotFound();
    }
}
