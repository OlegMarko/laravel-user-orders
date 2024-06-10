<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_users()
    {
        User::factory(10)->create();

        $response = $this->getJson('/api/v1/users');

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    #[Test]
    public function it_can_create_a_user()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/v1/users', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    #[Test]
    public function it_can_show_a_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson('/api/v1/users/' . $user->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }

    #[Test]
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $data = [
            'name' => 'Updated User',
            'email' => 'updated@example.com',
            'password' => 'password_updated',
            'password_confirmation' => 'password_updated',
        ];

        $response = $this->putJson('/api/v1/users/' . $user->id, $data);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => 'Updated User',
                'email' => 'updated@example.com',
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated User',
            'email' => 'updated@example.com',
        ]);
    }

    #[Test]
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson('/api/v1/users/' . $user->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
