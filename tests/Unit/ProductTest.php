<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_it_has_many_orders()
    {
        $product = Product::factory()->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $product->orders);
    }
}
