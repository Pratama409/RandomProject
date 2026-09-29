<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarCollectionTest extends TestCase
{
    use RefreshDatabase;

    private function createCar(): Car
    {
        $brand = Brand::create([
            'name' => 'Test Automotive',
            'slug' => 'test-automotive',
            'country' => 'Germany',
            'is_active' => true,
        ]);

        return Car::create([
            'brand_id' => $brand->id,
            'name' => 'Test Model',
            'slug' => 'test-model',
            'is_active' => true,
        ]);
    }

    private function createUser(): User
    {
        return User::create([
            'name' => 'Collection Tester',
            'email' => 'collection-tester@example.test',
            'password' => 'test-password',
        ]);
    }

    public function test_authenticated_user_can_toggle_favorite_on_and_off(): void
    {
        $user = $this->createUser();
        $car = $this->createCar();

        $this->actingAs($user)
            ->postJson(route('cars.favorite', $car))
            ->assertOk()
            ->assertJsonPath('active', true);

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'car_id' => $car->id,
        ]);

        $this->actingAs($user)
            ->postJson(route('cars.favorite', $car))
            ->assertOk()
            ->assertJsonPath('active', false);

        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'car_id' => $car->id,
        ]);
    }

    public function test_authenticated_user_can_toggle_wishlist_on_and_off(): void
    {
        $user = $this->createUser();
        $car = $this->createCar();

        $this->actingAs($user)
            ->postJson(route('cars.wishlist', $car))
            ->assertOk()
            ->assertJsonPath('active', true);

        $this->assertDatabaseHas('wishlists', [
            'user_id' => $user->id,
            'car_id' => $car->id,
        ]);

        $this->actingAs($user)
            ->postJson(route('cars.wishlist', $car))
            ->assertOk()
            ->assertJsonPath('active', false);

        $this->assertDatabaseMissing('wishlists', [
            'user_id' => $user->id,
            'car_id' => $car->id,
        ]);
    }

    public function test_guest_cannot_toggle_favorite_or_wishlist(): void
    {
        $car = $this->createCar();

        $this->postJson(route('cars.favorite', $car))
            ->assertUnauthorized();

        $this->postJson(route('cars.wishlist', $car))
            ->assertUnauthorized();
    }

    public function test_inactive_car_cannot_be_added_to_favorites_or_wishlist(): void
    {
        $user = $this->createUser();
        $car = $this->createCar();
        $car->update(['is_active' => false]);

        $this->actingAs($user)
            ->postJson(route('cars.favorite', $car))
            ->assertNotFound();

        $this->actingAs($user)
            ->postJson(route('cars.wishlist', $car))
            ->assertNotFound();

        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'car_id' => $car->id,
        ]);

        $this->assertDatabaseMissing('wishlists', [
            'user_id' => $user->id,
            'car_id' => $car->id,
        ]);
    }
}
