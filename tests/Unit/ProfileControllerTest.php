<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(
            \App\Http\Middleware\VerifyCsrfToken::class
        );
    }

    public function test_update_function()
    {
        // Create a user
        $user = User::factory()->create();

        // Login the user
        $this->actingAs($user);

        // Update user profile
        $response = $this->patch('/profile', [
            'name' => 'New Name',
        ]);

        // Check if the update was successful
        $response->assertStatus(302);

        // Refresh user instance and check if the name has been updated
        $user = $user->fresh();

        $this->assertEquals('New Name', $user->name);
    }
}


