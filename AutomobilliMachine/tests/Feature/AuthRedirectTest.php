<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthRedirectTest extends TestCase
{
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
