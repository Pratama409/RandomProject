<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_lists_active_featured_brands_first_in_configured_order(): void
    {
        Brand::create([
            'name' => 'Inactive Brand',
            'slug' => 'inactive-brand',
            'country' => 'Italy',
            'is_active' => false,
            'is_featured' => true,
            'sort_order' => 0,
        ]);

        Brand::create([
            'name' => 'Regular Brand',
            'slug' => 'regular-brand',
            'country' => 'Germany',
            'is_active' => true,
            'is_featured' => false,
            'sort_order' => 0,
        ]);

        Brand::create([
            'name' => 'Featured Later',
            'slug' => 'featured-later',
            'country' => 'Italy',
            'is_active' => true,
            'is_featured' => true,
            'sort_order' => 20,
        ]);

        Brand::create([
            'name' => 'Featured First',
            'slug' => 'featured-first',
            'country' => 'Italy',
            'is_active' => true,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertViewHas('brands', function ($brands): bool {
                return $brands->pluck('slug')->all() === [
                    'featured-first',
                    'featured-later',
                    'regular-brand',
                ];
            });
    }
}
