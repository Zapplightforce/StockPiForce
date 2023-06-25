<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticatedSessionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(
            \App\Http\Middleware\VerifyCsrfToken::class
        );
    }

    public function test_login_function()
    {
        // Create a user
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        // Call the login function
        $response = $this->post('login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Check if the user is redirected to the dashboard
        $response->assertStatus(302);

        // Check if the user is authenticated
        $this->assertAuthenticatedAs($user);
    }
}


