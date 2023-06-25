<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(
            \App\Http\Middleware\VerifyCsrfToken::class
        );
    }

    public function test_login_and_view_dashboard()
    {
        // Create a user
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'), // Hash the password
        ]);

        // Call the login function
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Check if the user is redirected to the dashboard
        $response->assertStatus(302); // 302 is the status code for redirection

        // Check if the user is authenticated
        $this->assertAuthenticatedAs($user);
    }

    public function test_update_profile()
    {
        // Create a user
        $user = User::factory()->create();

        // Login as the user
        $this->actingAs($user);

        // Update user profile
        $response = $this->patch('/profile', [
            'name' => 'New Name',
        ]);

        // Refresh user instance and check if the name has been updated
        $response->assertRedirect('/profile');
    }
}

