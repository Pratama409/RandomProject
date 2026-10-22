<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCarCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_catalog(): void
    {
        $this->get(route('admin.cars.index'))
            ->assertRedirect(route('login'));
    }

    public function test_regular_user_cannot_access_admin_catalog(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->get(route('admin.cars.index'))
            ->assertForbidden();
    }

    public function test_admin_can_create_update_and_delete_a_car_using_eloquent(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $brand = $this->createBrand();

        $this->actingAs($admin)
            ->post(route('admin.cars.store'), $this->validCarData($brand))
            ->assertRedirect(route('admin.cars.index'))
            ->assertSessionHas('success');

        $car = Car::query()->where('brand_id', $brand->id)->where('slug', 'test-roadster')->firstOrFail();

        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'brand_id' => $brand->id,
            'name' => 'Test Roadster',
            'is_active' => 1,
        ]);

        $updatedData = array_merge($this->validCarData($brand), [
            'name' => 'Updated Roadster',
            'slug' => 'updated-roadster',
            'is_active' => '1',
            'is_featured' => '1',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.cars.update', $car), $updatedData)
            ->assertRedirect(route('admin.cars.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'name' => 'Updated Roadster',
            'slug' => 'updated-roadster',
            'is_featured' => 1,
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.cars.destroy', $car))
            ->assertRedirect(route('admin.cars.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }

    public function test_slug_must_be_unique_within_the_selected_brand(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $brand = $this->createBrand();

        Car::create($this->validCarData($brand));

        $this->actingAs($admin)
            ->from(route('admin.cars.create'))
            ->post(route('admin.cars.store'), $this->validCarData($brand))
            ->assertRedirect(route('admin.cars.create'))
            ->assertSessionHasErrors('slug');

        $this->assertDatabaseCount('cars', 1);
    }

    private function createBrand(): Brand
    {
        return Brand::create([
            'name' => 'Test Motor Works',
            'slug' => 'test-motor-works',
            'country' => 'Germany',
            'is_active' => true,
        ]);
    }

    private function validCarData(Brand $brand): array
    {
        return [
            'brand_id' => $brand->id,
            'category_id' => null,
            'name' => 'Test Roadster',
            'slug' => 'test-roadster',
            'production_type' => 'Production',
            'vehicle_type' => 'Road Car',
            'production_year_start' => 2024,
            'production_year_end' => null,
            'horsepower' => 450,
            'acceleration_0_100' => 3.8,
            'top_speed_kmh' => 300,
            'is_active' => '1',
            'publicly_sold' => '1',
            'road_legal' => '1',
            'is_limited' => '0',
            'is_one_off' => '0',
            'is_concept' => '0',
            'is_track_only' => '0',
            'is_racing' => '0',
            'is_iconic' => '0',
            'is_featured' => '0',
        ];
    }
}
