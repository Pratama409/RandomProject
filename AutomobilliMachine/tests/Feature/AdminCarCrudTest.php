<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AdminCarCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_create_update_and_delete_routes_exist_only_in_admin_namespace(): void
    {
        $this->assertTrue(Route::has('admin.cars.create'));
        $this->assertTrue(Route::has('admin.cars.store'));
        $this->assertTrue(Route::has('admin.cars.edit'));
        $this->assertTrue(Route::has('admin.cars.update'));
        $this->assertTrue(Route::has('admin.cars.destroy'));

        $this->assertFalse(Route::has('cars.create'));
        $this->assertFalse(Route::has('cars.store'));
        $this->assertFalse(Route::has('cars.edit'));
        $this->assertFalse(Route::has('cars.update'));
        $this->assertFalse(Route::has('cars.destroy'));
    }

    public function test_admin_catalog_uses_quick_notifications_and_custom_delete_confirmation(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.cars.index'))
            ->assertOk()
            ->assertSee('data-admin-toast-region', false)
            ->assertSee('data-admin-confirm-dialog', false)
            ->assertSee('data-confirm-submit', false)
            ->assertDontSee('onsubmit="return confirm(', false);
    }

    public function test_car_forms_use_universal_placeholders_and_custom_required_notifications(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.cars.create'))
            ->assertOk()
            ->assertSee('data-admin-validate', false)
            ->assertSee('data-unsaved-guard', false)
            ->assertSee('data-confirm-navigation', false)
            ->assertSee('novalidate', false)
            ->assertSee('placeholder="Enter the vehicle name"', false)
            ->assertSee('placeholder="e.g. model-name"', false)
            ->assertSee('placeholder="e.g. Production / Concept / Racing"', false)
            ->assertSee('placeholder="e.g. Road Car / Race Car / Concept Car"', false)
            ->assertDontSee('value="Production"', false)
            ->assertDontSee('value="Road Car"', false)
            ->assertDontSee('placeholder="Ferrari 458 Italia"', false);

        $brand = $this->createBrand();
        $car = Car::create($this->validCarData($brand));

        $this->actingAs($admin)
            ->get(route('admin.cars.edit', $car))
            ->assertOk()
            ->assertSee('data-admin-validate', false)
            ->assertSee('data-unsaved-guard', false)
            ->assertSee('novalidate', false);
    }

    public function test_admin_layout_supports_dirty_form_navigation_guard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.cars.create'))
            ->assertOk()
            ->assertSee('getDirtyGuardedForm', false)
            ->assertSee('getActiveGuardedForm', false)
            ->assertSee('Form in progress', false)
            ->assertSee('Use Cancel to leave this form', false)
            ->assertSee('Stay and continue editing')
            ->assertSee('Discard changes & leave', false);
    }

    public function test_edit_cancel_button_warns_before_discarding_changes(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $brand = $this->createBrand();
        $car = Car::create($this->validCarData($brand));

        $this->actingAs($admin)
            ->get(route('admin.cars.edit', $car))
            ->assertOk()
            ->assertSee('data-unsaved-guard', false)
            ->assertSee('data-confirm-navigation', false)
            ->assertSee('data-confirm-variant="warning"', false)
            ->assertSee('data-confirm-title="Discard your changes?"', false)
            ->assertSee('data-confirm-confirm-label="Discard changes"', false);
    }

    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_admin_dashboard_shows_catalog_summary(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $brand = $this->createBrand();

        Car::create($this->validCarData($brand));

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Welcome back')
            ->assertSee('Total vehicles')
            ->assertSee('Test Roadster')
            ->assertSee('Car Catalog');
    }

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

    public function test_admin_can_upload_a_car_image_to_the_public_image_directory(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $brand = $this->createBrand();

        $response = $this->actingAs($admin)->post(route('admin.cars.store'), array_merge(
            $this->validCarData($brand),
            ['image' => UploadedFile::fake()->image('test-roadster.jpg')]
        ));

        $response->assertRedirect(route('admin.cars.index'));

        $car = Car::query()
            ->where('brand_id', $brand->id)
            ->where('slug', 'test-roadster')
            ->firstOrFail();

        $this->assertStringStartsWith('image/cars/', $car->image_path);
        $this->assertFileExists(public_path($car->image_path));

        @unlink(public_path($car->image_path));
    }

    public function test_admin_can_manage_complete_vehicle_details_and_photo_gallery(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $brand = $this->createBrand();

        $payload = array_merge($this->validCarData($brand), [
            'detail_editor' => [
                'OVERVIEW' => [
                    'title' => 'An automotive milestone',
                    'paragraphs_text' => "First paragraph.\nSecond paragraph.",
                    'specs_text' => "Year | 2024\nDrive | AWD",
                    'items_text' => '',
                ],
                'POWERTRAIN' => [
                    'title' => 'Powertrain explained',
                    'paragraphs_text' => 'Hybrid powertrain description.',
                    'specs_text' => 'Output | 500 HP',
                    'items_text' => 'Electric boost',
                ],
            ],
            'section_images' => [
                'POWERTRAIN' => UploadedFile::fake()->image('powertrain.jpg'),
            ],
            'gallery_editor_present' => '1',
            'gallery_files' => [UploadedFile::fake()->image('side.jpg')],
            'variants_editor_present' => '1',
            'variants_editor' => [
                ['name' => 'Sport', 'type' => 'Performance', 'years' => '2024–2025', 'description' => 'Sport package'],
            ],
            'sources_editor_present' => '1',
            'sources_editor' => [
                ['label' => 'Manufacturer', 'url' => 'https://example.com/specifications'],
            ],
        ]);

        $this->actingAs($admin)
            ->post(route('admin.cars.store'), $payload)
            ->assertRedirect(route('admin.cars.index'))
            ->assertSessionHas('success');

        $car = Car::query()->where('slug', 'test-roadster')->firstOrFail();
        $sections = collect($car->detail_sections)->keyBy('label');
        $this->assertSame(['First paragraph.', 'Second paragraph.'], $sections->get('OVERVIEW')['paragraphs']);
        $this->assertSame('AWD', $sections->get('OVERVIEW')['specs'][1]['value']);
        $this->assertStringStartsWith('image/cars/', $sections->get('POWERTRAIN')['image']);
        $this->assertSame('Sport', $car->variants[0]['name']);
        $this->assertSame('https://example.com/specifications', $car->source_links[0]['url']);
        $this->assertCount(1, $car->gallery_images);
        $this->assertFileExists(public_path($car->gallery_images[0]));
        $this->assertFileExists(public_path($sections->get('POWERTRAIN')['image']));

        $oldGallery = $car->gallery_images[0];
        $oldEngineImage = $sections->get('POWERTRAIN')['image'];

        $updated = array_merge($this->validCarData($brand), [
            'gallery_editor_present' => '1',
            'gallery_remove' => [$oldGallery],
            'detail_editor' => [
                'OVERVIEW' => [
                    'title' => 'Updated story',
                    'paragraphs_text' => 'Revised introduction.',
                    'specs_text' => '',
                    'items_text' => '',
                ],
                'POWERTRAIN' => [
                    'title' => 'Powertrain explained',
                    'paragraphs_text' => 'Hybrid powertrain description.',
                    'specs_text' => 'Output | 500 HP',
                    'items_text' => '',
                ],
            ],
            'section_image_remove' => ['POWERTRAIN' => '1'],
            'variants_editor_present' => '1',
            'sources_editor_present' => '1',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.cars.update', $car), $updated)
            ->assertRedirect(route('admin.cars.index'));

        $car->refresh();
        $this->assertSame([], $car->gallery_images);
        $this->assertSame([], $car->variants);
        $this->assertSame([], $car->source_links);
        $updatedSections = collect($car->detail_sections)->keyBy('label');
        $this->assertSame('Updated story', $updatedSections->get('OVERVIEW')['title']);
        $this->assertArrayNotHasKey('image', $updatedSections->get('POWERTRAIN'));

        // Uploaded files are intentionally not deleted when references change;
        // this test cleans its own artifacts instead.
        @unlink(public_path($oldGallery));
        @unlink(public_path($oldEngineImage));
    }

    public function test_car_form_renders_full_vehicle_editor(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.cars.create'))
            ->assertOk()
            ->assertSee('Vehicle Photo Gallery')
            ->assertSee('Editorial Detail Sections')
            ->assertSee('Variants &amp; Related Models')
            ->assertSee('Sources &amp; References')
            ->assertSee('name="gallery_files[]"', false)
            ->assertSee('name="detail_editor[OVERVIEW][title]"', false)
            ->assertSee('name="section_images[POWERTRAIN]"', false);
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
