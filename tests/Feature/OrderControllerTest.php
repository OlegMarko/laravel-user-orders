<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_orders()
    {
        Order::factory(10)->create();

        $response = $this->getJson('/api/v1/orders');

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    #[Test]
    public function it_can_create_an_order()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $data = [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ];

        $response = $this->postJson('/api/v1/orders', $data);

        $response->assertStatus(201)
            ->assertJson([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);

        $this->assertDatabaseHas('orders', $data);
    }

    #[Test]
    public function it_can_show_an_order()
    {
        $order = Order::factory()->create();

        $response = $this->getJson('/api/v1/orders/' . $order->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $order->id,
            ]);
    }

    #[Test]
    public function it_can_update_an_order()
    {
        $order = Order::factory()->create();

        $data = [
            'quantity' => 2,
        ];

        $response = $this->putJson('/api/v1/orders/' . $order->id, $data);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $order->id,
                'quantity' => 2,
            ]);

        $this->assertDatabaseHas('orders', $data);
    }

    #[Test]
    public function it_can_delete_an_order()
    {
        $order = Order::factory()->create();

        $response = $this->deleteJson('/api/v1/orders/' . $order->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }
}
