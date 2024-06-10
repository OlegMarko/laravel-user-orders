<?php

namespace Tests\Feature;

use App\Jobs\ProcessOrder;
use App\Mail\OrderProcessed;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ProcessOrderJobTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_processes_an_order_and_sends_email()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        Mail::fake();
        Queue::fake();

        Queue::assertPushed(ProcessOrder::class, function ($job) use ($order) {
            return $job->order->id === $order->id;
        });

        Mail::assertSent(OrderProcessed::class, function ($mail) use ($order, $user) {
            return $mail->order->id === $order->id && $mail->hasTo($user->email);
        });
    }
}
