<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    #[Test]
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $order->user);
    }

    #[Test]
    public function it_belongs_to_a_product()
    {
        $product = Product::factory()->create();
        $order = Order::factory()->create(['product_id' => $product->id]);

        $this->assertInstanceOf(Product::class, $order->product);
    }
}
