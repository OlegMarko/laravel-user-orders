<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_it_has_many_orders()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->orders);
    }
}
