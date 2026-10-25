<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileAdminShortcutTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_sees_admin_dashboard_shortcut_on_profile(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('profile.show'))
            ->assertOk()
            ->assertSee('Admin Dashboard')
            ->assertSee(route('admin.dashboard'), false);
    }

    public function test_regular_user_does_not_see_admin_dashboard_shortcut_on_profile(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->get(route('profile.show'))
            ->assertOk()
            ->assertDontSee('Admin Dashboard')
            ->assertDontSee(route('admin.dashboard'), false);
    }
}
