<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_contains_a_csrf_token(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('name="_token"', false);
    }

    public function test_user_can_login_and_logout_with_the_same_session(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('test-password'),
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'test-password',
        ])->assertRedirect('/home');

        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'))
            ->assertRedirect('/');

        $this->assertGuest();
    }

    public function test_https_app_url_defaults_to_secure_session_cookies(): void
    {
        $this->assertTrue(config('session.secure'));
        $this->assertSame('lax', config('session.same_site'));
    }
}
