<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthRedirectTest extends TestCase
{
    public function test_admin_login_redirects_directly_to_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => 'password',
        ]);

        $this->withSession(['url.intended' => route('profile.show')])
            ->post(route('login.store'), [
                'email' => $admin->email,
                'password' => 'password',
            ])
            ->assertRedirect(route('admin.dashboard'))
            ->assertAuthenticatedAs($admin);
    }

    public function test_regular_user_login_redirects_to_profile(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'password' => 'password',
        ]);

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])
            ->assertRedirect(route('profile.show'))
            ->assertAuthenticatedAs($user);
    }

    public function test_login_rejects_protocol_relative_external_redirects(): void
    {
        $this->get('/login?redirect=//example.com')
            ->assertOk()
            ->assertSessionMissing('url.intended');
    }

    public function test_login_accepts_internal_relative_redirects(): void
    {
        $this->get('/login?redirect=%2Fcollection%3Ftab%3Dwishlist')
            ->assertOk()
            ->assertSessionHas('url.intended', '/collection?tab=wishlist');
    }

    public function test_login_rejects_backslash_redirects(): void
    {
        $this->get('/login?redirect=%2F%5Cexample.com')
            ->assertOk()
            ->assertSessionMissing('url.intended');
    }
}
