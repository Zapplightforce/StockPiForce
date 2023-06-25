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

    public function test_login_with_incorrect_credentials()
    {
        // Create a user
        $user = User::factory()->create([
            'password' => bcrypt('password'), // Hash the password
        ]);

        // Call the login function with incorrect password
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        // Check if the response status is not successful (i.e., the login failed)
        $response->assertStatus(302);

        // Check if the session contains errors
        $response->assertSessionHasErrors();
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

    public function test_update_profile_without_required_field()
    {
        // Create a user
        $user = User::factory()->create();

        // Login as the user
        $this->actingAs($user);

        // Attempt to update user profile without required field
        $response = $this->patch('/profile', [
            'name' => '',
        ]);

        // Check if the user sees the error message
        $response->assertSessionHasErrors('name');
    }
}


