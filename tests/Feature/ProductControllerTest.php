<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_products()
    {
        Product::factory(10)->create();

        $response = $this->getJson('/api/v1/products');

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    #[Test]
    public function it_can_create_a_product()
    {
        $data = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 100,
        ];

        $response = $this->postJson('/api/v1/products', $data);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Test Product',
                'description' => 'Test Description',
                'price' => 100,
            ]);

        $this->assertDatabaseHas('products', $data);
    }

    #[Test]
    public function it_can_show_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson('/api/v1/products/' . $product->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $product->id,
            ]);
    }

    #[Test]
    public function it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $data = [
            'name' => 'Updated Product',
            'price' => 150,
            'description' => 'Updated Description',
        ];

        $response = $this->putJson('/api/v1/products/' . $product->id, $data);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $product->id,
                'name' => 'Updated Product',
            ]);

        $this->assertDatabaseHas('products', $data);
    }

    #[Test]
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson('/api/v1/products/' . $product->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
